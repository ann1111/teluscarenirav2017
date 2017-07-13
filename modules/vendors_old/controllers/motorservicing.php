<?php
class motorservicing extends Private_Controller
{

	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file','get_health_motor_vals','custom_form'));	
		$this->load->model('motor_servicing_model');			
		
	}

	public function index()
	{	
	
		$info['vehicle'] = $this->motor_servicing_model	->get_all_vehicle_info();
		
		$info['vehicle_types'] = $this->get_vehicle_types();
		$info['emirates_name'] = $this->get_emirates_names();
		
		//echo '<pre>'; print_r($this->get_vehicle_types()); exit;
		
		$user_id = $this->session->all_userdata();
		$this->load->view('motorservicing/motor_servicing_view',$info);
		
	}
	
	public function add_motor_serv_rates()
	{
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
			
		$info['vehicle'] = $this->motor_servicing_model	->get_all_vehicle_info();
		$info['static_data'] = $this->show_vendor_onetime_data();
		
		$info['vehicle_types'] = $this->get_vehicle_types();
		$info['emirates_name'] = $this->get_emirates_names();
		
		$motor_servicing_vendor_chk = $this->motor_servicing_model->Insert_motor_serv_values_chk($this->input->post(),$user_id);
		
		if(!empty($_FILES['file1']['name'])){
				
				$config['upload_path'] = './assets/motorservicing_doc'; 
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
		
		if($motor_servicing_vendor_chk > 0){
				$info['status'] = array('success' => 'Duplicate Entry');
		}else{
			$motor_servicing_vendor =	$this->motor_servicing_model->Insert_motor_serv_values($this->input->post(),$user_id,$file_path['file1']);
		
			if($motor_servicing_vendor == 0){
				$info['status'] = array('success' => 'Data Added Successfully');
			}else{
				$info['status'] = array('success' => 'Error Adding Data');
			}
		}
		
		$this->load->view('motorservicing/motor_servicing_view',$info);
		
	}
	
	
	public function update_vehicle_info(){
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		$motor_servicing_vendor =	$this->motor_servicing_model->update_motor_serv_values($this->input->post(),$user_id);
		if($motor_servicing_vendor == 0){
				$info['status'] = array('success' => 'Data Updated Successfully');
			}else{
				$info['status'] = array('success' => 'Error Updating Data');
			}
			//redirect('motorservicing/edit_entries_view',$info);	 
			$this->load->view('vendors/motorservicing/edit_entries_view',$info);
			
	}
	
	public function add_vendor_docs(){
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		
		if(!empty($_FILES['file1']['name'])){
				
				$config['upload_path'] = './assets/motorservicing_doc'; 
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
		
		$this->load->view('motorservicing/motor_servicing_view', $info);
	
	}
	
	public function show_vendor_onetime_data(){
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		$exclude_cars = $this->motor_servicing_model->one_time_static_data($user_id);
		return $exclude_cars; 
	}
	
	public function chk_cars_year_exist_cc(){
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		$exclude_cars = $this->motor_servicing_model->chk_cars_year_exist($user_id);
		return $exclude_cars;
	}
	
	
	public function get_vehicle_models(){
		
		//header('Content-type: application/json'); 
		
		$v_name = $this->input->post('vehicle_name');
		
		$models = $this->motor_servicing_model->get_v_model($v_name);
		
	}
	
	
	
	
	public function get_vehicle_types(){
		
		$types = $this->motor_servicing_model->get_v_types();
		
		return $types;
		
	}
	public function get_vehicle_types_by_vendor(){
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		$types = $this->motor_servicing_model->get_v_types_by_vendor($user_id);
		
		return $types;
		
	}
	
	public function get_emirates_names(){
		
		$names = $this->motor_servicing_model->get_emirates();
		
		return $names;
		
	}
	
	public function edit_vendor_entries(){
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		//$info['vehicle'] = $this->motor_servicing_model->get_all_vehicle_info_by_vendor($user_id);
		
		$info['vendor_data'] = $this->db->query("SELECT ms.id,ms.vehicle_type,ms.maker,ms.model,ms.level_of_services,ms.feature_of_services,ms.add_ons,msp.rate FROM tu_motor_servicing ms INNER JOIN tu_motor_service_premium msp ON ms.id = msp.id WHERE ms.vendor_id = '".$user_id."'")->result_array();
		
		$info['vehicle_types'] = $this->get_vehicle_types_by_vendor($user_id);
		$info['emirates_name'] = $this->get_emirates_names();
		
		
		$this->load->view('motorservicing/edit_entries_view',$info);
		
	}
	
	
	public function submit_vehicle_type(){
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		$vehicletype = $this->input->post('vehicletype'); 
		$id = $_POST['id']; 
	
		$info['vendor_data'] = $this->db->query("SELECT ms.id,ms.vehicle_type,ms.maker,ms.model,ms.level_of_services,ms.feature_of_services,ms.add_ons,msp.rate FROM tu_motor_servicing ms INNER JOIN tu_motor_service_premium msp ON ms.id = msp.id WHERE ms.vendor_id = '".$user_id."'")->result_array();
		
		$info['vehicle_types'] = $this->get_vehicle_types_by_vendor($user_id);
		$info['vehicle'] = $this->motor_servicing_model->get_all_vehicle_info();
		
		$query = $this->db->query("SELECT ms.id,ms.vehicle_type,ms.maker,ms.model,ms.level_of_services,ms.feature_of_services,ms.add_ons,msp.rate FROM tu_motor_servicing ms INNER JOIN tu_motor_service_premium msp ON ms.id = msp.id WHERE ms.vendor_id = '".$user_id."' and ms.id = '".$id."' ")->result_array();
		
		
		foreach($query as $ff){
		
			$info['id'] = $id;
			$info['selected_v_type'] = $ff['vehicle_type'];
			$info['selected_maker'] = $ff['maker'];
			$info['selected_model'] = $ff['model'];
			$info['selected_level_of_services'] = $ff['level_of_services'];
			$info['selected_feature_of_services'] = $ff['feature_of_services'];
			$info['selected_rate'] = $ff['rate'];
			if($ff['add_ons'] != ''){ $info['selected_add_ons'] = $ff['add_ons']; }else{ $info['selected_add_ons'] = ''; }
		
		}
	
		$this->load->view('motorservicing/edit_entries_view',$info);
		
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
