<?php  

class healthinsurance extends MX_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('date','language','string','cookie','file','download'));	
		$this->load->library(array('safe_encrypt','securimage_library','Auth','Dmailer','cart'));
	}
	
	
	public function index(){
		
		$user_info = $this->session->all_userdata();
		$user_id = $user_info['user_id']; 
		$user_email = $user_info['username']; 
		
		$this->load->view('healthinsurance_view');
		
	}
	
	public function health_result(){
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){}else{redirect('/healthinsurance', '');}
		/* if(!empty($this->input->post())
			redirect('/healthinsurance', '');
			return false; */
		
		
		$country_id = trim($_POST['country_id']);
		$plan_id = trim($_POST['plan_id']);
		$res_array = array();
		
		$res_array['show_post_data'] = $this->db->query("Select vp.vendor_id,wc.company_name,vp.vendor_plan_id,vp.vendor_country_id,vp.vendor_plan_doc FROM tu_vendor_plans as vp INNER JOIN wl_customers wc ON wc.customers_id = vp.vendor_id where vp.vendor_country_id = '".$country_id."' and vp.vendor_plan_id = '".$plan_id."'")->result_array();
		
		foreach($res_array['show_post_data'] as $vendor_id){
			
			foreach($_POST['userdata'] as $user_info){
				
				$age = date_diff(date_create($user_info['dob']), date_create('today'))->y;
				
				$sql = mysql_query("select * FROM tu_age_range")or die(mysql_error());
				
				while($ass = mysql_fetch_assoc($sql)){
					
					$age_start = $ass['age_start'];
					$age_end   = $ass['age_end'];
					
					if($age === min(max($age,$age_start),$age_end)){
						$between_string = $age_start.'-'.$age_end;
					}
				}
				
				$sql_find_age_id = $this->db->query("select ar.age_id,pv.premium_value,pv.vendor_id FROM tu_age_range as ar INNER JOIN tu_premium_value as pv ON ar.age_id = pv.age_id WHERE ar.age = '".$between_string."' and pv.vendor_id = '".$vendor_id['vendor_id']."' and ar.gender = '".$user_info['gender']."' and pv.country_id = '".$country_id."' and pv.plan_id = '".$plan_id."' ")->result_array();
					
					if(!empty($sql_find_age_id)){ 
					$tot = 0;
					foreach($sql_find_age_id as $pv){
							$age_id = $pv['age_id'];
							$tot += $age_id;
							$premium_value = $pv['premium_value'];
						}
						
						$res_array['total'][$vendor_id['vendor_id']][] =  $premium_value .'</br>';
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
		
		//echo '<pre>'; print_r($res_array);exit;
		$this->load->view('health_result_view',$res_array);
	}
	
	
	
	public function book_health_service(){
		
		$user_info = $this->session->all_userdata();
		$user_id = $user_info['user_id'];
			
		if($user_id == ''){
			
			redirect('/users', '');
			
			
		}	
		
		if ($this->input->server('REQUEST_METHOD') == 'POST'){}else{redirect('/healthinsurance', '');}
		/* if(empty($this->input->post())){
			redirect('/healthinsurance', '');
			return false;
		} */
		
		if($_FILES['file1']['name']){
				
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
			if($_FILES['file2']['name']){
				
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
			if($_FILES['file3']['name']){
				
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
			
			$this->book($_POST);
			/* ALL ENTRIES OF CUSTOMERS HERE */
			
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
	
	public function book($data){
		
		$vendor_id = $data['vendor_id1'];
		$country_id = $data['vendor_country_id1'];
		$plan_id = $data['vendor_plan_id1'];
		
		$user_info = $this->session->all_userdata();
		$user_id = $user_info['user_id'];
		
			foreach($_SESSION['save_p_data'] as $user_info){
				
				$age = date_diff(date_create($user_info['dob']), date_create('today'))->y;
				
				$sql = mysql_query("select * FROM tu_age_range")or die(mysql_error());
				
				while($ass = mysql_fetch_assoc($sql)){
					
					$age_start = $ass['age_start'];
					$age_end   = $ass['age_end'];
					
					if($age === min(max($age,$age_start),$age_end)){
						$between_string = $age_start.'-'.$age_end;
					}
				}
				
				$sql_find_age_id = $this->db->query("select ar.age_id,pv.premium_value,pv.vendor_id FROM tu_age_range as ar INNER JOIN tu_premium_value as pv ON ar.age_id = pv.age_id WHERE ar.age = '".$between_string."' and pv.vendor_id = '".$vendor_id."' and ar.gender = '".$user_info['gender']."' and pv.country_id = '".$country_id."' and pv.plan_id = '".$plan_id."' ")->result_array();
					
					//print_r($sql_find_age_id);
					
					if(!empty($sql_find_age_id)){ 
							$tot = 0; $premium_v = array();
						foreach($sql_find_age_id as $pv){
							$age_id = $pv['age_id'];
							$tot += $age_id;
							$premium_v[] = $pv['premium_value'];
						}
												
					}else{
						$premium_value = 'AGE BETWEEN '.$between_string.' PREMIUM VALUE IS NOT DEFINED BY VENDOR';
					}
				
				/* $c = array_map(function () {
					return array_sum(func_get_args());
				}, $a, $b);

				print_r($c);

				echo '<pre>';
				print_r($premium_v); */
				
				
			$this->db->insert('tu_save_book_health',array('vendor_id'=> $vendor_id,'user_id'=> $user_id,'Customer_name' =>   $user_info['member_user_name'],'dob'=> $user_info['dob'], 'gender'=> $user_info['gender'],'country_id' => $country_id, 'plan_id' => $plan_id,'flag' => 'B' ,'total_premium_val' => 110));
				
			}
		
			
		
	}
		
		//$this->load->view('health_save_view',$_POST);
	
	
	
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
	
	
	/* public function check_user_auth_login(){
		
		if ( !$this->auth->is_user_logged_in() )
		{
			redirect('/users', '');
		} else{
			redirect('/members/myaccount', '');
		}
	
	} */
	
}






?>