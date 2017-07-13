<?php $this->load->view('top_application'); ?>
<?php $this->load->view('project_header'); ?>
<!--body-->
<div class="container">
  <p class="breadcrumb"><a href="<?php echo base_url();?>"><img src="<?php echo theme_url();?>images/tree-home.png" alt="" class="vat"></a> <a href="<?php echo base_url();?>news">News &amp; Events</a> <?php echo char_limiter($res['news_title'],150);?></p>

  <div class="p10">

	<div class="bg-line mb15">
	  <div class="bg-heading"><h1>News &amp; Events</h1></div>
	  <p class="cb"></p>
	</div>


	<div class="p10 bb">
	  <div class="fr w92 mb10 pr10">
		<p class="yel fs17"><?php echo $res['news_title'];?></p>
		<p>( <?php echo date("F d, Y",strtotime($res['recv_date']));?> )</p>   
		<div class="lh18px aj mt10"><?php echo $res['news_description'];?></div>			
	  </div>
	  
	  <img src="<?php echo theme_url();?>images/col.jpg" alt="" class="mt10">
	  <p class="cb"></p>
	  <p class="wine ml32 mt20 fs11 b tahoma bt pt15"><a href="<?php echo base_url();?>news" class="underline">&lt;&lt; Back to News</a></p>
	</div>
  </div>
</div>
<!--body end-->
<?php $this->load->view('bottom_application'); ?>