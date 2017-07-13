<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Familymanagement extends CI_Controller {

 public function __construct(){


            parent::__construct();

			$this->load->model('Familymanagement_model');

		
	}
	
	
	public function  cleaning(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('fam/cleaning',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	public function  service(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('fam/service',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	public function  pest(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('fam/pest',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	}

	
