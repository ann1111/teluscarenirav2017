<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Welcome</title>
  <link href="<?php echo base_url(); ?>assets/developers/css/proj.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo theme_url();?>css/win.css" type="text/css" rel="stylesheet">
</head>
<body style="border:0" class="bg-white">
  <div class="p10 arial">
	<h3 class="bb pb3">Refer to Friend</h3>
	<?php echo error_message(); ?>
	<?php echo  form_open(''); ?>  
	<div class="mt18">
	  <input name="your_name" id="name" type="text" value="<?php echo set_value('your_name');?>" style="width:360px;" placeholder="Your Name *" class="p6">
	  <?php echo form_error('your_name');?>
	  <p class="mt10">
		<input name="your_email" id="email" type="text" value="<?php echo set_value('your_email');?>" style="width:360px;" placeholder="Your Email ID *" class="p6">
		<?php echo form_error('your_email');?>
	  </p>
	  <p class="mt10">
		<input name="friend_name" id="friend_name" type="text" value="<?php echo set_value('friend_name');?>" style="width:360px;" placeholder="Friend's Name *" class="p6">
		<?php echo form_error('friend_name');?>
	  </p>
	  <p class="mt10">
		<input name="friend_email" id="friend_email" type="text" value="<?php echo set_value('friend_email');?>" style="width:360px;" placeholder="Friend's Email ID *" class="p6">
		<?php echo form_error('friend_email');?>
	  </p>
	</div>
	<p class="mt10 fl">
	  <input name="verification_code" id="verification_code1" type="text" class="p6" style="width:200px" placeholder="Word Verification *">
	</p>
	<p class="mt15 fl"><img src="<?php echo site_url('captcha/normal/refer'); ?>" class="vam" alt="" id="captchaimage1"> &nbsp; <a href="javascript:void(0);" onclick="document.getElementById('captchaimage1').src='<?php echo site_url('captcha/normal'); ?>/refer/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code1').focus();"><img src="<?php echo theme_url();?>images/ref.png" class="vam" alt="Refresh"></a></p>
	<div class="cb"></div>
	<?php echo form_error('verification_code');?>
	<div class="cb"></div>
	<p class="mt10">
	  <input name="input" type="submit" value="Submit" class="btn2 shadow1 radius-3">
	</p>
	<?php echo form_close();?>
  </div>
</body>
</html>