<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Auth
{
	public $ci;
	public function __construct()
	{
	   if (!isset($this->ci))
	   {
			$this->ci =& get_instance();
	   }		
	   $this->ci->load->library('safe_encrypt');
	   $this->ci->load->helper('cookie');
	   $this->auth_tbl = 'wl_customers';
	  
	}	
	
	public function is_user_logged_in()
	{
		$is_logged_in = $this->ci->session->userdata('logged_in');
		$logged_in_username = $this->ci->session->userdata('username');
		if ($is_logged_in == TRUE)
		{
			 $user_data = array(
			   'user_name'=>$logged_in_username,			  
			   'status'=>'1'	
			   );						 
			 $num = $this->ci->db->get_where($this->auth_tbl,$user_data)->num_rows();
			 return ($num) ? true : false;
			
		}
		else
		{
			return false;
		}
	}
	
	public function is_auth_user()
	{
		if ($this->is_user_logged_in()!= TRUE)
		{
			$this->logout();
			redirect('home', '');
			
		}
	}
	
    public function update_last_login($login_data)
	{		
		
		$data = array(
						'last_login_date'=>$login_data['current_login'],
						'current_login'=>$this->ci->config->item('config.date.time') 
					  );
		$this->ci->db->where('customers_id', $this->ci->session->userdata('user_id'));
		$this->ci->db->update($this->auth_tbl, $data);
	}
		
	
   public function verify_user($username,$password,$status='1')
   {	   		
   
        $password = $this->ci->safe_encrypt->encode($password);
					
		$this->ci->db->select("customers_id,user_name,
		first_name,last_name,title,is_blocked,
		last_login_date,current_login,block_time",FALSE);
		
		$this->ci->db->where('user_name', $username);
		$this->ci->db->where('password', $password);
		$this->ci->db->where('status', $status);	
		$this->ci->db->where('is_verified','1');

		$login_type = $this->ci->input->post('login_usertype');
		if($login_type==2)
		{
		  $user_no = $this->ci->input->post('login_user_no');
		  $user_no = $this->ci->db->escape_str($user_no);
		  $this->ci->db->where('user_no', $user_no);
		  $this->ci->db->where('user_type','2');
		}
		else
		{
		  $this->ci->db->where('user_type','1');
		}		
		$query = $this->ci->db->get($this->auth_tbl);
		//echo $this->ci->db->last_query();
		
		if ($query->num_rows() == 1)
		{
			
			$row  = $query->row_array();
            $name = $row['first_name'].$row['last_name'];		
			$data = array(
					'user_id'=>$row['customers_id'],
					'username'=>$row['user_name'],											
					'user_type'=>$row['user_type'],
					'title'=>$row['title'],
					'first_name'=>$row['first_name'],
					'last_name'=>$row['last_name'],							
					'is_blocked'=>$row['is_blocked'],	
					'blocked_time'=>$row['block_time'],						
					'logged_in' => TRUE
				);
						
			$login_data = array('current_login'=>$row['current_login']);			
			$this->ci->session->set_userdata($data);			
			$this->update_last_login($login_data);	
			return TRUE;
			
		}else{
			
			  return FALSE;
			
			
		}
		
	}
	
	
	/** 
	* Logout - logs a user out
	* @access public
	*/
	
	 public function logout()
	 {		
		 
				
			$userId = $this->ci->session->userdata('user_id');
				
			if($userId!='' && $userId > 0 )
			{
				if ($this->ci->db->table_exists('tbl_user_online'))
				{   

			      $this->ci->db->query("DELETE FROM tbl_user_online WHERE user_id =".$userId." ");
			   
				}
			}
			
			$data = array('user_id' => 0,
						  'type'=> 0,
						  'user_type'=>0,
						  'username' => 0,
						  'name'=>0,
						  'mkey'=>0,
						  'is_blocked'=>0,
						  'blocked_time'=>0,						  
						  'logged_in' => FALSE
						);
			 $this->ci->session->unset_userdata($data);
			//$this->ci->session->sess_destroy();           
			
		 
	 }	 
	 
	 
	  
 	
	
}