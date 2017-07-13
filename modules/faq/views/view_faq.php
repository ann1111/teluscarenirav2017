<?php $this->load->view('top_application'); ?>
<?php $this->load->view('project_header'); ?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>FAQ's</strong></span></div>
  </div>
</div>
<div class="wrapper pt30">
  <div class="fl w78">
	<h1 class="bb pb5">FAQ's</h1>
	<?php
	if(is_array($res) && !empty($res) )
	{
	  $data['res'] = $res;
	  ?>
	  <div class="mt30" id="xlistContainer">
		<?php $this->load->view('faq/load_faq',$data);?>
	  </div>
	  <p class="ac mt20 dn" id="loadingdiv"><img src="<?php echo theme_url();?>images/ajax-loader.gif" width="128" height="15" alt=""><br><br></p>

	  <script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>

	  <?php echo form_open("",'id="myform" method="post" ');?>
	  <input type="hidden" name="per_page" value="<?php echo $this->config->item('per_page');?>">
	  <input type="hidden" name="offset" id="pg_offset" value="0">
	  <?php echo form_close();?>

	  <script type="text/javascript">
		$.extend(gObj,{
					  'actual_count':<?php echo $total_records;?>,
					  'listingContainer':'#xlistContainer',
					  'itemContainer':'.xitemContainer',
					  'req_url':'<?php echo $base_url;?>',
					  'data_frm' : '#myform'
			  });
	  </script>
	  <script type="text/javascript" src="<?php echo base_url(); ?>assets/developers/js/pager.js"></script>
	<?php
	}
	else
	{
	  echo '<p class="ac b">'.$this->config->item('no_record_found').'</p>';
	}
	?>
  </div>
  <!-- left ends -->
  <div class="fr w20"> 
	<?php $this->load->view('banner/right_banner');?>
  </div>
  <!-- right ends -->
  <div class="cb"></div>
</div>
<?php $this->load->view('bottom_application'); ?>