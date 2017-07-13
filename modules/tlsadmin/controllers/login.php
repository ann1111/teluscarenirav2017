<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends Public_Controller {

	public function __construct()
       {
            parent::__construct();
			
			$this->load->model('login_model');
		    //$this->load->library('encrypt');
			
			$this->load->model(array('users/users_model'));	

		    $this->load->library(array('safe_encrypt','encrypt','securimage_library','Auth','Dmailer','cart'));
			
	   }
	   
	public function index()
	{
		if($this->session->userdata('username') == true){
			
			redirect('tlsadmin/login/dashboard');
			
			} 
			
		$this->load->view('tlsadmin/login/page-login');
	}
	

	
	public function dashboard()
	{
	     	if($this->session->userdata('username') == false){
			
			redirect('tlsadmin/login');
			
			} 
			
	        $this->load->view('tlsadmin/theme/header');
			//$this->load->view('theme/sidebar');
			$this->load->view('tlsadmin/dashboard');
			$this->load->view('tlsadmin/theme/footer');
	}

	
	public function check_credencial(){
	
		$username= $this->input->post('username');
		$password= $this->input->post('password');
		$usertype= $this->input->post('login_usertype');
		
		//print_r($this->input->post());exit;
		//$login=$this->login_model->check_credencial($username,$password);
		$login = $this->auth->verify_user($username,$password);
		//echo $login;exit;
		if($login)
		{
			$this->session->set_userdata('usertype',$usertype);
			$this->session->set_userdata('username',$username);
		//	$this->session->set_userdata('password',$password);
			redirect('tlsadmin/login/dashboard');
			
		}
		else
		{
			$this->session->set_userdata('valid_credencial','Enter Valid Username and Password');
			redirect('tlsadmin/login');
		}
			
	}
	
	public function logoutuser(){
	
	$this->session->sess_destroy();
	redirect('/');
	
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */