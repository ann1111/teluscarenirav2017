<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>members" itemprop="url"><span itemprop="title">My Account</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Edit Account</strong></span></div>
  </div>
</div>
<div class="wrapper pt20 pb20" style="min-height:300px;">
  <?php $this->load->view('members/top_links');?>
  <div class="w90 auto mt30">
	<h2 class="bb1 pb5">Edit Account</h2>
	<?php error_message();?>
	<?php echo form_open(''); ?>
	<div class="mt40 w80 short_form fs14 auto bg-gray1 p20 border1">
	  <fieldset class="pb15 mt30" style="border:0;">
		<p class="w36 pt8">
		  <label for="name">Name <b class="red">*</b> :</label>
		</p>
		<div class="w62">
		  <input name="first_name" id="name" type="text" value="<?php echo set_value('first_name',$mres['first_name']); ?>">
		  <?php echo form_error('first_name');?>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
		  <label for="date_of_birth">Date of Birth <b class="red">*</b> :</label>
		</p>
		<div class="w62">
		  <input name="birth_date" id="date_of_birth" type="text" class="dob" value="<?php echo set_value('birth_date',$mres['birth_date']); ?>">
		  <?php echo form_error('birth_date');?>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
		  <label for="mobile">Mobile No. <b class="red">*</b> :</label>
		</p>
		<div class="w62">
		  <input name="mobile_number" id="mobile" type="text" value="<?php echo set_value('mobile_number',$mres['mobile_number']); ?>">
		  <?php echo form_error('mobile_number');?>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
		  <label for="landline">Landline No.  :</label>
		</p>
		<div class="w62">
		  <input name="phone_number" id="landline" type="text" value="<?php echo set_value('phone_number',$mres['phone_number']); ?>">
		  <?php echo form_error('phone_number');?>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
		  <label for="fax_number">Fax No.  :</label>
		</p>
		<div class="w62">
		  <input name="fax_number" id="fax_number" type="text" value="<?php echo set_value('fax_number',$mres['fax_number']); ?>">
		  <?php echo form_error('fax_number');?>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
		  <label for="country">Country <b class="red">*</b> :</label>
		</p>
		<div class="w62">
		  <?php echo CountrySelectBox(array('name'=>'country','format'=>'','current_selected_val'=>set_value('country',$mres['country']) )); ?>
		  <?php echo form_error('country');?>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
		  <label for="state">State <b class="red">*</b> :</label>
		</p>
		<div class="w62">
		  <input name="state" id="state" type="text" value="<?php echo set_value('state',$mres['state']); ?>">
		  <?php echo form_error('state');?>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
		  <label for="City">City <b class="red">*</b> :</label>
		</p>
		<div class="w62">
		  <input name="city" id="city" type="text" value="<?php echo set_value('city',$mres['city']); ?>">
		  <?php echo form_error('city');?>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
		  <label for="address">Address <b class="red">*</b> :</label>
		</p>
		<div class="w62">
		  <textarea name="address" cols="40" rows="2" id="address"><?php echo set_value('address',$mres['address']); ?></textarea>
		  <?php echo form_error('address');?>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
		  <label for="pincode">Pin/Zip Code <b class="red">*</b> :</label>
		</p>
		<div class="w62">
		  <input name="zipcode" id="pincode" type="text" value="<?php echo set_value('zipcode',$mres['zipcode']); ?>">
		  <?php echo form_error('zipcode');?>
		</div>
		<div class="cb pb10"></div>
	  </fieldset>
	  <p class="w62 osons">
		<input name="edt_btn" type="submit" value="Update Now!" class="btn3 trans_eff radius-3">
		<input name="reset" type="reset" value="Reset" class="btn3x trans_eff radius-3">
	  </p>
	  <div class="cb"></div>
	</div>
	<?php echo form_close();?>
	<div class="cb pb30"></div>
  </div>
  <script type="text/javascript" src="<?php echo base_url();?>assets/developers/js/ui/jquery-ui-1.8.16.custom.min.js"></script>
  <link type="text/css" href="<?php echo base_url();?>assets/developers/js/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
  <script type="text/javascript">
	
	jQuery(document).ready(function($){
	  if($('.dob').length){
		$( ".dob").attr("readonly","readonly").datepicker({
		  showOn: "focus",
		  //buttonImage: '',
		  dateFormat: 'yy-mm-dd',
		  changeMonth: true,
		  changeYear: true,
		  defaultDate: 'y',
		  buttonText:'',
		  minDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d')."-75 years"));?>',
		  maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d')."-18 years"));?>',
		  yearRange: "c-100:c+100",
		  buttonImageOnly: true
		});
	  }
	});
  </script>
</div>
<?php $this->load->view("bottom_application");?>