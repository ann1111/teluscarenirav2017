<?php $this->load->view('includes/header'); ?>

  <div id="content">
  <div class="breadcrumb">
     <?php echo anchor('sitepanel/dashbord','Home'); ?> &raquo; <?php echo $heading_title;?>        
      </div>
      
      <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">&nbsp;</div>
    </div>
    <div class="content">
    
   
     <div class="required">                        
                <strong> Total Record(s) Found : <?php echo $total_rec; ?></strong>  
         </div>
                  
      <?php   echo form_open("sitepanel/members",'id="search_form" method="get" ');    ?>
       <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
   
    <table width="100%"  border="0" align="center" cellspacing="3" cellpadding="3">
    <?php 
	 
	
                if(error_message() !=''){
               	   echo error_message();
                }
                ?> 
      <tr>
        <td width="52%" align="right" valign="top" >
          <strong>Search </strong> [ name,username ]
          <input name="keyword" type="text" value="<?php echo trim($this->input->get_post('keyword'));?>" size="35"  />&nbsp;</td>
        <td width="9%" align="center" >
            <select name="status">
            
            <option value="">Status</option>
            <option value="1" <?php echo $this->input->get_post('status')==='1' ? 'selected="selected"' : '';?>>Active</option>
            <option value="0" <?php echo $this->input->get_post('status')==='0' ? 'selected="selected"' : '';?>>In-active</option>
            
            </select>
        </td>
        
        
        <td width="39%" align="left" ><a  onclick="$('#search_form').submit();" class="button"><span>GO </span></a>&nbsp;
        <?php
            if( $this->input->get_post('keyword')!='' || $this->input->get_post('status')!='' )
            {             
			   echo anchor("sitepanel/members/",'<span>Clear Search</span>');
            }
            ?></td>
	  </tr>
			</table>
        <?php   echo form_close();     ?>
		<?php echo form_open("",'id="excel_form" method="get" ');?>
		<input type="hidden" name="keyword2" value="<?php echo $this->input->get_post('keyword2');?>"  />
		<input type="hidden" name="status" value="<?php echo $this->input->get_post('status');?>"  />
		<?php echo form_close();?>
	<!--span><a href="<?php echo base_url();?>sitepanel/members/export_members_csv" class="export">Export to CSV</a></span></span-->
      <br /><br />
    
	<?php
	if( count($pagelist) > 0 )
    {
      ?>
	  <?php  echo form_open("sitepanel/members/",'id="data_form"');?>         
  
	  <table class="list" width="100%" id="my_data">
	  <?php

		  $atts = array(
							'width'      => '650',
							'height'     => '600',
							'scrollbars' => 'yes',
							'status'     => 'yes',
							'resizable'  => 'yes',
							'screenx'    => '0',
							'screeny'    => '0'
						);
	  ?>	
      <thead>
        <tr>
          <td width="31" style="text-align: center;">
          <input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" /></td>
          <td width="295" class="left">Name</td>
          <td width="217" class="left">Username</td>
          <td width="148" class="left">Password</td>
          <td width="174" align="left" >Reg. Date </td>
          <td width="169" class="right">Status</td>
        </tr>
      </thead>
      <tbody>
      <?php
      
      foreach($pagelist as $catKey=>$pageVal)
      {
		  $member_name = trim($pageVal['first_name'].' '.$pageVal['last_name']);
		?>
        <tr>
          <td style="text-align: center;"><input type="checkbox" name="arr_ids[]" value="<?php echo $pageVal['customers_id'];?>" /></td>
          <td class="left">
            <?php echo $member_name;?>             
             <br /> 
               <?php echo anchor_popup('sitepanel/members/details/'.$pageVal['customers_id'], 'View Details!', $atts);?><br /><br />
				<?php echo anchor('sitepanel/products/quotation?member_id='.$pageVal['customers_id'], 'Quotes', array('target'=>'_blank'));?>
				| <?php echo anchor('sitepanel/admin_tenders?member_id='.$pageVal['customers_id'], 'Tender Request', array('target'=>'_blank'));?>
			    <?php //echo anchor_popup('sitepanel/members/products_viewed/'.$pageVal['customers_id'], 'Products Viewed [ '.$product_viewed.' ] ', $atts);?>
          </td>
          <td class="left"><?php echo $pageVal['user_name'];?></td>
          <td class="left"><?php echo $this->safe_encrypt->decode($pageVal['password']);?></td>
          <td class="left"><?php echo getDateFormat($pageVal['account_created_date'],7);?></td>
          <td class="right"><?php echo ($pageVal['status']=='1')?"Active":"Inactive";?>
         
        
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
      		<td align="left" style="padding:5px">
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
      		?>
            <?php
			if($this->deletePrvg===TRUE)
			{
			?>    
   			<input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onClick="return validcheckstatus('arr_ids[]','delete','Record');"/>
			<?php
			}
			?> 
            
		
            </td>
   		</tr>
      </tbody>
	  </table>
	  <?php echo form_close(); ?>
    <?php
    }
    else{
      echo "<div class='ac b'> No record(s) found !</div>" ;
    }
    ?>
 </div>
</div>
<script type="text/javascript">		
	$('.export').click(function(e){
	  e.preventDefault();
	  lobj = $(this);
	  $('#excel_form').attr('action',lobj.attr('href')).submit();
	  
	});	
</script>
<?php $this->load->view('includes/footer'); ?>