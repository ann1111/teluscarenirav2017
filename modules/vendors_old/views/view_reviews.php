<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>vendors" itemprop="url"><span itemprop="title">My Account</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Manage Reviews</strong></span></div>
  </div>
</div>
<div class="wrapper pt20 pb20" style="min-height:300px;">
  <?php $this->load->view('vendors/top_links');?>
  <div class="w90 auto mt30">
	<?php error_message();?>
	<div class="cb"></div>
	<h2 class="bb1 pb5 black text-center">Manage Reviews</h2>
	<div class="bb mt10">
	  <?php
	  if(is_array($res) && !empty($res))
	  {
		$data['res'] = $res;
		?>
		<table class="w100 tab-bdr1 fs13  bg-gray1 border1">
		<tr class="orange fs14 b lht-20">
		  <td class="w10 ac">S. No.</td>
		  <td>Reviews</td>
		  <td class="w15 ac">Delete</td>
		</tr>
		</table>
		<div class="trans_eff" >
		  <table class="w100 tab-bdr3 fs13" id="xlistContainer">
		  <?php $this->load->view('vendors/load_reviews',$data);?>
		  </table>
		</div>
		<p class="ac mt20 dn" id="loadingdiv"><img src="<?php echo theme_url();?>images/ajax-loader.gif" width="128" height="15" alt=""></p>

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
		echo '<p class="fl b">'.$this->config->item('no_record_found').'</p>';	
	  }
	  ?>
	</div>
	<div class="cb pb30"></div>
  </div>
</div>
<?php $this->load->view("bottom_application");?>