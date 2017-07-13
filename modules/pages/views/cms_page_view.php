<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong><?php echo $content['page_name'];?></strong></span></div>
  </div>
</div>
<div class="wrapper cms_area pt30 mb30" style="min-height:200px;">
  <h1 class="bb1 pb5"><?php echo $content['page_name'];?></h1>
  <div><?php echo $content['page_description'];?></div>
</div>
<?php $this->load->view("bottom_application");?>