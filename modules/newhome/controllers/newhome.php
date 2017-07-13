<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class newhome extends MX_Controller{
	
	public function __construct(){
		
		parent::__construct();
	}
	
	
	public function index(){
		
		
		$this->load->view('home_view_new');
		
		
	}
	
	
	public function first(){
		
		echo 'first Function';
		
		
	}
	
	
	
	
}




?>