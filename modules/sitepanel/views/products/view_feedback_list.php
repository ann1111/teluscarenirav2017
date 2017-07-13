<?php $this->load->view('includes/header'); ?>  
  
  <div id="content">
  
  <div class="breadcrumb">
  
    <?php echo anchor('sitepanel/dashbord','Home');?>
	<?php
	echo '<span class="pr2 fs14">»</span> Feedbacks <span class="pr2 fs14">»</span> '.$heading_title;
	?>
   </div>      
       
 <div class="box">
	
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
		
     
    </div>
	
     <div class="content">
		<?php
		if($quotation_id > 0)
		{
		  $condtion_array = array(
								  'where'=>"a.quotation_id ='".$quotation_id."'",
								  'fields'=>"a.*",
								  'offset'=>0,
								  'limit'=>1,
								  'debug'=>FALSE
								);

		  $quote_res              =  $this->quote_model->get_quotes($condtion_array);

		  if(is_array($quote_res) && !empty($quote_res))
		  {
			$quote_res = $quote_res[0];
			echo $quote_res['comments']."<br /><br />";
		  }

		}
		?>

    	<div style="padding-top:5px;padding-left:10px;">
		  <div class="buttons fl"><?php echo anchor("sitepanel/products/quotation_feedback?type=complain&quotation_id=$quotation_id","<span>Complaints</span>",'class="button" style="color:'.($feed_trk=='complain' ? '#f00' : '#fff').';"' );?></div>
		   <div class="buttons fl" style="padding-left:5px;"><?php echo anchor("sitepanel/products/quotation_feedback?type=suggestion&quotation_id=$quotation_id","<span>Suggestions</span>",'class="button" style="color:'.($feed_trk=='suggestion' ? '#f00' : '#fff').';" ' );?></div>
		  <div class="buttons fl" style="padding-left:5px;"><?php echo anchor("sitepanel/products/quotation_feedback?type=queries&quotation_id=$quotation_id","<span>Queries</span>",'class="button" style="color:'.($feed_trk=='queries' ? '#f00' : '#fff').';" ' );?></div>
		</div>
		<div class="cb"></div>
        <?php  echo error_message(); ?>
	
        
		<?php echo form_open("sitepanel/products/quotation",'id="search_form" method="get" '); ?>
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
                  Sl.              
                <!--input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);"  /-->
                
                </td>
				<td width="239" class="left">Details </td>
				<td width="174" align="center">Sender</td>
				<td width="118" align="left" >Receiver</td>
				<td width="131" align="center">Posted</td>
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
			  ?> 
				<tr>
					<td style="text-align: center;">
						<?php echo  ++$sl;;?>
						<!--input type="checkbox" name="arr_ids[]" value="<?php echo  $pageVal['quotation_id'];?>" /-->
					</td>
					<td class="left">
						<b>Quote For:</b><br /> <?php echo anchor_popup('sitepanel/products/details/'.$pageVal['ref_product_id'], $pageVal['prod_title'], $atts);?>
						<br /><br /><b>Subject:</b><br /> <?php echo $pageVal['subject'];?>
					  <br /><br /><b>Comments</b><br /> <?php echo $pageVal['feedback'];?><br /><br />

					  <?php
					  if(!is_null($pageVal['quot_type']))
					  {
						echo '<p>';
						echo anchor_popup('sitepanel/products/quote_details/'.$pageVal['ref_quot_id'], 'Quote Details', $atts);
						echo '</p>';
					  }
					  ?>
					</td>
                    <td align="center" valign="top">
					  <?php echo $pageVal['first_name'];?>
                    </td>
					<td>
					<?php 
					$recv_res = $this->db->select('user_type,company_name,first_name')->get_where('wl_customers',array('customers_id'=>$pageVal['receiver_id']))->row();
					if(is_object($recv_res))
					{
						if($recv_res->user_type==1)
						{
						  echo $recv_res->first_name;
						}
						else
						{
						  echo $recv_res->company_name;
						}
					}
					?>
					</td>
					<td align="left" >
					  <?php echo date("d F, Y",strtotime($pageVal['date_added']));?>
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
                    <!--input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onclick="return validcheckstatus('arr_ids[]','delete','Record');"/-->
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