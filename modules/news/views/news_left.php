<?php
$this->load->model('news/news_model');
$param = array('status'=>'1');	
$res_array = $this->news_model->get_news(1,0,$param);
$total_news = get_found_rows();	
if($total_news > 0)
{
  $news_result = array($res_array);
  ?>
<div class="mt23 pl8 pr8">
<p class="fl"><img src="<?php echo theme_url();?>images/news.jpg" alt="" class="vam"></p>
<p class="fr white w80 lh18px fs18">News &amp; Events</p>
<p class="cb"></p>
<div class="news-scroll">
<ul class="gal white">
<?php
foreach($news_result as $val)
{
  $news_links = base_url().$val['friendly_url'];
?>
<li><p class="mt8 fs14 ml3"><a href="<?php echo $news_links;?>" class="blue_hov" title="<?php echo escape_chars($val['news_title']);?>" alt="<?php echo escape_chars($val['news_title']);?>"><?php echo char_limiter($val['news_title'],20);?></a></p>
<p class="mt5 lh15px ml3"><?php echo char_limiter($val['news_description'],150);?></p></li>
<?php
}
?>
</ul>
</div>
<p class="mt9 ml3"><a href="<?php echo base_url();?>news" class="btn">See All</a></p>
</div>
<p class="bb mt24 ml15 mr15"></p>
<p class="bb mt3 ml15 mr15"></p>
<?php
}