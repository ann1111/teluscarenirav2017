<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
 $values_posted_back=(is_array($this->input->post())) ? TRUE : FALSE; 
 $is_same = $values_posted_back === TRUE ? $this->input->post('is_same') : ''; 

$billing_country = set_value('billing_country',$mres['billing_country']);

$billing_state = set_value('billing_state',$mres['billing_state']);


$shipping_country = set_value('shipping_country',$mres['shipping_country']);

$shipping_state = set_value('shipping_state',$mres['shipping_state']);

$us_states           =  $this->product_model->get_shipping_methods();
?>
<div class="tree minmax">
  <div class="wrapper"> YOUR ARE HERE : 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title"><img src="<?php echo theme_url();?>images/hm.png" class="vam pb3" alt=""></span></a></div>   
	<b>&gt;</b> 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>cart" itemprop="url"><span itemprop="title">Shopping Cart</span></a></div>  
	<b>&gt;</b> 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong>Checkout</strong></span></div>
  </div>
</div>

<!-- MIDDLE STARTS -->

<section class="minmax mid_shed">
  <div class="wrapper pt30">
	<h1>Checkout</h1>
	<div class="p10 fs16 checklink"> 
	<?php
	if($this->userId==0)
	{
	?>
	<a href="<?php echo base_url();?>users?ref=cart/checkout" class="done"><b>1</b>User Login</a>
	<?php
	}
	else
	{
	?>
	  <a href="javascript:void(0);" class="done"><b>1</b>User Login</a>
	<?php
	}
	?>
	 <a href="javascript:void(0);" class="ml20 act"><b>2</b>Delivery Information</a> <a href="javascript:void(0);" class="ml20"><b>3</b>Order Review / Payment</a> </div>
	<div class="cb"></div>
	<div class="fl w56 mt7">
	  <div class="border1 p20 pl30 mr10 checkout_box">
	  <?php echo form_open(''); ?>
	  <h3>Personal Information</h3>
	  <p class="mt10">
		<label for="name"> Name <b class="red">*</b></label>
	  </p>
	  <p class="mt7">
		<input name="first_name" id="name" type="text" value="<?php echo set_value('first_name',$mres['first_name']); ?>" class="p9" placeholder="Vinay">
		<?php echo form_error('first_name');?>
	  </p>
	  <p class="mt15">
		<label for="mobile_number">Mobile Number <b class="red">*</b></label>
	  </p>
	  <p class="mt7">
		<input name="mobile_number" id="mobile_number" type="text" value="<?php echo set_value('mobile_number',$mres['mobile_number']); ?>" class="p9" placeholder="9876543212">
		<?php echo form_error('mobile_number');?>
	  </p>
	  <p class="mt15">
		<label for="email">Email <b class="red">*</b></label>
	  </p>
	  <p class="mt7">
		<input name="email" id="email" type="text" value="<?php echo set_value('email',$mres['email']); ?>" class="p9">
		<?php echo form_error('email');?>
	  </p>
	  <br>
	  <br>
	  <h3>Billing Information</h3>
	  <div class="pt5">
		<p class="mt15">
		  <label for="billing_name">Name <b class="red">*</b></label>
		</p>
		<p class="mt7">
		  <input name="billing_name" id="billing_name"  type="text" value="<?php echo set_value('billing_name',$mres['billing_name']); ?>" class="p9">
		  <?php echo form_error('billing_name');?>
		</p>
		<p class="mt15">
		  <label for="billing_address">Address <b class="red">*</b></label>
		</p>
		<p class="mt7">
		  <input name="billing_address" id="billing_address" type="text" value="<?php echo set_value('billing_address',$mres['billing_address']); ?>" class="p9">
		  <?php echo form_error('billing_address');?>
		</p>
		<p class="mt15">
		  <label for="billing_mobile">Mobile No. <b class="red">*</b></label>
		</p>
		<p class="mt7">
		  <input name="billing_mobile" id="billing_mobile" type="text" value="<?php echo set_value('billing_mobile',$mres['billing_mobile']); ?>" class="p9">
		  <?php echo form_error('billing_mobile');?>
		</p>
		<p class="mt15">
		  <label for="billing_city">City <b class="red">*</b></label>
		</p>
		<p class="mt7">
		  <input name="billing_city" id="billing_city" type="text" value="<?php echo set_value('billing_city',$mres['billing_city']); ?>" class="p9">
		  <?php echo form_error('billing_city');?>
		</p>
		<p class="mt15">
		  <label for="billing_country">Country <b class="red">*</b></label>
		</p>
		<p class="mt7">
		  <?php echo CountrySelectBox(array('name'=>'billing_country','format'=>'class="p9" ','current_selected_val'=>$billing_country )); ?>
		  <?php echo form_error('billing_country');?>
		</p>
		<p class="mt15">
		  <label for="billing_state">State <b class="red">*</b></label>
		</p>
		<p class="mt7">
		  <div id="billing_state_box">
			<?php
			if($billing_country !='United States')
			{
			?>
			<input name="billing_state" id="billing_state" type="text" value="<?php echo set_value('billing_state',$mres['billing_state']); ?>" class="p9">
			<?php
			}
			else
			{
			?>
			  <select name="billing_state" id="billing_state" class="p9">
			  <option value="">Select</option>
			  <?php
			  if(is_array($us_states) && !empty($us_states))
			  {
				foreach($us_states as $val)
				{
				?>
				  <option value="<?php echo $val['shipping_type'];?>"<?php echo $val['shipping_type']==$billing_state ? ' selected="selected"' : '';?>><?php echo $val['shipping_type'];?></option>
				<?php
				}
			  }
			  ?>
			  </select>
			<?php
			}
			?>
		  </div>
		  <?php echo form_error('billing_state');?>
		</p>
		
		<p class="mt15">
		  <label for="billing_pin_code">Pin/Zip Code <b class="red">*</b></label>
		</p>
		<p class="mt7">
		  <input name="billing_zipcode" id="billing_pin_code" type="text" value="<?php echo set_value('billing_zipcode',$mres['billing_zipcode']); ?>" class="p9">
		  <?php echo form_error('billing_zipcode');?>
		</p>
	  </div>
	  <?php
	 $values_posted_back=(is_array($this->input->post())) ? TRUE : FALSE; 
	 $is_same = $values_posted_back === TRUE ? $this->input->post('is_same') : ''; 
	?>
	  <h3 class="mt30">Shipping Information</h3>
	  <div class="pt5">
		<p class="red tahoma fs11 b">
		  <label><input name="is_same" type="checkbox" value="Y" class="fl mr5 mt3 ckblsp" <?php echo $is_same=='Y' ? ' checked="checked"' : '';?>>Shipping Information is same as Billing Information</label>
		</p>
		<div id="ship_container" style="display:<?php echo $is_same=='Y' ? 'none' : 'block';?>">
		  <p class="mt15">
			<label for="shipping_name">Name <b class="red">*</b></label>
		  </p>
		  <p class="mt7">
			<input name="shipping_name" id="shipping_name" type="text" value="<?php echo set_value('shipping_name',$mres['shipping_name']); ?>" class="p9">
			<?php echo form_error('shipping_name');?>
		  </p>
		  <p class="mt15">
			<label for="shipping_address">Address <b class="red">*</b></label>
		  </p>
		  <p class="mt7">
			<input name="shipping_address" id="shipping_address" type="text" value="<?php echo set_value('shipping_address',$mres['shipping_address']); ?>" class="p9">
			<?php echo form_error('shipping_address');?>
		  </p>
		  <p class="mt15">
			<label for="shipping_mobile">Mobile No. <b class="red">*</b></label>
		  </p>
		  <p class="mt7">
			<input name="shipping_mobile" id="shipping_mobile" type="text" value="<?php echo set_value('shipping_mobile',$mres['shipping_mobile']); ?>" class="p9">
			<?php echo form_error('shipping_mobile');?>
		  </p>
		  <p class="mt15">
			<label for="shipping_city">City <b class="red">*</b></label>
		  </p>
		  <p class="mt7">
			<input name="shipping_city" id="shipping_city" type="text" value="<?php echo set_value('shipping_city',$mres['shipping_city']); ?>" class="p9">
			<?php echo form_error('shipping_city');?>
		  </p>
		  <p class="mt15">
			<label for="shipping_country">Country <b class="red">*</b></label>
		  </p>
		  <p class="mt7">
			<?php echo CountrySelectBox(array('name'=>'shipping_country','format'=>'class="p9" ','current_selected_val'=>set_value('shipping_country',$mres['shipping_country']) )); ?>
			<?php echo form_error('shipping_country');?>
		  </p>
		  <p class="mt15">
			<label for="shipping_state">State <b class="red">*</b></label>
		  </p>
		  <p class="mt7">
			<div id="shipping_state_box">
			<?php
			if($shipping_country !='United States')
			{
			?>
			<input name="shipping_state" id="shipping_state" type="text" value="<?php echo set_value('shipping_state',$mres['shipping_state']); ?>" class="p9">
			<?php
			}
			else
			{
			?>
			  <select name="shipping_state" id="shipping_state" class="p9">
			  <option value="">Select</option>
			  <?php
			  if(is_array($us_states) && !empty($us_states))
			  {
				foreach($us_states as $val)
				{
				?>
				  <option value="<?php echo $val['shipping_type'];?>"<?php echo $val['shipping_type']==$shipping_state ? ' selected="selected"' : '';?>><?php echo $val['shipping_type'];?></option>
				<?php
				}
			  }
			  ?>
			  </select>
			<?php
			}
			?>
			</div>
			<?php echo form_error('shipping_state');?>
		  </p>
		  
		  <p class="mt15">
			<label for="shipping_pin_code">Pin/Zip Code <b class="red">*</b></label>
		  </p>
		  <p class="mt7">
			<input name="shipping_zipcode" id="shipping_pin_code" type="text" value="<?php echo set_value('shipping_zipcode',$mres['shipping_zipcode']); ?>" class="p9">
			<?php echo form_error('shipping_zipcode');?>
		  </p>
		</div>
	  </div>
	  <div class="mt25 mr18"></div>
	  <div class="mt25">
		<input name="verification_code" id="verification_code" type="text" placeholder="Word Verification *" class="vam p5" style="width:120px">
		<img src="<?php echo site_url('captcha/normal/checkout'); ?>" alt="" class="vam" id="captchaimage"> <a href="javascript:void(0);" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/user/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();"><img src="<?php echo theme_url();?>images/ref.png" alt="Refresh" class="vam ml10"></a>
	  </div>
	  <div class="mt25 mr18"></div>
	  <?php echo form_error('verification_code');?>
	  <div class="bb2 mt25 mr18"></div>
	  <p class="mt25">
		<input name="edt_btn" type="submit" value="Update Now" class="btn2 radius-3">
		<input name="rst_btn" type="reset" value="Reset" class="btn3 radius-3">
	  </p>
	  <?php echo form_close();?>
	  </div>
	</div>
	<!-- left section ends -->
	<div class="fr w40 p20 border1 mt7">
	  <div id="cart_container"></div>
	</div>
	<!-- right section ends -->
	<div class="cb"></div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready(function(){
	<?php
	if(is_array($us_states) && !empty($us_states))
	{
	  $us_states_arr = "var us_states = [";
	  foreach($us_states as $val)
	  {
		$us_states_arr .= "'".$val['shipping_type']."',";
	  }
	  $us_states_arr = trim($us_states_arr,',');
	  $us_states_arr .= "];";
	}
	else
	{
	  $us_states_arr = "var us_states = [];";
	}
	echo $us_states_arr;
	?>

	$('#shipping_country,#billing_country').bind('change',function(){
	  evt_obj = $(this);
	  state_box = evt_obj.attr('id').replace(/(shipping|billing)_country/,"$1");
	  
	  state_box_obj = state_box+"_state_box";
	  state_box_name = state_box+"_state";
	  
	  if(evt_obj.val()!='United States'){
		state_str = '<input name="'+state_box_name+'" type="text" value="" class="p9">';
		
	  }else{
		state_str = '<select name="'+state_box_name+'" id="'+state_box_name+'" class="p9"><option value="">Select</option>';
		for(var xc in us_states){
		  state_str += '<option value="'+us_states[xc]+'">'+us_states[xc]+'</option>';
		}
		state_str = state_str + '</select>';
		$('#'+state_box_name).bind('change',loadCartSummary);
	  }
	  $('#'+state_box_obj).html(state_str);
	  if(evt_obj.val()!='United States'){
		loadCartSummary();
		$('#'+state_box_name).unbind('change',loadCartSummary);
	  }else{
		$('#'+state_box_name).bind('change',loadCartSummary);
	  }
	});

	$('.ckblsp').click(function(){
	  loadCartSummary();
	});

	
	function loadCartSummary(){
	  if($('.ckblsp').attr('checked')){
		shipping_method = $('#billing_state').val();
	  }else
	  {
		shipping_method = $('#shipping_state').val();
	  }
	  $('#cart_container').load('<?php echo base_url();?>cart/cart_summary?shipping_method='+shipping_method,function(){
		$('#countcart').html($('.ajx_item_crt').length);
		//window.scrollTo(0,0);
	  });
	}
	$('.rmcart').live('click',function(e){
	  e.preventDefault();
	  item_id = $(this).data('rowid');
	  acc_id = $(this).data('acc');
	  attr_id = $(this).data('attr');
	  var cfm = confirm('Are you sure you want to remove this item');
	  if(cfm){
		$.get('<?php echo base_url();?>cart/remove_item/'+item_id,{'acc_id':acc_id,'attr_id':attr_id},function(data){
		  loadCartSummary();
		});
	  }
	});
	loadCartSummary();
  });
</script>
<?php $this->load->view("bottom_application");?>