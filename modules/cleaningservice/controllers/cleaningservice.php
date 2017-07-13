<?php 

class cleaningservice extends MX_Controller{
	
	public function __Construct(){
		
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file','download','get_health_motor_vals_helper'));	
		$this->load->library(array('safe_encrypt','securimage_library','Auth','Dmailer','cart'));
		$this->load->model('cleaning_model');
		
	}
	
	
	public function index(){
		
		redirect("/",'');
		$this->load->view('cleaning_view','');
		
	}
	
	public function isWeekend($date){
		
		$weekday = date("w", strtotime($date));
		if($weekday == 5){
			$val = " and weekend_charges = ".$date;
		}else{
			$val = " and weekdays_charges = ".$date;
		}
		
		return $val;
	}
	
	
	public function concatequery($data){
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){}else{redirect('/cleaningservice', '');}
		if(!$this->input->post()){
			redirect('/cleaningservice', '');
		}
		
			$ftable = 'tu_cleaning';
			
			if($data['material_provide']){
				
				$material_provide = 1;
			}else{
				$material_provide = 0;
			}
			
			$age = date_diff(date_create($_POST['birth_date']), date_create('today'))->y;
			
			$sql = "SELECT * FROM ";
			$sql .= $ftable;
		
			if(!empty($data['emirate']) || !empty($data['noofhours']) || !empty($data['material_provide']) || !empty($data['premises']) || !empty($data['cleaning_date'])){
				$sql .= " WHERE ";
				$sql .= '1=1';
			}
			
			/* if($data['noofcleaners']){
				$nc = $this->input->post('noofcleaners');
				$sql .= " and num_of_cleaners = ".$nc;
			} */
			
			if($data['emirate']){
				$emirate = $this->input->post('emirate');
				$sql .= " and city = ".$emirate;
			} 
			
			if($data['sub_city']){
				$sub_city = $this->input->post('sub_city');
				$sql .= " and sub_city = ".$sub_city;
			}  
			
			if($data['material_provide']){
				$mp = $this->input->post('material_provide');
				$sql .= " and material = ".$material_provide;
			}
			
			if($data['premises']){
				$pt = $this->input->post('premises');
				$sql .= " and premises_type = '".$pt."'";
			}
			
			if($data['v_id']){
				$vendor_id = $this->input->post('v_id');
				$sql .= " and vendor_id = '".$vendor_id."'";
			}
			
			return $sql;
			
	}
	
	public function cleaning_post(){
		
		
		
		
		$sql = $this->concatequery($_POST);
			
		$cleaning_date = $this->input->post('cleaning_date');		
		$noofcleaners = $this->input->post('noofcleaners');		
		$noofhours = $this->input->post('noofhours');		
		$frequency =  $this->input->post('cleanerfreq');
		
		$result = $this->db->query($sql);
		$final_res = $result->result_array();
		
		//echo '<pre>'; print_r($final_res); 
		
		foreach($final_res as $calc){
			
			if($this->input->post('material') == 0){
				$material_cost = $calc['material_cost'];
			}else{
				$material_cost = 0;
			}
		
			$weekday = date("w", strtotime($cleaning_date));
			if($weekday == 5){ $charges = $calc['weekend_charges']; }else{ $charges = $calc['weekdays_charges']; }

			$labour_charges = $charges;
			
			if($noofhours >= $calc['discount_min_hour']){
				$discount_apply = $calc['discount_charges'];
			}else{
				$discount_apply = 0;
			}
			
			$total = ($material_cost  +	$labour_charges) * $noofhours * $noofcleaners * $frequency ;
		 
			$final = $total - ($total * $discount_apply / 100);
			
			$company_query = $this->db->query("SELECT company_name FROM wl_customers WHERE customers_id = '".$calc['vendor_id']."'")->result_array();
			$company_vendor_doc = $this->db->query("SELECT vendor_doc FROM tu_cleaning WHERE vendor_id = '".$calc['vendor_id']."' and vendor_doc != '' ")->result_array();
			
			//print_r($company_query[0]['company_name']);exit;
			
			$data['cleaning_calculation'][$calc['vendor_id']] = array(
		
					'vendor_id'    => $calc['vendor_id'],
					'company_name' => $company_query[0]['company_name'],
					'city'		   => $calc['city'], 
					'sub_city'	   => $calc['sub_city'],
					'material_cost'=> $material_cost,
					'vendor_doc'   => $company_vendor_doc[0]['vendor_doc'],
					'total'		   => $final
			);
			
			$data['detail_information'][$calc['vendor_id']] = array(
						'company_name'  => $company_query[0]['company_name'],
						'cleaning_date' => $cleaning_date,
						'city'		   => $calc['city'], 
						'cleanerfreq'	=> $frequency,
						'noofcleaners'  => $noofcleaners,
						'noofhours' 	=> $noofhours,
						'emirate'		=> $this->input->post('emirate'), 
						'sub_city'		=> $this->input->post('sub_city'),
						'material_provide'	=> $this->input->post('material_provide'),
						'material_cost'	=> $material_cost,
						'premises' 		 => $this->input->post('premises'),
						'discount_charge'=> $calc['discount_charges'],
						'discount_min_hour'	=> $calc['discount_min_hour']
			);
			
		}
		
		
		$this->load->view('cleaning_result_view',$data);
		
	}
	
	
	 public function download(){
		
		$file_path = $this->input->post('file_download');
		
		$ext = pathinfo($file_path, PATHINFO_EXTENSION);
		$file = basename($file_path, ".".$ext);

		$data = file_get_contents($file_path);
		$name = $file.'.'.$ext;
		
		force_download($name, $data);
		
	} 
	
	public function book_upload_doc(){
			
			if(!empty($_FILES['file1']['name'])){
				
				$config['upload_path'] = './assets/cleaning_doc/customer_docs'; 
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
				
				$config['upload_path'] = './assets/cleaning_doc/customer_docs'; 
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
				
				$config['upload_path'] = './assets/cleaning_doc/customer_docs'; 
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
	
	
	public function book_cleaning_service(){
		
			$this->book_upload_doc();
		
			$config['upload_path'] = './assets/cleaning_doc/customer_docs'; 
			$vendor_id = $_POST['v_id'];
			$file1 = $_FILES['file1']['name']=='' ? '' : $config['upload_path'] .'/'.$_FILES['file1']['name'];
			$file2 = $_FILES['file2']['name']=='' ? '' : $config['upload_path'] .'/'.$_FILES['file2']['name'];
			$file3 = $_FILES['file3']['name']=='' ? '' : $config['upload_path'] .'/'.$_FILES['file3']['name'];
		
			//echo '<pre>'; print_r($_POST); exit;
		
			$sql = $this->concatequery($_POST);
		
			$result = $this->db->query($sql);
			$final_res = $result->result_array();
			
			$cleaning_date = $this->input->post('cleaning_date');		
			$noofcleaners = $this->input->post('noofcleaners');		
			$noofhours = $this->input->post('noofhours');
			$frequency =  $this->input->post('cleanerfreq');
			$material_provided = $this->input->post('material_provide');
			
			//echo '<pre>'; print_r($final_res);  exit;
			
			if(count($final_res)){
			
				foreach($final_res as $calc){
				
					if($material_provided == 0){
						$material_cost = $calc['material_cost'];
					}else{
						$material_cost = 0;
					}
				
					$weekday = date("w", strtotime($cleaning_date));
					if($weekday == 5){ $charges = $calc['weekend_charges']; }else{ $charges = $calc['weekdays_charges']; }

					$labour_charges = $charges;
					
					if($noofhours >= $calc['discount_min_hour']){
						$discount_apply = $calc['discount_charges'];
					}else{
						$discount_apply = 0;
					}
					
					
					$total = ($material_cost  +	$labour_charges ) * $noofhours * $noofcleaners * $frequency ;
				 
					$final = $total - ($total * $discount_apply / 100);
					
					$user_info = $this->session->all_userdata();
					$user_id = $user_info['user_id'];
						
					if($this->input->post('sub_city') == ''){ $sub_emirate = 0;   }else{ $sub_emirate = $this->input->post('sub_city'); }	
						
					///echo $final;
				}
				
				//exit;
			$this->db->insert('tu_save_book_cleaning',array('vendor_id'=> $vendor_id,'user_id'=>$user_id,'emirate_id'=>$this->input->post('emirate'),'sub_emirate'=>$sub_emirate,'material_provided' =>$material_provided,'cleaning_date'=>$cleaning_date,'noc'=>$noofcleaners,'noh'=>$noofhours,'frequency'=>$frequency,'premises'=> $this->input->post('premises'),'total'=>$final,'doc1'=> $file1,'doc2'=> $file2,'doc3'=> $file3,'flag'=>'B')); 
				
		 $lid = $this->db->insert_id();
						
		 $this->db->insert('manage_quote' ,array('mq_vendor_id' => $vendor_id,'mq_user_id' => $user_id, 'mq_post_date' => $cleaning_date, 'mq_kind_of_request' => $user_info['usertype'],'mq_request_from' => $user_info['member_user_name'],'mq_request_to' => $vendor_id,'mq_quote_via' => '','mq_state_of_quote' => 'B','mq_product' => 'Cleaning','mq_subproduct' => $this->input->post('emirate').' | '.$sub_emirate.' | '.$material_provided.' | '.$cleaning_date.' | '.$noofcleaners.' | '.$noofhours.' | '.$frequency.' | '.$this->input->post('premises'),'mq_orderstatus' => 4,'mq_proof_attachment' => $file1.'~'.$file2.'~'.$file3,'mq_action_status' => '','mq_qbs_id' => $lid,'mq_total_quote' => $final , 'mq_feedback' =>''));

					$Message['status'] = array('success' => 'SERVICE BOOKED SUCCESSFULLY');
				
				$this->send_mail_customer($final,$_POST);
				
			}else{
				
				$Message['status'] = array('error' => 'Fake Entry Modified Not Exists'); ;
			}
			
			$this->load->view('cleaning_payment_view',$Message);
		
	}			
	
	public function get_vendor_name_from_id($vendor_id){	
		$query =  $this->db->query("SELECT company_name FROM wl_customers WHERE customers_id = '".$vendor_id."'")->row();	
		return $query->company_name;	
	}
	
	public function send_mail_customer($total,$data){	
				
			//echo '<pre>'; print_r($data); exit;	
				
		/*	$to = 'summit0987@gmail.com';			
			$from = 'sales@teluscare.com';			
			$message = '<html><body><table>';				

			$message .="<tr><td><h3>Company Info</h3></td></tr>";		
			$message .="<tr><td>Company Name:</td><td>".$data['company_name']."</td></tr>";	
			$message .="<tr><td>Cleaning date</td><td><h2>".$data['cleaning_date']."</h2></td></tr>";	
			$message .="<tr><td><h3>Booking Info</h3></td></tr>";			
			$message .="<tr><td>No Of Frequency</td><td>".get_frequency($data['cleanerfreq'])."</td></tr>";	
			$message .="<tr><td>No Of Cleaners</td><td>".get_number_of_cleaners($data['noofcleaners'])."</td></tr>";
			$message .="<tr><td>No Of Hours</td><td>".get_number_of_hours($data['noofhours'])."</td></tr>";
			$message .="<tr><td>Material provided</td><td>".get_material_provide($data['material_provide'])."</td></tr>";
			$message .="<tr><td>Emirate</td><td>".get_emirate_name_by_id($data['emirate'])."</td></tr>";
			$message .="<tr><td>Premises</td><td>".get_premises_name($data['premises'])."</td></tr>";		
			
			$message .="<tr><td><h3>Total Premium</h3></td><td>".$total."</td></tr>";
			$message .= '</table></body></html>';				
				
				$subject = 'Cleaning Service';				
				$headers .= "MIME-Version: 1.0\r\n";	
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";		
			
				$mail = mail($to,$subject,$message,$headers);				
				if($mail === true){							
				//echo 'mail Sent successfully';			
				}else{						
				//echo 'Error';		
				}*/		
	}
	
	
	public function book_view(){
		
		$this->load->view('cleaning_book_view');
		
	}
	
	public function save_cleaning_service(){
		
			$vendor_id = $_POST['v_id'];
			$file1 = '';
			$file2 = '';
			$file3 = '';
		
			//echo '<pre>'; print_r($_POST); exit;
		
			$sql = $this->concatequery($_POST);
		
			$result = $this->db->query($sql);
			$final_res = $result->result_array();
			
			$cleaning_date = $this->input->post('cleaning_date');		
			$noofcleaners = $this->input->post('noofcleaners');		
			$noofhours = $this->input->post('noofhours');
			$frequency =  $this->input->post('cleanerfreq');
			$material_provided = $this->input->post('material_provide');
			
			if(count($final_res)){
			
				foreach($final_res as $calc){
				
				if($material_provided == 0){
					$material_cost = $calc['material_cost'];
				}else{
					$material_cost = 0;
				}
			
				$weekday = date("w", strtotime($cleaning_date));
				if($weekday == 5){ $charges = $calc['weekend_charges']; }else{ $charges = $calc['weekdays_charges']; }

				$labour_charges = $charges;
				
				if($noofhours >= $calc['discount_min_hour']){
					$discount_apply = $calc['discount_charges'];
				}else{
					$discount_apply = 0;
				}
				
				
				$total = ($material_cost  +	$labour_charges ) * $noofhours * $noofcleaners * $frequency ;
			 
				$final = $total - ($total * $discount_apply / 100);
				
				//echo $final;
				
				$user_info = $this->session->all_userdata();
				$user_id = $user_info['user_id'];
					
				if($this->input->post('sub_city') == ''){ $sub_emirate = 0;   }else{ $sub_emirate = $this->input->post('sub_city'); }	
					
				}
				
				$this->db->insert('tu_save_book_cleaning',
					array(
					'vendor_id'=> $vendor_id,
					'user_id'=>$user_id,
					'emirate_id'=>$this->input->post('emirate'),
					'sub_emirate'=>$sub_emirate,
					'material_provided' =>$material_provided,
					'cleaning_date'=>$cleaning_date,
					'noc'=>$noofcleaners,
					'noh'=>$noofhours,
					'frequency'=>$frequency,
					'premises'=> $this->input->post('premises'),
					'total'=>$final,
					'doc1'=> $file1,'doc2'=> $file2,'doc3'=> $file3,
					'flag'=>'S'));
				
				    $lid = $this->db->insert_id();
						
				 $this->db->insert('manage_quote' ,array('mq_vendor_id' => $vendor_id,'mq_user_id' => $user_id, 'mq_post_date' => $cleaning_date, 'mq_kind_of_request' => $user_info['usertype'],'mq_request_from' => $user_info['member_user_name'],'mq_request_to' => $vendor_id,'mq_quote_via' => '','mq_state_of_quote' => 'S','mq_product' => 'Cleaning','mq_subproduct' => $this->input->post('emirate').' | '.$sub_emirate.' | '.$material_provided.' | '.$cleaning_date.' | '.$noofcleaners.' | '.$noofhours.' | '.$frequency.' | '.$this->input->post('premises'),'mq_orderstatus' => 4,'mq_proof_attachment' => '','mq_action_status' => '','mq_qbs_id' => $lid,'mq_total_quote' => $final , 'mq_feedback' =>''));
		
				$Message['status'] = array('success' => 'SERVICE SAVED SUCCESSFULLY');
				
			}else{
				
				$Message['status'] = array('error' => 'Fake Entry Modified Not Exists'); ;
			}
			
			$this->load->view('cleaning_save_view',$Message);
		
	}
	
	
	
	
	
}



?>