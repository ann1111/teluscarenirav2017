<?php
$this->load->helper(array('string','text'));
$banner_array = array();
$sql = "SELECT * FROM wl_banners WHERE banner_image!='' AND status='1' AND banner_position = 'Middle'  AND (ISNULL(banner_end_date) OR banner_end_date >= NOW() ) ORDER BY  RAND() LIMIT 1";
$query = $this->db->query($sql);
if($query->num_rows() > 0)
{
  $result_banner = $query->result_array();
  foreach($result_banner as $val)
  {
	if($val['banner_image']!='' && file_exists(UPLOAD_DIR."/banner/".$val['banner_image']))
	{ 
	  array_push($banner_array,$val);
	}
  }
}

if(!empty($banner_array))
{
	$calling_controller = $this->router->fetch_class();

	$width_banner = $calling_controller == 'property' ? 746 : 968;

	$height_banner = 120;


	foreach($banner_array as $key=>$val)
	{

	  $cls_banner = $key==0 ? 'ac' : 'ac mt10';
	  $ban_title =  '';

	  $link_ban = ($val['banner_url']!='' ) ? $val['banner_url'] : ""; 
	  if($link_ban!='')
	  {
		$link_ban = !preg_match("~^http~",$link_ban) ? "http://".$link_ban : $link_ban;
	  }
	  if($link_ban!='')
	  {
		?>
		<div class="mt16 ac radius-5"><a href="<?php echo $link_ban;?>" target="_blank"><img src="<?php echo get_image('banner',$val['banner_image'],$width_banner,$height_banner,'R'); ?>" alt="<?php echo escape_chars($ban_title);?>" title="<?php echo escape_chars($ban_title);?>" width="<?php echo $width_banner;?>" height="<?php echo $height_banner;?>"   /></a></div>
	<?php
	  }
	  else
	  {
	  ?>
		<div class="mt16 ac radius-5"><img src="<?php echo get_image('banner',$val['banner_image'],$width_banner,$height_banner,'R'); ?>" alt="<?php echo escape_chars($ban_title);?>" title="<?php echo escape_chars($ban_title);?>" width="<?php echo $width_banner;?>" height="<?php echo $height_banner;?>"   /></div>
	  <?php
	  }
	}
}