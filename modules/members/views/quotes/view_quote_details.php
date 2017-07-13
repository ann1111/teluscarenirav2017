<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
$confirm_quot_content = get_db_field_value('wl_cms_pages','page_description'," WHERE friendly_url='confirm-quotation' AND status='1'");

$prod_link = base_url().$res['friendly_url'];

$comp_link = base_url().$res['company_url'];

$res_attachment =  $this->db->select('media,sl')->get_where('wl_attachments',array('ref_id'=>$res['quotation_id'],'media_type'=>'docs','media_section'=>'request_quotation'))->result_array();
?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>members" itemprop="url"><span itemprop="title">My Account</span></a></div>
    <b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>members/quotes" itemprop="url"><span itemprop="title">Manage Quotes</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong><?php echo $res['prod_title'];?></strong></span></div>
  </div>
</div>
<div class="wrapper pt20 pb20" style="min-height:300px;">
  <?php $this->load->view('members/top_links');?>
  <div class="w90 auto mt30">
	<?php error_message();?>
	<h2>
	<?php
	if($res['status']=='1' && $res['user_status']=='1')
	{
	?>
	  <a href="<?php echo $prod_link;?>" class="uu b" target="_blank"><?php echo $res['prod_title'];?></a>
	<?php
	}
	else
	{
	?>
	  <?php echo $res['prod_title'];?><span class="red">(<?php echo ($res['status']==2 || $res['user_status']==2) ? 'Deleted' : 'Inactive';?>)</span>
	<?php
	}
	?>
	</h2>
	<?php
	if($res['quotation_mode']=='4' || $res['quotation_mode']=='2')
	{
	?>
	  <p class="fr mt15">
		<a href="#" class="btn1 radius-20t confirm_quot" >Confirm to SBP</a>
		<a href="#reply" class="btn2 pl25 pr25 radius-20t scroll">Negotiation</a>
		<a href="<?php echo base_url();?>members/quotes/decline_quote/<?php echo $res['quotation_id'];?>" class="btn2 pl25 pr25 radius-20t" onclick="return confirm('Are you sure you want to decline this record');">Decline</a>
	  </p>
	<?php
	}
	if($res['company_status']=='1')
	{
	?>
	  <p class="fs14 mt5 b lht-18">SBP : <a href="<?php echo $comp_link;?>" title="<?php echo escape_chars($res['company_name']);?>" class="uo"><?php echo $res['company_name'];?></a></p>
	<?php
	}
	else
	{
	?>
	  <p class="fs14 mt5 b lht-18">SBP : <?php echo $res['company_name'];?> <span class="red">(<?php echo $res['company_status']==0 ? 'Inactive' : 'Deleted';?>)</span></p>
	<?php
	}
	?>
	<p>Type : <b><?php echo get_product_type($res['prod_type']);?></b> /  Dated : <b><?php echo date("d F, Y",strtotime($res['date_added']));?></b></p>
	<?php
	$data['res'] = $res;
	switch($res['quot_type'])
	{
	  case 'motor_insurance':
		$this->load->view('quotes/motor_insurance_details',$data);
	  break;
	  case 'health_insurance':
		$this->load->view('quotes/health_insurance_details',$data);
	  break;
	  case 'banking_finance_insurance':
		$this->load->view('quotes/banking_finance_insurance_details',$data);
	  break;
	}
	?>
	<div class="b black fs14 mt15"><?php echo $res['comments'];?></div>
	<?php
	if(is_array($res_attachment) && !empty($res_attachment))
	{
	?>
	  <p class="b black fs14 mt15">Attachments</p>
	  <p class="mt10 blue1 i fs13 b">
		<?php
		$sptr = '';
		foreach($res_attachment as $dval)
		{
		?>
		  <?php echo $sptr;?><a href="<?php echo base_url();?>members/quotes/download_attachment/<?php echo $dval['sl'];?>" class="uu dib">-<?php echo $dval['media'];?></a>
		<?php
		  $sptr = '<br />';
		}
		?>
	  </p>
	<?php
	}
	?>
	<div class="pb5"></div>
	<a href="<?php echo base_url();?>members/quotes/view_feedback?quot_id=<?php echo $res['quotation_id'];?>" class="btn1s vam radius-3 trans_eff">View Feedbacks</a>
    <div class="bb1 pb5"></div>
    <h3 class="orange mt40">Conversations-<strong><?php echo $total_records;?></strong></h3>
    <div class="mt10">
	  <?php
	  if(is_array($reply_res) && !empty($reply_res))
	  {
		$data['res'] = $reply_res;

		$data['company_name'] = $res['company_name'];
	  ?>
		<div id="xlistContainer">
		  <?php $this->load->view('members/quotes/load_quote_reply',$data);?>
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
	<?php
	if(($res['quotation_mode']=='4' || $res['quotation_mode']=='2') && $res['vendor_status']!='2' && $res['status']==1)
	{
	  if(is_array($_POST) && !empty($_POST))
	  {
		//plz change if any other type file column added
		$attachment_length = count($_FILES);
	  }
	  else
	  {
		$attachment_length = 3;
	  }
	  $attachment_length = $attachment_length > $max_attachment ? $max_attachment : $attachment_length;
	?>
	  <h3 class="blue mt30 bb pb10" id="reply">Send Reply</h3>
	  <div class="pt25 pb25 bb fs16 weight600">
		<?php echo form_open_multipart('');?>
		<div class="fl w60">
		  <p>Subject</p>
		  <p class="short_form mt6">
			<input name="subject" type="text" style="width:80%" value="<?php echo set_value('subject');?>" size="50">
			<?php echo form_error('subject');?>
		  </p>
		  <p class="mt10">Comments</p>
		  <p class="short_form mt6">
			<textarea name="comments" cols="50" rows="7" style="height:136px; width:100%"><?php echo set_value('comments');?></textarea>
			<?php echo form_error('comments');?>
		  </p>
		</div>
	  <div class="fr w38 short_form">
		<p>Attachment</p>
		<div id="attachment_container">
		  <?php
		  for($ik=1;$ik<=$attachment_length;$ik++)
		  {
			$afld_name = "attachment".$ik;
		  ?>
			<p class="fls mt5 bg-white attachment" style="width:100%">
			  <span class="attch_sl"><?php echo $ik;?></span>. <input name="<?php echo $afld_name;?>" type="file" style="border:0; width:90%">
			  <?php echo form_error($afld_name);?>
			</p>
		  <?php
		  }
		  ?>
		</div>
		<p class="b red fs12 mt8"><a href="#" class="uo<?php echo $attachment_length>=$max_attachment ? ' dn' : '';?>" id="more_attach">+ Add more attachment</a></p>
	  </div>
	  <div class="cb pb5"></div>
	  <input name="post" type="submit" value="Submit" class="btn3 radius-3 trans_eff">
	  <input name="rst_btn" type="reset" value="Reset" class="btn3x radius-3 trans_eff">
	  <?php echo form_close();?>
	  </div>
	   <a id="pop_inline" class="dn" href="#inlinedata" title="Alert">Inline Pop</a>
	  <div class="dn">
		<div id="inlinedata">
		  <div><?php echo $confirm_quot_content;?></div>
		  <div class="pt10">
			<button class="xcontinue">Continue</button>&nbsp;&nbsp;<button class="xcancel">Cancel</button>
		  </div>
		</div>
	  </div>
	  <script type="text/javascript">
		$(document).ready(function(){
		  $('#more_attach').click(function(e){
			e.preventDefault();
			var parent_container = $('#attachment_container');
			var cloneObj = $('.attachment:eq(0)',parent_container).clone();
			cloneObj.find('.error').remove();
			pre_attachment_obj = $('.attachment',parent_container);
			counter_start = pre_attachment_obj.length+1;
			cloneObj.find('.attch_sl').html(counter_start);
			cloneObj.find(':file').attr('name','attachment'+counter_start);
			parent_container.append(cloneObj);
			//alert(attachment_obj.length);
			attachment_obj = $('.attachment',parent_container);
			if(attachment_obj.length >= <?php echo $max_attachment;?>){
			  $(this).addClass('dn');
			}

		  });
		  $('.confirm_quot').click(function(e){
			e.preventDefault();
			$('#pop_inline').fancybox().trigger('click');
		  });
		  $('.xcancel').click(function(){
			setTimeout(function(){ window.location.href='<?php echo base_url();?>usp';},200);
			$('.fancybox-close').click();
		  });
		  $('.xcontinue').click(function(){
			window.location.href='<?php echo base_url();?>members/quotes/confirm_quote/<?php echo $res['quotation_id'];?>';
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