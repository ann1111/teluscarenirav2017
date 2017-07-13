<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<?php
	if($fetch_type == 'category')
	{
	?> 
	  <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>category/<?php echo $cat_type;?>" itemprop="url"><span itemprop="title">Products by Category</span></a></div>
	<?php
	  echo category_breadcrumbs($cat_id,$cat_id,$cat_type);
	}
	else
	{
	?>
	  <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong><?php echo $heading_title;?></strong></span></div>
	<?php
	}
	?> 
  </div>
</div>
<div class="wrapper pt30">
  <div class="fl w78">
	<h1 class="bb1">Our Products/Services</h1>
	<div class="mt30">
	  <?php
	  if(is_array($res) && !empty($res))
	  {
		$data['res_products'] = $res;
	  ?>
		<div id="xlistContainer">
		  <?php $this->load->view('products/load_products',$data);?>
		</div>	
		<p class="ac mt20 dn" id="loadingdiv"><img src="<?php echo theme_url();?>images/ajax-loader.gif" width="128" height="15" alt=""><br><br></p>
		<script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>

		<?php echo form_open("",'id="myform" method="post" ');?>
		<input type="hidden" name="srch_keyword" value="<?php echo $this->input->get_post('srch_keyword');?>">
		<input type="hidden" name="cat_id" value="<?php echo $this->input->get_post('cat_id');?>">
		<input type="hidden" name="search" value="<?php echo $this->input->get_post('search');?>">
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
	  <div class="cb"></div>
	</div>

	<!-- listing ends -->
	<br>
	<br>
  </div>
  <!-- left ends -->
  <div class="fr w200px mt3">
	<?php
	$category_content = get_db_field_value('wl_cms_pages','page_description',"WHERE friendly_url='category-content' AND status='1'");
	?>
	<div><?php echo $category_content;?></div>
	<a href="<?php echo base_url();?>category" class="btn1 mt15 trans_eff">All Categories <img src="<?php echo theme_url();?>images/arb1.png" class="ml10 mr-10" alt=""></a> 

	<!-- category ends -->
	<div class="cb bb1 pb15 mb15"></div>
	<?php $this->load->view('banner/right_banner');?>
  </div>
  <!-- right ends -->

  <div class="cb"></div>
</div>
<?php $this->load->view("bottom_application");?>