<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orderhistory extends CI_Controller {

 public function __construct(){


            parent::__construct();

			$this->load->model('Order_history_model');

		
	}
	
	
	public function  vieworder(){
	
		$usrid = $this->session->userdata('user_id');
		
		$data['vieworders'] = $this->Order_history_model->getvieworders($usrid); 
	
		$this->load->view('theme/header',$data);
		$this->load->view('order/vieworder',$data);
		$this->load->view('theme/footer');

	
	}
	
	public function  completeorder(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('order/completeorder',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  pendingorder(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('order/pendingorder',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  changeorder(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('order/changeorder',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  cancelorder(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('order/cancelorder',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	public function  addedorder(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('order/addedorder',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	}

	
