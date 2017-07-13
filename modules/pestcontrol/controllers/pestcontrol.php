<?php  

class pestcontrol extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file','download','get_health_motor_vals','custom_form'));	
		$this->load->library(array('safe_encrypt','securimage_library','Auth','Dmailer','cart'));
		$this->load->model('pestcontrol_model');
	}
	
	
	public function index(){
		$data = array();
		
		// GET COUNTRIES 
		redirect('/','');
		$data['vehicle']  = $this->get_all_vehicle_info();
		$data['countries'] = $this->motorservicing_model->get_countries();
		
		$this->load->view('pestcontrol_view',$data);
	}
	
	public function concatequery($data){
		
		//echo '<pre>'; print_r($this->input->post()); exit;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){}else{redirect('/pestcontrol', '');}
		if(!$this->input->post()){
			redirect('/pestcontrol', '');
		}
		
			$table = 'tu_pest_control';
			$ftable = $table;
			
			$sql = "SELECT * FROM ";
			$sql .= $ftable;
		
			if(	!empty($data['type_of_service']) || !empty($data['vehicle_makers']) || !empty($data['premises']) || !empty($data['kind_premises']) || !empty($data['area'])){
				$sql .= " WHERE ";
				$sql .= '1=1';
				
			}
			
			if($data['type_of_service']){
				$vt = $this->input->post('type_of_service');
				$sql .= " and type_of_service = ".$vt;
			}
			
			if($data['premises']){
				$em = $this->input->post('premises');
				$sql .= " and type_of_premises = '".$em."'";
			} 
			
			/* if($data['vehicle_models']){
				$sql .= $this->motorservicing_model->check_vehicle_avail_customer($data);
			}  */
			
			if($data['kind_premises']){
				$kind_premises = $this->input->post('kind_premises');
				$sql .= " and kind_of_premises = '".$kind_premises."'";
			} 
			
			if($data['area']){
				$area = $this->input->post('area');
				$sql .= " and approx_area = '".$area."'";
			} 
			
			if($data['v_id'] != ''){
				$vendor_id = $this->input->post('v_id');
				$sql .= " and vendor_id = '".$vendor_id."'";
			}
			
			return $sql;
		
	}
	
	public function pestcontrol_result(){
	
		//	echo '<pre>'; print_r($this->input->post()); 	exit;
	
			$sql = $this->concatequery($_POST);
			
			$result = $this->db->query($sql);
			
			$final_res = $result->result_array();
			
			//echo'<pre>'; print_r($final_res); exit;
			
			$book_date_pest = $this->input->post('date_pest');
			
		foreach($final_res as $vendor_info){
				
				$get_rates = $this->db->query("SELECT rate from `tu_pest_control_premium` WHERE id = '".$vendor_info['id']."' and vendor_id = '".$vendor_info['vendor_id']."'")->row_array();
				
				if($get_rates){
					
					$get_download_doc = $this->db->query("SELECT upload_doc from `tu_pest_control` WHERE vendor_id = '".$vendor_info['vendor_id']."' and upload_doc != '' ")->row_array();
					
					$array['pestcontrol_vendor_details'][$vendor_info['vendor_id']] = array(
											'company_name' => get_vendor_company_name($vendor_info['vendor_id']),
											'vendor_address' => get_vendor_address($vendor_info['vendor_id']),
											'type_of_service' => $this->input->post('type_of_service'),
											'type_of_premises' => $this->input->post('premises'),
											'kind_of_premises' => $this->input->post('kind_premises'),
											'approx_area' => $this->input->post('area'),
											'total'   => number_format((float)$get_rates['rate'], 2, '.', ''),
											'download_doc' => $get_download_doc['upload_doc'],
											'book_date'		=> $this->input->post('date_pest'),
											'id'   		=> $vendor_info['id']
										);
					
										
				}
				
			
		}
		
		//echo'<pre>';print_r($array);exit;
		$this->load->view('pestcontrol_result_view',$array);
	}
	
	public function pestcontrol_availibility($data,$vid){
		
		return $this->pestcontrol_model->check_vehicle_avail($data,$vid);
		
	}
	
	
	public function book_pestcontrol(){
		
		$user_info = $this->session->all_userdata();
		$user_id = $user_info['user_id'];
	
			if($user_id == ''){
				
				redirect('/users', '');
			}
			
			$vendor_id = $_POST['v_id'];
		
			$sql = $this->concatequery($_POST);
			
			$result = $this->db->query($sql);
			$final_res = $result->row_array();
			$booking_date = $_POST['booking_date'];
			
				$get_rates = $this->db->query("SELECT rate from `tu_pest_control_premium` WHERE id = '".$final_res['id']."' and vendor_id = '".$final_res['vendor_id']."'")->row_array();
			
			$total = $get_rates['rate'];
			
			if(count($final_res)){
				
				$this->db->insert('tu_save_book_pestcontrol',array('vendor_id'=> $final_res['vendor_id'],'user_id'=>$user_id,'type_of_service'=>$final_res['type_of_service'],'type_of_premise'=>$final_res['type_of_premises'],'kind_of_premises' =>$final_res['kind_of_premises'],'approx_area'=>$final_res['approx_area'],'doc1'=>"",'doc2'=>"",'flag'=> "B",'total'=>$total,'booking_date'=>$booking_date));

				$lid = $this->db->insert_id();
				
				$this->db->insert('manage_quote' ,array('mq_vendor_id' => $vendor_id,'mq_user_id' => $user_id, 'mq_post_date' => $booking_date, 'mq_kind_of_request' => $user_info['usertype'], 'mq_kind_of_request' => $user_info['usertype'],'mq_request_from' => $user_info['member_user_name'],'mq_request_to' => $vendor_id,'mq_quote_via' => '','mq_state_of_quote' => 'B','mq_product' => 'Pestcontrol','mq_subproduct' =>$final_res['type_of_service'].' | '.$final_res['type_of_premises'].' | '.$final_res['kind_of_premises'].' | '.$final_res['approx_area'],'mq_orderstatus' => 4,'mq_proof_attachment' => '','mq_action_status' => '','mq_qbs_id' => $lid,'mq_total_quote' => $total,'mq_feedback' =>''));
				

				$last_id = $this->db->insert_id();
				/*  Upload file system 2 files  **) */
					foreach($_FILES as $key => $file_name){
						
						$config['upload_path'] = './assets/pestcontrol_doc/customer_docs'; 
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
					if($mydata['file1']){$this->db->update('tu_save_book_pestcontrol',array('doc1'=>$mydata['file1'])); }
					if($mydata['file2']){$this->db->update('tu_save_book_pestcontrol',array('doc2'=>$mydata['file2'])); }
					
					
					}
					
			
			
				$Message['status'] = array('success' => 'SERVICE BOOKED SUCCESSFULLY');
				
				if($this->db->insert_id()){									
					$this->send_mail_customer($vendor_id,$total,$_POST);		
					$Message['status'] = array('success' => 'SERVICE BOOKED SUCCESSFULLY');		
				}
			
		}else{
				$Message['status'] = array('error' => 'Fake Entry Modified Not Exists'); ;
		}
		
		$this->load->view('pestcontrol_payment_view',$Message);
			
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
		$message .="<tr><td><h3>Service Type</h3></td></tr>";			
		$message .="<tr><td>Type of Service</td><td>".get_types_of_services($data['type_of_service'])."</td></tr>";
		$message .="<tr><td><h3>Premises Info</h3></td></tr>";			
		$message .="<tr><td>Type Of Premise</td><td>".get_type_of_premise($data['type_of_premises'])."</td></tr>";
		$message .="<tr><td>Kind Of Premise</td><td><h2>".get_kind_of_premise($data['kind_of_premises'])."</h2></td></tr>";	
		$message .="<tr><td><h3>Area</h3></td></tr>";
		$message .="<tr><td>Level Of Services</td><td>".get_approx_area($data['approx_area'])."</td></tr>";	
				
		$message .="<tr><td><h3>Total Premium</h3></td><td>".$total."</td></tr>";	
		$message .= '</table></body></html>';		
		
		$subject = 'pestcontrol Mail';	
		
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
		
	
	public function save_pestcontrol(){
		
		$user_info = $this->session->all_userdata();
			$user_id = $user_info['user_id'];
				
			if($user_id == ''){
				
				redirect('/users', '');
			}
			
			$vendor_id = $_POST['v_id'];
			$model = $_POST['vehicle_models_selected'];
			$booking_date = $_POST['booking_date'];
		
			$sql = $this->concatequery($_POST);
			
			$result = $this->db->query($sql);
			$final_res = $result->row_array();
			
			$get_rates = $this->db->query("SELECT rate from `tu_pest_control_premium` WHERE id = '".$final_res['id']."' and vendor_id = '".$final_res['vendor_id']."'")->row_array();
			
			$total = $get_rates['rate'];
			
			if(count($final_res)){
				
				$this->db->insert('tu_save_book_pestcontrol',array('vendor_id'=> $final_res['vendor_id'],'user_id'=>$user_id,'type_of_service'=>$final_res['type_of_service'],'type_of_premise'=>$final_res['type_of_premises'],'kind_of_premises' =>$final_res['kind_of_premises'],'approx_area'=>$final_res['approx_area'],'doc1'=>"",'doc2'=>"",'flag'=> "S",'total'=>$total,'booking_date'=>$booking_date));
				
				$lid = $this->db->insert_id();
			
		
				$this->db->insert('manage_quote' ,array('mq_vendor_id' => $vendor_id,'mq_user_id' => $user_id, 'mq_post_date' => $booking_date, 'mq_kind_of_request' => $user_info['usertype'], 'mq_kind_of_request' => $user_info['usertype'],'mq_request_from' => $user_info['member_user_name'],'mq_request_to' => $vendor_id,'mq_quote_via' => '','mq_state_of_quote' => 'S','mq_product' => 'Pestcontrol','mq_subproduct' =>$final_res['type_of_service'].' | '.$final_res['type_of_premises'].' | '.$final_res['kind_of_premises'].' | '.$final_res['approx_area'],'mq_orderstatus' => 4,'mq_proof_attachment' => '','mq_action_status' => '','mq_qbs_id' => $lid,'mq_total_quote' => $total,'mq_feedback' =>''));
				
				
				$Message['status'] = array('success' => 'SERVICE BOOKED SUCCESSFULLY');
				
			}else{
				$Message['status'] = array('success' => 'SERVICE IS NOT SAVED DUE TO SOME ERROR');
			}  
				$this->load->view('pestcontrol_save_view',$message);
	}
	
	public function book_view(){
		
		$this->load->view('motorservicing_book_view');
		
	}
	
	
	public function download_pestcontrol_docs($v_id){
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