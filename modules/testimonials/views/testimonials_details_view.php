<?php $this->load->view('top_application'); ?>
<?php $this->load->view('project_header'); ?>
<div class="tree minmax">
  <div class="wrapper"> YOUR ARE HERE : 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title"><img src="<?php echo theme_url();?>images/hm.png" class="vam pb3" alt=""></span></a></div>   
	<b>&gt;</b> 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>testimonials" itemprop="url"><span itemprop="title">Testimonials</span></a></div>   
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong><?php echo $res['poster_name'];?></strong></span></div>
  </div>
</div>
<section class="minmax mid_shed">
  <div class="wrapper pt30 cms_area">
	<h1><?php echo $res['poster_name'];?></h1>
	<div class="fl w75">
	  <div class="t_box">
		<div class="t_text"><?php echo htmlspecialchars_decode($res['testimonial_description']);?></div>
		<p class="black mt10"><b><?php echo $res['poster_name'];?></b></p>
		<p class="gray"><?php echo date("d F,Y",strtotime($res['posted_date']));?></p>
	  </div>
	  <p class="gray1 b mt10"><a href="<?php echo base_url();?>testimonials" class="uu">&lt;&lt; Go Back</a></p>
	</div>
	<div class="fr w280px">   
	  <?php echo $this->load->view('banner/right_banner');?>
	</div>
	<div class="cb bb pb20"></div>
  </div>
</section>
<?php $this->load->view('bottom_application'); ?>