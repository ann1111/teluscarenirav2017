<?php
class motor extends Private_Controller
{

	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file','get_health_motor_vals'));	
		$this->load->model('motor_model');			
		
	}

	public function index()
	{	
	
		//print_r($_SESSION['exclude_data']);
		
		$info['year_exist'] = count($this->chk_cars_year_exist_cc());
		$info['data_exist'] = $this->chk_cars_year_exist_cc(); 
		/* print_r($info);
		exit; */ 
 		$info['vehicle'] = $this->motor_model->get_all_vehicle_info();
		$info['static_data'] = $this->show_vendor_onetime_data();
		
		$info['vehicle_types'] = $this->get_vehicle_types();
		$info['emirates_name'] = $this->get_emirates_names();
		
		//echo '<pre>'; print_r($this->get_vehicle_types()); exit;
		
		$user_id = $this->session->all_userdata();
		$this->load->view('motor/motor_view',$info);
		
	}

	public function post_plan(){
		
		/*  echo '<pre>';
		print_r($_POST);
		exit;  */
		
		
		$info['vehicle'] = $this->motor_model->get_all_vehicle_info();
		$info['static_data'] = $this->show_vendor_onetime_data();
		$info['year_exist'] = count($this->chk_cars_year_exist_cc());
		
		if($this->input->post() == ''){
			
			 redirect('vendors/motor','');
		}
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		
		if($this->input->post('sbt_btn')){

			//if($this->input->post('type_check') == 'comp'){
				
				/*  $chk_entry = $this->motor_model->Insert_comp_chk_entry($this->input->post(),$user_id);
				
				if($chk_entry > 0){
					echo  'Comprehensive Entry Already Exist please select different elements';	
				}else{  */
				
				$comp =	$this->motor_model->Insert_comp_values($this->input->post(),$user_id);
					
				//}
				
		//	}
			
			//if($this->input->post('type_check') == 'tpl'){
			
				//$chk_entry_tpl = $this->motor_model->Insert_tpl_chk_entry($this->input->post(),$user_id);
				
				/* if($chk_entry_tpl > 0){
					echo  'THIRD PARTY LIABILITY Entry Already Exist please select different elements';	
				}  */		
					$tpl =	$this->motor_model->Insert_tpl_values($this->input->post(),$user_id);
					
			//}
				
			$this->add_vendor_excludes_cars();	
			
			//$insert_vendor_plan = $this->vendor_plan_model->insert_vendor_plan_id($user_id,$country_id,$plan);
			$info['status'] = array('success' => 'Data Added Successfully');
			
			 redirect('vendors/motor','');
		}
			$this->load->view('motor/motor_view',$info);
			//redirect('vendors/motor','');
	}
	
	public function add_vendor_exclude_in_session(){
		
		$_SESSION['motor_exclude_data'][] = $_POST;
		
	}
	
	public function add_vendor_excludes_cars(){
		
		$info['vehicle'] = $this->motor_model->get_all_vehicle_info();
		$info['static_data'] = $this->show_vendor_onetime_data();
		$info['year_exist'] = count($this->chk_cars_year_exist_cc());
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		
		
		if(!empty($_FILES['file1']['name'])){
				
				$config['upload_path'] = './assets/motor_doc'; 
				$config['allowed_types'] = 'gif|jpg|png|jpeg|txt|pdf|doc';
               
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('file1'))
                {
                        $info['status'] = array('error1' => $this->upload->display_errors());
						
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						$file_path['file1'] = $config['upload_path'].'/'.$data['upload_data']['file_name'];
						$full_path = $this->upload->data();
						
				}
			
			}
		
		if(!empty($_FILES['file2']['name'])){
				
				$config['upload_path'] = './assets/motor_doc'; 
				$config['allowed_types'] = 'gif|jpg|png|jpeg|txt|pdf|doc';
               
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('file2'))
                {
                        $info['status'] = array('error2' => $this->upload->display_errors());
						
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						$file_path['file2'] = $config['upload_path'].'/'.$data['upload_data']['file_name'];
						$full_path = $this->upload->data();
						
				}
			
			}
			
		//if( !empty($data['status']['error1']) && !empty($data['status']['error2']) ){
		
			if($this->input->post('sbt_btn')){
					
				$exclude_cars = $this->motor_model->insert_excluded_cars_model($this->input->post(),$user_id,$file_path);
				
				if($exclude_cars == 1){
					$info['status'] = array('success' => 'Data Added Successfully');
				}
				
				$info['status'] = array('success' => 'Data Added Successfully');
				
				$this->load->view('motor/motor_view', $info);
				//redirect('vendors/motor',$info);
			}
		//}else{
			
			//$this->load->view('motor/motor_view', $info);
		//	redirect('vendors/motor',$info);
		//}
		
	}
	
	
	public function remove_vendor_excludes_cars(){
		
		unset($_SESSION['motor_exclude_data'][$_POST['exclude_remove']]);
	
	 	redirect('vendors/motor');
	}
	
	public function show_vendor_onetime_data(){
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		$exclude_cars = $this->motor_model->one_time_static_data($user_id);
		return $exclude_cars; 
	}
	
	public function chk_cars_year_exist_cc(){
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		$exclude_cars = $this->motor_model->chk_cars_year_exist($user_id);
		return $exclude_cars;
	}
	
	
	public function get_vehicle_models(){
		
		//header('Content-type: application/json'); 
		
		$v_name = $this->input->post('vehicle_name');
		
		$models = $this->motor_model->get_v_model($v_name);
		
	}
	
	public function get_vehicle_types(){
		
		$types = $this->motor_model->get_v_types();
		
		return $types;
		
	}
	
	public function get_emirates_names(){
		
		$names = $this->motor_model->get_emirates();
		
		return $names;
		
	}
	
	public function vendor_entries(){
		
		$this->load->view('motor/vendor_entries_view',$info);
		
	}
	
	public function vendor_entries_show(){
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		
		if($this->input->post('sbt_btn')){
			
			if($this->input->post('insurance_type')){
			
				if($this->input->post('insurance_type') == 'comp'){ $table = 'tu_comprehensive';  }
				if($this->input->post('insurance_type') == 'tpl'){ $table = 'tu_tpl'; $prem_val = 'premiumvalue'; }
				
				$ftable = $table;
			
			}
			
			$var = '';
			
			$sql = "SELECT * FROM ";
			$sql .= $ftable;
			
			if(	$this->input->post('vehicletype') != '' || $this->input->post('emirates') != '' || $this->input->post('gcc_status') != '' || $this->input->post('Driving_Licence') != '' || $this->input->post('driver_age') != '' || $this->input->post('noofcylinders') != '' || $this->input->post('agencytype') != ''  ){
				$sql .= " WHERE ";
				$sql .= '1=1';
				$sql .= " and vendor_id = '".$user_id."'";
				
			}else{
				
				$sql .= " WHERE vendor_id = '".$user_id."'";
			}
			
			if($this->input->post('vehicletype')){
				$vt = $this->input->post('vehicletype');
				$sql .= " and vehicle_type = ".$vt;
			}
			
			if($this->input->post('emirates')){
				$em = $this->input->post('emirates');
				$sql .= " and registration_emirates = '".$em."'";
			}
			
			if($this->input->post('gcc_status') != ''){
				$gcc = $this->input->post('gcc_status');
				$sql .= " and gcc = ".$gcc;
			}
			
			if($this->input->post('Driving_Licence')){
				$dl = $this->input->post('Driving_Licence');
				$sql .= " and d_licence = '".$dl."'";
			}
			
			if($this->input->post('driver_age')){
				$da = $this->input->post('driver_age');
				$sql .= " and driver_age = ".$da;
			}
			
			if($this->input->post('noofcylinders')){
				$cy = $this->input->post('noofcylinders');
				$sql .= " and noofcilender = '".$cy."'";
			}
			
			if($this->input->post('agencytype')){
				$at = $this->input->post('agencytype');
				$sql .= " and agency_type = '".$at."'";
			}
			
			$result = $this->db->query($sql);
			
			 //  print_r($this->input->post());	 echo $sql;	exit;  
			 
			$data['results'] = $result->result_array();
			
			/* echo '<pre>'; print_r($data); exit; */
			
		}
		
		$this->load->view('motor/vendor_entries_view',$data);
		
	}
	
	
	
	
	
	
}
