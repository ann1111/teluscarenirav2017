<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Thanks</strong></span></div>
  </div>
</div>
<div class="wrapper cms_area pt30 mb30">
  <h1 class="bb1 pb5">Thanks</h1>
  <div class="red"><?php echo  $this->session->flashdata('msg');?></div>
  <div class="cb pb10"></div>
</div>
<?php $this->load->view("bottom_application");?>