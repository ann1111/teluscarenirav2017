<?php $this->load->view('includes/header'); ?>  
  
  <div id="content">
  
  <div class="breadcrumb">
  
    <?php echo anchor('sitepanel/dashbord','Home'); 
	$segment=4;	
	$catid    = (int) $this->uri->segment(4,0);		
	
	if($catid )
	{
		 echo admin_category_breadcrumbs($catid,$catid);
		 
	}else
	{
		echo '<span class="pr2 fs14">»</span> '.$heading_title;
	}   
    ?>
       
             
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
		<div class="buttons"><?php echo anchor("sitepanel/category/add/$parent_id","<span>Add $heading_title</span>",'class="button" ' );?></div>
     
    </div>
   
  
      
     <div class="content">
    	
        <?php  echo error_message(); ?>
	
        
		<?php echo form_open("sitepanel/category/index/$parent_id",'id="search_form" method="get" '); ?>
         <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
		<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
		  
          <tr>
			<td align="center" >Search [name ] 
            
				<input type="text" name="keyword" value="<?php echo $this->input->get_post('keyword');?>"  />&nbsp;
                
				<select name="status">
                
					<option value="">Status</option>
					<option value="1" <?php echo $this->input->get_post('status')==='1' ? 'selected="selected"' : '';?>>Active</option>
					<option value="0" <?php echo $this->input->get_post('status')==='0' ? 'selected="selected"' : '';?>>In-active</option>
                    
				</select>
                
				<a  onclick="$('#search_form').submit();" class="button"><span> GO </span></a>                
			
				<?php 
				if( $this->input->get_post('keyword')!='' || $this->input->get_post('status')!='' )
				{ 
				   $parentid = (int) $this->input->get_post('parent_id');
				   if($parentid > 0 )
				   {					   
					  echo anchor("sitepanel/category/index/$parentid",'<span>Clear Search</span>'); 
					   
				   }else
				   {
					    echo anchor("sitepanel/category/",'<span>Clear Search</span>');
					 
				   }				  
				} 
				?>
                <input type="hidden" name="parent_id" value="<?php echo $parent_id;?>"  />
			</td>
		</tr>        
		</table>
		<?php echo form_close();?>
        
		<?php
		if(is_array($res) && ! empty($res))
		{
			
		?>
        
          
        
			<?php echo form_open("sitepanel/category/",'id="data_form"');?>
            
          
           
			<table class="list" width="100%" id="my_data">
            
			<thead>
			  <tr>
				<td width="20" style="text-align: center;">
                                
                <input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" id="slcbox" />
                
                </td>
				<td width="239" class="left">Name </td>
				<td width="174" align="center">Image</td>
				<td width="94" class="left">Display Order</td>
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
			foreach($res as $catKey=>$pageVal)
			{ 
				$imgdisplay=FALSE;		
						
				$displayorder       = ($pageVal['sort_order']!='') ? $pageVal['sort_order']: "0";								
				
				$total_subcategory  =  $pageVal['total_subcategories'];

				$condtion_product   =  "JOIN wl_product_category as b ON a.products_id=b.ref_product_id WHERE  b.category_id='".$pageVal['category_id']."' AND a.status!='2'";

				$total_products     =  count_products($condtion_product);

				?> 
				<tr>
					<td style="text-align: center;">
						<?php
						if($pageVal['is_fixed']!='1')
						{
						  $controll_btn = 1; 
						?>
						<input type="checkbox" name="arr_ids[]" value="<?php echo  $pageVal['category_id'];?>" />
						<?php
						}
						?>
						<input type="hidden" name="friendly_url_<?php echo $pageVal['category_id'];?>" value="<?php echo $pageVal['friendly_url'];?>" />
                        <input type="hidden" name="category_count" value="Y" />
                        <input type="hidden" name="product_count" value="Y" />
					</td>
					<td class="left">
						<?php echo $pageVal['category_name'];?>
						<?php
						if($total_subcategory>0 && $pageVal['parent_id']==0)
						{
							echo "<br><br>".anchor("sitepanel/category/index/".$pageVal['category_id'],'Subcategory ['. $total_subcategory.']','class="refSection" ' );
							
						}elseif($total_products>0)
						{
							echo "<br><br>".anchor("sitepanel/products?category_id=".$pageVal['category_id'],'Products ['. $total_products.']','class="refSection" ' );
						}else
						{
							echo "<br><br>";
							if($pageVal['parent_id']==0)
							{
								echo anchor("sitepanel/category/index/".$pageVal['category_id'],'Subcategory ['. $total_subcategory.']','class="refSection" ');
								
								echo " | ";
							 }
							  echo anchor("sitepanel/products?category_id=".$pageVal['category_id'],'Products ['. $total_products.']','class="refSection" ');
								
						}
						?>
						<?php 
						$category_set_in = array();					
						if($pageVal['set_home']!="" && $pageVal['set_home']!='0')
						{ 
							//$category_set_in[]="<b class='red'>Set as Home  : </b> Yes";
						}					
											
						if(!empty($category_set_in))
						{   echo "<br /><br />";
							echo implode("<br>",$category_set_in); 
						}
						?>
						
					</td>
                    <td align="center">
					  <img src="<?php echo get_image('category',$pageVal['category_image'],50,50,'AR');?>" />
                    </td>
					<td>
                     <input type="text" name="ord[<?php echo $pageVal['category_id'];?>]" value="<?php echo $displayorder;?>" size="5" />
                    </td>
					<td align="left" ><?php echo ($pageVal['status']==1)? "Active":"In-active";?></td>
					<td align="center" >
						<?php
						if($this->editPrvg===TRUE)
						{
						 echo anchor("sitepanel/category/edit/$pageVal[category_id]/".query_string(),'Edit'); 
						 echo "&nbsp;";
						}
						?>
						<?php
						if($this->deletePrvg===TRUE && is_null($pageVal['cat_type']))
						{
						  echo '  '.anchor("sitepanel/category/delete/$pageVal[category_id]/".query_string(),'Delete','onclick = \'return confirm("Are you sure to delete this category");\''); 
						}
						
						?>     
						
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
					if($this->activatePrvg===TRUE && $controll_btn > 0)
					{
					?>
					  <input name="status_action" type="submit"  value="Activate" class="button2" id="Activate" onClick="return validcheckstatus('arr_ids[]','Activate','Record','u_status_arr[]');"/>
					<?php
					}
					if($this->deactivatePrvg===TRUE && $controll_btn > 0)
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
					if($this->orderPrvg===TRUE)
					{
					?>
					  <input name="update_order" type="submit"  value="Update Order" class="button2" />
					<?php
					}
					if($this->featuredPrvg === TRUE)
					{
					?>
					<?php										
					 //echo form_dropdown("set_as",$this->config->item('category_set_as_config'),$this->input->post('set_as'),'style="width:120px;" onchange="return onclickgroup()"'); ?>
					
                    <?php //echo form_dropdown("unset_as",$this->config->item('category_unset_as_config'),$this->input->post('unset_as'),'style="width:120px;" onchange="return onclickgroup()"'); ?>
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
	function onclickgroup(){
		if(validcheckstatus('arr_ids[]','set','record','u_status_arr[]')){			
			$('#data_form').submit();
		}
	}	
</script>
<?php $this->load->view('includes/footer'); ?>