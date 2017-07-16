<?php $this->load->model('pages/pages_model');?>
<?php $this->load->helper(array('category/category','cookie'));?>
<?php $this->load->model(array('products/product_model'));?>
<?php $this->load->library(array('Auth','session'));?>
<?php
$header_cat_qry = $this->db->select('category_name,friendly_url,category_alt,category_id')->limit(5)->get_where('wl_categories',array('parent_id'=>'0','status'=>'1'));
$root_cat_count = $header_cat_qry->num_rows();

//Products
$condtion_array = array(
				'fields'=>'DISTINCT(country) as country',
				'where'=>"a.user_status ='1' AND a.status ='1' AND c.status ='1'",
				'debug'=>FALSE
			  );

$condtion_array['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=a.mem_id");

$country_res              =  $this->product_model->get_products($condtion_array);
//trace($country_res);
?>
<?php
  /* if($this->uri->uri_string == '')
  { */
	 /*  echo '<pre>';
	  //print_r($this->session->all_userdata()); exit;
	  print_r($this->session->userdata('first_name')); exit;  */
  ?>
  <?php
 

 $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

  //if (strpos($url,'vendors') === false) {
    
  ?>
<header>
	<nav id="topNav" class="navbar navbar-default navbar-fixed-top">
		<!--Start desktop & tablet View -->
        <div class="container-fluid hidden-xs">
			<div class="col-lg-2 col-sm-3 col-md-2">
					<!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button> -->
				<a class="navbar-brand page-scroll" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/newasset/image/assurance.png"/></a>
			</div>
			<div class="col-lg-2 col-sm-3 col-md-3">
				<div class="center-nav">
					<span style="font-size:21px;margin-right:5px;" class="ion-ios-clock"></span> <span id="clockbox">  </span> <span id="time_string">  </span>
				</div>
			</div>
			<div class="col-lg-3 col-sm-3 col-md-3">
				<div class="center-nav">
					<span style="font-size:21px;margin-right:5px;" class="ion-social-whatsapp"></span> <span> <small>UAE</small>  +971 52 2188 228</span>
				</div>
			</div>
			<div class="col-lg-4 col-sm-3 col-md-3">
			<?php if( !$this->auth->is_user_logged_in() ) { ?>
				<div class="center-nav">
					<a class="page-scroll" data-toggle="modal" title="Login" href="#loginModal"><span style="font-size:21px;" class="ion-locked"></span>  Login</a>    <!-- ion-unlocked -->
				</div>
			<?php }else{ if($this->session->userdata('userType')==1){
					//$base_url = base_url().'members/myaccount';
					$base_url = base_url().'consumer-dashboard';					
					$acc_link = "<a href=".$base_url." >".strtoupper($this->session->userdata('first_name'))."</a>";
				}else{
					//$base_url = base_url().'vendors/myaccount'; 
					$base_url = base_url().'seller-dashboard';  
					$acc_link = "<a href=".$base_url." >".strtoupper($this->session->userdata('first_name'))."</a>";
				}
			 ?>
				<div class="center-nav">
					 <span style="font-weight:700;"><?php echo $acc_link; ?></span> &nbsp; <a title="LogOut" href="<?php echo base_url(); ?>users/logout"><span style="font-size:21px;" class="ion-locked"></span>  LogOut</a>    <!-- ion-unlocked -->
				</div>
			<?php } ?>
			</div>
		</div>
		<!--End desktop & tablet View -->
		
		<!--Start Mobile View -->
		<div class="container-fluid visible-xs" style="padding:0;">
			<div class="col-xs-12">
				<div class="mobile_nav_tt">
					<span style="font-size:21px;margin-right:5px;" class="ion-ios-clock"></span> <span id="clockbox1">  </span> <span id="time_string1">  </span>
				</div>
			</div>
			<div class="col-xs-4">
					<!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button> -->
				<a class="navbar-brand page-scroll" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/newasset/image/assurance.png"/></a>
			</div>
			<div class="col-xs-8 mobile_nav_tt" >
				<div class="" style="text-align:left;">
					<span style="font-size:18px;margin-right:5px;" class="ion-social-whatsapp"></span> <span> <small>UAE</small> +971 52 2188 228</span>
				</div>
				<?php if( !$this->auth->is_user_logged_in() ) { ?>
				<div class="">
					<a class="page-scroll" data-toggle="modal" title="Login" href="#loginModal"><span style="font-size:18px;" class="ion-locked"></span>  Login</a>    <!-- ion-unlocked -->
				</div>
			<?php }else{ if($this->session->userdata('userType')==1){
					//$base_url = base_url().'members/myaccount';
					$base_url = base_url().'consumer-dashboard';					
					$acc_link = "<a href=".$base_url." >".strtoupper($this->session->userdata('first_name'))."</a>";
				}else{
					//$base_url = base_url().'vendors/myaccount'; 
					$base_url = base_url().'seller-dashboard';  
					$acc_link = "<a href=".$base_url." >".strtoupper($this->session->userdata('first_name'))."</a>";
				}
			 ?>
				<div class="">
					Welcome <span style="font-weight:700;font-size:16px;"><?php echo $acc_link; ?></span> &nbsp; <a title="LogOut" href="<?php echo base_url(); ?>users/logout"><span style="font-size:18px;" class="ion-locked"></span>  LogOut</a>    <!-- ion-unlocked -->
				</div>
			<?php } ?>
			</div>
			
			
		</div>
		
		<!--End Mobile View -->
    </nav>
		<script>
			$(document).ready(function(){     
			var h_path = window.location.pathname;
			 if(h_path != '/'){ 
				$('#topNav').css('background-color', '#2BBBAD');
			 }			
		   var scroll_start = 0;
		   var startchange = $('#topNav');
		   var offset = startchange.offset();
		   $(document).scroll(function() { 
			  scroll_start = $(this).scrollTop();
			   if(scroll_start > offset.top) {
				  $('#topNav').css('background-color', '#2BBBAD');
			   } else {
				    if(h_path == '/'){  $('#topNav').css('background-color', 'transparent'); }else{
				  $('#topNav').css('background-color', '#2BBBAD'); }
			   }
		   });
		});
	</script>
 
  
  <div class="top_space"></div>
</header>
  <?php // } ?>
 
	
	 
	
	
	<!-- TOP 2 ENDS --> 
 
