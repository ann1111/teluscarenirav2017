<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
$qstring = $category_type != '' ? "?type=".$category_type : "";
if($category_type == 'buy')
{
  $bd_category_link = "wanted-to-buy";

  $product_type =  1;

  $view_all_title = "View All Products";
}
elseif($category_type == 'sell')
{
  $bd_category_link = "available-for-sale";

  $product_type =  2;

  $view_all_title = "View All Products";
}
if($category_type == 'rental')
{
  $bd_category_link = "rental-services";

  $product_type =  3;

  $view_all_title = "View All Services";
}
?>
<!--body-->
<div class="container">
  <p class="breadcrumb"><a href="<?php echo base_url();?>"><img src="<?php echo theme_url();?>images/tree-home.png" alt="" class="vat"></a> 
  <a href="<?php echo base_url().$bd_category_link;?>">Categories</a>
  <?php
  $catid = $this->meta_info['entity_id'];
  if($catid )
  {
	   echo category_breadcrumbs($catid,$catid);
	   
  }
  ?>
  </p>

  <div class="p10">

	<div class="bg-line mb15">
	  <div class="bg-heading"><h1><?php echo $heading_title;?></h1></div>
	  <p class="cb"></p>
	</div>

	<?php echo form_open("",'id="myform" method="post" ');?>
	<input type="hidden" name="per_page" value="<?php echo $this->input->post('per_page');?>">
	<input type="hidden" name="offset" id="pg_offset" value="0">
	<?php echo form_close();?>

	<div id="my_data">
	<?php
	if(is_array($res) && !empty($res))
	{
	?>
	  <div class="fs11">
		<p class="fl paging"><?php echo $page_links; ?></p>
		<p class="fr">Show Results :
		  <?php echo front_record_per_page('per_page1'); ?>
		</p>
		<p class="cb"></p>
	  </div>

	  <div>
		<?php
		foreach($res as $val)
		{
		  $total_subcategories = $val['total_subcategories'];	

		  $link_url = base_url().$val['friendly_url'].$qstring;	

		  /*if($total_subcategories>0)
		  {	
			  
			$link_url = base_url().$val['friendly_url'].$qstring;	

		  }else
		  {			
			$link_url = base_url()."products/index/".$val['category_id'].$qstring;	
		  }*/

		  

		  $total_products = count_products("AND product_type='".$product_type."' AND a.status='1' AND a.mem_status='1' AND b.status='1' AND FIND_IN_SET('".$val['category_id']."',c.category_links)");
 
		?>
		  <div class="fl w30 m5 p10 bdr2 shadow radius-10">    
			<p class="blue"><a href="<?php echo $link_url;?>"><?php echo ucwords(char_limiter($val['category_name'],45));?></a></p>
			<p class="fs12">(<?php echo $total_products;?> Items)</p>
			<p class="mt5 yel"><a href="<?php echo $link_url;?>"><?php echo $view_all_title;?></a></p>
		  </div>
		<?php
		}
		?>

		<p class="cb"></p>

	  </div>  


	  <p class="cb"></p>

	  <div class="fs11 mt15 mb10">
		<p class="fl paging"><?php echo $page_links; ?></p>
		<p class="fr">Show Results :
		  <?php echo front_record_per_page('per_page2'); ?>
		</p>
		<p class="cb"></p>
	  </div>
	<?php
	}
	else
	{	
	  echo '<p class="ac b">'.$this->config->item('no_record_found').'</p>';	
	}
	?>
	</div>
  </div>
  <script>
  jQuery(document).ready(function(e) {
	jQuery('[id ^="per_page"]').live('change',function(){	
		  per_page_val = jQuery(this).val();	
		  $("[id ^='per_page'] option[value=" + per_page_val + "]").attr('selected', 'selected');
		  $(":hidden[name='per_page']","#myform").val(per_page_val);
		  jQuery('#myform').submit();
	  });	
  });
  </script>
</div>
<!--body end-->
<?php $this->load->view("bottom_application");?>