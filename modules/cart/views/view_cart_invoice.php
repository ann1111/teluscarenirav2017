<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
$page_content = get_db_field_value('wl_cms_pages','page_description'," WHERE friendly_url='payment_page' AND status='1'");
?>
<div class="tree minmax">
  <div class="wrapper"> YOUR ARE HERE : 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title"><img src="<?php echo theme_url();?>images/hm.png" class="vam pb3" alt=""></span></a></div>   
	<b>&gt;</b> 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong>Invoice / Payment</strong></span></div>
  </div>
</div>


<!-- MIDDLE STARTS -->

<section class="minmax mid_shed">
  <div class="wrapper pt30">
	<h1>Invoice / <b>Payment</b></h1>

	<div class="p10 fs16 checklink"> <a href="javascript:void(0);" class="done"><b>1</b>User Login</a> <a href="javascript:void(0);" class="ml20 done"><b>2</b>Delivery Information</a> <a href="javascript:void(0);" class="ml20 act"><b>3</b>Order Review / Payment</a> </div>
	<div class="cb"></div>

	<div class="p25 border1 mt10">
	 <?php echo invoice_content($ordmaster,$orddetail);?> 
	</div>
	<!-- invoice ends / payment starts -->
	<p class="ac fs30 ttu red mt30">Make 100% Safe Payment</p>
	<h3 class="ac mt10">Select a payment method</h3>
	<p class="fs11 tahoma mt5 ac b"><?php echo $page_content;?></p>
	<?php echo form_open('payment');?>
	<div class="ac p15 w80 auto border2 mt30">
	  <label>
		<input type="radio" name="pay_method" id="radio" value="paypal" checked>
		<img src="<?php echo theme_url();?>images/mycrd1.png" alt="" class="vam mr10">
	  </label>
	  <label>
		<input type="radio" name="pay_method" id="radio2" value="paypal">
		<img src="<?php echo theme_url();?>images/mycrd2.png" alt="" class="vam mr10">
	  </label>
	  <label>
		<input type="radio" name="pay_method" id="radio4" value="paypal">
		<img src="<?php echo theme_url();?>images/mycrd4.png" alt="" class="vam mr10">
	  </label>
	  <label>
		<input type="radio" name="pay_method" id="radio5" value="paypal">
		<img src="<?php echo theme_url();?>images/mycrd5.png" alt="" class="vam">
	  </label>
	  <div class="cb"></div>
	</div>
	<p class="mt20 ac">
	  <input type="submit" value="Make Payment Now!" class="btn1 radius-3 shadow1" style="padding:0px 60px; height:40px; line-height:40px; font-size:20px" name="button2">
	</p>
	<?php echo form_close();?>
	<div class="cb pb50"></div>
  </div>
</section>
<?php $this->load->view("bottom_application");?>