<?php
class Testimonial extends Admin_Controller
{
	public function __construct()
	{		
		parent::__construct(); 				
		$this->load->model(array('testimonials/testimonial_model'));  		
		$this->config->set_item('menu_highlight','other management');				
	}
	 
	public  function index()
	{
		
		
		 $pagesize               =  (int) $this->input->get_post('pagesize');
		 		
	     $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
		 		 				
		 $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	
		
		 $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));
		 
		 
									 						 	
	 	$res_array               =  $this->testimonial_model->get_testimonial($config['limit'],$offset);
						
	    $config['total_rows']    =  get_found_rows();
		
		$data['page_links']      =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);
				
		$data['heading_title']   =   'Testimonial';
						
		$data['res']             =  $res_array; 
			
		
		if($this->input->post('status_action')!='')
		{
			
			$this->update_status('wl_testimonial','testimonial_id');
			
		}		
						
		$this->load->view('testimonial/view_testimonial_list',$data);		
		
		
	}	
	
	
	public function post()
	{	
		$img_allow_size =  $this->config->item('allow.file.size');
		$img_allow_dim  =  $this->config->item('allow.imgage.dimension');		
					
		//$this->form_validation->set_rules('testimonial_title','Title','trim|required|xss_clean|max_length[150]');
		$this->form_validation->set_rules('email','Email','trim|valid_email|xss_clean|max_length[80]');
		$this->form_validation->set_rules('poster_name','Name','trim|required|alpha|xss_clean|max_length[30]');
		$this->form_validation->set_rules('photo','Image',"file_allowed_type[image]|file_size_max[$img_allow_size]|check_dimension[$img_allow_dim]");
		$this->form_validation->set_rules('testimonial_description','Comment','trim|required|xss_clean|max_length[8500]');
	
		 $data['ckeditor']  =  set_ck_config(array('textarea_id'=>'testimonial_description'));		
		 		
		if($this->form_validation->run()==TRUE)
		{
			$uploaded_file = null;	
				
			if( !empty($_FILES) && $_FILES['photo']['name']!='' )
			{			  
				$this->load->library('upload');	
					
				$uploaded_data =  $this->upload->my_upload('photo','testimonial');
			
				if( is_array($uploaded_data)  && !empty($uploaded_data) )
				{ 								
					$uploaded_file = $uploaded_data['upload_data']['file_name'];
				
				}		
				
			}
			
			$posted_data=array(				
			'testimonial_title'      => null,
			'poster_name'             => $this->input->post('poster_name'),
			'email'                   => $this->input->post('email'),
			'testimonial_description' => $this->input->post('testimonial_description'),
			'photo'=>$uploaded_file,
			'status'=>'1',						
			'posted_date'            =>$this->config->item('config.date.time')
			);			
			$this->testimonial_model->safe_insert('wl_testimonial',$posted_data,FALSE); 			
			
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success',lang('success'));
			redirect('sitepanel/testimonial', ''); 
			
		}		
		$data['heading_title'] = "Post Testimonial";	
		$this->load->view('testimonial/view_post_testimonials',$data);	
		
		
	}
	
	
	public function edit()
	{	
	
	          $id = (int) $this->uri->segment(4);		
		      $param     = array('where'=>"testimonial_id ='$id' ");	
	    	  $res       = $this->testimonial_model->get_testimonial(1,0,$param);	
		
			if( is_array($res) && !empty($res) )
			{
				$img_allow_size =  $this->config->item('allow.file.size');
				$img_allow_dim  =  $this->config->item('allow.imgage.dimension');	
					
				//$this->form_validation->set_rules('testimonial_title','Title','trim|required|xss_clean|max_length[150]');
				$this->form_validation->set_rules('email','Email','trim|valid_email|xss_clean|max_length[80]');
				$this->form_validation->set_rules('poster_name','Name','trim|required|alpha|xss_clean|max_length[30]');
				$this->form_validation->set_rules('photo','Image',"file_allowed_type[image]|file_size_max[$img_allow_size]|check_dimension[$img_allow_dim]");
				$this->form_validation->set_rules('testimonial_description','Comment','trim|required|xss_clean|max_length[8500]');
				
				$data['ckeditor']  =  set_ck_config(array('textarea_id'=>'testimonial_description'));		
				
				if($this->form_validation->run()==TRUE)
				{
					$uploaded_file = $res['photo'];				 
					$unlink_image = array('source_dir'=>"testimonial",'source_file'=>$res['photo']);
					if($this->input->post('photo_delete')==='Y')
					 {					
						removeImage($unlink_image);						
						$uploaded_file = NULL;	
									
					 }				
					 if( !empty($_FILES) && $_FILES['photo']['name']!='' )
					 {			  
							$this->load->library('upload');	
								
							$uploaded_data =  $this->upload->my_upload('photo','testimonial');
						
							if( is_array($uploaded_data)  && !empty($uploaded_data) )
							{ 								
								$uploaded_file = $uploaded_data['upload_data']['file_name'];
								removeImage($unlink_image);	
							}
							
					}
				
					$posted_data=array(				
					'testimonial_title'       => null,
					'poster_name'             => $this->input->post('poster_name'),
					'email'                   => $this->input->post('email'),
					'testimonial_description' => $this->input->post('testimonial_description'),
					'photo'=>$uploaded_file
					);					
					 $where = "testimonial_id = '".$res['testimonial_id']."'"; 				
					 $this->testimonial_model->safe_update('wl_testimonial',$posted_data,$where,FALSE);
					 $this->session->set_userdata(array('msg_type'=>'success'));				
					 $this->session->set_flashdata('success',lang('successupdate'));	
					
					redirect('sitepanel/testimonial', ''); 
				
				}		
				$data['heading_title'] = "Edit Testimonial";	
				$data['res'] = $res;	
				$this->load->view('testimonial/view_edit_testimonials',$data);	
			}else
			{
				redirect('sitepanel/testimonial', ''); 
				
			}
		
	}
	
	
}
// End of controller