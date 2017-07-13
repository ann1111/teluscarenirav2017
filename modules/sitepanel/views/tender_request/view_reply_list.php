<?php $this->load->view('includes/header'); ?>  
  
  <div id="content">
  
  <div class="breadcrumb">
  
    <?php echo anchor('sitepanel/dashbord','Home');?>
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
	
        <?php
		if($this->input->get_post('quotation_id') > 0)
		{
		  echo '<a href="javascript:void(0);" onclick="window.open(\''.base_url().'sitepanel/admin_tenders/reply_quotation/'.$this->input->get_post('quotation_id').'\',\'rep\',\'width=580,height=500,scrollbars=yes\');" class="button">Reply</a>'; 
		}
		?>
		<?php echo form_open("",'id="search_form" method="get" '); ?>
		  <input type="hidden" name="quotation_id" value="<?php echo $this->input->get_post('quotation_id');?>" />
         <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
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
                                
                <!--input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);"  /-->
                
                </td>
				<td width="139" class="left">Posted By </td>
				<td width="239" class="left">Tender Details </td>
				<td width="239" class="left">Reply </td>
				<td width="174" align="left">Attachments</td>
				<td width="131" align="left">Posted</td>
				<td width="131" align="left">Action</td>
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
				$res_attachment =  $this->db->select('media,sl')->get_where('wl_attachments',array('ref_id'=>$pageVal['reply_id'],'media_type'=>'docs','media_section'=>'reply_quotation'))->result_array();
	
				?> 
				<tr>
					<td style="text-align: center;">
						<?php //echo  ++$sl;?>
						<input type="checkbox" name="arr_ids[]" value="<?php echo  $pageVal['reply_id'];?>" />
					</td>
					<td class="left">
					  <?php
					  if($pageVal['posted_by']==0)
					  {
						echo "Me";
					  }
					  else
					  {
						echo trim($pageVal['first_name'].' '.$pageVal['last_name']);
					  }
					  ?>	
					</td>
					<td>
					  <p><?php echo $pageVal['tender_title'];?></p>
					  <div class="mt5"><?php echo $pageVal['tender_comment'];?></div>
					</td>
					<td>
					  <p><?php echo $pageVal['subject'];?></p>
					  <div class="mt5"><?php echo $pageVal['comments'];?></div>
					</td>
                    <td align="center" valign="top">
					  <?php
					  if(is_array($res_attachment) && !empty($res_attachment))
					  {
					  ?>
						<p class="mt10 blue1 i fs13 b">
						  <?php
						  $sptr = '';
						  foreach($res_attachment as $dval)
						  {
						  ?>
							<?php echo $sptr;?><a href="<?php echo base_url();?>sitepanel/admin_tenders/download_attachment/<?php echo $dval['sl'];?>" class="uu dib">-<?php echo $dval['media'];?></a>
						  <?php
							$sptr = '<br /><br />';
						  }
						  ?>
						</p>
					  <?php
					  }
					  else
					  {
						echo "-";
					  }
					  ?>
                    </td>
					
					<td align="left" >
					 <?php echo date("d F, Y",strtotime($pageVal['date_added']));?>
					</td>
					<td align="center" >
					  <?php echo anchor_popup("sitepanel/admin_tenders/reply_quotation/$pageVal[ref_quot_id]/",'Reply','width=300,height=400'); ?>
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
					if($this->deletePrvg===TRUE)
					{
					?>
                    <input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onclick="return validcheckstatus('arr_ids[]','delete','Record');"/>
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