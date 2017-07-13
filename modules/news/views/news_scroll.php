<?php
$this->load->model('news/news_model');
$param = array('status'=>'1');	
$res_array = $this->news_model->get_news(5,0,$param);
$total_news = get_found_rows();	
if($total_news > 0)
{
  $visible_news = 1;
  $show_scroll = $total_news > $visible_news ? TRUE : FALSE;
?>
<div class="mt10 news_tab radius-8 p15 pt10 pb10" style="min-height:227px;">
  <p class="b fs11 fr white mt15"><a href="<?php echo base_url();?>news" class="underline">View All</a></p>
  <h2>News &amp; Events</h2>
  <div class="white mt10 o-hid" style="height:130px;">
	<div<?php echo $show_scroll===TRUE ? ' class="scroll_1"' : '';?>>
	  <ul class="myulx">
		<?php
		foreach($res_array as $v)
		{
		  $news_links = base_url()."news/details/".$v['news_id'];
		?>
		<li>
		  <p class="b fs13"><a href="<?php echo $news_links;?>" class="undr"><?php echo char_limiter($v['news_title'],50);?></a></p>
		  <p class="blue fs12"> <?php echo date("M d,Y",strtotime($v['recv_date']));?></p>
		  <div class="fs13 mt3 lht-17 white"><?php echo char_limiter($v['news_description'],550);?></div>
		</li>
		<?php
		}
		?>
	  </ul>
	</div>
  </div>
  <?php
  if($show_scroll === TRUE)
  {
  ?> 
  <p class="aro_cont auto radius-5 mt5">
	<a href="javascript:void(0)" class="prev2 fl"><img src="<?php echo theme_url(); ?>images/arl.png" class="db" alt=""></a> 
	<a href="javascript:void(0)" class="next2 fr"><img src="<?php echo theme_url(); ?>images/arr.png" class="db" alt=""></a>
  </p>
  <?php
  }
  ?>
</div>
<?php
}
?>