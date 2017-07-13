<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment extends CI_Controller {

 public function __construct(){


            parent::__construct();

			$this->load->model('customer_model');

		
	}
	
	
	public function  pay_done(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('cust/pay_done',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  pay_cancel(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('cust/pay_cancel',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  wallet(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('cust/wallet',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  pay_refund(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('cust/pay_refund',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	public function  pay_add(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('cust/pay_add',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	}

	
