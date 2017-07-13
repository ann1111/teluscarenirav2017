<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
* The global dbquery CI helpers 

*/

if ( ! function_exists('get_agency_type'))
{	
	function get_agency_type($data)
	{
		if($data == 1){$agency_type = 'Agency'; }
		elseif($data == 2){$agency_type = 'NON-AGENCY(Standard)'; }
		elseif($data == 3){$agency_type = 'NON-AGENCY(Superior)'; }
		
		return $agency_type;
		
	}
}

		
if ( ! function_exists('get_vehicle_type'))
{	
	function get_vehicle_type($data)
	{
		if($data == 1){ $vehicle_type = 'Saloon Hatchback'; } 
		elseif($data == 2){ $vehicle_type = '4X4 / SUV'; }
		elseif($data == 3){ $vehicle_type = 'Van'; }
		elseif($data == 4){ $vehicle_type = 'Bus(15 seats)'; }
		elseif($data == 5){ $vehicle_type = 'Bus(26 seats)'; }
		elseif($data == 6){ $vehicle_type = 'Bus(56 seats)'; } 
		elseif($data == 7){ $vehicle_type = 'Bus(83 seats)'; } 
		elseif($data == 8){ $vehicle_type = 'Motor Bike'; } 
		elseif($data == 9){ $vehicle_type = 'Pick Up (1 ton)'; } 
		elseif($data == 10){ $vehicle_type = 'Pick Up (2 ton)'; } 
		elseif($data == 11){ $vehicle_type = 'Pick Up (upto 3 ton)'; } 
		elseif($data == 12){ $vehicle_type = 'Pick Up (More than 3 ton)'; } 
		elseif($data == 13){ $vehicle_type = 'Rent a Car'; } 
		elseif($data == 14){ $vehicle_type = 'Taxi'; } 
		elseif($data == 15){ $vehicle_type = 'Truck'; } 
		elseif($data == 16){ $vehicle_type = 'Trails'; } 
		elseif($data == 17){ $vehicle_type = 'Tanker (Upto 2 Gallons)'; } 
		elseif($data == 18){ $vehicle_type = 'Tanker (Upto 5 Gallons)'; } 
		elseif($data == 19){ $vehicle_type = 'Gas Pick up'; } 
		elseif($data == 20){ $vehicle_type = 'Tanker (chemical)'; } 
		elseif($data == 21){ $vehicle_type = 'Tanker (Diesel)'; } 
		elseif($data == 22){ $vehicle_type = 'Fork lift'; } 
		elseif($data == 23){ $vehicle_type = 'Dumper'; } 
		elseif($data == 24){ $vehicle_type = 'Heavy Equipment'; } 
		elseif($data == 25){ $vehicle_type = 'Sports/Coupe'; } 
		elseif($data == 26){ $vehicle_type = 'Light Equipment'; } 
		
		return $vehicle_type;
	}
}

if ( ! function_exists('get_emirate_name'))
{	
	function get_emirate_name($data)
	{
		if($data == 'DUB'){ $emirates = 'Dubai'; }
		elseif($data == 'ABU'){ $emirates = 'Abu Dhabi'; }
		elseif($data == 'SHR'){ $emirates = 'Sharjah'; }
		elseif($data == 'RAK'){ $emirates = 'Ras Al Khaimah'; }
		elseif($data == 'AJM'){ $emirates = 'Ajman'; }
		elseif($data == 'FUI'){ $emirates = 'Fujairah'; }
		elseif($data == 'UAQ'){ $emirates = 'Umm Al Quwain'; }
		
		return $emirates;
	}
}


if ( ! function_exists('get_licence_foryear'))
{	
	function get_driver_licence($data)
	{
		if($data == 'l6'){ $d_licence = 'less than 6 months'; }
		elseif($data == 'l1'){ $d_licence = 'less than 1 year'; }
		elseif($data == '1'){ $d_licence = '1 year'; }
		elseif($data == '2'){ $d_licence = '2 year'; }
		elseif($data == 'A2'){ $d_licence = 'Above 2 years'; }

		return $d_licence;
	}
}

if ( ! function_exists('get_gcc'))
{	
	function get_gcc($data)
	{
		if($data == 1){ $gcc = 'Yes'; }
		if($data == 0){ $gcc = 'No'; } 
	
	return $gcc;
	}
}

if ( ! function_exists('get_no_cylinder'))
{	
	function get_no_cylinder($data)
	{
		
		if($data == 'A8'){ $cylender = 'Above 8'; }
		elseif($data == 'SC'){ $cylender = 'Sports/Coupe'; }
		else{ 
		$cylender = $data;
		} 
		
		return $cylender;
		
		
	}
}

if ( ! function_exists('get_driver_age'))
{	
	function get_driver_age($data)
	{
		
		if($data == 1){ $driver_age = 'Less than 20'; }
		elseif($data == 2){ $driver_age = '20 to 25'; }
		elseif($data == 3){ $driver_age = 'More than 25'; }

		return $driver_age;
		
		
	}
}

if ( ! function_exists('get_health_plan'))
{	
	function get_health_plan($data)
	{
		if($data == 'DHAB'){ $plan = 'DHA Basic'; }
		elseif($data == 'DHAE'){ $plan = 'DHA Enhance'; }
		elseif($data == 'HAADB'){ $plan = 'HAAD Basic'; }
		elseif($data == 'HAADE'){ $plan = 'HAAD Enhance'; }
		elseif($data == 'B'){ $plan = 'Basic'; }
		elseif($data == 'ESIL'){ $plan = 'Enhance Silver'; }
		elseif($data == 'EGOL'){ $plan = 'Enhance Gold'; }
		elseif($data == 'EPLA'){ $plan = 'Enhance Platinum'; }

		return $plan;
		
	}
}


if ( ! function_exists('get_material_provided'))
{	
	function get_material_provided($data)
	{
		
		if($data == '1'){ $plan = 'Yes'; }
		elseif($data == '0'){ $plan = 'No'; }
	
		return $plan;
		
	}
}


if ( ! function_exists('get_type_of_premise'))
{	
	function get_type_of_premise($data)
	{
		
		if($data == '1'){ $plan = 'Villa'; }
		elseif($data == '2'){ $plan = 'Office'; }
		elseif($data == '3'){ $plan = 'Apartment'; }
		elseif($data == '4'){ $plan = 'Warehouse'; }
		elseif($data == '5'){ $plan = 'In Our Own Office Premises'; }
	
		return $plan;
		
	}
}
if ( ! function_exists('get_kind_of_premise'))
{	
	function get_kind_of_premise($data,$type_of_premises)
	{
		if($type_of_premises == 1){

			if($data == '1'){ $plan = '1 BHK'; }
			elseif($data == '2'){ $plan = '2 BHK'; }
			elseif($data == '3'){ $plan = '3 BHK'; }
			elseif($data == '4'){ $plan = '4 BHK'; }
			elseif($data == '5'){ $plan = '5 BHK'; }
			
			return $plan;
		}
		if($type_of_premises == 3){
		
			if($data == '0'){ $plan = 'STUDIO'; }
			elseif($data == '1'){ $plan = '1 BHK'; }
			elseif($data == '2'){ $plan = '2 BHK'; }
			elseif($data == '3'){ $plan = '3 BHK'; }
			elseif($data == '4'){ $plan = '4 BHK'; }
			elseif($data == '5'){ $plan = '5 BHK'; }
			
			return $plan;
		}
		if($type_of_premises == 2 || $type_of_premises == 4 || $type_of_premises == 5){
			
			if($data == '0'){ $plan = 'STUDIO'; }
			elseif($data == '1'){ $plan = 'below 500 sqft'; }
			elseif($data == '2'){ $plan = '500 sqft to 1000 sqft'; }
			elseif($data == '3'){ $plan = '1000 sqft to 2000 sqft'; }
			elseif($data == '4'){ $plan = '2000 sqft to 3000 sqft'; }
			elseif($data == '5'){ $plan = '3000 sqft to 4000 sqft'; }
			elseif($data == '6'){ $plan = '4000 sqft to 5000 sqft'; }
			elseif($data == '7'){ $plan = '5000 sqft to 7000 sqft'; }
			elseif($data == '8'){ $plan = '7000 sqft to 10000 sqft'; }
			elseif($data == '9'){ $plan = '10000 sqft to 20000 sqft'; }
			elseif($data == '10'){$plan = '20000 sqft & above'; }
			
			return $plan;
			
		}
		
		
	}
}
if ( ! function_exists('get_approx_area'))
{	
	function get_approx_area($data)
	{
		if($data == '1'){ $plan = 'below 500 sqft'; }
		elseif($data == '2'){ $plan = '500 sqft to 1000 sqft'; }
		elseif($data == '3'){ $plan = '1000 sqft to 2000 sqft'; }
		elseif($data == '4'){ $plan = '2000 sqft to 3000 sqft'; }
		elseif($data == '5'){ $plan = '3000 sqft to 4000 sqft'; }
		elseif($data == '6'){ $plan = '4000 sqft to 5000 sqft'; }
		elseif($data == '7'){ $plan = '5000 sqft to 7000 sqft'; }
		elseif($data == '8'){ $plan = '7000 sqft to 10000 sqft'; }
		elseif($data == '9'){ $plan = '10000 sqft to 20000 sqft'; }
		elseif($data == '10'){ $plan = '20000 sqft & above'; }
		
		return $plan;
		
	}
}	
	
if ( ! function_exists('get_emirate_name_by_id'))
{	
	function get_emirate_name_by_id($data)
	{
		if($data == '1'){ $plan = 'Abu Dabi'; }
		elseif($data == '2'){ $plan = 'Ajman'; }
		elseif($data == '3'){ $plan = 'Dubai'; }
		elseif($data == '4'){ $plan = 'Ras al-Khaymah'; }
		elseif($data == '5'){ $plan = 'Sharjah'; }
		elseif($data == '6'){ $plan = 'Sharjha'; }
		elseif($data == '7'){ $plan = 'Umm al Qaywayn'; }
		elseif($data == '8'){ $plan = 'al-Fujayrah'; }
		elseif($data == '9'){ $plan = 'ash-Shariqah'; }
	
		return $plan;
		
	}
}

if ( ! function_exists('get_frequency'))
{	
	function get_frequency($data)
	{
		if($data == '1'){ $c = '1 Time Only'; }
		elseif($data == '2'){ $c = '2 Time Only'; }
		elseif($data == '4'){ $c = '4 Time Only'; }
		elseif($data == '8'){ $c = '8 Time Only'; }
		elseif($data == '12'){ $c = '12 Time Only'; }
		elseif($data == '15'){ $c = '15 Time Only'; }
		elseif($data == '30'){ $c = 'Every Day'; }
		
		return $c;
	}
}


if ( ! function_exists('get_number_of_cleaners'))
{	
	function get_number_of_cleaners($data)
	{
		if($data == '1'){ $c = '1 Cleaner'; }
		elseif($data == '2'){ $c = '2 Cleaner'; }
		elseif($data == '3'){ $c = '3 Cleaner'; }
		elseif($data == '4'){ $c = '4 Cleaner'; }
		elseif($data == '5'){ $c = '5 Cleaner'; }
		elseif($data == '6'){ $c = '6 Cleaner'; }
		elseif($data == '7'){ $c = '7 Cleaner'; }
		elseif($data == '8'){ $c = '8 Cleaner'; }
		elseif($data == '9'){ $c = '9 Cleaner'; }
		elseif($data == '10'){ $c = '10 Cleaner'; }
		return $c;
	}
}

if ( ! function_exists('get_number_of_hours'))
{	
	function get_number_of_hours($data)
	{
		if($data == '1'){ $c = '1 Hour'; }
		elseif($data == '2'){ $c = '2 Hour'; }
		elseif($data == '3'){ $c = '3 Hour'; }
		elseif($data == '4'){ $c = '4 Hour'; }
		elseif($data == '5'){ $c = '5 Hour'; }
		elseif($data == '6'){ $c = '6 Hour'; }
		elseif($data == '7'){ $c = '7 Hour'; }
		elseif($data == '8'){ $c = '8 Hour'; }
		elseif($data == '9'){ $c = '9 Hour'; }
		elseif($data == '10'){ $c = '10 Hour'; }
		return $c;
	}
}


				
if ( ! function_exists('get_cleaner_city_name'))
{	
	function get_cleaner_city_name($data)
	{
		
		if($data == '1'){ $plan = 'Abu Dabi'; }
		elseif($data == '2'){ $plan = 'Ajman'; }
		elseif($data == '3'){ $plan = 'Dubai'; }
		elseif($data == '4'){ $plan = 'Ras al-Khaymah'; }
		elseif($data == '5'){ $plan = 'Sharjah'; }
		elseif($data == '6'){ $plan = 'Sharjha'; }
		elseif($data == '7'){ $plan = 'Umm al Qaywayn'; }
		elseif($data == '8'){ $plan = 'al-Fujayrah'; }
		elseif($data == '9'){ $plan = 'ash-Shariqah'; }

		return $plan;
		
		
	}
}

if ( ! function_exists('get_emirate_name'))
{	
	function get_emirate_name($data)
	{
		if($data == 'DUB'){ $emirates = 'Dubai'; }
		elseif($data == 'ABU'){ $emirates = 'Abu Dhabi'; }
		elseif($data == 'SHR'){ $emirates = 'Sharjah'; }
		elseif($data == 'RAK'){ $emirates = 'Ras Al Khaimah'; }
		elseif($data == 'AJM'){ $emirates = 'Ajman'; }
		elseif($data == 'FUI'){ $emirates = 'Fujairah'; }
		elseif($data == 'UAQ'){ $emirates = 'Umm Al Quwain'; }
		
		echo $emirates;
	}
}


if ( ! function_exists('get_vehicle_reg_for'))
{	
	function get_vehicle_reg_for($data)
	{
		if($data == '1'){ $c = 'Individual'; }
		elseif($data == '2'){ $c = 'Corporate(rent a car)'; }
		elseif($data == '3'){ $c = 'Corporate(transport company)'; }
		elseif($data == '4'){ $c = 'Corporate(recovery company)'; }
		
		echo $c;
	}
}

if ( ! function_exists('get_level_of_serv'))
{	
	function get_level_of_serv($data)
	{
		if($data == '1'){ $c = 'Essential Services'; }
		elseif($data == '2'){ $c = 'Internal services'; }
		elseif($data == '3'){ $c = 'Full Services'; }
	
		echo $c;
	}
}

if ( ! function_exists('get_types_of_services'))
{	
	function get_types_of_services($data)
	{
		if($data == '1'){ $c = 'Bed Bug'; }
		elseif($data == '2'){ $c = 'Cockroaches'; }
		elseif($data == '3'){ $c = 'Bed Bug + Cockroaches'; }
		elseif($data == '4'){ $c = 'Rats Termites'; }
		elseif($data == '5'){ $c = 'Other Pest Control Services'; }
		elseif($data == '6'){ $c = 'Annual Pest Control Contracts'; }
	
		echo $c;
	}
}

if ( ! function_exists('get_feature_of_serv'))
{	
	function get_feature_of_serv($data)
	{
		if($data == '1'){ $c = 'Feature 1'; }
		elseif($data == '2'){ $c = 'Feature 2'; }
		elseif($data == '3'){ $c = 'Feature 3'; }
		elseif($data == '4'){ $c = 'Feature 4'; }
		elseif($data == '5'){ $c = 'Feature 5'; }
	
		echo $c;
	}
}

if ( ! function_exists('get_order_status'))
{	
	function get_order_status($data)
	{
		if($data == '1'){ $c = 'Pending'; }
		elseif($data == '2'){ $c = 'Complete'; }
		elseif($data == '3'){ $c = 'cancel'; }
		elseif($data == '4'){ $c = 'Under-Process'; }
		
		echo $c;
	}
}


if ( ! function_exists('get_type_of_calc_service'))
{	
	function get_type_of_calc_service($data)
	{
		if($data == '1'){ $c = 'health'; }
		elseif($data == '2'){ $c = 'motor'; }
		elseif($data == '3'){ $c = 'cleaning'; }
		elseif($data == '4'){ $c = 'motorservice'; }
		elseif($data == '5'){ $c = 'pestcontrol'; }
		elseif($data == '6'){ $c = 'paintservice'; }
		elseif($data == '7'){ $c = 'rentacar'; }
		
		echo $c;
	}
}


if ( ! function_exists('get_exclude_driver_licence'))
{	
	function get_exclude_driver_licence($data)
	{
		$dl = array('l6' => 'less than 6 months','l1' => 'less than 1 year','1'=>'1 year','2'=>'2 years','A2'=>'Above 2 years');
		
		$sm .= '<select class="form-control current" name="Driving_Licence">';
		
		foreach($dl as $key => $val){
			if($_SESSION['exclude_data']['Driving_Licence'] != ''){
				if($key == $_SESSION['exclude_data']['Driving_Licence']){
						
					}else{
						
						$sm .= '<option value='.$key.'> '.$val.' </option>';
					}
				
			}else{
				$sm .= '<option value='.$key.'> '.$val.' </option>';
				
			}	
					
			
			
		}
		$sm .= '</select>';
		
		echo $sm;
	}
}

if ( ! function_exists('get_exclude_driver_age'))
{	
	function get_exclude_driver_age($data)
	{
		$dl = array('1' => 'Less than 21 Years','2' => 'More Than 21 Years and Less than 25 Years','3'=>'More than 25 Years and Less than 30 Years','4'=>'More than 30 Years');
		
		$sm .= '<select class="form-control current" name="driver_age">';
		
		foreach($dl as $key => $val){
			if($_SESSION['exclude_data']['driver_age'] != ''){
				if($key == $_SESSION['exclude_data']['driver_age']){
						
					}else{
						
						$sm .= '<option value='.$key.'> '.$val.' </option>';
					}
				
			}else{
				$sm .= '<option value='.$key.'> '.$val.' </option>';
				
			}	
			
		}
		$sm .= '</select>';
		
		echo $sm;
	}
}

if ( ! function_exists('get_all_vehicle_info_hel'))
{	
 function get_all_vehicle_info_hel(){
		
		$CI =& get_instance();
		
		$CI->db->distinct();
		$CI->db->select('makeby');
		$this->db->order_by("makeby", "asc");
		$CI->db->get('tu_vehiclemodelyear');
		return $CI->result_array();
	} 
}
/*


*/

?>