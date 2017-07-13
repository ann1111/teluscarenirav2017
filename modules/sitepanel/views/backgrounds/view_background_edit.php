<?php $this->load->view('includes/header'); ?>  
 <div id="content">
  
  <div class="breadcrumb">
  
      <?php echo anchor('sitepanel/dashbord','Home'); ?>
 &raquo; <?php echo anchor('sitepanel/backgrounds','Back To Listing'); ?> &raquo;  <?php echo $heading_title; ?> 
             
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">&nbsp;</div>
      
    </div>
   
<div class="content">       
<?php echo validation_message('');?>
<?php echo error_message(); ?> 
<?php echo form_open_multipart(current_url_query_string());?>    
<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
<tr>
	<th colspan="2" align="center" > </th>
</tr>
<tr class="trOdd">
<td width="28%" height="26" align="right" ><span class="required">*</span> Background Image:</td>
	<td align="left">
		<input type="file" name="image1" id="image1" />                 
		<?php
		 $j=1;
		 $product_path = "baackground/".$res->background_image;
		?>
         <a href="#"  onclick="$('#dialog_<?php echo $j;?>').dialog();">View</a>
         <div id="dialog_<?php echo $j;?>" title="Background Image" style="display:none;">
         <img src="<?php echo base_url().'uploaded_files/'.$product_path;?>"  /> </div>
        
		<br />
	</td>
</tr>
<tr class="trOdd">
	<td align="left">&nbsp;</td>
	<td align="left">
		<input type="submit" name="sub" value="Update" class="button2" />
		<input type="hidden" name="action" value="add" />
	</td>
</tr>
</table>    
</div>
</div>
<?php $this->load->view('includes/footer'); ?>