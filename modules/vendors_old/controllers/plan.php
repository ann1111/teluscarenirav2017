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
				//echo '<pre>'; print_r($_POST); exit;		
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
							foreach($_POST['userdata'] as $vendor_rate_data){										$start_age = $vendor_rate_data['agestart'];					$end_age = $vendor_rate_data['ageend'];					$age_string = $start_age.'-'.$end_age;					$relationship = $vendor_rate_data['relation'];					$gen_age_id = $this->generateRandomString().'_'.$relationship;					$prem_val = $vendor_rate_data['premium_val'];															$res_num_w = $this->vendor_plan_model->select_age_range_res($age_string,$relationship);										if(count($res_num_w) == 0){						$this->vendor_plan_model->insert_age_id($relationship,$age_string,$start_age,$end_age,$gen_age_id);												$this->vendor_plan_model->insert_vendor_premium($country_id,$user_id,$plan,$gen_age_id,$prem_val);												$last_I_Id = $this->db->insert_id();						$this->vendor_plan_model->insert_vendor_plan_info($last_I_Id); 						$insert_vendor_plan = $this->vendor_plan_model->insert_vendor_plan_id($user_id,$country_id,$plan,$file_path);					}else{												$data = array('success' => 'Already Exists');											}				}								/* INSERT VENDOR PLAN */
				
			
				if($insert_vendor_plan == 1){
					$data = array('success' => 'DATA ADDED SUCCESSFULLY');
				}else{
					$data = array('success' => '');
				}
				$this->load->view('plan/plan_view',$data);
		}
			//redirect('vendors/plan','');
	}
	
			function generateRandomString($length = 5) {				return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);			}
	
	
}
