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
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Manage Quote Feedbacks</strong></span></div>
  </div>
</div>
<div class="wrapper">
  <?php $this->load->view('vendors/top_links');?>
  <div class="w90 auto mt30">
	<h2 class="bb1 pb5 black text-center">Manage Feedbacks</h2>
	<div class="mt20">
	  <?php error_message();?>
	  <div class="cb"></div>
	  <div class="tab_links">
		<a href="<?php echo base_url();?>vendors/quotes/view_feedback?type=complain" class="xtabs <?php echo $feed_type=='complain' || $feed_type=='' ? ' act' : '';?>">Complain</a>
		<a href="<?php echo base_url();?>vendors/quotes/view_feedback?type=suggestion" class="xtabs<?php echo $feed_type=='suggestion' ? ' act' : '';?>">Suggestions</a>
		<a href="<?php echo base_url();?>vendors/quotes/view_feedback?type=queries" class="xtabs<?php echo $feed_type=='queries' ? ' act' : '';?>">Queries</a>
	  </div>

	  <div class="form_box">
		<?php
		if(is_array($res) && !empty($res))
		{
		  $data['res'] = $res;
		  ?>
		  <table class="w100 tab-bdr1 fs13  bg-gray1 border1">
		  <tr class="orange fs14 b lht-20">
			<td class="w10 ac">S. No.</td>
			<td><?php echo $feedback_type;?></td>
			<td class="w15 ac">Action</td>
			<td class="w15 ac">Delete</td>
		  </tr>
		  </table>
		  <div class="trans_eff">
			<table class="w100 tab-bdr3 fs13" id="xlistContainer">
		  <?php $this->load->view('vendors/quotes/load_feedback',$data);?>
			</table>
		  </div>
		  <p class="ac mt20 dn" id="loadingdiv"><img src="<?php echo theme_url();?>images/ajax-loader.gif" width="128" height="15" alt=""></p>

		  <script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>

		  <?php echo form_open("",'id="myform" method="post" ');?>
		  <input type="hidden" name="type" value="<?php echo $feed_type;?>">
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

	</div>
	<?php
	if(is_array($res) && !empty($res))
	{
	?>
	  <a name="reply" id="reply"></a>
	  <h3 class="blue mt30 bb pb10" id="reply">Send Reply</h3>
	  <?php echo form_open('');?>
	  <div class="pt25 pb25 bb fs16 weight600">
		<div class="fl w60">
		  <p>Title</p>
		  <p class="short_form mt6">
			<input name="title" type="text" style="width:100%" value="<?php echo set_value('title');?>" size="50">
			<?php echo form_error('title');?>
		  </p>
		  <p class="mt20">Comments</p>
		  <p class="short_form mt6">
			<textarea name="comments" cols="50" rows="7" style="height:156px; width:100%"><?php echo set_value('comments');?></textarea>
			<?php echo form_error('comments');?>
		  </p>
		</div>
		<div class="cb pb5"></div>
		<input type="hidden" name="feedback_id" id="feedback_id" value="<?php echo $this->input->post('feedback_id');?>" />
		<input type="hidden" name="quot_id"  value="<?php echo $this->input->get_post('quot_id');?>" />
		<input name="post" type="submit" value="Submit" class="btn3 radius-3 trans_eff">
		<input name="btn_rst" type="reset" value="Reset" class="btn3x radius-3 trans_eff">
	  </div>
	<?php
	  echo form_close();
	?>
	  <script type="text/javascript">
		$(document).ready(function(){
		  $('#xlistContainer').on('click','.scroll',function(e){
			e.preventDefault();
			$('#feedback_id').val($(this).data('id'));
			$('body,html').animate({scrollTop:$('#reply').offset().top},200);
		  });
		  <?php
		  if($error_data===TRUE)
		  {
		  ?>
			$('body,html').animate({scrollTop:$('#reply').offset().top},200);
		  <?php
		  }
		  ?>
		});
	  </script>
	<?php
	}
	?>
	<div class="cb pb30"></div>  
  </div>
</div>
<?php $this->load->view("bottom_application");?>
