<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/* The MX_Controller class is autoloaded as required */
class MY_Controller extends CI_Controller 
{
	
	public $spamwords = array(); 
	public $has_spamword;
    public $admin_info;
	
	public function __construct()
	{	
	   ob_start();
	   parent::__construct();
	  
	   $this->is404 = FALSE;
			
	  $this->db->select('admin_email,address,admin_type,business_contact_number,office_hrs,phone');
	  $this->db->from('tbl_admin');
	  $this->db->where('admin_id','1');		
	  $query = $this->db->get();			
	  if( $query->num_rows() > 0 )
	  {
		  $this->admin_info = $query->row(); 
		  
	  }
	  
	  $this->load->helper('seo/seo');
	  $this->load->config('seo/config');

	  if($this->uri->segment(1)!='sitepanel')
	  {
		 $this->meta_info  = getMeta();
	  }

	
	  $this->get_configuration_values();

	  $this->userId = (int) $this->session->userdata('user_id');
	  $this->userType = $this->session->userdata('user_type');
	  if($this->userId > 0)
	  {	
		if($this->userType == 1)
		{
		  $this->load->model(array('members/members_model'));

		  $mem_cond = array(
							  'where'=>"a.customers_id ='".$this->userId."' AND a.status='1'"
							); 			 
		  $this->mres = $this->members_model->get_members($mem_cond);
		}
		else
		{
		  $this->load->model(array('vendors/vendor_model')); 			 
		  $mem_cond = array(
							  'where'=>"a.customers_id ='".$this->userId."' AND a.status='1'"
							);
		  $this->mres = $this->vendor_model->get_members($mem_cond);
		  

		  //trace($this->mres);
		}

		if(is_array($this->mres) && !empty($this->mres))
		{
		  $this->mres = $this->mres[0];
		}
		else
		{
		  redirect('users/logout','');
		}

		$this->canShop = TRUE;
	  }
	  else
	  {
		$this->canShop = TRUE;
	  }
	}
	
	
     public function fetch_spamwords()
	 {
		 if(is_array($this->spamwords) && empty($this->spamwords) ) 
		 {
			 
	  		$this->db->select('words');
			$this->db->where('status','1');
			$query=$this->db->get('tbl_spam_words');
			//echo $this->db->last_query();
			if($query->num_rows() > 0)
			{
				
			  $this->spamwords=$query->result();
			  
			}
			
		 }
		 
		 return  $this->spamwords;
	} 

	public function filter_spamwords($in_string)
	{
		  $spam_words="";
		  $res=$this->fetch_spamwords();
		  $i=0;			 
		  foreach($res as $val)
		  {
			if( preg_match("/\b".$val->words."\b/i",$in_string) )
			{				
				$spam_words.=$val->words.",";
								
			 }
			 
		   }
		   
		 $spam_words=rtrim($spam_words,',');
		 return  $spam_words;
	}	
	public function has_spamwords($in_string)
	{
		
			$array = array_map('reset', $this->fetch_spamwords());
			$this->has_spamword=check_spam_words($array,$in_string);
		    return  $this->has_spamword;
			
	} 

	public function get_configuration_values()
	{
		$this->configuration_res = array();
		$configuration_res = $this->db->get_where('wl_configuration')->result_array();
		foreach($configuration_res as $val)
		{
		  $this->configuration_res[$val['type']] = $val['value'];
		}
	}
	
	 public function check_spamwords($str)
	 {
		if($this->has_spamwords($str))
		{		
		  $this->form_validation->set_message("check_spamwords","The %s field contains some offensive words. Please remove them first. The Found Offensive Word(s): <b> ".$this->filter_spamwords($str)."</b>");		  
			return FALSE;			
		}
		 else
		{			
			return TRUE;			
		 }
		
	 }
	
   
}