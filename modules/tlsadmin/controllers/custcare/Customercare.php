<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customercare extends CI_Controller {

 public function __construct(){


            parent::__construct();

			$this->load->model('customercare_model');

		
	}
	
	
	public function  complains(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('custcare/complains',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	public function  queries(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('custcare/queries',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	public function  suggestions(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('custcare/suggestions',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	}

	
