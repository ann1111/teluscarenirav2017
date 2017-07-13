<?php
$this->load->helper(array('string','text'));
$banner_left_array = array();
$sql = "SELECT * FROM wl_banners WHERE banner_image!='' AND status='1' AND banner_position = 'Left' AND banner_page='".$this->page_section_ct."'  AND (ISNULL(banner_end_date) OR banner_end_date >= NOW() ) ORDER BY  RAND() LIMIT 1";
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

	$cls_banner = $key==0 ? 'ac mt30' : 'ac mt30';
	$ban_title =  '';

	$link_ban = ($val['banner_url']!='' ) ? $val['banner_url'] : ""; 
	if($link_ban!='')
	{
	  $link_ban = !preg_match("~^http~",$link_ban) ? "http://".$link_ban : $link_ban;
	}
	if($link_ban!='')
	{
	  ?>
	  <p class="<?php echo $cls_banner;?>"><a href="<?php echo $link_ban;?>" target="_blank" alt="<?php echo $val['banner_alt'];?>" title="<?php echo $val['banner_alt'];?>"><img src="<?php echo get_image('banner',$val['banner_image'],'230','629','R'); ?>" class="db w100" /></a></p>
  <?php
	}
	else
	{
	?>
	  <p class="ac mt30" alt="<?php echo $val['banner_alt'];?>" title="<?php echo $val['banner_alt'];?>"><img src="<?php echo get_image('banner',$val['banner_image'],'230','629','R'); ?>" class="db w100" /></p>
	<?php
	}
  }
}