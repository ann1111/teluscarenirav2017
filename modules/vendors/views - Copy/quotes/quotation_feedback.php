<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Welcome</title>
  <link href="<?php echo base_url(); ?>assets/developers/css/proj.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo theme_url();?>css/win.css" rel="stylesheet" type="text/css">
  <link href="<?php echo theme_url();?>css/conditional_win.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="assurance.ico">
</head>
<body>
  <div class="p10">
	<h1 class="bb1 pb5"><?php echo $heading_title;?></h1>
	<?php error_message();?>
	<?php echo form_open('');?>
	<div class="mt5">
	  <p class="b">Subject</p>
	  <p class="short_form mt6">
		<input name="subject" type="text" style="width:80%" value="<?php echo set_value('subject');?>" size="50">
		<?php echo form_error('subject');?>
	  </p>
	  <p class="mt10 b">Comments</p>
	  <p class="short_form mt6">
		<textarea name="comments" cols="50" rows="6" style="height:126px; width:100%"><?php echo set_value('comments');?></textarea>
		<?php echo form_error('comments');?>
	  </p>
	  <div class="cb pb5"></div>
	  <input name="btn_sbt" type="submit" value="Submit" class="btn3 radius-3 trans_eff">
	  <input name="btn_rst" type="reset" value="Reset" class="btn3x radius-3 trans_eff">
	</div>
	<?php echo form_close();?>
  </div>
</body>
</html>
