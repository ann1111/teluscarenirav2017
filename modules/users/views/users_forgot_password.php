<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Welcome</title>
  <link href="<?php echo base_url(); ?>assets/developers/css/proj.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo theme_url();?>css/win.css" type="text/css" rel="stylesheet">
  <link href="<?php echo theme_url();?>css/conditional_win.css" rel="stylesheet" type="text/css">
</head>
<div class="p10 pl15 pr15">
  <h2 class="fs18">Password Help</h2>
  <?php error_message();?>
  <?php echo form_open('users/forgotten_password/');?> 
  <div class="mt8">
	<input name="email" id="email" type="text" value="<?php echo set_value('email');?>" placeholder="Enter Your Email ID *" class="p8 w100 radius-3">
	<?php echo form_error('email');?>
  </div>
  <div class="mt10 fl">
	<input name="verification_code" id="verification_code" type="text" class="p8 radius-3" style="width:120px" placeholder="Enter Code *">
	 <?php echo form_error('verification_code');?>
  </div>
  <p class="mt15 fl ml10"><img src="<?php echo site_url('captcha/normal'); ?>" class="vam" alt="" title="" id="captchaimage"> &nbsp; <a href="javascript:void(0);" title="Change Verification Code" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" ><img src="<?php echo theme_url();?>images/ref.png" class="vam" alt="" title="" ></a></p>
 
  <div class="cb"></div>
  <p class="mt15">
	<input type="hidden" name="forgotme" value="yes" />
	<input name="input" type="submit" value="Submit" class="btn1 trans_eff radius-3">
  </p>
  <?php echo form_close();?>
</div>
</body>
</html>