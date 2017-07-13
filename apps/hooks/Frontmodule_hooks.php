<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Frontmodule_hooks {

	private $ci;
	public $trackAdmin;	
	
	public function __construct() 
	{
		$this->ci =& get_instance();
	}
	
	//--------------------------------------------------------------------
	
	
	/**
	  check privilege to login user
	 */
	public function check_privileges() 
	{
		if (!class_exists('CI_Session'))
		{
			$this->ci->load->library('session');
		}

		/* Works only if working environment is front end */
		//$path_admin = FCPATH.'modules/'.$module.'/

		if(!in_array('sitepanel',$this->ci->uri->segments))
		{
		  $privacy_page_res = $this->ci->db->get_where('wl_menu_items')->result_array();
		  foreach($privacy_page_res as $val)
		  {
			  $privacy_page_arr[$val['sl']] = $val;
		  }
		  //trace($privacy_page_arr);
		  
		  $controller = $this->ci->router->fetch_class();
		  $method = $this->ci->router->fetch_method();
		
		  $prvg = TRUE;

		  switch($controller)
		  {
			  case 'home':
				switch($method)
				{
					case 'index':
					  if($privacy_page_arr[1]['status']!='1')
					  {
						$prvg = FALSE;
					  }	
					break;
				}
			  break;
			  case 'faq':
				switch($method)
				{
					case 'index':
					  if($privacy_page_arr[13]['status']!='1')
					  {
						$prvg = FALSE;
					  }	
					break;
				}
			  break;
			  case 'products':
				switch($method)
				{
					case 'index':
					  $segment_str  = $this->ci->uri->segment(3);
					  switch($segment_str)
					  {
						case 'most-viewed':
						  if($privacy_page_arr[29]['status']!='1')
						  {
							$prvg = FALSE;
						  }
						break;
						case 'best-seller':
						  if($privacy_page_arr[27]['status']!='1')
						  {
							$prvg = FALSE;
						  }
						break;
						case 'new-arrival':
						  if($privacy_page_arr[26]['status']!='1')
						  {
							$prvg = FALSE;
						  }
						break;
					  }	
					  break;
				}
			  break;
			  case 'pages':
				switch($method)
				{
					case 'track_order':
					  if($privacy_page_arr[32]['status']!='1')
					  {
						$prvg = FALSE;
					  }	
					break;
					case 'sitemap':
					  if($privacy_page_arr[16]['status']!='1')
					  {
						$prvg = FALSE;
					  }	
					break;
					case 'refer_to_friends':
					  if($privacy_page_arr[20]['status']!='1')
					  {
						$prvg = FALSE;
					  }	
					break;
					case 'newsletter':
					  if($privacy_page_arr[15]['status']!='1')
					  {
						$prvg = FALSE;
					  }	
					break;
				}
				$segment_str  = $this->ci->uri->segment(2);
				if($segment_str!='')
				{
				  switch($segment_str)
				  {
					  case 'return_refund':
						if($privacy_page_arr[31]['status']!='1')
						{
						  $prvg = FALSE;
						}	
					  break;
					  case 'aboutus':
						if($privacy_page_arr[12]['status']!='1')
						{
						  $prvg = FALSE;
						}	
					  break;
					  case 'contactus':
						if($privacy_page_arr[14]['status']!='1')
						{
						  $prvg = FALSE;
						}	
					  break;
					  case 'deliveries':
						if($privacy_page_arr[28]['status']!='1')
						{
						  $prvg = FALSE;
						}	
					  break;
					  case 'terms_conditions':
						if($privacy_page_arr[24]['status']!='1')
						{
						  $prvg = FALSE;
						}	
					  break;
				  }
				}
			  break;
			  case 'users':
				switch($method)
				{
					case 'register':
					  if($privacy_page_arr[17]['status']!='1')
					  {
						$prvg = FALSE;
					  }	
					break;
					case 'login':
					  if($privacy_page_arr[16]['status']!='1')
					  {
						$prvg = FALSE;
					  }	
					break;
					case 'logout':
					  if($privacy_page_arr[19]['status']!='1')
					  {
						$prvg = FALSE;
					  }	
					break;
				}
			  break;
			  case 'search':
				switch($method)
				{
					case 'advance_search':
					  if($privacy_page_arr[22]['status']!='1')
					  {
						$prvg = FALSE;
					  }	
					break;
				}
			  break;
			  case 'category':
				switch($method)
				{
					case 'index':
					  $parent_segment         = (int) $this->ci->uri->segment(3);
					  $parent_id              = ( $parent_segment > 0 ) ?  $parent_segment : '0';
					  if($parent_id==0)
					  {
						if($privacy_page_arr[11]['status']!='1')
						{
						  $prvg = FALSE;
						}
					  }	
					break;
				}
			  break;
			  case 'testimonials':
				if($privacy_page_arr[23]['status']!='1')
				{
				  $prvg = FALSE;
				}	
			  break;
			  case 'members':
				if($privacy_page_arr[18]['status']!='1')
				{
				  $prvg = FALSE;
				}	
			  break;
			  default:
				  switch($method)
				  {
					  case 'edit':
						if(!$this->ci->editPrvg)
						{
						  $prvg = FALSE;
						}	
					  break;
					  case 'delete':
						if(!$this->ci->deletePrvg)
						{
						  $prvg = FALSE;
						}	
					  break;
					  
				  }
			  break;

		  }

		  if(!$prvg)
		  {
			//$this->ci->session->set_userdata(array('msg_type'=>'error'));
			//$this->ci->session->set_flashdata('error',"Page requested not found");
			 $red_path = 'errors/a404';//$this->ci->session->userdata('previous_page');
			 redirect($red_path, '');
		  }
	   }
	}
}

// End Subadmin_hooks class