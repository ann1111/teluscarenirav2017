<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Welcome to RJ Group</title>
<link href="<?php echo theme_url(); ?>css/ak.css" rel="stylesheet" type="text/css" />
<style type="text/css" media="screen">
<!--
@import url("<?php echo base_url();?>assets/fancybox/jquery.fancybox-1.3.0.css");
@import url("<?php echo base_url();?>assets/ddlevelsfiles/ddlevelsmenu-base.css");
-->
</style>
</head>
<body style="font-size:12px; color:#fff; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif; background:#fff;">
<div style="width:800px; background:#f4f4f4;">
 <?php echo invoice_content($ordmaster,$orddetail);?>
</div>
</body>
</html>
