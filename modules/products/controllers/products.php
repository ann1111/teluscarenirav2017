<?php
class Products extends Public_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('products/product_model'));
		$this->load->helper(array('category/category','products/product'));	 
	}

	
	
	public function index()
	{
		$this->page_section_ct = 'product';

		load_products();
		
	}

	public function detail()
	{
	  $this->load->model(array('vendors/vendor_model','products/product_model'));

	  $productId = (int) $this->meta_info['entity_id'];

	  $condtion_array = array(
								'fields'=>"a.*,m.media as product_image,c.category_id",
								'where'=>"a.user_status ='1' AND a.status ='1' AND e.status ='1' AND a.products_id ='".$productId."'",
								'offset'=>0,
								'limit'=>1,
								'debug'=>FALSE
							  );

	  $condtion_array['exjoin'][] = array('tbl'=>'wl_product_category as c','condition'=>"a.products_id=c.ref_product_id");

	  $condtion_array['exjoin'][] = array('tbl'=>'wl_customers as e','condition'=>"e.customers_id=a.mem_id");

	  $res              =  $this->product_model->get_products($condtion_array);



	  
	  if(is_array($res) && !empty($res))
	  {
		$res = $res[0];

		$ajx_req = $this->input->is_ajax_request();

		$load_action = $this->input->post('load_action');

		switch($load_action)
		{
		   case 'review':

		   break;
		   case 'services':
			if($ajx_req === TRUE)
			{	
				$record_per_page        = (int) $this->input->post('per_page');

				$offset = (int) $this->input->post('offset');
		
				$per_page		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');

				$condtion_array = array(
								'where'=>"a.user_status ='1' AND a.status ='1' AND a.mem_id ='".$res['customers_id']."'",
								'offset'=>$offset,
								'limit'=>$per_page,
								'debug'=>FALSE
							  );

				$res_products              =  $this->product_model->get_products($condtion_array);

				$data['res_products'] = $res_products;

				$this->load->view('category/load_vendor_products',$data);
			}
		   break;
		   default:
			if($ajx_req === FALSE)
			{
				//Products
				$condtion_array = array(
								'where'=>"a.user_status ='1' AND a.status ='1' AND a.mem_id ='".$res['mem_id']."' AND a.products_id!='".$res['products_id']."'",
								'offset'=>0,
								'limit'=>12,
								'debug'=>FALSE
							  );

				

				$res_products              =  $this->product_model->get_products($condtion_array);
								
				$total_products	=  get_found_rows();

				//Vendor

				$condtion_array = array(
								'where'=>"a.status ='1' AND a.customers_id ='".$res['mem_id']."' AND a.user_type = '2' AND a.is_verified ='1'",
								'offset'=>0,
								'limit'=>1,
								'debug'=>FALSE
							  );

				$res_vendor               = $this->vendor_model->get_members($condtion_array);	

				$data['vendor_res'] = $res_vendor;

				$data['res_products'] = $res_products;

				$data['total_products'] = $total_products;

				$data['res'] = $res;

				$base_url  = $this->uri->uri_string;

				$data['base_url'] = $base_url;

				$this->load->view('products/view_product_details',$data);

			}
		   break;
		}
		
		
	  }
	  else
	  {
		redirect('category');
	  }
	}

	public function request_quotation()
	{
		$productId = (int) $this->uri->segment(3);

		

		$condtion_array = array(
								  'fields'=>"a.*,m.media as product_image,c.category_id",
								  'where'=>"a.user_status ='1' AND a.status ='1' AND a.products_id ='".$productId."'",
								  'offset'=>0,
								  'limit'=>1,
								  'debug'=>FALSE
								);

		$condtion_array['exjoin'][] = array('tbl'=>'wl_product_category as c','condition'=>"a.products_id=c.ref_product_id");

		$res              =  $this->product_model->get_products($condtion_array);



		
		if(is_array($res) && !empty($res))
		{
		  $res = $res[0];

		  if($this->userId == 0)
		  {
			redirect('users/login?ref=products/request_quotation/'.$res['products_id'],'');
		  }
		  elseif($this->userType == 2)
		  {
			$this->session->set_userdata(array('msg_type'=>'error'));
			$this->session->set_flashdata('error','You cannot request quotation');
			redirect($res['friendly_url'],'');
		  }

		  $cat_res = $this->db->select('cat_type')->get_where('wl_categories',array('category_id'=>$res['category_id']))->row_array();
		  if(is_array($cat_res) && !empty($cat_res))
		  {
			$cat_type = !is_null($cat_res['cat_type']) ? $cat_res['cat_type'] : 'common';
		  }
		  else
		  {
			$cat_type = "common";
		  }

		  //$cat_type = "health_insurance";

		  switch($cat_type)
		  {
			case 'common':
			  $this->process_quotation_form_common($res);
			break;
			case 'motor_insurance':
			  $this->process_quotation_form_motor_insurance($res);
			break;
			case 'health_insurance':
			  $this->process_quotation_form_health_insurance($res);
			break;
			case 'banking_finance_insurance':
			  $this->process_quotation_form_banking_finance_insurance($res);
			break;
		  }

		  $max_attachment = $this->config->item('max_request_quotation_attachment');

		  
		  $data['max_attachment'] = $max_attachment;
		  $data['cat_type'] = $cat_type;
		  $data['res'] = $res;
		  $this->load->view('products/request_quotation',$data);
		  
		}
		else
		{
		  redirect('category');
		}
	}

	public function process_quotation_form_motor_insurance($res)
	{
		if($this->input->post('post')!='')
		{
		  $max_attachment = $this->config->item('max_request_quotation_attachment');

		  $this->form_validation->set_error_delimiters("<div class='required db'>","</div>");

		  $img_allow_size =  $this->config->item('allow.file.size');
  
		  $this->form_validation->set_rules('data_type', 'Type','trim|required|xss_clean');

		  $data_type = $this->input->post('data_type');

		  if($data_type == 'group_fleet')
		  {
			$this->form_validation->set_rules('name1', 'Name','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('country1', 'Country','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('landline_no', 'Landline No','trim|required|max_length[30]|xss_clean');

			$this->form_validation->set_rules('city1', 'City','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('company_name1', 'Company Name','trim|required|max_length[250]|xss_clean');

			$this->form_validation->set_rules('looking_for1', 'Looking For','trim|required|is_natural|max_length[2]|xss_clean');

			$this->form_validation->set_rules('type_establishment', 'Type Of Establishment','trim|required|is_natural|max_length[2]|xss_clean');

			$this->form_validation->set_rules('designation', 'Designation','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|max_length[70]|xss_clean');

			$this->form_validation->set_rules('company_nature', 'Job Nature of company','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('no_vehicles', 'No of vehicles','trim|required|is_natural|max_length[100000]|xss_clean');

		  }
		  elseif($data_type == 'individual_motor')
		  {
			$this->form_validation->set_rules('name2', 'Name','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('country2', 'Country','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('city2', 'City','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('company_name2', 'Company Name','trim|required|max_length[250]|xss_clean');

			$this->form_validation->set_rules('looking_for2', 'Looking For','trim|required|max_length[2]|xss_clean');

			$this->form_validation->set_rules('model_name', 'Model Name','trim|required|max_length[150]|xss_clean');
  
			$this->form_validation->set_rules('make_year', 'Make Year','trim|required|max_length[30]|xss_clean');

			$this->form_validation->set_rules('value_motor', 'Value of Motor','trim|required|max_length[70]|xss_clean');

		  }

		  $this->form_validation->set_rules('comments', 'Comments','trim|required|max_length[800]|xss_clean');

		  for($ik=1;$ik<=$max_attachment;$ik++)
		  {
			$this->form_validation->set_rules('attachment'.$ik,'Attachment',"file_allowed_type[document,image]|file_size_max[$img_allow_size]");
		  }
		  if($this->form_validation->run()===TRUE)
		  {
			  $posted_data = array(
									  'quot_type'=>'motor_insurance',
									  'data_type'=>$data_type,
									  'ref_product_id'=>$res['products_id'],
									  'posted_by'=>$this->userId,
									  'vendor_id'=>$res['mem_id'],
									  'comments'=>$this->input->post('comments'),
									  'date_added'=>$this->config->item('config.date.time')

								   );

			  if($data_type=='group_fleet')
			  {
				$name = $this->input->post('name1')!='' ? $this->input->post('name1') : null;

				$posted_data['name'] = $name;

				$email = $this->input->post('email')!='' ? $this->input->post('email') : null;

				$posted_data['email'] = $email;

				$country = $this->input->post('country1')!='' ? $this->input->post('country1') : null;

				$posted_data['country'] = $country;
  
				$city = $this->input->post('city1')!='' ? $this->input->post('city1') : null;

				$posted_data['city'] = $city;

				$landline_no = $this->input->post('landline_no')!='' ? $this->input->post('landline_no') : null;

				$posted_data['landline_no'] = $landline_no;

				$company_name = $this->input->post('company_name1')!='' ? $this->input->post('company_name1') : null;

				$posted_data['company_name'] = $company_name;

				$looking_for = $this->input->post('looking_for1')!='' ? $this->input->post('looking_for1') : null;

				$posted_data['looking_for'] = $looking_for;

				$type_establishment = $this->input->post('type_establishment')!='' ? $this->input->post('type_establishment') : null;

				$posted_data['type_establishment'] = $type_establishment;

				$designation = $this->input->post('designation')!='' ? $this->input->post('designation') : null;

				$posted_data['designation'] = $designation;

				$company_nature = $this->input->post('company_nature')!='' ? $this->input->post('company_nature') : null;

				$posted_data['company_nature'] = $company_nature;

				$no_vehicles = $this->input->post('no_vehicles')!='' ? $this->input->post('no_vehicles') : null;

				$posted_data['no_vehicles'] = $no_vehicles;

			  }
			  if($data_type=='individual_motor')
			  {
				$name = $this->input->post('name2')!='' ? $this->input->post('name2') : null;

				$posted_data['name'] = $name;

				$country = $this->input->post('country2')!='' ? $this->input->post('country2') : null;

				$posted_data['country'] = $country;
  
				$city = $this->input->post('city2')!='' ? $this->input->post('city2') : null;

				$posted_data['city'] = $city;

				$company_name = $this->input->post('company_name2')!='' ? $this->input->post('company_name2') : null;

				$posted_data['company_name'] = $company_name;

				$looking_for = $this->input->post('looking_for2')!='' ? $this->input->post('looking_for2') : null;

				$posted_data['looking_for'] = $looking_for;

				$model_name = $this->input->post('model_name')!='' ? $this->input->post('model_name') : null;

				$posted_data['model_name'] = $model_name;

				$make_year = $this->input->post('make_year')!='' ? $this->input->post('make_year') : null;

				$posted_data['make_year'] = $make_year;

				$value_motor = $this->input->post('value_motor')!='' ? $this->input->post('value_motor') : null;

				$posted_data['value_motor'] = $value_motor;

			  }


			  $insertId = $this->product_model->safe_insert('wl_request_quotation',$posted_data,FALSE);

			  if($insertId > 0)
			  {	
		  
				  if(is_array($_FILES) && !empty($_FILES))
				  {
					$this->load->library('upload');
		
					foreach($_FILES as $fkey=>$fval)
					{
					  if(preg_match("~(attachment)~",$fkey,$matches))
					  {
						  $folder = $matches[1];
						  if( $fval['name']!='' )
						  {			  
							  $uploaded_data =  $this->upload->my_upload($fkey,$folder);
						  
							  if( is_array($uploaded_data)  && !empty($uploaded_data) )
							  { 								
								  $uploaded_file = $uploaded_data['upload_data']['file_name'];

								  $posted_data = array(
												  'media_section'=>'request_quotation',
												  'media_type'=>'docs',
												  'ref_id'=>$insertId,
												  'media'=>$uploaded_file			
												  );
								  $this->product_model->safe_insert('wl_attachments',$posted_data,FALSE);
							  
							  }		
							  
						  }
					  }
					}
				  }
			  }
			  $this->session->set_userdata(array('msg_type'=>'success'));
			  $this->session->set_flashdata('success','Your  request has been posted successfully');
			  redirect($res['friendly_url'],'');
		  }
		}
	}

	public function process_quotation_form_banking_finance_insurance($res)
	{
		if($this->input->post('post')!='')
		{
		  $max_attachment = $this->config->item('max_request_quotation_attachment');

		  $this->form_validation->set_error_delimiters("<span class='required db'>","</span>");

		  $img_allow_size =  $this->config->item('allow.file.size');
  
		  $this->form_validation->set_rules('data_type', 'Type','trim|required|xss_clean');

		  $data_type = $this->input->post('data_type');

		  if($data_type == 'sme_corporate')
		  {
			$this->form_validation->set_rules('name1', 'Name','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('country1', 'Country','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('landline_no', 'Landline No','trim|required|max_length[30]|xss_clean');

			$this->form_validation->set_rules('mobile_no', 'Mobile No','trim|required|max_length[15]|xss_clean');


			$this->form_validation->set_rules('city1', 'City','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('company_name1', 'Company Name','trim|required|max_length[250]|xss_clean');

			$this->form_validation->set_rules('looking_for1', 'Looking For','trim|required|is_natural|max_length[2]|xss_clean');

			$this->form_validation->set_rules('type_establishment', 'Type Of Establishment','trim|required|is_natural|max_length[2]|xss_clean');

			$this->form_validation->set_rules('designation', 'Designation','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('email1', 'Email','trim|required|valid_email|max_length[70]|xss_clean');

			$this->form_validation->set_rules('company_nature', 'Job Nature of company','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('no_employees', 'No of Employees','trim|required|is_natural|max_length[10000000]|xss_clean');

			$this->form_validation->set_rules('company_annual_turnover', 'Annual Turn Over','trim|required|max_length[30]|xss_clean');

			$this->form_validation->set_rules('old_company', 'How Old Company','trim|required|max_length[40]|xss_clean');

		  }
		  elseif($data_type == 'individual_finance')
		  {
			$this->form_validation->set_rules('terms', 'Terms &amp; Conditions','trim|required|xss_clean');

			$this->form_validation->set_rules('name2', 'Name','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('country2', 'Country','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('city2', 'City','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('company_name2', 'Company Name','trim|required|max_length[250]|xss_clean');

			$this->form_validation->set_rules('looking_for2', 'Looking For','trim|required|max_length[2]|xss_clean');

			$this->form_validation->set_rules('email2', 'Email','trim|required|valid_email|max_length[70]|xss_clean');
  
			$this->form_validation->set_rules('age', 'Age','trim|required|is_natural|less_than[90]|xss_clean');

			$this->form_validation->set_rules('length_service', 'Length of service in company','trim|required|max_length[30]|xss_clean');

			$this->form_validation->set_rules('salary_per_month', 'Salary per month ','trim|required|valid_price|less_than[400000]|xss_clean');

		  }

		  $this->form_validation->set_rules('comments', 'Comments','trim|required|max_length[800]|xss_clean');

		  for($ik=1;$ik<=$max_attachment;$ik++)
		  {
			$this->form_validation->set_rules('attachment'.$ik,'Attachment',"file_allowed_type[document,image]|file_size_max[$img_allow_size]");
		  }
		  if($this->form_validation->run()===TRUE)
		  {
			  $posted_data = array(
									  'quot_type'=>'banking_finance_insurance',
									  'data_type'=>$data_type,
									  'ref_product_id'=>$res['products_id'],
									  'posted_by'=>$this->userId,
									  'vendor_id'=>$res['mem_id'],
									  'comments'=>$this->input->post('comments'),
									  'date_added'=>$this->config->item('config.date.time')

								   );

			  if($data_type=='sme_corporate')
			  {
				$name = $this->input->post('name1')!='' ? $this->input->post('name1') : null;

				$posted_data['name'] = $name;

				$email = $this->input->post('email1')!='' ? $this->input->post('email1') : null;

				$posted_data['email'] = $email;

				$country = $this->input->post('country1')!='' ? $this->input->post('country1') : null;

				$posted_data['country'] = $country;
  
				$city = $this->input->post('city1')!='' ? $this->input->post('city1') : null;

				$posted_data['city'] = $city;

				$landline_no = $this->input->post('landline_no')!='' ? $this->input->post('landline_no') : null;

				$posted_data['landline_no'] = $landline_no;

				$mobile_no = $this->input->post('mobile_no')!='' ? $this->input->post('mobile_no') : null;

				$posted_data['mobile_no'] = $mobile_no;

				$company_name = $this->input->post('company_name1')!='' ? $this->input->post('company_name1') : null;

				$posted_data['company_name'] = $company_name;

				$looking_for = $this->input->post('looking_for1')!='' ? $this->input->post('looking_for1') : null;

				$posted_data['looking_for'] = $looking_for;

				$type_establishment = $this->input->post('type_establishment')!='' ? $this->input->post('type_establishment') : null;

				$posted_data['type_establishment'] = $type_establishment;

				$designation = $this->input->post('designation')!='' ? $this->input->post('designation') : null;

				$posted_data['designation'] = $designation;

				$company_nature = $this->input->post('company_nature')!='' ? $this->input->post('company_nature') : null;

				$posted_data['company_nature'] = $company_nature;

				$company_annual_turnover = $this->input->post('company_annual_turnover')!='' ? $this->input->post('company_annual_turnover') : null;

				$posted_data['company_annual_turnover'] = $company_annual_turnover;

				$old_company = $this->input->post('old_company')!='' ? $this->input->post('old_company') : null;

				$posted_data['old_company'] = $old_company;

				$no_employees = $this->input->post('no_employees')!='' ? $this->input->post('no_employees') : null;

				$posted_data['no_employees'] = $no_employees;

			  }
			  if($data_type=='individual_finance')
			  {
				$name = $this->input->post('name2')!='' ? $this->input->post('name2') : null;

				$posted_data['name'] = $name;

				$email = $this->input->post('email2')!='' ? $this->input->post('email2') : null;

				$posted_data['email'] = $email;


				$country = $this->input->post('country2')!='' ? $this->input->post('country2') : null;

				$posted_data['country'] = $country;
  
				$city = $this->input->post('city2')!='' ? $this->input->post('city2') : null;

				$posted_data['city'] = $city;

				$company_name = $this->input->post('company_name2')!='' ? $this->input->post('company_name2') : null;

				$posted_data['company_name'] = $company_name;

				$looking_for = $this->input->post('looking_for2')!='' ? $this->input->post('looking_for2') : null;

				$posted_data['looking_for'] = $looking_for;

				$age = $this->input->post('age')!='' ? $this->input->post('age') : null;

				$posted_data['age'] = $age;

				$length_service = $this->input->post('length_service')!='' ? $this->input->post('length_service') : null;

				$posted_data['length_service'] = $length_service;

				$salary_per_month = $this->input->post('salary_per_month')!='' ? $this->input->post('salary_per_month') : null;

				$posted_data['salary_per_month'] = $salary_per_month;


			  }

			  $insertId = $this->product_model->safe_insert('wl_request_quotation',$posted_data,FALSE);

			  if($insertId > 0)
			  {	
		  
				  if(is_array($_FILES) && !empty($_FILES))
				  {
					$this->load->library('upload');
		
					foreach($_FILES as $fkey=>$fval)
					{
					  if(preg_match("~(attachment)~",$fkey,$matches))
					  {
						  $folder = $matches[1];
						  if( $fval['name']!='' )
						  {			  
							  $uploaded_data =  $this->upload->my_upload($fkey,$folder);
						  
							  if( is_array($uploaded_data)  && !empty($uploaded_data) )
							  { 								
								  $uploaded_file = $uploaded_data['upload_data']['file_name'];

								  $posted_data = array(
												  'media_section'=>'request_quotation',
												  'media_type'=>'docs',
												  'ref_id'=>$insertId,
												  'media'=>$uploaded_file			
												  );
								  $this->product_model->safe_insert('wl_attachments',$posted_data,FALSE);
							  
							  }		
							  
						  }
					  }
					}
				  }
			  }
			  $this->session->set_userdata(array('msg_type'=>'success'));
			  $this->session->set_flashdata('success','Your  request has been posted successfully');
			  redirect($res['friendly_url'],'');
		  }
		}
	}

	public function process_quotation_form_health_insurance($res)
	{
		if($this->input->post('post')!='')
		{
		  $max_attachment = $this->config->item('max_request_quotation_attachment');

		  $this->form_validation->set_error_delimiters("<span class='required db'>","</span>");

		  $img_allow_size =  $this->config->item('allow.file.size');
  
		  $this->form_validation->set_rules('data_type', 'Type','trim|required|xss_clean');

		  $data_type = $this->input->post('data_type');

		  if($data_type == 'group_health')
		  {
			$this->form_validation->set_rules('name1', 'Name','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('country1', 'Country','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('landline_no', 'Landline No','trim|required|max_length[30]|xss_clean');

			$this->form_validation->set_rules('mobile_no', 'Mobile No','trim|required|max_length[15]|xss_clean');

			$this->form_validation->set_rules('city1', 'City','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('company_name1', 'Company Name','trim|required|max_length[250]|xss_clean');

			$this->form_validation->set_rules('looking_for1', 'Looking For','trim|required|is_natural|max_length[2]|xss_clean');

			$this->form_validation->set_rules('type_establishment', 'Type Of Establishment','trim|required|is_natural|max_length[2]|xss_clean');

			$this->form_validation->set_rules('designation', 'Designation','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|max_length[70]|xss_clean');

			$this->form_validation->set_rules('company_nature', 'Job Nature of company','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('approx_employees', 'Approx no. of Employees','trim|required|is_natural|max_length[100000]|xss_clean');

		  }
		  elseif($data_type == 'individual_family')
		  {
			$this->form_validation->set_rules('name2', 'Name','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('country2', 'Country','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('city2', 'City','trim|required|max_length[70]|xss_clean');

			$this->form_validation->set_rules('company_name2', 'Company Name','trim|required|max_length[250]|xss_clean');

			$this->form_validation->set_rules('looking_for2', 'Looking For','trim|required|max_length[2]|xss_clean');

			$this->form_validation->set_rules('age', 'Age','trim|required|is_natural|less_than[90]|xss_clean');
  
			$this->form_validation->set_rules('no_members', 'No. of Members','trim|required|is_natural|max_length[2]|xss_clean');

			$no_members = (int) $this->input->post('no_members');
			if($no_members > 0)
			{
			  
			  $member_name = (array) $this->input->post('member_name');
			  $member_age = (array) $this->input->post('member_age');
			  $member_sex = (array) $this->input->post('member_sex');
			  foreach($member_age as $key=>$val)
			  {
				$this->form_validation->set_rules("member_name[$key]", 'Name','trim|required|max_length[70]|xss_clean');
				$this->form_validation->set_rules("member_age[$key]", 'Age','trim|required|is_natural|less_than[90]|xss_clean');
				$this->form_validation->set_rules("member_sex[$key]", 'Sex','trim|required|max_length[1]|xss_clean');
			  }
			}
		  }

		  $this->form_validation->set_rules('comments', 'Comments','trim|required|max_length[800]|xss_clean');

		  for($ik=1;$ik<=$max_attachment;$ik++)
		  {
			$this->form_validation->set_rules('attachment'.$ik,'Attachment',"file_allowed_type[document,image]|file_size_max[$img_allow_size]");
		  }
		  if($this->form_validation->run()===TRUE)
		  {
			  $posted_data = array(
									  'quot_type'=>'health_insurance',
									  'data_type'=>$data_type,
									  'ref_product_id'=>$res['products_id'],
									  'posted_by'=>$this->userId,
									  'vendor_id'=>$res['mem_id'],
									  'comments'=>$this->input->post('comments'),
									  'date_added'=>$this->config->item('config.date.time')

								   );

			  if($data_type=='group_health')
			  {
				$name = $this->input->post('name1')!='' ? $this->input->post('name1') : null;

				$posted_data['name'] = $name;

				$email = $this->input->post('email')!='' ? $this->input->post('email') : null;

				$posted_data['email'] = $email;

				$country = $this->input->post('country1')!='' ? $this->input->post('country1') : null;

				$posted_data['country'] = $country;
  
				$city = $this->input->post('city1')!='' ? $this->input->post('city1') : null;

				$posted_data['city'] = $city;

				$landline_no = $this->input->post('landline_no')!='' ? $this->input->post('landline_no') : null;

				$posted_data['landline_no'] = $landline_no;

				$mobile_no = $this->input->post('mobile_no')!='' ? $this->input->post('mobile_no') : null;

				$posted_data['mobile_no'] = $mobile_no;

				$company_name = $this->input->post('company_name1')!='' ? $this->input->post('company_name1') : null;

				$posted_data['company_name'] = $company_name;

				$looking_for = $this->input->post('looking_for1')!='' ? $this->input->post('looking_for1') : null;

				$posted_data['looking_for'] = $looking_for;

				$type_establishment = $this->input->post('type_establishment')!='' ? $this->input->post('type_establishment') : null;

				$posted_data['type_establishment'] = $type_establishment;

				$designation = $this->input->post('designation')!='' ? $this->input->post('designation') : null;

				$posted_data['designation'] = $designation;

				$company_nature = $this->input->post('company_nature')!='' ? $this->input->post('company_nature') : null;

				$posted_data['company_nature'] = $company_nature;

				$approx_employees = $this->input->post('approx_employees')!='' ? $this->input->post('approx_employees') : null;

				$posted_data['approx_employees'] = $approx_employees;

			  }
			  if($data_type=='individual_family')
			  {
				$name = $this->input->post('name2')!='' ? $this->input->post('name2') : null;

				$posted_data['name'] = $name;


				$country = $this->input->post('country2')!='' ? $this->input->post('country2') : null;

				$posted_data['country'] = $country;
  
				$city = $this->input->post('city2')!='' ? $this->input->post('city2') : null;

				$posted_data['city'] = $city;

				$company_name = $this->input->post('company_name2')!='' ? $this->input->post('company_name2') : null;

				$posted_data['company_name'] = $company_name;

				$looking_for = $this->input->post('looking_for2')!='' ? $this->input->post('looking_for2') : null;

				$posted_data['looking_for'] = $looking_for;

				$no_members = $this->input->post('no_members')!='' ? $this->input->post('no_members') : null;

				$posted_data['no_members'] = $no_members;

				if(!is_null($no_members))
				{
					$db_arr_mem_detail = array('age'=>array(),'sex'=>array(),'name'=>array());
					$member_name = (array) $this->input->post('member_name');
					$member_age = (array) $this->input->post('member_age');
					$member_sex = (array) $this->input->post('member_sex');
					foreach($member_age as $key=>$val)
					{
					  array_push($db_arr_mem_detail['age'],$val);
					  array_push($db_arr_mem_detail['sex'],$member_sex[$key]);
					  array_push($db_arr_mem_detail['name'],$member_name[$key]);
					}

					$posted_data['member_details'] = serialize($db_arr_mem_detail);
				}

				$age = $this->input->post('age')!='' ? $this->input->post('age') : null;

				$posted_data['age'] = $age;

			  }

			  $insertId = $this->product_model->safe_insert('wl_request_quotation',$posted_data,FALSE);

			  if($insertId > 0)
			  {	
		  
				  if(is_array($_FILES) && !empty($_FILES))
				  {
					$this->load->library('upload');
		
					foreach($_FILES as $fkey=>$fval)
					{
					  if(preg_match("~(attachment)~",$fkey,$matches))
					  {
						  $folder = $matches[1];
						  if( $fval['name']!='' )
						  {			  
							  $uploaded_data =  $this->upload->my_upload($fkey,$folder);
						  
							  if( is_array($uploaded_data)  && !empty($uploaded_data) )
							  { 								
								  $uploaded_file = $uploaded_data['upload_data']['file_name'];

								  $posted_data = array(
												  'media_section'=>'request_quotation',
												  'media_type'=>'docs',
												  'ref_id'=>$insertId,
												  'media'=>$uploaded_file			
												  );
								  $this->product_model->safe_insert('wl_attachments',$posted_data,FALSE);
							  
							  }		
							  
						  }
					  }
					}
				  }
			  }
			  $this->session->set_userdata(array('msg_type'=>'success'));
			  $this->session->set_flashdata('success','Your  request has been posted successfully');
			  redirect($res['friendly_url'],'');
		  }
		}
	}

	public function process_quotation_form_common($res)
	{
		if($this->input->post('post')!='')
		{
		  $max_attachment = $this->config->item('max_request_quotation_attachment');

		  $this->form_validation->set_error_delimiters("<span class='required db'>","</span>");

		  $img_allow_size =  $this->config->item('allow.file.size');
  
		  $this->form_validation->set_rules('comments', 'Comments','trim|required|max_length[800]|xss_clean');

		  for($ik=1;$ik<=$max_attachment;$ik++)
		  {
			$this->form_validation->set_rules('attachment'.$ik,'Attachment',"file_allowed_type[document,image]|file_size_max[$img_allow_size]");
		  }
		  if($this->form_validation->run()===TRUE)
		  {
			  $posted_data = array(
									  'quot_type'=>'common',
									  'ref_product_id'=>$res['products_id'],
									  'posted_by'=>$this->userId,
									  'vendor_id'=>$res['mem_id'],
									  'comments'=>$this->input->post('comments'),
									  'date_added'=>$this->config->item('config.date.time')

								   );

			  $insertId = $this->product_model->safe_insert('wl_request_quotation',$posted_data,FALSE);

			  if($insertId > 0)
			  {	
		  
				  if(is_array($_FILES) && !empty($_FILES))
				  {
					$this->load->library('upload');
		
					foreach($_FILES as $fkey=>$fval)
					{
					  if(preg_match("~(attachment)~",$fkey,$matches))
					  {
						  $folder = $matches[1];
						  if( $fval['name']!='' )
						  {			  
							  $uploaded_data =  $this->upload->my_upload($fkey,$folder);
						  
							  if( is_array($uploaded_data)  && !empty($uploaded_data) )
							  { 								
								  $uploaded_file = $uploaded_data['upload_data']['file_name'];

								  $posted_data = array(
												  'media_section'=>'request_quotation',
												  'media_type'=>'docs',
												  'ref_id'=>$insertId,
												  'media'=>$uploaded_file			
												  );
								  $this->product_model->safe_insert('wl_attachments',$posted_data,FALSE);
							  
							  }		
							  
						  }
					  }
					}
				  }
			  }
			  $this->session->set_userdata(array('msg_type'=>'success'));
			  $this->session->set_flashdata('success','Your  request has been posted successfully');
			  redirect($res['friendly_url'],'');
		  }
		}
	}
	
	public function advanced_search()
	{
	  $this->load->view('products/view_advanced_search','');
	}

	public function download_doc()
	{
	  $mediaId = (int) $this->uri->segment(3);

	  $res_array = $this->db->select('media')->get_where('wl_media',array('sl'=>$mediaId,'media_type'=>'docs','media_section'=>'products'))->row_array();

	  if(is_array($res_array) && !empty($res_array))
	  {
		  if($res_array['media']!='' && file_exists(UPLOAD_DIR."/product/docs/".$res_array['media']))
		  {
			  $this->load->helper('download');
			  $data = file_get_contents(UPLOAD_DIR."/product/docs/".$res_array['media']);
			  $name = $res_array['media'];
			  force_download($name, $data); 
		  }

	  }
	}
}
/* End of file member.php */
/* Location: .application/modules/products/controllers/products.php */
