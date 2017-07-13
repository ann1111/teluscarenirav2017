<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>
<title> MOTOR INSURANCE </title>
<?php echo form_open('/motorinsurance/book_view'); ?> 

<?php foreach($status as $message){  echo $message; }  ?>
<div class="w90 auto mt30">
	<p class="fr mt1"><a href="/motorinsurance" class="btn1 radius-20t" title="?Go Back">Go Back</a> </p>
	
<h2 class="bb1 pb5">Make Payment</h2>  

 <div class="cb mb15"></div>
 
	<input type="hidden" name ="book_customer" value="Customer" />
	
	  <div class="fl w32 short_form ml16">
		
		<p class="mt6">
		QuikPay	<input type="radio" name="pg" />
		 </p>
	  </div> 
	  <div class="fl w32 short_form ml16">
		
		<p class="mt6">
		Credit/ Debit Card	<input type="radio" name="pg" />
		 </p>
	  </div>
	  <div class="fl w32 short_form ml16">
		
		<p class="mt6">
		Credit Card EMI	<input type="radio" name="pg" />
		 </p>
	  </div>
	  <div class="fl w32 short_form ml16">
		
		<p class="mt6">
		Cash On Delivery New	<input type="radio" name="pg" />
		 </p>
	  </div>
	  
	  <div class="fl w32 short_form ml16">
		
		<p class="mt6">
		Net Banking	<input type="radio" name="pg" />
		 </p>
	  </div>
	  
	  <div class="fl w32 short_form ml16">
		
		<p class="mt6">
		PayPal	<input type="radio" name="pg" />
		 </p>
	  </div>
	  
	<div class="cb mb15"></div>
	<input type="submit" class="btn3 radius-3 trans_eff" value="MAKE PAYMENT" />

<div class="cb mb15"></div>

</div>

<?php echo form_close(); ?>

<?php $this->load->view("bottom_application");?>