<?php
class myorders extends Private_Controller
{

	private $mId;

	public function __construct()
	{
		parent::__construct();
		if($this->mres['user_type'] == 1)
		{
		  redirect('members','');
		} 		
		$this->load->model(array('vendors/vendor_model','comments/comments_model'));		$this->load->helper(array('date','language','string','cookie','file','get_health_motor_vals','custom_form','download'));
		$this->load->library(array('safe_encrypt','Dmailer'));	
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		$this->page_section_ct = 'other';
	}

	public function index()
	{	
		$this->myorders();
	}

	public function myorders()
	{
		$this->page_section_ct = 'myaccount';

		$this->load->model(array('quotes/quote_model','products/product_model'));

		$this->load->helper(array('products/product'));	
		
		/* Total Inquiries */

		$condtion_inq = array(
								'fields'=>"count(quotation_id) as total_inquiry",
								'where'=>"a.vendor_id ='".$this->userId."' AND a.vendor_status='1' AND c.status='1'",
								'debug'=>FALSE
							  );

		$condtion_inq['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=a.posted_by");

		$inquiry_res               = $this->quote_model->get_quotes($condtion_inq);

		$total_inquiry = !empty($inquiry_res) ? $inquiry_res[0]['total_inquiry'] : 0;

		/* Total Confirmed Inquiries */

		$condtion_inq = array(
								'fields'=>"count(quotation_id) as total_inquiry",
								'where'=>"a.vendor_id ='".$this->userId."' AND a.vendor_status='1' AND a.quotation_mode='1' AND c.status ='1'",
								'debug'=>FALSE
							  );

		$condtion_inq['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=a.posted_by");

		$inquiry_res               = $this->quote_model->get_quotes($condtion_inq);

		$total_confirmed_inquiry = !empty($inquiry_res) ? $inquiry_res[0]['total_inquiry'] : 0;

		/* Total Products */

		$condtion_prod = array(
								'fields'=>"count(a.products_id) as total_products",
								'where'=>"a.user_status !='2' AND a.mem_id ='".$this->userId."'",
								'debug'=>FALSE
							  );

		$product_res               = $this->product_model->get_products($condtion_prod);

		$total_products = !empty($product_res) ? $product_res[0]['total_products'] : 0;

		/* Recent Inquiries */

		$condtion_inq = array(
								'fields'=>"SQL_CALC_FOUND_ROWS a.*,b.prod_title,b.prod_type,b.prod_for,b.short_description,b.friendly_url,b.status,b.user_status",
								'where'=>"a.vendor_id ='".$this->userId."' AND a.vendor_status='1' AND c.status ='1'",
								'offset'=>0,
								'limit'=>3,
								'debug'=>FALSE
							  );

		$condtion_inq['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=a.posted_by");

		$recent_inquiry               = $this->quote_model->get_quotes($condtion_inq);

		/* SUMIT CODE FOR BOOK AND SAVE START*/
				/* Health Insurance */		   
		$this->db->select('*');		$query = $this->db->where(array('flag'=>'B','vendor_id'=>$this->userId));		//$query = $this->db->group_by('added_date');		$query = $this->db->order_by("added_date", "desc");
		$query = $this->db->get('tu_save_book_health');		
		$result = $query->result_array();  		foreach($result as $health_i){			$new_array_health[$health_i['user_id']][] = array(					'id'  => $health_i['id'],					'Customer_name' => $health_i['Customer_name'],					'dob' => $health_i['dob'],					'gender' => $health_i['gender'],					'country_id' => $health_i['country_id'],					'plan_id' => $health_i['plan_id'],					'total_premium_val' => $health_i['total_premium_val'],					'doc1' => $health_i['doc1'],					'doc2' => $health_i['doc2'],					'doc3' => $health_i['doc3'],			);
		}		/* Health Insurance */		   		/* Motor Insurance */		   		$this->db->select('*');		$query = $this->db->where(array('flag'=>'B','vendor_id'=>$this->userId));		//$query = $this->db->group_by('added_date');		$query = $this->db->order_by("added_date", "desc");		$query = $this->db->get('tu_save_book_motor');				$result_motor = $query->result_array();  				foreach($result_motor as $motor_i){						$new_array_motor[$motor_i['user_id']][] = array(					'id'  => $motor_i['id'],					'service_type' => $motor_i['service_type'],					'vehicle_type' => $motor_i['vehicle_type'],					'driving_licence' => $motor_i['driving_licence'],					'driver_age' => $motor_i['driver_age'],					'r_emirate' => $motor_i['r_emirate'],					'gcc' => $motor_i['gcc'],					'agency_type' => $motor_i['agency_type'],					'current_year_value' => $motor_i['current_year_value'],					'PAB_driver' => $motor_i['PAB_driver'],					'RSA' => $motor_i['RSA'],					'PAB_passangers' => $motor_i['PAB_passangers'],					'ADD_rent_car' => $motor_i['ADD_rent_car'],					'doc1' => $motor_i['doc1'],					'doc2' => $motor_i['doc2'],					'doc3' => $motor_i['doc3'],			);		} 		   		/* Motor Insurance */				/* Cleaning Insurance */		   		$this->db->select('*');		$query = $this->db->where(array('flag'=>'B','vendor_id'=>$this->userId));		//$query = $this->db->group_by('added_date');		$query = $this->db->order_by("date_time", "desc");		$query = $this->db->get('tu_save_book_cleaning');				$result_cleaning = $query->result_array();  		foreach($result_cleaning as $cleaning_i){						$new_array_cleaning[$cleaning_i['user_id']][] = array(					'id'  => $cleaning_i['id'],					'emirate_id' => $cleaning_i['emirate_id'],					'material_provided' => $cleaning_i['material_provided'],					'noc' => $cleaning_i['noc'],					'noh' => $cleaning_i['noh'],					'frequency' => $cleaning_i['frequency'],					'premises' => $cleaning_i['premises'],					'doc1' => $cleaning_i['doc1'],					'doc2' => $cleaning_i['doc2'],					'doc3' => $cleaning_i['doc3'],				);		} 		   		   		/* Cleaning Insurance */				/* Motor Services */		   		$this->db->select('*');		$query = $this->db->where(array('flag'=>'B','vendor_id'=>$this->userId));		//$query = $this->db->group_by('added_date');		$query = $this->db->order_by("date_added", "desc");		$query = $this->db->get('tu_save_book_motorservicing');				$result_motorservicing = $query->result_array();  		foreach($result_motorservicing as $motorservicing_i){						$new_array_motorservicing[$motorservicing_i['user_id']][] = array(					'id'  => $motorservicing_i['id'],					'vehicle_type' => $motorservicing_i['vehicle_type'],					'make' => $motorservicing_i['make'],					'model' => $motorservicing_i['model'],					'level_of_services' => $motorservicing_i['level_of_services'],					'feature_of_services' => $motorservicing_i['feature_of_services'],					'doc1' => $motorservicing_i['doc1'],					'doc2' => $motorservicing_i['doc2'],					'doc3' => $motorservicing_i['doc3'],					'doc4' => $motorservicing_i['doc4'],					'doc5' => $motorservicing_i['doc5'],					'doc6' => $motorservicing_i['doc6'],					'doc7' => $motorservicing_i['doc7'],					'doc8' => $motorservicing_i['doc8'],				);		} 		   		   		/* Motor Services */				/* Pest Control Services */		   		$this->db->select('*');		$query = $this->db->where(array('flag'=>'B','vendor_id'=>$this->userId));		//$query = $this->db->group_by('added_date');		$query = $this->db->order_by("date_added", "desc");		$query = $this->db->get('tu_save_book_pestcontrol');				$result_pestcontrol = $query->result_array();  		foreach($result_pestcontrol as $pestcontrol_i){						$new_array_pestcontrol[$pestcontrol_i['user_id']][] = array(					'id'  => $pestcontrol_i['id'],					'type_of_service' => $pestcontrol_i['type_of_service'],					'type_of_premise' => $pestcontrol_i['type_of_premise'],					'kind_of_premises' => $pestcontrol_i['kind_of_premises'],					'approx_area' => $pestcontrol_i['approx_area'],					'booking_date' => $pestcontrol_i['booking_date'],					'doc1' => $pestcontrol_i['doc1'],					'doc2' => $pestcontrol_i['doc2'],									);		} 		   		   		/* Pest Control Services */				$data['health_books'] = $new_array_health;		$data['motor_books'] = $new_array_motor;		$data['cleaning_books'] = $new_array_cleaning;		$data['motorservicing_books'] = $new_array_motorservicing;		$data['pestcontrol_books'] = $new_array_pestcontrol;
		/* SUMIT CODE FOR BOOK AND SAVE END */
		
		$data['total_confirmed_inquiry'] = $total_confirmed_inquiry;
		$data['total_inquiry'] = $total_inquiry;
		$data['total_products'] = $total_products;
		$data['recent_inquiry'] = $recent_inquiry;
		$data['unq_section'] = "Myaccount";	
		$data['title'] = "My Account";
		$this->load->view('view_myorders',$data);
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
		//$this->form_validation->set_rules('cat_id', 'Nature of Business','trim|required|xss_clean');
		$this->form_validation->set_rules('vendor_type', 'Vendor Type','trim|required|xss_clean');
		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|max_length[132]|xss_clean');
		$this->form_validation->set_rules('first_name', 'Contact Name', 'trim|required|alpha|max_length[32]|xss_clean');
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
									   'vendor_type'        => $this->input->post('vendor_type'),
									   						
									   'title'            => ($this->input->post('title') !=''  ?  $this->input->post('title') : null),
										'first_name'       => ($this->input->post('first_name') !=''  ?  $this->input->post('first_name') : null),
										'last_name'        => ($this->input->post('last_name') !=''  ?  $this->input->post('last_name') : null),
										'birth_date'=>$birth_date,
										'company_name'        => $this->input->post('company_name',TRUE),
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
		  
		  $this->vendor_model->safe_update('wl_customers',$posted_user_data,$where,FALSE);				 
		  

		  $this->session->set_userdata(array('msg_type'=>'success'));
		  $this->session->set_flashdata('success',$this->config->item('myaccount_update'));						 
		  redirect('vendors/edit_account', '');

		}
	  }
	  $data['mres'] = $mres;		   
	  $this->load->view('view_member_edit_account',$data);	
	}
	
	public function my_profile()
	{	
	  $this->page_section_ct = 'myprofile';

	  $data['unq_section'] = "Myaccount";
	  $data['title'] = "My Account";

	  $img_allow_size =  $this->config->item('allow.file.size');
	  $img_allow_dim  =  $this->config->item('allow.imgage.dimension');

	  $mres = $this->mres;	
	  
	  if( !is_null($mres['mem_id']))
	  {
		
		$insert_flag = FALSE;
	  }
	  else
	  {
		$mres = array(
						'short_description'=>'',
						'usp'=>'',
						'why_us'=>'',
						'company_logo'=>''
					  );
		$insert_flag = TRUE;
	  }					


		if($this->input->post('edt_btn')!='')
		{
		  $why_us = $this->input->post('why_us');
		  $why_us = array_filter($why_us);
		  sort($why_us);
		  
		  $usp = $this->input->post('usp');
		  $usp = array_filter($usp);
		  sort($usp);
		  
		  $this->form_validation->set_rules('company_logo','Company Logo',"file_allowed_type[image]|file_size_max[$img_allow_size]|check_dimension[$img_allow_dim]");

		  $this->form_validation->set_rules('short_description', 'Short Description', 'trim|required|max_length[250]|xss_clean');

		  for($i=0;$i<=4;$i++)
		  {
			$this->form_validation->set_rules("usp[$i]", 'USP', "trim|".(empty($usp) ? ($i==0 ? 'required|' : '') : '')."max_length[100]|xss_clean");
		  }
		  for($i=0;$i<=9;$i++)
		  {
			$this->form_validation->set_rules("why_us[$i]", 'Why Us', "trim|".(empty($why_us) ? ($i==0 ? 'required|' : '') : '')."max_length[100]|xss_clean");
		  }
		 

		  if ($this->form_validation->run() == TRUE)
		  {
			$uploaded_file = $mres['company_logo'];				 
			$unlink_image = array('source_dir'=>"company_logos",'source_file'=>$uploaded_file);

			if($this->input->post('comp_logo_delete')==='Y' && $uploaded_file!='')
			 {					
				removeImage($unlink_image);						
				$uploaded_file = NULL;	
							
			 }				
			 if( !empty($_FILES) && $_FILES['company_logo']['name']!='' )
			 {			  
					$this->load->library('upload');	
						
					$uploaded_data =  $this->upload->my_upload('company_logo','company_logos');
				
					if( is_array($uploaded_data)  && !empty($uploaded_data) )
					{ 								
						$uploaded_file = $uploaded_data['upload_data']['file_name'];
						if($uploaded_file!='')
						{		
						  removeImage($unlink_image);
						}	
					}
					
			}

			$usp_str = !empty($usp) ? serialize($usp) : null;

			$why_us_str = !empty($why_us) ? serialize($why_us) : null;

			$posted_user_data =  array(
										 'company_logo' => $uploaded_file,
										 'short_description'       => ($this->input->post('short_description') !=''  ?  $this->input->post('short_description') : null),
										  'usp'        => $usp_str,
										  'why_us'	   => $why_us_str
										);	

			
			if($insert_flag === TRUE)
			{
			  $posted_user_data['mem_id'] = $this->session->userdata('user_id');
			  $this->vendor_model->safe_insert('wl_customer_profile',$posted_user_data,FALSE);
			}
			else
			{
			  $where       = "mem_id = '".$mres['mem_id']."'"; 
			  
			  $this->vendor_model->safe_update('wl_customer_profile',$posted_user_data,$where,FALSE);
			}				 
			

			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success','Your profile has been updated successfully');						 
			redirect('vendors/my_profile', '');

		  }
		}
		$data['mres'] = $mres;		   
		$this->load->view('view_member_edit_profile',$data);	
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
	
		  //$mres           =  $this->vendor_model->get_member_row($this->userId," AND password='$password_old' ");

		  if( $actual_pwd == $password_old )
		  {						
			$password = $this->safe_encrypt->encode($this->input->post('new_password',TRUE));				
			$data = array('password'=>$password);			
			$where = "customers_id=".$this->session->userdata('user_id')." ";
			$this->vendor_model->safe_update('wl_customers',$data,$where,FALSE);					
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success',$this->config->item('myaccount_password_changed'));	
		  }
		  else
		  {						
		   $this->session->set_userdata(array('msg_type'=>'warning'));
			$this->session->set_flashdata('warning',$this->config->item('myaccount_password_not_match'));
		  }
		  redirect('vendors/change_password','');

		}
		$this->load->view('view_member_change_password','');
	} 


	public function reviews()
	{
		$this->load->helper(array('products/product'));

		$this->page_section_ct = 'reviews';

		$record_per_page        = (int) $this->input->post('per_page');		
		
		$offset = (int) $this->input->post('offset');
		
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');		
		
		
		$base_url               = "vendors/reviews";

		$qry_options = array(
							  'limit'	  => $config['per_page'],
							  'offset'	  => $offset,
							  'condition' => " AND b.entity_id ='".$this->userId."' AND entity_type='customer' AND b.status='1' AND b.vendor_status='1'"

							);
									 						 	
	 	$review_res               =  $this->comments_model->get_comments($qry_options);
		
				
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
		  $this->load->view('vendors/load_reviews',$data);
		}
		else
		{
		  $this->load->view('vendors/view_reviews',$data);
		}
	}

	public function remove_review()
    {
	  $reviewId = (int) $this->uri->segment(3);

	  $qry_options = array(
							  'limit'	  => 1,
							  'offset'	  => 0,
							  'condition' => " AND entity_id ='".$this->userId."' AND b.review_id='".$reviewId."'"

							);
									 						 	
	 	$review_res               =  $this->comments_model->get_comments($qry_options);

	  if(is_array($review_res) && !empty($review_res))
	  {
		$review_res = $review_res[0];

		$review_data = array(
								'vendor_status'=>'2'
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
	  redirect('vendors/reviews',''); 
		
	   
   }   	public function send_policy(){		$customer_id = $this->input->post('c');	$order_id = $this->input->post('o');	$type = $this->input->post('t');		//echo'<pre>'; print_r($_POST); exit;		if($type == '1'){				$this->db->select('*');		$query = $this->db->where(array('id'=>$order_id,'user_id'=>$customer_id));		$query = $this->db->get('tu_save_book_health');				$info['health_result'] = $query->result_array();	}		if($type == '2'){				$this->db->select('*');		$query = $this->db->where(array('id'=>$order_id,'user_id'=>$customer_id));		$query = $this->db->get('tu_save_book_motor');				$info['motor_result'] = $query->result_array();	}		if($type == '3'){				$this->db->select('*');		$query = $this->db->where(array('id'=>$order_id,'user_id'=>$customer_id));		$query = $this->db->get('tu_save_book_cleaning');				$info['cleaning_result'] = $query->result_array();	}		if($type == '4'){				$this->db->select('*');		$query = $this->db->where(array('id'=>$order_id,'user_id'=>$customer_id));		$query = $this->db->get('tu_save_book_motorservicing');				$info['motorservicing_result'] = $query->result_array();	}	if($type == '5'){				$this->db->select('*');		$query = $this->db->where(array('id'=>$order_id,'user_id'=>$customer_id));		$query = $this->db->get('tu_save_book_pestcontrol');				$info['pestcontrol_result'] = $query->result_array();	}		$this->load->view('view_send_policy',$info);			}      	public function order_insert(){		$use_info = $this->session->all_userdata();		$vendor_id = $use_info['user_id'];		//echo'<pre>'; print_r($_POST);exit;		$user_id = $this->input->post('user_id');		$order_id = $this->input->post('o_id');		$type = $this->input->post('type');		$order_status = $this->input->post('order_status');		/* echo $type;exit; */								if($type == 1){			$this->db->select('*');			$query = $this->db->where(array('id'=>$order_id,'user_id'=>$user_id,'vendor_id'=>$vendor_id));			$query = $this->db->get('tu_save_book_health');			$query = $query->row_array();			$total = $query['total_premium_val'];		}				if($type == 2){			$this->db->select('*');			$query = $this->db->where(array('id'=>$order_id,'user_id'=>$user_id,'vendor_id'=>$vendor_id));			$query = $this->db->get('tu_save_book_motor');			$query = $query->row_array();			$total = $query['total'];		}				if($type == 3){			$this->db->select('*');			$query = $this->db->where(array('id'=>$order_id,'user_id'=>$user_id,'vendor_id'=>$vendor_id));			$query = $this->db->get('tu_save_book_cleaning');			$query = $query->row_array();			$total = $query['total'];		}				if($type == 4){			$this->db->select('*');			$query = $this->db->where(array('id'=>$order_id,'user_id'=>$user_id,'vendor_id'=>$vendor_id));			$query = $this->db->get('tu_save_book_motorservicing');			$query = $query->row_array();			$total = $query['total'];		}				if($type == 5){			$this->db->select('*');			$query = $this->db->where(array('id'=>$order_id,'user_id'=>$user_id,'vendor_id'=>$vendor_id));			$query = $this->db->get('tu_save_book_pestcontrol');			$query = $query->row_array();			$total = $query['total'];		}				if(!empty($_FILES['v_doc1']['name'])){								$config['upload_path'] = './assets/vendor_policies'; 				$config['allowed_types'] = 'gif|jpg|png|jpeg|txt|pdf|doc';               				$this->load->library('upload', $config);				$this->upload->initialize($config);								if ( ! $this->upload->do_upload('v_doc1'))                {                        $error['errors'] = array('error1' => $this->upload->display_errors());						                }                else                {                        $data = array('upload_data' => $this->upload->data());						if($data['upload_data']['file_name']){							$file_path1 = $config['upload_path'].'/'.$data['upload_data']['file_name'];						}else{							$file_path1 = '';						}						$full_path = $this->upload->data();										}						}											$chk_order = $this->db->query("SELECT * FROM tu_orders as o INNER JOIN tu_order_premium as op ON o.id=op.id WHERE o.vendor_order_id='".$order_id."' and o.type_of_service='".$type."' and op.vendor_id='".$vendor_id."' and op.user_id='".$user_id."' ")->result_array();		if(!count($chk_order)){					$this->db->insert('tu_orders',array('vendor_order_id'=> $order_id, 'type_of_service'=> $type, 'policy_status'=>$order_status,'order_status'=>$order_status ,'policy_doc'=>$file_path1));						$last_id = $this->db->insert_id();						$this->db->insert('tu_order_premium',array('id'=> $last_id, 'vendor_id'=> $vendor_id, 'user_id'=>$user_id, 'premium'=>$total));											}else{			if($file_path1 != ''){				$this->db->where(array('vendor_order_id'=> $order_id, 'type_of_service'=> $type));				$this->db->update('tu_orders',array('policy_status'=>$order_status,'order_status'=>$order_status,'policy_doc'=>$file_path1));			}else{				$this->db->where(array('vendor_order_id'=> $order_id, 'type_of_service'=> $type));				$this->db->update('tu_orders',array('policy_status'=>$order_status,'order_status'=>$order_status));			}					}				redirect('vendors/myorders','');		//$this->load->view('vendor/myorders/view_myorders',$info);			}      	public function download(){				if($this->input->post('doc1')!= ''){			$doc = $this->input->post('doc1');		}		if($this->input->post('doc2')!= ''){			$doc = $this->input->post('doc2');		}		if($this->input->post('doc3')!= ''){			$doc = $this->input->post('doc3');		}				$file_path = $doc;		$ext = pathinfo($file_path, PATHINFO_EXTENSION);		$file = basename($file_path, ".".$ext);		$data = file_get_contents($file_path);		$name = $file.'.'.$ext;				force_download($name, $data);									}
	
	
	
}
/* End of file member.php */
/* Location: .application/modules/member/member.php */