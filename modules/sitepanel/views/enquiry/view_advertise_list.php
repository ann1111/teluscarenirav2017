<?php $this->load->view('includes/header');?>  
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
        
		<?php echo form_open("sitepanel/advertise/",'id="search_form"');?>
        <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
		<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
		 <?php 
                if(error_message() !=''){
               	   echo error_message();
                }
                ?> 
         <tr>
			<td align="center" ><strong>Search</strong> [  name,email,company name,comment ] 
			  <input type="text" name="keyword" value="<?php echo $this->input->get_post('keyword');?>"  />&nbsp;			
			<a  onclick="$('#search_form').submit();" class="button"><span> GO </span></a>			
			<?php
			if($this->input->get_post('keyword')!='')
			{ 
				echo anchor("sitepanel/advertise/",'<span>Clear Search</span>');
			} 
			?>
		   </td>
		</tr>
		</table>
		<?php echo form_close();?>
		<?php 
		if( is_array($res) && !empty($res) )
		{
		?>
			<?php echo form_open("sitepanel/advertise/",'id="data_form"');?>
          
			<table class="list" width="100%" id="my_data">
			<thead>
			<tr>
				<td width="22" style="text-align: center;"><?php if($this->deletePrvg===TRUE){?><input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" /><?php }?></td>
				<td width="188" class="left">Name</td>
				<td width="163" class="left"> Email</td>
				<td width="163" class="left"> Image</td>
				<td width="163" class="left"> Requirement</td>
				<td width="424" class="left">Comments</td>
				<td width="163" class="left"> Posted</td>
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
					<?php echo $res['mem_name'];?>
					<br /><br />
					<?php echo anchor_popup('sitepanel/advertise/send_reply/'.$res['id'], 'Send Reply', $atts);?>
					</td>
					<td class="left" valign="top"><?php echo $res['email'];?></td>
					<td align="center" valign="top">
					  <?php
					  if($res['banner']!='' && file_exists(UPLOAD_DIR."/advertisement/".$res['banner']))
					  {
					  ?>
					  <a href="javascript:void(0);"  onclick="$('#dialog_<?php echo $catKey;?>').dialog({width:'auto',height:'auto'});"><img src="<?php echo get_image('advertisement',$res['banner'],200,200,'R');?>" /></a>
					  <div id="dialog_<?php echo $catKey;?>" title="Banner Image" style="display:none;"><img src="<?php echo base_url().'uploaded_files/advertisement/'.$res['banner'];?>"  /> </div>
					  <?php
					  }
					  else
					  {
						echo "-";
					  }
					  ?>
					</td>
					<td class="left" valign="top" nowrap>
					  <table width="100%">
					  <tr>
						<td width="30%"><span class="red b">Company Name </span></td>
						<td><?php echo formatCustomValue(array('val'=>$res['company_name']));?></td>
					  </tr>
					  <tr>
						<td><span class="red b">Mobile </span></td>
						<td><?php echo formatCustomValue(array('val'=>$res['mobile_number']));?></td>
					  </tr>
					  <tr>
						<td><span class="red b">Website </span></td>
						<td><?php echo formatCustomValue(array('val'=>$res['website_url']));?></td>
					  </tr>
					  
					  </table>
					</td>
					
					<td class="left" valign="top">
					<?php echo nl2br($res['comment']); ?> 
					</td> 
					<td class="left" valign="top">
					<?php echo date("M d, Y",strtotime($res['inserted_on'])); ?> 
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