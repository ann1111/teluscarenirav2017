<?php  

class motorservicing extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file','download','get_health_motor_vals','custom_form'));	
		$this->load->library(array('safe_encrypt','securimage_library','Auth','Dmailer','cart'));
		$this->load->model('motorservicing_model');
	}
	
	
	public function index(){
		$data = array();
		
		// GET COUNTRIES 
		redirect('/','');
		$data['vehicle']  = $this->get_all_vehicle_info();
		$data['countries'] = $this->motorservicing_model->get_countries();
		
		$this->load->view('motorservicing_view',$data);
	}
	
	public function concatequery($data){
		
		//echo '<pre>'; print_r($this->input->post()); exit;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){}else{redirect('/motorservicing', '');}
		if(!$this->input->post()){
			redirect('/motorservicing', '');
		}
		
			$table = 'tu_motor_servicing';
			$ftable = $table;
			
			$sql = "SELECT * FROM ";
			$sql .= $ftable;
		
			if(	!empty($data['vehicletype']) || !empty($data['vehicle_makers']) || !empty($data['vehicle_models']) || !empty($data['services_level']) ){
				$sql .= " WHERE ";
				$sql .= '1=1';
				
			}
			
			 if($data['vehicletype']){
				$vt = $this->input->post('vehicletype');
				$sql .= " and vehicle_type = ".$vt;
			}
			
			if($data['vehicle_makers']){
				$em = $this->input->post('vehicle_makers');
				$sql .= " and maker = '".$em."'";
			} 
			
			if($data['vehicle_models']){
				$sql .= $this->motorservicing_model->check_vehicle_avail_customer($data);
			} 
			
			if($data['services_level']){
				$services_level = $this->input->post('services_level');
				$sql .= " and level_of_services = '".$services_level."'";
			} 
			
			if($data['v_id'] != ''){
				$vendor_id = $this->input->post('v_id');
				$sql .= " and vendor_id = '".$vendor_id."'";
			}
			
			return $sql;
		
	}
	
	public function motorservicing_result(){
	
			//echo '<pre>'; print_r($_POST); 	exit;
	
			$sql = $this->concatequery($_POST);
			
			$result = $this->db->query($sql);
			
			$final_res = $result->result_array();
			
			//echo'<pre>'; print_r($final_res); exit;
			
			$vehicle_type = get_vehicle_type($this->input->post('vehicletype'));
			$maker = $this->input->post('vehicle_makers');
			$selected_model = $this->input->post('vehicle_models');
			$date_motor_servicing = $this->input->post('date_motor_servicing'); 
			
		foreach($final_res as $vendor_info){
				
				$get_rates = $this->db->query("SELECT rate from `tu_motor_service_premium` WHERE id = '".$vendor_info['id']."' and vendor_id = '".$vendor_info['vendor_id']."'")->row_array();
				
				if($get_rates){
					
					$get_download_doc = $this->db->query("SELECT upload_doc from `tu_motor_servicing` WHERE vendor_id = '".$vendor_info['vendor_id']."' and upload_doc != '' ")->row_array();
					
					$array['motorservices_vendor_details'][$vendor_info['vendor_id']] = array(
											'company_name' => get_vendor_company_name($vendor_info['vendor_id']),
											'vendor_address' => get_vendor_address($vendor_info['vendor_id']),
											'vehicle_type' => $vehicle_type,
											'vehicle_type_id' => $this->input->post('vehicletype'),
											'total'   => number_format((float)$get_rates['rate'], 2, '.', ''),
											'maker' => $maker,
											'model' => $selected_model,
											'level_of_services' => $vendor_info['level_of_services'],
											'feature_of_services' => $vendor_info['feature_of_services'],
											'date_motor_servicing' => $date_motor_servicing,
											'add_ons' => $vendor_info['add_ons'],
											'download_doc' => $get_download_doc['upload_doc'],
											'id'   		=> $vendor_info['id']
										);
					
										
				}
				
			
		}
		
		//echo '<pre>';	print_r($array);exit;
		$this->load->view('motorservicing_result_view',$array);
	}
	
	public function motor_service_availibility($data,$vid){
		
		return $this->motorservicing_model->check_vehicle_avail($data,$vid);
		
	}
	
	
	public function book_motorservicing(){
		
		$user_info = $this->session->all_userdata();
		$user_id = $user_info['user_id'];
		$model = $_POST['vehicle_models_selected'];
		$date_motor_servicing = $_POST['date_motor_servicing'];
		
			if($user_id == ''){
				
				redirect('/users', '');
			}
			
		$vendor_id = $_POST['v_id'];
		
			$sql = $this->concatequery($_POST);
			
			$result = $this->db->query($sql);
			$final_res = $result->row_array();
			
			$get_rates = $this->db->query("SELECT rate from `tu_motor_service_premium` WHERE id = '".$final_res['id']."' and vendor_id = '".$final_res['vendor_id']."'")->row_array();
			
			$total = $get_rates['rate'];
			
			
		if($final_res){
			
				$this->db->insert('tu_save_book_motorservicing',array('vendor_id'=> $vendor_id,'user_id'=>$user_id,'vehicle_type'=>$final_res['vehicle_type'],'make'=>$final_res['maker'],'model' =>$model,'level_of_services'=>$final_res['level_of_services'],'feature_of_services'=>$final_res['feature_of_services'],'doc1'=>'','doc2'=>'','doc3'=>'','doc4'=>'','doc5'=>'','doc6'=>'','doc7'=>'','doc8'=>'','total'=>$total,'flag'=> "B",'booking_date'=>$date_motor_servicing));
				
				
				$lid = $this->db->insert_id();
				
				$this->db->insert('manage_quote' ,array('mq_vendor_id' => $vendor_id,'mq_user_id' => $user_id, 'mq_post_date' => $date_motor_servicing, 'mq_kind_of_request' => $user_info['usertype'], 'mq_kind_of_request' => $user_info['usertype'],'mq_request_from' => $user_info['member_user_name'],'mq_request_to' => $vendor_id,'mq_quote_via' => '','mq_state_of_quote' => 'B','mq_product' => 'Motorservicing','mq_subproduct' =>$final_res['vehicle_type'].' | '.$final_res['maker'].' | '.$model.' | '.$final_res['level_of_services'].' | '.$final_res['feature_of_services'],'mq_orderstatus' => 4,'mq_proof_attachment' => '','mq_action_status' => '','mq_qbs_id' => $lid,'mq_total_quote' => $total,'mq_feedback' =>''));
							

				$last_id = $this->db->insert_id();
				/*  Upload file system 8 files  **) */
					foreach($_FILES as $key => $file_name){
						
						$config['upload_path'] = './assets/motorservicing_doc/customer_docs'; 
						$config['allowed_types'] = 'gif|jpg|png|jpeg|txt|pdf|doc';
					   
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						
						if ( ! $this->upload->do_upload($key))
						{
								$error['errors'] = array($error_name => $this->upload->display_errors());
								
						}
						else
						{
								$mydata = array();
								$data = array('upload_data' => $this->upload->data());
								$mydata[$key] = $config['upload_path'].'/'.$data['upload_data']['file_name'];
								$full_path = $this->upload->data();
								
						}
						
						$this->db->where('id',$last_id);
					if($mydata['file1']){$this->db->update('tu_save_book_motorservicing',array('doc1'=>$mydata['file1'])); }
					if($mydata['file2']){$this->db->update('tu_save_book_motorservicing',array('doc2'=>$mydata['file2'])); }
					if($mydata['file3']){$this->db->update('tu_save_book_motorservicing',array('doc3'=>$mydata['file3'])); }
					if($mydata['file4']){$this->db->update('tu_save_book_motorservicing',array('doc4'=>$mydata['file4'])); }
					if($mydata['file5']){$this->db->update('tu_save_book_motorservicing',array('doc5'=>$mydata['file5'])); }
					if($mydata['file6']){$this->db->update('tu_save_book_motorservicing',array('doc6'=>$mydata['file6'])); }
					if($mydata['file7']){$this->db->update('tu_save_book_motorservicing',array('doc7'=>$mydata['file7'])); }
					if($mydata['file8']){$this->db->update('tu_save_book_motorservicing',array('doc8'=>$mydata['file8'])); }
					
					}
					
			
			
				$Message['status'] = array('success' => 'SERVICE BOOKED SUCCESSFULLY');
				
				if($this->db->insert_id()){									
					$this->send_mail_customer($vendor_id,$total,$_POST);		
					$Message['status'] = array('success' => 'SERVICE BOOKED SUCCESSFULLY');		
				}
			
		}else{
				$Message['status'] = array('error' => 'Fake Entry Modified Not Exists'); ;
		}
		
		$this->load->view('motorservicing_payment_view',$Message);
			
	}			
	
	public function get_vendor_name_from_id($vendor_id){	
	$query =  $this->db->query("SELECT company_name FROM wl_customers WHERE customers_id = '".$vendor_id."'")->row();	
	return $query->company_name;	
	}	

	public function send_mail_customer($vendor_id,$total,$data){
		//echo '<pre>'; print_r($data); exit;		
		
		
		$to = 'summit0987@gmail.com';		
		$from = 'sales@teluscare.com';			
		
			$message = '<html><body><table>';			
			$message .="<tr><td><h3>Company Info</h3></td></tr>";
			$message .="<tr><td>Company Name</td><td>".get_vendor_company_name($vendor_id)."</td></tr>";
			$message .="<tr><td><h3>Vehicle Info</h3></td></tr>";			
			$message .="<tr><td>Maker</td><td>".$data['vehicle_makers']."</td></tr>";
			$message .="<tr><td>Model</td><td><h2>".$data['vehicle_models_selected']."</h2></td></tr>";	
			$message .="<tr><td><h3>Services Info</h3></td></tr>";
			$message .="<tr><td>Level Of Services</td><td>".get_level_of_serv($data['services_level'])."</td></tr>";	
			$message .="<tr><td>Feature Of Services</td><td>".get_feature_of_serv($data['feature_of_services'])."</td></tr>";
			//$message .="<tr><td>Add Ons</td><td>".get_vehicle_type($data['vehicletype'])."</td></tr>";	
				
			$message .="<tr><td><h3>Total Premium</h3></td><td>".$total."</td></tr>";	
			$message .= '</table></body></html>';		
		
		$subject = 'MotorServicing Mail';	
		
		$headers .= "MIME-Version: 1.0\r\n";	
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";		
		$headers .= "From: '".$from."'";		
		$mail = mail($to,$subject,$message,$headers);					
		if($mail === true){				
		//echo 'mail Sent successfully';			
		}else{				
		//echo 'Error';		
		}
		
		}
	
	
	public function book_upload_doc(){
			
			//echo'<pre>'; print_r($_FILES);exit;
		
			foreach($_FILES as $key => $file_name){
				
				//print_r($file_name);
				
				$config['upload_path'] = './assets/motorservicing_doc/customer_docs'; 
				$config['allowed_types'] = 'gif|jpg|png|jpeg|txt|pdf|doc';
               
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload($key))
                {
                        $error['errors'] = array($error_name => $this->upload->display_errors());
						
                }
                else
                {
						$mydata = array();
                        $data = array('upload_data' => $this->upload->data());
						$mydata[$key] = $config['upload_path'].'/'.$data['upload_data']['file_name'];
						$full_path = $this->upload->data();
						
				}
				
				
		
			}
			
		}	
		
	
	public function save_motorservice(){
		
		$user_info = $this->session->all_userdata();
			$user_id = $user_info['user_id'];
				
			if($user_id == ''){
				
				redirect('/users', '');
			}
			
			$vendor_id = $_POST['v_id'];
			$model = $_POST['vehicle_models_selected'];
			$date_motor_servicing = $_POST['date_motor_servicing'];
		
			$sql = $this->concatequery($_POST);
			
			$result = $this->db->query($sql);
			$final_res = $result->row_array();
			
			$get_rates = $this->db->query("SELECT rate from `tu_motor_service_premium` WHERE id = '".$final_res['id']."' and vendor_id = '".$final_res['vendor_id']."'")->row_array();
			
			$total = $get_rates['rate'];
			
			if(count($final_res)){
				
				$this->db->insert('tu_save_book_motorservicing',array('vendor_id'=> $vendor_id,'user_id'=>$user_id,'vehicle_type'=>$final_res['vehicle_type'],'make'=>$final_res['maker'],'model' =>$model,'level_of_services'=>$final_res['level_of_services'],'feature_of_services'=>$final_res['feature_of_services'],'doc1'=>"",'doc2'=>"",'doc3'=>"",'doc4'=>"",'doc5'=>"",'doc6'=>"",'doc7'=>"",'doc8'=>"",'total'=>$total,'flag'=> "S",'booking_date'=>$date_motor_servicing));
				
				$lid = $this->db->insert_id();
				
				$this->db->insert('manage_quote' ,array('mq_vendor_id' => $vendor_id,'mq_user_id' => $user_id, 'mq_post_date' => $date_motor_servicing, 'mq_kind_of_request' => $user_info['usertype'], 'mq_kind_of_request' => $user_info['usertype'],'mq_request_from' => $user_info['member_user_name'],'mq_request_to' => $vendor_id,'mq_quote_via' => '','mq_state_of_quote' => 'S','mq_product' => 'Motorservicing','mq_subproduct' =>$final_res['vehicle_type'].' | '.$final_res['maker'].' | '.$model.' | '.$final_res['level_of_services'].' | '.$final_res['feature_of_services'],'mq_orderstatus' => 4,'mq_proof_attachment' => '','mq_action_status' => '','mq_qbs_id' => $lid,'mq_total_quote' => $total,'mq_feedback' =>''));

				$Message['status'] = array('success' => 'SERVICE BOOKED SUCCESSFULLY');
				
			}else{
				$Message['status'] = array('success' => 'SERVICE IS NOT SAVED DUE TO SOME ERROR');
			}  
				$this->load->view('motorservicing_save_view',$message);
	}
	
	public function book_view(){
		
		$this->load->view('motorservicing_book_view');
		
	}
	
	
	public function download_motor_docs($v_id){
		$vendor_id = $v_id;
		
		$res = $this->db->select("*");
		$res = $this->db->where('vendor_id', $vendor_id);
		$res = $this->db->get('tu_vendor_excluded_cars');
		
		return $res->result_array();
	}
	
	public function download(){
		
		$document = $_POST['docu'];
		
		$file_path1 = $document;
		$ext1 = pathinfo($file_path1, PATHINFO_EXTENSION);
		
		$file1 = basename($file_path1, ".".$ext1);
		$data1 = file_get_contents($file_path1);
		$name1 = $file1.'.'.$ext1;
					
		force_download($name1, $data1);
		
	}
	
	public function get_vehicle_models(){
		
		header('Content-type: application/json'); 
		
		$v_name = $this->input->post('vehicle_name');
		
		$models = $this->motorservicing_model->get_v_model($v_name);
		
	}
	
	public function get_all_vehicle_info(){
		
		$this->db->distinct();
		$query = $this->db->select('makeby');
		$query = $this->db->get('tu_vehiclemodelyear');
		return $query->result_array();
	} 
	
	public function check_user_auth_login(){
		
		if (!$this->auth->is_user_logged_in())
		{
			redirect('/users', '');
		} else{
			redirect('/members/myaccount', '');
		}
	
	}
}






?>