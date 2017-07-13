<?php
class Vendors extends Private_Controller
{

	private $mId;

	public function __construct()
	{
		parent::__construct();
		if($this->mres['user_type'] == 1)
		{
		  redirect('members','');
		} 		
		$this->load->model(array('vendors/vendor_model','comments/comments_model'));
		$this->load->library(array('safe_encrypt','Dmailer'));	
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
		
		$this->db->select('*');
		$query = $this->db->where(array('flag'=>'B','vendor_id'=>$this->userId));
		$query = $this->db->get('tu_save_book_health');
		$num_b = $query->num_rows();  

		$this->db->select('*');
		$query = $this->db->where(array('flag'=>'S','vendor_id'=>$this->userId));
		$query = $this->db->get('tu_save_book_health');
		$num = $query->num_rows();	
		
		
		$data['books'] = $num;
		$data['saves'] = $num_b;
		
		/* SUMIT CODE FOR BOOK AND SAVE END */
		
		$data['total_confirmed_inquiry'] = $total_confirmed_inquiry;
		$data['total_inquiry'] = $total_inquiry;
		$data['total_products'] = $total_products;
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
		
	   
   } 
	
	
	
}
/* End of file member.php */
/* Location: .application/modules/member/member.php */