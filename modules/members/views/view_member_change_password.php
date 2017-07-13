<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>members" itemprop="url"><span itemprop="title">My Account</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Change Password</strong></span></div>
  </div>
</div>
<div class="wrapper pt20 pb20" style="min-height:300px;">
  <?php $this->load->view('members/top_links');?>
  <div class="w90 auto mt30">
	<h2 class="bb1 pb5">Change Password</h2>
	<?php error_message();?>
	<?php echo form_open('members/change_password'); ?>
	<div class="mt40 w80 short_form fs14 auto bg-gray1 p20 border1">
	  <fieldset class="pb15 mt30" style="border:0;">
	  <p class="w36 pt8">
		<label for="old_password">Old Password <b class="red">*</b> :</label>
	  </p>
	  <div class="w62">
		<input name="old_password" id="old_password" type="password">
		<?php echo form_error('old_password');?>
	  </div>
	  <div class="cb pb10"></div>
	  <p class="w36 pt8">
		<label for="new_password">New Password <b class="red">*</b> :</label>
	  </p>
	  <div class="w62">
		<input name="new_password" id="new_password" type="password">
		<?php echo form_error('new_password');?>
	  </div>
	  <div class="cb pb10"></div>
	  <p class="w36 pt8">
		<label for="confirm_password">Confirm Password <b class="red">*</b> :</label>
	  </p>
	  <div class="w62">
		<input name="confirm_password" id="confirm_password" type="password">
		<?php echo form_error('confirm_password');?>
	  </div>
	  <div class="cb pb10"></div>
	  </fieldset>
	  <p class="w62 osons">
		<input name="chg_pwd" type="submit" value="Update Now!" class="btn3 trans_eff radius-3">
		<input name="reset" type="reset" value="Reset" class="btn3x trans_eff radius-3">
	  </p>
	  <div class="cb"></div>
	</div>
	<?php echo form_close();?>
	<div class="cb pb30"></div>
  </div>
</div>
<?php $this->load->view("bottom_application");?>