<?php $this->load->view('includes/header'); ?>
<?php

$values_posted_back=(is_array($this->input->post())) ? TRUE : FALSE;

?>  
 <div id="content">
  <div class="breadcrumb">
       <?php echo anchor('sitepanel/dashbord','Home'); ?>
        &raquo; <?php echo anchor('sitepanel/accessories'.($result['acc_parent_id']==0 ? '' : '/index/'.$result['acc_parent_id']),'Back To Listing'); ?> &raquo; <?php echo $heading_title; ?> </a>
        
      </div>
      
      <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
     <div class="buttons"><?php echo anchor("sitepanel/accessories/",'<span>Cancel</span>','class="button" ' );?></div>
      
    </div>
    
    <div class="content">
       
	<?php echo error_message(); ?>  
    
	<?php echo form_open_multipart(current_url_query_string(),array('id'=>'accfrm','name'=>'accfrm'));?>  
		<div id="tab_pinfo">
			<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
			<tr>
				<th colspan="2" align="center" > </th>
			</tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" >Name</td>
				<td align="left">
					<input type="text" name="acc_name" value="<?php echo set_value('acc_name',$result['acc_name']);?>" />
					<br />
				</td>
			</tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" >Image :</td>
				<td align="left">
					<input type="file" name="acc_image" />
					<?php
					if($result['acc_image']!='' && file_exists(UPLOAD_DIR."/accessories/".$result['acc_image']))
					{ 
					?>
						 <a href="javascript:void(0);"  onclick="$('#dialog').dialog({width:'auto',height:'auto'});">View</a>
					<?php if($this->deletePrvg===TRUE){?> | <input type="checkbox" name="acc_img_delete" value="Y" />Delete <?php } ?>
                        
					<?php	
					}
					?>
					<br />
                    <br />
					[ <?php echo $this->config->item('acc.best.image.view');?> ]
					<div id="dialog" title="Image" style="display:none;">
					<img src="<?php echo base_url().'uploaded_files/accessories/'.$result['acc_image'];?>"  />						</div>
				  <?php echo form_error('acc_image');?>
				</td>
			</tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" >Alt</td>
				<td align="left">
					<input type="text" name="acc_alt" value="<?php echo set_value('acc_alt',$result['acc_alt']);?>" />
					<br />
				</td>
			</tr>
            <!--tr class="trOdd">
                <td height="26"> Description:</td>
                <td>
               <textarea name="category_description" rows="5" cols="50" id="cat_desc" ><?php echo set_value('acc_description',$catresult['acc_description']);?></textarea><?php  echo display_ckeditor($ckeditor); ?>
                </td>
            </tr-->
            
			<tr class="trOdd">
				<td align="left">&nbsp;</td>
				<td align="left">
					<input type="submit" name="sub" value="Update" class="button2" />
					<input type="hidden" name="action" value="edit" />
					<input type="hidden" name="acc_id" id="pg_recid" value="<?php echo $result['acc_id'];?>">
				</td>
			</tr>
			</table>
		</div>
	<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('includes/footer'); ?>