<?php
if(is_array($res) && !empty($res))
{
  $ix = 0;
  $to_show = 4;
  foreach($res as $val)
  {
	$link_url = base_url().$val['friendly_url'];

	$excls = $ix%$to_show > 0 ? 'ml5' : '';

	?>
	<div class="pro_cont ac img_scale2 fl <?php echo $excls;?> xitemContainer">
	  <div class="pro_pc">
		<div class="pro_pc2">
		  <figure><a href="<?php echo $link_url;?>" title="<?php echo escape_chars($val['prod_title']);?>"><img src="<?php echo get_image('product/images',$val['product_image'],'175','120','R'); ?>" alt="<?php echo escape_chars($val['product_alt']);?>"></a></figure>
		</div>
	  </div>
	  <p class="mt5 blue1 fs15 weight700 mnht_36 lht-18"><a href="<?php echo $link_url;?>" title="<?php echo escape_chars($val['prod_title']);?>" class="uo"><?php echo char_limiter($val['prod_title'],40);?></a></p>
	  <p class="fs12 mt7 lht-14 black mnht_48" style="height:48px;overflow:hidden;"><?php echo char_limiter($val['short_description'],80);?></p>
	  <a href="<?php echo $link_url;?>" class="btn1s trans_eff mt7 auto" title="View Details">View Details</a>
	</div>
	<!-- list 1 -->
	<?php
	$ix++;
	if($ix%$to_show==0)
	{
	?>
	  <div class="cb pb30 bb2 mb30"></div>
  <?php
	}
  }
  if($ix%$to_show > 0)
  {
	echo '<div class="cb pb30 bb2 mb30"></div>';
  }	
}