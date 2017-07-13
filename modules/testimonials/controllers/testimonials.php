<?php
class Testimonials extends Public_Controller
{

	public function __construct()
	{
		parent::__construct(); 
		$this->load->model(array('testimonials/testimonial_model'));
	    $this->form_validation->set_error_delimiters("<div class='required'>","</div>");

		$this->page_section_ct = 'testimonial';
	}

	public function index()
	{
		 $this->post('testimonials');
		 $record_per_page         = (int) $this->input->post('per_page');		
		 
		 $offset = (int) $this->input->get_post('offset');
			
		 $config['per_page']	  =  2;//( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');	

		$base_url                =   "testimonials";
				
		$param = array('status'=>'1');	
		$res_array              = $this->testimonial_model->get_testimonial($config['per_page'],$offset,$param);

		$total_rows = get_found_rows();		
		$config['total_rows']	= $total_rows;
		$data['total_records'] = $total_rows;
	    $data['page_links']      = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$offset);				
		$data['title'] = 'Testimonials';
		$data['res'] = $res_array; 		
		$data['base_url'] = $base_url;
		$data['error_validate'] = $this->validate;

		$ajx_req = $this->input->is_ajax_request();
			  
		if($ajx_req===TRUE)
		{	
		  $this->load->view('testimonials/load_testimonials',$data);
		}
		else
		{
		  $this->load->view('testimonials/view_testimonials',$data);
		}
	}	

	public function post($url)
	{		
		$this->validate = TRUE;	
		if($this->input->post('post_test')!='')
		{
		  		
		  //$this->form_validation->set_rules('testimonial_title','Title','trim|required|xss_clean|max_length[150]');
		  $this->form_validation->set_rules('poster_email','Email','trim|required|valid_email|xss_clean|max_length[80]');
		  $this->form_validation->set_rules('poster_name','Name','trim|required|alpha|xss_clean|max_length[30]');
		  $this->form_validation->set_rules('testimonial_description','Description','trim|required|xss_clean|max_length[8500]');
		  $this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code');
		  
		  
		  if($this->form_validation->run()==TRUE)
		  {
			  $uploaded_file = null;	
				
			  						  
			  $posted_data=array(				
			  'testimonial_title'      => $this->input->post('testimonial_title',TRUE),
			  'poster_name'             => $this->input->post('poster_name'),
			  'email'                   => $this->input->post('poster_email')!='' ? $this->input->post('poster_email') : null,
			  'photo'=>$uploaded_file,
			  'testimonial_description' => nl2br($this->input->post('testimonial_description')),						
			  'posted_date'            =>$this->config->item('config.date.time')
			  );			
			  $this->testimonial_model->safe_insert('wl_testimonial',$posted_data,FALSE); 
			  
			  
			  $message = $this->config->item('testimonial_post_success');			
			  $message = str_replace('<site_name>',$this->config->item('site_name'),$message);
									  
			  $this->session->set_userdata(array('msg_type'=>'success'));
			  $this->session->set_flashdata('success',$message);
			  redirect($url, ''); 
			  
		  }
		  $this->validate = FALSE;	
		  
		}		
	}
	
	public function details()
	{
		$id = (int) $this->uri->segment(3);		
		$param     = array('status'=>'1','where'=>"testimonial_id ='$id' ");	
		$res       = $this->testimonial_model->get_testimonial(1,0,$param);	
		
		if(is_array($res) && !empty($res))
		{	
			$this->post('testimonials/details/'.$id);			
			$data['title'] = 'Testimonials';
		    $data['res'] = $res; 			
		    $this->load->view('testimonials/testimonials_details_view',$data);
		
			
		}else
		{
			redirect('testimonials', ''); 
			
		}
		
	}
	
	
}


/* End of file pages.php */

?>
