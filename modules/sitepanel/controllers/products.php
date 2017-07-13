<?php
class Products extends Admin_Controller
{
	public function __construct()
	{		
		parent::__construct(); 				
		$this->load->model(array('products/product_model','quotes/quote_model'));  
		$this->load->helper(array('category/category','products/product','quotes/quote'));
		$this->config->set_item('menu_highlight','product management');
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		$this->default_view = 'products';				
	}
	 
	public  function index()
	{
		if( $this->input->post('status_action')!='')
		{	
			$action = $this->input->post('status_action',TRUE);	
			$arr_ids = $this->input->post('arr_ids',TRUE);
			if($action == 'Delete')
			{
			  if( is_array($arr_ids) )
			  {
				$err_flag = 0;
				$succ_flag = 0;	
				foreach($arr_ids as $prdId)
				{

				  $quot_res = $this->db->select('count(quotation_id) as gtotal')->get_where('wl_request_quotation',array('ref_product_id'=>$prdId,'poster_status'=>'1'))->row();

				  if($quot_res->gtotal > 0)
				  {
					$err_flag = 1;
				  }
				  else
				  {
					$succ_flag = 1;
					$posted_data = array(
										  'status'=>'2'
									   );
					$where = "products_id ='".$prdId."'";
					$this->product_model->safe_update('wl_products',$posted_data,$where,TRUE);
				  }
				}
				if(!$err_flag)
				{
				  $this->session->set_userdata(array('msg_type'=>'success'));
				  $this->session->set_flashdata('success',lang('deleted') );
				}
				elseif(!$succ_flag)
				{
				  $this->session->set_userdata(array('msg_type'=>'error'));
				  $this->session->set_flashdata('error',"The selected record(s) has some quotations.Please delete them first");
				}
				else
				{
				  $this->session->set_userdata(array('msg_type'=>'error'));
				  $this->session->set_flashdata('error',lang('deleted')." <br />But some selected record(s) has quotations.Please delete them first" );
				}	
				redirect($_SERVER['HTTP_REFERER'], '');
			  }
			}
			else
			{			
			  $this->update_status('wl_products','products_id');
			}			
		}
		if( $this->input->post('update_order')!='')
		{			
			$this->update_displayOrder('wl_products','sort_order','products_id');			
		}
		
		/* record set as a */
		
		if( $this->input->post('set_as')!='' )
		{	
		    $set_as    = $this->input->post('set_as',TRUE);			
			$this->set_as('wl_products','products_id',array($set_as=>'1'));			
		}
		
		if( $this->input->post('unset_as')!='' )
		{	
		    $unset_as   = $this->input->post('unset_as',TRUE);		
			$this->set_as('wl_products','products_id',array($unset_as=>'0'));			
		}
		/* End record set as a */
		
		 $pagesize               =  (int) $this->input->get_post('pagesize');
	     $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');		 		 				
		 $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;		
		 $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));				 
		$keyword = trim($this->input->get_post('keyword',TRUE));		
		$keyword = $this->db->escape_str($keyword);

		$status = trim($this->input->get_post('status',TRUE));

		$vendor_status = trim($this->input->get_post('vendor_status',TRUE));

		$prod_for = trim($this->input->get_post('prod_for',TRUE));

		$prod_for = (int) $prod_for;

		$prod_type = trim($this->input->get_post('prod_type',TRUE));

		$vendor_id = (int) $this->input->get_post('vendor_id');

		$category_id = (int) $this->input->get_post('category_id');

		$condtion = "";
	     
		if($keyword!='')
		{
			$condtion.= " AND a.prod_title like '%".$keyword."%'";
		}

		if($prod_type !='')
		{
			$condtion.= " AND a.prod_type = '".$prod_type."'";
		}

		if($prod_for > 0)
		{
			switch($prod_for)
			{
			  case '1':
				$condtion.= " AND (a.prod_for = '1' OR a.prod_for = '3')";
			  break;
			  case '2':
				$condtion.= " AND (a.prod_for = '2' OR a.prod_for = '3')";
			  break;
			  case '3':
				$condtion.= " AND (a.prod_for = '3')";
			  break;
			}
		}

		if($category_id > 0)
		{
			$condtion.= " AND c.category_id = '".$category_id."'";
		}

		if($vendor_id > 0)
		{
			$condtion.= " AND a.mem_id = '".$vendor_id."'";
		}

		if($status!='')
		{
			$condtion.= " AND a.status = '".$status."'";
		}

		if($vendor_status!='')
		{
			$condtion.= " AND a.user_status = '".$vendor_status."'";
		}

		$condtion = trim($condtion," AND ");
									
		$condtion_array = array(
								'offset'=>$offset,
								'limit'=>$config['limit'],
								'debug'=>FALSE
							  );

		if($condtion != '')
		{
		  $condtion_array['where'] = $condtion;
		}

		$condtion_array['exjoin'] = array();

		$condtion_array['exjoin'][] = array('tbl'=>'wl_product_category as c','condition'=>"a.products_id=c.ref_product_id");

		$res_array              =  $this->product_model->get_products($condtion_array);
						
		$config['total_rows']	=  get_found_rows();	
		
		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);
				
		$data['heading_title']  =  'Products/Services';
						
		$data['res']            =  $res_array;

		$data['category_id'] = $category_id;

		$data['vendor_id'] = $vendor_id; 
		
		$this->load->view($this->default_view.'/view_product_list',$data);		
		
		
	}

	public function details()
	{
		
		$product_id   = (int) $this->uri->segment(4);
		
		$condtion_array = array(
								'fields'=>"a.*,m.media as product_image,c.category_id",
								'where'=>"a.status !='2' AND a.products_id ='".$product_id."'",
								'offset'=>0,
								'limit'=>1,
								'debug'=>FALSE
							  );

	  $condtion_array['exjoin'][] = array('tbl'=>'wl_product_category as c','condition'=>"a.products_id=c.ref_product_id");

	  $mres              =  $this->product_model->get_products($condtion_array);
		
	  if(is_array($mres) && !empty($mres))
	  {
		$mres = $mres[0];
		$data['heading_title']  = 'Product Details';
		$data['mres']      = $mres;		
		$this->load->view('products/view_product_detail',$data);
	  }
	  else
	  {
		echo "Invalid record";
	  }
	}

	public function quotation()
	{
	
		if( $this->input->post('status_action')!='')
		{	
			$action = $this->input->post('status_action',TRUE);	
			$arr_ids = $this->input->post('arr_ids',TRUE);
			if($action == 'Delete')
			{
			  if( is_array($arr_ids) )
			  {
				foreach($arr_ids as $prdId)
				{
				  $posted_data = array(
										'poster_status'=>'2',
										'vendor_status'=>'2'
									 );
				  $where = "quotation_id ='".$prdId."'";
				  $this->product_model->safe_update('wl_request_quotation',$posted_data,$where,TRUE);

				  /* Delete Replies */

				  $where = array('ref_quot_id'=>$prdId);
				  $this->product_model->safe_delete('wl_reply_quotation',$where,TRUE);

				  /* Delete Feedbacks */

				  $where = array('ref_quot_id'=>$prdId);
				  $this->product_model->safe_delete('wl_quotation_feedback',$where,TRUE);
				}
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('deleted') );
				redirect($_SERVER['HTTP_REFERER'], '');
			  }
			}
			else
			{			
			  $this->update_status('wl_products','products_id');
			}			
		}
		
		 $pagesize               =  (int) $this->input->get_post('pagesize');
	     $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');		 		 				
		 $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;		
		 $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));

					 
		$where = "b.status !='2'";

		$product_id = (int) $this->input->get_post('product_id');

		if($product_id > 0)
		{
		  $where .= " AND ref_product_id='".$product_id."'";
		}

		$member_id = (int) $this->input->get_post('member_id');

		if($member_id > 0)
		{
		  $where .= " AND posted_by='".$member_id."'";
		}

		$keyword = trim($this->input->get_post('keyword',TRUE));		
		$keyword = $this->db->escape_str($keyword);

		if($keyword !='')
		{
		  $where.= " AND b.prod_title like '%".$keyword."%'";
		}

		$quot_mode = (int) $this->input->get_post('quot_mode');

		if($quot_mode > 0)
		{
		  $where .= " AND quotation_mode='".$quot_mode."'";
		}

		$status = $this->input->get_post('status');

		if($status !='')
		{
		  $where .= " AND poster_status='".$status."'";
		}

		$vendor_status = $this->input->get_post('vendor_status');

		if($vendor_status != '')
		{
		  $where .= " AND vendor_status='".$vendor_status."'";
		}

		$where = trim($where,' AND');

		$condtion_array = array(
								'fields'=>"SQL_CALC_FOUND_ROWS a.*,b.prod_title,b.prod_type,b.prod_for,b.short_description,b.friendly_url,b.status,b.user_status,c.company_name,c.status as company_status,c.friendly_url as company_url",
								'where'=>$where,
								'offset'=>$offset,
								'limit'=>$config['limit'],
								'debug'=>FALSE
							  );

		$condtion_array['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=b.mem_id");

		$res_array              =  $this->quote_model->get_quotes($condtion_array);
						
		$config['total_rows']	=  get_found_rows();	
		
		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);
				
		$data['heading_title']  =  'Manage Quotation';
						
		$data['res']            =  $res_array;

		$data['product_id'] = $product_id;

		$data['member_id'] = $member_id; 
		
		$this->load->view($this->default_view.'/view_quotation_list',$data);		
		
		
	}

	public function quotation_reply()
	{
	  $quoteId = (int) $this->input->get_post('quotation_id');

	  $pagesize               =  (int) $this->input->get_post('pagesize');

	  $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');

	  $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	

	  $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));

	  $condtion_array = array(
							  'fields'=>"SQL_CALC_FOUND_ROWS a.*,c.company_name,c.first_name",
							  'where'=>"a.ref_quot_id ='".$quoteId."'",
							  'offset'=>$offset,
							  'limit'=>$config['limit'],
							  'debug'=>FALSE
							);

	 $condtion_array['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=a.posted_by");

	  $reply_res              =  $this->quote_model->get_reply($condtion_array);

	  $config['total_rows']	=  get_found_rows();	

	  $data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);

	  $data['heading_title']  =  'Quotation reply';

	  $data['res']            =  $reply_res;

	  $data['offset'] = $offset;

	  $this->load->view($this->default_view.'/view_quotation_reply',$data);		
	
	}

	public function quotation_feedback()
	{
		$pagesize               =  (int) $this->input->get_post('pagesize');

		$config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');

		$offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	

		$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));

		$feed_type = $this->input->get_post('type');

		$feed_type = $feed_type=='' ? '-1' : $feed_type;
		$feed_type = !in_array($feed_type,array('complain','suggestion','queries')) ? 'complain' : $feed_type;

		$where = "b.status !='2'";

		$quotation_id = $this->input->get_post('quotation_id');

		if($quotation_id > 0)
		{
		  $where .= " AND ref_quot_id ='".$quotation_id."'";
		}


		switch($feed_type)
		{
		  case 'complain':
			$where .= " AND a.feed_type ='1'";
			$feedback_heading = "Complaints";
			$feed_trk = 'complain';
		  break;
		  case'suggestion':
			$where .= " AND a.feed_type ='2'";
			$feedback_heading = "Suggestions";
			$feed_trk = 'suggestion';
		  break;
		  case'queries':
			$where .= " AND a.feed_type ='3'";
			$feedback_heading = "Queries";
			$feed_trk = 'queries';
		  break;
		}

		$where = trim($where,' AND');

		$condtion_array = array(
							  'fields'=>"SQL_CALC_FOUND_ROWS a.*,b.prod_title,b.prod_type,b.prod_for,d.first_name,d.user_name,c.comments,c.ref_product_id,c.quot_type",
							  'where'=>$where,
							  'offset'=>$offset,
							  'limit'=>$config['limit'],
							  'debug'=>FALSE
							);

		$res_feedback = $this->quote_model->get_feedback($condtion_array);

		$total_rows = get_found_rows();

		$config['total_rows']	=  $total_rows;	

		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);

		$data['heading_title']  =  $feedback_heading;

		$data['res']            =  $res_feedback;

		$data['offset'] = $offset;

		$data['quotation_id'] = $quotation_id;

		$data['feed_trk'] = $feed_trk;

		$this->load->view($this->default_view.'/view_feedback_list',$data);		

	}
	
	
	public function delete()
	{
	  $prdId = (int) $this->uri->segment(4,0);
	  $rowdata=$this->product_model->get_product_by_id($prdId);

	  if( !is_array($rowdata) )
	  {
		  $this->session->set_flashdata('message', lang('idmissing'));	
		  redirect('sitepanel/products', ''); 	
		  
	  }
	  else
	  {
		  
		  $where = array('products_id'=>$prdId);
		  $this->product_model->safe_delete('wl_products',$where,TRUE);

		  /* Delete Product Attributes */

		  $where = array('ref_product_id'=>$prdId);
		  $this->product_model->safe_delete('wl_product_attributes',$where,TRUE);

		  /* Delete Product Accessories */

		  $where = array('ref_product_id'=>$prdId);
		  $this->product_model->safe_delete('wl_product_accessories',$where,TRUE);

		  /* Delete Product Category */

		  $where = array('ref_product_id'=>$prdId);
		  $this->product_model->safe_delete('wl_product_category',$where,TRUE);

		  /* Delete Product Media */


		  /* Delete Product Meta */

		  $friendly_url_val = $rowdata['friendly_url'];

		  $where = array('entity_id'=>$prdId,'page_url'=>$friendly_url_val);
		  $this->product_model->safe_delete('wl_meta_tags',$where,TRUE);

		  $this->session->set_userdata(array('msg_type'=>'success'));
		  $this->session->set_flashdata('success',lang('deleted') );
			  
		  
		  redirect($_SERVER['HTTP_REFERER'], '');
	  }
	  

	}
	
	public function download_attachment()
	{
	  $mediaId = (int) $this->uri->segment(4);

	  $res_array = $this->db->select('media')->get_where('wl_attachments',array('sl'=>$mediaId,'media_type'=>'docs'))->row_array();

	  if(is_array($res_array) && !empty($res_array))
	  {
		  if($res_array['media']!='' && file_exists(UPLOAD_DIR."/attachment/".$res_array['media']))
		  {
			  $this->load->helper('download');
			  $data = file_get_contents(UPLOAD_DIR."/attachment/".$res_array['media']);
			  $name = $res_array['media'];
			  force_download($name, $data); 
		  }

	  }
	}

	public function quote_details()
	{
	  $quoteId = (int) $this->uri->segment(4);
	  $res = $this->db->get_where('wl_request_quotation',array('quotation_id'=>$quoteId))->row_array();
	  if(is_array($res) && !empty($res))
	  {
		$data['res'] = $res;
		switch($res['quot_type'])
		{
		  case 'motor_insurance':
			$view = 'members/quotes/motor_insurance_details';
		  break;
		  case 'health_insurance':
			$view = 'members/quotes/health_insurance_details';
		  break;
		  case 'banking_finance_insurance':
			$view = 'members/quotes/banking_finance_insurance_details';
		  break;
		}
		if($view!='')
		{
		  $data['view'] = $view;
		  $this->load->view('products/quote_details',$data);
		}
	  }
	}
}
// End of controller