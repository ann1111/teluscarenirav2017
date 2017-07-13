<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/* Param list 

	**** Single Dimension Associative Array i.e array('Size'=>'Large','Color'=>'Black','width'=>'22CM')
	**** ExcludeKeys array of keys that to be excluded
*/

if ( ! function_exists('create_hidden_fields'))
{
	function create_hidden_fields($arr_values,$excludeKeys = NULL)
	{
		$hiddenFields = '';
		if(is_array($arr_values) && count($arr_values)>0)
		{
			foreach($arr_values as $fieldKey=>$fieldVal)
			{
				if(is_array($excludeKeys) && in_array($fieldKey,$excludeKeys))
				{
					continue;
					
				}
				$hiddenFields .= "<input type='hidden' name='".$fieldKey."' value='".$fieldVal."'>\n";
				
				
			}
		}
		return $hiddenFields;
	}
}

/**
	 * Drop-down Menu
	 *
	 * @param	string
	 * @param	array
	 * @param	string
	 * @param	string
	 * @return	string
	 */
	 
if ( ! function_exists('custom_drop_down'))
{
	function custom_drop_down($name = '', $options = array(), $selected = array(), $extra = '',$force_select = TRUE,$default_text = NULL)
	{
		// If name is really an array then we'll call the function again using the array
		if (is_array($name) && isset($name['name']))
		{
			isset($name['options']) OR $name['options'] = array();
			isset($name['selected']) OR $name['selected'] = array();
			isset($name['extra']) OR $name['extra'] = array();

			return custom_drop_down($name['name'], $name['options'], $name['selected'], $name['extra'],$name['force_select'],$name['default_option']);
		}

		if ( ! is_array($selected))
		{
			$selected = array($selected);
		}

		// If no selected state was submitted we will attempt to set it automatically
		if (count($selected) === 0 && isset($_POST[$name]))
		{
			$selected = array($_POST[$name]);
		}

		if ($extra != '')
		{
			$extra = ' '.$extra;
		}

		$multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

		$form = '<select name="'.$name.'"'.$extra.$multiple.">\n";
		
		if($force_select == TRUE)
		{
			$default_text = (!empty($default_text)) ? $default_text : 'Select';
			$form .= '<option value="">'.(string) $default_text."</option>\n";
			
		}

		foreach ($options as $key => $val)
		{
			$key = (string) $key;

			if (is_array($val))
			{
				if (empty($val))
				{
					continue;
				}

				$form .= '<optgroup label="'.$key."\">\n";

				foreach ($val as $optgroup_key => $optgroup_val)
				{
					$sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
					$form .= '<option value="'.$optgroup_key.'"'.$sel.'>'.(string) $optgroup_val."</option>\n";
				}

				$form .= "</optgroup>\n";
			}
			else
			{
				$form .= '<option value="'.$key.'"'.(in_array($key, $selected) ? ' selected="selected"' : '').'>'.(string) $val."</option>\n";
			}
		}

		return $form."</select>\n";
	}
}

if (!function_exists('get_all_vehicle_info_form'))
{
	function get_all_vehicle_info_form(){
		
		$CI = CI();
		
		$CI->db->distinct();
		$query = $CI->db->select('makeby');		$query = $CI->db->order_by("makeby", "asc");
		$query = $CI->db->get('tu_vehiclemodelyear');
		
		$cont = '<select class="form-control" name="vehicle_name" id="vehicle_name" required>';
		$cont .= '<option value="">Select</option>'; 
		foreach($query->result_array() as $maker){
			
			$cont .= '<option value="'.$maker['makeby'].'">'.$maker['makeby'].'</option>'; 
			
		}
		$cont .= '</select>';
		
		return $cont; 
	} 
}	
	
	
if (!function_exists('get_vehicle_type_form_field'))
{	
	function get_vehicle_type_form_field()
	{
		$veh_type = array(
			'1' => 'Saloon Hatchback',
			'2' => '4X4 / SUV',
			'3' => 'Van',
			'4' => 'Bus(15 seats)',
			'5' => 'Bus(26 seats)',
			'6' => 'Bus(56 seats)',
			'7' => 'Bus(83 seats)',
			'8' => 'Motor Bike',
			'9'=> 'Pick Up (1 ton)',
			'10'=> 'Pick Up (2 ton)',
			'11'=> 'Pick Up (upto 3 ton)',
			'12'=> 'Pick Up (More than 3 ton)',
			'13'=> 'Rent a Car',
			'14' => 'Taxi',
			'15' => 'Truck',
			'16' => 'Trails',
			'17' => 'Tanker (Upto 2 Gallons)',
			'18' => 'Tanker (Upto 5 Gallons)',
			'19'=> 'Gas Pick up',
			'20' => 'Tanker (chemical)',
			'21' => 'Tanker (Diesel)',
			'22' => 'Fork lift',
			'23' => 'Dumper',
			'24' => 'Heavy Equipment',
			'25' => 'Sports/Coupe',
			'26' => 'Light Equipment'
		
		);
		
		
		$cont = '<select class="form-control" id="vehicletype" name="vehicletype" required>';
		$cont .= '<option value="">Select</option>'; 
		foreach($veh_type as $key => $vt){
			
			$cont .= '<option value="'.$key.'">'.$vt.'</option>'; 
			
		}
		$cont .= '</select>';
		
		return $cont; 
	}
}

if (!function_exists('get_emirates_field'))
{	
	function get_emirates_field($field_id,$field_name)
	{
		
		$countries = array(
			'DUB' => 'Dubai',
			'ABUD' => 'Abu Dhabi',
			'SHR' => 'Sharjah',
			'FUJ' => 'Fujairah',
			'RAK' => 'Ras Al Khaimah',
			'AJM' => 'Ajman',
			'UAQ' => 'Umm Al Quwain',
		);
		
		
		$cont = '<select id="'.$field_id.'" class="form-control" name="'.$field_name.'" required="">';
		$cont .= '<option value="">Select</option>'; 
		foreach($countries as $KEY => $vt){
			
			$cont .= '<option value="'.$KEY.'">'.$vt.'</option>'; 
			
		}
		$cont .= '</select>';
		
		return $cont; 
	}
}	



if (!function_exists('get_years_field'))
{	
	function get_years_field($year,$field_id,$field_name)
	{
		
		$cont = '<select id="'.$field_id.'" class="form-control" name="'.$field_name.'" required="">';
		$cont .= '<option value="">Select</option>'; 
		
		for($i = $year;$i <= date('Y'); $i++){
				
				$cont .= '<option value="'.$i.'">'.$i.'</option>'; 
			
		}
		
		$cont .= '</select>';
		
		return $cont; 
	}
}
	
	
	if (!function_exists('get_health_plan_field'))
{	
	function get_health_plan_field($field_id,$field_name)
	{
	
		$countries = array(
			'DHAB' => 'DHA Basic',
			'DHAE' => 'DHA Enhance',
			'HAADB' => 'HAAD Basic',
			'HAADE' => 'HAAD Enhance',
			'B' => 	   'Basic',
			'ESIL' => 'Enhance Silver',
			'EGOL' => 'Enhance Gold',
			'EPLA' => 'Enhance Platinum',
		);
		
		
		$cont = '<select id="'.$field_id.'" class="form-control" name="'.$field_name.'" required="">';
		$cont .= '<option value="">Select</option>'; 
		foreach($countries as $KEY => $vt){
			
			$cont .= '<option value="'.$KEY.'">'.$vt.'</option>'; 
			
		}
		$cont .= '</select>';
		
		return $cont; 
	}
}

if (!function_exists('get_health_maps_field'))
{	
	function get_health_maps_field($field_id,$field_name)
	{
		$countries = array(
			'DNE' => 'Dubai Northern Emirates',
			'ABUAL' => 'Abu Dhabi - Al Ain',
			'UAE' => 'UAE',
			'UAEME' => 'UAE & Middle East',
			'UAEHC' => 'UAE & Home Country',
			'UAEIS' => 'UAE / Indian Subscountries',
			'EXUSA' => 'World Wide ex-USA',
			'UAEMEC' => 'UAE | Middle East | Africa Countries',
		);
		
		
		$cont = '<select id="'.$field_id.'" class="form-control" name="'.$field_name.'" required="">';
		$cont .= '<option value="">Select</option>'; 
		foreach($countries as $KEY => $vt){
			
			$cont .= '<option value="'.$KEY.'">'.$vt.'</option>'; 
			
		}
		$cont .= '</select>';
		
		return $cont; 
	}
}


	
if (!function_exists('get_health_gender_field'))
{	
	function get_health_gender_field($field_id,$field_name)
	{
		$countries = array(
			'M' => 'Male',
			'F' => 'Female',
			'FM' => 'Married Female',
		);
		
		$cont = '<select id="'.$field_id.'" class="form-control" name="'.$field_name.'" required="">';
		$cont .= '<option value="">Select</option>'; 
		foreach($countries as $KEY => $vt){
			
			$cont .= '<option value="'.$KEY.'">'.$vt.'</option>'; 
			
		}
		$cont .= '</select>';
		
		return $cont; 
	}
}
	
if (!function_exists('get_relations_field'))
{	
	function get_relations_field($field_id,$field_name)
	{
		$countries = array(
			'M' => 'Male(Primary)',
			'F' => 'Female(Primary)',
			'FM' => 'Married Female(Primary)',
			'CM' => 'Child Male',
			'CF' => 'Child Female',
			'MA' =>  'Married',
			'UM' => 'Unmarried',
			'FA' => 'Father',
			'MO' => 'Mother',
			'MCS' => 'Maid/Cleaner/Servent',
			'P' => 'Partner',
			'E' => 'Employee',
		);
		
		
		$cont = '<select id="'.$field_id.'" class="form-control" name="'.$field_name.'" required="">';
		$cont .= '<option value="">Select</option>'; 
		foreach($countries as $KEY => $vt){
			
			$cont .= '<option value="'.$KEY.'">'.$vt.'</option>'; 
			
		}
		$cont .= '</select>';
		
		return $cont; 
	}
}


if (!function_exists('get_level_of_services_field'))
{	
	function get_level_of_services_field($field_id,$field_name,$selected_level_of_services)
	{
		$services = array(
			'1' => 'Essential Services',
			'2' => 'Internal services',
			'3' => 'Full Services',
			
		);
		
		
		$cont = '<select id="'.$field_id.'" class="form-control" name="'.$field_name.'" required="">';
		$cont .= '<option value="">Select</option>';
		foreach($services as $KEY => $vt){
			if($selected_level_of_services == $KEY){
				$cont .= '<option value="'.$KEY.'" selected>'.$vt.'</option>'; 
			}else{
				$cont .= '<option value="'.$KEY.'">'.$vt.'</option>'; 
			}
		}
		$cont .= '</select>';
		
		return $cont; 
	}
}

if (!function_exists('get_feature_of_Services_field'))
{	
	function get_feature_of_Services_field($field_id,$field_name,$featureofServices)
	{
		$features = array(
			'1' => 'Feature 1',
			'2' => 'Feature 2',
			'3' => 'Feature 3',
			'4' => 'Feature 4',
			'5' => 'Feature 5',
		);
		
		
		$cont = '<select id="'.$field_id.'" class="form-control" name="'.$field_name.'" required="">';
		$cont .= '<option value="">Select</option>';
		foreach($features as $KEY => $vt){
			if($featureofServices == $KEY){
				$cont .= '<option value="'.$KEY.'" selected>'.$vt.'</option>'; 
			}else{
				$cont .= '<option value="'.$KEY.'">'.$vt.'</option>'; 
			}
		}
		$cont .= '</select>';
		
		return $cont; 
	}
}

if ( ! function_exists('get_all_makers_hel'))
{	
 function get_all_makers_hel($field_id,$field_name){
		
		$CI =& get_instance();
		
		$query =	$CI->db->distinct();
		$query =	$CI->db->select('makeby');
		$query =	$CI->db->get('tu_vehiclemodelyear');
		
		$cont = '<select id="'.$field_id.'" class="form-control" name="'.$field_name.'" required="">';
		$cont .= '<option value="" selected>Select</option>';
		foreach($query->result_array() as $KEY => $vt){
			if($featureofServices == $KEY){
				$cont .= '<option value="'.$vt['makeby'].'" >'.$vt['makeby'].'</option>'; 
			}else{
				$cont .= '<option value="'.$vt['makeby'].'">'.$vt['makeby'].'</option>'; 
			}
		}
		$cont .= '</select>';
		
		return $cont; 
		
	} 
}

if ( ! function_exists('get_pest_type_of_service_field'))
{	
 function get_pest_type_of_service_field($field_id,$field_name,$selected){
	
		$type_of_serv = array(
			'1' => 'Bed Bug',
			'2' => 'Cockroaches',
			'3' => 'Bed Bug + Cockroaches',
			'4' => 'Rats Termites',
			'5' => 'Other Pest Control Services',
			'6' => 'Annual Pest Control Contracts',
		);
		
		$cont = '<select id="'.$field_id.'" class="form-control" name="'.$field_name.'" required="">';
		$cont .= '<option value="">Select</option>';
		foreach($type_of_serv as $KEY => $vt){
			if($selected == $KEY){
				$cont .= '<option value="'.$KEY.'" selected>'.$vt.'</option>'; 
			}else{
				$cont .= '<option value="'.$KEY.'">'.$vt.'</option>'; 
			}
		}
		$cont .= '</select>';
		
		return $cont; 
		
	} 
}	


if ( ! function_exists('get_type_of_premises_field'))
{	
 function get_type_of_premises_field($field_id,$field_name,$selected){
	
		$type_of_prem = array(
			'1' => 'Villa',
			'2' => 'Office',
			'3' => 'Apartment',
			'4' => 'Warehouse',
			'5' => 'Own Company Premises',
		);
		
		$cont = '<select id="'.$field_id.'" class="form-control premises" name="'.$field_name.'" required="">';
		$cont .= '<option value="">Select</option>';
		foreach($type_of_prem as $KEY => $vt){
			if($selected == $KEY){
				$cont .= '<option value="'.$KEY.'" selected>'.$vt.'</option>'; 
			}else{
				$cont .= '<option value="'.$KEY.'">'.$vt.'</option>'; 
			}
		}
		$cont .= '</select>';
		
		return $cont; 
		
	} 
}	

if ( ! function_exists('get_kind_of_premises_field'))
{	
 function get_kind_of_premises_field($field_id,$field_name,$data,$kind_of_premises){
	
	if($kind_of_premises == 1){
		$kind_of_prem = array('1' => '1 BHK','2' => '2 BHK','3' => '3 BHK','4' => '4 BHK','5' => '5 BHK');
	}
	if($kind_of_premises == 3){
		$kind_of_prem = array('0' => 'STUDIO','1' => '1 BHK','2' => '2 BHK','3' => '3 BHK','4' => '4 BHK','5' => '5 BHK');
	}
	if($kind_of_premises == 2 || $kind_of_premises == 4 || $kind_of_premises == 5){
		$kind_of_prem = array('0' => 'STUDIO','1' => 'below 500 sqft','2' => '500 sqft to 1000 sqft','3' => '1000 sqft to 2000 sqft','4' => '2000 sqft to 3000 sqft','5' => '3000 sqft to 4000 sqft','6' => '4000 sqft to 5000 sqft','7' => '5000 sqft to 7000 sqft','8' => '7000 sqft to 10000 sqft','9' => '10000 sqft to 20000 sqft','10' => '20000 sqft & above');
	}
	
		
		$cont = '<select id="'.$field_id.'" class="form-control " name="'.$field_name.'" required="">';
		$cont .= '<option value="">Select</option>';
		foreach($kind_of_prem as $KEY => $vt){
			if($data == $KEY){
				$cont .= '<option value="'.$KEY.'" selected>'.$vt.'</option>'; 
			}else{
				$cont .= '<option value="'.$KEY.'">'.$vt.'</option>'; 
			}
		}
		$cont .= '</select>';
		
		return $cont; 
		
	} 
}	

if ( ! function_exists('get_area_sqrt_field'))
{	
 function get_area_sqrt_field($field_id,$field_name,$selected){
	
		$kind_of_prem = array(
			'1' => 'below 500 sqft',
			'2' => '500 sqft to 1000 sqft',
			'3' => '1000 sqft to 2000 sqft',
			'4' => '2000 sqft to 3000 sqft',
			'5' => '3000 sqft to 4000 sqft',
			'6' => '4000 sqft to 5000 sqft',
			'7' => '5000 sqft to 7000 sqft',
			'8' => '7000 sqft to 10000 sqft',
			'9' => '10000 sqft to 20000 sqft',
			'10' => '20000 sqft & above',
		);
		
		$cont = '<select id="'.$field_id.'" class="form-control" name="'.$field_name.'" required="">';
		$cont .= '<option value="">Select</option>';
		foreach($kind_of_prem as $KEY => $vt){
			if($selected == $KEY){
				$cont .= '<option value="'.$KEY.'" selected>'.$vt.'</option>'; 
			}else{
				$cont .= '<option value="'.$KEY.'">'.$vt.'</option>'; 
			}
		}
		$cont .= '</select>';
		
		return $cont; 
		
	} 
}	


if ( ! function_exists('get_vendor_company_name'))
{	
 function get_vendor_company_name($vendor_id){
		
		$CI =& get_instance();
		
		$query =	$CI->db->select('company_name');
		$query =	$CI->db->WHERE('customers_id' , $vendor_id);
		$query =	$CI->db->get('wl_customers');
		$final = 		$query->row_array();
		
		return $final['company_name'];
		
	} 
}

if ( ! function_exists('get_vendor_address'))
{	
 function get_vendor_address($vendor_id){
		
		$CI =& get_instance();
		
		$query =	$CI->db->select('*');
		$query =	$CI->db->WHERE('customers_id' , $vendor_id);
		$query =	$CI->db->get('wl_customers');
		$final = 		$query->row_array();
		
		return $final;
		
	} 
}

if ( ! function_exists('get_order_status_by_vendor_order_id'))
{	
	function get_order_status_by_vendor_order_id($vendor_order_id,$service_type)
	{
		$CI =& get_instance();
		
		$query =	$CI->db->select('*');
		$query =	$CI->db->WHERE(array('vendor_order_id'=>$vendor_order_id,'type_of_service'=>$service_type));
		$query =	$CI->db->get('tu_orders');
		$res = 		$query->row_array();
		
		if(count($res)){
			$data =  $res['order_status'];
		}else{
			$data = 1;
		}
		
		if($data == '1'){ $c = 'Pending'; }
		elseif($data == '2'){ $c = 'Complete'; }
		elseif($data == '3'){ $c = 'cancel'; }
		elseif($data == '4'){ $c = 'Under-Process'; }
		
		return $c;
	}
}


/**
*******
  

***************/




