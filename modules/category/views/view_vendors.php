<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php $bc_res = '';?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>vendors/category" itemprop="url"><span itemprop="title">Category</span></a></div>
	<?php
	if($catid > 0)
	{
	  $bc_res = $this->db->select('category_name,category_description')->get_where('wl_categories',array('category_id'=>$catid))->row();
	  if(is_object($bc_res))
	  {
	  ?>
		<b>&gt;</b>
		<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong><?php echo $bc_res->category_name;?></strong></span></div>
	  <?php
	  }
	}
	?>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Vendors</strong></span></div>
  </div>
</div>
<div class="wrapper pt30">
  <div class="fl w200px mt3">
	<?php
	$left_cat_qry = $this->db->select('category_name,friendly_url,category_alt')->limit(28)->order_by('sort_order')->get_where('wl_categories',array('parent_id'=>'0','status'=>'1'));

	$left_cat_count = $left_cat_qry->num_rows();
	if($left_cat_count > 0)
	{
	  $left_cat_res = $left_cat_qry->result_array();
	?>
	<p class="cat_ttl pb5 b bb1"><b>C</b ><strong> Categories</strong></p>
	<p class="catlist catlist_inr mt15 osons ml40">
	  <?php
	  foreach($left_cat_res as $val)
	  {
		$link_url = base_url().$val['friendly_url']."/".$this->config->item('cat_vendor_url_suffix');
	  ?>
		<a href="<?php echo $link_url;?>" title="<?php echo escape_chars($val['category_alt']);?>"><?php echo $val['category_name'];?></a>
	  <?php
	  }
	  ?>
	</p>
	<!-- category ends -->
	<?php
	}
	?>
	<div class="cb bb1 pb15 mb15"></div>
	<img src="<?php echo theme_url();?>images/r_bnr1.jpg" class="db w100" alt="">		<img src="<?php echo theme_url();?>images/r_bnr3.jpg" class="db w100 mt20" alt="">	
  </div>

  <!-- left ends -->

  <div class="fr w75">
	<?php
	if(is_object($bc_res))
	{
	?>
	  <h1><?php echo $bc_res->category_name;?></h1>
	  <?php
	  if($bc_res->category_description!='')
	  {
	  ?>
		<div class="fs13 i bg-gray1 p10 pl15 border1"><?php echo $bc_res->category_description;?></div>
	<?php
	  }
	}
	?>
	<div class="mt20">
	  <?php
	  if(is_array($res) && !empty($res))
	  {
		$data['res'] = $res;
		?>
		<div id="xlistContainer">
		  <?php $this->load->view('category/load_vendors',$data);?>
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
	<!-- listing ends -->

	
	<br>
	<br>
  </div>
  <!-- right ends -->

  <div class="cb"></div>
</div>
<?php $this->load->view("bottom_application");?>