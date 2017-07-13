<div class="p10 border1">
  <p class="fl">Showing :
  <?php echo front_record_per_page('per_page1'); ?>
  </p>
  <p class="paging fr ar w60 mt2"><?php echo $page_links; ?></p>
  <div class="cb"></div>
</div>
<div class="mt10">
<?php
if(is_array($res) && !empty($res))
{
?>
  <table class="w100 tab-bdr2 fs13">
  <tr class="verd black fs12 b  lht-20">
	<td class="w10">S. No.</td>
	<td>Products</td>
	<td class="w15 ac">Remove</td>
  </tr>
  <?php
  $sl = $offset;
  foreach($res as $val)
  {
	$link_url = base_url().$val['friendly_url'];

	$discounted_price = floatval($val['product_discounted_price']);

	$param_media = array(
							  'where'=>"ref_id ='".$val['products_id']."' AND media_section='products' AND media_type='photo'"
							);

    $res_media = $this->product_model->get_media(1,0,$param_media);
  
	if(is_array($res_media) && !empty($res_media))
	{
	  $product_image = $res_media['media'];
	}
	else
	{
	  $product_image = "noimg.jpg";
	}
  ?>
	<tr>
	  <td> <?php echo ++$sl;?>.</td>
	  <td class="al"><p class="fs16 b"><a href="<?php echo $link_url;?>"> <b class="fl thm_cont mr10"><img src="<?php echo get_image('product/images',$product_image,'100','100','R'); ?>" alt="<?php echo escape_chars($val['product_alt']);?>" title="<?php echo escape_chars($val['product_alt']);?>"></b><?php echo $val['product_name'];?></a></p>
	  <p class="mt5 fs12">Code : <?php echo $val['product_code'];?></p>
	  <p class="black fs15 mt2">Price:
	  <?php
	  if($discounted_price > 0)
	  {
	  ?> 
		<span class="gray through"><?php echo display_price($val['product_price']);?></span> <b class="red"><?php echo display_price($val['product_discounted_price']);?></b>
	  <?php
	  }
	  else
	  {
	  ?>
		<b class="red"><?php echo display_price($val['product_price']);?></b>
	  <?php
	  }
	  ?>
	  </p>
	  <p class="mt10 fs12 gray">Added On : <?php echo date("d/m/Y",strtotime($val['wishlists_date_added']));?></p></td>
	  <td class="ac"><a href="<?php echo base_url();?>members/remove_wislist/<?php echo $val['wishlists_id'];?>" title="Remove Record" onclick="return confirm('Are you sure you want to remove this product from wislist');"><img src="<?php echo theme_url();?>images/m-no.png" width="20" height="24" alt=""></a></td>
	</tr>
  <?php
  }
  ?>
  </table>
<?php
}
?>
</div>
<div class="p10 border1">
  <p class="fl">Showing :
	<?php echo front_record_per_page('per_page2'); ?>
  </p>
  <p class="paging fr ar w60 mt2"><?php echo $page_links; ?></p>
  <div class="cb"></div>
</div>