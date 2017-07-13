<?php  

class motorinsurance extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file','download','get_health_motor_vals'));	
		$this->load->library(array('safe_encrypt','securimage_library','Auth','Dmailer','cart'));
		$this->load->model('motorinsurance_model');
	}
	
	
	public function index(){
		$data = array();
		
		// GET COUNTRIES 
		redirect('/','');
		$data['vehicle']  = $this->get_all_vehicle_info();
		$data['countries'] = $this->motorinsurance_model->get_countries();
		
		$this->load->view('motorinsurance_view',$data);
	}
	
	public function concatequery($data){
		
		//echo '<pre>'; print_r($this->input->post()); exit;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){}else{redirect('/motorinsurance', '');}
		if(!$this->input->post()){
			redirect('/motorinsurance', '');
		}
		
		if($this->input->post('type_check')){
			
				if($data['type_check'] == 'comp'){ $table = 'tu_comprehensive';  }
				if($data['type_check'] == 'tpl'){ $table = 'tu_tpl'; $prem_val = 'premiumvalue'; }
				
				$ftable = $table;
			
			}
			
			$age = date_diff(date_create($_POST['birth_date']), date_create('today'))->y;
			
			if($age < 25){
				$age_post_id = 1;
			}elseif($age > 25){
				$age_post_id = 3;
			}
			
			$sql = "SELECT * FROM ";
			$sql .= $ftable;
		
			if(	!empty($data['vehicletype']) || !empty($data['emirates']) || $data['gcc_status'] != '' || !empty($data['Driving_Licence']) || !empty($data['driver_age']) || !empty($data['noofcylinders']) || !empty($data['agencytype'])  ){
				$sql .= " WHERE ";
				$sql .= '1=1';
				
			}
			
			if($data['vehicletype']){
				$vt = $this->input->post('vehicletype');
				$sql .= " and vehicle_type = ".$vt;
			}
			
			if($data['emirates']){
				$em = $this->input->post('emirates');
				$sql .= " and registration_emirates = '".$em."'";
			}
			
			if($data['gcc_status'] != ''){
				$gcc = $this->input->post('gcc_status');
				$sql .= " and gcc = ".$gcc;
			}
			
			if($data['Driving_Licence']){
				$dl = $this->input->post('Driving_Licence');
				$sql .= " and d_licence = '".$dl."'";
			}
			
			if($data['driver_age']){
				$da = $this->input->post('driver_age');
				$sql .= " and driver_age = ".$da;
			}
			
			if($data['noofcylinders']){
				$cy = $this->input->post('noofcylinders');
				$sql .= " and noofcilender = '".$cy."'";
			}
			
			if($data['type_check'] != 'tpl'){
				if($data['agencytype']){
					$at = $this->input->post('agencytype');
					$sql .= " and agency_type = '".$at."'";
				}
			}
			if($data['v_id']){
				$vendor_id = $this->input->post('v_id');
				$sql .= " and vendor_id = '".$vendor_id."'";
			}
			
			
			return $sql;
		
	}
	
	public function motor_result(){
	
		$sql = $this->concatequery($_POST);
			
			$result = $this->db->query($sql);
			
			$final_res = $result->result_array();
			
			if($this->input->post('PAB_passangers_txt') == ''){  
			$num_of_pass = 1; }else{ $num_of_pass = $this->input->post('PAB_passangers_txt');  }
			
			$vehicle_type = get_vehicle_type($this->input->post('vehicletype'));
			
			$current_year_val = $this->input->post('current_year_val');
			$type_of_bussiness = $this->input->post('business_check');
			
			//$array = array();
			 /*   echo '<pre>'; print_r($final_res);
			exit;  */  
			
			
			
		foreach($final_res as $vendor_info){
				
			  $motor_serv_availability = $this->motor_service_availibility($this->input->post(),$vendor_info['vendor_id']);
			
			//if($motor_serv_availability == 0){
				
			  $vendor_charges = $this->db->query("SELECT vec.*,wc.company_name FROM tu_vendor_excluded_cars as vec LEFT JOIN wl_customers as wc ON vec.vendor_id = wc.customers_id WHERE vec.vendor_id = '".$vendor_info['vendor_id']."'")->result_array();
				
				$add = 0;
				if($type_of_bussiness == 'pvt' ){
					$current_year_charges = $current_year_val  * $vendor_info['premium_value']  / 100 ;
				}else{
					$current_year_charges = $current_year_val  * $vendor_info['comm_premium_value']  / 100 ;
				}
				if($this->input->post('type_check') == 'comp'){
					
					foreach($vendor_charges as $vc){
						
						$company_name = $vc['company_name'];
						
						if($vc['PAB_driver'] != '' && $vc['RSA'] != '' && $vc['PAB_passanger'] != '' && $vc['ADD_rent_car'] != '' ){
							 
							if($this->input->post('PAB_driver') == 1){ 	
								$add_PAB_driver = $vc['PAB_driver'];   $driver = 'Driver';	
							}else{ $add_PAB_driver = 'N/A'; $driver = ''; }
							
							if($this->input->post('RSA') == 1) 	
								{ 
								$add_RSA  = $vc['RSA'];  	$RSA = 'RSA';	
							}else{ $add_RSA = 'N/A'; $RSA = ''; } 
							
							if($this->input->post('PAB_passangers') == 1){
								$add_PAB_passangers_txt = $num_of_pass * $vc['PAB_passanger'];  $passangers = 'Passangers';
								}else{ $add_PAB_passangers_txt = 'N/A'; $passangers = ''; }
								
							if($this->input->post('ADD_rent_car') == 1) { 
								$add_ADD_rent_car = $vc['ADD_rent_car'];  $Rentacar = 'Rent A Car'; 
							}else{ $add_ADD_rent_car = 'N/A';  $Rentacar = '';  }
							
							//echo $add_PAB_passangers_txt;
							
							
						$total = $current_year_charges + $add_PAB_driver + $add_RSA  +  $add_PAB_passangers_txt + $add_ADD_rent_car ;
						if($type_of_bussiness == 'pvt' ){
							if($total > $vendor_info['min_value']){
								$final_val = $total ;
							}else{
								$final_val = $vendor_info['min_value'];
							}
						}else{
							if($total > $vendor_info['comm_min_value']){
								$final_val = $total ;
							}else{
								$final_val = $vendor_info['comm_min_value'];
							}
						}
					}
					}
						
				}	
				if($this->input->post('type_check') == 'tpl'){
					if($type_of_bussiness == 'pvt' ){
						$final_val = $vendor_info['premiumvalue'];
					}else{
						$final_val = $vendor_info['premiumvalue_comm'];
					}
						foreach($vendor_charges as $vc){
							$company_name = $vc['company_name'];
						}
				}	
				
					$downloadable_data = $this->download_motor_docs($vendor_info['vendor_id']); 
					
					$array['motor_vendor_details'][$vendor_info['vendor_id']] = array(
										'company_name' => $company_name,
										'vehicle_type' => $vehicle_type,
										'total'   => number_format((float)$final_val, 2, '.', ''),
										'post_val' => $this->input->post(),
										'downloadable_data' => $downloadable_data,
										'exclude_motors' => $motor_serv_availability,
										'summary_benefits' => array(
															'PAB Driver' => $add_PAB_driver,
															'RSA' => $add_RSA,
															'PAB Passangers' => $add_PAB_passangers_txt,
															'Rent A Car' => $add_ADD_rent_car
										)
									);
					
				
		
			
		}
		$this->load->view('motor_result_view',$array);
	}
	
	public function motor_service_availibility($data,$vid){
		
		return $this->motorinsurance_model->check_vehicle_avail($data,$vid);
		
	}
	
	
	public function book_motor_service(){
		
		$user_info = $this->session->all_userdata();
			$user_id = $user_info['user_id'];
				
			if($user_id == ''){
				
				redirect('/users', '');
			}
			
		$this->book_upload_doc();
		
		$config['upload_path'] = './assets/motor_doc/customer_docs'; 
		$vendor_id = $_POST['v_id'];
		$file1 = $config['upload_path'] .'/'.$_FILES['file1']['name'];
		$file2 = $config['upload_path'] .'/'.$_FILES['file2']['name'];
		$file3 = $config['upload_path'] .'/'.$_FILES['file3']['name'];
		
			$sql = $this->concatequery($_POST);
			
			$result = $this->db->query($sql);
			$final_res = $result->result_array();
			
			
		if($final_res){
			
			if($this->input->post('PAB_passangers_txt') == ''){  
				$num_of_pass = 1; }else{ $num_of_pass = $this->input->post('PAB_passangers_txt');  }
			
			$vehicle_type = get_vehicle_type($this->input->post('vehicletype'));

			$current_year_val = $this->input->post('current_year_val');
			
				foreach($final_res as $vendor_info){
					
				  $vendor_charges = $this->db->query("SELECT vec.*,wc.company_name FROM tu_vendor_excluded_cars as vec INNER JOIN wl_customers as wc ON vec.vendor_id = wc.customers_id WHERE vec.vendor_id = '".$vendor_info['vendor_id']."'")->result_array();
					
					$add = 0;
					
					$current_year_charges = $current_year_val  * $vendor_info['premium_value']  / 100 ;
					
					if($this->input->post('type_check') == 'comp'){
						
						foreach($vendor_charges as $vc){
							
							$company_name = $vc['company_name'];
							
							if($vc['PAB_driver'] != '' && $vc['RSA'] != '' && $vc['PAB_passanger'] != ''  && $vc['ADD_rent_car'] != '' ){
								 //echo '<pre>'; print_r($vc); 
								
								if($this->input->post('PAB_driver') == 1){ 	
									$add_PAB_driver = $vc['PAB_driver'];   $driver = 'Driver';	
								}else{ $add_PAB_driver = 0; $driver = ''; }
								
								if($this->input->post('RSA') == 1) 	
									{ 
									$add_RSA  = $vc['RSA'];  	$RSA = 'RSA';	
								}else{ $add_RSA = 0; $RSA = ''; } 
								
								if($this->input->post('PAB_passangers') == 1){
									$add_PAB_passangers_txt = $num_of_pass * $vc['PAB_passanger'];  $passangers = 'Passangers';
									$pfa_pass = $num_of_pass;
									}else{ $add_PAB_passangers_txt = 0;$pfa_pass =0; $passangers = ''; }
									
								if($this->input->post('ADD_rent_car') == 1) { 
									$add_ADD_rent_car = $vc['ADD_rent_car'];  $Rentacar = 'Rent A Car'; 
								}else{ $add_ADD_rent_car = 0;  $Rentacar = '';  }
								
								//echo $add_PAB_passangers_txt;
							$total = $current_year_charges + $add_PAB_driver + $add_RSA  +  $add_PAB_passangers_txt + $add_ADD_rent_car ;
							
							}
						}
					
							
					}	
					if($this->input->post('type_check') == 'tpl'){
						$total = $vendor_info['premiumvalue'];
							foreach($vendor_charges as $vc){
								$company_name = $vc['company_name'];
							}
							if($_POST['noofcylinders']){
								$noofcilender = $_POST['noofcylinders'];
							}else{ $noofcilender =0; }
					}	
					
					$user_info = $this->session->all_userdata();
					$user_id = $user_info['user_id'];
					
					$agencytype	= $_POST['agencytype'];
					$agency = $agencytype == '' ? 0 : $agencytype;
					
					$current_year_val	= $_POST['current_year_val'];
					$current_y_v = $current_year_val == '' ? 0 : $current_year_val;
					
					
					
				$this->db->insert('tu_save_book_motor',array('vendor_id'=> $vendor_id,'user_id'=>$user_id,'service_type'=>$_POST['type_check'],'vehicle_type'=>$_POST['vehicletype'],'driving_licence' => $_POST['Driving_Licence'],'driver_age'=>$_POST['driver_age'],'r_emirate'=>$_POST['emirates'],'gcc'=>$_POST['gcc_status'],'agency_type'=>$agency,'current_year_value'=> $current_y_v,'PAB_driver'=>$_POST['PAB_driver'],'RSA'=>$_POST['RSA'],'PAB_passangers'=>$pfa_pass,'ADD_rent_car'=>$_POST['ADD_rent_car'],'noofcilender'=>$noofcilender,'total'=>$total,'doc1'=> $file1,'doc2'=> $file2,'doc3'=> $file3,'flag'=>'B'));
				
				$lid = $this->db->insert_id();
			
				$this->db->insert('manage_quote' ,array('mq_vendor_id' => $vendor_id,'mq_user_id' => $user_id, 'mq_post_date' => date('Y-m-d h:i:s',time()), 'mq_kind_of_request' => $user_info['usertype'], 'mq_kind_of_request' => $user_info['usertype'],'mq_request_from' => $user_info['member_user_name'],'mq_request_to' => $vendor_id,'mq_quote_via' => '','mq_state_of_quote' => 'B','mq_product' => 'Motor Insurance','mq_subproduct' => 'Service Type: '.$_POST['type_check'].' | Vehicletype: '.$_POST['vehicletype'].' | Driving_Licence: '.$_POST['Driving_Licence'].' | Driver Age :'.$_POST['driver_age'].' | Emirates '.$_POST['emirates'].' | GCC Status: '.$_POST['gcc_status'].' | Agency Type '.$agency.' | Current Year Value: '.$current_y_v.' | PAB Driver: '.$_POST['PAB_driver'].' | RSA:'.$_POST['RSA'].' | PAB_passangers: '.$pfa_pass.' | ADD_rent_car: '.$_POST['ADD_rent_car'].' | noofcilender:'.$noofcilender,'mq_orderstatus' => 4,'mq_proof_attachment' => $file1.'~'.$file2.'~'$file3,'mq_action_status' => '','mq_qbs_id' => $lid,'mq_total_quote' => $total,'mq_feedback' =>''));
				
				
				if($this->db->insert_id()){			

				$this->send_mail_customer($vendor_id,$total,$_POST);	
				
				$Message['status'] = array('success' => 'SERVICE BOOKED SUCCESSFULLY');
				}
			}
		}else{
				$Message['status'] = array('error' => 'Fake Entry Modified Not Exists'); ;
		}
		
		$this->load->view('motor_payment_view',$Message);
			
	}			
	
	public function get_vendor_name_from_id($vendor_id){	
	$query =  $this->db->query("SELECT company_name FROM wl_customers WHERE customers_id = '".$vendor_id."'")->row();	
	return $query->company_name;	
	}	

	public function send_mail_customer($vendor_id,$total,$data){
		//echo '<pre>'; print_r($data); exit;		
		if($data['PAB_driver'] == 1){ $driver = 'Yes';}else{ $driver = 'No'; }	
		if($data['RSA'] == 1){$RSA = 'Yes';}else{ $add_RSA = 0; $RSA = 'No'; } 	
		if($data['PAB_passangers'] == 1){$passangers = 'Yes'; }else{ $passangers = 'No'; }	
		if($data['ADD_rent_car'] == 1) {  $Rentacar = 'Yes'; }else{ $Rentacar = 'No';  }

		if($data['PAB_passangers_txt'] == ''){ $num_of_pass = 1; }else{ $num_of_pass = $data['PAB_passangers_txt'];  }	

		$tot = 0;			
		$vendor_company_name = $this->get_vendor_name_from_id($vendor_id);
		$type_check = $data['type_check'] ==  'comp' ? 'Comprehensive' : 'Third Party Liabilities';
		
		$to = 'summit0987@gmail.com';		
		$from = 'sales@teluscare.com';			
		
			$message = '<html><body><table>';			
			$message .="<tr><td><h3>Company Info</h3></td></tr>";	
			$message .="<tr><td>Company Name:</td><td>".$vendor_company_name."</td></tr>";
			$message .="<tr><td>Service Type</td><td><h2>".$type_check."</h2></td></tr>";	
			$message .="<tr><td><h3>Vehicle Info</h3></td></tr>";			
			$message .="<tr><td>Vehicle Name</td><td>".$data['vehicle_name']."</td></tr>";	
			$message .="<tr><td>Vehicle Model</td><td>".$data['vehicle_models']."</td></tr>";
			$message .="<tr><td>Vehicle Type</td><td>".get_vehicle_type($data['vehicletype'])."</td></tr>";	
			$message .="<tr><td>Driving Licence</td><td>".get_driver_licence($data['Driving_Licence'])."</td></tr>";
			$message .="<tr><td>Driver Age</td><td>".get_driver_age($data['driver_age'])."</td></tr>";	
			$message .="<tr><td>Emirate</td><td>".get_emirate_name($data['emirates'])."</td></tr>";		
			$message .="<tr><td>GCC</td><td>".get_gcc($data['gcc_status'])."</td></tr>";		
		if($data['type_check'] == 'comp'){				
			$message .="<tr><td>Agency Type</td><td>".get_agency_type($data['agencytype'])."</td></tr>";
			$message .="<tr><td>Current Year Value</td><td>".$data['current_year_val']."</td></tr>";	
			$message .="<tr><td><h3>Benefits</h3></td></tr>";			
			$message .="<tr><td>PAB Driver</td><td>".$driver."</td></tr>";	
			$message .="<tr><td>Road Side Accident</td><td>".$RSA."</td></tr>";	
			$message .="<tr><td>PAB Passangers</td><td>".$passangers."</td></tr>";
		
			$message .="<tr><td>No Of Passangers</td><td>".$num_of_pass."</td></tr>";	
			$message .="<tr><td>Rent A Car</td><td>".$Rentacar."</td></tr>";			
		}else{				
			$message .="<tr><td>No Of Cylinders</td><td>".get_no_cylinder($data['noofcylinders'])."</td></tr>";		
		}			
			$message .="<tr><td><h3>Total Premium</h3></td><td>".$total."</td></tr>";	
			$message .= '</table></body></html>';		
		
		$subject = 'Motor Insurance';	
		
		$headers .= "MIME-Version: 1.0\r\n";	
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";		
		$mail = mail($to,$subject,$message,$headers);					
		if($mail === true){				
		//echo 'mail Sent successfully';			
		}else{				
		//echo 'Error';		
		}
		
		}
	
	
	public function book_upload_doc(){
			
			if(!empty($_FILES['file1']['name'])){
				
				$config['upload_path'] = './assets/motor_doc/customer_docs'; 
				$config['allowed_types'] = 'gif|jpg|png|jpeg|txt|pdf|doc';
               
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('file1'))
                {
                        $error['errors'] = array('error1' => $this->upload->display_errors());
						
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						$file_path1 = $config['upload_path'].'/'.$data['upload_data']['file_name'];
						$full_path = $this->upload->data();
						
				}
			
			}
			if(!empty($_FILES['file2']['name'])){
				
				$config['upload_path'] = './assets/motor_doc/customer_docs'; 
				$config['allowed_types'] = 'gif|jpg|png|jpeg|txt|pdf|doc';
               
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				
				
                if ( ! $this->upload->do_upload('file2'))
                {
                        $error['errors'] = array('error2' => $this->upload->display_errors());
						
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						$file_path2 = $config['upload_path'].'/'.$data['upload_data']['file_name'];
						$full_path = $this->upload->data();
						
				}
			
			}
			if(!empty($_FILES['file3']['name'])){
				
				$config['upload_path'] = './assets/motor_doc/customer_docs'; 
				$config['allowed_types'] = 'gif|jpg|png|jpeg|txt|pdf|doc';
               
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
			    if ( ! $this->upload->do_upload('file3'))
                {
                        $error['errors'] = array('error3' => $this->upload->display_errors());
						
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						$file_path3 = $config['upload_path'].'/'.$data['upload_data']['file_name'];
						$full_path = $this->upload->data();
				}
			
			}
				
				
	}	
		
	
	public function save_motor_service(){
		
		$user_info = $this->session->all_userdata();
			$user_id = $user_info['user_id'];
				
			if($user_id == ''){
				
				redirect('/users', '');
			}
			
		$vendor_id = $_POST['v_id'];
		
		$sql = $this->concatequery($_POST);
			
			$result = $this->db->query($sql);
			$final_res = $result->result_array();
			
			if(count($final_res)){
				
				if($this->input->post('PAB_passangers') == 1){
						$pfa_pass = $this->input->post('PAB_passangers_txt');
					}else{ 
						$pfa_pass =0; 
					}
					
				if($_POST['noofcylinders']){
						$noofcilender = $_POST['noofcylinders'];
					}else{ 
						$noofcilender =0;
					}
					
					$user_info = $this->session->all_userdata();
					$user_id = $user_info['user_id'];
					
					$agencytype	= $_POST['agencytype'];
					$agency = $agencytype == '' ? 0 : $agencytype;
					
					$current_year_val	= $_POST['current_year_val'];
					$current_y_v = $current_year_val == '' ? 0 : $current_year_val;
					
				$this->db->insert('tu_save_book_motor',array('vendor_id'=> $vendor_id,'user_id'=>$user_id,'service_type'=>$_POST['type_check'],'vehicle_type'=>$_POST['vehicletype'],'driving_licence' => $_POST['Driving_Licence'],'driver_age'=>$_POST['driver_age'],'r_emirate'=>$_POST['emirates'],'gcc'=>$_POST['gcc_status'],'agency_type'=>$agency,'current_year_value'=> $current_y_v,'PAB_driver'=>$_POST['PAB_driver'],'RSA'=>$_POST['RSA'],'PAB_passangers'=>$pfa_pass,'ADD_rent_car'=>$_POST['ADD_rent_car'],'noofcilender'=>$noofcilender,'total'=>0,'doc1'=> '','doc2'=> '','doc3'=> '','flag'=>'S'));

				$lid = $this->db->insert_id();
			
				$this->db->insert('manage_quote' ,array('mq_vendor_id' => $vendor_id,'mq_user_id' => $user_id, 'mq_post_date' => date('Y-m-d h:i:s',time()), 'mq_kind_of_request' => $user_info['usertype'], 'mq_kind_of_request' => $user_info['usertype'],'mq_request_from' => $user_info['member_user_name'],'mq_request_to' => $vendor_id,'mq_quote_via' => '','mq_state_of_quote' => 'S','mq_product' => 'Motor Insurance','mq_subproduct' => 'Service Type: '.$_POST['type_check'].' | Vehicletype: '.$_POST['vehicletype'].' | Driving_Licence: '.$_POST['Driving_Licence'].' | Driver Age :'.$_POST['driver_age'].' | Emirates '.$_POST['emirates'].' | GCC Status: '.$_POST['gcc_status'].' | Agency Type '.$agency.' | Current Year Value: '.$current_y_v.' | PAB Driver: '.$_POST['PAB_driver'].' | RSA:'.$_POST['RSA'].' | PAB_passangers: '.$pfa_pass.' | ADD_rent_car: '.$_POST['ADD_rent_car'].' | noofcilender:'.$noofcilender,'mq_orderstatus' => 4,'mq_proof_attachment' => $file1.'~'.$file2.'~'$file3,'mq_action_status' => '','mq_qbs_id' => $lid,'mq_total_quote' => $total,'mq_feedback' =>''));
				
				
				$Message['status'] = array('success' => 'SERVICE BOOKED SUCCESSFULLY');
				
			}else{
				$Message['status'] = array('success' => 'SERVICE IS NOT SAVED DUE TO SOME ERROR');
			}
				$this->load->view('motor_save_view',$message);
	}
	
	public function book_view(){
		
		$this->load->view('motor_book_view');
		
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
		
		$v_name = $this->input->post('vehicle_name');
		
		$models = $this->motorinsurance_model->get_v_model($v_name);
		
	}
	
	public function motor_data_popup(){
		
		$models = $this->db->insert('tu_pop_up_registration',$_POST);
		
		if($this->db->insert_id()){
			echo 'OK';
			$to = $_POST['email'];		
			$from = 'sales@teluscare.com';			
		
			$message = '<html><body>';			
			$message .="<h3>Dear ".$_POST['fullname']."</h3></br>";	
			$message .="<p>Thanks for registering with Telus</p></br></br>";
			$message .="<p>The offer valid from 1st April 17, upon renewal of Motor Insurance with us at market best rate avails the discount as describe.</p></br>";
			$message .="<p>A. 30% to 50% off on car washing *</p></br>";
			$message .="<p>B. 10% to 30% off on car servicing *</p></br>";
			$message .="<p>C. Reward points up to AED 350 *</p></br></br>";
			$message .="<p>Renew your veicle and avail the above offer</p></br></br>";
			
			$message .="<p>Thanks and Regards</p></br>";
			$message .="<p>Telus care Team</p></br>";
						
			$message .= '</table></body></html>';		
		
			$subject = 'Motor Offers from Teluscare.com';	
			
			$headers .= "MIME-Version: 1.0\r\n";	
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";		
			$mail = mail($to,$subject,$message,$headers);					
			if($mail === true){				
			//echo 'mail Sent successfully';			
			}else{				
			//echo 'Error';		
			}
			
		}else{
			echo 'KO';
			
		}
		
	}
	
	public function get_all_vehicle_info(){
		
		$this->db->distinct();
		$query = $this->db->select('makeby');
		$this->db->order_by("makeby", "ASC");
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