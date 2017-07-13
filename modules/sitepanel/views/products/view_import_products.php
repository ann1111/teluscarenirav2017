<?php $this->load->view('includes/header'); ?>
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
<div class="content">
    <div id="content">
  <div class="breadcrumb">
       <?php echo anchor('sitepanel/dashbord','Home'); ?>
        &raquo; <?php echo $heading_title; ?> </a>
        
      </div>
      
      <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      
      
    </div>
	
    <div class="content">
	<span><a href="<?php echo base_url();?>sitepanel/products/download_sample_excel">Sample Import Excel</a></span>&nbsp;<span style="padding-left:20px;"><a href="#" onclick="$('#dialog_1').dialog( {width: 650} );">Note Regarding Import</a></span>&nbsp;<span style="padding-left:20px;"><?php echo anchor_popup('sitepanel/products/import_ids/', 'Valid Ids', $atts);?></span>
    <br /><br />
	 <div id="dialog_1" title="Note" style="display:none;">
		<table width="100%" class="List">
		<tr>
		  <th colspan="2">Important Note</th>
		</tr>
		<tr>
		  <th align="left" width="20%" class="red" valign="top">Category</th>
		  <td valign="top">
			  <ul>
				<li>must not be empty</li>
				<li>must be a numeric value mentioned in the valid ids link</li>
			  </ul>
		  </td>
		</tr>
		<tr>
		  <th align="left" class="red">Product Name</th>
		  <td>
			<ul>
			  <li>must not be empty</li>
			  <li>should not exceed 100 characters</li>
			</ul>
		  </td>
		</tr>
		<tr>
		  <th align="left" class="red">Product Code</th>
		  <td>
			<ul>
			  <li>must not be empty</li>
			  <li>must be unique</li>
			  <li>should not exceed 64 characters</li>
			</ul>
		  </td>
		</tr>
		<tr>
		  <th align="left" class="red">Description</th>
		  <td>
			  <ul>
				<li>can be empty</li>
				<li>should not exceed 6400 characters</li>
			  </ul>
		  </td>
		</tr>
		<tr>
		  <th align="left" class="red">Product Specifications</th>
		  <td>
			  <ul>
				<li>can be empty</li>
				<li>should not exceed 6400 characters</li>
			  </ul>
		  </td>
		</tr>
		<tr>
		  <th align="left" class="red">Additional Features</th>
		  <td>
			  <ul>
				<li>can be empty</li>
				<li>should not exceed 6400 characters</li>
			  </ul>
		  </td>
		</tr>
		<tr>
		  <th align="left" class="red">Price</th>
		  <td>
			  <ul>
				<li>must not be empty</li>
				<li>must be valid price format (eg 30 or 54.67)</li>
				<li>if it is invalid then 0 value will be inserted</li>
			  </ul>
		  </td>
		</tr>
		<tr>
		  <th align="left" class="red">Discount Price</th>
		  <td>
			  <ul>
				<li>can be empty</li>
				<li>must be valid price format (eg 30 or 54.67)</li>
				<li>must be less than price field</li>
				<li>Invalid/violate rule 3, then null value would be inserted</li>
				<li>default value is null if left blank</li>
			  </ul>
		  </td>
		</tr>
		<tr>
		  <th align="left" class="red">Attributes</th>
		  <td>
			  <ul>
				<li>can be empty</li>
				<li>must be in the form : attribute_id1 | price1 & attribute_id2 | price2</li>
				<li>attribute id must be a numeric value mentioned in the valid ids link </li>
				<li>price can be blank </li>
				<li>Two attributes must be seperated by '&' and their properties must be seperated with '|' as shown above</li>
			  </ul>
		  </td>
		</tr>
		<tr>
		  <th align="left" class="red">Accessories</th>
		  <td>
			  <ul>
				<li>can be empty</li>
				<li>must be in the form : accessory_id1 | price1 | discount_price1 & attribute_id2 | price2 | discount_price2</li>
				<li>accessory id must be a numeric value mentioned in the valid ids link </li>
				<li>price and discount price can be blank </li>
				<li>Two accessories must be seperated by '&' and their properties must be seperated with '|' as shown above</li>
			  </ul>
		  </td>
		</tr>
		</table>
	  </div>
	<?php
	if($err_msg !='')
	{
	?>
	  <div class="error" style="width:80%;"><?php echo $err_msg;?></div>
	<?php
	}
	?>
	<div style="clear:both;"></div>
    <?php echo error_message(); ?>  
    <?php echo form_open_multipart("sitepanel/products/import_products/");?>  
		<div id="tab_pinfo">
			<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
			<tr>
				<th colspan="2" align="center" > </th>
			</tr>
			<!--tr class="trOdd">
				<td width="28%" height="26" align="right" ><span class="required">*</span> File Type:</td>
				<td width="72%" align="left">
				<select name="file_type">
				  <option value="">Select</option>
				  <option value="xls" <?php echo set_value('file_type')=='xls' ? 'selected="selected"' : '';?>>Excel</option>
				  <option value="csv" <?php echo set_value('file_type')=='csv' ? 'selected="selected"' : '';?>>CSV</option>
				</select>
				<?php echo form_error('file_type');?>
				</td>
			</tr-->
			<tr class="trOdd">
				<td width="28%" height="26" align="right" ><span class="required">*</span> File :</td>
				<td align="left">
					<input type="file" name="import_file" />
					<?php echo form_error('import_file');?>
				</td>
			</tr>
            
           
        
			<tr class="trOdd">
				<td align="left">&nbsp;</td>
				<td align="left">
					<input type="hidden" name="file_type" value="xls" />
					<input type="submit" name="sub" value="Import" class="button2" />
                </td>
			</tr>
			</table>
		</div>
	<?php echo form_close(); ?>
	</div>
</div>

<?php $this->load->view('includes/footer'); ?>