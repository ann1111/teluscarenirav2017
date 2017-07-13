<?php
if(is_array($res) && !empty($res) )
{
  foreach($res as $val)
  {
	$link_url = base_url().$val['friendly_url'];
  ?>
	<li class="xitemContainer">
	  <div class="cat-w">
		<div class="cat-img"><figure><a href="<?php echo $link_url;?>"><img src="<?php echo get_image('category',$val['category_image'],'280','187','R'); ?>" alt=""></a></figure></div>
		<div class="roboto-slab fs18 black ac p15"><a href="<?php echo $link_url;?>" title="<?php echo escape_chars($val['category_name']);?>" ><?php echo char_limiter($val['category_name'],45);?></a></div>
	  </div>
	</li>
<?php
  }
}