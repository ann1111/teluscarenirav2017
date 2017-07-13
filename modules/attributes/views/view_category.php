<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php $this->load->view("project_subheader");?>
<?php
$category_content = get_db_field_value('wl_cms_pages','page_description'," AND friendly_url='category' AND status='1'");
?>
<section>
  <script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>

  <?php echo form_open("",'id="myform" method="post" ');?>
  <input type="hidden" name="per_page" value="<?php echo $this->config->item('per_page');?>">
  <input type="hidden" name="offset" id="pg_offset" value="0">
  <input type="hidden" name="ajx_req" id="ajx_req" value="Y">
  <?php echo form_close();?>
  <!--tree-->
  <div class="breadcrumb  mb8 tab_hider">
	<div class="wrapper">
	  <b class="ttu"><span class="gray pl5">You Are Here :</span> </b>
	  <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title"><img src="<?php echo theme_url();?>images/tree-home.png" class="vam" alt="" title=""></span></a></div>   
	  <b>&gt;</b>   
	  <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><b>Tour Categories</b></span></div>
	  <div class="pb5"></div>
	</div>
  </div>
  <!--tree-->

  <div class="wrapper">
	<div class="p10">
	  <h1>Tour Categories</h1>
	  <div class="cb bb4 pb5"></div>

	  <?php
	  if($category_content !='')
	  {
	  ?>
	  <div class="border1 roboto-slab p20 mt10"><?php echo $category_content;?></div>
	  <?php
	  }
	  ?>
	  <div class="pt20">
		<?php
		if(is_array($res) && !empty($res) )
		{
		  $data['res'] = $res;
		  ?>
		  <div>
			<ul class="floater float_3" id="xlistContainer">
			  <?php $this->load->view('category/load_category',$data);?>
			</ul>
		  </div>
		  <div class="cb"></div>
		  <div class="ac mt45 dn" id="loadingdiv"><img src="<?php echo theme_url();?>images/ajax-loader.gif" alt=""></div>

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
	</div>
  </div>
</section>
<?php $this->load->view("bottom_application");?>