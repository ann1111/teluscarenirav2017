<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<div class="tree minmax">
  <div class="wrapper"> YOUR ARE HERE : 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title"><img src="<?php echo theme_url();?>images/hm.png" class="vam pb3" alt=""></span></a></div>   
	<b>&gt;</b>   
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong>Thank You</strong></span></div>
  </div>
</div>

<!-- MIDDLE STARTS -->


<section class="minmax mid_shed">
  <div class="wrapper pt30 cms_area">
	<div>
	  <h1>Thank You</h1>
	  <br>
	  <p><img src="<?php echo theme_url();?>images/thankyou.jpg" width="306" height="211" alt=""></p>
	  <div><?php echo  $this->session->flashdata('msg');?> </div>
	</div>
  </div>
</section>
<?php $this->load->view("bottom_application");?>