<?php $this->load->view('top_application'); ?>
<?php $this->load->view('project_header'); ?>
<?php $this->load->view('project_subheader'); ?>
<section>
  <!--tree-->
  <div class="breadcrumb  mb8 tab_hider">
	<div class="wrapper">
	  <b class="ttu"><span class="gray pl5">You Are Here :</span> </b>
	  <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="index.htm" itemprop="url"><span itemprop="title"><img src="<?php echo theme_url();?>images/tree-home.png" class="vam" alt="" title=""></span></a></div>   
	  <b>&gt;</b>
	  <?php
	  if(is_array($res) && !empty($res))
	  {
	  ?>
		<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url().$res['friendly_url'];?>" itemprop="url"><span itemprop="title"><?php echo $res['package_name'];?></span></a></div>   
	  <b>&gt;</b>  
	  <?php
	  }
	  ?>   
	  <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><b>Enquiry</b></span></div>
	  <div class="pb5"></div>
	</div>
  </div>
  <!--tree-->

  <div class="wrapper">
	<div class="p10">
	  <h1>Enquiry</h1>
	  <div class="cb bb4 pb5"></div>
	  <div class="pt30">

		<div class="register_box w100 auto">
		  <?php error_message();?>
		  <?php echo form_open('');?>
		  <fieldset class="pb15" style="border:0; border-bottom:1px solid #eee">
		  <div>
			<div class="w36"><label for="name">Name<b class="red">*</b> :</label></div>
			<div class="w62">
			  <input name="first_name" id="name" type="text" value="<?php echo set_value('first_name');?>" class="w100">
			  <?php echo form_error('first_name');?>
			</div>
			<div class="cb mb10"></div>

			<div class="w36"><label for="email">Email<b class="red">*</b> :</label></div>
			<div class="w62">
			  <input name="email" id="email" type="text" value="<?php echo set_value('email');?>" class="w100">
			  <?php echo form_error('email');?>
			</div>
			<div class="cb mb10"></div>

			<div class="w36"><label for="mobile_number">Mobile No.<b class="red">*</b> :</label></div>
			<div class="w62">
			  <input name="mobile_number" id="mobile_number" type="text" value="<?php echo set_value('mobile_number');?>" class="w100">
			  <?php echo form_error('mobile_number');?>
			</div>
			<div class="cb mb10"></div>

			<div class="w36"><label for="arrival_date">Arrival Date<b class="red">*</b> :</label></div>
			<div class="w62">
			  <input name="from_travel_date" id="arrival_date" type="text" value="<?php echo set_value('from_travel_date');?>" class="w90 arr_date1"><a href="#"><img src="<?php echo theme_url(); ?>images/date.png" alt="" class="arr_date vam ml5"></a>
			  <?php echo form_error('from_travel_date');?>
			</div>
			<div class="cb mb10"></div>

			<div class="w36"><label for="dep_date">Departure Date<b class="red">*</b> :</label></div>
			<div class="w62">
			  <input name="to_travel_date" id="dep_date" type="text" value="<?php echo set_value('to_travel_date');?>" class="w90 dep_date1"><a href="#"><img src="<?php echo theme_url(); ?>images/date.png" alt="" class="dep_date vam ml5"></a>
			  <?php echo form_error('to_travel_date');?>
			</div>
			<div class="cb mb10"></div>

			<div class="w36"><label for="enquiry">Enquiry<b class="red">*</b> :</label></div>
			<div class="w62">
			  <textarea name="message" id="enquiry" cols="45" rows="5" class="w100"><?php echo set_value('message');?></textarea>
			  <?php echo form_error('message');?>
			</div>
			<div class="cb mb10"></div>

			<div class="w36"><label for="verification_code">Verification Code<b class="red">*</b> :</label></div>
			<div class="w62">
			  <input name="verification_code" id="verification_code" type="text" placeholder="Word Verification *" class="vam w40">
			  <img src="<?php echo site_url('captcha/normal/enquiry'); ?>" alt="" class="vam" id="captchaimage"> <a href="javascript:void(0);" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/contactus/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();"><img src="<?php echo theme_url();?>images/ref1.png" alt="Refresh" title="Refresh" class="vam"></a><br>Type the characters shown above.
			  <?php echo form_error('verification_code');?>
			</div>
			<div class="cb mb10"></div>
			<p class="w36 mob_hider">&nbsp;</p>
			<p class="w62">
			  <input type="submit" name="button" id="button" value="Submit" class="btn1"> 
			  <input type="reset" name="Reset" id="button" value="Reset" class="btn2 ml5">
			</p>
			<div class="cb pb10"></div>
		  </div>
		  </fieldset>
		  <?php echo form_close();?>
		</div>
	  </div>
	</div>
  </div>
  <?php 
  $default_date = $this->config->item('config.date');
  $posted_start_date = $this->input->post('from_travel_date');
  ?>
  <script type="text/javascript" src="<?php echo base_url();?>assets/developers/js/ui/jquery-ui-1.8.16.custom.min.js"></script>
  <link type="text/css" href="<?php echo base_url();?>assets/developers/js/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
  <script type="text/javascript">
	$(document).ready(function(){
	  
	  $('.arr_date,.dep_date').click(function(e){
		e.preventDefault();
		cls = $(this).hasClass('arr_date') ? 'arr_date1' : 'dep_date1';
		$('.'+cls+':eq(0)').focus();
	  });
	  $( ".arr_date1").live('focus',function(){
			  $(this).datepicker({
			  showOn: "focus",
			  dateFormat: 'yy-mm-dd',
			  changeMonth: true,
			  changeYear: true,
			  defaultDate: 'y',
			  buttonText:'',
			  minDate:'<?php echo $default_date;?>' ,
			  maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
			  yearRange: "c-100:c+100",
			  buttonImageOnly: true,
			  onSelect: function(dateText, inst) {
							$('.arr_date1').val(dateText);
							$( ".dep_date1").datepicker("option",{
							  minDate:dateText ,
							  maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
						  });

						}
		  });
	  });
	  $( ".dep_date1").live('focus',function(){
			  $(this).datepicker({
						showOn: "focus",
						dateFormat: 'yy-mm-dd',
						changeMonth: true,
						changeYear: true,
						defaultDate: 'y',
						buttonText:'',
						minDate:'<?php echo $posted_start_date!='' ? $posted_start_date :  $default_date;?>' ,
						maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
						yearRange: "c-100:c+100",
						buttonImageOnly: true,
						onSelect: function(dateText, inst) {
						  $('.dep_date1').val(dateText);
						}
					});
		});
		
	});
  </script>
</section>
<?php $this->load->view('bottom_application'); ?>