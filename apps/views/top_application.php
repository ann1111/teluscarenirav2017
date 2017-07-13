<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
$meta_rec = $this->meta_info;  

if( is_array($meta_rec) && !empty($meta_rec) )
{	
?>

<title>TelUs Care<?php //echo $meta_rec['meta_title'];?></title>
<meta name="description" content="<?php echo $meta_rec['meta_description'];?>" />
<meta  name="keywords" content="<?php echo $meta_rec['meta_keyword'];?>" />

<?php
}
?>
<?php
if($this->is404 === TRUE)
{
?>
  <meta name="googlebot" content="noindex">
<?php
}
?> 
<?php
  $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  if (strpos($url,'vendors') === true) {
	  echo 'yes'; exit;
	?>
	
  <?php } ?>
	<!-- New CSS -->
	<link href="<?php echo theme_url(); ?>css/win.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo theme_url(); ?>css/conditional_win.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/newasset/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newasset/css/animate.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newasset/css/ionicons.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/newasset/css/styles.css" />
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">-->
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>assets/newasset/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/newasset/js/date-time.js"></script>
	<script src="<?php echo base_url(); ?>assets/newasset/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/newasset/js/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/newasset/js/wow.js"></script>
	<script src="<?php echo base_url(); ?>assets/newasset/js/common.js"></script>
    <script src="<?php echo base_url(); ?>assets/newasset/js/scripts.js"></script>
	
	<script type="text/javascript" > var site_url = '<?php echo base_url();?>';</script>
	<script type="text/javascript" > var theme_url = '<?php echo theme_url();?>';</script>
	<script type="text/javascript" > var resource_url = '<?php echo resource_url(); ?>';</script>
	
	<!--- ajaxForm & ajaxSubmit -->
    <script src="<?php echo base_url(); ?>assets/newasset/js/jquery.form.js"></script>
	
	<!--- Bootstrap Form Validator -->
    <script src="<?php echo base_url(); ?>assets/newasset/js/validator.js"></script>
	
	<!--- COOKIE LOCAL STORAGE -->
	<script src="<?php echo base_url(); ?>assets/newasset/js/halma-localstorage.js"></script>
	 
	<!--- bootstrap date Picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/newasset/js/datepicker/datepicker.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/newasset/js/datepicker/datepicker3.min.css" />
	<script src="<?php echo base_url(); ?>assets/newasset/js/datepicker/bootstrap-datepicker.min.js"></script>

	
	<link href='http://fonts.googleapis.com/css?family=Monoton' rel='stylesheet' type='text/css'>
	
<!--- NEW CSS END -->
  <?php //}else{   ?>

<!-- OLD CSS START -->

<!-- <link href="<?php echo base_url(); ?>assets/developers/css/proj.css" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/ico" href="<?php echo base_url();?>assurance.ico"/>
<script type="text/javascript" > var site_url = '<?php echo base_url();?>';</script>
<script type="text/javascript" > var theme_url = '<?php echo theme_url();?>';</script>
<script type="text/javascript" > var resource_url = '<?php echo resource_url(); ?>'; var gObj = {currdate:new Date()/*'<?php echo date("l F d, Y H:i:s",strtotime("-2 hours 37 minutes"));?>'*/}</script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/developers/js/common.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/developers/js/timezone.js"></script>
<link href="<?php echo theme_url(); ?>css/win.css" rel="stylesheet" type="text/css" />
<link href="<?php echo theme_url(); ?>css/conditional_win.css" rel="stylesheet" type="text/css" />
<style type="text/css">
@import url("<?php echo resource_url(); ?>fancybox/jquery.fancybox.css");
@import url("<?php echo theme_url();?>css/fluid_dg.css");
</style> -->
<!-- OLD CSS END -->


<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
  <?php //} ?>

<?php if ( $this->config->item('analytics_id')!="" )
{
	 ?>     
	<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', '<?php echo $this->config->item('analytics_id');?>']);
    _gaq.push(['_trackPageview']);
    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    </script> 
        
 <?php
 }
 ?>
</head>
<body>
<noscript>
	<div style="height:30px;border:3px solid #6699ff;text-align:center;font-weight: bold;padding-top:10px">
		Java script is disabled , please enable your browser java script first.
	</div>
</noscript>