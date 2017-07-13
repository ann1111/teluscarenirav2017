<?php
if(is_array($res) && !empty($res))
{
  foreach($res as $val)
  {
	$actual_deformated_text = strip_tags($val['testimonial_description']);

	$limit_deformated_text = char_limiter($val['testimonial_description'],300);
   ?>
	<div class="t_box xitemContainer">
	  <div class="fr t_text mr10">
		<?php
		if(strlen($actual_deformated_text) == strlen($limit_deformated_text))
		{
		?>
		<div class="fq_text"><?php echo $val['testimonial_description'];?></div>
		<?php
		}
		else
		{
		?>
		  <div class="fq_text less_det"><?php echo $limit_deformated_text;?></div>
		  <div class="fq_text more_det dn"><?php echo $val['testimonial_description'];?></div>
		  <a href="javascript:void(0)" class="mt15 dib uu mr_links"></a>
		<?php
		}
		?>
		<p class="mt13 ml15 black fs16"><b>-- <?php echo $val['poster_name'];?></b> <span class="gray fs14 ml10"><?php echo date("d F,Y",strtotime($val['posted_date']));?></span></p>
	  </div>
	  <div class="cb"></div>
	</div>
  <?php
  }
}