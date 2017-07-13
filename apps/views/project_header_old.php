<?php $this->load->model('pages/pages_model');?>
<?php $this->load->helper(array('category/category'));?>
<?php
$header_cat_qry = $this->db->select('category_name,friendly_url,category_alt,category_id')->limit(5)->get_where('wl_categories',array('parent_id'=>'0','status'=>'1'));
$root_cat_count = $header_cat_qry->num_rows();
?>
<header>
  <div class="top1 minmax">
	<div class="wrapper">
	  <div class="logo_area fl"><div id="logo"><a href="<?php echo base_url();?>" title="TelUs Care"><img src="<?php echo theme_url();?>images/assurance.png"  alt=""></a></div></div>
	  <div class="fr w65 ar mt9">
		<span class="dib fs12 white vam" id="date_string">    </span><span class="dib fs12 white vam pl5" id="time_string"></span>
		<?php
		if($this->userId == 0)
		{
		?>
		<a href="<?php echo base_url();?>users" class="login_btn ml15 mr1 vam" title="Login Now">Login Now</a>
		<?php
		}
		else
		{ 
		  $acc_link = $this->userType==1 ? 'members' : 'vendors';
		?>
		  <a href="<?php echo base_url().$acc_link;?>" class="login_btn ml15 mr1 vam" title="My Account">My Account</a>
		<?php
		}
		?>
		<p class="soc_links vam dib"><a href="#" title="Facebook">&nbsp;</a><a href="#" class="twit" title="Twitter">&nbsp;</a><a href="#" class="in" title="LinkedIn">&nbsp;</a><a href="#" class="gplus" title="Google+">&nbsp;</a><a href="#" class="ytube" title="YouTube">&nbsp;</a></p>
		<div class="cb"></div>
		<?php echo CountrySelectBox(array('name'=>'country','opt_val_fld'=>'name','format'=>'class="t_country osons mt6" onchange="window.location.href=\''.base_url().'home/change_country/\'+this.value;"','current_selected_val'=>$this->session->userdata('loc_country') )); ?>
		
		<nav class="mynav ml32 mt7">
		  <ul class="topmenu">
			<li><a href="<?php echo base_url();?>" title="Home"><img src="<?php echo theme_url();?>images/hm.png" class="vam pb3" alt=""></a></li>
			<li>|</li>
			<li> <a href="<?php echo base_url();?>faq" title="FAQ’s">FAQ's</a> </li>
			<li>|</li>
			<li> <a href="<?php echo base_url();?>usp" title="USP">USP</a> </li>
			<li>|</li>
			<?php
			if($this->userId == 0)
			{
			?>
			<li> <a href="<?php echo base_url();?>users/vendor_register" title="Join Assurance">Join Assurance</a> </li>
			<?php
			}
			else
			{
			  $acc_link = $this->userType==1 ? 'members' : 'vendors';
			?>
			  <li> <a href="<?php echo base_url().$acc_link;?>" title="My Account">My Account</a> </li>
			<?php
			}
			?>
			<li>|</li>
			<li> <a href="<?php echo base_url();?>contactus" title="Contact Us">Contact Us</a> </li>
		  </ul>
		</nav>
		<div class="cb"></div>
	  </div>
	  <div class="cb"></div>
	</div>
  </div>
  <div class="search_area_outer">
	<div class="wrapper">
	  <div class="search_area rel">
		<p class="fs16 white weight600 fl mt15 ml13 lht-20"> <img src="<?php echo theme_url();?>images/srvf.png" class="fl mr14 assur1" alt=""> <a href="<?php echo base_url();?>"><img src="<?php echo theme_url();?>images/assur.png" class="assur2" alt=""></a> Services For </p>
		<div class="link_area fl mt7 ml13"> <a href="javascript:void(0)" title="Individual" class="trans_eff">Individual</a>
		  <?php
		  if($root_cat_count > 0)
		  {
			$header_cat_res = $header_cat_qry->result_array();
		  ?>
			<div class="link_dd trans_eff radius-20b o-hid">
			  <div class="p15" style="height:164px">
				<?php
				foreach($header_cat_res as $key1=>$val1)
				{
				  $top_menu_class = $key1==0 ? 'fl w18' : 'fl w18 ml15';
				  $link_url1 = base_url().$this->config->item('individual_url_prefix')."/".$val1['friendly_url'];
				
				  $header_subcat1_qry = $this->db->select('category_name,friendly_url,category_alt,category_id')->limit(6)->get_where('wl_categories',array('parent_id'=>$val1['category_id'],'status'=>'1'));
				  $root_subcat1_count = $header_subcat1_qry->num_rows();
				?>
				<div class="<?php echo $top_menu_class;?>">
				  <p class="white weight600 fs18"><a href="<?php echo $link_url1;?>" title="<?php echo escape_chars($val1['category_name']);?>" class="uo"><?php echo char_limiter($val1['category_name'],40);?></a></p>
				  <?php
				  if($root_subcat1_count > 0)
				  {
					$header_subcat1_res = $header_subcat1_qry->result_array();
				  ?>
				  <p class="submenu mt10"> 
				  <?php
				  foreach($header_subcat1_res as $key2=>$val2)
				  {
					$link_url2 = base_url().$this->config->item('individual_url_prefix')."/".$val2['friendly_url'];
				  ?>
					<a href="<?php echo $link_url2;?>" title="<?php echo escape_chars($val2['category_name']);?>" ><?php echo char_limiter($val2['category_name'],40);?></a>
				  <?php
				  }
				  ?>
				  </p>
				  <?php
				  }
				  ?>
				</div>
				<?php
				}
				?>
				<div class="cb"></div>
			  </div>
			  <div class="ac white" style="background:#764600"><a href="<?php echo base_url();?>category/individual" class="ttu fs16 weight700 osons white p10 db ac uo" title="View All Categories">View All Categories</a></div>
			</div>
		  <?php
		  }
		  ?>
		</div>
		<div class="link_area fl mt7 ml6"> <a href="javascript:void(0)" title="Corporate/SME" class="trans_eff">Corporate/SME</a>
		  <?php
		  if($root_cat_count > 0)
		  {
			$header_cat_res = $header_cat_qry->result_array();
		  ?>
			<div class="link_dd trans_eff radius-20b o-hid">
			  <div class="p15" style="height:164px">
				<?php
				foreach($header_cat_res as $key1=>$val1)
				{
				  $top_menu_class = $key1==0 ? 'fl w18' : 'fl w18 ml15';
				  $link_url1 = base_url().$this->config->item('corporate_url_prefix')."/".$val1['friendly_url'];
				
				  $header_subcat1_qry = $this->db->select('category_name,friendly_url,category_alt,category_id')->limit(6)->get_where('wl_categories',array('parent_id'=>$val1['category_id'],'status'=>'1'));
				  $root_subcat1_count = $header_subcat1_qry->num_rows();
				?>
				<div class="<?php echo $top_menu_class;?>">
				  <p class="white weight600 fs18"><a href="<?php echo $link_url1;?>" title="<?php echo escape_chars($val1['category_name']);?>" class="uo"><?php echo char_limiter($val1['category_name'],40);?></a></p>
				  <?php
				  if($root_subcat1_count > 0)
				  {
					$header_subcat1_res = $header_subcat1_qry->result_array();
				  ?>
				  <p class="submenu mt10"> 
				  <?php
				  foreach($header_subcat1_res as $key2=>$val2)
				  {
					$link_url2 = base_url().$this->config->item('corporate_url_prefix')."/".$val2['friendly_url'];
				  ?>
					<a href="<?php echo $link_url2;?>" title="<?php echo escape_chars($val2['category_name']);?>" ><?php echo char_limiter($val2['category_name'],40);?></a>
				  <?php
				  }
				  ?>
				  </p>
				  <?php
				  }
				  ?>
				</div>
				<?php
				}
				?>
				<div class="cb"></div>
			  </div>
			  <div class="ac white" style="background:#764600"><a href="<?php echo base_url();?>category/corporate" class="ttu fs16 weight700 osons white p10 db ac uo" title="View All Categories">View All Categories</a></div>
			</div>
		  <?php
		  }
		  ?>
		</div>
		<img src="<?php echo theme_url();?>images/spacer.gif" class="db fl bg-white ml12 mt7 opc7" width="1" height="37" alt="">
		<?php echo form_open('products');?>
		<div class="srch_box fl mt7 ml13 pl10 pt7">
		  <input name="srch_keyword" type="text" class="fl p4 w65 osons" placeholder="Search Products/Services...">
		  <img src="<?php echo theme_url();?>images/spacer.gif" class="db fl bg-black mt2 opc3" width="1" height="21" alt="">
		  <select name="cat_id" class="fr w32 osons mr5 p2">
			<option value="">All Categories</option>
			<?php echo get_nested_dropdown_menu(0,array());?>
		  </select>
		  <div class="cb"></div>
		</div>
		<input type="hidden" name="search" value="Y" />
		<input name="btn_sbt" type="image" title="Search" alt="Search" src="<?php echo theme_url();?>images/srch.png" class="db fl ml7 trans_eff mt7 srch_btn">
		<div class="cb"></div>
		<?php echo form_close();?>
	  </div>
	</div>
  </div>
  <div class="top_space"></div>
  <?php
  if($this->uri->uri_string =='')
  {
  ?>
	<div class="top2 minmax">
	  <div class="wrapper pt4"> 
		<!-- TOP 2 ENDS --> 
		<!-- BANNER ENDS -->
		<div class="banner_area">
		  <div class="fluid_container">
			<div class="fluid_dg_wrap fluid_dg_charcoal_skin fluid_container" id="fluid_dg_wrap_1" >
			  <div data-src="<?php echo theme_url();?>banner/slide1.png"></div>
			  <div data-src="<?php echo theme_url();?>banner/slide2.png"></div>
			  <div data-src="<?php echo theme_url();?>banner/slide3.png"></div>
			  <div data-src="<?php echo theme_url();?>banner/slide4.png"></div>
			</div>
		  </div>
		</div>
		<!-- BANNER ENDS --> 
	  </div>
	</div>
	<!-- TOP 2 ENDS --> 
  <?php
  }
  ?>
</header>