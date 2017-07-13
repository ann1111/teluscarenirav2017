<?php $this->load->view('includes/header'); ?>
<?php $cat_type = set_value('cat_type');?>  
 <div id="content">
  
  <div class="breadcrumb">
  
      <?php echo anchor('sitepanel/dashbord','Home'); ?>
 &raquo; <?php echo anchor('sitepanel/company_type','Back To Listing'); ?> &raquo;  <?php echo $heading_title; ?> 
             
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">&nbsp;</div>
      
    </div>
   
  
     <div class="content">
   
       
	    <?php echo validation_message();?>
        <?php echo error_message(); ?>
        
       <?php echo form_open_multipart('sitepanel/company_type/add/');?>  

	<table width="90%"  class="tableList" align="center">
		<tr>
			<th colspan="2" align="center" > </th>
		</tr>
		<tr class="trOdd">
			<td height="26">* <span class="left">Category</span>:</td>
			<td>
			  <select name="cat_type">
				<option value="">Select</option>
				<?php
				foreach($this->cat_type_added as $key=>$val)
				{
				?>
				  <option value="<?php echo $key;?>" <?php echo $cat_type==$key ? ' selected="selected"' : '';?>><?php echo $val;?></option>
				<?php
				}
				?>
			  </select>
			</td>
		</tr>
		<tr class="trOdd">
			<td height="26">* <span class="left">Type</span>:</td>
			<td><input type="text" name="fld_value" size="40" value="<?php echo set_value('fld_value');?>"></td>
		</tr>
		<tr class="trOdd">
			<td align="left">&nbsp;</td>
			<td align="left">
			<input type="submit" name="sub" value="Add" class="button2" />
			<input type="hidden" name="action" value="addnews" />
			</td>
		</tr>
	</table>
<?php echo form_close(); ?>
  </div>
</div>
<?php $this->load->view('includes/footer'); ?>