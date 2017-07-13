<?php
if(is_array($res) && !empty($res))
{

  foreach($res as $val1)
  {
	$link_url1 = base_url().$val1['friendly_url']."/".$this->config->item('cat_vendor_url_suffix');

	?>
	<li class="xitemContainer">
	  <p class="cat_ttl"><b><?php echo ucfirst(substr(trim($val1['category_name']),0,1));?></b> 
	  <a href="<?php echo $link_url1;?>" title="<?php echo escape_chars($val1['category_alt']);?>"><?php echo char_limiter($val1['category_name'],40);?></a>
	  </p>
	</li>
  <?php
  }	
}