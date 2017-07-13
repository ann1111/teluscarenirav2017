<?php
if(is_array($res) && !empty($res))
{

  foreach($res as $val1)
  {
	$total_subcategories = $val1['total_subcategories'];	
	$link_url1 = base_url().$cat_type."/".$val1['friendly_url'];

	?>
	<li class="xitemContainer">
	  <p class="cat_ttl"><b><?php echo ucfirst(substr(trim($val1['category_name']),0,1));?></b> 
	  <?php
	  if($total_subcategories > 0)
	  {
	  ?>
		<?php echo char_limiter($val1['category_name'],40);?>
	  <?php
	  }
	  else
	  {
	  ?>
		<a href="<?php echo $link_url1;?>" title="<?php echo escape_chars($val1['category_alt']);?>"><?php echo char_limiter($val1['category_name'],40);?></a>
	  <?php
	  }
	  ?>
	  </p>
	  <?php
	  if($total_subcategories > 0)
	  {
		$header_subcat1_qry = $this->db->select('category_name,friendly_url,category_alt,category_id')->limit(60)->get_where('wl_categories',array('parent_id'=>$val1['category_id'],'status'=>'1'));

		$header_subcat1_res = $header_subcat1_qry->result_array();
	  ?>
	  <p class="catlist mt10 osons ml40">
	   <?php
		foreach($header_subcat1_res as $key2=>$val2)
		{
		  $link_url2 = base_url().$cat_type."/".$val2['friendly_url'];
		?>
		  <a href="<?php echo $link_url2;?>" title="<?php echo escape_chars($val2['category_name']);?>" ><?php echo char_limiter($val2['category_name'],40);?></a>
		<?php
		}
		?>
	   <!--a href="<?php echo $link_url1;?>"  class="b">View All</a-->
		</p>
	  <?php
	  }
	  ?>
	</li>
  <?php
  }	
}