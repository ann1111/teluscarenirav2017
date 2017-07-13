<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
$curr_symbol = display_symbol();

$prod_type = set_value('prod_type'); 
$prod_for = set_value('prod_for');

$product_categories = $this->input->post('category_id');

$product_categories = !is_array($product_categories) ? array() : $product_categories;


$why_to_choose = $this->input->post('why_to_choose');
$why_to_choose = !is_array($why_to_choose) ? array() : $why_to_choose;

$detail_description = $this->input->post('detail_description');
$detail_description = !is_array($detail_description) ? array() : $detail_description;
?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>vendors" itemprop="url"><span itemprop="title">My Account</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Post Product/Service</strong></span></div>
  </div>
</div>
<div class="wrapper pt20 pb20" style="min-height:300px;">
  <?php $this->load->view('vendors/top_links');?>
  <div class="w90 auto mt30">
	<p class="fr mt1"><a href="<?php echo base_url();?>vendors/products" class="btn1 radius-20t" title="«Go Back">Go Back</a> </p>
	<h2 class="bb1 pb5">Post Product/Service</h2>
	<div class="p25 bg-gray1 border1 bb fs16 weight600">
	  <?php error_message();?>
	  <?php echo form_open_multipart('');?>
	  <div class="fl w32 short_form">
		<p>Type <b class="red">*</b></p>
		<p class="mt6 fls bg-white" style="width:100%">
		<label><input name="prod_type" type="radio" value="1" <?php echo $prod_type=='1' ? ' checked="checked"' : '';?>>
  Product</label>
		&nbsp;&nbsp;
		<label><input name="prod_type" type="radio" value="2"<?php echo $prod_type=='2' ? '  checked="checked"' : '';?>>
  Service</label>
		  <?php echo form_error('prod_type');?>
		</p>
	  </div>
	  <div class="fl w32 short_form ml16">
		<p>Product/Service Title <b class="red">*</b></p>
		<p class="mt6">
		  <input name="prod_title" type="text" class="p7" style="width:100%" value="<?php echo set_value('prod_title');?>">
		  <?php echo form_error('prod_title');?>
		</p>
	  </div>
	  <div class="fr w32 short_form ml10">
		<p>Image </p>
		<p class="mt6 fls bg-white" style="width:100%">
		  <input name="product_images1" type="file" style="width:100%; border:0">
		  <?php echo form_error('product_images1');?>
		</p>
	  </div>
	  <div class="cb mb15"></div>

	  <div class="fl w32 short_form">
		<p>Posting Service for <b class="red">*</b></p>
		<p class="mt6">
		  <select name="prod_for" class="p7" style="width:100%">
			<option value="">Select</option>
			<option value="1"<?php echo $prod_for=='1' ? '  selected="selected"' : '';?>>Individual</option>
			<option value="2"<?php echo $prod_for=='2' ? '  selected="selected"' : '';?>>Corporate/SME</option>
			<option value="3"<?php echo $prod_for=='3' ? '  selected="selected"' : '';?>>Both</option>
		  </select>
		  <?php echo form_error('prod_for');?>
		</p>
	  </div>
	  <div class="fl w32 short_form ml10">
		<p>Category <b class="red">*</b></p>
		<p class="mt6">
		  <select name="category_id[]" class="p7" style="width:100%">
			<option value="">Select</option>
			<?php echo get_nested_dropdown_menu($this->mres['ref_cat_id'],$product_categories);?>
		  </select>
		  <?php echo form_error('category_id[]');?>
		</p>
	  </div>
	  <div class="cb"></div>

	  <p class="mt15">Short Description <b class="red">*</b></p>
	  <div class="short_form mt6 mb15">
		<textarea name="short_description" cols="100" rows="3" class="p7" style="height:70px; width:100%"><?php echo set_value('short_description');?></textarea>
		<?php echo form_error('short_description');?>
	  </div>
	  <p class="mt15">Why to Choose This <b class="red">&nbsp;</b></p>
	  <div class="short_form mt6 mb15">
		<?php
		for($i=0;$i<=4;$i++)
		{
		  $loop_value = array_key_exists($i,$why_to_choose) ? $why_to_choose[$i] : '';
		?>
		  <div<?php echo $i>0 ? ' class="pt5"' : '';?>><input type="text" name="why_to_choose[]" value="<?php echo set_value('why_to_choose',$loop_value);?>" /></div>
		  <?php echo form_error("why_to_choose[$i]");?>
		<?php
		}
		?>
	  </div>
	  <div class="cb pb5"></div>

	  <p class="mt15">Detailed Description <b class="red">*</b></p>
	  <div class="short_form mt6 mb15">
		<?php
		for($i=0;$i<=9;$i++)
		{
		  $loop_value = array_key_exists($i,$detail_description) ? $detail_description[$i] : '';
		?>
		  <div<?php echo $i>0 ? ' class="pt5"' : '';?>><input type="text" name="detail_description[]" value="<?php echo set_value('detail_description',$loop_value);?>" /></div>
		  <?php echo form_error("detail_description[$i]");?>
		<?php
		}
		?>
	  </div>
	  <div class="cb pb5"></div>
	  <input name="sbt_btn" type="submit" value="Submit" class="btn3 radius-3 trans_eff">
	  <input name="btn_rst" type="reset" value="Reset" class="btn3x radius-3 trans_eff">
	  <?php echo form_close();?>
	</div>
	<div class="cb pb30"></div>
  </div>
</div>
<?php $this->load->view("bottom_application");?>