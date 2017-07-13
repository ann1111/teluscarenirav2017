<?php
class Category extends Public_Controller
{
	
	public function __construct()
	{
		parent::__construct();  
		$this->load->helper(array('category/category','products/product'));	 
		$this->load->model(array('category/category_model'));
		
	}

	public function index()
	{
		$this->cat_type = 'category';
		$this->category();
	}

	

	public function category()
	{
	    $this->page_section_ct = 'category';

		$rsegments = $this->uri->rsegments;

		$load_products = FALSE;

			
		
		$parent_id              = $this->meta_info['entity_id'];

		if($parent_id > 0)
		{
		  $subcat_res = $this->db->query("SELECT count(category_id) as gtotal FROM wl_categories WHERE parent_id='".$parent_id."' AND status='1'")->row();

		  

		  $total_subcat = (int) $subcat_res->gtotal;

		  if(!$total_subcat)
		  {
			$load_products = TRUE;
		  }
		  else
		  {
			$this->page_section_ct = 'subcategory';
		  }
		}
		
		if($load_products === FALSE)
		{
		  $base_url               = $this->uri->uri_string;

		  $heading_title = "Products By Category";

		  $data['title'] = "Category";

		  $parentdata = "";
		  
		  $record_per_page        = (int) $this->input->get_post('per_page');
		  
				  
		  $config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');
		  
		  $offset                 =  (int) $this->input->get_post('offset');
		  
		  
		  $condtion_array = array(
		  'field' =>"*,( SELECT COUNT(category_id) FROM wl_categories AS b
		  WHERE b.parent_id=a.category_id AND b.status='1' ) AS total_subcategories",
		  'condition'=>"AND parent_id = '$parent_id' AND status='1' ",
		  'order'=>'sort_order',
		  'debug'=>FALSE
		  );	

		  $condtion_array['offset'] = $offset;
		  $condtion_array['limit'] = $config['per_page'];

		  if($parent_id>0)
		  {
			  $parentdata = get_db_single_row('wl_categories','*'," category_id='$parent_id'");
			  if(is_array($parentdata) && !empty($parentdata))
			  {
				$heading_title = $parentdata['category_name'];
			  }
		  }
		  
		  
		  $res_array              =  $this->category_model->getcategory($condtion_array);
						  
		  $config['total_rows']	=  $this->category_model->total_rec_found;

		  $data['total_records'] = $config['total_rows'];
		   
		  
		  $data['page_links']     = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$offset);
		  
		  $data['base_url'] = $base_url;
		  
		  $data['heading_title'] = $heading_title;

		  $data['res'] = $res_array; 	
		  
		  $data['parentres']=$parentdata;
		  
		  $data['unq_section'] = isset($parentdata) && is_array($parentdata) ? "Subcategory" : "Category";

		  $page_view = $parent_id > 0 ? 'category' : 'category';

		  $data['page_view'] = $page_view;
		  
		  if(preg_match('~(('.$this->config->item('individual_url_prefix').'|'.$this->config->item('corporate_url_prefix').')/?)~',$base_url,$matches))
		  {
			$data['cat_type'] = $matches[2];
		  }
		  else
		  {
			$data['cat_type'] =  $this->config->item('individual_url_prefix');
		  }

		  $ajx_req = $this->input->is_ajax_request();

		  if($ajx_req===TRUE)
		  {
			
			$this->load->view('category/load_'.$page_view,$data);
		  }
		  else
		  {
			
			$this->load->view('category/view_'.$page_view,$data);
		  }
		}
		else
		{
		  load_products();
		}
	}

	public function vendor_category()
	{
		$parent_id = (int) $this->meta_info['entity_id'];

		$record_per_page        = (int) $this->input->post('per_page');		
		
		$offset = (int) $this->input->post('offset');
		
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');		
		
		
		$base_url               = $this->uri->uri_string;
			
									
		$condtion_array = array(
								'condition'=>"AND parent_id = '$parent_id' AND status='1' ",
								'order'=>'sort_order',
								'offset'=>$offset,
								'limit'=>$config['per_page'],
								'debug'=>FALSE
							  );

		$res_array              =  $this->category_model->getcategory($condtion_array);
						  
		$total_rows	=  $this->category_model->total_rec_found;	
		$config['total_rows']	= $total_rows;
		$data['total_records'] = $total_rows;		
	    //$data['page_links']      = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$offset);			
	    $data['title'] = "Category";
		$data['res'] = $res_array; 	
		$data['base_url'] = $base_url;
		$data['parent_id']  = $parent_id;

		$ajx_req = $this->input->is_ajax_request();
			  
		if($ajx_req===TRUE)
		{	
		  $this->load->view('category/load_vendor_category',$data);
		}
		else
		{
		  $this->load->view('category/view_vendor_category',$data);
		}
			 
	}

	public function vendors()
	{
		$this->load->model('vendors/vendor_model');

		$catid = (int) $this->meta_info['entity_id'];

		$record_per_page        = (int) $this->input->post('per_page');		
		
		$offset = (int) $this->input->post('offset');
		
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');		
		
		
		$base_url               = $this->uri->uri_string;
			
									
		$condtion_array = array(
								'where'=>"a.status ='1' AND a.user_type = '2' AND a.is_verified ='1'",
								'offset'=>$offset,
								'limit'=>$config['per_page'],
								'debug'=>FALSE
							  );

		if($catid > 0)
		{
		  $condtion_array['where'] .= " AND a.ref_cat_id ='".$catid."'";

		}

		$res_array               = $this->vendor_model->get_members($condtion_array);	
		
				
		$total_rows = get_found_rows();		
		$config['total_rows']	= $total_rows;
		$data['total_records'] = $total_rows;		
	    $data['page_links']      = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$offset);			
	    $data['title'] = "Vendors";
		$data['res'] = $res_array; 	
		$data['base_url'] = $base_url;
		$data['catid']  = $catid;

		$ajx_req = $this->input->is_ajax_request();
			  
		if($ajx_req===TRUE)
		{	
		  $this->load->view('category/load_vendors',$data);
		}
		else
		{
		  $this->load->view('category/view_vendors',$data);
		}
			 
	}

	public function vendor_details()
	{
	  $this->load->model(array('vendors/vendor_model','products/product_model','comments/comments_model'));

	  $vendorId = (int) $this->meta_info['entity_id'];
	  $condtion_array = array(
								'where'=>"a.status ='1' AND a.customers_id ='".$vendorId."' AND a.user_type = '2' AND a.is_verified ='1'",
								'offset'=>0,
								'limit'=>1,
								'debug'=>FALSE
							  );

	  $res               = $this->vendor_model->get_members($condtion_array);
	  if(is_array($res) && !empty($res))
	  {
		$res = $res[0];

		$data['error_validate'] = TRUE;;

		if($this->input->post('post_review')!='')
		{
		  $this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		  $this->form_validation->set_rules('review_to','Review To','trim|required|max_length[1]');
		  $this->form_validation->set_rules('ads_rating','Rating','trim|required|max_length[1]');
		  $this->form_validation->set_rules('author','Name','trim|required|max_length[70]');
		  $this->form_validation->set_rules('author_email','Email','trim|required|max_length[80]|valid_email');	
		  $this->form_validation->set_rules('comment','Review','trim|required|max_length[450]');
		  $this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code[review]');
		   
		  if($this->form_validation->run()===TRUE)
		  {
			 $mem_id = $this->session->userdata('user_id');
			 $posted_data=array(		
								  'entity_id'  => $res['customers_id'],
								  'entity_type'  => 'customer',
								  'customer_id'   => $mem_id,
								  'review_to'		=> $this->input->post('review_to'),	
								  'ads_rating'		=> $this->input->post('ads_rating'),
								  'author'  => $this->input->post('author'),
								  'author_email'  => $this->input->post('author_email'),
								  'text'  => $this->input->post('comment'),
								  'status'=>'1',						
								  'review_date'             => $this->config->item('config.date.time')
								  );			
			  $this->comments_model->safe_insert('wl_review',$posted_data,FALSE); 

			  $red_links = $res['friendly_url'];
			  $this->session->set_userdata('msg_type','success');
			  $this->session->set_flashdata('success','Thank you. Your review has been submitted successfully'); 
			  redirect($red_links, ''); 
		  }
		  $data['error_validate'] = FALSE;
		}

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
								'where'=>"a.user_status ='1' AND a.status ='1' AND a.mem_id ='".$res['customers_id']."'",
								'offset'=>0,
								'limit'=>12,
								'debug'=>FALSE
							  );

				$res_products              =  $this->product_model->get_products($condtion_array);
								
				$total_products	=  get_found_rows();

				//Reviews

				$qry_options = array(
							  'limit'	  => 200,
							  'offset'	  => 0,
							  'condition' => " AND entity_id ='".$res['customers_id']."' AND entity_type='customer' AND b.status='1'"

							);
									 						 	
	 			$review_res               =  $this->comments_model->get_comments($qry_options);	

				$data['review_res'] = $review_res;

				$data['res_products'] = $res_products;

				$data['total_products'] = $total_products;

				$data['res'] = $res;

				$base_url  = $this->uri->uri_string;

				$data['base_url'] = $base_url;

				$this->load->view('category/view_vendor_details',$data);

			}
		   break;
		}
		
		
	  }
	  else
	  {
		redirect('vendors/category');
	  }
	}

	public function get_category_dn()
	{
	  $parent_id = (int) $this->input->post('category_id');

	  $selected_id = "";

	  if($parent_id > 0)
	  {	
		$res_array = $this->db->select('category_name,category_id')->get_where('wl_categories',array('status'=>'1','parent_id'=>$parent_id))->result_array();

		$data['res'] =  $res_array;
		$data['selected_id']    = $selected_id;
		$data['option_val_field'] = 'category_id';
		$data['option_text_field'] = 'category_name';
		$this->load->view('remote/load_attributes',$data);
	  }
	
	}
	
}
/* End of file member.php */
/* Location: .application/modules/products/controllers/products.php */
