<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class maplocation extends MX_Controller{
	
	public function __construct(){
		
		parent::__construct();
		$this->load->library('googlemaps');
		$this->load->helper('form');
	}
	
	public function index(){
		
		$this->load->view('map_location_view');
		
	}
	
	public function location_result(){
		
		$config['center'] = '37.4419, -122.1419';
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);

		$arr = $this->db->query("SELECT * FROM markers WHERE type='".$_POST['map_category']."'")->result_array();
		
		/* echo '<pre>';
		print_r($arr);
		exit; */
		
		foreach($arr as $mark){
			$marker = array();
			
			$marker['position'] = $mark['lat'].','.$mark['lng'];
			$marker['infowindow_content'] = '<img src="http://www.getmoresports.com/wp-content/uploads/2014/10/Notre-Dame-Fighting-Irish-vs-Navy-Midshipmen.jpg" width="250px"/></br>'.$mark['address'];
			$marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
			$this->googlemaps->add_marker($marker);
				
		}
		
		
		
		/* $marker = array();
		$marker['position'] = '37.429, -122.1519';
		$marker['infowindow_content'] = '1 - Hello World!';
		$marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
		$this->googlemaps->add_marker($marker);

		$marker = array();
		$marker['position'] = '37.409, -122.1319';
		$marker['draggable'] = TRUE;
		$marker['animation'] = 'DROP';
		$this->googlemaps->add_marker($marker);

		$marker = array();
		$marker['position'] = '37.449, -122.1419';
		$marker['onclick'] = 'alert("You just clicked me!!")';
		$this->googlemaps->add_marker($marker); */
		
		$data['map'] = $this->googlemaps->create_map();

		$this->load->view('map_location_result_view',$data);
	}
	
}

?>