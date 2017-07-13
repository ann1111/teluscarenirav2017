<?php
class Social_media_links extends Admin_Controller
{
	public function __construct()
	{		
		parent::__construct(); 				
		$this->load->model(array('social_media_links/social_media_links_model'));
		$this->config->set_item('menu_highlight','other management');				
	}
	 
	public  function index()
	{
		
		
		 $pagesize               =  (int) $this->input->get_post('pagesize');
	     $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');		 		 				
		 $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;		
		 $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));				 
		 $parent_id              =   (int) $this->uri->segment(4,0);			
	     
		 $keyword = trim($this->input->get_post('keyword',TRUE));		
		 $keyword = $this->db->escape_str($keyword);
	     $condtion = " ";
		 
		
									
		$condtion_array = array(
						  'field' =>"*",
						  'condition'=>$condtion,
						  'limit'=>$config['limit'],
						  'offset'=>$offset	,
						  'debug'=>FALSE
						 );							 						 	
		$res_array              =  $this->social_media_links_model->getsocial_media_links($condtion_array);
						
		$config['total_rows']	=  $this->social_media_links_model->total_rec_found;	
		
		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);
				
		$data['heading_title']  =  'Social Media Links';
						
		$data['res']            =  $res_array; 	
		
		$data['parent_id']      =  $parent_id; 	
		
		
		if( $this->input->post('status_action')!='')
		{			
			$this->update_status('wl_social_media_links','media_id');			
		}
		if( $this->input->post('update_order')!='')
		{			
			//$this->update_displayOrder('wl_social_media_links','sort_order','media_id');			
		}
						
		$this->load->view('social_media_links/view_social_media_links_list',$data);		
		
		
	}	
	
	public function add()
	{
		   
		  
	}
	
	
	public function edit()
	{
		$mediaId = (int) $this->uri->segment(4);
		
		$rowdata=$this->social_media_links_model->get_link_by_id($mediaId);
				
		$mediaId = $rowdata['media_id'];
		
		$data['heading_title'] = 'Social Media Links';
		
		
		
		if( !is_array($rowdata) )
		{
			$this->session->set_flashdata('message', lang('idmissing'));	
			redirect('sitepanel/social_media_links', ''); 	
			
		}
		
			$this->form_validation->set_rules('brand_url','URL',"trim|max_length[220]|xss_clean");	 		
			
			if($this->form_validation->run()==TRUE)
			{	
				$posted_data = array(
					'media_url'=>($this->input->post('media_url')!='' ? $this->input->post('media_url') : null)
				 );
				 
			 	$where = "media_id = '".$mediaId."'"; 				
				$this->social_media_links_model->safe_update('wl_social_media_links',$posted_data,$where,FALSE);	
							
				$this->session->set_userdata(array('msg_type'=>'success'));				
				$this->session->set_flashdata('success',lang('successupdate'));								
				
				redirect('sitepanel/social_media_links'.'/'.query_string(), ''); 	
							
			}						
			
		$data['edit_result']=$rowdata;		
		$this->load->view('social_media_links/view_social_media_links_edit',$data);				
		
	}
	
	
}
// End of controller