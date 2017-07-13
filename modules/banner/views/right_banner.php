<?php
$this->load->helper(array('string','text'));
$limit = isset($limit) ? $limit : 2;
$banner_left_array = array();
$sql = "SELECT * FROM wl_banners WHERE banner_image!='' AND status='1' AND banner_position = 'Right'  AND (ISNULL(banner_end_date) OR banner_end_date >= NOW() ) ORDER BY  RAND() LIMIT $limit";
$query = $this->db->query($sql);
if($query->num_rows() > 0)
{
  $result_banner = $query->result_array();
  foreach($result_banner as $val)
  {
	if($val['banner_image']!='' && file_exists(UPLOAD_DIR."/banner/".$val['banner_image']))
	{ 
	  array_push($banner_left_array,$val);
	}
  }
}
if(!empty($banner_left_array))
{

  foreach($banner_left_array as $key=>$val)
  {

	$cls_banner = $key==0 ? 'ac' : 'ac mt20';
	$ban_title =  '';

	$link_ban = ($val['banner_url']!='' ) ? $val['banner_url'] : ""; 
	if($link_ban!='')
	{
	  $link_ban = !preg_match("~^http~",$link_ban) ? "http://".$link_ban : $link_ban;
	}
	if($link_ban!='')
	{
	  ?>
	  <a href="<?php echo $link_ban;?>" target="_blank" alt="<?php echo escape_chars($val['banner_alt']);?>" title="<?php echo escape_chars($val['banner_alt']);?>" ><img src="<?php echo get_image('banner',$val['banner_image'],'245','328','R'); ?>" class="db w100 <?php echo $cls_banner;?>" /></a>
  <?php
	}
	else
	{
	?>
	  <p alt="<?php echo escape_chars($val['banner_alt']);?>" title="<?php echo escape_chars($val['banner_alt']);?>"><img src="<?php echo get_image('banner',$val['banner_image'],'245','328','R'); ?>"  class="db w100 <?php echo $cls_banner;?>" /></p>
	<?php
	}
  }
}