<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
$product_res = $this->db->select('prod_title,products_id')->get_where('wl_products',array('mem_id'=>$this->userId,'user_status'=>'1','status !='=>'2'))->result_array();
?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>vendors" itemprop="url"><span itemprop="title">My Account</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Manage Quote Enquiry</strong></span></div>
  </div>
</div>
<div class="wrapper">
  <?php $this->load->view('vendors/top_links');?>
  <div class="w90 auto mt30">
	<?php error_message();?>
	<h2 class="bb1 pb5 black text-center">Manage Quote Enquiry</h2>
	<div class="pt20">
	  <?php echo form_open('');?>
	  <p class="b mt7 fl gray">Sort by : </p>
	  <select name="product_id" class="fl w45 b fs14 p6 radius-3 ml10">
		<option value="">Products</option>
		<?php
		if(is_array($product_res) && !empty($product_res))
		{
		  foreach($product_res as $val)
		  {
		  ?>
			<option value="<?php echo $val['products_id'];?>"<?php echo $this->input->get_post('product_id')==$val['products_id'] ? ' selected="selected"' : '';?>><?php echo $val['prod_title'];?></option>
		  <?php
		  }
		}
		?>
	  </select>
	  <select name="sort_by" class="fl w20 b fs14 p6 radius-3 ml10">
		<option>Date</option>
		<option value="recent" <?php echo $this->input->get_post('sort_by')=='recent' ? ' selected="selected"' : '';?>>Recent First</option>
		<option value="oldest"<?php echo $this->input->get_post('sort_by')=='oldest' ? ' selected="selected"' : '';?>>Oldest First</option>
	  </select>
	  <select name="quot_mode" class="fl w20 b fs14 p6 radius-3 ml10">
		<option value="">Status</option>
		<option value="1"<?php echo $this->input->get_post('quot_mode')==1 ? ' selected="selected"' : '';?>>Confirmed</option>
		<option value="2"<?php echo $this->input->get_post('quot_mode')==2 ? ' selected="selected"' : '';?>>Negotiation</option>
		<option value="3"<?php echo $this->input->get_post('quot_mode')==3 ? ' selected="selected"' : '';?>>Decline</option>
	  </select>
	  <div class="cb"></div>
	  <div class="ac mt10"><input type="submit" name="sbt" value="Filter" class="btn3 radius-3 trans_eff" /></div>
	  <div class="cb"></div>
	  <?php echo form_close();?>
	</div>
	<div class="bb mt10">
	  <?php
	  if(is_array($res) && !empty($res))
	  {
		$data['res'] = $res;
		?>
		<table class="w100 tab-bdr2 fs13">
		<tr class="orange fs14 b lht-20">
		  <td class="w10 ac">S. No.</td>
		  <td>Quote Request</td>
		  <td class="w15 ac">Delete</td>
		</tr>
		</table>
		<div id="xlistContainer">
		  <?php $this->load->view('vendors/quotes/load_quotes',$data);?>
		</div>
		<p class="ac mt20 dn" id="loadingdiv"><img src="<?php echo theme_url();?>images/ajax-loader.gif" width="128" height="15" alt=""></p>

		<script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>

		<?php echo form_open("",'id="myform" method="post" ');?>
		<input type="hidden" name="product_id" value="<?php echo $this->input->get_post('product_id');?>">
		<input type="hidden" name="sort_by" value="<?php echo $this->input->get_post('sort_by');?>">
		<input type="hidden" name="quot_mode" value="<?php echo $this->input->get_post('quot_mode');?>">
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
		echo '<p class="fl b red">'.$this->config->item('no_record_found').'</p>';	
	  }
	  ?>
	</div>
	<div class="cb pb30"></div>
  </div>
</div>
<?php $this->load->view("bottom_application");?>