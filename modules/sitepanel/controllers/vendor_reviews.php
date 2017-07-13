<?php
class Vendor_reviews extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct(); 
		$this->load->model(array('comments/comments_model','vendor/vendor_model'));
		$this->load->helper(array('products/product'));
		$this->config->set_item('menu_highlight','vendor management');	
		
	}
	
	public  function index($page = NULL)
	{
	  if($this->input->post('status_action')!='')
	  {
		  
		  $this->update_status('wl_review','review_id');
		  
	  }
	

	  
	  $keyword			=   trim($this->input->get_post('keyword2',TRUE));						
	  $keyword			=   $this->db->escape_str($keyword);

	  $pagesize               =  (int) $this->input->get_post('pagesize');

	  $ref_id               =  (int) $this->input->get_post('ref_id');
			  
	  $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');
							
	  $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;	

	  $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));

	  $condition = " AND entity_type='customer' AND b.status!='2' AND c.status!='2' ";

	  if($ref_id > 0)
	  {
		$condition .= " AND entity_id ='".$ref_id."' ";
	  }
  
	  $review_to               =  (int) $this->input->get_post('review_to');

	  if($review_to > 0)
	  {
		$condition .= " AND review_to ='".$review_to."' ";
	  }

	  if($keyword!='')
	  {
		$condition .= " AND ( IF(ISNULL(a.customers_id),b.author,CONCAT_WS(' ',a.first_name,a.last_name)) LIKE '%$keyword%' OR text  LIKE '%$keyword%' OR c.company_name  LIKE '%$keyword%')";
	  }

	  $status                 =  $this->input->get_post('status');

	  if($status != '')
	  {
		$condition .= " AND b.status = '".$status."'";
	  }	

	  $qry_options = array(
							'limit'	    => $config['limit'],
							'offset'	=> $offset,
							'condition' => $condition,
							'exjoin'    => " INNER JOIN wl_customers as c ON c.customers_id=b.entity_id",
							'exselect'  => " ,c.company_name"
							
						  );
	  
															  
	  $res_array               =  $this->comments_model->get_comments($qry_options);	

	  
	  $config['total_rows']    =  get_found_rows();
		  
	  $data['page_links']      =   admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);		
	  $data['res'] = $res_array;
	  $data['category_result_found'] = "Total ".$config['total_rows']." result(s) found ";	
	  $data['heading_title'] = "View Reviews";
	  $this->load->view('vendor/view_reviews_list',$data);
	 
	}
	
	/* Add Comments */

	public function add()
	{
		$Id =  (int) $this->uri->segment(4);	

		$mem_cond = array(
							  'fields'=>"a.company_name,a.customers_id",
							  'where'=>"a.customers_id ='".$Id."' AND a.status !='2'"
							); 		

		$pres           = $this->vendor_model->get_members($mem_cond);

		if( is_array($pres) && !empty($pres) )
		{
			$pres = $pres[0];

			$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
	
			$this->form_validation->set_rules('ads_rating','Rating','trim|max_length[1]');
			$this->form_validation->set_rules('author','Name','trim|max_length[70]');
			$this->form_validation->set_rules('author_email','Email','trim|max_length[80]|valid_email');	
			$this->form_validation->set_rules('comment','Review','trim|required|max_length[450]');
		
			if($this->form_validation->run()==TRUE)
			{
				$ads_rating = (int) $this->input->post('ads_rating');

				//$ads_rating = $ads_rating < 1 ? 1 : $ads_rating;
			
				$posted_data=array(		
									  'entity_id'  => $pres['products_id'],
									  'entity_type'  => 'product',
									  'customer_id'   => 0,	
									  'ads_rating'		=> $ads_rating,
									  'author'  => $this->input->post('author')!='' ? $this->input->post('author') : 'Admin',
									  'author_email'  => $this->input->post('author_email')!='' ? $this->input->post('author_email') : null,
									  'text'  => $this->input->post('comment'),
									  'status'=>'1',						
									  'review_date'             => $this->config->item('config.date.time')
									  );			
				  $this->comments_model->safe_insert('wl_review',$posted_data,FALSE); 			
				
				
										
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',lang('success'));
				redirect('sitepanel/vendor_reviews?ref_id='.$pres['customers_id'], '');
				
			}				
				
			$data['pres'] = $pres;
			$data['heading_title'] = "Add Review";
			$this->load->view('vendor/view_post_review',$data);
		}
		else
		{
		  $this->session->set_userdata(array('msg_type'=>'error'));
		  $this->session->set_flashdata('success','Product not exists');
		  redirect('sitepanel/vendor_reviews/', '');

		} 
		
	}

	/* Edit Review */

	public function edit()
	{
		
	    $id =  (int) $this->uri->segment(4);	

		$qry_options = array(
							  'limit'	  => 1,
							  'offset'	  => 0,
							  'condition' => " AND review_id ='$id'"

							);

	    $res       = $this->comments_model->get_comments($qry_options);

		if(is_array($res) && !empty($res))
		{
		 
		  $res = $res[0];

		  $mem_cond = array(
							  'fields'=>"a.company_name,a.customers_id",
							  'where'=>"a.customers_id ='".$res['entity_id']."' AND a.status !='2'"
							); 		

		  $pres           = $this->vendor_model->get_members($mem_cond);;	

		  
		  $this->form_validation->set_rules('ads_rating','Rating','trim|max_length[1]');
			$this->form_validation->set_rules('author','Name','trim|max_length[70]');
			$this->form_validation->set_rules('author_email','Email','trim|max_length[80]|valid_email');	
			$this->form_validation->set_rules('comment','Review','trim|required|max_length[450]');
		  
		  if($this->form_validation->run()==TRUE)
		  {
			  $ads_rating = (int) $this->input->post('ads_rating');

			  //$ads_rating = $ads_rating < 1 ? 1 : $ads_rating;

			  $posted_data=array(		
								  'ads_rating'		=> $ads_rating,
								  'author'  => $this->input->post('author')!='' ? $this->input->post('author') : 'Admin',
								  'author_email'  => $this->input->post('author_email')!='' ? $this->input->post('author_email') : null,
								  'text'  => $this->input->post('comment'),
								  'status'=>'1'
								  );
				
			 $where = "review_id = '".$res['review_id']."'"; 	
		
			 $this->comments_model->safe_update('wl_review',$posted_data,$where,FALSE);

			 $this->session->set_userdata(array('msg_type'=>'success'));				
			 $this->session->set_flashdata('success',lang('successupdate'));	
		
			 redirect('sitepanel/vendor_reviews'.query_string(), '');
		  }
		  
		  $data['res'] = $res;
		  $data['pres'] = $pres;
		  $data['heading_title'] = "Edit Review";
		  $this->load->view('vendor/view_edit_review',$data);
	  }
	  else
	  {
		$this->session->set_userdata(array('msg_type'=>'error'));
		$this->session->set_flashdata('success','Review not exists');
		redirect('sitepanel/vendor_reviews'.query_string(), '');

	  }  
	}
	
}
// End of controller