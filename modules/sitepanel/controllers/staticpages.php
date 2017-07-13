<?php
class Staticpages extends Admin_Controller {

	public function __construct()
	{		
		parent::__construct(); 			  
		$this->load->model(array('pages/pages_model'));  		
		$this->config->set_item('menu_highlight','other management');
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");		
	}
	
	
	public  function index()
	{
		if($this->input->post('status_action')!='')
		{
			
			$this->update_status('wl_cms_pages','page_id');
			
		}

		$parent_result = "";

		$pagesize               =  (int) $this->input->get_post('pagesize');
		
	    $config['limit']		=  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
			
		$offset                 = ($this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;
		
		$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));

		$parent_id               =  (int) $this->input->get_post('parent_id');

		$keyword = $this->db->escape_str($this->input->get_post('keyword'));

		$condition = "";
		
		if($keyword!='')
		{
		  $condition .= " AND page_name LIKE '%".$keyword."%'";
		}

		$condition .= " AND parent_id = '".$parent_id."'";

		if($parent_id > 0)
		{
		  

		  $parent_result = $this->pages_model->get_cms_page(array('page_id'=>$parent_id,'is_nested'=>'Y','status !='=>'2'));
		}

						  
		$qry_opts = array(
								  'condition'=>$condition,
								  'debug'=>FALSE

								);
				
		$res_array              =  $this->pages_model->get_all_cms_page($offset,$config['limit'],$qry_opts);
		
		$total_record        	=  $this->pages_model->total_rec_found;	
		
		$data['page_links']     =  admin_pagination("$base_url",$total_record,$config['limit'],$offset);		
		$data['heading_title']  = 'Manage Static Pages';
		$data['pagelist']       = $res_array; 			
		$data['offset'] = $offset;
		$data['parent_result'] = $parent_result;		
		$this->load->view('staticpage/staticpage_list_index_view',$data); 	
		
		
	}

	public function pagedatadisplay()
	{
		$id = (int) $this->uri->segment(4);
		$res = $this->pages_model->getStaticpage_by_id($id); 
		
		$data['heading_title'] = 'Static Pages';
		$data['page_title']    = 'View Page Information';
		$data['pageresult']    =$res;		
		$this->load->view('staticpage/statispage_detail_view',$data);
	}

	public function edit()
	{
		$data['ckeditor']  =  set_ck_config(array('textarea_id'=>'page_desc'));					
		$page_id = (int) $this->uri->segment(4);
		$res = $this->pages_model->get_cms_page(array('page_id'=>$page_id));
				
		if( is_array( $res ) )
		{ 	
		  $parent_res = $this->pages_model->get_cms_page(array('page_id'=>$res['parent_id'],'status !='=>'2'));
				
		  if( !is_array( $res ) || empty($res) )
		  { 	
			  $this->session->set_userdata(array('msg_type'=>'error'));
			  $this->session->set_flashdata('success','Invalid Access');					  redirect('sitepanel/staticpages/', ''); 	
		  }

		  if($res['parent_id'] > 0)
		  {
			$this->form_validation->set_rules('page_name', 'Page Name',"trim|max_length[50]|xss_clean|unique[wl_cms_pages.page_name='".$this->db->escape_str($this->input->post('page_name'))."' AND parent_id='".$res['parent_id']."' AND page_id!='".$res['page_id']."']");
		  }


		  $seo_url_length = $this->config->item('seo_url_length');

		  $page_name = $this->db->escape_str($this->input->post('page_name'));
			
		  $this->form_validation->set_rules('page_name', 'Page Name',"trim|max_length[50]|xss_clean|unique[wl_cms_pages.page_name='".$page_name."' AND parent_id='".$res['parent_id']."' AND page_id!='".$res['page_id']."']");

		  
		  $this->cbk_friendly_url = seo_url_title($this->input->post('friendly_url',TRUE));
		 
		  if($res['is_url_fixed']=='N')
		  {

			$this->form_validation->set_rules('friendly_url','Page URL',"trim|required|max_length[$seo_url_length]|xss_clean|unique[wl_meta_tags.page_url='".$this->cbk_friendly_url."' AND entity_id!='".$res['page_id']."'] ");
		  }	  
			
		  $this->form_validation->set_rules('page_short_description', 'Heading','trim|max_length[2500]');
		  $this->form_validation->set_rules('page_description', 'Description','required|max_length[8500]');				
		  
		  if ($this->form_validation->run() == TRUE)
		  {
								  
				  $posted_data = array(
				  'page_description'=>$this->input->post('page_description',TRUE),
				  'page_updated_date'=>$this->config->item('config.date.time')
				  );

				  if($res['is_url_fixed']=='N')
				  {
					$posted_data['friendly_url'] = $this->cbk_friendly_url;
				  }
				  
				  $where = "page_id = '".$res['page_id']."'"; 						
				  $this->pages_model->safe_update('wl_cms_pages',$posted_data,$where,FALSE);

				  if($res['is_url_fixed']=='N')
				  {
					update_meta_page_url('pages/index',$res['page_id'],$this->cbk_friendly_url);
				  }
	
				  $this->session->set_userdata(array('msg_type'=>'success'));
				  $this->session->set_flashdata('success',lang('successupdate'));				
				  redirect('sitepanel/staticpages/'.query_string(), ''); 	
								  
			  
		  }		 
			
			
		  $data['heading_title']  = 'Edit Static Pages';
		  $data['page_title']     = 'Edit Information';
		  $data['pageresult']     = $res;
		  $data['parent_result']  = $parent_res;		
		  $this->load->view('staticpage/statispage_edit_view',$data);
			
		}else
		{
			redirect('sitepanel/staticpages','');
		}
	}

	public function add()
	{
		
		$data['ckeditor']  =  set_ck_config(array('textarea_id'=>'page_desc'));					
		$parent_id = (int) $this->uri->segment(4);
		$res = $this->pages_model->get_cms_page(array('page_id'=>$parent_id,'is_nested'=>'Y','status !='=>'2'));
				
		if( is_array( $res ) )
		{ 
		  $seo_url_length = $this->config->item('seo_url_length');

		  $page_name = $this->db->escape_str($this->input->post('page_name'));
			
		  $this->form_validation->set_rules('page_name', 'Page Name',"trim|max_length[50]|xss_clean|unique[wl_cms_pages.page_name='".$page_name."' AND parent_id='".$res['page_id']."']");

		  
		  $this->cbk_friendly_url = 	$res['friendly_url']."/".seo_url_title($page_name);
		 

		  $this->form_validation->set_rules('friendly_url','Page URL',"trim|required|max_length[$seo_url_length]|xss_clean|unique[wl_meta_tags.page_url='".$this->cbk_friendly_url."'] ");

		  $this->form_validation->set_rules('page_description', 'Description','required|max_length[8500]');				
		  
		  if ($this->form_validation->run() == TRUE)
		  {
			  $redirect_url = "pages/index";
					  
			  $posted_data = array(
			  'parent_id'=>$res['page_id'],
			  'friendly_url' => $this->cbk_friendly_url,
			  'page_name'=>$this->input->post('page_name',TRUE),
			  'page_description'=>$this->input->post('page_description',TRUE),
			  'page_updated_date'=>$this->config->item('config.date.time')
			  );
			  
			  $insertId = $this->pages_model->safe_insert('wl_cms_pages',$posted_data,FALSE);

			  if( $insertId > 0 )
			  {
				$meta_array  = array(
								'entity_type'=>$redirect_url,
								'entity_id'=>$insertId,
								'page_url'=>$this->cbk_friendly_url,
								'meta_title'=>get_text($this->input->post('page_name'),80),
								'meta_description'=>get_text($this->input->post('page_description')),
								'meta_keyword'=>get_keywords($this->input->post('page_description'))
								);

				create_meta($meta_array);
			  }	
			  $this->session->set_userdata(array('msg_type'=>'success'));
			  $this->session->set_flashdata('success',lang('success'));				
			  redirect('sitepanel/staticpages?parent_id='.$res['page_id'], ''); 	
		  }		 
			
			
		  $data['heading_title']  = 'Add Pages';
		  $data['page_title']     = 'Add Information';
		  $data['parent_result']  = $res;		
		  $this->load->view('staticpage/statispage_add_view',$data);
			
		}else
		{
		  $this->session->set_userdata(array('msg_type'=>'error'));
		  $this->session->set_flashdata('success','Add page permission denied');
		  redirect('sitepanel/staticpages','');
		}
	}

	public function check_seo_url($fld,$id)
	{
	  if(strlen($this->cbk_friendly_url) > $this->config->item('seo_url_length'))
	  {
		$this->form_validation->set_message('check_seo_url', lang('seo_url_limit_excess'));
			
		return FALSE;
	  }
	  $where = array('page_url'=>$this->cbk_friendly_url);
	  if($id > 0)
	  {
		$where['meta_id !='] = $id;
	  }	
	  $meta_qry = $this->db->select('meta_id')->from('wl_meta_tags')->where($where)->get();
	  
	  if($meta_qry->num_rows() > 0)
	  {
		$this->form_validation->set_message('check_seo_url', lang('seo_url_exists'));
			
		return FALSE;
	  }
	  return TRUE;
	}
}
// End of controller