<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>vendors" itemprop="url"><span itemprop="title">My Account</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Manage Product/Service</strong></span></div>
  </div>
</div>
<div class="wrapper">
  <?php $this->load->view('vendors/top_links');?>
  <div class="w90 auto mt30">
	<?php error_message();?>
	<p class="fr mt1"><a href="<?php echo base_url();?>vendors/products/post_products" class="btn1 radius-20t" title="Add Product/Service">Add Product/Service</a> </p>
	<h2 class="bb1 pb5 black text-center">Manage Products/Serviecs</h2>
	<?php
	if(is_array($res) && !empty($res))
	{
	  $data['res'] = $res;
	  ?>
	  <div class="bb">
		<table class="w100 tab-bdr2 fs13" id="xlistContainer">
		<tr class="gray1 fs14 b lht-20 bg-gray1">
		  <td class="w10">S. No.</td>
		  <td>Products/Services</td>
		  <td class="w15 ac">Action</td>
		</tr>
		<?php $this->load->view('vendors/products/load_products',$data);?>
		</table>
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
	  echo '<p class="fl b">'.$this->config->item('no_record_found').'</p>';	
	}
	?>
	<div class="cb pb30"></div>
  </div>
</div>
<?php $this->load->view("bottom_application");?>