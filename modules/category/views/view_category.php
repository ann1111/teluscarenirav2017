<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<?php
	if(is_array($parentres))
	{
	  ?>
	  <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>category/<?php echo $cat_type;?>" itemprop="url"><span itemprop="title">Products By Category</span></a></div>  
	  <?php
	  $catid = $this->meta_info['entity_id'];
	  if($catid )
	  {
		echo category_breadcrumbs($catid,$catid,$cat_type);
	  }
	}
	else
	{
	?>   
	  <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong><?php echo $heading_title;?></strong></span></div>
	<?php
	}
	?> 
  </div>
</div>
<div class="wrapper pt30">
  <h1 class="tablinks bb1">
	<?php
	if($cat_type==$this->config->item('corporate_url_prefix'))
	{
	  $url_individual = base_url();

	  if(is_array($parentres) && !empty($parentres))
	  {
		$url_individual .= $this->config->item('individual_url_prefix')."/".$parentres['friendly_url'];
	  }
	  else
	  {
		$url_individual .= "category/".$this->config->item('individual_url_prefix');
	  }
	?>
	  <a href="<?php echo $url_individual;?>" >Individual</a> <img src="<?php echo theme_url();?>images/linkdvd.png" class="vab ml7 mr5" alt=""> <a href="javascript:void(0)" class="act">Corporate/SME</a>
	<?php
	}
	elseif($cat_type==$this->config->item('individual_url_prefix'))
	{
	  $url_corporate = base_url();

	  if(is_array($parentres) && !empty($parentres))
	  {
		$url_corporate .= $this->config->item('corporate_url_prefix')."/".$parentres['friendly_url'];
	  }
	  else
	  {
		$url_corporate .= "category/".$this->config->item('corporate_url_prefix');
	  }
	?>
	  <a href="javascript:void(0)" class="act">Individual</a> <img src="<?php echo theme_url();?>images/linkdvd.png" class="vab ml7 mr5" alt=""> <a href="<?php echo $url_corporate;?>" >Corporate/SME</a>
	<?php
	}
	if(is_array($parentres) && !empty($parentres))
	{
	  echo "&nbsp;".$parentres['category_name'];
	}
	?>
  </h1>
  <?php
  if(is_array($res) && !empty($res) )
  {
	$data['res'] = $res;
	$data['cat_type'] = $cat_type;
	?>
	<div class="mt0">
	  <ul class="cat_cont" id="xlistContainer">
		<?php $this->load->view('category/load_'.$page_view,$data);?>
		
	  </ul>
	  <div class="cb bb1" style="margin-top:-1px"></div>
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
<?php $this->load->view("bottom_application");?>