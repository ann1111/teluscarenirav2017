<?php
if(is_array($res) && !empty($res))
{
  foreach($res as $val)
  {
  ?>
	<div class="fq_box mt20 xitemContainer">
	  <p class="fq_ttl"><?php echo $val['faq_question'];?></p>
	  <div class="fq_text">
		<div><?php echo $val['faq_answer'];?></div>
	  </div>
	</div>
  <?php
  }
}