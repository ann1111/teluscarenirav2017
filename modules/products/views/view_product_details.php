<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
$quot_content = get_db_field_value('wl_cms_pages','page_description'," WHERE friendly_url='request-quotation' AND status='1'");

if($res['prod_for']==3)
{
  $cat_type = $this->config->item('individual_url_prefix');
}
elseif($res['prod_for']==2)
{
  $cat_type = $this->config->item('corporate_url_prefix');
}
else
{
  $cat_type = $this->config->item('individual_url_prefix');
} 
?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>category/<?php echo $cat_type;?>" itemprop="url"><span itemprop="title">Category</span></a></div>
	<?php	
echo category_breadcrumbs($res['category_id'],'',$cat_type);?>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong><?php echo $res['prod_title'];?></strong></span></div>
  </div>
</div>
<div class="wrapper pt30">
  <?php error_message();?>
  <a href="#" class="btn2 pl30 pr30 mt12 fr radius-3 shadow1 quot">Request for Quotation</a><h1><?php echo $res['prod_title'];?></h1>
  <p>Type : <?php echo get_product_type($res['prod_type']);?></p>

  <div class="mt15 p15 border1 bb">
	<div class="pro_pc_b fl mr15 mb10">
	  <figure><img src="<?php echo get_image('product/images',$res['product_image'],'350','240','R'); ?>" alt="<?php echo escape_chars($res['product_alt']);?>"></figure>
	</div>
	<div>
	
	</div>
	<div class="cb"></div>
  </div>

  <div class="border1 mt10 bg-gray1 p10">
	<div class="fl w49 p10">
	  <?php
	  if(!is_null($res['why_to_choose']))
	  {
		$why_us_arr = unserialize($res['why_to_choose']);
		?>
		<p class="fs16 b black ">Why to Choose This ?</p>
		<div class="mylist2 mt10 ml10" style="min-height:170px">
		  <?php
		  foreach($why_us_arr as $val)
		  {
		  ?>
			<p><?php echo $val;?></p>
		  <?php
		  }
		  ?>
		</div>
	  <?php
	  }
	  ?>
	</div>
	<div class="fr w49 p10">
	  <?php
	  if(!is_null($res['detail_description']))
	  {
		$detail_description_arr = unserialize($res['detail_description']);
		?>
		<p class="fs16 b black">Detail of this Product</p>
		<div class="mylist2 mt10 ml10" style="min-height:170px">
		  <?php
		  foreach($detail_description_arr as $val)
		  {
		  ?>
			<p><?php echo $val;?></p>
		  <?php
		  }
		  ?>
		</div>
	  <?php
	  }
	  ?>	
	</div>
	<div class="cb"></div>
  </div>
  <?php
  if(is_array($vendor_res) && !empty($vendor_res))
  {
	$vendor_res = $vendor_res[0];
	$vendor_url = base_url().$vendor_res['friendly_url'];
  ?>
	<div class="bg-gray2 border2 p15">
	  <p class="fs14 b ttu mb7"><?php echo $vendor_res['company_name'];?></p>
	  <div class="part_pc fr">
		<figure><img src="<?php echo get_image('company_logos',$vendor_res['company_logo'],'170','90','R'); ?>" alt="<?php echo escape_chars($vendor_res['company_name']);?>"></figure>
	  </div>
	  <div class="fl w80 al">
		<p class="blue1 fs16 weight700 lht-18"><a href="<?php echo $vendor_url;?>" title="<?php echo escape_chars($vendor_res['company_name']);?>" class="uo"><?php echo $vendor_res['company_name'];?></a></p>
		<p class="fs13 mt2 lht-16"><?php echo $vendor_res['short_description'];?></p>
		<a href="<?php echo $vendor_url;?>" class="btn1s trans_eff mt10 auto" title="View Details">View Details</a> 
	  </div>
	  <div class="cb"></div>
	  <div class="cb"></div>
	</div>
  <?php
  }
  ?>
  <div class="fr w25 mt30"> 
	<?php $this->load->view('banner/right_banner');?>
  </div>

  <!-- left ends -->

  <div class="fl w70 mt25">
	<h2 class="blue fs20">Other Services for this Vendor</h2>
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
	  ?>
	</div>

	<!-- listing ends -->
  </div>
  <!-- right ends -->
  <div class="cb"></div>

  <a id="pop_inline" class="dn" href="#inlinedata" title="Alert">Inline Pop</a>
  <div class="dn">
	<div id="inlinedata">
	  <div><?php echo $quot_content;?></div>
	  <div class="pt10">
		<button class="xcontinue">Continue</button>&nbsp;&nbsp;<button class="xcancel">Cancel</button>
	  </div>
	</div>
  </div>
  <script type="text/javascript">
  $(document).ready(function(){
	$('.quot').click(function(e){
	  e.preventDefault();
	  $('#pop_inline').fancybox().trigger('click');
	});
	$('.xcancel').click(function(){
	  setTimeout(function(){ window.location.href='<?php echo base_url();?>usp';},200);
	  $('.fancybox-close').click();
	});
	$('.xcontinue').click(function(){
	  window.location.href='<?php echo base_url();?>products/request_quotation/<?php echo $res['products_id'];?>';
	});
  });
  </script>
</div>
<?php $this->load->view("bottom_application");?>