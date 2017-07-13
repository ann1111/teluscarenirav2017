<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php $ref=$this->input->get_post('ref');?>
<?php
$vendor_login_content = get_db_field_value('wl_cms_pages','page_description',"WHERE friendly_url='vendor-login-content' AND status='1'");

$user_login_content = get_db_field_value('wl_cms_pages','page_description',"WHERE friendly_url='user-login-content' AND status='1'");

if(!empty($_POST))
{
  $login_type = set_value('login_usertype');
  $login_username = set_value('login_username');
  $login_userno = set_value('login_user_no');
  $remember = $this->input->post('remember');
}
else
{
  $login_type = get_cookie('userType');
  $login_username = get_cookie('userName');
  $login_userno = get_cookie('user_no');
  $remember = $login_username;
}
?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong> Login!</strong></span></div>
  </div>
</div>
<div class="wrapper pt20 pb20" style="min-height:300px;">
  <div class="border1 pt30 pb30">
	<?php error_message();?>
	<?php validation_message();?>
	<div class="cb"></div>
	<?php echo form_open('');?>
	<div class="fl w40 fs13 ml50">
	  <h1 class="fs24">Login!</h1>
	  <p class="mt20 fs16">Login as : 
	  <label class="b ml10"><input name="login_usertype" type="radio" value="1" class="login_usertype" <?php if($login_type==1){ ?> checked="checked" <?php } ?>> Consumer</label>
	  <label class="b ml20"><input name="login_usertype" type="radio" value="2" class="login_usertype" <?php if($login_type==2){ ?> checked="checked" <?php } ?>> SBP</label>
	  <?php echo form_error('login_usertype');?>
	  </p>
	  <p class="mt20">
		<label for="email">Email ID :</label>
	  </p>
	  <p class="mt3">
		<input name="login_username" id="email" type="text" value="<?php if($login_username!=""){ echo $login_username; } ?>" class="p7 fs14 lht-20 w90 myfrm radius-3">
		<?php echo form_error('login_username');?>
	  </p>
	  <p class="mt10">
		<label for="password">Password :</label>
	  </p>
	  <p class="mt3">
		<input name="login_password" id="password" type="password" class="p7 fs14 lht-20 w90 myfrm radius-3" value="<?php if(get_cookie('pwd')!=""){ echo get_cookie('pwd'); } ?>">
		<?php echo form_error('login_password');?>
	  </p>
	  <div id="cnt_userno" <?php if($login_type!=2){?> class="dn"<?php }?>>
		<p class="mt10">
		  <label for="user_no">User No :</label>
		</p>
		<p class="mt3">
		  <input name="login_user_no" id="user_no" type="text" class="p7 fs14 lht-20 w90 myfrm radius-3" value="<?php if($login_userno!=""){ echo $login_userno; } ?>">
		<?php echo form_error('login_user_no');?>
		</p>
	  </div>
	  <p class="mt10 mb10">
		<label><input name="remember" type="checkbox" value="Y" class="fl mr5 mt3" <?php if($remember!=""){ ?> checked="checked" <?php } ?>>Remember Me!</label>
	  </p>
	  
	  <p>
		<input type="hidden" name="action" value="Y" />
		<input name="btn_sbt" type="submit" class="btn3 osons shadow1 trans_eff radius-3" value="Submit" style="padding:0 31px">
	  </p>
	  <p class="red mt10"><a href="<?php echo base_url();?>users/forgotten_password" class="uu forgot">Forgot Your Password?</a></p>
	</div>
	<?php echo form_close();?>
	<!-- login ends -->
	<div class="fl w40 fs13 ml30 mt50 bl pl60 pb5">
	  <div id="login_benefit_user" <?php if($login_type==2){?> class="dn"<?php }?>>
		<?php echo $user_login_content;?>
		<p class="mt20"><a href="<?php echo base_url();?>users/register" class="btn1 shadow1 trans_eff radius-3" style="padding:0 30px">Create Your Account</a></p>
	  </div>
	  <div id="login_benefit_vendor" <?php if($login_type!=2){?> class="dn"<?php }?>>
		<?php echo $vendor_login_content;?>
		<p class="mt20"><a href="<?php echo base_url();?>users/vendor_register" class="btn1 shadow1 trans_eff radius-3" style="padding:0 30px">Create Your Account</a></p>
	  </div>
	</div>
	<div class="cb pb20"></div>
  </div>
  <div  style="border-bottom:3px solid #e79721"></div>
  <script type="text/javascript">
	$(document).ready(function(){
	  $('.login_usertype').click(function(){
		btn_obj = $(this);
		if(btn_obj.val()=='1'){
		  $('#cnt_userno').addClass('dn');
		  $('#login_benefit_vendor').slideUp(200,function(){
			$('#login_benefit_user').slideDown(200);
		  });
		}
		else{
		  $('#cnt_userno').removeClass('dn');
		  $('#login_benefit_user').slideUp(200,function(){
			$('#login_benefit_vendor').slideDown(200);
		  });
		}
	  });
	});
  </script>
</div>
<?php $this->load->view("bottom_application");?>