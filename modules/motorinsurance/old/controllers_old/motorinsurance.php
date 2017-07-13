<?php  

class motorinsurance extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file','download'));	
		$this->load->library(array('safe_encrypt','securimage_library','Auth','Dmailer','cart'));
		$this->load->model('motorinsurance_model');
	}
	
	
	public function index(){
		$data = array();
		
		// GET COUNTRIES 
		$data['countries'] = $this->motorinsurance_model->get_countries();
		
		
		$this->load->view('motorinsurance_view',$data);
	}
	
	public function concatequery($data){
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){}else{redirect('/motorinsurance', '');}
		
		if($this->input->post('type_check')){
			
				if($data['type_check'] == 'comp'){ $table = 'tu_comprehensive';  }
				if($data['type_check'] == 'tpl'){ $table = 'tu_tpl'; $prem_val = 'premiumvalue'; }
				
				$ftable = $table;
			
			}
			
			$sql = "SELECT * FROM ";
			$sql .= $ftable;
		
			if(	$data['vehicletype'] != '' || $data['emirates'] != '' || $data['gcc_status'] != '' || $data['Driving_Licence'] != '' || $data['driver_age'] != '' || $data['noofcylinders'] != '' || $data['agencytype'] != ''  ){
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
			
			if($data['agencytype']){
				$at = $this->input->post('agencytype');
				$sql .= " and agency_type = '".$at."'";
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
			
			if($this->input->post('vehicletype') == 1){ $vehicle_type = 'Buses(abv 15 seats)'; } elseif($this->input->post('vehicletype') == 2){ $vehicle_type = 'Heavy Vehicles'; }elseif($this->input->post('vehicletype') == 3){ $vehicle_type = 'Saloon'; }elseif($this->input->post('vehicletype') == 4){ $vehicle_type = 'Sports'; }elseif($this->input->post('vehicletype') == 5){ $vehicle_type = 'Stationwagon'; }elseif($this->input->post('vehicletype') == 6){ $vehicle_type = 'Vans,Buses(upto 15 seats)'; }
			
			$current_year_val = $this->input->post('current_year_val');
			
			//$array = array();
			/*  echo $sql; //print_r($final_res);
			exit;  */
			
			foreach($final_res as $vendor_info){
				
			  $vendor_charges = $this->db->query("SELECT vec.*,wc.company_name FROM tu_vendor_excluded_cars as vec INNER JOIN wl_customers as wc ON vec.vendor_id = wc.customers_id WHERE vec.vendor_id = '".$vendor_info['vendor_id']."'")->result_array();
				
				$add = 0;
				
				$current_year_charges = $current_year_val  * $vendor_info['premium_value']  / 100 ;
				
				if($this->input->post('type_check') == 'comp'){
					
					foreach($vendor_charges as $vc){
						
						$company_name = $vc['company_name'];
						
						if($vc['PAB_driver'] != '' && $vc['RSA'] != '' && $vc['PAB_passanger'] != '' && $vc['ADD_rent_car'] != '' ){
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
								}else{ $add_PAB_passangers_txt = 0; $passangers = ''; }
								
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
				}	
				
				$downloadable_data = $this->download_motor_docs($vendor_info['vendor_id']); 
				
				
					$array['motor_vendor_details'][$vendor_info['vendor_id']] = array(
				
										'company_name' => $company_name,
										'vehicle_type' => $vehicle_type,
										'total'   => $total,
										'post_val' => $_POST,
										'downloadable_data' => $downloadable_data,
										'summary_benefits' => array(
															'PAB_driver' => $driver,
															'RSA' => $RSA,
															'PAB_passangers' => $passangers,
															'rent_car' => $Rentacar
										)
									);
					
				
			}
			
		$this->load->view('motor_result_view',$array);
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
			
				if($this->input->post('vehicletype') == 1){ $vehicle_type = 'Buses(abv 15 seats)'; } elseif($this->input->post('vehicletype') == 2){ $vehicle_type = 'Heavy Vehicles'; }elseif($this->input->post('vehicletype') == 3){ $vehicle_type = 'Saloon'; }elseif($this->input->post('vehicletype') == 4){ $vehicle_type = 'Sports'; }elseif($this->input->post('vehicletype') == 5){ $vehicle_type = 'Stationwagon'; }elseif($this->input->post('vehicletype') == 6){ $vehicle_type = 'Vans,Buses(upto 15 seats)'; }

		
			$current_year_val = $this->input->post('current_year_val');
			
				foreach($final_res as $vendor_info){
					
				  $vendor_charges = $this->db->query("SELECT vec.*,wc.company_name FROM tu_vendor_excluded_cars as vec INNER JOIN wl_customers as wc ON vec.vendor_id = wc.customers_id WHERE vec.vendor_id = '".$vendor_info['vendor_id']."'")->result_array();
					
					$add = 0;
					
					$current_year_charges = $current_year_val  * $vendor_info['premium_value']  / 100 ;
					
					if($this->input->post('type_check') == 'comp'){
						
						foreach($vendor_charges as $vc){
							
							$company_name = $vc['company_name'];
							
							if($vc['PAB_driver'] != '' && $vc['RSA'] != '' && $vc['PAB_passanger'] != '' && $vc['ADD_rent_car'] != '' ){
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

				$Message['status'] = array('success' => 'SERVICE BOOKED SUCCESSFULLY');
			}
		}else{
				$Message['status'] = array('error' => 'Fake Entry Modified Not Exists'); ;
		}
		
		$this->load->view('motor_payment_view',$Message);
			
	}
	
	public function book_upload_doc(){
			
			if($_FILES['file1']['name'] != '' ){
				
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
			if($_FILES['file2']['name'] != ''){
				
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
			if($_FILES['file3']['name'] != ''){
				
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
		/* echo '<pre>';
		print_r($_POST);
		
		exit; */
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
					
				$this->db->insert('tu_save_book_motor',array('vendor_id'=> $vendor_id,'user_id'=>$user_id,'service_type'=>$_POST['type_check'],'vehicle_type'=>$_POST['vehicletype'],'driving_licence' => $_POST['Driving_Licence'],'driver_age'=>$_POST['driver_age'],'r_emirate'=>$_POST['emirates'],'gcc'=>$_POST['gcc_status'],'agency_type'=>$_POST['agencytype'],'current_year_value'=> $_POST['current_year_val'],'PAB_driver'=>$_POST['PAB_driver'],'RSA'=>$_POST['RSA'],'PAB_passangers'=>$pfa_pass,'ADD_rent_car'=>$_POST['ADD_rent_car'],'noofcilender'=>$noofcilender,'total'=>0,'doc1'=> '','doc2'=> '','doc3'=> '','flag'=>'S'));

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
	
	
	public function check_user_auth_login(){
		
		if ( !$this->auth->is_user_logged_in() )
		{
			redirect('/users', '');
		} else{
			redirect('/members/myaccount', '');
		}
	
	}
}






?>