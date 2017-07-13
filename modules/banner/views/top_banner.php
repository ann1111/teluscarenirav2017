<?php
$this->load->helper(array('string','text'));
$banner_array = array();
$sql = "SELECT * FROM wl_banners WHERE banner_image!='' AND status='1' AND banner_position = 'Top' AND banner_page = 'common'  AND (ISNULL(banner_end_date) OR banner_end_date >= NOW() ) ORDER BY  RAND() LIMIT 2";
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
  foreach($banner_array as $key=>$val)
  {

	$cls_banner = $key==0 ? 'fr' : 'fr mr10';
	$ban_title =  '';

	$link_ban = ($val['banner_url']!='' ) ? $val['banner_url'] : ""; 
	if($link_ban!='')
	{
	  $link_ban = !preg_match("~^http~",$link_ban) ? "http://".$link_ban : $link_ban;
	}
	if($link_ban!='')
	{
	  ?>
	  <div class="<?php echo $cls_banner;?>"><a href="<?php echo $link_ban;?>" target="_blank"><img src="<?php echo get_image('banner',$val['banner_image'],'341','75','R'); ?>" alt="<?php echo escape_chars($ban_title);?>" title="<?php echo escape_chars($ban_title);?>" width="341" height="75"   /></a></div>
  <?php
	}
	else
	{
	?>
	  <div class="<?php echo $cls_banner;?>"><img src="<?php echo get_image('banner',$val['banner_image'],'341','75','R'); ?>" alt="<?php echo escape_chars($ban_title);?>" title="<?php echo escape_chars($ban_title);?>" width="341" height="75"   /></div>
	<?php
	}
  }
	
}