<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insurance extends CI_Controller {

 public function __construct(){


            parent::__construct();

			$this->load->model('Insurance_model');

		
	}
	
	
	public function  ins_motor(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('ins/ins_motor',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	public function  medical_ins(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('ins/medical_ins',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	}

	
