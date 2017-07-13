<?php
class Users extends Public_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file'));	 
		$this->load->model(array('users/users_model'));	
		$this->load->library(array('safe_encrypt','securimage_library','Auth','Dmailer','cart'));	
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		
		 $rf_session = $this->session->userdata('ref');
		 if( $rf_session=='' && $this->input->get('ref')!="")
		 {			 
		   $this->session->set_userdata( array('ref'=>$this->input->get('ref') ) );		   
		   
		 }
		$this->page_section_ct = 'register'; 
		
	}


	public function index()
	{	 
		if ( $this->auth->is_user_logged_in() )
		{
			redirect('members/', '');
		} 
		$this->login();
	}


	public function forgotten_password()
	{	
		
		if ( $this->input->post('forgotme')!="")
		{
			
			$email = $this->input->post('email',TRUE);
			
			$this->form_validation->set_rules('email', ' Email ID', 'required|valid_email');	
			$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code');
			
			if ($this->form_validation->run() == TRUE)
			{
				
				$condtion = array('field'=>"user_name,password,first_name,last_name",'condition'=>"user_name ='$email' AND status ='1' ");
				$res = $this->users_model->find('wl_customers',$condtion);
				
				if( is_array($res) && !empty($res))
				{
					
						$first_name  = $res['first_name'];
						$last_name   = $res['last_name'];	
						$username    = $res['user_name'];	
						$password    = $res['password'];
						$password = $this->safe_encrypt->decode($password);					
						/* Send  mail to user */
						
						$content    =  get_content('wl_auto_respond_mails','2');		
						$subject    =  $content->email_subject;						
						$body       =  $content->email_content;	
											
						$verify_url = "<a href=".base_url()."users/register>Click here </a>";				
												
						$name = $first_name." ".$last_name;
											
						$body			=	str_replace('{mem_name}',$name,$body);
						$body			=	str_replace('{username}',$username,$body);
						$body			=	str_replace('{password}',$password,$body);
						$body			=	str_replace('{admin_email}',$this->admin_info->admin_email,$body);
						$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
						$body			=	str_replace('{url}',base_url(),$body);
						$body			=	str_replace('{link}',$verify_url,$body);
						
						$mail_conf =  array(
						'subject'=>$subject,
						'to_email'=>$username,
						'from_email'=>$this->admin_info->admin_email,
						'from_name'=> $this->config->item('site_name'),
						'body_part'=>$body
						);	
							
					$this->dmailer->mail_notify($mail_conf);
					$this->session->set_userdata(array('msg_type'=>'success'));
					$this->session->set_flashdata('success',$this->config->item('forgot_password_success'));	
					redirect('users/forgotten_password', '');						
					
				}else				
				{					
					$this->session->set_userdata(array('msg_type'=>'error'));
			        $this->session->set_flashdata('error',$this->config->item('email_not_exist'));
			        redirect('users/forgotten_password', '');
					
				}
				
			}			
						 
		}
		
		$data['heading_title'] = "Forgot Password";			
		$this->load->view('users_forgot_password',$data);		
	}

	
	public function login()
	{
		$this->page_section_ct = 'login';
		
		if( $this->auth->is_user_logged_in() )
		{
		  redirect('members/myaccount','');
		}
		if ( $this->input->post('action') )
		{		
			$this->form_validation->set_rules('login_usertype', 'User Type','required');
			$this->form_validation->set_rules('login_username', 'Username','required|valid_email');
			$this->form_validation->set_rules('login_password', 'Password', 'required|');
			$login_type = $this->input->post('login_usertype');
			if($login_type==2)
			{
			  $this->form_validation->set_rules('login_user_no', 'User No','trim|required');
			}
			else
			{
			  $this->form_validation->set_rules('login_user_no', 'User No','trim');
			}
			
			if ($this->form_validation->run() == TRUE)
			{
				$username  =  $this->input->post('login_username');
				$password  =  $this->input->post('login_password');				
				$rember    =  ($this->input->post('remember')!="") ? TRUE : FALSE;
				
				$usertype = $this->input->post('login_usertype');	
				
				$this->auth->verify_user($username,$password);	
				
				if( $this->auth->is_user_logged_in() )
				{
					  if( $this->input->post('remember')=="Y" ) 
					  {
						 
						set_cookie('userType',$this->input->post('login_usertype'), time()+60*60*24*30 );										
						set_cookie('userName',$this->input->post('login_username'), time()+60*60*24*30 );
						set_cookie('pwd',$this->input->post('login_password'), time()+60*60*24*30 );
						if($login_type==2)
						{
						  set_cookie('user_no',$this->input->post('login_user_no'), time()+60*60*24*30 );
						}
					  }
					  else
					  {						 
						    delete_cookie('userType');
							delete_cookie('userName');
							delete_cookie('pwd');
							delete_cookie('user_no');
						   
					  }	
					  
					  $ref = $this->session->userdata('ref');
					  $this->session->unset_userdata(array('ref'=>0));
					 
					  if( $ref !=""  )
					  {	
					  					 
					    redirect($ref,'');	
											
					  }elseif($usertype==1)
					  {
						  
						 //redirect('members/myaccount',''); 
							echo 'member';
						    $this->session->set_userdata('userType', 1);							$this->session->set_userdata('usertype', 1);
					  }
					  else
					  {
						  echo 'vendors';
						  $this->session->set_userdata('userType', 2);						  $this->session->set_userdata('usertype', 2);
						//redirect('vendors/myaccount',''); 
					  }
								  
				}else
				{
					$this->session->set_userdata(array('msg_type'=>'error'));
			        $this->session->set_flashdata('error',$this->config->item('login_failed'));
					echo 'Invalid';
					//redirect('users/login', '');
				}
				
			}else
			{
				//$data['heading_title'] = "Login";			
				//$this->load->view('users_login',$data); 
			}				
		}else{
		  
			$data['heading_title'] = "Login";			
			$this->load->view('users_login',$data); 	
			
		}
	} 


	public function logout()
	{	
		$data2 = array(
		'shipping_id' =>0,
		'coupon_id'=>0,
		'discount_amount'=>0
		);
		$this->session->unset_userdata($data2);
		$this->session->unset_userdata(array("ref"=>'0','working_order_id'=>'0'));	
		$this->cart->destroy();
		$this->auth->logout();
		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',$this->config->item('member_logout'));
		//redirect('users/login', '');
		redirect('/', '');
	}	 

	public function thanks(){
		
		$data['heading_title'] = "Thanks";			
		$this->load->view('users_thanks',$data);	
	}
	
	
	public function comingsoonvendor(){
	
	$data['heading_title'] = "Coming Soon";			
	$this->load->view('users_comingsoon',$data);	
	
	}


	public function register()
	{		    
	   	if (!$this->auth->is_user_logged_in() )
		{			
			
			$email = $this->input->post('user_name');
			$this->db->select('*');
			$this->db->where('user_name', $email);
			$query = $this->db->get('wl_customers');

			if ($query->num_rows() > 0) {
				echo 'EMAIL EXITS';
				return false;
			}
	
	
		    $this->form_validation->set_rules('user_name', 'Email ID','trim|required|valid_email|max_length[80]|callback_email_check');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[20]|valid_password');
			$this->form_validation->set_rules('confirm_password', 'Retype password', 'required|matches[password]');		 
			
			
			//$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[10]|xss_clean');
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
			$this->form_validation->set_rules('terms', 'Terms & Conditions','trim|required|xss_clean');
		//	$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code[user]');			

			
			
			if ($this->form_validation->run() == TRUE)
			{
				
					$registerId  = $this->users_model->create_user();
					$first_name  = $this->input->post('first_name',TRUE);	
					$last_name   = $this->input->post('last_name',TRUE);	
					$username    = $this->input->post('user_name',TRUE);	
					$password    = $this->input->post('password',TRUE);
					
					if($registerId !='')
					{
						/* Send  mail to user */
						
						$content    =  get_content('wl_auto_respond_mails','1');		
						$subject    =  str_replace('{site_name}',$this->config->item('site_name'),$content->email_subject);						
						$body       =  $content->email_content;	
											
						$verify_url = "<a href=".base_url()."users/>Click here </a>";				
						
						$logo_url = get_mail_logo();	
						
						$name = $first_name." ".$last_name;
											
						$body			=	str_replace('{mem_name}',$name,$body);
						$body			=	str_replace('{username}',$username,$body);
						$body			=	str_replace('{password}',$password,$body);
						$body			=	str_replace('{admin_email}',$this->admin_info->admin_email,$body);
						$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
						$body			=	str_replace('{url}',base_url(),$body);
						$body			=	str_replace('{link}',$verify_url,$body);

						$body			=	str_replace('{logo}',$logo_url,$body);
						
						$mail_conf =  array(
						'subject'=>$subject,
						'to_email'=>$this->input->post('user_name'),
						'from_email'=>$this->admin_info->admin_email,
						'from_name'=> $this->config->item('site_name'),
						'body_part'=>$body
						);						
											
						$this->dmailer->mail_notify($mail_conf);
						
						/* End send  mail to user */	
						
					  	
					}
					
			     $this->auth->verify_user($username,$password);		
				 
				 $message = $this->config->item('register_thanks');			
			     $message = str_replace('<site_name>',$this->config->item('site_name'),$message);
			
				 $this->session->set_userdata(array('msg_type'=>'success'));
				 $this->session->set_flashdata('success',$message);
								  
			    if( $cart_items!="" &&  $cart_items > 0 )
				{
					
					 redirect('cart','');
					 
					
				}else
				{			
				   // redirect('members/myaccount','');
					 // redirect('/','');
					 echo 'OK';
				
				}
				
				
			}
	
			//$data['heading_title'] = "Register";		
			//$data['unq_section'] = "Register";				
			//$this->load->view('users_register',$data);	
		}else
		{
			redirect('members/', 'refresh');			
		}		
	}

	public function vendor_register()
	{		    
	   	if (!$this->auth->is_user_logged_in() )
		{			
	
			$email = $this->input->post('user_name');
			$this->db->select('*');
			$this->db->where('user_name', $email);
			$query = $this->db->get('wl_customers');

			if ($query->num_rows() > 0) {
				echo 'EMAIL EXITS';
				return false;
			}
			
			
		    $this->form_validation->set_rules('user_name', 'Email ID','trim|required|valid_email|max_length[80]|callback_email_check');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[20]|valid_password');
			$this->form_validation->set_rules('confirm_password', 'Retype password', 'required|matches[password]');		 
			
			
			//$this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[10]|xss_clean');
			$this->form_validation->set_rules('cat_id', 'Nature of Business','trim|required|xss_clean');
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
			$this->form_validation->set_rules('terms', 'Terms & Conditions','trim|required|xss_clean');
			//$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code[user]');			

			
			
			if ($this->form_validation->run() == TRUE)
			{
				
					$registerId  = $this->users_model->create_vendor();
					$company_name  = $this->input->post('company_name',TRUE);

					$first_name  = $this->input->post('first_name');	
						
					$username    = $this->input->post('user_name',TRUE);	
					$password    = $this->input->post('password',TRUE);
					
					if($registerId !='')
					{
						/* Send  mail to vendor */
						
						/*$content    =  get_content('wl_auto_respond_mails','17');		
						$subject    =  str_replace('{site_name}',$this->config->item('site_name'),$content->email_subject);						
						$body       =  $content->email_content;	
											
						$verify_url = "<a href=".base_url()."users/>Click here </a>";				
						
						
						
						$name = $first_name!='' ? $first_name : $company_name;
											
						$body			=	str_replace('{mem_name}',$name,$body);
						$body			=	str_replace('{username}',$username,$body);
						$body			=	str_replace('{password}',$password,$body);
						$body			=	str_replace('{admin_email}',$this->admin_info->admin_email,$body);
						$body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);
						$body			=	str_replace('{url}',base_url(),$body);
						$body			=	str_replace('{link}',$verify_url,$body);
						
						$mail_conf =  array(
						'subject'=>$subject,
						'to_email'=>$this->input->post('user_name'),
						'from_email'=>$this->admin_info->admin_email,
						'from_name'=> $this->config->item('site_name'),
						'body_part'=>$body
						);						
											
						$this->dmailer->mail_notify($mail_conf);*/
						
						/* End send  mail to vendor */	
						
					  	
					}
					
			     //$this->auth->verify_user($username,$password);		
				 
				 $message = "Thanks for the registration. You will receive your login credentials once approved by the admin.";			
			     
				 $this->session->set_flashdata('msg',$message);
								  
			   // redirect('users/thanks','');
			    //redirect('/','');
				 echo 'OK';
			}
	
			$data['heading_title'] = "Register";		
			$data['unq_section'] = "Register";				
			$this->load->view('vendor_register',$data);	
		}else
		{
			redirect('vendors/', 'refresh');			
		}		
	}	

	public function email_check()
	{
		$email = $this->input->post('user_name');
		if ($this->users_model->is_email_exits(array('user_name' => $email)))
		{
			$this->form_validation->set_message('email_check', $this->config->item('exists_user_id'));
			return FALSE;
		}else
		{
			return TRUE;
		}
	}


	public function valid_captcha_code($verification_code)
	{
		if ($this->securimage_library->check($verification_code) == true)
		{
			return TRUE;
		}else
		{			
			$this->form_validation->set_message('valid_captcha_code', 'The Word verification code you have entered is invalid.');			
			return FALSE;
		}
	}



	public function verify()
	{		 
		$this->users_model->activate_account($this->uri->segment(3) );		
	}	
}
/* End of file users.php */
/* Location: ./application/modules/users/controller/users.php */