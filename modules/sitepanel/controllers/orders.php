<?php
class Orders extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct(); 
		
		$this->load->model(array('order/order_model'));  
		  $this->load->helper(array('cart/cart','file'));		
		$this->config->set_item('menu_highlight','order management');	
		$this->load->library(array('Dmailer'));
		
	}

	public  function index($page = NULL)
	{
		
		
		$pagesize               =  (int) $this->input->get_post('pagesize');

		$user_id               =  (int) $this->input->get_post('user_id');
		
		$config['limit']		=  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
		
		$offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	
		
		$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));
		
		$res_array              =  $this->order_model->get_orders($offset,$config['limit']);	
		
		$config['total_rows']   =  $this->order_model->total_rec_found;		
		
		$total_transaction              =  $this->order_model->get_total_transaction();
		
		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);	
		
		
		/* Order oprations  */
		
		
		if(  $this->input->post('unset_as')!='' )
		{			
			$this->set_as('wl_order','order_id',array('payment_status'=>'Unpaid'));			
		}
		
		if(  $this->input->post('ord_status')!='' )
		{	
		    $posted_order_status = $this->input->post('ord_status');		
			$this->set_as('wl_order','order_id',array('order_status'=>$posted_order_status));			
		}
		
		if(  $this->input->post('Delete')!='' )
		{	
		    $posted_order_status = $this->input->post('ord_status');		
			$this->set_as('wl_order','order_id',array('order_status'=>'Deleted'));			
		}	
		
		/* End order oprations  */
				
		$data['heading_title']  = 'Order Lists';
		$data['res']            = $res_array; 
		$data['total_transaction'] = $total_transaction;			
		$this->load->view('order/view_order_list',$data);		
	}
	
	
	
	public function make_paid($order_id)
	{
		
		$order_id = (int) $order_id;		
		$where = "order_id = '".$order_id."'"; 		
		$this->order_model->safe_update('wl_order',array('payment_status'=>'Paid'),$where,FALSE);	
		//$this->update_stocks($order_id);
		
	    $ordmaster = $this->order_model->get_order_master( $order_id );		
		$orddetail = $this->order_model->get_order_detail($order_id);	 
			
		/* Start  send mail */
			
		ob_start();	
		$mail_subject =$this->config->item('site_name')." Order overview";
		$from_email   = $this->admin_info->admin_email;
		$from_name    = $this->config->item('site_name');
		$mail_to      = $ordmaster['email'];									
		$body         = invoice_content($ordmaster,$orddetail);					
		$msg          = ob_get_contents();
		
		$mail_conf =  array(
		'subject'=>$this->config->item('site_name')." Order overview",
		'to_email'=>$mail_to,
		'from_email'=>$from_email,
		'from_name'=> $this->config->item('site_name'),
		'body_part'=>$msg);						
		$this->dmailer->mail_notify($mail_conf);		
		
		
		/* End  send mail */

		/***** Send Invoice mail to Admin */
		$mail_subject =$this->config->item('site_name')." Order overview";
		$from_email   = $this->admin_info->admin_email;
		$from_name    = $this->config->item('site_name');
		$mail_to      = $this->admin_info->admin_email;									
						
		
		
		$mail_conf =  array(
		'subject'=>$this->config->item('site_name')." Order overview",
		'to_email'=>$mail_to,
		'from_email'=>$from_email,
		'from_name'=> $this->config->item('site_name'),
		'body_part'=>$msg);							
		$this->dmailer->mail_notify($mail_conf);					
	
	  /******* End Invoice  mail */
		
		$this->session->set_userdata(array('msg_type'=>'success'));
		 $this->session->set_flashdata('success', $this->config->item('payment_success'));		
		 redirect('sitepanel/orders', '');
		
	}
	
	public function update_stocks($order_id)
	{
		$order_id = (int) $order_id;
				
		$condtion = array('field'=>"products_id,quantity",'condition'=>"orders_id ='$order_id'",'index'=>'products_id') ;
		$orders_res =  $this->order_model->findAll('wl_orders_products',$condtion);
		
		if( is_array($orders_res) && !empty($orders_res))
		{
			foreach($orders_res as $v)
			{				 
				 
				$sql = "UPDATE wl_product_attributes  SET used_quantity = used_quantity+$v[quantity] 
				WHERE product_id = '".$v['products_id']."' AND color_id=0 AND size_id=0  ";
				$this->db->query($sql);
				
			}
						
		}			 
			
	 }
		
	
    

	public function print_invoice()
	{
		$this->load->helper(array('cart/cart'));	
		$this->load->model(array('order/order_model'));
		$ordId              = (int) $this->uri->segment(4);
		$order_res          = $this->order_model->get_order_master( $ordId );
		$order_details_res  = $this->order_model->get_order_detail($order_res['order_id']);			
		$data['orddetail']  = $order_details_res;
		$data['ordmaster']  = $order_res;			
		$this->load->view('order/view_invoice_print',$data);		
		
	}

	public function send_mail()
	{
		$rid =  (int) $this->uri->segment(4);
		$this->db->select("billing_name,email,order_id",FALSE);
		$res_data =  $this->db->get_where('wl_order', array('order_id' =>$rid))->row();	
	    $this->load->library('email');
	   
		if( is_object( $res_data ) )
		{ 
			$data['ckeditor_message']  =  set_ck_config(array('textarea_id'=>'message','type'=>'specific'));
			$this->form_validation->set_rules('subject', 'Subject', 'required|xss_clean');	
			$this->form_validation->set_rules('message', 'Message', 'required|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
			{			
				/* Reply  mail to user */
				
						
				$mail_to      = $res_data->email;
				$mail_subject = $this->input->post('subject'); 				
				$from_email   = $this->admin_info->admin_email;
				$from_name    =  $this->config->item('site_name');				
				$body = "Dear ".$res_data->billing_name.",<br /><br />	";					
				$body .= $this->input->post('message');				
				$body .= "<br /> <br />						   
									Thanks and Regards,<br />						   
									".$this->config->item('site_name')." Team ";		
							
				$this->email->from($from_email,$from_name);
				$this->email->to($mail_to);			
				$this->email->subject($mail_subject);				
				$this->email->message($body);
				$this->email->set_mailtype('html');
				$this->email->send();

				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('admin_mail_msg'));
									
				redirect('sitepanel/orders/send_mail/'.$res_data->order_id, '');
				
				/* End reply mail to user */	

							
		}
		$data['heading_title'] = "Send Reply";
		$this->load->view('order/view_send_order_email',$data);
		
	}else
	{
		echo 'Invalid request';
		exit;
		
	}
	
	
 }	


	
}
// End of controller