<?php
class Attributes extends Admin_Controller
{
	public function __construct()
	{		
		parent::__construct(); 				
		$this->load->model(array('attributes/attribute_model'));
		$this->config->set_item('menu_highlight','product management');
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
		$this->default_view = 'attributes';				
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
				foreach($arr_ids as $attrId)
				{
				  $where = array('attr_id'=>$attrId);
				  $this->attribute_model->safe_delete('wl_attributes',$where,TRUE);

				  /* Delete Product Attributes */

				  $where = array('ref_attr_id'=>$attrId);
				  $this->attribute_model->safe_delete('wl_product_attributes',$where,TRUE);
				 }
				 $this->session->set_userdata(array('msg_type'=>'success'));
				 $this->session->set_flashdata('success',lang('deleted') );
				 redirect($_SERVER['HTTP_REFERER'], '');
			  }
			}
			else
			{		
			  $this->update_status('wl_attributes','attr_id');
			}			
		}
		if( $this->input->post('update_order')!='')
		{			
			$this->update_displayOrder('wl_attributes','sort_order','attr_id');			
		}
		
		/* record set as a */
		
		if( $this->input->post('set_as')!='' )
		{	
		    $set_as    = $this->input->post('set_as',TRUE);			
			$this->set_as('wl_attributes','attr_id',array($set_as=>'1'));			
		}
		
		if( $this->input->post('unset_as')!='' )
		{	
		    $unset_as   = $this->input->post('unset_as',TRUE);		
			$this->set_as('wl_attributes','attr_id',array($unset_as=>'0'));			
		}
		/* End record set as a */
		
		 $pagesize               =  (int) $this->input->get_post('pagesize');
	     $config['limit']		 =  ( $pagesize > 0 ) ? $pagesize : $this->config->item('pagesize');		 		 				
		 $offset                 =  ( $this->input->get_post('per_page') > 0 ) ? $this->input->get_post('per_page') : 0;		
		 $base_url               =  current_url_query_string(array('filter'=>'result'),array('per_page'));				 
		 $parent_id              =   (int) $this->uri->segment(4,0);			
	     
		 $keyword = trim($this->input->get_post('keyword',TRUE));		
		 $keyword = $this->db->escape_str($keyword);
	     
		 $condtion = "AND attr_parent_id = '$parent_id'";
		   
		if($keyword!='')
		{
			$condtion.= " AND attr_name like '%".$keyword."%'";
		}
									
		$condtion_array = array(
		                'field' =>"*,( SELECT COUNT(attr_id) FROM wl_attributes AS b
						              WHERE b.attr_parent_id=a.attr_id ) AS total_subattr",
						 'condition'=>$condtion,
						 'limit'=>$config['limit'],
						  'offset'=>$offset	,
						  'debug'=>FALSE
						 );							 						 	
		$res_array              =  $this->attribute_model->getattributes($condtion_array);
						
		$config['total_rows']	=  $this->attribute_model->total_rec_found;	
		
		$data['page_links']     =  admin_pagination($base_url,$config['total_rows'],$config['limit'],$offset);
				
		$data['heading_title']  =  ( $parent_id > 0 ) ? 'Sub-Attributes' :  'Attributes';
						
		$data['res']            =  $res_array; 	
		
		$data['parent_id']      =  $parent_id; 	
		
		
		
						
		$this->load->view($this->default_view.'/view_attribute_list',$data);		
		
		
	}	
	
	public function add()
	{
				
		 		
		 $parent_id         =  (int) $this->uri->segment(4,0);
		 
		 $attr_name = $this->db->escape_str($this->input->post('attr_name'));

		
							
		if( $parent_id!='' && $parent_id > 0 )
		{
			$parent_id = applyFilter('NUMERIC_GT_ZERO',$parent_id);
			
			$data['heading_title'] = 'Add Sub-Attribute';
			
			if($parent_id<=0)
			{
				redirect("sitepanel/attributes");
			}
			
			$parentdata=$this->attribute_model->get_attribute_by_id($parent_id);
			
			if(!is_array($parentdata))
			{
				$this->session->set_flashdata('message', lang('invalidRecord'));
					
				redirect('sitepanel/attributes', ''); 	
				
			}
			$data['parentData'] = $parentdata; 
			
				
		}else
		{
			$data['parentData'] = '';
			$data['heading_title'] = 'Add Attribute';
		}
		
		$this->form_validation->set_rules('attr_name','Attribute Name',"trim|required|max_length[100]|xss_clean|unique[wl_attributes.attr_name='".$attr_name."' AND status!='2' AND attr_parent_id='".$parent_id."']");

		if($this->form_validation->run()===TRUE)
		{
		   $posted_data = array(
			  'attr_name'=>$this->input->post('attr_name'),
			  'attr_parent_id' =>$parent_id,
			  'date_added'=>$this->config->item('config.date.time')
		   );
								
		    $insertId = $this->attribute_model->safe_insert('wl_attributes',$posted_data,FALSE);	

			$this->session->set_userdata(array('msg_type'=>'success'));			
			$this->session->set_flashdata('success',lang('success'));				
			$redirect_path= isset($parentdata) && is_array($parentdata) ? 'attributes/index/'.$parentdata['attr_id'] : 'attributes';			
			redirect('sitepanel/'.$redirect_path, '');		
					
		}	
		$data['parent_id'] = $parent_id; 
		$this->load->view($this->default_view.'/view_attribute_add',$data);		  
		  
	}
	
	
	public function edit()
	{
		$attrId = (int) $this->uri->segment(4);
		
		$rowdata=$this->attribute_model->get_attribute_by_id($attrId);
				
		
		
		$data['heading_title'] = ($rowdata['attr_parent_id'] > 0 ) ? 'Edit Sub-Attribute' : 'Edit Attribute';
		
		if( !is_array($rowdata) )
		{
			$this->session->set_flashdata('message', lang('idmissing'));	
			redirect('sitepanel/attributes', ''); 	
			
		}

		$attrId = $rowdata['attr_id'];

		
		
		$this->form_validation->set_rules('attr_name','Attribute Name',"trim|required|max_length[100]|xss_clean|unique[wl_attributes.attr_name='".$this->db->escape_str($this->input->post('attr_name'))."' AND status!='2' AND attr_parent_id='".$rowdata['attr_parent_id']."' AND attr_id!='".$attrId."']");

		if($this->form_validation->run()==TRUE)
		{	
			$posted_data = array(
				'attr_name'=>$this->input->post('attr_name')	
			 );

			$where = "attr_id = '".$attrId."'";
 				
			$this->attribute_model->safe_update('wl_attributes',$posted_data,$where,FALSE);

			$this->session->set_userdata(array('msg_type'=>'success'));				
			$this->session->set_flashdata('success',lang('successupdate'));								
			$redirect_path= $rowdata['attr_parent_id']>0 ? 'attributes/index/'. $rowdata['attr_parent_id'] : 'attributes';
							
			redirect('sitepanel/'.$redirect_path.'/'.query_string(), ''); 	
						
		}						
			
		$data['result']=$rowdata;		
		$this->load->view($this->default_view.'/view_attribute_edit',$data);				
		
	}

	public function delete()
	{
	  $attrId = (int) $this->uri->segment(4,0);
	  $rowdata=$this->attribute_model->get_attribute_by_id($attrId);

	  if( !is_array($rowdata) )
	  {
		  $this->session->set_flashdata('message', lang('idmissing'));	
		  redirect('sitepanel/attributes', ''); 	
		  
	  }
	  else
	  {
		 
		  $where = array('attr_id'=>$attrId);
		  $this->attribute_model->safe_delete('wl_attributes',$where,TRUE);


		  /* Delete Product Attributes */

		  $where = array('ref_attr_id'=>$attrId);
		  $this->attribute_model->safe_delete('wl_product_attributes',$where,TRUE);
		  
		  $this->session->set_userdata(array('msg_type'=>'success'));
		  $this->session->set_flashdata('success',lang('deleted') );
			  
		  
		  redirect($_SERVER['HTTP_REFERER'], '');
	  }
	  

	}
	
	
}
// End of controller