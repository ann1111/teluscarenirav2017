<?php $this->load->view('includes/header'); ?>  
  
  <div id="content">
  
  <div class="breadcrumb">
  
    <?php echo anchor('sitepanel/dashbord','Home');?>
	<?php
	if($vendor_id > 0)
	{
	  $vendor_res = $this->db->select('company_name')->get_where('wl_customers',array('customers_id'=>$vendor_id))->row();
	  if(is_object($vendor_res))
	  {
		echo ' <span class="pr2 fs14">»</span> ';
		echo anchor('sitepanel/vendors','Vendors');
		echo ' <span class="pr2 fs14">»</span> '.$vendor_res->company_name;
	  }
	}
	elseif($category_id > 0)
	{
	  echo admin_category_breadcrumbs($category_id,$category_id);
	}
	?>
	<?php
	echo '<span class="pr2 fs14">»</span> '.$heading_title;
	?>
       
             
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
		
     
    </div>
   
  
      
     <div class="content">
    	
        <?php  echo error_message(); ?>
	
        
		<?php echo form_open("sitepanel/products",'id="search_form" method="get" '); ?>
         <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
		<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
		  
          <tr>
			<td align="center" >Search [name ] 
            
				<input type="text" name="keyword" value="<?php echo $this->input->get_post('keyword');?>"  />&nbsp;
                
				<select name="status">
                
					<option value="">Admin Status</option>
					<option value="1" <?php echo $this->input->get_post('status')==='1' ? 'selected="selected"' : '';?>>Active</option>
					<option value="0" <?php echo $this->input->get_post('status')==='0' ? 'selected="selected"' : '';?>>In-active</option>
                    
				</select>
				<select name="vendor_status">
                
					<option value="">Vendor Status</option>
					<option value="2" <?php echo $this->input->get_post('vendor_status')==='2' ? 'selected="selected"' : '';?>>Deleted</option>
                    
				</select>
				<select name="prod_type">
				  <option value="">Type</option>
				  <option value="1" <?php echo $this->input->get_post('prod_type')==='1' ? 'selected="selected"' : '';?>>Product</option>
				  <option value="2" <?php echo $this->input->get_post('prod_type')==='2' ? 'selected="selected"' : '';?>>Service</option>
				</select>&nbsp;
				<select name="prod_for">
				  <option value="">For</option>
				  <option value="1" <?php echo $this->input->get_post('prod_for')==='1' ? 'selected="selected"' : '';?>>Individual</option>
				  <option value="2" <?php echo $this->input->get_post('prod_for')==='2' ? 'selected="selected"' : '';?>>Corporate</option>
				  <option value="3" <?php echo $this->input->get_post('prod_for')==='3' ? 'selected="selected"' : '';?>>Both</option>
				</select>&nbsp;
                <input type="hidden" name="vendor_id" value="<?php echo $vendor_id;?>" />
				<input type="hidden" name="category_id" value="<?php echo $category_id;?>" />
				<a  onclick="$('#search_form').submit();" class="button"><span> GO </span></a>                
			
				<?php 
				if( $this->input->get_post('keyword')!='' || $this->input->get_post('status')!='' || $this->input->get_post('prod_type')!='' || $this->input->get_post('prod_for')!='' || $vendor_id>0 || $category_id >  0 )
				{ 
				  echo anchor("sitepanel/products/",'<span>Clear Search</span>');
				} 
				?>
            </td>
		</tr>        
		</table>
		<?php echo form_close();?>
        
		<?php
		if(is_array($res) && ! empty($res))
		{
			
		?>
        
          
        
			<?php echo form_open(current_url_query_string(),'id="data_form"');?>
            
          
           
			<table class="list" width="100%" id="my_data">
            
			<thead>
			  <tr>
				<td width="20" style="text-align: center;">
                                
                <input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);"  />
                
                </td>
				<td width="239" class="left">Name </td>
				<td width="174" align="center">Image</td>
				<!--td width="94" class="left">Display Order</td-->
				<td width="118" align="left" >Status</td>
				<td width="131" align="center">Action</td>
			</tr>
			</thead>
			<tbody>
			<?php
			$atts = array(
			'width'      => '740',
			'height'     => '600',
			'scrollbars' => 'yes',
			'status'     => 'yes',
			'resizable'  => 'yes',
			'screenx'    => '0',
			'screeny'    => '0'
			); 
			$controll_btn = 0;
			$sl = 0;	
			foreach($res as $destKey=>$pageVal)
			{ 
				$imgdisplay=FALSE;		
						
				$product_categories = array();

				$param_category = array(
											'where'=>"d.ref_product_id ='".$pageVal['products_id']."'"
										  );
				$category_res = $this->product_model->get_product_category($param_category);								
				if(is_array($category_res) && !empty($category_res))
				{
				  foreach($category_res as $dval)
				  {
					array_push($product_categories,$dval['category_name']);
				  }
				}
				
				
			?> 
				<tr>
					<td style="text-align: center;">
						<?php //echo  ++$sl;;?>
						<input type="checkbox" name="arr_ids[]" value="<?php echo  $pageVal['products_id'];?>" />
						<input type="hidden" name="friendly_url_<?php echo $pageVal['products_id'];?>" value="<?php echo $pageVal['friendly_url'];?>" />
                    </td>
					<td class="left">
						<?php echo $pageVal['prod_title'];?>
						<p>Type : <?php echo get_product_type($pageVal['prod_type']);?></p>
						<p>For : <?php echo get_product_for($pageVal['prod_for']);?></p>
						<?php
						if(!empty($product_categories))
						{
						  echo '<div class="green ">'.implode(',',$product_categories).'</div>';
						}
						
						?>
						<?php 
						$product_set_in = array();					
						
						if(!empty($product_set_in))
						{   echo "<br /><br />";
							echo implode("<br>",$product_set_in); 
						}
						?>
						<br /><?php echo anchor_popup('sitepanel/vendors/details/'.$pageVal['mem_id'], 'Vendor Details!', $atts);?><br /><br />
						<?php echo anchor_popup('sitepanel/products/details/'.$pageVal['products_id'], 'Details!', $atts);?><br /><br />
					</td>
                    <td align="center">
					  <img src="<?php echo get_image('product/images',$pageVal['product_image'],50,50,'AR');?>" />
                    </td>
					
					<td align="left" >
					  Admin:<?php echo ($pageVal['status']==1)? "Active":"In-active";?><br /><br />
					  Vendor:<?php echo ($pageVal['user_status']==1)? "Active":"Deleted";?><br /><br />
					  Site Status:<?php echo ($pageVal['user_status']==1 && $pageVal['status']==1)? "Active":($pageVal['user_status']==2 ? "Deleted" : "Inactive");?>
					</td>
					<td align="center" >
					  <?php echo anchor("sitepanel/products/quotation?product_id=$pageVal[products_id]/",'Quotation','target="_blank"'); ?>
					</td>
				</tr>
			<?php
			}		   
			?> 
			</tbody>
			</table>
			<?php
			if($page_links!='')
			{
			?>
			  <table class="list" width="100%">
			  <tr><td align="right" height="30"><?php echo $page_links; ?></td></tr>     
			  </table>
			<?php
			}
			?>
			<table class="list" width="100%">
			<tr>
				<td align="left" style="padding:2px" height="35">
					<?php
					if($this->activatePrvg===TRUE)
					{
					?>
					  <input name="status_action" type="submit"  value="Activate" class="button2" id="Activate" onClick="return validcheckstatus('arr_ids[]','Activate','Record','u_status_arr[]');"/>
					<?php
					}
					if($this->deactivatePrvg===TRUE)
					{
					?>
					<input name="status_action" type="submit" class="button2" value="Deactivate" id="Deactivate"  onClick="return validcheckstatus('arr_ids[]','Deactivate','Record','u_status_arr[]');"/>
					<?php
					}
					if($this->deletePrvg===TRUE)
					{
					?>
                    <input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onclick="return validcheckstatus('arr_ids[]','delete','Record');"/>
					<?php
					}
					if($this->featuredPrvg === FALSE)
					{
					?>
					<?php										
					 echo form_dropdown("set_as",$this->config->item('package_set_as_config'),$this->input->post('set_as'),'style="width:120px;" onchange="return onclickgroup(this)"'); ?>
					
                    <?php echo form_dropdown("unset_as",$this->config->item('package_unset_as_config'),$this->input->post('unset_as'),'style="width:120px;" onchange="return onclickgroup(this)"'); ?>
                    <?php
					}
					?>
                </td>
			</tr>
			</table>
			<?php
			echo form_close();
		}else{
			echo "<center><strong> No record(s) found !</strong></center>" ;
		}
		?> 
	</div>
    
</div>
<script type="text/javascript">
	<?php

	if(!$controll_btn)
	{
	?>
	  $('#slcbox').hide();
	<?php
	}
	?>		
	function onclickgroup(obj){
	  if(validcheckstatus('arr_ids[]','set','record','u_status_arr[]'))				  {			
		$('#data_form').submit();
	  }
	  else
	  {
		$('option:eq(0)',obj).attr('selected',true);
	  }
	}	
</script>
<?php $this->load->view('includes/footer'); ?>