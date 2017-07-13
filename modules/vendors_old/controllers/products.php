<?php
class Products extends Private_Controller
{

	private $mId;

	public function __construct()
	{
		parent::__construct();
		if($this->mres['user_type'] == 1)
		{
		  redirect('members','');
		} 		
		$this->load->model(array('vendors/vendor_model','products/product_model'));
		$this->load->library(array('Dmailer'));
		$this->load->helper(array('category/category','products/product'));	
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");

		$this->page_section_ct = 'products';
	}

	public function index()
	{	
		$record_per_page        = (int) $this->input->post('per_page');		
		
		$offset = (int) $this->input->post('offset');
		
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');		
		
		
		$base_url               = "vendors/products";

		$condtion_array = array(
								'where'=>"a.user_status !='2' AND a.mem_id ='".$this->userId."'",
								'offset'=>$offset,
								'limit'=>$config['per_page'],
								'debug'=>FALSE
							  );

		$condtion_array['exjoin'] = array();

		$condtion_array['exjoin'][] = array('tbl'=>'wl_product_category as c','condition'=>"a.products_id=c.ref_product_id");

		$res_array              =  $this->product_model->get_products($condtion_array);
					  
	  $config['total_rows']	=  get_found_rows();

	  //$data['page_links']     = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$offset);

	  $data['heading_title'] = 'Manage Products/Services';

	  $data['res'] = $res_array;

	  $data['offset'] = $offset; 

	  $data['total_records'] = $config['total_rows'];

	  $data['base_url'] = $base_url;	
	
	  
	  $ajx_req = $this->input->is_ajax_request();
	  if($ajx_req !='')
	  {
		$this->load->view('vendors/products/load_products',$data);
	  }
	  else
	  {
		$this->load->view('vendors/products/view_products',$data);
	  }
	}

	public function post_products()
	{
		$why_to_choose = $this->input->post('why_to_choose');
		$why_to_choose = !is_array($why_to_choose) ? array() : $why_to_choose;
		$why_to_choose = array_filter($why_to_choose);
		sort($why_to_choose);
		
		$detail_description = $this->input->post('detail_description');
		$detail_description = !is_array($detail_description) ? array() : $detail_description;
		$detail_description = array_filter($detail_description);
		sort($detail_description);
  
		$config_total_images = $this->config->item('total_product_images');

		$img_allow_size =  $this->config->item('allow.file.size');

		$img_allow_dim  =  $this->config->item('allow.imgage.dimension');

		$this->form_validation->set_rules('prod_title','Product/Service Title','trim|required|max_length[100]|xss_clean');

		$this->form_validation->set_rules('prod_type','Type','trim|required|max_length[1]|xss_clean');

		$this->form_validation->set_rules('prod_for','Posting Service for ','trim|required|max_length[1]|xss_clean');

		$this->form_validation->set_rules('category_id[]','Category','trim|required|max_length[4]|xss_clean');

		$this->form_validation->set_rules('short_description','Short Description','trim|required|max_length[200]|xss_clean');

		for($i=0;$i<=4;$i++)
		{
		  $this->form_validation->set_rules("why_to_choose[$i]", 'Why to Choose', "trim|max_length[100]|xss_clean");
		}
		for($i=0;$i<=9;$i++)
		{
		  $this->form_validation->set_rules("detail_description[$i]", 'Detail Description', "trim|".(empty($detail_description) ? ($i==0 ? 'required|' : '') : '')."max_length[100]|xss_clean");
		}

		//$this->form_validation->set_rules('why_to_choose','Why to Choose This','trim|max_length[200]|xss_clean');

		//$this->form_validation->set_rules('detail_description','Detail Description','trim|required|max_length[580]|xss_clean');

		for($i=1;$i<=$config_total_images;$i++)
		{
		  $this->form_validation->set_rules('product_images'.$i,'Image'.$i,"file_allowed_type[image]|file_size_max[$img_allow_size]|check_dimension[$img_allow_dim]");
		}

		if ($this->form_validation->run() == TRUE)
		{
			$prod_title = $this->input->post('prod_title');

			$pre_friendly_url = seo_url_title($prod_title);

			$friendly_url = $pre_friendly_url."/".$this->userId;

			$unique_url = FALSE;

			while(!$unique_url)
			{
			  
			  $meta_qry  = $this->db->select('meta_id')->from('wl_meta_tags')->where(array('page_url'=>$friendly_url))->get();

			  if(!$meta_qry->num_rows())
			  {
				$unique_url = TRUE;
			  }
			  else
			  {
				$friendly_url = $pre_friendly_url."/".random_string();
			  }
			  

			}

			$why_to_choose_str = !empty($why_to_choose) ? serialize($why_to_choose) : null;

			$detail_description_str = !empty($detail_description) ? serialize($detail_description) : null;

			$posted_user_data = array(	
									  'mem_id' => $this->userId,

									  'friendly_url' => $friendly_url,
									  'product_alt'        => $this->input->post('prod_title'),
									  'prod_title'        => $this->input->post('prod_title'),
									  'prod_type'        => $this->input->post('prod_type'),
									  'prod_for'        => $this->input->post('prod_for'),
									  'detail_description'        => $detail_description_str,		
									  'short_description'        => $this->input->post('short_description')=='' ? null : $this->input->post('short_description'),
									   'why_to_choose'        => $why_to_choose_str,
									  'date_added'=>$this->config->item('config.date.time')
									);

			$productId = $this->vendor_model->safe_insert('wl_products', $posted_user_data ,FALSE );

			if( $productId > 0 )
			{
			  $meta_array  = array(
							  'entity_type'=>'products/detail/'.$productId,
							  'entity_id'=>$productId,
							  'page_url'=>$friendly_url,
							  'meta_title'=>get_text($this->input->post('prod_title'),80),
							  'meta_description'=>get_text($this->input->post('detail_description')),
							  'meta_keyword'=>get_keywords($this->input->post('detail_description'))
							  );

			  create_meta($meta_array);
			}

			$posted_category_id = $this->input->post('category_id');

			foreach($posted_category_id as $cval)
			{
			  $category_links = get_parent_categories($cval,"AND status='1'","category_id,parent_id");		
			  $category_links = array_keys($category_links);
			  $category_links = implode(",",$category_links);

			  $posted_data = array(
								  'category_id'=>$cval,
								  'category_links'=>$category_links,
								  'ref_product_id'=>$productId					
								  );

			  $this->vendor_model->safe_insert('wl_product_category',$posted_data,FALSE);
			}

			//Media
			if(is_array($_FILES) && !empty($_FILES))
			{
			  $this->load->library('upload');
  
			  foreach($_FILES as $fkey=>$fval)
			  {
				if(preg_match("~product_(images)~",$fkey,$matches))
				{
					$folder = $matches[1];
					
					if( $fval['name']!='' )
					{			  
						$uploaded_data =  $this->upload->my_upload($fkey,'product/'.$folder);
					
						if( is_array($uploaded_data)  && !empty($uploaded_data) )
						{ 								
							$uploaded_file = $uploaded_data['upload_data']['file_name'];

							$posted_data = array(
											'media_section'=>'products',
											'media_type'=>$folder,
											'ref_id'=>$productId,
											'media'=>$uploaded_file			
											);
							$this->vendor_model->safe_insert('wl_media',$posted_data,FALSE);
						
						}		
						
					}
				}
			  }
			}
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success',"Product has been added successfully");

			redirect('vendors/products','');
		}

		$data['unq_section'] = "Myaccount";	
		$data['title'] = "My Account";
		$this->load->view('vendors/products/view_post_products',$data);
	}


	public function edit_product()
	{
		$productId = (int) $this->uri->segment(4);

		$condtion_array = array(
								'where'=>"a.products_id ='".$productId."' AND a.user_status !='2' AND a.mem_id ='".$this->userId."'",
								'offset'=>0,
								'limit'=>1,
								'debug'=>FALSE
							  );

		$condtion_array['exjoin'] = array();

		$condtion_array['exjoin'][] = array('tbl'=>'wl_product_category as c','condition'=>"a.products_id=c.ref_product_id");

		$res_array              =  $this->product_model->get_products($condtion_array);

		if(is_array($res_array) && !empty($res_array))
		{
		  $res_array = $res_array[0];

		  $total_config_product_images = $this->config->item('total_product_images');

		  /* Saved Records */

		  /* Product Categories */

		  $res_product_categories = $this->db->select('category_id')->get_where('wl_product_category',array('ref_product_id'=>$productId))->result_array();

		  $db_category_ids = array();

		  if(is_array($res_product_categories) && !empty($res_product_categories))
		  {
			foreach($res_product_categories as $val)
			{
			  array_push($db_category_ids,$val['category_id']);
			}
		  }

		  /* Product Images */
  
		  $img_cond = array(
							  'where'=>"ref_id ='".$productId."' AND media_type='images' AND media_section='products'"
						   );
		  $db_product_images = $this->product_model->get_media($total_config_product_images,0,$img_cond);

		  $db_product_images = array($db_product_images);

		  /* Saved Records Ends */

		  $why_to_choose = $this->input->post('why_to_choose');
		  $why_to_choose = !is_array($why_to_choose) ? array() : $why_to_choose;
		  $why_to_choose = array_filter($why_to_choose);
		  sort($why_to_choose);

		  $detail_description = $this->input->post('detail_description');
		  $detail_description = !is_array($detail_description) ? array() : $detail_description;
		  $detail_description = array_filter($detail_description);
		  sort($detail_description);

		  $img_allow_size =  $this->config->item('allow.file.size');

		  $img_allow_dim  =  $this->config->item('allow.imgage.dimension');

		  $this->form_validation->set_rules('prod_title','Product/Service Title','trim|required|max_length[100]|xss_clean');

		  $this->form_validation->set_rules('prod_type','Type','trim|required|max_length[1]|xss_clean');

		  $this->form_validation->set_rules('prod_for','Posting Service for ','trim|required|max_length[1]|xss_clean');

		  $this->form_validation->set_rules('category_id[]','Category','trim|required|max_length[4]|xss_clean');

		  $this->form_validation->set_rules('short_description','Short Description','trim|required|max_length[200]|xss_clean');

		  

		  for($i=0;$i<=4;$i++)
		  {
			$this->form_validation->set_rules("why_to_choose[$i]", 'Why to Choose', "trim|max_length[100]|xss_clean");
		  }
		  for($i=0;$i<=9;$i++)
		  {
			$this->form_validation->set_rules("detail_description[$i]", 'Detail Description', "trim|".(empty($detail_description) ? ($i==0 ? 'required|' : '') : '')."max_length[100]|xss_clean");
		  }

		  //$this->form_validation->set_rules('why_to_choose','Why to Choose This','trim|max_length[200]|xss_clean');

		  //$this->form_validation->set_rules('detail_description','Detail Description','trim|required|max_length[580]|xss_clean');

		  for($i=1;$i<=$total_config_product_images;$i++)
		  {
			$this->form_validation->set_rules('product_images'.$i,'Image'.$i,"file_allowed_type[image]|file_size_max[$img_allow_size]|check_dimension[$img_allow_dim]");
		  }

		  if ($this->form_validation->run() == TRUE)
		  {
			  $prod_title = $this->input->post('prod_title');

			  $why_to_choose_str = !empty($why_to_choose) ? serialize($why_to_choose) : null;

			  $detail_description_str = !empty($detail_description) ? serialize($detail_description) : null;

			  
			  $posted_user_data = array(	
										'product_alt'        => $this->input->post('prod_title'),
										'prod_title'        => $this->input->post('prod_title'),
										'prod_type'        => $this->input->post('prod_type'),
										'prod_for'        => $this->input->post('prod_for'),
										'detail_description'        => $detail_description_str,		
										'short_description'        => $this->input->post('short_description')=='' ? null : $this->input->post('short_description'),
										 'why_to_choose'        => $why_to_choose_str,
										'date_updated'=>$this->config->item('config.date.time')
									  );

			  $where = "products_id = '".$productId."'";

			  $this->vendor_model->safe_update('wl_products', $posted_user_data,$where ,FALSE );

			  /* Product Categories */

			  $product_categories =  $this->input->post('category_id');

			  $product_categories = !is_array($product_categories) ? array() : $product_categories;

			  $insertable_category_ids = array_diff($product_categories,$db_category_ids);

			  

			  $removable_category_ids = array_diff($db_category_ids,$product_categories);

			  

			  if(is_array($insertable_category_ids) && !empty($insertable_category_ids))
			  {
				  foreach($insertable_category_ids as $val)
				  {
					$category_links = get_parent_categories($val,"AND status='1'","category_id,parent_id");		
					$category_links = array_keys($category_links);
					$category_links = implode(",",$category_links);

					$posted_data = array(
										'category_id'=>$val,
										'category_links'=>$category_links,
										'ref_product_id'=>$productId					
										);
					$this->product_model->safe_insert('wl_product_category',$posted_data,FALSE);
				  }
			  }

			  if(is_array($removable_category_ids) && !empty($removable_category_ids))
			  {
				  $this->db->query("DELETE FROM wl_product_category WHERE  ref_product_id='".$productId."' AND category_id IN(".implode(',',$removable_category_ids).")");
				  
			  }

			  //Media
			  $ckbox_image_delete_keys = array();

			  $post_vals = $this->input->post();

			  for($i=1;$i<=$total_config_product_images;$i++)
			  {
				  $del_fld = 'product_image'.$i.'_delete';
				  if(array_key_exists($del_fld,$post_vals))
				  {
					array_push($ckbox_image_delete_keys,($i-1));
				  }

			  }

			  $db_product_images = array_filter($db_product_images);

			  //trace($db_product_images);exit;

			  if(is_array($_FILES) && !empty($_FILES))
			  {
				$this->load->library('upload');
				foreach($_FILES as $fkey=>$fval)
				{
				  if(preg_match("~product_images(\d+)~",$fkey,$matches))
				  {
					  $jx = $matches[1] - 1;
					  if( $fval['name']!='' )
					  {
						  $uploaded_data =  $this->upload->my_upload($fkey,'product/images');
						
						  if( is_array($uploaded_data)  && !empty($uploaded_data) )
						  { 								
							  $uploaded_file = $uploaded_data['upload_data']['file_name'];

							  $posted_data = array(
													'media_section'=>'products',
													'media_type'=>'images',
													'ref_id'=>$productId,
													'media'=>$uploaded_file			
													);
							  if(!array_key_exists($jx,$db_product_images))
							  {
								$this->product_model->safe_insert('wl_media',$posted_data,FALSE);
							  }
							  else
							  {
								if(in_array($jx,$ckbox_image_delete_keys))
								{
								  $del_key = array_search($jx,$ckbox_image_delete_keys);
								  unset($ckbox_image_delete_keys[$del_key]);
								}

								$where = "sl = '".$db_product_images[$jx]['sl']."'";
   
								$this->product_model->safe_update('wl_media',$posted_data,$where,FALSE);

								$del_img_name = $db_product_images[$jx]['media'];

								$unlink_image = array('source_dir'=>"product/images",'source_file'=>$del_img_name);
								removeImage($unlink_image);
							  }
						  
						  }	
					  }
					  
				  }
				}
			  }

			  if(!empty($ckbox_image_delete_keys))
			  {
				foreach($ckbox_image_delete_keys as $kval)
				{
				  $del_id = $db_product_images[$kval]['sl'];

				  $del_img_name = $db_product_images[$kval]['media'];

				  $unlink_image = array('source_dir'=>"product/images",'source_file'=>$del_img_name);

				  removeImage($unlink_image);

				  $this->db->query("DELETE FROM wl_media WHERE  ref_id='".$productId."' AND media_type='images' AND media_section='products' AND  sl='".$del_id."'");
				}
			  }
			  $this->session->set_userdata(array('msg_type'=>'success'));
			  $this->session->set_flashdata('success',"Product has been updated successfully");

			  redirect('vendors/products','');
		  }
		  $data['res']=$res_array;
		  $data['db_product_images'] = $db_product_images;
		  $data['db_category_ids'] = $db_category_ids;
		  $data['unq_section'] = "Myaccount";	
		  $data['title'] = "My Account";
		  $this->load->view('vendors/products/view_edit_products',$data);
	  }
	  else
	  {
		$this->session->set_userdata(array('msg_type'=>'error'));
		$this->session->set_flashdata('error',"Invalid record");

		redirect('vendors/products','');
	  }
	}

	public function remove_product($wishlists_id)
   {
	  $productId = (int) $this->uri->segment(4);

	  $condtion_array = array(
							  'where'=>"a.products_id ='".$productId."' AND a.user_status !='2' AND a.mem_id ='".$this->userId."'",
							  'field'=>'a.products_id',
							  'offset'=>0,
							  'limit'=>1,
							  'debug'=>FALSE
							);

	  $res_array              =  $this->product_model->get_products($condtion_array);

	  if(is_array($res_array) && !empty($res_array))
	  {
		$res_array = $res_array[0];

		$product_data = array(
								'user_status'=>'2'
							  );
	
		$where = "products_id = '".$productId."'";

		$this->vendor_model->safe_update('wl_products', $product_data,$where ,FALSE );

		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',"Product has been deleted successfully");
	  }
	  else
	  {
		$this->session->set_userdata(array('msg_type'=>'error'));
		$this->session->set_flashdata('error',"Invalid record");
	  }
	  redirect('vendors/products',''); 
   }
	
}
/* End of file member.php */
/* Location: .application/modules/member/member.php */