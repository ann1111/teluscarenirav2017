<?php
class Contact_address extends Admin_Controller
{

	public function __construct(){
	
	  parent::__construct();

	  $this->config->set_item('menu_highlight','other management');	
	  $this->load->model(array('pages/pages_model'));
	}
	
	
	public  function index()
	{		 
	  if($this->input->post('status_action')!='')
	  {
		$this->update_status('wl_contact_address','sl');
	  }

	  $pagesize               =  (int) $this->input->get_post('pagesize');

	  $config['limit']	    =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');

	  $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	

	  $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));

	  $keyword = trim($this->input->get_post('keyword',TRUE));		
	  $keyword = $this->db->escape_str($keyword);

	  $condition = "";

	  if($keyword!='')
	  {
		$condition.= " AND (address like '%".$keyword."%' OR country_name LIKE '%".$keyword."%')";
	  }

	  $opt_arr = array(
						'condition'=>$condition,
						'limit'  => $config['limit'],
						'offset' => $offset
					  );
					
	  $res_array              =  $this->pages_model->get_contact_address($opt_arr);

	  $config['total_rows']	= $this->pages_model->total_rec_found;	

	  $data['page_links']     =  admin_pagination("$base_url",$config['total_rows'],$config['limit'],$offset);

	  $data['heading_title']  =   'Manage Contact Address';

	  $data['res']            =  $res_array; 

	  $this->load->view('contact_address/view_list',$data);	
	}
		
		
	public function add()
	{				
	  $data['heading_title'] = 'Add Contact Address';
			
	  $this->form_validation->set_rules('country_name','Country',"trim|required|unique[wl_contact_address.country_name='".$this->input->post('country_name',TRUE)."' AND status!='2']|max_length[80]|xss_clean");
	  $this->form_validation->set_rules('address','Address','trim|required|max_length[400]|xss_clean');

	  if($this->form_validation->run()==TRUE)
	  {
		$address = $this->input->post('address',TRUE);

		$map_coordinates = $this->getlatlng($address);

		//trace($map_coordinates);exit;

		$latitude = $map_coordinates[0];

		$latitude = $latitude=='' ? null : $latitude;

		$longitude = $map_coordinates[1];

		$longitude = $longitude=='' ? null : $longitude;

		$posted_data = array(
							'country_name'=>$this->input->post('country_name',TRUE),
							'address'=>$address,
							'latitude'=>$latitude,
							'longitude'=>$longitude,
							'post_date'   =>$this->config->item('config.date.time')
							);

		  $this->pages_model->safe_insert('wl_contact_address',$posted_data,FALSE);
		  $this->session->set_userdata(array('msg_type'=>'success'));
		  $this->session->set_flashdata('success',lang('success'));		
		  redirect('sitepanel/contact_address', '');
	  }

	  $this->load->view('contact_address/view_add',$data);		

	}
	   
	  
	   
	public function edit()
	{


	  $data['heading_title'] = 'Edit Contact Address';
	  $Id = (int) $this->uri->segment(4);
	  $rowdata=$this->db->get_where('wl_contact_address',array('sl'=>$Id,'status !='=>'2'))->row();

	  if( is_object($rowdata) )
	  { 
		$this->form_validation->set_rules('country_name','Country',"trim|required|unique[wl_contact_address.country_name='".$this->input->post('country_name',TRUE)."' AND status!='2' AND sl!='".$rowdata->sl."']|max_length[80]|xss_clean");
		$this->form_validation->set_rules('address','Address','trim|required|max_length[400]|xss_clean');

		if($this->form_validation->run()==TRUE)
		{
		  $address = $this->input->post('address',TRUE);

		  $map_coordinates = $this->getlatlng($address);

		  $latitude = $map_coordinates[0];

		  $latitude = $latitude=='' ? null : $latitude;

		  $longitude = $map_coordinates[1];

		  $longitude = $longitude=='' ? null : $longitude;

		  $posted_data = array(																		'country_name'=>$this->input->post('country_name',TRUE),
							'address'=>$address,
							'latitude'=>$latitude,
							'longitude'=>$longitude
							  );

		  $where = "sl = '".$rowdata->sl."'"; 						
		  $this->pages_model->safe_update('wl_contact_address',$posted_data,$where,FALSE);	
		  $this->session->set_userdata(array('msg_type'=>'success'));
		  $this->session->set_flashdata('success',lang('successupdate'));		
		  redirect('sitepanel/contact_address/'.query_string(), ''); 	

		}

		$data['res']=$rowdata;
		$this->load->view('contact_address/view_edit',$data);

	  }
	  else
	  {
		redirect('sitepanel/contact_address', ''); 	 
	  }
	}

	public function getlatlng($address='')
	{
	  $address = (empty($address)) ? "33A,Rama road Industrial Area,kirti nagar,delhi-110015" : $address;

	  $address = urlencode($address);

	  echo $url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.trim($address).'&sensor=false&api_key=AIzaSyAg-kEaNr3B0YlLNLZCLI_sJIecb5d-HtM';


	  $json = @file_get_contents($url);
	  $data=json_decode($json);

	  $status = $data->status;
	  $results = $data->results;
	  if($status=="OK")
	  {
		if(is_object($results[0]->geometry->location))
		{
		  $lat = $results[0]->geometry->location->lat;
		  $lng = $results[0]->geometry->location->lng;
		  //trace(array($lat,$lng));
		  return array($lat,$lng);	
		}
		else
		{
		  return false;	
		}
	  }
	  else
	  {
		return false;
	  }

	} 

	public function addCountry()
	{
	  $res = $this->db->select('name')->get_where('wl_countries')->result_array();
	  foreach($res as $val)
	  {
		$posted_data = array(
							  'country_name'=>$val['name'],
							  'post_date'   =>$this->config->item('config.date.time')
				                      );
				
				$this->shipping_model->safe_insert('wl_contact_address',$posted_data,FALSE);
	  }
	}

}
//controllet end