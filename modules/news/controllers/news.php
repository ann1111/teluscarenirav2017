<?php
class News extends Public_Controller
{

	public function __construct()
	{
		parent::__construct(); 
		$this->load->model(array('news/news_model'));
	    $this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		$this->page_section_ct = 'news';
	}

	public function index()
	{
		
			$record_per_page         = (int) $this->input->post('per_page');			
			$offset            =  (int) $this->input->post('offset');
			
			$config['per_page']	     =  ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');	
			
											
			$base_url                =   "news";
			
			$param = array('status'=>'1');	
			$res_array              = $this->news_model->get_news($config['per_page'],$offset,$param);		
			$config['total_rows']	= get_found_rows();	
			$data['page_links']      = front_pagination($base_url,$config['total_rows'],$config['per_page'],$offset);				
			$data['title'] = 'News';
			$data['res'] = $res_array; 			
			$this->load->view('news/view_news',$data);
			
	}		
	
	public function details()
	{
		$id = (int) $this->uri->rsegments['3'];		
		$param     = array('wl_news.status'=>'1','where'=>"wl_news.news_id ='$id' ");	
		$res       = $this->news_model->get_news(1,0,$param);	
		
		if(is_array($res) && !empty($res))
		{			
			$data['title'] = 'News';
		    $data['res'] = $res; 			
		    $this->load->view('news/news_details_view',$data);
		
			
		}else
		{
			redirect('news', ''); 
			
		}
		
	}
	
	
}


/* End of file pages.php */

?>
