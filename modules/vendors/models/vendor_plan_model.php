<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class vendor_plan_model extends MY_Model
{
		public function select_age_range_res($age_string,$gender){
			
			$query = $this->db->select('*');
			$query = $this->db->where(array('age' => $age_string,'gender'=>$gender));
			$query = $this->db->get('tu_age_range');
			return $ret = $query->row();
		}
		public function insert_age_id($gender_id,$age,$age_start,$age_end,$age_id){			$query = $this->db->insert('tu_age_range',array('gender'=>$gender_id,'age'=>$age,'age_start'=>$age_start,'age_end'=>$age_end,'age_id'=>$age_id));		}		public function insert_vendor_plan_info($last_I_Id){			$query = $this->db->insert('tu_health_plan_info',array('id'=>$last_I_Id,'special_fetures'=>$this->input->post('special_features_dec'),'custom_plan_name'=>$this->input->post('custom_plan_name'),'insurance_company_name'=>$this->input->post('insu_comp_name'),'silent_cover_features'=>$this->input->post('silent_features')));		}		
		public function insert_vendor_premium($country_id,$user_id,$plan,$age_id,$gender_premium_val){
			$query = $this->db->insert('tu_premium_value',array('country_id'=>$country_id,'vendor_id'=>$user_id,'plan_id'=>$plan,'age_id'=>$age_id,'premium_value'=>$gender_premium_val,'dental_rate'=>$this->input->post('dental'),'maternity_rate'=>$this->input->post('maternity'),'eye_rate'=>$this->input->post('eye'),'currency'=>'AED'));
		}
		public function insert_vendor_plan_id($user_id,$country_id,$plan,$file_path){
			$query = $this->db->select('*');
			$query = $this->db->where(array('vendor_id'=>$user_id,'vendor_country_id'=>$country_id,'vendor_plan_id'=>$plan));
			$query = $this->db->get('tu_vendor_plans');
			$ret = $query->num_rows();
			if($ret == 0){
				$query = $this->db->insert('tu_vendor_plans',array('vendor_id'=>$user_id,'vendor_country_id'=>$country_id,'vendor_plan_id'=>$plan,'vendor_plan_doc' => $file_path));
				return true;
			}
		}
		
	
}


?> 
	 