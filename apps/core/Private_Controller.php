<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Private_Controller extends MY_Controller
{
	
	public $userId;
	public $userphoto;
	public $friend_count;
	public $country_res = array();
	public $my_friends = array();
	
	
	 public function __construct()
	 {
		 ob_start();
		 parent::__construct();	    
		 $this->load->library(array('Auth'));		 
         $this->auth->is_auth_user();
		// trace( $mres );
		
	 }	 
	 
}