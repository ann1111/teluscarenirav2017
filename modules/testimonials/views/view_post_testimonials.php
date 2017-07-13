<!--post your Testimonial-->
<div class="p15 border5">
  <?php //validation_message();?>
  <?php echo  form_open_multipart(''); ?>
  <p class="fs18 lht-22 pb5 orange roboto-slab ttu bb4"><b class="gray4">Post Your</b><br> <span class="fs22">Testimonial</span></p>

  <p class="ttu mt8"><label for="person_name">*Name :</label></p>
  <p class="mt2">
	<input type="text" name="poster_name" id="person_name" value="<?php echo set_value('poster_name');?>" class="w100">
	<?php echo form_error('poster_name');?>
  </p>

  <p class="ttu mt8"><label for="email">Email ID :</label></p>
  <p class="mt2"><input type="text" name="poster_email" id="email" value="<?php echo set_value('poster_email');?>" class="w100">
  <?php echo form_error('poster_email');?>
  </p>

  <p class="ttu mt8"><label for="upload">Upload Image :</label></p>
  <p class="mt2"><input type="file" name="photo" id="upload" class="w100">
  <?php echo form_error('photo');?>
  </p>


  <p class="ttu mt8"><label for="description">*Description :</label></p>
  <p class="mt2"><textarea name="testimonial_description" id="description" cols="45" rows="5" class="w100"><?php echo set_value('testimonial_description');?></textarea>
  <?php echo form_error('testimonial_description');?>
  </p>

  <p class="ttu mt8"><label for="verification_code">*Word Verification :</label></p>
  <p class="mt2"><input type="text" name="verification_code" id="verification_code" autocomplete="off" class="w100"></p>
  <p><img src="<?php echo site_url('captcha/normal'); ?>" alt="" class="vam" id="captchaimage"> <a href="javascript:void(0);" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();"><img src="<?php echo theme_url();?>images/ref1.png" alt="Refresh" title="Refresh" class="ml5 vam"></a>
  <?php echo form_error('verification_code');?>
  </p>
  <p class="mt10">
	<input type="submit" name="post_test" id="button2" value="Post" class="btn1">
  </p>
  <?php echo form_close();?>
</div>
<!--post your Testimonial-->
