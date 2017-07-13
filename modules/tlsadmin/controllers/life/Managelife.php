<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managelife extends CI_Controller {

 public function __construct(){


            parent::__construct();

			$this->load->model('Managelife_model');

		
	}
	
	
	public function  life_insurance(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('life/life_insurance',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  life_motor(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('life/life_motor',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  life_medical(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('life/life_medical',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  life_fail_management(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('life/life_fail_management',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  life_cleaning(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('life/life_cleaning',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  life_pest(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('life/life_pest',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  life_paint(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('life/life_paint',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	}

	
