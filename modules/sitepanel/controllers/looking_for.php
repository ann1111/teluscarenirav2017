<?php
class Looking_for extends Admin_Controller
{

	public function __construct()
	{	
	  parent::__construct(); 				
	  $this->load->model(array('products/product_model'));  			
	  $this->config->set_item('menu_highlight','product management');
	  $this->cat_type_added = array();	
	  $res_cat_type = $this->db->query("SELECT cat_type,category_name FROM wl_categories WHERE cat_type IS NOT NULL AND spl_quot_form ='Y' AND status !='2'")->result_array();
	  if(is_array($res_cat_type) && !empty($res_cat_type))
	  {
		foreach($res_cat_type as $val)
		{
		  $this->cat_type_added[$val['cat_type']] = $val['category_name'];
		}
	  }
			
	}
	
	
	 public  function index()
	 {

		if( $this->input->post('status_action')!='')
		{	
			$action = $this->input->post('status_action',TRUE);	
			$arr_ids = $this->input->post('arr_ids',TRUE);
					
			$this->update_status('wl_looking_for','fld_id');
		}
		
		$pagesize               =  (int) $this->input->get_post('pagesize');

		$config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');

		$offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	

		$base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));

		$keyword = trim($this->input->get_post('keyword',TRUE));		
		$keyword = $this->db->escape_str($keyword);

		$condtion = "";

		if($keyword!='')
		{
		  $condtion.= " AND fld_value like '%".$keyword."%'";
		}

		$cat_type = trim($this->input->get_post('cat_type',TRUE));		
		$cat_type = $this->db->escape_str($cat_type);

		if($cat_type!='')
		{
		  $condtion.= " AND cat_type = '".$cat_type."'";
		}

		$status = trim($this->input->get_post('status',TRUE));		
		$status = $this->db->escape_str($status);

		if($status!='')
		{
		  $condtion.= " AND status = '".$status."'";
		}
  
		$condtion = ltrim($condtion,' AND ');

		$condtion_array = array(
							'where'=>$condtion,
							'limit'=>$config['limit'],
							'offset'=>$offset	,
							'debug'=>FALSE
							);							 						 	
		$res_array              =  $this->product_model->get_looking_for($condtion_array);

		$total_record           =   $this->product_model->total_rec_found;	

		$config['total_rows']   =   $total_record;



		$data['page_links']      =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);

		$data['res']            =  $res_array; 

		$data['heading_title'] = 'Manage Looking For';
		$data['pagelist']      = $res_array; 			
		$this->load->view('looking_for/view_looking_for',$data);			  }
	   
	   
		
		
		
	  public function add()
	  {			
		$data['heading_title'] = 'Add Looking For';
			
		$this->form_validation->set_rules('cat_type','Category','trim|required|xss_clean|max_length[30]');

		$this->form_validation->set_rules('fld_value','Type value',"trim|required|xss_clean|max_length[50]|unique[wl_looking_for.fld_value='".$this->db->escape_str($this->input->post('fld_value'))."' AND cat_type='".$this->input->post('cat_type')."' AND status!='2']");
		

		if($this->form_validation->run()==TRUE)
		{

		$posted_data = array(
		'cat_type'=>$this->input->post('cat_type',TRUE),
		'fld_value'=>$this->input->post('fld_value',TRUE),
		'recv_date'=>$this->config->item('config.date.time')
		);

		$this->product_model->safe_insert('wl_looking_for',$posted_data,FALSE);					 
		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',lang('success'));			
		redirect('sitepanel/looking_for', '');


		}

		$this->load->view('looking_for/view_looking_for_add',$data);				

	  }
	   
	   
	  public function edit()
	  {

		$data['heading_title'] = 'Edit Company Type';

		$Id = (int) $this->uri->segment(4);

		$res = $this->db->get_where('wl_looking_for',array('status !='=>'2','fld_id'=>$Id))->row_array();


		if(  is_array($res) && !empty($res) )
		{ 
		  $this->form_validation->set_rules('cat_type','Category','trim|required|xss_clean|max_length[30]');

		  $this->form_validation->set_rules('fld_value','Type value',"trim|required|xss_clean|max_length[50]|unique[wl_looking_for.fld_value='".$this->db->escape_str($this->input->post('fld_value'))."' AND cat_type='".$this->input->post('cat_type')."' AND status!='2' AND fld_id !='".$res['fld_id']."']");

		  if($this->form_validation->run()==TRUE)
		  {

			$posted_data = array(
			'fld_value'=>$this->input->post('fld_value',TRUE),
			'cat_type'=>$this->input->post('cat_type',TRUE)
			);

			$where = "fld_id = '".$res['fld_id']."'"; 						
			$this->product_model->safe_update('wl_looking_for',$posted_data,$where,FALSE);	
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success',lang('successupdate'));	

			redirect('sitepanel/looking_for/'.query_string(), ''); 	

		  }

		  $data['res']=$res;
		  $this->load->view('looking_for/view_looking_for_edit',$data);

		}
		else
		{

		  redirect('sitepanel/looking_for', ''); 	 

		}

	  }
	   
	   
	   
	   

}
//controllet end