<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Welcome to Hoists Online</title>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
</head>
<body style="font-size:12px; color:#333; margin:0px; padding:0px; font-family:Arial, Helvetica, sans-serif;">
<div>
 <?php echo invoice_content($ordmaster,$orddetail);?>
  <a href="#" class="invoice print" style="color:#f00; text-decoration:none; float:left; font:bold 13px/22px Georgia, 'Times New Roman', Times, serif; text-transform:uppercase; margin:0px 10px 0 0"><img src="<?php echo theme_url();?>images/prnt.png" border="0" style="float:left; margin-right:3px" alt=""> Print Invoice</a>
</div>
<script type="text/javascript">
  $('.print').click(function(e){
	e.preventDefault();
	$(this).hide();
	window.print();
  });
</script>
</body>
</html>
