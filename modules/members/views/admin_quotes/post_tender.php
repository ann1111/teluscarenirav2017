<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
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

$where = "a.posted_by ='".$this->userId."' AND a.poster_status='1' AND a.quotation_mode !='1'";

$condtion_array = array(
								'fields'=>"a.quotation_id,b.prod_title,b.prod_type,b.prod_for,b.friendly_url,b.status,b.user_status,c.company_name,c.status as company_status,c.friendly_url as company_url",
								'where'=>$where,
								'offset'=>0,
								'limit'=>50,
								'debug'=>FALSE
							  );

$condtion_array['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=b.mem_id");

$res_vendors = $this->quote_model->get_quotes($condtion_array);
?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>members" itemprop="url"><span itemprop="title">My Account</span></a></div>
    <b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>members/admin_quotes" itemprop="url"><span itemprop="title">Tender to Admin</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Post Tender</strong></span></div>
  </div>
</div>
<div class="wrapper pt20 pb20" style="min-height:300px;">
  <?php $this->load->view('members/top_links');?>
  <div class="w90 auto mt30">
	<?php error_message();?>
	<p class="fr mt1"><a href="<?php echo base_url();?>members/admin_quotes" class="btn1 radius-20t">Back to Tender</a> </p>
	<h2 class="bb1 pb5">Post New Tender</h2>
	<div class="p25 bg-gray1 border1 bb fs16 weight600">
	  <?php echo form_open_multipart('');?>
	  <p>Enter Tender Title</p>
	  <p class="short_form mt6">
		<input name="tender_title" type="text" value="<?php echo set_value('tender_title');?>" class="p7" style="width:100%">
		<?php echo form_error('tender_title');?>
	  </p>
	  <?php
	  if(is_array($res_vendors) && !empty($res_vendors))
	  {
	  ?>
	  <p class="mt15">Select Vendors</p>
	  <div class="short_form mt6 mb15">
		<div class="fls p7" style="width:100%;">
		  <div style="height:185px; overflow-y:scroll">
			<?php
			$sl = 0;
			foreach($res_vendors as $key=>$val)
			{
			  $cls = $sl%2==0 ? 'fl w48 p5' : 'fr w48 p5';

			  $prod_link = base_url().$val['friendly_url'];

			  $comp_link = base_url().$val['company_url'];
			?>
			  <div class="<?php echo $cls;?>">
				<p class="fl mr9 bg-black p10 radius-20">
				  <input name="vendors[]" type="checkbox" value="<?php echo $val['quotation_id'];?>" class="db">
				</p>
				<p>Service : 
				  <?php
				  if($val['status']=='1' && $val['user_status']=='1')
				  {
				  ?>
					<a href="<?php echo $prod_link;?>" class="uu b" target="_blank"><?php echo $val['prod_title'];?></a>
				  <?php
				  }
				  else
				  {
				  ?>
					<?php echo $val['prod_title'];?>
				  <?php
				  }
				  ?>
				</p>
				<p class="fs13 mt3 ml40">Type : <?php echo get_product_type($val['prod_type']);?></p>
				<?php
				if($val['company_status']=='1')
				{
				?>
				  <p class="ml40">SBP : <b class="orange b"><a href="<?php echo $comp_link;?>" title="<?php echo escape_chars($val['company_name']);?>" class="uo" target="_blank"><?php echo $val['company_name'];?></a></b></p>
				<?php
				}
				else
				{
				?>
				  <p class="ml40">SBP : <b class="orange b"><?php echo $val['company_name'];?></b></p>
				<?php
				}
				?>
			  </div>
			<?php
			  $sl++;
			  if($sl%2 == 0)
			  {
				echo '<div class="cb pb15"></div>';
			  }
			}
			?>
			<div class="cb"></div>
		  </div>
		</div>
	  </div>
	  <?php
	  }
	  ?>
	  <div class="fl w60">
		<p>Comments</p>
		<p class="short_form mt6">
		  <textarea name="comments" cols="50" rows="7" style="height:156px; width:100%"><?php echo set_value('comments');?></textarea>
		  <?php echo form_error('comments');?>
		</p>
	  </div>
	  <div class="fr w38 short_form">
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
	<div class="cb pb30"></div>
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
	});
  </script>
</div>
<?php $this->load->view("bottom_application");?>