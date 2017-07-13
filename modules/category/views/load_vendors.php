<?php
if(is_array($res) && !empty($res))
{

  foreach($res as $val)
  {
	$link_url = base_url().$val['friendly_url'];

	?>
	<div class="part_cont2 img_scale2 xitemContainer">
	  <div class="part_pc fl">
		<figure><a href="<?php echo $link_url;?>" title="<?php echo escape_chars($val['company_name']);?>"><img src="<?php echo get_image('company_logos',$val['company_logo'],'170','90','R'); ?>" alt="<?php echo escape_chars($val['company_name']);?>"></a></figure>
	  </div>
	  <div class="fr w73 al">
		<p class="blue1 fs16 weight700 lht-18"><a href="<?php echo $link_url;?>" title="<?php echo escape_chars($val['company_name']);?>" class="uo"><?php echo $val['company_name'];?></a></p>
		<p class="fs13 mt6 lht-16" style="height:30px;overflow:hidden;min-height:30px;"><?php echo $val['short_description'];?></p>
		<a href="<?php echo $link_url;?>" class="btn1s trans_eff mt10 auto" title="View Details">View Details</a>			</div>
	  <div class="cb"></div>
	</div>
  <?php
  }	
}