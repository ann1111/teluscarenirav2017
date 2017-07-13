<?php $this->load->view('top_application'); ?>
<?php $this->load->view('project_header'); ?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Advertise With Us</strong></span></div>
  </div>
</div>
<div class="wrapper pt30 pb30">
  <h1>Advertise With Us</h1>
  <p class="mt5 fs16 b">Have a advertisement related query??? Just Fill the Below Information:</p>
  <div class="mt20 p25 border1 bb fs16 bg-gray1">
	<?php echo error_message(); ?>
	<?php echo form_open_multipart('');?>
	<fieldset class="" style="border:none;">
	<div class="w40 fl">
	  <p>
		<input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name',$this->mres['first_name']);?>" class="p8 pl15 lht-20 myfrm w100" placeholder="First Name *">
		<?php echo form_error('first_name');?>
	  </p>
	  <p class="mt8">
		<input type="text" name="last_name" id="last_name" value="<?php echo set_value('last_name');?>" class="p8 pl15 lht-20 myfrm w100" placeholder="Last Name">
		<?php echo form_error('last_name');?>
	  </p>
		<p class="mt8">
		  <input type="text" name="company_name" id="company_name" value="<?php echo set_value('company_name',$this->mres['company_name']);?>" class="p8 pl15 lht-20 myfrm w100" placeholder="Company Name">
		  <?php echo form_error('company_name');?>
		</p>
		<p class="mt8">
		  <input type="text" name="email" id="email" value="<?php echo set_value('email',$this->mres['user_name']);?>" class="p8 pl15 lht-20 myfrm w100" placeholder="Email ID *">
		  <?php echo form_error('email');?>
		</p>
		<p class="mt8">
		  <input type="text" name="mobile_number" id="mobile_number" value="<?php echo set_value('mobile_number');?>" class="p8 pl15 lht-20 myfrm w100" placeholder="Mobile No. *">
		  <?php echo form_error('mobile_number');?>
		</p>
	  </div>
	  <div class="fr w58">
		<p><span class="p8 pl15 lht-20 myfrm w100 db">Upload Banner :
		  <input name="banner" type="file" style="border:0;" class="vam w60">
</span>
		</p>
		<p class="mt8 ">
		  <input type="text" name="website_url" id="website_url" value="<?php echo set_value('website_url');?>" class="p8 pl15 lht-20 myfrm w100" placeholder="Banner URL">
		  <?php echo form_error('website_url');?>
		</p>
		<p class="mt8">
		  <textarea name="description" id="description" cols="45" rows="5" class="p8 pl15 lht-20 myfrm w100" style="height:136px; resize:none" placeholder="Enquiry / Comments *"><?php echo set_value('description');?></textarea>
		  <?php echo form_error('description');?>
		</p>
	  </div>
	  <div class="cb pb3"></div>
	  <p class="fl">
		<input name="verification_code" id="verification_code" type="text" class="p8 pl15 lht-20 myfrm" style="width:150px;" placeholder="Word Verification *">
	  </p>
	  <p class="fl ml10 mt8"><img src="<?php echo site_url('captcha/normal/advertise'); ?>" alt="" title=""  class="vam p1" id="captchaimage"><a href="javascript:void(0);" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/advertise/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();"><img src="<?php echo theme_url();?>images/ref.png" alt="Refresh" title="Refresh"  class="vam ml10"></a></p>
	  <div class="cb"></div>
	  <?php echo form_error('verification_code');?>
	  <div class="cb"></div>
	  <div class="mt10">
		<input name="input" type="submit"  value="Submit" class="btn3 radius-3 trans_eff">
		<input name="input" type="reset" value="Reset" class="btn3x radius-3 trans_eff">
	  </div>
	</fieldset>
	<?php echo form_close();?>
  </div>
</div>
<div class="cb bb1"></div>
<?php $this->load->view('bottom_application'); ?>