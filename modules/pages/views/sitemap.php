<?php $this->load->view('top_application'); ?>
<?php $this->load->view('project_header'); ?>
<?php
$cat_qry = $this->db->select('category_name,friendly_url,category_alt')->limit(20)->get_where('wl_categories',array('parent_id'=>'0','status'=>'1'));
?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Siemap</strong></span></div>
  </div>
</div>
<div class="wrapper pt30 pb30">
  <h1 class="bb2 pb5">Sitemap</h1>
  <div class="fl w50 mt25">
	<h4 class="blue">Quick Links</h4>
	<p class="fl w48 mt5 sitemap">
	  <a href="<?php echo base_url();?>" title="Home">Home</a> 
	  <a href="<?php echo base_url();?>aboutus" title="About Us">About Us</a>  
	  <a href="<?php echo base_url();?>testimonials" title="Testimonials">Testimonials</a> 
	  <a href="<?php echo base_url();?>pages/newsletter" title="Newsletter" class="newsletter">Newsletter</a> 
	  <a href="<?php echo base_url();?>pages/advertisement" title="Advertise With Us">Advertise With Us</a>
	</p>
	<p class="fr w48 mt5 sitemap"> 
	  <a href="<?php echo base_url();?>faq" title="FAQ's">FAQ's</a> 
	  <a href="<?php echo base_url();?>contactus" title="Contact Us">Contact Us</a> 
	  <a href="<?php echo base_url();?>privacy-policy" title="Privacy Policy">Privacy Policy</a> 
	  <a href="<?php echo base_url();?>legal-disclaimer" title="Legal Disclaimer">Legal Disclaimer</a> 
	  <a href="<?php echo base_url();?>terms-and-conditions" title="Terms &amp; Conditions">Terms &amp; Conditions</a> 
	</p>
	<div class="cb"></div>
  </div>
  <div class="fl ml19 w23 mt25">
	<h4 class="blue">Consumers</h4>
	<p class="mt9 sitemap"> 
	  <a href="<?php echo base_url();?>how-to-buy" title="How to Buy">How to Buy</a> 
	  <a href="<?php echo base_url();?>buying-guidelines" title="Buying Guidelines">Buying Guidelines</a>
	  <?php
	  if($this->userId == 0)
	  {
	  ?> 
	  <a href="<?php echo base_url();?>users" title="Login">Login</a> 
	  <a href="<?php echo base_url();?>users/register" title="Registration">Registration</a>
	  <?php
	  }
	  elseif($this->userType==1)
	  {
	  ?>
		<a href="<?php echo base_url();?>members" title="My Account">My Account</a> 
	  <?php
	  }
	  ?> 
	</p>
  </div>
  <div class="fr w23 mt25">
	<h4 class="blue">SBP</h4>
	<p class="mt9 sitemap"> 
	  <a href="<?php echo base_url();?>how-to-sell" title="How to Sell">How to Sell</a> 
	  <a href="<?php echo base_url();?>selling-guidelines" title="Selling Guidelines">Selling Guidelines</a> 
	  <?php
	  if($this->userId == 0)
	  {
	  ?> 
	  <a href="<?php echo base_url();?>users" title="Login">Login</a> 
	  <a href="<?php echo base_url();?>users/vendor_register" title="Registration">Registration</a>
	  <?php
	  }
	  elseif($this->userType==2)
	  {
	  ?>
		<a href="<?php echo base_url();?>vendors" title="My Account">My Account</a> 
	  <?php
	  }
	  ?> 
	</p>
  </div>
  <div class="cb"></div>
  <div class="mt25">
	<h4 class="blue">Individual</h4>
	<div class="mt9 sitemap2">
	  <?php
	  if($cat_qry->num_rows() > 0)
	  {
		$cat_res = $cat_qry->result_array();
		foreach($cat_res as $val)
		{
		  $link_url = base_url().$this->config->item('individual_url_prefix')."/".$val['friendly_url'];
		?> 
		  <a href="<?php echo $link_url;?>" title="<?php echo escape_chars($val['category_alt']);?>"><?php echo $val['category_name'];?></a>
	  <?php
		}
	  }
	  ?> 
	  <div class="cb"></div>
	</div>
  </div>
  <div class="mt25">
	<h4 class="blue">Corporate/SME</h4>
	<div class="mt9 sitemap2"> 
	  <?php
	  if($cat_qry->num_rows() > 0)
	  {
		$cat_res = $cat_qry->result_array();
		foreach($cat_res as $val)
		{
		   $link_url = base_url().$this->config->item('corporate_url_prefix')."/".$val['friendly_url'];
		?> 
		  <a href="<?php echo $link_url;?>" title="<?php echo escape_chars($val['category_alt']);?>"><?php echo $val['category_name'];?></a>
	  <?php
		}
	  }
	  ?> 
	  <div class="cb"></div>
	</div>
  </div>
</div>
<div class="cb bb1"></div>
<?php $this->load->view('bottom_application'); ?>