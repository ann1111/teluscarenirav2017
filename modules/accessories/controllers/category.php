<?php
class Category extends Public_Controller
{
	
	public function __construct()
	{
		parent::__construct();  
		$this->load->helper(array('category/category'));	 
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

		
		$base_url               = $this->uri->uri_string;

		$parent_id = 0;

		$heading_title = "Category";

		$data['title'] = "Category";

		$record_per_page        = (int) $this->input->get_post('per_page');
		
				
		$config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $this->config->item('per_page');
		
		$offset                 =  (int) $this->input->get_post('offset');
		
		
		$condtion_array = array(
		'field' =>"*",
		'condition'=>"AND parent_id = '$parent_id' AND status='1' ",
		'order'=>'sort_order',
		'debug'=>FALSE
		);	

		$condtion_array['offset'] = $offset;
		$condtion_array['limit'] = $config['per_page'];

		
		
		
		$res_array              =  $this->category_model->getcategory($condtion_array);
						
		$config['total_rows']	=  $this->category_model->total_rec_found;
		 
		
		//$data['page_links']     = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$offset);
		
		
		
		$data['heading_title'] = $heading_title;

		$data['res'] = $res_array; 

		$data['total_records'] = $config['total_rows'];

		$data['base_url'] = $base_url;	
		
		$ajx_req = $this->input->get_post('ajx_req');
			
		if($ajx_req !='')
		{	
		  $this->load->view('category/load_category',$data);
		}
		else
		{
		  $this->load->view('category/view_category',$data);
		}
		
	}
}
/* End of file member.php */
/* Location: .application/modules/products/controllers/products.php */
