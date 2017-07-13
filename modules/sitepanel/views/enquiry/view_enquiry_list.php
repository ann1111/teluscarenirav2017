<?php $this->load->view('includes/header');
$ref_id               =  (int) $this->input->get_post('ref_id');
 
$block_path=$type=='1' ? "property_enquiry".($ref_id > 0 ? "?ref_id=$ref_id" : '') : ($type==2 ? " service_enquiry" : "enquiry");
?>  

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
     <?php  echo error_message(); ?>
        
		<?php echo form_open("sitepanel/$block_path/",'id="search_form"');?>
        <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
		<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
		 <?php 
                if(error_message() !=''){
               	   echo error_message();
                }
                ?> 
         <tr>
			<td align="center" ><strong>Search</strong> [  name,email<?php echo $type==1 ? ',property title' : '';?> ] 
			  <input type="text" name="keyword" value="<?php echo $this->input->get_post('keyword');?>"  />&nbsp;
			  
			  <select name="reply_status">
				<option value="">Reply Status</option>
				<option value="Y" <?php echo $this->input->get_post('reply_status')==='Y' ? 'selected="selected"' : '';?>>Replied</option>
				<option value="N" <?php echo $this->input->get_post('reply_status')==='N' ? 'selected="selected"' : '';?>>Non-Replied</option>
			  </select>
			
			<a  onclick="$('#search_form').submit();" class="button"><span> GO </span></a>			
			<?php
			if($this->input->get_post('keyword')!='' || $this->input->get_post('reply_status') !='')
			{ 
				echo anchor("sitepanel/$block_path/",'<span>Clear Search</span>');
			} 
			?>
		   </td>
		</tr>
		</table>
		<?php echo form_close();?>
		<?php
		if($type==1)
		{
		?>
		  <?php echo form_open("",'id="excel_form" method="get" ');?>
		  <input type="hidden" name="keyword" value="<?php echo $this->input->get_post('keyword');?>"  />
		  <input type="hidden" name="ref_id" value="<?php echo $ref_id;?>"  />
		  <?php echo form_close();?>
	   <span><a href="<?php echo base_url();?>sitepanel/property_enquiry/export_excel" class="export">Export to Excel</a></span>
		  <br /><br />
		<?php
		} 
		if( is_array($res) && !empty($res) )
		{
		?>
			<?php echo form_open("sitepanel/$block_path/",'id="data_form"');?>
          
			<table class="list" width="100%" id="my_data">
			<thead>
			<tr>
				<td width="22" style="text-align: center;"><?php if($this->deletePrvg===TRUE){?><input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" /><?php }?></td>
				<td width="188" class="left">User info</td>
				<td width="163" class="left"> Email</td>
				<?php
				if($type==1)
				{
				?>
				  <td width="163" class="left"> Property</td>
				<?php
				}
				?>
				<td width="424" class="left">Comments</td>
			</tr>
			</thead>
			<tbody>
			<?php
			$atts = array(
										'width'      => '600',
										'height'     => '300',
										'scrollbars' => 'yes',
										'status'     => 'yes',
										'resizable'  => 'yes',
										'screenx'    => '0',
										'screeny'    => '0'
									 );
			
			foreach($res as $catKey=>$res)
			{
				$address_details=array();
			?> 
				<tr>
					<td style="text-align: center;" valign="top">
					<?php
					if($this->deletePrvg===TRUE)
					{
					?>
                    <input type="checkbox" name="arr_ids[]" value="<?php echo $res['id'];?>" />
					<?php
					}
					?>
					</td>
					<td class="left" valign="top">
					<?php echo $res['first_name'];?> <?php echo $res['last_name'];?> <br>
					<?php 
					
					
					if($res['country']!="" && $res['country']!='0')
					{ 
						$address_details[]="<b>Country : </b>".$res['country']; 
					}
					
					if($res['city']!="" && $res['city']!='0')
					{ 
						$address_details[]="<b>City : </b>".$res['city']; 
					}
					
					if($res['state']!="" && $res['state']!='0')
					{ 
						$address_details[]="<b>State : </b>".$res['state']; 
					}
					
					
					if($res['company_name']!="" && $res['company_name']!='0')
					{ 
						$address_details[]="<b>Company : </b>".$res['company_name']; 
					}
					if($res['phone_number']!="" && $res['phone_number']!='0')
					{ 
						$address_details[]="<b>Phone : </b>".$res['phone_number'];  
					}
					if($res['mobile_number']!="" && $res['mobile_number']!='0')
					{ 
						$address_details[]="<b>Mobile : </b>".$res['mobile_number'];  
					}
					
					if($res['fax_number']!="" && $res['fax_number']!='0')
					{ 
						$address_details[]="<b>Fax : </b>".$res['fax_number'];  
					}
					if(!empty($address_details))
					{
						echo implode("<br>",$address_details)."<br />"; 
					}
					
					if($res['reply_status']=='Y')
					{
					  echo '<br /><span class="b red">Replied</span><br /><br />';
					}

					if($res['status']=='2')
					{
					  echo '<br /><span class="b red">User Status: Deleted</span><br /><br />';
					}
					
					?>
					
					<?php echo anchor_popup('sitepanel/enquiry/send_reply/'.$res['id'], 'Send Reply', $atts);?>
					</td>
					<td class="left" valign="top"><?php echo $res['email'];?></td>
					<?php
					if($type==1)
					{
					?>
					  <td class="left" valign="top"><?php echo $res['service'];?></td>
					<?php
					}
					?>
					<td class="left" valign="top">
					<?php
					if($res['subject'] !='' && $res['subject'] !='0')
					{
					  echo '<b>Subject:</b> '.$res['subject'].'<br /><br />';
					}
					?>
					  <?php echo nl2br($res['message']); ?> 
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
					<input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onClick="return validcheckstatus('arr_ids[]','delete','Record');"/>
					<?php
					}
					?>
					<input name="Send" type="submit"  value="Send Email" class="button2" id="Activate" onClick="return validcheckstatus('arr_ids[]','Send Email','Record','u_status_arr[]');"/>
				</td>
			</tr>
			</table>
			<?php echo form_close();
		}else{
			echo "<center><strong> No record(s) found !</strong></center>" ;
		}
		?> 
	</div>
</div>
<?php $this->load->view('includes/footer'); ?>