<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php 
$values_posted_back=(is_array($this->input->post())) ? TRUE : FALSE;

if($this->session->userdata('user_id') > 0)
{
  $mres = $this->mres;
}
else
{
  $mres = "";
}

$valid_mem=(isset($mres) && is_array($mres)) ? TRUE : FALSE;

$author = ($values_posted_back===TRUE) ? $this->input->post('author') : ($valid_mem===TRUE ? $mres['first_name'] : "");

$author_email = ($values_posted_back===TRUE) ? $this->input->post('author_email') : ($valid_mem===TRUE ? $mres['user_name'] : "");

$post_review_flag = (($valid_mem === TRUE) ? ($this->userId==$res['customers_id'] ? FALSE : TRUE) : FALSE);

if($post_review_flag === TRUE)
{
  //Check member requested any quotation of this vendor before?
  $res_quot_vendor = $this->db->query("SELECT count(quotation_id) as gtotal FROM wl_request_quotation WHERE posted_by='".$this->userId."' AND vendor_id='".$res['customers_id']."'")->row();

  $post_review_flag = $res_quot_vendor->gtotal > 0 ? TRUE : FALSE;
}

$rating_opts = $this->config->item('rating_opts');

$cfg_comment = array(
				  'condition'=> "AND entity_id ='".$res['customers_id']."' AND entity_type='customer' AND a.status ='1'"
		  );

$comments_ct = $this->comments_model->get_count_comments($cfg_comment);

?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>vendors/category" itemprop="url"><span itemprop="title">Category</span></a></div>
	<?php
	if($res['ref_cat_id'] > 0)
	{
	  $bc_res = $this->db->select('category_name,friendly_url')->get_where('wl_categories',array('category_id'=>$res['ref_cat_id']))->row();
	  if(is_object($bc_res))
	  {
	  ?>
		<b>&gt;</b>
		<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url().$bc_res->friendly_url."/".$this->config->item('cat_vendor_url_suffix');?>" itemprop="url"><span itemprop="title"><?php echo $bc_res->category_name;?></strong></span></a></div>
	  <?php
	  }
	}
	?>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong><?php echo $res['company_name'];?></strong></span></div>
  </div>
</div>
<div class="wrapper pt30">
  <?php error_message();?>
  <h1><?php echo $res['company_name'];?></h1>
  <div class="mt10 p15 border1 bb bg-gray1">
	<div class="part_pc fl mt5 mr15 mb10">
	  <figure><img src="<?php echo get_image('company_logos',$res['company_logo'],'170','90','R'); ?>" alt="<?php echo escape_chars($res['company_name']);?>"></figure>
	</div>
	<div>
	  <?php 
	  if(!is_null($res['why_us']))
	  {
		$why_us_arr = unserialize($res['why_us']);
		echo '<ul>';
		foreach($why_us_arr as $val)
		{
		  echo '<li>'.$val.'</li>';
		}
		echo '</ul>';
	  }
	  ?>
	</div>
	<div class="cb"></div>
  </div>
  <div class="fr w25 mt30"> <img src="<?php echo theme_url();?>images/r_bnr1.jpg" class="db w100" alt=""> <img src="<?php echo theme_url();?>images/r_bnr3.jpg" class="db w100 mt20" alt=""> </div>

  <!-- left ends -->

  <div class="fl w70 mt25">
	<p class="fr mt10"><a href="#writereview" class=" btn1 scroll">Write A Review</a><br><br></p>
	<h3 class="pb10 mt10 " id="review"><b class="red">Reviews for</b>
<?php echo $res['company_name'];?></h3>
	<p class="bb pb5"><b class="red fs1">Total:</b> <span class="fs14 b u  black"><?php echo $comments_ct;?> Reviews</span></p>
	<div class="mt15 pr15 mb10">
	  <?php
	  if(is_array($review_res) && !empty($review_res))
	  {
		foreach($review_res as $key=>$val)
		{
		?>
		  <div class="rev_box">
			<div class="rev_text">
			  <p class="fs18 black mb10 b robotoC"><?php echo $val['mem_name'];?></p>
			  <p class="fl">Rating : <?php echo rating_html($val['ads_rating'],5);?></p>
			  <p class="fl ml15">Posted On - <?php echo date("d m, Y",strtotime($val['review_date']));?></p>

			  <div class="cb"></div>
			  <p class="p10 gray1 fs13 i mt5 border1 bg-gray1"><?php echo $val['text'];?></p>
			</div>
		  </div>
	  <?php
		}
	  }
	  else
	  {
		echo '<p class="ac b">'.$this->config->item('no_record_found').'</p>';
	  }
	  ?>
	</div>

	<h3 class="pb10 mt30 bb" id="writereview"><b class="red">Write a Review For</b><br>
<?php echo $res['company_name'];?></h3>
	<div class="mt20 pb30">
	  <?php
	  if($post_review_flag === TRUE)
	  {
	  ?>
	  <?php echo form_open('');?>
	  <div class="p5 mb10 fs16 b"><input name="review_to" type="radio" value="1" class="vam mr5" <?php echo set_value('review_to')==1 ? ' checked="checked"' : '';?>> SBP <input name="review_to" type="radio" value="2" class="ml20 mr5 vam" <?php echo set_value('review_to')==2 ? ' checked="checked"' : '';?>> ADMIN
	  <?php echo form_error('review_to');?>
	  </div>
	  <div class="fl w32">
		<input name="author" type="text" value="<?php echo set_value('author',$author);?>" class="p5 w100" placeholder="Name *">
		<?php echo form_error('author');?>
	  </div>
	  <div class="fl ml5 w32">
		<input name="author_email" type="text" value="<?php echo set_value('author_email',$author_email);?>" class="p5 w100" placeholder="Email ID *">
		<?php echo form_error('author_email');?>
	  </div>
	  <div class="fl ml5 w32">
		<select name="ads_rating" class="p5 w100">
		  <option value="">Ratings</option>
		  <?php
		  foreach($rating_opts as $key=>$val)
		  {
		  ?>
			<option value="<?php echo $key;?>" <?php echo set_value('ads_rating')==$key ? ' selected="selected"' : '';?>><?php echo $key;?> Star</option>
		  <?php
		  }
		  ?>
		</select>
		<?php echo form_error('ads_rating');?>
	  </div>
	  <div class="cb"></div>
	  <p class="mt10 mr22">
		<textarea name="comment" cols="40" rows="3" class="p5 w100" placeholder="Reviews *"><?php echo set_value('comment');?></textarea>
		<?php echo form_error('comment');?>
	  </p>
	  <p class="mt10">
		<input name="verification_code" id="verification_code" type="text" placeholder="Enter Code *" class="p7 vam" style="width:120px">
		<img src="<?php echo site_url('captcha/normal/review'); ?>" alt="" class="vam" id="captchaimage"> <a href="javascript:void(0);" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/review/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();"><img src="<?php echo theme_url();?>images/ref.png" alt="" class="vam"></a>
		<?php echo form_error('verification_code');?> 
	  </p>
	  <p class="mt10">
		<input name="post_review" type="submit"  value="Submit" class="btn1 trans_eff">
		<input name="input" type="reset" value="Reset" class=" btn1 trans_eff">
	  </p>
	  <?php echo form_close();?>
	<?php
	}
	else
	{
	  if($this->userId==0)
	  {
		echo '<div class="red"><a href="'.base_url().'users/login?ref='.$res['friendly_url'].'">Login to post review</a></div>';
	  }
	  elseif($this->userType !='1')
	  {
		echo '<div class="red">You must be registered as a member to post review</div>';
	  }
	  else
	  {
		echo '<div class="red">You must have to purchase quotation of this vendor products/services to post review</div>';
	  }
	}
	?>
	</div>

	<h2 class="blue fs20">Our Products/Services - <?php echo $total_products;?></h2>
	<div class="mt15">
	  <?php
	  if(is_array($res_products) && !empty($res_products))
	  {
		$data['res_products'] = $res_products;
	  ?>
		<div id="xlistContainer">
		  <?php $this->load->view('category/load_vendor_products',$data);?>
		</div>	
		<p class="ac mt20 dn" id="loadingdiv"><img src="<?php echo theme_url();?>images/ajax-loader.gif" width="128" height="15" alt=""><br><br></p>
		<script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>

		<?php echo form_open("",'id="myform" method="post" ');?>
		<input type="hidden" name="per_page" value="<?php echo $this->config->item('per_page');?>">
		<input type="hidden" name="offset" id="pg_offset" value="0">
		<input type="hidden" name="load_action" id="load_action" value="services">
		<?php echo form_close();?>

		<script type="text/javascript">
		  $.extend(gObj,{
						'actual_count':<?php echo $total_products;?>,
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

	<!-- listing ends -->
  </div>
  <!-- right ends -->
  <div class="cb"></div>
  <script type="text/javascript">
  <?php
  if(!$error_validate)
  {
  ?>
	jQuery('html,body').animate({scrollTop:$('#writereview').offset().top}, 1000);
  <?php
  }
  ?>
  </script>
</div>
<?php $this->load->view("bottom_application");?>