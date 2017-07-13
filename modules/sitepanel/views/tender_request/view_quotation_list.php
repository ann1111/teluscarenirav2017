<?php $this->load->view('includes/header'); ?>  
  
  <div id="content">
  
  <div class="breadcrumb">
  
    <?php echo anchor('sitepanel/dashbord','Home');?>
	<?php
	if($member_id > 0)
	{
	  $member_res = $this->db->select('first_name')->get_where('wl_customers',array('customers_id'=>$member_id))->row();
	  if(is_object($member_res))
	  {
		echo ' <span class="pr2 fs14">»</span> ';
		echo anchor('sitepanel/members','Members');
		echo ' <span class="pr2 fs14">»</span> '.$member_res->first_name;
	  }
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
	
        
		<?php echo form_open("sitepanel/admin_tenders",'id="search_form" method="get" '); ?>
         <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
		<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
		  
          <tr>
			<td align="center" >Search [title ] 
            
				<input type="text" name="keyword" value="<?php echo $this->input->get_post('keyword');?>"  />&nbsp;
                
				
				
				<select name="quot_mode">
				  <option value="">Mode</option>
				  <option value="1" <?php echo $this->input->get_post('quot_mode')==='1' ? 'selected="selected"' : '';?>>Confirmed</option>
				  <option value="2" <?php echo $this->input->get_post('quot_mode')==='2' ? 'selected="selected"' : '';?>>Negotiation</option>
				  <option value="3" <?php echo $this->input->get_post('quot_mode')==='3' ? 'selected="selected"' : '';?>>Decline</option>
				  <option value="4" <?php echo $this->input->get_post('quot_mode')==='4' ? 'selected="selected"' : '';?>>Pending</option>
				</select>&nbsp;
				<input type="hidden" name="member_id" value="<?php echo $member_id;?>" />
				<a  onclick="$('#search_form').submit();" class="button"><span> GO </span></a>                
			
				<?php 
				if( $this->input->get_post('keyword')!='' || $this->input->get_post('quot_mode')!='' )
				{ 
				  echo anchor("sitepanel/admin_tenders",'<span>Clear Search</span>');
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
				<td width="239" class="left">Details </td>
				<td width="174" align="center">Attachments</td>
				<td width="118" align="left" >Posted</td>
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
				$res_attachment =  $this->db->select('media,sl')->get_where('wl_attachments',array('ref_id'=>$pageVal['quotation_id'],'media_type'=>'docs','media_section'=>'tender_quotation'))->result_array();

				$ref_product_id = array('-99');
				if($pageVal['ref_product_id']!='')
				{
				  $ref_product_id  = explode(',',$pageVal['ref_product_id']); 
				}

				$where = "a.poster_status ='1' AND a.quotation_id IN (".implode(',',$ref_product_id).")";

				$condtion_array = array(
											'fields'=>"count(a.quotation_id) as total_sbp",
											'where'=>$where,
											'offset'=>0,
											'limit'=>1,
											'debug'=>FALSE
										  );

				$condtion_array['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=b.mem_id");

				$res_vendors = $this->quote_model->get_quotes($condtion_array);

				$count_sbp = $res_vendors[0]['total_sbp'];
	
				?> 
				<tr>
					<td style="text-align: center;">
						<?php //echo  ++$sl;;?>
						<input type="checkbox" name="arr_ids[]" value="<?php echo  $pageVal['quotation_id'];?>" />
					</td>
					<td class="left">
						<b>Title:</b><br /> <?php echo $pageVal['tender_title'];?>
						<br /><br /><b>Quote:</b><br /> <?php echo $pageVal['comments'];?><br /><br />
					  <?php
					  if($count_sbp > 0)
					  {
						echo anchor_popup("sitepanel/admin_tenders/sbp_list/$pageVal[quotation_id]/",'SBP['.$count_sbp.']',$atts);
						echo "<br /><br />";
					  }
					  echo anchor_popup("sitepanel/members/details/$pageVal[posted_by]/",'Member Details',$atts);
						echo "<br /><br />";
					  ?>
					  <span class="red">Mode: <?php echo get_quote_status($pageVal['quotation_mode']);?></span>
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
					  <?php echo anchor("sitepanel/admin_tenders/tender_reply?quotation_id=$pageVal[quotation_id]/",'Replies','target="_blank"'); ?>
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