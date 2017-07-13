<?php $this->load->view('includes/header'); ?>  
<?php
$curr_symbol = display_symbol();

$values_posted_back=(is_array($this->input->post())) ? TRUE : FALSE;

$vat_charge = ($values_posted_back===TRUE) ? $this->input->post('vat_charge') : (int) $result['vat_charge']['value'];
?>
<div id="content">  
<div class="breadcrumb"> <?php echo anchor('sitepanel/dashboard','Home'); ?>
 &raquo; <?php echo $heading_title; ?> </div>
<div class="box">
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1 style="background-image: url('<?php echo base_url(); ?>assets/admin/image/category.png');">   <?php echo $heading_title; ?></h1>
  </div>
  <div class="content">
   <?php 
  //validation_message();
   error_message();
  ?>
  <?php echo form_open('sitepanel/configuration');?>  
  <table width="70%" border="0" class="tableList" align="center">
  <tr>
	<th align="left">Item</th>
	<th align="left">Unit</th>
	<th align="left">Value</th>
	
  </tr>
  <tr class="trOdd">
	<td width="217" height="26" align="left">VAT</td>
	<td width="217" height="26" align="left">(%)</td>
	<td width="233" align="left">
	  <input type="text" name="vat_charge" size="8" value="<?php echo $vat_charge;?>">
	   <span class="errors"><?php echo form_error('vat_charge');?></span>
	</td>
  </tr>
  <tr class="trOdd" >
	<td  colspan="4"></td>
  </tr>
  <?php
  if($this->editPrvg===TRUE)
  {
  ?>
  <tr class="trOdd">
	<td colspan="4" align="left"><input type="submit" class="button2" value="Save Changes"  /></td>
  </tr>
  <?php
  }
  ?>
  </table>
  <?php echo form_close(); ?>
  </div>
</div>
</div>
<?php $this->load->view('includes/footer'); ?>