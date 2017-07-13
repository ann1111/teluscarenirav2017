<?php
$this->load->helper(array('string','text'));
$banner_bottom_array = array();
$sql = "SELECT * FROM wl_banners WHERE banner_image!='' AND status='1' AND banner_position = 'Bottom' AND banner_page = 'common' AND (ISNULL(banner_end_date) OR banner_end_date >= NOW() ) ORDER BY  RAND() LIMIT 2";
$query = $this->db->query($sql);
if($query->num_rows() > 0)
{
  $result_banner = $query->result_array();
  foreach($result_banner as $val)
  {
	if($val['banner_image']!='' && file_exists(UPLOAD_DIR."/banner/".$val['banner_image']))
	{ 
	  array_push($banner_bottom_array,$val);
	}
  }
}
if(!empty($banner_bottom_array))
{
  ?>
  <div class="wrapper pt15">
	<p class="adv_ttl ac"><span class="dib bg-white ttu fs12 pl4 pr4 lht-17 gray">ADVERTISEMENT</span></p>
	<?php
	foreach($banner_bottom_array as $key=>$val)
	{
	  $cls_banner = $key==0 ? 'class="db fl mt10"' : 'class="db fr mt10"';

	  $ban_title =  '';
	  
	  $link_ban = ($val['banner_url']!='' ) ? $val['banner_url'] : ""; 
	  if($link_ban!='')
	  {
		$link_ban = !preg_match("~^http~",$link_ban) ? "http://".$link_ban : $link_ban;
	  }
	  if($link_ban!='')
	  {
		?>
		<a href="<?php echo $link_ban;?>" target="_blank"><img src="<?php echo get_image('banner',$val['banner_image'],'469','90','R'); ?>" alt="<?php echo escape_chars($ban_title);?>" title="<?php echo escape_chars($ban_title);?>" width="469" height="90" <?php echo $cls_banner;?> /></a>
	<?php
	  }
	  else
	  {
	  ?>
		<img src="<?php echo get_image('banner',$val['banner_image'],'469','90','R'); ?>" alt="<?php echo escape_chars($ban_title);?>" title="<?php echo escape_chars($ban_title);?>" width="469" height="90" <?php echo $cls_banner;?> />
	  <?php
	  }
	}
	?>
	<div class="cb"></div>
  </div>
<?php
}