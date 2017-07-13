<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Configuration_model extends MY_Model{

  public function __construct(){

	parent::__construct();

  }

  public function getThresholds()
  {
	$fetch_config = array(
							'debug'=>FALSE,
							'index'=>'type',
							'return_type'=>"array"							  
						 );		
	$result = $this->findAll('wl_configuration',$fetch_config);

	return $result;
  }

  public function saveThresholds()
  {
	$arr_timeframes = array(
							  'vat_charge'
						   );
	foreach($arr_timeframes as $val)
	{
	  $post_fld_dollar = $val;
	 
	  $data = array(
					'value'  	=>$this->input->post($val)
					);
			
	  $where = "type = '".$val."'";
	  $this->safe_update('wl_configuration',$data,$where,FALSE);
	}
  }
}
// model end here