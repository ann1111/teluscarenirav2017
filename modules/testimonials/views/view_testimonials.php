<?php $this->load->view('top_application'); ?>
<?php $this->load->view('project_header'); ?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Testimonials</strong></span></div>
  </div>
</div>
<div class="wrapper pt30">
  <div class="fl w78">
	<h1 class="bb pb5">Testimonials</h1>
	<?php
	error_message();
	if(is_array($res) && !empty($res) )
	{
	  $data['res'] = $res;
	  ?>
	  <div class="mt30" id="xlistContainer">
		<?php $this->load->view('testimonials/load_testimonials',$data);?>
	  </div>
	  <p class="ac mt20 dn" id="loadingdiv"><img src="<?php echo theme_url();?>images/ajax-loader.gif" width="128" height="15" alt=""><br><br></p>

	  <script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>

	  <?php echo form_open("",'id="myform" method="post" ');?>
	  <input type="hidden" name="per_page" value="<?php echo $this->config->item('per_page');?>">
	  <input type="hidden" name="offset" id="pg_offset" value="0">
	  <?php echo form_close();?>

	  <script type="text/javascript">
		$.extend(gObj,{
					  'actual_count':<?php echo $total_records;?>,
					  'listingContainer':'#xlistContainer',
					  'itemContainer':'.xitemContainer',
					  'req_url':'<?php echo $base_url;?>',
					  'data_frm' : '#myform'
			  });
	  </script>
	  <script type="text/javascript" src="<?php echo base_url(); ?>assets/developers/js/pager.js"></script>

	<?php
	}
	else
	{
	  echo '<p class="ac b">'.$this->config->item('no_record_found').'</p>';
	}
	?>
  </div>
  <!-- left ends -->
  <div class="fr w20">
	<h3>Post <b class="db fs18">Your Testimonial</b></h3>
	<?php echo  form_open(''); ?>
	<div class="mt15 bb1 pb20 mb30">
	  <input name="poster_name" type="text" value="<?php echo set_value('poster_name');?>" class="radius-3 p6 pl10 w100 fs13 lht-20" placeholder="Name *">
	  <?php echo form_error('poster_name');?>
	  <input name="poster_email" type="text" value="<?php echo set_value('poster_email');?>" class="radius-3 p6 pl10 w100 fs13 lht-20 mt10" placeholder="Email ID *">
	  <?php echo form_error('poster_email');?>
	  <textarea class="radius-3 p6 pl10 w100 fs13 lht-20 mt10" name="testimonial_description" cols="" rows="4" placeholder="Testimonials *"><?php echo set_value('testimonial_description');?></textarea>
	  <?php echo form_error('testimonial_description');?>
	  <p class="mt10">
		<input name="verification_code" id="verification_code" type="text" class="radius-3 p6 pl10 fs13 lht-20" style="width:90px;" placeholder="Enter Code *">
	  </p>
	  <p class="mt10"><img src="<?php echo site_url('captcha/normal'); ?>" alt="" title=""  class="vam p1" id="captchaimage"><a href="javascript:void(0);" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();"><img src="<?php echo theme_url();?>images/ref.png" alt="" title=""  class="vam"></a></p>
	  <?php echo form_error('verification_code');?>
	  <div class="cb"></div>
	  <p class="mt10">
		<input name="post_test" type="submit"  value="Post Now!" class="btn3 radius-3 trans_eff">
	  </p>
	</div>
	<?php echo form_close();?>
	<?php $this->load->view('banner/right_banner');?>
  </div>
  <!-- right ends -->
  <div class="cb"></div>
</div>
<?php $this->load->view('bottom_application'); ?>