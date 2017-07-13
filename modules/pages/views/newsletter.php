<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Welcome</title>
  <link href="<?php echo base_url(); ?>assets/developers/css/proj.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo theme_url();?>css/win.css" type="text/css" rel="stylesheet">
  <link href="<?php echo theme_url();?>css/conditional_win.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="p10 pl15 pr15">
	<h2 class="fs18">Newsletter</h2>
	<?php error_message();?>
	<?php echo form_open('');?> 
	<p class="mt8">
	  <input name="subscriber_name" id="name" type="text" placeholder="Name *" class="p8 w100 radius-3">
	  <?php echo form_error('subscriber_name');?>
	</p>
	<p class="mt8">
	  <input name="subscriber_email" id="email" type="text" placeholder="Email ID *" class="p8 w100 radius-3">
	  <?php echo form_error('subscriber_email');?>
	</p>
	<p class="mt10 fl">
	  <input name="verification_code" id="verification_code" type="text" class="p8 radius-3" style="width:120px" placeholder="Enter Code *">
	</p>
	<p class="mt15 fl ml10"><img src="<?php echo site_url('captcha/normal/newsletter'); ?>" class="vam" alt="" title="" id="captchaimage1"> &nbsp; <a href="javascript:void(0);" onclick="document.getElementById('captchaimage1').src='<?php echo site_url('captcha/normal'); ?>/newsletter/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code1').focus();"><img src="<?php echo theme_url();?>images/ref.png" class="vam" alt="Refresh" title="Refresh" ></a></p>
	<div class="cb"></div>
	<?php echo form_error('verification_code');?>
	<div class="cb"></div>
	<p class="mt15">
	  <input name="subscribe_me" type="submit" value="Subscribe" class="btn1 trans_eff radius-3">
	  <input name="subscribe_me" type="submit" value="Unsubscribe" class="btn1 trans_eff radius-3">
	</p>
	<?php echo form_close();?>
  </div>
</body>
</html>