<?php
class Accessories extends Admin_Controller
{
	public function __construct()
	{		
		parent::__construct(); 				
		$this->load->model(array('accessories/accessories_model'));
		$this->config->set_item('menu_highlight','product management');
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		$this->default_view = 'accessories';				
	}
	 
	public  function index()
	{
		if( $this->input->post('status_action')!='')
		{	
			$action = $this->input->post('status_action',TRUE);	
			$arr_ids = $this->input->post('arr_ids',TRUE);
			if($action == 'Delete')
			{
			  if( is_array($arr_ids) )
			  {
				foreach($arr_ids as $accId)
				{
				  $where = array('acc_id'=>$accId);
				  $this->accessories_model->safe_delete('wl_accessories',$where,TRUE);


				  /* Delete Product Accessories */

				  $where = array('ref_acc_id'=>$accId);
				  $this->accessories_model->safe_delete('wl_product_accessories',$where,TRUE);
				 }
				 $this->session->set_userdata(array('msg_type'=>'success'));
				 $this->session->set_flashdata('success',lang('deleted') );
				 redirect($_SERVER['HTTP_REFERER'], '');
			  }
			}
			else
			{		
			  $this->update_status('wl_accessories','acc_id');
			}			
		}
		if( $this->input->post('update_order')!='')
		{			
			$this->update_displayOrder('wl_accessories','sort_order','acc_id');			
		}
		
		/* record set as a */
		
		if( $this->input->post('set_as')!='' )
		{	
		    $set_as    = $this->input->post('set_as',TRUE);			
			$this->set_as('wl_accessories','acc_id',array($set_as=>'1'));			
		}
		
		if( $this->input->post('unset_as')!='' )
		{	
		    $unset_as   = $this->input->post('unset_as',TRUE);		
			$this->set_as('wl_accessories','acc_id',array($unset_as=>'0'));			
		}
		/* End record set as a */
		
		 $pagesize               =  (int) $this->input->get_post('pagesize');
	     $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');		 		 				
		 $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;		
		 $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));				 
		 $parent_id              =   (int) $this->uri->segment(4,0);			
	     
		 $keyword = trim($this->input->get_post('keyword',TRUE));		
		 $keyword = $this->db->escape_str($keyword);
	     
		 $condtion = "AND acc_parent_id = '$parent_id'";
		   
		if($keyword!='')
		{
			$condtion.= " AND acc_name like '%".$keyword."%'";
		}
									
		$condtion_array = array(
		                'field' =>"*",
						 'condition'=>$condtion,
						 'limit'=>$config['limit'],
						  'offset'=>$offset	,
						  'debug'=>FALSE
						 );							 						 	
		$res_array              =  $this->accessories_model->getaccessories($condtion_array);
						
		$config['total_rows']	=  $this->accessories_model->total_rec_found;	
		
		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);
				
		$data['heading_title']  =  ( $parent_id > 0 ) ? 'Accessories' :  'Accessories';
						
		$data['res']            =  $res_array; 	
		
		$data['parent_id']      =  $parent_id; 	
		
		
		
						
		$this->load->view($this->default_view.'/view_acc_list',$data);		
		
		
	}	
	
	public function add()
	{
				
		 		
		 $parent_id         =  (int) $this->uri->segment(4,0);

		 $img_allow_size =  $this->config->item('allow.file.size');
		 $img_allow_dim  =  $this->config->item('allow.imgage.dimension');
		 
		 $acc_name = $this->db->escape_str($this->input->post('acc_name'));

		
							
		if( $parent_id!='' && $parent_id > 0 )
		{
			$parent_id = applyFilter('NUMERIC_GT_ZERO',$parent_id);
			
			$data['heading_title'] = 'Add Accessories';
			
			if($parent_id<=0)
			{
				redirect("sitepanel/accessories");
			}
			
			$parentdata=$this->accessories_model->get_accessories_by_id($parent_id);
			
			if(!is_array($parentdata))
			{
				$this->session->set_flashdata('message', lang('invalidRecord'));
					
				redirect('sitepanel/accessories', ''); 	
				
			}
			$data['parentData'] = $parentdata; 
			
				
		}else
		{
			$data['parentData'] = '';
			$data['heading_title'] = 'Add Accessories';
		}
		
		$this->form_validation->set_rules('acc_name','Accessories Name',"trim|required|max_length[100]|xss_clean|unique[wl_accessories.acc_name='".$acc_name."' AND status!='2' AND acc_parent_id='".$parent_id."']");

		$this->form_validation->set_rules('acc_image','Image',"file_allowed_type[image]|file_size_max[$img_allow_size]|check_dimension[$img_allow_dim]");

		$this->form_validation->set_rules('acc_alt','Alt',"trim|max_length[100]");

		if($this->form_validation->run()===TRUE)
		{
		   $uploaded_file = null;	
				
		   if( !empty($_FILES) && $_FILES['acc_image']['name']!='' )
		   {			  
			  $this->load->library('upload');	
				  
			  $uploaded_data =  $this->upload->my_upload('acc_image','accessories');
		  
			  if( is_array($uploaded_data)  && !empty($uploaded_data) )
			  { 								
				  $uploaded_file = $uploaded_data['upload_data']['file_name'];
			  
			  }		
			  
		   }
		   $acc_alt = $this->input->post('acc_alt');

		  if($acc_alt =='')
		  {
			$acc_alt = $this->input->post('acc_name');
		  }

		   $posted_data = array(
			  'acc_name'=>$this->input->post('acc_name'),
			  'acc_parent_id' =>$parent_id,
			  'acc_alt'=>$acc_alt,
			  'acc_image'=>$uploaded_file,
			  'date_added'=>$this->config->item('config.date.time')
		   );
								
		    $insertId = $this->accessories_model->safe_insert('wl_accessories',$posted_data,FALSE);	

			$this->session->set_userdata(array('msg_type'=>'success'));			
			$this->session->set_flashdata('success',lang('success'));				
			$redirect_path= isset($parentdata) && is_array($parentdata) ? 'accessories/index/'.$parentdata['acc_id'] : 'accessories';			
			redirect('sitepanel/'.$redirect_path, '');		
					
		}	
		$data['parent_id'] = $parent_id; 
		$this->load->view($this->default_view.'/view_acc_add',$data);		  
		  
	}
	
	
	public function edit()
	{
		$accId = (int) $this->uri->segment(4);
		
		$rowdata=$this->accessories_model->get_accessories_by_id($accId);
				
		
		
		$data['heading_title'] = ($rowdata['acc_parent_id'] > 0 ) ? 'Edit Accessories' : 'Edit Accessories';
		
		if( !is_array($rowdata) )
		{
			$this->session->set_flashdata('message', lang('idmissing'));	
			redirect('sitepanel/accessories', ''); 	
			
		}

		$accId = $rowdata['acc_id'];

		$img_allow_size =  $this->config->item('allow.file.size');

		$img_allow_dim  =  $this->config->item('allow.imgage.dimension');
		
		$this->form_validation->set_rules('acc_name','Accessories Name',"trim|required|max_length[100]|xss_clean|unique[wl_accessories.acc_name='".$this->db->escape_str($this->input->post('acc_name'))."' AND status!='2' AND acc_parent_id='".$rowdata['acc_parent_id']."' AND acc_id!='".$accId."']");

		$this->form_validation->set_rules('acc_image','Image',"file_allowed_type[image]|file_size_max[$img_allow_size]|check_dimension[$img_allow_dim]");

		$this->form_validation->set_rules('acc_alt','Alt',"trim|max_length[100]");	

		if($this->form_validation->run()==TRUE)
		{
			$uploaded_file = $rowdata['acc_image'];				 
			$unlink_image = array('source_dir'=>"accessories",'source_file'=>$rowdata['acc_image']);
			if($this->input->post('acc_img_delete')==='Y')
			 {					
				removeImage($unlink_image);						
				$uploaded_file = NULL;	
							
			 }				
			 if( !empty($_FILES) && $_FILES['acc_image']['name']!='' )
			 {			  
					$this->load->library('upload');	
						
					$uploaded_data =  $this->upload->my_upload('acc_image','accessories');
				
					if( is_array($uploaded_data)  && !empty($uploaded_data) )
					{ 								
						$uploaded_file = $uploaded_data['upload_data']['file_name'];
						removeImage($unlink_image);	
					}
					
			}

			$acc_alt = $this->input->post('acc_alt');

			if($acc_alt =='')
			{
			  $acc_alt = $this->input->post('acc_name');
			}
	
			$posted_data = array(
				'acc_name'=>$this->input->post('acc_name'),
				'acc_alt'=>$acc_alt,
				'acc_image'=>$uploaded_file	
			 );

			$where = "acc_id = '".$accId."'";
 				
			$this->accessories_model->safe_update('wl_accessories',$posted_data,$where,FALSE);

			$this->session->set_userdata(array('msg_type'=>'success'));				
			$this->session->set_flashdata('success',lang('successupdate'));								
			$redirect_path= $rowdata['acc_parent_id']>0 ? 'accessories/index/'. $rowdata['acc_parent_id'] : 'accessories';
							
			redirect('sitepanel/'.$redirect_path.'/'.query_string(), ''); 	
						
		}						
			
		$data['result']=$rowdata;		
		$this->load->view($this->default_view.'/view_acc_edit',$data);				
		
	}

	public function delete()
	{
	  $accId = (int) $this->uri->segment(4,0);
	  $rowdata=$this->accessories_model->get_accessories_by_id($accId);

	  if( !is_array($rowdata) )
	  {
		  $this->session->set_flashdata('message', lang('idmissing'));	
		  redirect('sitepanel/accessories', ''); 	
		  
	  }
	  else
	  {
		 
		  $where = array('acc_id'=>$accId);
		  $this->accessories_model->safe_delete('wl_accessories',$where,TRUE);


		  /* Delete Product Attributes */

		  $where = array('ref_acc_id'=>$accId);
		  $this->accessories_model->safe_delete('wl_product_accessories',$where,TRUE);
		  
		  $this->session->set_userdata(array('msg_type'=>'success'));
		  $this->session->set_flashdata('success',lang('deleted') );
			  
		  
		  redirect($_SERVER['HTTP_REFERER'], '');
	  }
	  

	}
	
	
}
// End of controller