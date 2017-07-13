<?php
class Faq extends Public_Controller
{

	
	public function __construct()
	{
		parent::__construct(); 
		$this->load->model(array('faq/faq_model'));
	    $this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		$this->page_section_ct = 'faqs';
		
	}

	public function index()
	{	
		
		
		$record_per_page        = (int) $this->input->post('per_page');		
		
		$offset = (int) $this->input->post('offset');
		
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');		
		
		
		$base_url               = "faq";
			
									
		$param = array('status'=>'1');

		$res_array               = $this->faq_model->get_faq($config['per_page'],$offset,$param);	
		
				
		$total_rows = get_found_rows();		
		$config['total_rows']	= $total_rows;
		$data['total_records'] = $total_rows;		
	    $data['page_links']      = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$offset);			
	    $data['title'] = "FAQ's";
		$data['res'] = $res_array; 	
		$data['base_url'] = $base_url;

		$ajx_req = $this->input->is_ajax_request();
			  
		if($ajx_req===TRUE)
		{	
		  $this->load->view('faq/load_faq',$data);
		}
		else
		{
		  $this->load->view('faq/view_faq',$data);
		}
					
	}
	
	public function details()
	{
		$id = (int) $this->uri->segment(3);		
		$param     = array('status'=>'1','where'=>"faq_id ='$id' ");	
		$res       = $this->faq_model->get_faq(1,0,$param);	
		
		if(is_array($res) && !empty($res))
		{	
			$data['title'] = 'FAQ';
		    $data['res'] = array($res); 			
		    $this->load->view('faq/faq_details_view',$data);
		
			
		}else
		{
			redirect('faq', ''); 
			
		}
		
	}
	
	
		
	
	
}
?>