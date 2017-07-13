<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>members" itemprop="url"><span itemprop="title">My Account</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Manage Quote</strong></span></div>
  </div>
</div>
<div class="wrapper pt20 pb20" style="min-height:300px;">
  <?php $this->load->view('members/top_links');?>
  <div class="w90 auto mt30">
	<?php error_message();?>
	<p class="fr mt1"><a href="<?php echo base_url();?>members/admin_quotes/post_tender" class="btn1 radius-20t">Post New Tender</a> </p>
	<h2 class="bb1 pb5">Tenders to Admin</h2>
	<div class="bg-gray1 border2 p10 pl15">
	  <?php echo form_open('');?>
      <p class="b mt7 fl">Sort by : </p>
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
	  </select>&nbsp;
	  <input type="submit" name="sbt" value="Filter" class="btn3 radius-3 trans_eff" />
	  <div class="cb"></div>
	  <?php echo form_close();?>
      <div class="cb"></div>
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
          <td>Tenders</td>
          <td class="w15 ac">Delete</td>
        </tr>
		</table>
		<div id="xlistContainer">
		  <?php $this->load->view('members/admin_quotes/load_quotes',$data);?>
		</div>
		<p class="ac mt20 dn" id="loadingdiv"><img src="<?php echo theme_url();?>images/ajax-loader.gif" width="128" height="15" alt=""></p>

		<script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>

		<?php echo form_open("",'id="myform" method="post" ');?>
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
		echo '<p class="fl b">'.$this->config->item('no_record_found').'</p>';	
	  }
	  ?>
	</div>
	<div class="cb pb30"></div>
  </div>
</div>
<?php $this->load->view("bottom_application");?>