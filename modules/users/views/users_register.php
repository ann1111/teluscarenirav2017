<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
$user_register_content = get_db_field_value('wl_cms_pages','page_description',"WHERE friendly_url='user-register-content' AND status='1'");
?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Consumer Registration</strong></span></div>
  </div>
</div>

<div class="wrapper pt20 pb20" style="min-height:300px">
  <div class="bg-blue1 p25 radius-3 white">
	<p class="fr ar lht-14" style="margin-top:-7px"><b class="db mb5">Have a TelUs Care ???</b> <a href="<?php echo base_url();?>users" class="btn1 radius-3 trans_eff" title="Login Here">Login Here</a></p>
	<h1 class="fs24 white">Consumer Registration</h1>
  </div>
  <?php echo form_open('users/register'); ?> 
  <div class="fl w65 mt40 short_form fs14  bg-gray1 p20 border1 radius-5">
	<fieldset class="pb15" style="border:0; border-bottom:1px solid #f1f1f1">
	<legend class="b fs18 b mb20 blue"> Login Information :</legend>
	<div class="input_l">
	  <p class=" pt8"><label for="username">Email ID  <b class="red">*</b> :</label></p>
	  <div class="mt3">
		<input name="user_name" id="username" type="text" value="<?php echo set_value('user_name');?>" style="width:90%; padding:5px;">
		<?php echo form_error('user_name');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>

	<div class="input_r">    
	  <p class=" pt8"><label for="password">Password <b class="red">*</b> :</label></p>
	  <div class="mt3">
		<input name="password" id="password" type="password" style="width:90%; padding:5px;">
		<?php echo form_error('password');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l">
	  <p class="pt8"><label for="confirm_password">Confirm Password <b class="red">*</b> :</label></p>
	  <div class="mt3">
		<input name="confirm_password" id="confirm_password" type="password" style="width:90%; padding:5px;">
		<?php echo form_error('confirm_password');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>
	</fieldset>
	<div class="cb "></div>
	<fieldset class="pb15 mt10" style="border:0; border-bottom:1px solid #f1f1f1">
	<legend class="b fs18 b mb10 blue"> Personal Information :</legend>

	<div class="input_l">
	  <p class="pt8"><label for="name">Name <b class="red">*</b> :</label></p>
	  <div class="mt3">
		<input name="first_name" id="name" type="text" value="<?php echo set_value('first_name'); ?>" style="width:90%; padding:5px;">
		<?php echo form_error('first_name');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>

	<div class="input_r">      
	  <p class="pt8"><label for="date_of_birth">Date of Birth <b class="red">*</b> :</label></p>
	  <div class="mt3">
		<input name="birth_date" id="date_of_birth" type="text" class="dob" style="width:90%; padding:5px;">
		<?php echo form_error('birth_date');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l">      
	  <p class="pt8"><label for="mobile">Mobile No. <b class="red">*</b> :</label></p>
	  <div class="mt3">
		<input name="mobile_number" id="mobile" type="text" value="<?php echo set_value('mobile_number'); ?>" style="width:90%; padding:5px;">
		<?php echo form_error('mobile_number');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>


	<div class="input_r">
	  <p class="pt8"><label for="Landline">Landline No. :</label></p>
	  <div class="mt3">
		<input name="phone_number" id="Landline" type="text" value="<?php echo set_value('phone_number'); ?>" style="width:90%; padding:5px;">
		<?php echo form_error('phone_number');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l">      
	  <p class=" pt8"><label for="fax_number">Fax No.  :</label></p>
	  <div class="mt3">
		<input name="fax_number" id="fax_number" type="text" value="<?php echo set_value('fax_number'); ?>" style="width:90%; padding:5px;">
		<?php echo form_error('fax_number');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>


	<div class="input_r">      
	  <p class="pt8"><label for="country">Country <b class="red">*</b> :</label></p>
	  <div class="mt3">
		<?php echo CountrySelectBox(array('name'=>'country','format'=>'style="width:90%; padding:5px;"','current_selected_val'=>set_value('country') )); ?>
		<?php echo form_error('country');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l">       
	  <p class="pt8"><label for="state">State <b class="red">*</b> :</label></p>
	  <div class="mt3">
		<input name="state" id="state" type="text" value="<?php echo set_value('state'); ?>" style="width:90%; padding:5px;">
		<?php echo form_error('state');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>


	<div class="input_r">  
	  <p class="pt8"><label for="city">City <b class="red">*</b> :</label></p>
	  <div class="mt3">
		<input name="city" id="city" type="text" value="<?php echo set_value('city'); ?>" style="width:90%; padding:5px;">
		<?php echo form_error('city');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l"> 
	  <p class=" pt8"><label for="address">Address <b class="red">*</b> :</label></p>
	  <div class="mt3">
		<textarea name="address" cols="40" rows="2" id="address" style="width:90%; padding:5px;"><?php echo set_value('address'); ?></textarea>
		<?php echo form_error('address');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>

	<div class="input_r">  
	  <p class="pt8"><label for="pincode">Pin/Zip Code <b class="red">*</b> :</label></p>
	  <div class="mt3">
		<input name="zipcode" id="pincode" type="text" value="<?php echo set_value('zipcode'); ?>" style="width:90%; padding:5px;">
		<?php echo form_error('zipcode');?>
	  </div>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>
	</fieldset>
	<fieldset class="pb15 mt10" style="border:0; border-bottom:1px solid #f1f1f1">
	  <p class="w36 pt8">
		<label for="verification_code">Word Verification <b class="red">*</b> :</label>
	  </p>
	  <div class="w62">
		<input name="verification_code" id="verification_code" type="text" class="hf vam" placeholder="Enter Code" style="width:50%; padding:5px;">
		<img src="<?php echo site_url('captcha/normal/user'); ?>" width="89" height="30" class="vam" alt="" id="captchaimage"> <a href="javascript:void(0);" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/user/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();"><img src="<?php echo theme_url();?>images/ref.png" width="24" height="23" class="vam" alt=""></a>
	  <?php echo form_error('verification_code');?>
	  </div>
	  <div class="cb pb10"></div>
	  <p class="gray1 mt10 w62"> <span class="db mr30">
		<label>
		<input type="checkbox" name="terms" value="Y" class="fl mb15 mr10"<?php echo set_value('terms')=='Y' ? ' checked="checked"' : '';?>>
		I have read, understood and agree to the <br>
		<a href="<?php echo base_url();?>terms-and-conditions" class="uu" target="_blank" title="Terms &amp; Conditions">Terms &amp; Conditions</a> of <b>TelUs Care.</b></label>
		<?php echo form_error('terms');?>
	  </span></p>
	  <div class="cb pb10"></div>
	</fieldset>
	<p class="mt15 w62 osons">
	  <input name="register_me" type="submit" value="Register Now!" class="btn3 trans_eff radius-3">
	  <input name="reset" type="reset" value="Reset" class="btn3 trans_eff radius-3">
	</p>
	<div class="cb"></div>
  </div>
  <?php echo form_close();?>
  <div class="fr w32 mt65">
	<div><?php echo $user_register_content;?></div>
  </div>
  <div class="cb"></div>
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