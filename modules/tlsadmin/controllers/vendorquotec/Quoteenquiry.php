<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quoteenquiry extends CI_Controller {

 public function __construct(){


            parent::__construct();

			$this->load->model('vendor_quotation_c_model');

		
	}
	
	
	public function  quoteenquiry(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('vendorquotec/quoteenquiry',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	}

	
