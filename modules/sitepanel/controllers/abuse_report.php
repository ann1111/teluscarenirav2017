<?php
class Abuse_report extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct(); 
		$this->load->model(array('comments/comments_model','products/product_model'));
		$this->load->helper('products/product');
		$this->config->set_item('menu_highlight','other management');	
		
	}
	
	public  function index($page = NULL)
	{
	  if($this->input->post('status_action')!='')
	  {
		  
		  $this->update_status('wl_abuse_report','abuse_id');
		  
	  }
	

	  
	  $keyword			=   trim($this->input->get_post('keyword2',TRUE));						
	  $keyword			=   $this->db->escape_str($keyword);

	  $pagesize               =  (int) $this->input->get_post('pagesize');

	  $review_id               =  (int) $this->input->get_post('review_id');
			  
	  $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
							
	  $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	

	  $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));

	  $condition = " AND entity_type='product' AND b.status!='2' ";

	  if($review_id > 0)
	  {
		$condition .= " AND b.reviews_id ='".$review_id."' ";
	  }

	  if($keyword!='')
	  {
		$condition .= " AND ( CONCAT_WS(' ',first_name,last_name) LIKE '%$keyword%' OR text  LIKE '%$keyword%' OR comment LIKE '%$keyword%')";
	  }

	  $qry_options = array(
							'limit'	    => $config['limit'],
							'offset'	=> $offset,
							'condition' => $condition,
							'exjoin'    => " INNER JOIN wl_review as c ON c.review_id=b.reviews_id",
							'exselect'  => " ,c.text,(SELECT count(abuse_id) FROM wl_abuse_report as d WHERE d.reviews_id = b.reviews_id AND d.status !='2' ) as total_reports"
						  );
	  
															  
	  $res_array               =  $this->comments_model->get_abuse_report($qry_options);	

	  
	  $config['total_rows']    =  get_found_rows();
		  
	  $data['page_links']      =   admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);		
	  $data['res'] = $res_array;
	  $data['category_result_found'] = "Total ".$config['total_rows']." result(s) found ";	
	  $data['heading_title'] = "View Abuse report";
	  $this->load->view('catalog/view_abuse_list',$data);
	 
	}
	
	public function delete()
	{
	  $del_id = (int) $this->uri->segment(4);

	  $review_id = (int) $this->input->get('review_id');

	  if($del_id > 0)
	  {
		//$this->db->query("UPDATE wl_abuse_report SET status ='2' WHERE abuse_id='".$del_id."'");
		$this->db->query("DELETE FROM wl_abuse_report WHERE abuse_id='".$del_id."'");
		$ex_path = $review_id > 0  ? '?review_id='.$review_id : '';
		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',lang('deleted') );
		redirect('sitepanel/abuse_report'.$ex_path,'');
	  }
	  else
	  {
		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',lang('deleted') );
		redirect('sitepanel/abuse_report','');
	  }
	}

	public function delete_review()
	{
	  $review_id = (int) $this->input->get('review_id');

	  if($review_id > 0)
	  {
		$this->db->query("UPDATE wl_abuse_report SET status ='2' WHERE reviews_id='".$review_id."'");
		$this->db->query("UPDATE wl_review SET status ='2' WHERE review_id='".$review_id."'");
		$this->session->set_userdata(array('msg_type'=>'success'));
		$this->session->set_flashdata('success',lang('deleted') );
		redirect('sitepanel/abuse_report','');
	  }
	  else
	  {
		$this->session->set_userdata(array('msg_type'=>'error'));
		$this->session->set_flashdata('error','Invalid Request');
		redirect('sitepanel/abuse_report','');
	  }
	}
	
	
}
// End of controller