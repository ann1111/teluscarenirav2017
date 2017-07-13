<?php  

class healthinsurance extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file','download','get_health_motor_vals'));	
		$this->load->library(array('safe_encrypt','securimage_library','Auth','Dmailer','cart'));
	}
	
	
	public function index(){
		redirect('/','');
		$this->load->view('healthinsurance_view');
		
	}
	
	public function health_result(){
		
		//echo '<pre>'; print_r($_POST); exit;
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){}else{redirect('/healthinsurance', '');}
		
		$country_id = trim($_POST['country_id']);
		$plan_id = trim($_POST['plan_id']);
		$res_array = array();
		$benefits = trim($_POST['benefits']);
		
		$res_array['show_post_data'] = $this->db->query("Select vp.vendor_id,wc.company_name,vp.vendor_plan_id,vp.vendor_country_id,vp.vendor_plan_doc FROM tu_vendor_plans as vp INNER JOIN wl_customers wc ON wc.customers_id = vp.vendor_id where vp.vendor_country_id = '".$country_id."' and vp.vendor_plan_id = '".$plan_id."'")->result_array();
		
		//print_r($res_array['show_post_data']);exit;
		
		foreach($res_array['show_post_data'] as $vendor_id){
			
			foreach($_POST['userdata'] as $user_info){
				
				//$age = date_diff(date_create($user_info['dob']), date_create('today'))->y;
				
				$age = (date('Y') - date('Y',strtotime($user_info['dob'])));
				
				$sql = mysql_query("select * FROM tu_age_range")or die(mysql_error());
				
				while($ass = mysql_fetch_assoc($sql)){
					
					$age_start = $ass['age_start'];
					$age_end   = $ass['age_end'];
					
					if($age === min(max($age,$age_start),$age_end)){
						$between_string = $age_start.'-'.$age_end;
					}
				}
				
				$sql_find_age_id = $this->db->query("select ar.age_id,pv.premium_value,pv.dental_rate,pv.maternity_rate,pv.eye_rate,pv.vendor_id FROM tu_age_range as ar INNER JOIN tu_premium_value as pv ON ar.age_id = pv.age_id WHERE ar.age = '".$between_string."' and pv.vendor_id = '".$vendor_id['vendor_id']."' and ar.gender = '".$user_info['gender']."' and pv.country_id = '".$country_id."' and pv.plan_id = '".$plan_id."' ")->result_array();
					
					if(!empty($sql_find_age_id)){ 
					$tot = 0;
					foreach($sql_find_age_id as $pv){
						
						if($benefits == 'dental'){
							$addon_rate = $pv['dental_rate'];
						}elseif($benefits == 'maternity'){
							$addon_rate = $pv['maternity_rate'];
						}elseif($benefits == 'Eye'){
							$addon_rate = $pv['eye_rate'];
						}else{
							$addon_rate = 0;
						}
						
							$age_id = $pv['age_id'];
							$tot += $age_id;
							$premium_value = $pv['premium_value'];
						}
						
						$res_array['addOns'][$vendor_id['vendor_id']][$benefits] = $addon_rate;
						$res_array['total'][$vendor_id['vendor_id']][] = $addon_rate + $premium_value;
						$res_array['vendor_plan_doc'][$vendor_id['vendor_id']][] =  $vendor_id['vendor_plan_doc'];
						
						
					}else{
						$premium_value = 'AGE BETWEEN '.$between_string.' PREMIUM VALUE IS NOT DEFINED BY VENDOR';
					}
				
				$res_array['user_value'][$vendor_id['vendor_id']][] = array(
					'age_id'		=> $age_id,
					'user_name' 	=> $user_info['member_user_name'],
					'age'        	=> $age,
					'gender' 	 	=> $user_info['gender'],
					'Premium_value' => $premium_value,
					'tot'			=> $tot
					
				);
				
			}
			
		}
		
		$_SESSION['save_p_data'] = $_POST['userdata'];
		$_SESSION['save_p_country_id'] = $country_id;
		$_SESSION['save_p_plan_id'] = $plan_id;
		$_SESSION['save_p_benefits'] = $_POST['benefits'];
		
		//echo '<pre>'; print_r($res_array);exit;
		$this->load->view('health_result_view',$res_array);
	}
	
	
	
	public function book_health_service(){
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){}else{redirect('/healthinsurance', '');}
		
		$user_info = $this->session->all_userdata();
		$user_id = $user_info['user_id'];
			
		if($user_id == ''){
			
			redirect('/users', '');
			
		}
		
		if(!empty($_FILES['file1']['name'])){
				
				$config['upload_path'] = './assets/health_doc/customer_docs'; 
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
				
				$config['upload_path'] = './assets/health_doc/customer_docs'; 
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
				
				$config['upload_path'] = './assets/health_doc/customer_docs'; 
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
			
			$this->book($_POST,$file_path1,$file_path2,$file_path3);
			
			$this->load->view('health_payment_view',$_POST);
	}
	
	 public function save(){
	 	
		$user_info = $this->session->all_userdata();
		$user_id = $user_info['user_id'];
			
		if($user_id == ''){
			redirect('/users', '');
		}	
		
		$vendor_id = $_POST['vendor_id'];
		$country_id = $_POST['country_id'];
		$plan_id = $_POST['plan_id']; 
		
		if($_SESSION['save_p_data']){
			
		$chk_plan_exist = $this->db->query("SELECT * FROM tu_vendor_plans WHERE vendor_id = '".$vendor_id."' and vendor_plan_id = '".$plan_id."' and vendor_country_id = '".$country_id."' ");
		
		
			if($chk_plan_exist->num_rows()){
				
				$user_info = $this->session->all_userdata();
				$user_id = $user_info['user_id']; 
				$user_email = $user_info['username']; 
				
				
				foreach($_SESSION['save_p_data'] as $udata){
					
					$this->db->insert('tu_save_book_health',array('vendor_id'=> $vendor_id,'user_id'=> $user_id,'Customer_name' =>   $udata['member_user_name'],'dob'=> $udata['dob'], 'gender'=> $udata['gender'],'country_id' => $country_id, 'plan_id' => $plan_id,'flag' => 'S','total_premium_val' => 0));
					
					$lid = $this->db->insert_id();
							
				    $this->db->insert('manage_quote' ,array('mq_vendor_id' => $vendor_id,'mq_user_id' => $user_id, 'mq_post_date' => date('Y-m-d h:i:s',time()), 'mq_kind_of_request' => $user_info['usertype'],'mq_request_from' => $user_info['member_user_name'],'mq_request_to' => $vendor_id,'mq_quote_via' => '','mq_state_of_quote' => 'S','mq_product' => 'Insurance','mq_subproduct' => $plan_id,'mq_orderstatus' => 4,'mq_proof_attachment' => '','mq_action_status' => '','mq_qbs_id' => $lid,'mq_feedback' =>''));
				}
				
				$message['status'] = array('success' => 'Data Added Successfully');
				
			}else{
				
				echo 'plan is not exist post values are fake';
			}
		
		}else{
			
			$message['status']  = array('success' => '');
		}
		
		$this->load->view('health_save_view',$message);
	
	} 
	
	public function book_view(){
		
		
		$this->load->view('health_book_view',$_POST);
		
	}
	
	public function book($data,$file1,$file2,$file3){
		
		$vendor_id = $data['vendor_id1'];
		$country_id = $data['vendor_country_id1'];
		$plan_id = $data['vendor_plan_id1'];
		$benefits = trim($data['benefits']);
		
	//	echo'<pre>';print_r($data);exit;
		$user_info = $this->session->all_userdata();
		$user_id = $user_info['user_id'];
		
		$get_last_id_to_add = $this->db->query("SELECT MAX(group_id) as num FROM tu_save_book_health")->row_array();
			$ins_id = $get_last_id_to_add['num'] + 1;
						
						
			foreach($_SESSION['save_p_data'] as $user_info){
				
				//$age = date_diff(date_create($user_info['dob']), date_create('today'))->y;
				
				$age = (date('Y') - date('Y',strtotime($user_info['dob'])));
				
				$sql = mysql_query("select * FROM tu_age_range")or die(mysql_error());
				
				while($ass = mysql_fetch_assoc($sql)){
					
					$age_start = $ass['age_start'];
					$age_end   = $ass['age_end'];
					
					if($age === min(max($age,$age_start),$age_end)){
						$between_string = $age_start.'-'.$age_end;
					}
				}
				
				$sql_find_age_id = $this->db->query("select ar.age_id,pv.premium_value,pv.dental_rate,pv.maternity_rate,pv.eye_rate,pv.vendor_id FROM tu_age_range as ar INNER JOIN tu_premium_value as pv ON ar.age_id = pv.age_id WHERE ar.age = '".$between_string."' and pv.vendor_id = '".$vendor_id."' and ar.gender = '".$user_info['gender']."' and pv.country_id = '".$country_id."' and pv.plan_id = '".$plan_id."' ")->result_array();
					
					//print_r($sql_find_age_id);
					
					if(!empty($sql_find_age_id)){ 
					$tot = 0;
					foreach($sql_find_age_id as $pv){
						
					
						if($benefits == 'dental'){
							$addon_rate = $pv['dental_rate'];
						}elseif($benefits == 'maternity'){
							$addon_rate = $pv['maternity_rate'];
						}elseif($benefits == 'Eye'){
							$addon_rate = $pv['eye_rate'];
						}else{
							$addon_rate = 0;
						}
						
							$age_id = $pv['age_id'];
							$tot += $age_id;
							$premium_value = $pv['premium_value'];
						}
						
						$total_array = array();
						$total_array['total'][$vendor_id][] = $premium_value;
						
						
						//print_r($get_last_id_to_add['num']);exit;
						$tot = 0;
						foreach($total_array['total'][$vendor_id] as $tpta){
							
							$this->db->insert('tu_save_book_health',array('vendor_id'=> $vendor_id,'user_id'=> $user_id,'group_id'=>$ins_id,'Customer_name' =>   $user_info['member_user_name'],'dob'=> $user_info['dob'], 'gender'=> $user_info['gender'],'country_id' => $country_id, 'plan_id' => $plan_id,'doc1'=>$file1,'doc2'=>$file2,'doc3'=>$file3,'flag' => 'B' ,'total_premium_val' => $tpta));
							
							$lid = $this->db->insert_id();
							
							$this->db->insert('manage_quote' ,array('mq_vendor_id' => $vendor_id,'mq_user_id' => $user_id, 'mq_post_date' => date('Y-m-d h:i:s',time()), 'mq_kind_of_request' => $user_info['usertype'], 'mq_kind_of_request' => $user_info['usertype'],'mq_request_from' => $user_info['member_user_name'],'mq_request_to' => $vendor_id,'mq_quote_via' => '','mq_state_of_quote' => 'B','mq_product' => 'Insurance','mq_subproduct' => $plan_id,'mq_orderstatus' => 4,'mq_proof_attachment' => $file1.'~'.$file2.'~'.$file3,'mq_action_status' => '','mq_qbs_id' => $lid,'mq_total_quote' => $tpta,'mq_feedback' =>''));

						}
						
					}else{
						$premium_value = 'AGE BETWEEN '.$between_string.' PREMIUM VALUE IS NOT DEFINED BY VENDOR';
					}
				
			}
			
			/* GET ALL GROUP BY PREMIUM VALUE */
					$get_last_id = $this->db->query("SELECT * FROM tu_save_book_health WHERE group_id = '".$ins_id."' ")->result_array();
							
					$prem = 0;
					
					foreach($get_last_id as $get_total_prem){
						$prem += $get_total_prem['total_premium_val'];
						}
					
					$this->db->insert('tu_health_group_premium',array('group_id'=>$ins_id,'add_on_rate' =>   $addon_rate,'total_premium'=> $prem));

					if($this->db->insert_id()){	
						$this->send_mail_customer($premium_v,$vendor_id,$country_id,$plan_id);		
					} 
				
	}
	
	
	
	
	public function get_vendor_name_from_id($vendor_id){		
	$query =  $this->db->query("SELECT company_name FROM wl_customers WHERE customers_id = '".$vendor_id."'")->row();	
	return $query->company_name;	}		
	
	
	public function send_mail_customer($premium_v,$vendor_id,$country_id,$plan_id){	
	
	foreach($_SESSION['save_p_data'] as $user_info){
		
	$messages_members .= "<tr><td>Gender:</td><td>".$user_info['gender']."</td><td>Member Name:</td><td>".$user_info['member_user_name']."</td><td>DOB:</td><td>".$user_info['dob']."</td></tr>";	
	}				
		
		$to = 'niravphp1111@gmail.com';			
		$from = 'sales@teluscare.com';		
		$vendor_company_name = $this->get_vendor_name_from_id($vendor_id);	
		$message = '<html><body><table>';		
		$message .="<tr><td><h3>Company Info</h3></td></tr>";	
		$message .="<tr><td>Company Name:</td><td>".$vendor_company_name."</td></tr>";	
		$message .="<tr><td>Country</td><td>".get_emirate_name($country_id)."</td></tr>";	
		$message .="<tr><td>Health Plan</td><td>".get_health_plan($plan_id)."</td></tr>";	
		$message .="<tr><td><h3>Members</h3></td></tr>";				
		$message .= $messages_members;					
		$message .="<tr><td><h3>Total Premium</h3></td><td>".$premium_v."</td></tr>";
		$message .= '</table></body></html>';								
		$subject = 'Health Insurance';		

		$headers .= "MIME-Version: 1.0\r\n";	
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";		
		$mail = mail($to,$subject,$message,$headers);				
		if($mail === true){		
		//	echo 'mail Sent successfully';			
		}else{			
		//echo 'Error';		
		} 
	}
	
	
	
	public function chk_valid_file(){
		
		$config['upload_path'] = './assets/health_doc/customer_docs'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg|txt|pdf|doc';
               
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
		
	}
	
	public function download(){
		
		$file_path = $this->input->post('file_download');
		$ext = pathinfo($file_path, PATHINFO_EXTENSION);
		$file = basename($file_path, ".".$ext);

		$data = file_get_contents($file_path);
		$name = $file.'.'.$ext;
		
		force_download($name, $data);
		
	}
	
}






?>