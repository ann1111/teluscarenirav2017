<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class manage_hr extends CI_Controller {

 public function __construct(){


            parent::__construct();

			$this->load->model('managehr_model');

		
	}
	
	
	public function  attendance(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('managehr/attendance',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  addnewemployee(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('managehr/addnewemployee',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  emp_work_status(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('managehr/emp_work_status',$data);

			$this->load->view('theme/footer');

	}
	
	
	public function  emp_reward_prg(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('managehr/emp_reward_prg',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  status_of_app_req(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('managehr/status_of_app_req',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	
	
	}

	
