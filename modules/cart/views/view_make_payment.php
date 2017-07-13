<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<section class="mb20">
  <!--tree-->
  <div class="tree-bg mb10">
	<div class="w980">
	  <p class="tree pt3"><a href="<?php echo base_url();?>">Home</a>  » Make Payment</p>
	</div>
  </div>
  <!--tree-->

  <div class="w980">
	<h1>Make Payment</h1>
	<div class="aj mt15">

	  <!--progress bar-->
	  <div class="fs16 p5 checklink bg-brown shadow1"><a href="#" class="ml10 done"><b>2</b>Delivery Information</a> <a href="#" class="ml30 done"><b>3</b>Order Review</a> <a href="#" class="ml30 act"><b>4</b>Make Payment</a> </div>
	  <!--progress bar-->

	  <div class="mt20">
		<p class="ac b mt10 fs16">Select your payment method</p>
		<?php
		$page_content = get_db_field_value('wl_cms_pages','page_description'," AND friendly_url='payment_page' AND status='1'");
	  ?>
		<div class="fs11 tahoma mt5 ac"><?php echo $page_content;?></div>
		<?php echo form_open('payment');?>
		<div class="ac p15 w65 auto shadow1 mt30">
		  <label>
			<input type="radio" name="pay_method" id="radio" value="paypal" checked>
			<img src="<?php echo theme_url(); ?>images/mycrd1.png" alt="" class="vam mr10">
		  </label>
		  <label>
			<input type="radio" name="pay_method" id="radio2" value="cardsave">
			<img src="<?php echo theme_url(); ?>images/mycrd2.png" alt="" class="vam mr10">
		  </label>
		  <label>
			<input type="radio" name="pay_method" id="radio3" value="radio">
			<img src="<?php echo theme_url(); ?>images/mycrd6.png" alt="" class="vam mr10">
		  </label>
		  <label>
		  <label>
			<input type="radio" name="pay_method" id="radio3" value="radio">
			<img src="<?php echo theme_url(); ?>images/mycrd7.jpg" alt="" class="vam mr10">
		  </label>
		  <label>
			<input type="radio" name="pay_method" id="radio4" value="radio">
			<img src="<?php echo theme_url(); ?>images/mycrd4.png" alt="" class="vam mr10">
		  </label>
		  <label>
			<input type="radio" name="pay_method" id="radio5" value="radio">
			<img src="<?php echo theme_url(); ?>images/mycrd5.png" alt="" class="vam">
		  </label>
		  <div class="cb"></div>
		</div>
		<p class="mt20 ac">
		<input type="submit" value="Make Payment Now!" class=" button3 hand" style="padding:0px 60px; height:40px; line-height:40px; font-size:20px" name="button2">
		</p>
		<?php echo form_close();?>
	  </div>
	</div>
  </div>
</section>
<?php $this->load->view("banner/footer_banner");?>
<?php $this->load->view("bottom_application");?>