<?php $ci_obj=&get_instance();?>
<?php $ci_obj->load->view("top_application");?>
<?php $ci_obj->load->view('project_header'); ?>
<!--body-->
<div class="container">
  <p class="breadcrumb"><a href="<?php echo base_url();?>"><img src="<?php echo theme_url();?>images/tree-home.png" alt="" class="vat"></a> 404</p>

  <div class="p10">

	<div class="bg-line mb15">
	  <div class="bg-heading"><h1>404</h1></div>
	  <p class="cb"></p>
	</div>


	<div class="p15 ac">
	  <span class="red arl pt5 fs18 db verd">OOPS!! Page requested not found </span>
	  <p class="cb"></p>
	</div>
  </div>

</div>
<!--body end-->
<?php $ci_obj->load->view("bottom_application");?>