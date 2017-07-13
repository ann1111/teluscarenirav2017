<?php
$curr_symbol = display_symbol();
$priceRange = $this->config->item('price_range_opts');
?>
<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<div class="tree minmax">
  <div class="wrapper"> YOUR ARE HERE : 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title"><img src="<?php echo theme_url();?>images/hm.png" class="vam pb3" alt=""></span></a></div>   
	<b>&gt;</b>   
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong>Advanced Search</strong></span></div>
  </div>
</div>

<!-- MIDDLE STARTS -->

<section class="minmax mid_shed">
  <div class="wrapper pt30 cms_area">
	<div class="fl w75">
	  <h1 class="bb pb5">Advanced <b>Search</b></h1>
	  <div class="short_form">
		<?php echo form_open('products',array('name'=>"frm11",'method'=>'get')); ?>
		<fieldset class="pb15" style="border:0;">
		  <p class="w36 pt8">
			<label for="name"> Keyword  </label>
		  </p>
		  <p class="w62">
			<input name="keyword" id="name" type="text" placeholder="Product Name / Product Code">
		  </p>
		  <div class="cb pb7"></div>          
		  <p class="w36 pt8">
			<label for="category"> Category  </label>
		  </p>
		  <p class="w62">
			<select name="cat_id" id="category">
			  <option value="">Select</option>
			  <?php echo get_nested_dropdown_menu(0);?>
			</select>
		  </p>
		  <div class="cb pb7"></div>
		  <p class="w36 pt8">
			<label for="l_price"> Price Range  </label>
		  </p>
		  <p class="w62">
			<select name="prange" id="l_price" style="width:186px">
			  <option value="">Select</option>
			  <?php
			  foreach($priceRange as $key=>$val)
			  {
			  ?>
				  <option value="<?php echo $key;?>"><?php echo $val;?> (<?php echo $curr_symbol;?>) </option>
			  <?php	
			  }
			  ?>
			</select>
		  </p>
		  <div class="cb pb7"></div>
		</fieldset>
		<p class="w62">
		  <input type="hidden" name="search" value="Y" />
		  <input name="register_me" type="submit" value="Search"  class="btn2 radius-3">
		</p>
		<?php echo form_close();?>
		<div class="cb"></div>
	  </div>
	</div>

	<!-- left ends -->

	<div class="fr w20 bl pl20">
	  <p><img src="<?php echo theme_url();?>images/r_bnr4.jpg" class="db w100" alt=""></p>
	</div>

	<!-- right ends -->

	<div class="cb"></div>
</div>
</section>
<?php $this->load->view("bottom_application");?>