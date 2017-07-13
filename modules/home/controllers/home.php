<?php
class Home extends Public_Controller
{

	public function __construct()
	{
		parent::__construct();				
		$this->load->model(array('home/home_model','products/product_model','vendors/vendor_model'));
		$this->load->helper(array('category/category'));	 
		
	}
	
	public function index()
	{
		$this->page_section_ct = 'home';
		$data = array();

		$offset = (int) $this->input->get_post('offset');

		//Products
		$condtion_array = array(
						'where'=>"a.user_status ='1' AND a.status ='1' AND c.status ='1'",
						'offset'=>0,
						'limit'=>30,
						'debug'=>FALSE
					  );

		$condtion_array['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=a.mem_id");

		$loc_country = $this->session->userdata('loc_country');
		if($loc_country !='')
		{
		  $condtion_array['where'] .= " AND c.country ='".$loc_country."'";
		}

		$product_res              =  $this->product_model->get_products($condtion_array);

		//Partners

		$condtion_array = array(
								'where'=>"a.status ='1' AND a.user_type = '2' AND a.is_verified ='1'",
								'offset'=>0,
								'limit'=>20,
								'debug'=>FALSE
							  );

		if($loc_country !='')
		{
		  $condtion_array['where'] .= " AND a.country ='".$loc_country."'";

		}

		$partner_res               = $this->vendor_model->get_members($condtion_array);	
	  
		$data['product_res'] = $product_res;

		$data['partner_res'] = $partner_res;

		$this->load->view('home',$data);	
	}

	public function change_country()
	{
	  $country_id = $this->uri->segment(3);

	  $this->session->set_userdata('loc_country',$country_id);
	  
	  redirect($_SERVER['HTTP_REFERER'],'');
	}
}