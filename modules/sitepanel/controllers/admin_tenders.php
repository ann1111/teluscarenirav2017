<?php
class Admin_tenders extends Admin_Controller
{
	public function __construct()
	{		
		parent::__construct(); 				
		$this->load->model(array('quotes/quote_model','quotes/admin_quote_model'));  
		$this->load->helper(array('quotes/quote','products/product'));
		$this->config->set_item('menu_highlight','tender request');
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		$this->default_view = 'tender_request';				
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
				foreach($arr_ids as $prdId)
				{
				  $posted_data = array(
										'poster_status'=>'2',
										'vendor_status'=>'2'
									 );
				  $where = "quotation_id ='".$prdId."'";
				  $this->admin_quote_model->safe_update('wl_admin_tenders',$posted_data,$where,TRUE);

				  /* Delete Replies */

				  $where = array('ref_quot_id'=>$prdId);
				  $this->product_model->safe_delete('wl_tender_reply',$where,TRUE);
				}
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('deleted') );
				redirect($_SERVER['HTTP_REFERER'], '');
			  }
			}
			else
			{			
			  //$this->update_status('wl_admin_tenders','quotation_id');
			}			
		}
		
		 $pagesize               =  (int) $this->input->get_post('pagesize');
	     $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');		 		 				
		 $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;		
		 $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));

		$where = "a.vendor_status !='2' AND a.poster_status !='2'";

		$quot_mode = (int) $this->input->get_post('quot_mode');

		if($quot_mode > 0)
		{
		  $where .= " AND quotation_mode='".$quot_mode."'";
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
		  $where.= " AND a.tender_title like '%".$keyword."%'";
		}

		$condtion_array = array(
								'fields'=>"SQL_CALC_FOUND_ROWS a.*",
								'where'=>$where,
								'offset'=>$offset,
								'limit'=>$config['limit'],
								'debug'=>FALSE
							  );			 
		
		$where = trim($where,' AND');

		
		$res_array              =  $this->admin_quote_model->get_quotes($condtion_array);
						
		$config['total_rows']	=  get_found_rows();	
		
		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);
				
		$data['heading_title']  =  'Tender Request';
						
		$data['res']            =  $res_array;

		$data['member_id'] = $member_id; 
		
		$this->load->view($this->default_view.'/view_quotation_list',$data);	
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

	
	public  function tender_reply()
	{
		  if( $this->input->post('status_action')!='')
		  {	
			$this->update_status('wl_tender_reply','reply_id');
		  }

		  $pagesize               =  (int) $this->input->get_post('pagesize');
	     $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');		 		 				
		 $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;		
		 $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));

		$where = "d.poster_status !='2' AND d.vendor_status !='2'";

		$quotation_id = (int) $this->input->get_post('quotation_id');

		if($quotation_id > 0)
		{
		  $where .= " AND a.ref_quot_id ='".$quotation_id."'";
		}

		$condtion_array = array(
							  'fields'=>"SQL_CALC_FOUND_ROWS a.*,d.tender_title,d.comments as tender_comment,c.company_name,c.first_name,c.last_name",
							  'where'=>$where,
							  'offset'=>$offset,
							  'limit'=>$config['limit'],
							  'debug'=>FALSE
							);

		$condtion_array['exjoin'][] = array('tbl'=>'wl_admin_tenders as d','condition'=>"d.quotation_id=a.ref_quot_id");

		$condtion_array['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=a.posted_by",'type'=>"LEFT");

		$reply_res              =  $this->admin_quote_model->get_reply($condtion_array);
						
		$config['total_rows']	=  get_found_rows();	
		
		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);
				
		$data['heading_title']  =  'Tender Replies';
						
		$data['res']            =  $reply_res;

		$data['quotation_id'] = $quotation_id;
		
		$this->load->view($this->default_view.'/view_reply_list',$data);	
	}

	public function sbp_list()
	{
		$quoteId = (int) $this->uri->segment(4);

		$condtion_array = array(
							  'where'=>"a.quotation_id ='".$quoteId."' AND a.poster_status !='2'",
							  'fields'=>'a.quotation_id,a.ref_product_id',
							  'offset'=>0,
							  'limit'=>1,
							  'debug'=>FALSE
							);

		$res_array              =  $this->admin_quote_model->get_quotes($condtion_array);

		if(is_array($res_array) && !empty($res_array))
		{
		  $res_array = $res_array[0];

		  $pagesize               =  (int) $this->input->get_post('pagesize');

		  $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');

		  $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;

		  $ref_product_id = array('-99');

		  if($res_array['ref_product_id']!='')
		  {
			$ref_product_id  = explode(',',$res_array['ref_product_id']); 
		  }

		  $where = "a.poster_status ='1' AND a.quotation_id IN (".implode(',',$ref_product_id).")";

		  $condtion_array = array(
										  'fields'=>"a.quotation_id,a.vendor_id,a.ref_product_id,a.date_added,b.prod_title,b.prod_type,b.prod_for,b.status,b.user_status,c.company_name",
										  'where'=>$where,
										  'offset'=>0,
										  'limit'=>50,
										  'debug'=>FALSE
										);

		  $condtion_array['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=b.mem_id");

		  $res_vendors = $this->quote_model->get_quotes($condtion_array);

		  $total_rows = get_found_rows();

		  //$config['total_rows'] = $total_rows;

		  //$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);

		  $data['heading_title'] = "SBP List";

		  $data['page_links'] = '';

		  $data['res_vendors'] = $res_vendors;

		  $data['offset'] = $offset;

		  $this->load->view($this->default_view.'/view_sbp_list',$data);
		}

	}


	public function reply_quotation($res)
	{
		$quoteId = (int) $this->uri->segment(4);

		$condtion_array = array(
							  'where'=>"a.quotation_id ='".$quoteId."' AND a.poster_status !='2'",
							  'fields'=>'a.quotation_id,a.vendor_id',
							  'offset'=>0,
							  'limit'=>1,
							  'debug'=>FALSE
							);

		$res              =  $this->admin_quote_model->get_quotes($condtion_array);

		if(is_array($res) && !empty($res))
		{
		  $res = $res[0];

		  $max_attachment = $this->config->item('max_request_quotation_attachment');

		  if($this->input->post('post')!='')
		  {
			

			$this->form_validation->set_error_delimiters("<div class='required'>","</div>");

			$img_allow_size =  $this->config->item('allow.file.size');

			$this->form_validation->set_rules('subject', 'Subject','trim|required|max_length[300]|xss_clean');

			$this->form_validation->set_rules('comments', 'Comments','trim|required|max_length[800]|xss_clean');

			for($ik=1;$ik<=$max_attachment;$ik++)
			{
			  $this->form_validation->set_rules('attachment'.$ik,'Attachment',"file_allowed_type[document,image]|file_size_max[$img_allow_size]");
			}
			if($this->form_validation->run()===TRUE)
			{
				$posted_data = array(
										'ref_quot_id'=>$res['quotation_id'],
										'posted_by'=>0,
										'vendor_id'=>$res['vendor_id'],
										'subject'=>$this->input->post('subject')!='' ? $this->input->post('subject') : null,
										'comments'=>$this->input->post('comments'),
										'date_added'=>$this->config->item('config.date.time')

									 );

				$insertId = $this->admin_quote_model->safe_insert('wl_tender_reply',$posted_data,FALSE);

				if($insertId > 0)
				{	

					$quote_data = array(
								  'quotation_mode'=>'2'
								);
	  
					$where = "quotation_id = '".$res['quotation_id']."'";

					$this->admin_quote_model->safe_update('wl_admin_tenders', $quote_data,$where ,FALSE );
			
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
													'media_section'=>'reply_tenders',
													'media_type'=>'docs',
													'ref_id'=>$insertId,
													'media'=>$uploaded_file			
													);
									$this->admin_quote_model->safe_insert('wl_attachments',$posted_data,FALSE);
								
								}		
								
							}
						}
					  }
					}
				}
				$dtl_link = 'members/admin_quotes/quote_details/'.$res['quotation_id'];

				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success','Your  reply has been posted successfully');
				?>
				<script type="text/javascript">
				  window.opener.location.reload();
				  this.close();
				</script>
				<?php
				//redirect($dtl_link,'');
			}
			
		  }
		  $data['res'] = $res;
		  $data['max_attachment'] = $max_attachment;
		  $this->load->view($this->default_view.'/view_reply_form',$data);
		}
		else
		{
		  echo "Invalid record";
		}
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

	public  function tender_coupons()
	{
		 $pagesize               =  (int) $this->input->get_post('pagesize');
	     $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');		 		 				
		 $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;		
		 $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));

		$where = "a.vendor_status !='2' AND a.poster_status !='2' AND a.quotation_mode ='2'";

		
		$member_id = (int) $this->input->get_post('member_id');

		if($member_id > 0)
		{
		  $where .= " AND posted_by='".$member_id."'";
		}

		$keyword = trim($this->input->get_post('keyword',TRUE));		
		$keyword = $this->db->escape_str($keyword);

		if($keyword !='')
		{
		  $where.= " AND a.tender_title like '%".$keyword."%'";
		}

		$condtion_array = array(
								'fields'=>"SQL_CALC_FOUND_ROWS a.*",
								'where'=>$where,
								'offset'=>$offset,
								'limit'=>$config['limit'],
								'debug'=>FALSE
							  );			 
		
		$where = trim($where,' AND');

		
		$res_array              =  $this->admin_quote_model->get_quotes($condtion_array);
						
		$config['total_rows']	=  get_found_rows();	
		
		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);
				
		$data['heading_title']  =  'Manage Tender Coupons';
						
		$data['res']            =  $res_array;

		$data['member_id'] = $member_id; 
		
		$this->load->view($this->default_view.'/view_tender_coupon_quotes',$data);	
	}
}
// End of controller