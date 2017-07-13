<?php
class paintservice extends Private_Controller
{

	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file','get_health_motor_vals','custom_form'));	
		$this->load->model('paintservice_model');			
		
	}

	public function index()
	{	
	
		$user_id = $this->session->all_userdata();
		$this->load->view('paintservice/paintservice_view',$info);
		
	}
	
	public function add_paintservice_rates()
	{
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
			
		$motor_servicing_vendor_chk = $this->paintservice_model->Insert_paintservice_values_chk($this->input->post(),$user_id);
		
		if(!empty($_FILES['file1']['name'])){
				
				$config['upload_path'] = './assets/pestcontrol_doc'; 
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
			$motor_servicing_vendor = $this->paintservice_model->Insert_paintservice_values($this->input->post(),$user_id,$file_path['file1']);
		
			if($motor_servicing_vendor == 0){
				$info['status'] = array('success' => 'Data Added Successfully');
			}else{
				$info['status'] = array('success' => 'Error Adding Data');
			}
		}
		
		$this->load->view('pestcontrol/paintservice_view',$info);
		
	}
	
	
	public function update_vehicle_info(){
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		$motor_servicing_vendor =	$this->paintservice_model->update_paintservice_values($this->input->post(),$user_id);
		if($motor_servicing_vendor == 0){
				$info['status'] = array('success' => 'Data Updated Successfully');
			}else{
				$info['status'] = array('success' => 'Error Updating Data');
			}
				 
			$this->load->view('vendors/paintservice/edit_entries_view',$info);
			
	}
	
	
	
	public function add_vendor_exclude_in_session(){
		
		$_SESSION['motor_exclude_data'] = $_POST;
		
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
		
		$this->load->view('paintservice/paintservice_view', $info);
	
	}
	
	public function show_vendor_onetime_data(){
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		$exclude_cars = $this->paintservice_model->one_time_static_data($user_id);
		return $exclude_cars; 
	}
	
	public function chk_cars_year_exist_cc(){
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		$exclude_cars = $this->paintservice_model->chk_cars_year_exist($user_id);
		return $exclude_cars;
	}
	
	
	public function get_vehicle_models(){
		
		//header('Content-type: application/json'); 
		
		$v_name = $this->input->post('vehicle_name');
		
		$models = $this->paintservice_model->get_v_model($v_name);
		
	}
	
	
	
	public function get_vehicle_types_by_vendor(){
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		$types = $this->paintservice_model->get_v_types_by_vendor($user_id);
		
		return $types;
		
	}
	
	public function get_emirates_names(){
		
		$names = $this->paintservice_model->get_emirates();
		
		return $names;
		
	}
	
	public function edit_vendor_entries(){
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		//$info['vehicle'] = $this->motor_servicing_model->get_all_vehicle_info_by_vendor($user_id);
		
		$info['vendor_data'] = $this->db->query("SELECT pc.id,pc.type_of_service,pc.type_of_premises,pc.kind_of_premises,pc.approx_area,pcp.rate FROM tu_pest_control pc INNER JOIN tu_pest_control_premium pcp ON pc.id = pcp.id WHERE pc.vendor_id = '".$user_id."'")->result_array();
		
		$this->load->view('paintservice/edit_entries_view',$info);
		
	}
	
	
	public function submit_vehicle_type(){
		
		$user_data = $this->session->all_userdata();
		$user_id = $user_data['user_id'];
		$id = $_POST['id']; 
	
	
		$info['vendor_data'] = $this->db->query("SELECT pc.id,pc.type_of_service,pc.type_of_premises,pc.kind_of_premises,pc.approx_area,pcp.rate FROM tu_pest_control pc INNER JOIN tu_pest_control_premium pcp ON pc.id = pcp.id WHERE pc.vendor_id = '".$user_id."'")->result_array();
		
		
		$query = $this->db->query("SELECT pc.id,pc.type_of_service,pc.type_of_premises,pc.kind_of_premises,pc.approx_area,pcp.rate FROM tu_pest_control pc INNER JOIN tu_pest_control_premium pcp ON pc.id = pcp.id WHERE pc.vendor_id = '".$user_id."' and pc.id = '".$id."' ")->result_array();
		
		//echo '<pre>';	print_r($query);exit;
		
		foreach($query as $ff){
		
			$info['id'] = $id;
			$info['type_of_service'] = $ff['type_of_service'];
			$info['type_of_premises'] = $ff['type_of_premises'];
			$info['kind_of_premises'] = $ff['kind_of_premises'];
			$info['approx_area'] = $ff['approx_area'];
			$info['rate'] = $ff['rate'];
		}
	
		$this->load->view('pestcontrol/edit_entries_view',$info);
		
	}
	
}
