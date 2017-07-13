<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model
{

	/**
	* Get account by id
	*
	* @access public
	* @param string $account_id
	* @return object account object
	*/
	public function create_user()
	{
	
		$password = $this->safe_encrypt->encode($this->input->post('password',TRUE));
		$is_same_bill_ship =   $this->input->post('is_same',TRUE);
		$birth_date = 	($this->input->post('birth_date') !=''  ?  $this->input->post('birth_date') : null);	 
		$register_array = array
		( 	
			'user_type'        => '1',
			'user_name'        => $this->input->post('user_name',TRUE),
			'password'         => $password,
			'title'            => ($this->input->post('title') !=''  ?  $this->input->post('title') : null),
			'first_name'       => $this->input->post('first_name',TRUE),
			'last_name'        => ($this->input->post('last_name') !=''  ?  $this->input->post('last_name') : null),
			'birth_date'		=> $birth_date,
			'phone_number'		=> ($this->input->post('phone_number') !=''  ?  $this->input->post('phone_number') : null),
			'mobile_number'		=> ($this->input->post('mobile_number') !=''  ?  $this->input->post('mobile_number') : null),
			'fax_number'		=> ($this->input->post('fax_number') !=''  ?  $this->input->post('fax_number') : null),
			'country'		=> ($this->input->post('country') !=''  ?  $this->input->post('country') : null),
			'city'		=> ($this->input->post('city') !=''  ?  $this->input->post('city') : null),
			'state'		=> ($this->input->post('state') !=''  ?  $this->input->post('state') : null),
			'address'		=> ($this->input->post('address') !=''  ?  $this->input->post('address') : null),
			'zipcode'		=> ($this->input->post('zipcode') !=''  ?  $this->input->post('zipcode') : null),
			'actkey'           =>md5($this->input->post('user_name',TRUE)),
			'account_created_date'=>$this->config->item('config.date.time'),
			'current_login'    =>null,
			'status'=>'1',
			'is_verified'=>'1',									
			'ip_address'  =>$this->input->ip_address()
			
		);
		
	    $insId =  $this->safe_insert('wl_customers',$register_array,FALSE);
		
		return  $insId ;
	}

	public function create_vendor()
	{
		/* Create Meta URL */
		$company_name = $this->input->post('company_name');

		$pre_friendly_url = seo_url_title($company_name);

		$friendly_url = $pre_friendly_url;

		$unique_url = FALSE;

		while(!$unique_url)
		{
		  
		  $meta_qry  = $this->db->select('meta_id')->from('wl_meta_tags')->where(array('page_url'=>$friendly_url))->get();

		  if(!$meta_qry->num_rows())
		  {
			$unique_url = TRUE;
		  }
		  else
		  {
			$friendly_url = $pre_friendly_url."/".random_string();
		  }
		  

		}

		/* Create Meta URL Ends*/
	
		$password = $this->safe_encrypt->encode($this->input->post('password',TRUE));
		$is_same_bill_ship =   $this->input->post('is_same',TRUE);

		$birth_date = 	($this->input->post('birth_date') !=''  ?  $this->input->post('birth_date') : null);
		  
		$register_array = array
		( 			
			'friendly_url'     => $friendly_url,		
			'user_type'        => '2',
			'vendor_type'      => $this->input->post('vendor_type'),
			'ref_cat_id'        => $this->input->post('cat_id'),
			'user_name'        => $this->input->post('user_name',TRUE),
			'password'         => $password,
			'title'            => ($this->input->post('title') !=''  ?  $this->input->post('title') : null),
			'birth_date'=>$birth_date,
			'company_name'        => $this->input->post('company_name',TRUE),
			'first_name'       => ($this->input->post('first_name') !=''  ?  $this->input->post('first_name') : null),
			'last_name'        => ($this->input->post('last_name') !=''  ?  $this->input->post('last_name') : null),
			'phone_number'		=> ($this->input->post('phone_number') !=''  ?  $this->input->post('phone_number') : null),
			'mobile_number'		=> ($this->input->post('mobile_number') !=''  ?  $this->input->post('mobile_number') : null),
			'fax_number'		=> ($this->input->post('fax_number') !=''  ?  $this->input->post('fax_number') : null),
			'country'		=> ($this->input->post('country') !=''  ?  $this->input->post('country') : null),
			'city'		=> ($this->input->post('city') !=''  ?  $this->input->post('city') : null),
			'state'		=> ($this->input->post('state') !=''  ?  $this->input->post('state') : null),
			'address'		=> ($this->input->post('address') !=''  ?  $this->input->post('address') : null),
			'zipcode'		=> ($this->input->post('zipcode') !=''  ?  $this->input->post('zipcode') : null),
			'actkey'           =>md5($this->input->post('user_name',TRUE)),
			'account_created_date'=>$this->config->item('config.date.time'),
			'current_login'    =>null,
			'status'=>'1',
			'is_verified'=>'0',									
			'ip_address'  =>$this->input->ip_address()
			
		);
		
	    $insId =  $this->safe_insert('wl_customers',$register_array,FALSE);

		if( $insId > 0 )
		{
		  $meta_array  = array(
						  'entity_type'=>'category/vendor_details/'.$insId,
						  'entity_id'=>$insId,
						  'page_url'=>$friendly_url,
						  'meta_title'=>get_text($this->input->post('company_name'),80),
						  'meta_description'=>get_text($this->input->post('company_name')),
						  'meta_keyword'=>get_keywords($this->input->post('company_name'))
						  );

		  create_meta($meta_array);
		}
		
		return  $insId ;
	}


	public function is_email_exits($data)
	{
		$this->db->select('customers_id');
		$this->db->from('wl_customers');
		$this->db->where($data);	
		$this->db->where('status !=', '2');
		
		$query = $this->db->get();
		if ($query->num_rows() == 1)
		{
			return TRUE;
			
		}else
		{
			return FALSE;
	
		}
		
	}	

	public function logout()
	{
		$data = array(
		'user_id' => 0,
		'email' => 0,
		'name'=>0,
		'user_photo'=>0,
		'logged_in' => FALSE
		);		
		$this->session->sess_destroy();
		$this->session->unset_userdata($data);
	}


	
}
/* End of file users_model.php */
/* Location: ./application/modules/users/models/users_model.php */