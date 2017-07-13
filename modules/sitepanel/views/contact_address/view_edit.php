<?php $this->load->view('includes/header'); ?>  

 <div id="content">
  
  <div class="breadcrumb">
  
  <?php echo anchor('sitepanel/dashbord','Home'); ?>
 &raquo; <?php echo anchor('sitepanel/contact_address','Back To Listing'); ?> &raquo;  <?php echo $heading_title; ?>
 
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">&nbsp;</div>
      
    </div>
   
  
     <div class="content">
   
       
	    <?php echo validation_message();?>
        <?php echo error_message(); ?>
     
     
       <?php echo form_open_multipart(current_url_query_string());?>  

	<table width="90%"  class="tableList" align="center">
		<tr>
			<th colspan="2" align="center" > </th>
		</tr>
		<tr class="trOdd">
			<td height="26">* Country:</td>
			<td>
			<?php echo CountrySelectBox(array('name'=>'country_name','format'=>'style="padding:5px;"','current_selected_val'=>set_value('country_name',$res->country_name) )); ?>
			</td>
		</tr>
		<tr class="trEven">
			<td width="253" height="26">* Address:</td>
			<td width="597" style="f">
            <textarea name="address" rows="10" cols="42"><?php echo set_value('address',$res->address);?></textarea>
			
			</td>
		</tr>
		<tr class="trOdd">
			<td align="left">&nbsp;</td>
			<td align="left">
			<input type="submit" name="sub" value="Update" class="button2" />
			<input type="hidden" name="id" value="<?php echo $res->sl;?>" />
			<input type="hidden" name="action" value="addnews" />
			</td>
		</tr>
	</table>
<?php echo form_close(); ?>
  </div>
</div>
<?php $this->load->view('includes/footer'); ?>