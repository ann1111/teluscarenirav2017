<?php $this->load->view('includes/header'); ?>  
  
  <div id="content">
  
  <div class="breadcrumb">
  
    <?php echo anchor('sitepanel/dashbord','Home'); 
	if($parent_id > 0)
	{
	  $parent_res = $this->db->select('attr_name')->get_where('wl_attributes',array('attr_id'=>$parent_id))->row();
	  if(is_object($parent_res))
	  {
		echo ' <span class="pr2 fs14">»</span> ';
		echo anchor('sitepanel/attributes','Attributes');
		echo ' <span class="pr2 fs14">»</span> '.$parent_res->attr_name;
	  }
	}
	else
	{
	  echo '<span class="pr2 fs14">»</span> '.$heading_title;
	}
	?>
       
             
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
		<?php
		if($parent_id > 0)
		{
		?>
		<div class="buttons"><?php echo anchor("sitepanel/attributes/add/$parent_id","<span>Add $heading_title</span>",'class="button" ' );?></div>
		<?php
		} 
		?>
    </div>
   
  
      
     <div class="content">
    	
        <?php  echo error_message(); ?>
	
        
		<?php echo form_open("sitepanel/attributes/index/$parent_id",'id="search_form" method="get" '); ?>
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
					  echo anchor("sitepanel/attributes/index/$parentid",'<span>Clear Search</span>'); 
					   
				   }else
				   {
					    echo anchor("sitepanel/attributes/",'<span>Clear Search</span>');
					 
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
        
          
        
			<?php echo form_open("sitepanel/attributes/",'id="data_form"');?>
            
          
           
			<table class="list" width="100%" id="my_data">
            
			<thead>
			  <tr>
				<td width="20" style="text-align: center;">
                                
                <input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" id="slcbox" />
                
                </td>
				<td width="239" class="left">Name </td>
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
			foreach($res as $catKey=>$pageVal)
			{ 
				$imgdisplay=FALSE;		
						
				$displayorder       = ($pageVal['sort_order']!='') ? $pageVal['sort_order']: "0";								
				
				$total_subattr  =  $pageVal['total_subattr'];
				?> 
				<tr>
					<td style="text-align: center;">
						<input type="checkbox" name="arr_ids[]" value="<?php echo  $pageVal['attr_id'];?>" />
					</td>
					<td class="left">
						<?php echo $pageVal['attr_name'];?>
						<?php
						if($pageVal['attr_parent_id'] == 0)
						{
						echo "<br><br>".anchor("sitepanel/attributes/index/".$pageVal['attr_id'],'Sub-Attributes ['. $total_subattr.']','class="refSection" ');
						}
						?>
					</td>
                    <!--td>
                     <input type="text" name="ord[<?php echo $pageVal['category_id'];?>]" value="<?php echo $displayorder;?>" size="5" />
                    </td-->
					<td align="left" ><?php echo ($pageVal['status']==1)? "Active":"In-active";?></td>
					<td align="center" >
						<?php
						if($this->editPrvg===TRUE)
						{
						 echo anchor("sitepanel/attributes/edit/$pageVal[attr_id]/".query_string(),'Edit'); 
						 echo "&nbsp;";
						}
						?>
						<?php
						if($this->deletePrvg===TRUE && $parent_id > 0 )
						{
						  echo '  '.anchor("sitepanel/attributes/delete/$pageVal[attr_id]/".query_string(),'Delete','onclick = \'return confirm("Are you sure to delete this record");\''); 
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
					if($this->activatePrvg===TRUE)
					{
					?>
					  <input name="status_action" type="submit"  value="Activate" class="button2" id="Activate" onClick="return validcheckstatus('arr_ids[]','Activate','Record','u_status_arr[]');"/>
					<?php
					}
					if($this->deactivatePrvg===TRUE> 0)
					{
					?>
					<input name="status_action" type="submit" class="button2" value="Deactivate" id="Deactivate"  onClick="return validcheckstatus('arr_ids[]','Deactivate','Record','u_status_arr[]');"/>
					<?php
					}
					if($this->deletePrvg===TRUE && $parent_id > 0)
					{
					?>
                    <input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onclick="return validcheckstatus('arr_ids[]','delete','Record');"/>
					<?php
					}
					if($this->orderPrvg===TRUE)
					{
					?>
					  <!--input name="update_order" type="submit"  value="Update Order" class="button2" /-->
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
	function onclickgroup(){
		if(validcheckstatus('arr_ids[]','set','record','u_status_arr[]')){			
			$('#data_form').submit();
		}
	}	
</script>
<?php $this->load->view('includes/footer'); ?>