<?php
class plan extends Private_Controller
{

	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file'));	
		//$this->load->library('upload', $config);
		$this->load->model('vendor_plan_model');	
	}

	public function index()
	{	
		$user_id = $this->session->all_userdata();
		$this->load->view('plan/plan_view',array('error' => ' ') );
		
	}

	public function post_plan(){
		
		if(empty($_POST)){
			
			 redirect('vendors/plan','');
		}
			
		$user_data = $this->session->all_userdata();
		
		$user_id = $user_data['user_id'];
		
		if($_POST['sbt_btn']){

			$country_id = $_POST['emirates'];
			$plan = $_POST['plan'];
			$upload_plan = $_POST['upload_health_doc'];
			
			if(!empty($_FILES['upload_health_doc']['name'])){
				
				/* echo dirname($_SERVER["SCRIPT_FILENAME"]).'/assets/motor_doc'; 
				die();
				 */
				$config['upload_path'] = './assets/health_doc'; 
				$config['allowed_types'] = 'gif|jpg|png|jpeg|txt|pdf|doc';
               
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				
				
                if ( ! $this->upload->do_upload('upload_health_doc'))
                {
                        $error = array('error' => $this->upload->display_errors());
						/* print_r($error);
						exit; */
						$this->load->view('plan/plan_view',$error);
                      
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
							
						$file_path = $config['upload_path'].'/'.$data['upload_data']['file_name'];
						$full_path = $this->upload->data();
						
				}
			
			}
			
				
			
				if($insert_vendor_plan == 1){
					$data = array('success' => 'DATA ADDED SUCCESSFULLY');
				}else{
					$data = array('success' => '');
				}
				$this->load->view('plan/plan_view',$data);
		}
			//redirect('vendors/plan','');
	}
	
			function generateRandomString($length = 5) {
	
	
}