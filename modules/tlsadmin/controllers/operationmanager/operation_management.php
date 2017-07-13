<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class operation_management extends CI_Controller {

 public function __construct(){


            parent::__construct();

			$this->load->model('operation_manager_model');

		
	}
	
	
	public function  emp_dpt_management(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('operationmanager/emp_dpt_management',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  emp_shedule_management(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('operationmanager/emp_shedule_management',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	}

	
