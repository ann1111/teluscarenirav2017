<?php
class Pages extends Public_Controller
{

		public function __construct() {
		
		  parent::__construct(); 
		  $this->load->helper(array('file'));	 
		  $this->load->library(array('Dmailer'));	
		  $this->load->model(array('pages/pages_model'));
		  $this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		  $this->page_section_ct = 'cms';
		}
		public function infopages(){						$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];		  if (strpos($url,'about_us') !== false) {			  $this->load->view('static_pages/about_us');		  }					  if (strpos($url,'contact_us') !== false) {			  $this->load->view('static_pages/contact_us');		  } 		  if (strpos($url,'buying_guidelines') !== false) {			  $this->load->view('static_pages/buying_guidelines');		  }		  if (strpos($url,'faq_page') !== false) {			  $this->load->view('static_pages/faq_page');		  }		  if (strpos($url,'how_to_buy') !== false) {			  $this->load->view('static_pages/how_to_buy');		  }		  if (strpos($url,'how_to_sell') !== false) {			  $this->load->view('static_pages/how_to_sell');		  } 		  if (strpos($url,'legal_disclaimer') !== false) {			  $this->load->view('static_pages/legal_disclaimer');		  }		  if (strpos($url,'Privacy_policy') !== false) {			  $this->load->view('static_pages/Privacy_policy');		  } 		  if (strpos($url,'selling_guidelines') !== false) {			  $this->load->view('static_pages/selling_guidelines');		  }		  if (strpos($url,'team_condition') !== false) {			  $this->load->view('static_pages/team_condition');		  } 		   			}
		public function index()
		{
		  if(array_key_exists('entity_id',$this->meta_info) && $this->meta_info['entity_id'] > 0)
		  {
			$page_id = (int) $this->meta_info['entity_id'];	

			$condition       = array('page_id'=>$page_id,'status'=>'1');
		  }
		  else
		  {
			$friendly_url = $this->uri->rsegments[3];	

			$condition       = array('friendly_url'=>$friendly_url,'status'=>'1');
		  }			 
		  $content         =  $this->pages_model->get_cms_page( $condition );
		  if(is_array($content) && !empty($content))
		  {
			if($content['is_nested']=='Y')
			{
			  $offset = (int) $this->input->post('offset');

			  $record_per_page        = (int) $this->input->post('per_page');	
			  $config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');	

  
			  $vital_qry_cond  = "AND parent_id ='".$content['page_id']."' AND status ='1'";
				  
			  $vital_qry_opts = array(
										'condition'=>$vital_qry_cond,
										'order'=>'page_updated_date DESC',
										'debug'=>FALSE

									  );

			  $vital_pages = $this->pages_model->get_all_cms_page($offset,$config['per_page'],$vital_qry_opts);

			  $total_rows = $this->pages_model->total_rec_found;
		
			  $config['total_rows']	= $total_rows;

			  $base_url               =  "vital-information";

			  

			  $data['page_links']      = front_pagination($base_url,$config['total_rows'],$config['per_page'],$offset);

			  $data['vital_pages'] = $vital_pages;
			}
			$data['content'] = $content;			 
			$this->load->view('pages/cms_page_view',$data);
		  }
		  else
		  {
			
		  }	
			
		}

		public function classified()
		{
							 			 			 
			 $friendly_url = $this->uri->rsegments[2];	
			 		 
		     $condition       = array('friendly_url'=>$friendly_url,'status'=>'1');			 
			 $content         =  $this->pages_model->get_cms_page( $condition );				 $data['content'] = $content;			 
			 $this->load->view('pages/cms_classified_view',$data);	
			
		}

		public function terms_conditions()
		{
							 			 			 
			 $friendly_url = 'terms_conditions';	
			 		 
		     $condition       = array('friendly_url'=>$friendly_url,'status'=>'1');			 
			 $content         =  $this->pages_model->get_cms_page( $condition );				 $data['content'] = $content;			 
			 $this->load->view('pages/pop_terms_conditions',$data);	
			
		}

		public function avail_service_list()
		{
			 $data = '';			 
			 $this->load->view('pages/avail_service',$data);	
		}	

		public function track_order()
		{
		  $this->form_validation->set_rules('order_no','Order No','trim|required|max_length[30]');
		  if($this->form_validation->run()==TRUE)
		  {
			$order_no = $this->input->post('order_no');
			if( $this->session->userdata('user_id') > 0 )
			{
			   redirect('members/orders_history?order_no='.$order_no); 
			}
			else
			{
			   redirect('users/login?ref=members/orders_history?order_no='.$order_no); 
			}
		  }
		  $data['content'] = array();		
		  $this->load->view('pages/track_order',$data);	
		}		
		
		
		public function contactus()
		{			    
		 	$this->page_section_ct = 'contactus';		
			$this->form_validation->set_rules('first_name','First Name','trim|alpha|required|max_length[30]');
			$this->form_validation->set_rules('last_name','Last Name','trim|alpha|max_length[30]');			
			$this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[80]');
			$this->form_validation->set_rules('phone_number','Phone','trim|max_length[20]');
			$this->form_validation->set_rules('mobile_number','Mobile Number','trim|required|max_length[15]');			
			
			$this->form_validation->set_rules('message','Comments','trim|required|max_length[8500]');		
			$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code[contactus]');
			
			if($this->form_validation->run()==TRUE)
			{		
				$last_name = 	$this->input->post('last_name');
				$last_name = $last_name!='' ? $last_name : null;

				$phone_number = 	$this->input->post('phone_number');
				$phone_number = $phone_number!='' ? $phone_number : null;

				$mobile_number = 	$this->input->post('mobile_number');
				$mobile_number = $mobile_number!='' ? $mobile_number : null;
			  				
				$posted_data=array(				
				'first_name'    => $this->input->post('first_name'),
				'last_name'     => $last_name,
				'email'         => $this->input->post('email'),
				'subject'         => null,
				'phone_number'  => $phone_number,
				'mobile_number'  => $mobile_number,
				'country'		=> null,		
				'message'       => nl2br($this->input->post('message')),				
				'receive_date'     =>$this->config->item('config.date.time')
				);
				
				$this->pages_model->safe_insert('wl_enquiry',$posted_data,FALSE); 

				/* Send  mail to user */
						
				$content    =  get_content('wl_auto_respond_mails','5');		
				$subject    =  str_replace('{site_name}',$this->config->item('site_name'),$content->email_subject);						
				$body       =  $content->email_content;	
									
				$verify_url = "<a href=".base_url().">Click here </a>";	

				$logo_url = get_mail_logo();			
				
				
				
				$name = $this->input->post('first_name')." ".$this->input->post('last_name');
									
				$body			=	str_replace('{mem_name}',$name,$body);
				$body			=	str_replace('{email}',$this->input->post('email'),$body);
				$body			=	str_replace('{phone}',$this->input->post('phone_number'),$body);
				$body			=	str_replace('{mobile}',$this->input->post('mobile_number'),$body);
				$body			=	str_replace('{subject}',$this->input->post('subject'),$body);
				$body			=	str_replace('{comments}',nl2br($this->input->post('message')),$body);
				$body			=	str_replace('{admin_email}',$this->admin_info->admin_email,$body);
				$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
				$body			=	str_replace('{url}',base_url(),$body);
				$body			=	str_replace('{link}',$verify_url,$body);
				$body			=	str_replace('{logo}',$logo_url,$body);

				
				$mail_conf =  array(
				'subject'=>$subject,
				'to_email'=>$this->input->post('email'),
				'from_email'=>$this->admin_info->admin_email,
				'from_name'=> $this->config->item('site_name'),
				'body_part'=>$body
				);						
									
				$this->dmailer->mail_notify($mail_conf);
				
				/* End send  mail to user */

				/* Send  mail to admin */
						
				$body       =  $content->email_content;	
									
				$verify_url = "<a href=".base_url().">Click here </a>";				
				
				
				
				$name = 'Admin';
									
				$body			=	str_replace('{mem_name}',$name,$body);
				$body			=	str_replace('{email}',$this->input->post('email'),$body);
				$body			=	str_replace('{phone}',$this->input->post('phone_number'),$body);
				$body			=	str_replace('{mobile}',$this->input->post('mobile_number'),$body);
				$body			=	str_replace('{subject}',$this->input->post('subject'),$body);
				$body			=	str_replace('{comments}',$this->input->post('message'),$body);
				$body			=	str_replace('{admin_email}',$this->admin_info->admin_email,$body);
				$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
				$body			=	str_replace('{url}',base_url(),$body);
				$body			=	str_replace('{link}',$verify_url,$body);
				$body			=	str_replace('{logo}',$logo_url,$body);
				
				$mail_conf =  array(
				'subject'=>$subject,
				'to_email'=>$this->admin_info->admin_email,
				'from_email'=>$this->admin_info->admin_email,
				'from_name'=> $this->config->item('site_name'),
				'body_part'=>$body
				);						
									
				$this->dmailer->mail_notify($mail_conf);
				
				/* End send  mail to admin */


				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success', 'Your feedback has been submitted successfully.We will get back to you soon.'); 
				redirect('contactus', ''); 
				
			}
			 $friendly_url = $this->uri->segment(1);			
			 $condition       = array('friendly_url'=>$friendly_url,'status'=>'1');			 
			 $content         =  $this->pages_model->get_cms_page( $condition );
			 $data['content'] = $content['page_description'];				
			 $data['title'] = "Contact Us";
			 $this->load->view('contactus',$data);	
		
		}

		public function post_requirement()
		{	
			$this->load->model('location/location_model');
			if( $this->session->userdata('user_id') == 0 )
			{
				redirect("users/login?ref=pages/post_requirement"); 
				
			}		    
		 	$this->page_section_ct = 'contactus';
			$this->form_validation->set_rules('property_purpose','Purpose','trim|required|max_length[20]');		
			$this->form_validation->set_rules('name','Name','trim|alpha|required|max_length[80]');
			$this->form_validation->set_rules('property_type','Property Type','trim|required|max_length[30]');				
			$this->form_validation->set_rules('property_title','Property Title','trim|required|max_length[250]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[80]');
			$this->form_validation->set_rules('location','Location','trim|required|max_length[20]');
			$this->form_validation->set_rules('mobile_number','Mobile Number','trim|required|max_length[15]');			
			$this->form_validation->set_rules('bedroom','Bedroom','trim');
			$this->form_validation->set_rules('build_area','Build up Area','trim|required|is_natural|max_length[5]');
			$this->form_validation->set_rules('build_unit','Build up Area Unit','trim|required');
			$this->form_validation->set_rules('carpet_area','Carpet Area','trim|required|is_natural|max_length[5]');
			$this->form_validation->set_rules('carpet_unit','Carpet Area Unit','trim|required');
			$this->form_validation->set_rules('budget_range','Budget Range','trim');
			//$this->form_validation->set_rules('budget_max','Budget Maximum','trim');
			$this->form_validation->set_rules('comment','Comment','trim|required|max_length[1500]');
			$this->form_validation->set_rules('interested_loan','Home Load Interest','trim|required|max_length[350]');		
			$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code');
			
			if($this->form_validation->run()==TRUE)
			{	
				$budget_opts = $this->config->item('budget_opts');

				$budget_range =  $this->input->post('budget_range');

				if($budget_range!='' && array_key_exists($budget_range,$budget_opts))
				{
				  $budget_range_value = $budget_opts[$budget_range];

				  $budget_range_arr = explode("-",$budget_range);

				  $budget_min = $budget_range_arr[0];
				  $budget_max = $budget_range_arr[1];
				  
				}
				else
				{
				  $budget_range_value = null;
				  $budget_min = 0;
				  $budget_max = 0;
				}

					
			  				
				$posted_data=array(	
				'mem_id'    => $this->session->userdata('user_id'),			
				'name'    => $this->input->post('name'),
				'property_purpose'     => $this->input->post('property_purpose'),
				'email'         => $this->input->post('email'),
				'property_type'         => $this->input->post('property_type'),
				'property_title'         => $this->input->post('property_title'),
				'mobile_number'  => $this->input->post('mobile_number'),
				'location'  => $this->input->post('location'),
				'bedroom'		=> $this->input->post('bedroom')=='' ? null : $this->input->post('bedroom'),
				'build_area'		=> $this->input->post('build_area'),
				'build_unit'		=> $this->input->post('build_unit'),
				'carpet_area'		=> $this->input->post('carpet_area'),
				'carpet_unit'		=> $this->input->post('carpet_unit'),
				'budget_range'		=> $budget_range_value,
				'budget_min'		=> $budget_min,
				'budget_max'		=> $budget_max,
				'interested_loan'		=> $this->input->post('interested_loan')=='' ? null : $this->input->post('interested_loan'),		
				'comment'       => nl2br($this->input->post('comment')),				
				'receive_date'     =>$this->config->item('config.date.time')
				);
				
				$inserted_id = $this->pages_model->safe_insert('wl_post_requirement',$posted_data,FALSE); 

				/* Send  mail to user */
						
				$content    =  get_content('wl_auto_respond_mails','17');		
				$subject    =  str_replace('{site_name}',$this->config->item('site_name'),$content->email_subject);						
				$body       =  $content->email_content;	
									
				$verify_url = "<a href=".base_url().">Click here </a>";	

				$logo_url = get_mail_logo();			
				
				
				
				$name = $this->input->post('name');

				$build_area_unit_opts = $this->config->item('build_area_unit_opts');

				$build_unit =  $this->input->post('build_unit');

				$build_area_unit =  $this->input->post('build_area')." ".$build_area_unit_opts[$build_unit];

				$carpet_area_unit_opts = $this->config->item('carpet_area_unit_opts');

				$carpet_unit =  $this->input->post('carpet_unit');

				$carpet_area_unit =  $this->input->post('carpet_area')." ".$carpet_area_unit_opts[$carpet_unit];

				

				

				$property_type_opts = $this->config->item('property_type_opts');

				$property_type =  $this->input->post('property_type');

				if($property_type!='' && array_key_exists($property_type,$property_type_opts))
				{
				  $property_type = $property_type_opts[$property_type];
				}
				else
				{
				  $property_type = "";
				}

				$property_purpose_opts = $this->config->item('property_purpose_opts');

				$property_purpose =  $this->input->post('property_purpose');

				if($property_purpose!='' && array_key_exists($property_purpose,$property_purpose_opts))
				{
				  $property_purpose = $property_purpose_opts[$property_purpose];
				}
				else
				{
				  $property_purpose = "";
				}
									
				$body			=	str_replace('{mem_name}',$name,$body);
				$body			=	str_replace('{email}',$this->input->post('email'),$body);
				$body			=	str_replace('{location}',$this->input->post('location'),$body);
				$body			=	str_replace('{mobile}',$this->input->post('mobile_number'),$body);
				$body			=	str_replace('{property_purpose}',$property_purpose,$body);
				$body			=	str_replace('{property_type}',$property_type,$body);
				$body			=	str_replace('{property_title}',$this->input->post('property_title'),$body);
				$body			=	str_replace('{build_area}',$build_area_unit,$body);
				$body			=	str_replace('{carpet_area}',$carpet_area_unit,$body);
				$body			=	str_replace('{budget}',$budget_range_value,$body);
				$body			=	str_replace('{interested_loan}',$this->input->post('interested_loan'),$body);
				$body			=	str_replace('{comments}',nl2br($this->input->post('comment')),$body);
				$body			=	str_replace('{admin_email}',$this->admin_info->admin_email,$body);
				$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
				$body			=	str_replace('{url}',base_url(),$body);
				$body			=	str_replace('{link}',$verify_url,$body);
				$body			=	str_replace('{logo}',$logo_url,$body);
				
				$mail_conf =  array(
				'subject'=>$subject,
				'to_email'=>$this->input->post('email'),
				'from_email'=>$this->admin_info->admin_email,
				'from_name'=> $this->config->item('site_name'),
				'body_part'=>$body
				);						
									
				$this->dmailer->mail_notify($mail_conf);
				
				/* End send  mail to user */

				/* Send  mail to admin */
						
				$body       =  $content->email_content;	
									
				$verify_url = "<a href=".base_url().">Click here </a>";				
				
				
				
				$name = 'Admin';
									
				$body			=	str_replace('{mem_name}',$name,$body);
				$body			=	str_replace('{email}',$this->input->post('email'),$body);
				$body			=	str_replace('{location}',$this->input->post('location'),$body);
				$body			=	str_replace('{mobile}',$this->input->post('mobile_number'),$body);
				$body			=	str_replace('{property_purpose}',$property_purpose,$body);
				$body			=	str_replace('{property_type}',$property_type,$body);
				$body			=	str_replace('{property_title}',$this->input->post('property_title'),$body);
				$body			=	str_replace('{build_area}',$build_area_unit,$body);
				$body			=	str_replace('{carpet_area}',$carpet_area_unit,$body);
				$body			=	str_replace('{budget}',$budget_range_value,$body);
				$body			=	str_replace('{interested_loan}',$this->input->post('interested_loan'),$body);
				$body			=	str_replace('{comments}',nl2br($this->input->post('comment')),$body);
				$body			=	str_replace('{admin_email}',$this->admin_info->admin_email,$body);
				$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
				$body			=	str_replace('{url}',base_url(),$body);
				$body			=	str_replace('{link}',$verify_url,$body);
				$body			=	str_replace('{logo}',$logo_url,$body);
				
				$mail_conf =  array(
				'subject'=>$subject,
				'to_email'=>$this->admin_info->admin_email,
				'from_email'=>$this->admin_info->admin_email,
				'from_name'=> $this->config->item('site_name'),
				'body_part'=>$body
				);						
									
				$this->dmailer->mail_notify($mail_conf);
				
				/* End send  mail to admin */

				$this->load->model('run_cron/cron_model');

				$this->cron_model->requirement_matching_alerts($inserted_id);


				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success', 'Your requirement has been submitted successfully.We will get back to you soon.'); 
				redirect('pages/post_requirement', ''); 
				
			}
			 				
			 $data['title'] = "Post Your Requirement";
			 $this->load->view('post_your_requirement',$data);	
		
		}
		
		
		public function sitemap()
		{			
			$data['title'] = "Contact Us";
			$this->load->view('sitemap',$data);	
		}
				
	  

	public function newsletter()
	{	
		$data['default_email_text']= "Email Id";
		$this->form_validation->set_rules('subscriber_name','Name','trim|required|alpha|max_length[225]');
		$this->form_validation->set_rules('subscriber_email','Email','trim|required|valid_email|max_length[255]');
		$this->form_validation->set_rules('verification_code','Verification Code','trim|required|valid_captcha_code[newsletter]');
		if($this->form_validation->run()==TRUE)
		{
			$res = $this->pages_model->add_newsletter_member();
			$this->session->set_userdata('msg_type',$res['error_type']);
			$this->session->set_flashdata($res['error_type'],$res['error_msg']); 
			redirect('pages/newsletter', ''); 
		}
		$this->load->view('newsletter',$data);
	}

	public function newsletter_ajx()
	{	
		$data['default_email_text']= "Email Id";
		$this->form_validation->set_rules('subscriber_name','Name','trim|required|alpha|max_length[225]');
		$this->form_validation->set_rules('subscriber_email','Email','trim|required|valid_email|max_length[255]');
		$this->form_validation->set_rules('subscribe_me','Status','trim|required');
		$this->form_validation->set_rules('verification_code3','Verification Code','trim|required|valid_captcha_code[newsletter]');
		if($this->form_validation->run()==TRUE)
		{
			$res = $this->pages_model->add_newsletter_member();
		}
		else
		{
		  $res = array('error_type'=>'error','error_msg'=>form_error('verification_code3'));
		}
		echo json_encode($res);
		exit;
	}
	  
	  
	public function refer_to_friend()
	{		
	
	  		
		$productId        = (int) $this->uri->segment(3);
		
						
		$data['heading_title'] = "Refer to a Friend";			
		$this->form_validation->set_rules('your_name','Your Name','trim|required|alpha|xss_clean|max_length[100]');
		$this->form_validation->set_rules('your_email','Your email id','trim|required|valid_email|xss_clean|max_length[100]');
		$this->form_validation->set_rules('friend_name','Friend Name','trim|required|alpha|xss_clean|max_length[100]');
		$this->form_validation->set_rules('friend_email','Friend email id','trim|required|valid_email|xss_clean|max_length[100]');
		
		$this->form_validation->set_rules('verification_code','Verification Code','trim|required|valid_captcha_code[refer]');
	   
	   
		if($this->form_validation->run()==TRUE)
		{
			
			
				$your_name     = $this->input->post('your_name',TRUE);
				$your_email    =  $this->input->post('your_email',TRUE);
				$friend_name   = $this->input->post('friend_name',TRUE);
				$friend_email  = $this->input->post('friend_email',TRUE);
				
				$conditions   = "your_email ='$your_email' AND friend_email ='$friend_email' ";
				$count_result = $this->pages_model->findCount('wl_invite_friends',$conditions);
					
				if( !$count_result )
				{
					$posted_data =  array('your_name'=>$your_name,
					'your_email'=>$your_email,
					'friend_name'=>$friend_name,
					'friend_email'=>$friend_email,
					'receive_date'=>$this->config->item('config.date.time')
					);									
					$this->pages_model->safe_insert('wl_invite_friends',$posted_data); 	
				}
			
		   $content    =  get_content('wl_auto_respond_mails','3');	
		   $body       =  $content->email_content;	
			
			if($productId > 0 )
			{
				$res = $this->db->select('friendly_url')->get_where('wl_products',array('products_id'=>$productId))->row();
				if(is_object($res))
				{
				  $link_url = base_url().$res->product_friendly_url;
				  $red_url = 'pages/refer_to_friend/'.$productId;
				}
				else
				{
				  $link_url = base_url();
				  $red_url = 'pages/refer_to_friend/';
				}	
				$link_url= "<a href=".$link_url.">Click here </a>";
				$text ="Product";
				$this->session->set_userdata(array('msg_type'=>'success'));			
			    $this->session->set_flashdata('success',$this->config->item('product_referred_success'));
				
			}else
			{
				$red_url = 'pages/refer_to_friend/';
				$link_url = base_url();
				$link_url= "<a href=".$link_url.">Click here </a>";
				$text ="Site";	
				$this->session->set_userdata(array('msg_type'=>'success'));			
			    $this->session->set_flashdata('success',$this->config->item('site_referred_success'));
				
			}
			
			$logo_url = get_mail_logo();
			
			$body			=	str_replace('{friend_name}',$friend_name,$body);
			$body			=	str_replace('{your_name}',$your_name,$body);			
			$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);	
			$body			=	str_replace('{text}',$text,$body);				
			$body			=	str_replace('{site_link}',$link_url,$body);	
	
			$body			=	str_replace('{logo}',$logo_url,$body);
							
			$mail_conf =  array(
			'subject'=>"Invitation from ".$your_name." to see",
			'to_email'=>$friend_email,
			'from_email'=>$your_email,
			'from_name'=>$your_name,
			'body_part'=>$body
			);				
			$this->dmailer->mail_notify($mail_conf);			
			redirect($red_url, ''); 			
				
			
		}
		
		$this->load->view('pages/view_refer_to_friend',$data);
		
	}
	
	
	public function advertisement()
	{	
		$data['curr_section'] = 'advertise_with_us';	
		
		$data['heading_title'] = "Contact Us";	

		if($this->userId == 0)
		{
		  redirect('users?ref=pages/advertisement','');
		  exit;
		}

		$img_allow_size =  $this->config->item('allow.file.size');
		$img_allow_dim  =  $this->config->item('allow.imgage.dimension');

		$this->form_validation->set_rules('first_name','First Name','trim|required|alpha|max_length[80]');
		$this->form_validation->set_rules('last_name','Last Name','trim|max_length[80]');	
		$this->form_validation->set_rules('company_name','Company Name','trim|max_length[100]');
		$this->form_validation->set_rules('website_url','Website','trim|max_length[255]');
		$this->form_validation->set_rules('mobile_number','Mobile Number','trim|required|max_length[20]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[80]');
		$this->form_validation->set_rules('banner',' Banner Image',"file_allowed_type[image]|file_size_max[$img_allow_size]|check_dimension[$img_allow_dim]");
		$this->form_validation->set_rules('description',' Comments','trim|required|max_length[700]|xss_clean');
		$this->form_validation->set_rules('verification_code','Verification Code','trim|required|valid_captcha_code[advertise]');
		if($this->form_validation->run()==TRUE)
		{
			$banner_file = "";	
				
			if( !empty($_FILES) && $_FILES['banner']['name']!='' )
			{			  
				$this->load->library('upload');	
					
				$uploaded_data =  $this->upload->my_upload('banner','advertisement');
			
				if( is_array($uploaded_data)  && !empty($uploaded_data) )
				{ 								
					$banner_file = $uploaded_data['upload_data']['file_name'];
				
				}		
				
			}

			$data = array(
					   'banner' => $banner_file,
					  'mem_id'=>$this->userId,
					  'first_name' => $this->input->post('first_name')!='' ? $this->input->post('first_name'):null,
					  'last_name' => $this->input->post('last_name')!='' ? $this->input->post('last_name'):null,
					  'email' => $this->input->post('email')!='' ? $this->input->post('email'):null,
					  'company_name' => $this->input->post('company_name')!='' ? $this->input->post('company_name'):null,
					  'website_url' => $this->input->post('website_url')!='' ? $this->input->post('website_url'):null,
					  'mobile_number' => $this->input->post('mobile_number')!='' ? $this->input->post('mobile_number'):null,
					  'comment' =>$this->input->post('description')!='' ? $this->input->post('description'):null,
					  'inserted_on'=>$this->config->item('config.date.time'),
					  'status' =>'0'
					 );
			   
		  $banId =  $this->pages_model->safe_insert('wl_advertise',$data,FALSE);

		  $this->session->set_userdata('msg_type','success');
		  $this->session->set_flashdata('success','Thanks for posting your advertisement. We will revert to you soon.'); 
		  redirect('pages/advertisement', ''); 
			
		}
		$this->load->view('pages/advertisement',$data);
	}

	public function avail_service()
	{
	  $arr_service = array(
							'silver' => 'Silver',
							'gold' => 'Gold',
							'premium' => 'Premium Listing',
							'deluxe_premium' => 'Deluxe Premium Listing'
						  );

	  $arr_service_id = array(
							'silver' => '1',
							'gold' => '2',
							'premium' => '3',
							'deluxe_premium' => '4'
						  );

	  $arr_user_type = array(
							'individual' => 'Individual',
							'broker' => 'Broker',
							'dealer_builder' => 'Dealer/Builder'
						  );
	  
	  $service_type = $this->uri->segment(3);

	  $user_type = $this->uri->segment(4);

	  if($service_type == '' || $user_type == '')
	  {
		$this->session->set_userdata(array('msg_type'=>'warning'));
		$this->session->set_flashdata('warning',"Invalid Request");

		redirect("pages/buy_our_services"); 
	  }
	  else if(!array_key_exists($service_type,$arr_service) || !array_key_exists($user_type,$arr_user_type))
	  {
		$this->session->set_userdata(array('msg_type'=>'warning'));
		$this->session->set_flashdata('warning',"Invalid Request");

		redirect("pages/avail_service_list"); 
	  }

	  if($user_type == 'individual')
	  {
		$db_user_type = 1;
	  }
	  elseif($user_type == 'builder')
	  {
		$db_user_type = 3;
	  }
	  elseif($user_type == 'dealer_builder')
	  {
		$db_user_type = 0;
	  }



	  
	  if( $this->session->userdata('user_id') == 0 )
	  {
		  redirect("users/login?ref=pages/avail_service/".$service_type."/".$user_type); 
		  
	  }
	  elseif($db_user_type != $this->mres['user_subtype'] && $db_user_type > 0)
	  {
		$this->session->set_userdata(array('msg_type'=>'warning'));
		$this->session->set_flashdata('warning',"You cannot avail the requested service");
		redirect("pages/avail_service_list"); 
	  }

		
	  $this->page_section_ct = 'avail_service';

	  $this->form_validation->set_error_delimiters("<div class='required'>","</div>");
	  
	  $this->form_validation->set_rules('first_name','First Name','trim|alpha|required|max_length[30]');
	  $this->form_validation->set_rules('last_name','Last Name','trim|alpha|max_length[30]');			
	  $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[80]');
	  $this->form_validation->set_rules('phone_number','Phone','trim|max_length[20]');
	  $this->form_validation->set_rules('mobile_number','Mobile Number','trim|required|max_length[15]');			
	  $this->form_validation->set_rules('country','Country','trim');
	  $this->form_validation->set_rules('message','Message','trim|required|max_length[8500]');	
	  $this->form_validation->set_rules('payment_mode','Payment Mode','trim|required|max_length[25]');		
	  $this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code[contactus]');

	  $service_key = $service_type;

	  $service_type = $arr_service[$service_type];

	  $user_type = $arr_user_type[$user_type];

	  if($this->form_validation->run()==TRUE)
	  {	
		  
		  $membership_id = $arr_service_id[$service_key];		
					  
		  $posted_data=array(		
		  'poster_id'    => $this->session->userdata('user_id'),
		  'type'         => 2,
		  'membership_id'       => $membership_id,
		  'user_type'       => $user_type,
		  'service'      => $service_type,	
		  'first_name'    => $this->input->post('first_name'),
		  'last_name'     => $this->input->post('last_name'),
		  'email'         => $this->input->post('email'),
		  'subject'         => $this->input->post('subject'),
		  'phone_number'  => $this->input->post('phone_number'),
		  'mobile_number'  => $this->input->post('mobile_number'),
		  'country'		=> $this->input->post('country'),		
		  'message'       => nl2br($this->input->post('message')),
		  'payment_mode'  => $this->input->post('payment_mode'),				
		  'receive_date'     =>$this->config->item('config.date.time')
		  );
		  
		  $this->pages_model->safe_insert('wl_enquiry',$posted_data,FALSE);

		  $this->load->library(array('Dmailer'));	

		  /* Send  mail to user */
					  
		  $content    =  get_content('wl_auto_respond_mails','22');		
		  $subject    =  str_replace('{site_name}',$this->config->item('site_name'),$content->email_subject);						
		  $body       =  $content->email_content;	
							  
		  $verify_url = "<a href=".base_url().">Click here </a>";

		  $logo_url = get_mail_logo();				
		  
		  
		  
		  $name = $this->input->post('first_name')." ".$this->input->post('last_name');
							  
		  $body			=	str_replace('{mem_name}',$name,$body);
		  $body			=	str_replace('{email}',$this->input->post('email'),$body);
  
		  $body			=	str_replace('{user_type}',ucfirst($user_type),$body);
		  $body			=	str_replace('{service}',ucfirst($service_type),$body);
		  $body			=	str_replace('{mobile}',$this->input->post('mobile_number'),$body);

		  $body			=	str_replace('{payment_mode}',$this->input->post('payment_mode'),$body);

		  $body			=	str_replace('{phone}',$this->input->post('phone_number'),$body);

		  $body			=	str_replace('{country}',$this->input->post('country'),$body);
		  
		  $body			=	str_replace('{comments}',nl2br($this->input->post('message')),$body);
		  $body			=	str_replace('{admin_email}',$this->admin_info->admin_email,$body);
		  $body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
		  $body			=	str_replace('{url}',base_url(),$body);
		  $body			=	str_replace('{link}',$verify_url,$body);
		  $body			=	str_replace('{logo}',$logo_url,$body);
		  
		  $mail_conf =  array(
		  'subject'=>$subject,
		  'to_email'=>$this->input->post('email'),
		  'from_email'=>$this->admin_info->admin_email,
		  'from_name'=> $this->config->item('site_name'),
		  'body_part'=>$body
		  );						
							  
		  $this->dmailer->mail_notify($mail_conf);
		  
		  /* End send  mail to user */

		  

		  /* Send  mail to admin */
				  
		  $body       =  $content->email_content;	
							  
		  $verify_url = "<a href=".base_url().">Click here </a>";		
		  
		  
		  
		  $name = 'Admin';
							  
		  $body			=	str_replace('{mem_name}',$name,$body);
		  $body			=	str_replace('{email}',$this->input->post('email'),$body);
		  $body			=	str_replace('{user_type}',ucfirst($user_type),$body);
		  $body			=	str_replace('{service}',ucfirst($service_type),$body);
		  $body			=	str_replace('{mobile}',$this->input->post('mobile_number'),$body);

		  $body			=	str_replace('{phone}',$this->input->post('phone_number'),$body);

		  $body			=	str_replace('{country}',$this->input->post('country'),$body);
		  
		  $body			=	str_replace('{comments}',$this->input->post('message'),$body);

		  $body			=	str_replace('{payment_mode}',$this->input->post('payment_mode'),$body);

		  $body			=	str_replace('{admin_email}',$this->admin_info->admin_email,$body);
		  $body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
		  $body			=	str_replace('{url}',base_url(),$body);
		  $body			=	str_replace('{link}',$verify_url,$body);
		  $body			=	str_replace('{logo}',$logo_url,$body);
		  
		  $mail_conf =  array(
		  'subject'=>$subject,
		  'to_email'=>$this->admin_info->admin_email,
		  'from_email'=>$this->admin_info->admin_email,
		  'from_name'=> $this->config->item('site_name'),
		  'body_part'=>$body
		  );						
							  
		  $this->dmailer->mail_notify($mail_conf);
		  
		  /* End send  mail to admin */ 

		  
		  $this->session->set_userdata(array('msg_type'=>'success'));
		  $this->session->set_flashdata('success', 'Your inquiry has been submitted successfully.We will get back to you soon.'); 
		  redirect('pages/avail_service_list', ''); 
		  
	  }
	  $data['service_type'] = $service_type; 
	  $data['title'] = "Service Inquiry";
	  $this->load->view('pages/avail_service_inquiry',$data);	
		
	  
	}
		

}

/* End of file pages.php */