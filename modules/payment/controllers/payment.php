<?php
class Payment extends Public_Controller
{
	
		public function __construct()
		{
		
		  parent::__construct();  			
		  $this->load->helper(array('payment/paypal','cart/cart','file'));
		  $this->load->model(array('order/order_model','payment/payment_model'));
		  $this->load->library(array('Dmailer'));	
		  $this->page_section_ct = 'other';	
		
		}
		
		public function index()
		{
		
			if( $this->input->post()!='' )
			{
			
				if($this->input->post('pay_method') == "paypal" )
				{
				    $working_order_id =  $this->session->userdata('working_order_id');
				    $order_res = $this->order_model->get_order_master($working_order_id);
				    paypalForm($order_res);
				
				}
				
							
			
			}  
		
		}

	  
	   	 
	 
	   public function order_success()
	   {	
	   	   
		  $ordId = $this->uri->segment(4);
		  $payment_method = $this->uri->segment(3);	

		   
		  $res_order = $this->db->query("SELECT * FROM wl_order WHERE MD5(order_id)='".$ordId."'")->row();
		  //print_r($res_order);
		  if (is_object($res_order))
		  {

			if($res_order->payment_status == 'Unpaid')
			{
	 
			  $data  = array('payment_method'=>$payment_method,'payment_status'=>'Paid');			 	 
			  $where = "order_id = '".$res_order->order_id."' ";
					 
			  $this->payment_model->safe_update('wl_order',$data,$where,FALSE);		
		 
			  $ordmaster = $this->order_model->get_order_master($res_order->order_id);
			  $orddetail = $this->order_model->get_order_detail($res_order->order_id);	 
					
			   if( is_array( $ordmaster )  && !empty( $ordmaster ) ) 
			   {
					 /***** Send Invoice mail */
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
				  
					/******* End Invoice  mail */	

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

				  } 
			  }
			  $this->session->unset_userdata(array('working_order_id' =>0));
			  $this->session->set_flashdata('msg', $this->config->item('payment_success'));		
			  redirect('payment/thanks/'.$ordId, '');
		  }
		  else
		  {
			$this->session->unset_userdata(array('working_order_id' =>0));
			$this->session->set_flashdata('msg', 'Invalid request');		
			redirect('payment/thanks/'.$ordId, '');
		  }
	 }
	 
	 
	public function order_cancel()
	{	 
	
	   $ordId = $this->uri->segment(4);
	   $payment_method = $this->uri->segment(3);		 
	   $data  = array('payment_method'=>$payment_method,'order_status'=>'Canceled');			 	 
	   $where = "MD5(order_id) = '$ordId' ";
	   $this->payment_model->safe_update('wl_order',$data,$where,FALSE);			 
	   $this->session->unset_userdata(array('working_order_id' =>0));
	   $this->session->set_flashdata('msg', $this->config->item('payment_failed'));		 
	   redirect('payment/thanks/'.$ordId, '');
	 
   }

   public function thanks()
   {	   	
	 
	  $this->load->view('payment/pay_thanks');
	  
	 
   }
   
   
   

}
/* End of file member.php */
/* Location: .application/modules/products/controllers/cart.php */
