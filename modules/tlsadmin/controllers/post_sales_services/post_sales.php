<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post_sales extends CI_Controller {

 public function __construct(){


            parent::__construct();

			$this->load->model('post_sales_services_model');

		
	}
	
	
	public function  post_reviews(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('post_sales_services/post_reviews',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  messages(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('post_sales_services/messages',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  notifications(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('post_sales_services/notifications',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	public function  refer_to_friend(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('post_sales_services/refer_to_friend',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	public function  prospect(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('post_sales_services/prospect',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	public function  offers(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('post_sales_services/offers',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  add_sell_offers(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('post_sales_services/add_sell_offers',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  add_sell_prospect(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('post_sales_services/add_sell_prospect',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	}

	
