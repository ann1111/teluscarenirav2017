<?php
class Members extends Private_Controller
{

	private $mId;

	public function __construct()
	{
		parent::__construct(); 	
		if($this->mres['user_type'] == 2)
		{
		  redirect('vendors','');
		}	
		$this->load->model(array('members/members_model','comments/comments_model'));
		$this->load->helper(array('products/product','get_health_motor_vals','download','custom_form'));		 
		$this->load->library(array('safe_encrypt','Dmailer','cart'));	
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		$this->page_section_ct = 'other';
	}

	public function index()
	{	
		$this->myaccount();
	}

	public function myaccount()
	{
		$this->page_section_ct = 'myaccount';
		$this->load->model(array('quotes/quote_model','quotes/admin_quote_model','products/product_model'));

		$this->load->helper(array('products/product'));	
		/* USER SAVE SERVICE COUNT */
		
		$get_user_id = $this->session->all_userdata();
		$user_id = $get_user_id['user_id'];
		
		
		$get_health_save_count = $this->db->query("select * from tu_save_book_health WHERE user_id = '".$user_id."' and flag = 'S'")->num_rows(); 
		
		$get_motor_save_count = $this->db->query("select * from tu_save_book_motor WHERE user_id = '".$user_id."' and flag = 'S'")->num_rows(); 
		
		$get_cleaning_save_count = $this->db->query("select * from tu_save_book_cleaning WHERE user_id = '".$user_id."' and flag = 'S'")->num_rows();
		
		$get_motorserciving_save_count = $this->db->query("select * from tu_save_book_motorservicing WHERE user_id = '".$user_id."' and flag = 'S'")->num_rows(); 
		
		$get_pestcontrol_save_count = $this->db->query("select * from tu_save_book_pestcontrol WHERE user_id = '".$user_id."' and flag = 'S'")->num_rows(); 
		
		$data['member_saves'] = $get_health_save_count + $get_motor_save_count + $get_cleaning_save_count + $get_motorserciving_save_count + $get_pestcontrol_save_count;
		
		/* SAVE Data Tables */
		
		$data['save_data_health'] = $this->db->query("select * from tu_save_book_health WHERE user_id = '".$user_id."' and flag = 'S'")->result_array(); 
		$data['save_data_motor_comp'] = $this->db->query("select * from tu_save_book_motor WHERE user_id = '".$user_id."' and flag = 'S' and service_type = 'comp'")->result_array(); 
		$data['save_data_motor_tpl'] = $this->db->query("select * from tu_save_book_motor WHERE user_id = '".$user_id."' and flag = 'S' and service_type = 'tpl'")->result_array(); 
		$data['save_data_cleaning'] = $this->db->query("select * from tu_save_book_cleaning WHERE user_id = '".$user_id."' and flag = 'S'")->result_array(); 
		$data['save_data_motor_services'] = $this->db->query("select * from tu_save_book_motorservicing WHERE user_id = '".$user_id."' and flag = 'S'")->result_array();
		$data['save_data_pestcontrol'] = $this->db->query("select * from tu_save_book_pestcontrol WHERE user_id = '".$user_id."' and flag = 'S'")->result_array();
		
		/* USER SAVE SERVICE COUNT END */
		
		/* USER BOOK SERVICE COUNT */
		
		$get_health_book_count = $this->db->query("select * from tu_save_book_health WHERE user_id = '".$user_id."' and flag = 'B'")->num_rows(); 
		
		$get_motor_book_count = $this->db->query("select * from tu_save_book_motor WHERE user_id = '".$user_id."' and flag = 'B'")->num_rows(); 
		
		$get_cleaning_book_count = $this->db->query("select * from tu_save_book_cleaning WHERE user_id = '".$user_id."' and flag = 'B'")->num_rows(); 
		
		$get_motorservicing_book_count = $this->db->query("select * from tu_save_book_motorservicing WHERE user_id = '".$user_id."' and flag = 'B'")->num_rows();
		
		$get_pestcontrol_book_count = $this->db->query("select * from tu_save_book_motorservicing WHERE user_id = '".$user_id."' and flag = 'B'")->num_rows(); 
		
		
		$data['member_booked'] = $get_health_book_count + $get_motor_book_count + $get_cleaning_book_count + $get_motorservicing_book_count + $get_pestcontrol_book_count;
		
		/* BOOK DATA TABLE */
		
		$data['book_data_health'] = $this->db->query("select * from tu_save_book_health WHERE user_id = '".$user_id."' and flag = 'B'")->result_array(); 
		$data['book_data_motor_comp'] = $this->db->query("select * from tu_save_book_motor WHERE user_id = '".$user_id."' and flag = 'B' and service_type = 'comp'")->result_array(); 
		$data['book_data_motor_tpl'] = $this->db->query("select * from tu_save_book_motor WHERE user_id = '".$user_id."' and flag = 'B' and service_type = 'tpl'")->result_array(); 
		$data['book_data_cleaning'] = $this->db->query("select * from tu_save_book_cleaning WHERE user_id = '".$user_id."' and flag = 'B'")->result_array();
		$data['book_data_motorservicing'] = $this->db->query("select * from tu_save_book_motorservicing WHERE user_id = '".$user_id."' and flag = 'B'")->result_array();
		$data['book_data_pestcontrol'] = $this->db->query("select * from tu_save_book_pestcontrol WHERE user_id = '".$user_id."' and flag = 'B'")->result_array();
		/* USER BOOK SERVICE COUNT END*/
		
		
		/* USER MY ORDERS */
		$data['user_orders'] = $this->db->query("select o.*,op.premium from tu_orders as o INNER JOIN tu_order_premium as op ON o.id = op.id WHERE op.user_id = '".$user_id."'")->result_array();
		/* USER MY ORDERS ENDS */
		
		
		/* Total Admin Tenders */

		$condtion_inq = array(
								'fields'=>"count(quotation_id) as total_inquiry",
								'where'=>"a.posted_by ='".$this->userId."' AND a.poster_status='1'",
								'debug'=>FALSE
							  );

		$inquiry_res               = $this->admin_quote_model->get_quotes($condtion_inq);

		$total_admin_tenders = $inquiry_res[0]['total_inquiry'];

		/* Total Confirmed Inquiries */

		$condtion_inq = array(
								'fields'=>"count(quotation_id) as total_inquiry",
								'where'=>"a.posted_by ='".$this->userId."' AND a.poster_status='1' AND a.quotation_mode='1' AND c.status ='1'",
								'debug'=>FALSE
							  );

		$condtion_inq['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=a.vendor_id");

		$inquiry_res               = $this->quote_model->get_quotes($condtion_inq);

		$total_confirmed_inquiry = $inquiry_res[0]['total_inquiry'];

		

		/* Recent Inquiries */

		$condtion_inq = array(
								'fields'=>"SQL_CALC_FOUND_ROWS a.*,b.prod_title,b.prod_type,b.prod_for,b.short_description,b.friendly_url,b.status,b.user_status",
								'where'=>"a.posted_by ='".$this->userId."' AND a.poster_status='1' AND c.status ='1'",
								'offset'=>0,
								'limit'=>3,
								'debug'=>FALSE
							  );

		$condtion_inq['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=a.vendor_id");

		$recent_inquiry               = $this->quote_model->get_quotes($condtion_inq);

		$data['total_confirmed_inquiry'] = $total_confirmed_inquiry;
		
		$data['total_admin_tenders'] = $total_admin_tenders;
		$data['recent_inquiry'] = $recent_inquiry;

		$data['unq_section'] = "Myaccount";	
		$data['title'] = "My Account";
		$this->load->view('view_member_myaccount',$data);
	}


	public function edit_account()
	{	
	  $this->page_section_ct = 'editaccount';

	  $data['unq_section'] = "Myaccount";
	  $data['title'] = "My Account";

	  $mres = $this->mres;	
	  
	  if($this->input->post('edt_btn')!='')
	  {
		//$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required|alpha|max_length[32]|xss_clean');
		//$this->form_validation->set_rules('last_name', 'Last Name', 'trim|alpha|max_length[32]|xss_clean');
		$this->form_validation->set_rules('phone_number', 'Landline Number','trim|max_length[20]|xss_clean');
		$this->form_validation->set_rules('fax_number', 'Fax Number','trim|max_length[20]|xss_clean');
		$this->form_validation->set_rules('mobile_number', 'Mobile Number','trim|required|max_length[25]|xss_clean');
		$this->form_validation->set_rules('country', 'Country','trim|required|max_length[60]|xss_clean');
		$this->form_validation->set_rules('state', 'State','trim|required|max_length[60]|xss_clean');
		$this->form_validation->set_rules('city', 'City','trim|required|max_length[60]|xss_clean');
		$this->form_validation->set_rules('zipcode', 'Zipcode','trim|required|max_length[7]|xss_clean');
		$this->form_validation->set_rules('address', 'Address','trim|required|max_length[180]|xss_clean');
		$this->form_validation->set_rules('birth_date', 'Date of Birth','trim|required|max_length[30]|xss_clean');
		if ($this->form_validation->run() == TRUE)
		{

		  $birth_date = 	($this->input->post('birth_date') !=''  ?  $this->input->post('birth_date') : null);

		  $posted_user_data =  array( 								
									   'title'            => ($this->input->post('title') !=''  ?  $this->input->post('title') : null),
										'first_name'       => $this->input->post('first_name',TRUE),
										'last_name'        => ($this->input->post('last_name') !=''  ?  $this->input->post('last_name') : null),
										'birth_date'=>$birth_date,
										'phone_number'		=> ($this->input->post('phone_number') !=''  ?  $this->input->post('phone_number') : null),
										'mobile_number'		=> ($this->input->post('mobile_number') !=''  ?  $this->input->post('mobile_number') : null),
										'fax_number'		=> ($this->input->post('fax_number') !=''  ?  $this->input->post('fax_number') : null),
										'country'		=> ($this->input->post('country') !=''  ?  $this->input->post('country') : null),
										'city'		=> ($this->input->post('city') !=''  ?  $this->input->post('city') : null),
										'state'		=> ($this->input->post('state') !=''  ?  $this->input->post('state') : null),
										'address'		=> ($this->input->post('address') !=''  ?  $this->input->post('address') : null),
										'zipcode'		=> ($this->input->post('zipcode') !=''  ?  $this->input->post('zipcode') : null)
									  );	

		  

		  $where       = "customers_id = '".$mres['customers_id']."'"; 
		  
		  $this->members_model->safe_update('wl_customers',$posted_user_data,$where,FALSE);				 
		  

		  $this->session->set_userdata(array('msg_type'=>'success'));
		  $this->session->set_flashdata('success',$this->config->item('myaccount_update'));						 
		  redirect('members/edit_account', '');

		}
	  }
	  $data['mres'] = $mres;		   
	  $this->load->view('view_member_edit_account',$data);	

	  
	}
	
	
	
	

	public function change_password()
	{
		$this->page_section_ct = 'editaccount';

		$this->form_validation->set_rules('old_password', 'Current Password', 'trim|required');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|valid_password');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[new_password]');


		if ($this->form_validation->run() == TRUE)
		{
		  
		  $password_old   =  $this->safe_encrypt->encode($this->input->post('old_password',TRUE));

		  $actual_pwd = $this->mres['password'];
	
		  //$mres           =  $this->members_model->get_member_row($this->userId," AND password='$password_old' ");

		  if( $actual_pwd == $password_old )
		  {						
			$password = $this->safe_encrypt->encode($this->input->post('new_password',TRUE));				
			$data = array('password'=>$password);			
			$where = "customers_id=".$this->session->userdata('user_id')." ";
			$this->members_model->safe_update('wl_customers',$data,$where,FALSE);					
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success',$this->config->item('myaccount_password_changed'));	
		  }
		  else
		  {						
		   $this->session->set_userdata(array('msg_type'=>'warning'));
			$this->session->set_flashdata('warning',$this->config->item('myaccount_password_not_match'));
		  }
		  redirect('members/change_password','');

		}
		$this->load->view('view_member_change_password','');
	}

	public function reviews()
	{
		$this->page_section_ct = 'reviews';

		$record_per_page        = (int) $this->input->post('per_page');		
		
		$offset = (int) $this->input->post('offset');
		
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');		
		
		
		$base_url               = "members/reviews";

		$qry_options = array(
							  'limit'	  => $config['per_page'],
							  'offset'	  => $offset,
							  'condition' => " AND b.customer_id ='".$this->userId."' AND entity_type='customer' AND b.status='1' AND b.poster_status='1'"

							);
									 						 	
	 	$review_res               =  $this->comments_model->get_entity_comments($qry_options);
		
				
		$total_rows = get_found_rows();

		$config['total_rows']	= $total_rows;	
  
		$data['total_records'] = $config['total_rows'];

		$data['base_url'] = $base_url;
		
		
	    //$data['page_links']      = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$offset);			
	    $data['title'] = "Manage Quotes";

		$data['res'] = $review_res; 
	
		$data['offset'] = $offset; 	

		$ajx_req = $this->input->is_ajax_request();
			  
		if($ajx_req===TRUE)
		{	
		  $this->load->view('members/load_reviews',$data);
		}
		else
		{
		  $this->load->view('members/view_reviews',$data);
		}
	}

	public function remove_review()
    {
	  $reviewId = (int) $this->uri->segment(3);

	  $qry_options = array(
							  'limit'	  => 1,
							  'offset'	  => 0,
							  'condition' => " AND customer_id ='".$this->userId."' AND b.review_id='".$reviewId."'"

							);
									 						 	
	 	$review_res               =  $this->comments_model->get_comments($qry_options);

	  if(is_array($review_res) && !empty($review_res))
	  {
		$review_res = $review_res[0];

		$review_data = array(
								'poster_status'=>'2'
							  );
	
		$where = "review_id = '".$review_res['review_id']."'";

		$this->vendor_model->safe_update('wl_review', $review_data,$where ,FALSE );

		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',"Review has been deleted successfully");
	  }
	  else
	  {
		$this->session->set_userdata(array('msg_type'=>'error'));
		$this->session->set_flashdata('error',"Invalid record");
	  }
	  redirect('members/reviews',''); 
		
	   
   } 
   
   public function member_save(){
		$user_id = $this->session->userdata('user_id');
		
		$data['save_data_health'] = $this->db->query("select * from tu_save_book_health WHERE user_id = '".$user_id."' and flag = 'S'")->result_array(); 
		
		$data['save_data_motor_comp'] = $this->db->query("select * from tu_save_book_motor WHERE user_id = '".$user_id."' and flag = 'S' and service_type = 'comp'")->result_array(); 
		$data['save_data_motor_tpl'] = $this->db->query("select * from tu_save_book_motor WHERE user_id = '".$user_id."' and flag = 'S' and service_type = 'tpl'")->result_array(); 
		
		$this->load->view('member_services/member_save_view',$data);
	  
   }
   
   public function member_book(){
	   
		$user_id = $this->session->userdata('user_id');
		
		$data['book_data_health'] = $this->db->query("select * from tu_save_book_health WHERE user_id = '".$user_id."' and flag = 'B'")->result_array(); 
		
		$data['book_data_motor_comp'] = $this->db->query("select * from tu_save_book_motor WHERE user_id = '".$user_id."' and flag = 'B' and service_type = 'comp'")->result_array(); 
		$data['book_data_motor_tpl'] = $this->db->query("select * from tu_save_book_motor WHERE user_id = '".$user_id."' and flag = 'B' and service_type = 'tpl'")->result_array(); 
		
		$this->load->view('member_services/member_book_view',$data);
	  
   }
   
   public function download(){
		
		if($this->input->post('doc1')!= ''){
			$doc = $this->input->post('doc1');
		}
		if($this->input->post('doc2')!= ''){
			$doc = $this->input->post('doc2');
		}
		if($this->input->post('doc3')!= ''){
			$doc = $this->input->post('doc3');
		}
		
		$file_path = $doc;
		$ext = pathinfo($file_path, PATHINFO_EXTENSION);
		$file = basename($file_path, ".".$ext);

		$data = file_get_contents($file_path);
		$name = $file.'.'.$ext;
		
		force_download($name, $data);
		
		
		
		
	}
   
}
/* End of file member.php */
/* Location: .application/modules/member/member.php */