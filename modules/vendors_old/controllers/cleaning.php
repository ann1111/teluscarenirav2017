<?php
class cleaning extends Private_Controller
{

	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file'));	
		//$this->load->library('upload', $config);
		$this->load->model('vendor_cleaning_model');	
	}

	public function index()
	{	
		$user_id = $this->session->all_userdata();
		$this->load->view('cleaning/cleaning_view',array('error' => ' ') );
		
	}

	public function post_cleaning(){
		
		if($_POST == ''){
			
			 redirect('vendors/cleaning','');
		}
		
		
		$user_id = $this->session->userdata('user_id');
		$city = $this->input->post('emirate');
		$sub_city = $this->input->post('sub_city');
		if($_POST['file1']['name']){
			$file = './assets/cleaning_doc'.$_POST['file1']['name'];
		}else{
			$file = '';
		}
						
		if($_POST['villa']['type'] == 'on'){
		
			$premise_type = 1;
			
			$result = $this->vendor_cleaning_model->get_existing_data($user_id,$city,$sub_city,$premise_type);
				if(count($result) == 0){
					$insert_villa = $this->vendor_cleaning_model->insert_cleaning_plan($_POST['villa'],$user_id,$city,$sub_city,$file,$premise_type);
				}else{
					$data['status'] = array('error' => 'Villa Data For This City is already Exist');
				} 
		}
		
		if($_POST['office']['type'] == 'on'){
		
			$premise_type = 2;
			$result_v = $this->vendor_cleaning_model->get_existing_data($user_id,$city,$sub_city,$premise_type);
				if(count($result_v) == 0){
					$insert_office = $this->vendor_cleaning_model->insert_cleaning_plan($_POST['office'],$user_id,$city,$sub_city,$file,$premise_type);
				}else{
					$data['status'] = array('error' => 'Office Data For This City is already Exist');
				}
				
		}
		
		if($_POST['apart']['type'] == 'on'){
		
			$premise_type = 3;
			$result_a = $this->vendor_cleaning_model->get_existing_data($user_id,$city,$sub_city,$premise_type);
				if(count($result_a) == 0){
					$insert_apart = $this->vendor_cleaning_model->insert_cleaning_plan($_POST['apart'],$user_id,$city,$sub_city,$file,$premise_type);
				}else{
					$data['status'] = array('error' => 'Apartment Data For This City is already Exist');
				}
			
			
		}
		
		if($_POST['House']['type'] == 'on'){
		
			$premise_type = 4;
			$result_h = $this->vendor_cleaning_model->get_existing_data($user_id,$city,$sub_city,$premise_type);
				if(count($result_h) == 0){
					$insert_House = $this->vendor_cleaning_model->insert_cleaning_plan($_POST['apart'],$user_id,$city,$sub_city,$file,$premise_type);
				}else{
					$data['status'] = array('error' => 'House Data For This City is already Exist');
				}
			
			
		}
		
		$this->upload_doc();
		
		if($insert_House || $insert_apart || $insert_office || $insert_villa ){
					$data['status'] = array('success' => 'DATA ADDED SUCCESSFULLY');
				}else{
					$data['status'] = array('success' => '');
				}
				
			$this->load->view('cleaning/cleaning_view',$data);
			
			//redirect('vendors/cleaning','');
		
	}
	
	
	public function upload_doc(){
		
		if(!empty($_FILES['file1']['name'])){
				
				$config['upload_path'] = './assets/cleaning_doc'; 
				$config['allowed_types'] = 'gif|jpg|png|jpeg|txt|pdf|doc';
               
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				
				
                if ( ! $this->upload->do_upload('file1'))
                {
                        $error = array('error' => $this->upload->display_errors());
						$this->load->view('cleaning/cleaning_view',$error);
						
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
							
						$file_path = $config['upload_path'].'/'.$data['upload_data']['file_name'];
						$full_path = $this->upload->data();
						
				}
			
			}
		
	}
	
	public function get_sub_city(){
		
		$sub_city = $this->input->post('city_id');
		
		return $this->vendor_cleaning_model->get_city($sub_city);
		
	}
	
	
}
