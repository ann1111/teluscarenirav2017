<?php
if(is_array($res) && !empty($res))
{
  $sl = $offset;
  foreach($res as $key=>$val)
  {
	$exclass= $sl > 0 ? 'mt10' : '';

	$dtl_link = base_url().'members/admin_quotes/quote_details/'.$val['quotation_id'];

	$res_attachment =  $this->db->select('media,sl')->get_where('wl_attachments',array('ref_id'=>$val['quotation_id'],'media_type'=>'docs','media_section'=>'tender_quotation'))->result_array();

	$ref_product_id = array('-99');
	if($val['ref_product_id']!='')
	{
	  $ref_product_id  = explode(',',$val['ref_product_id']); 
	}

	$where = "a.posted_by ='".$this->userId."' AND a.poster_status='1' AND a.quotation_id IN (".implode(',',$ref_product_id).")";

	$condtion_array = array(
								'fields'=>"count(a.quotation_id) as total_sbp",
								'where'=>$where,
								'offset'=>0,
								'limit'=>1,
								'debug'=>FALSE
							  );

	$condtion_array['exjoin'][] = array('tbl'=>'wl_customers as c','condition'=>"c.customers_id=b.mem_id");

	$res_vendors = $this->quote_model->get_quotes($condtion_array);

	$count_sbp = $res_vendors[0]['total_sbp'];
	?>
	<div class="mybox1 trans_eff <?php echo $exclass;?> xitemContainer">
	  <table class="w100 tab-bdr2x fs13">
	  <tr>
		<td class="w10 b ac"> <?php echo ++$sl;?>.</td>
		<td>
		  <p class="blue fs16 b"><a href="<?php echo $dtl_link?>" class="uu"><?php echo $val['tender_title'];?></a>
		  <?php
		  if($val['vendor_status']=='2')
		  {
		  ?>
			<span class="red">[Deleted By Admin]</span>
		  <?php
		  }
		  ?>
		  </p>
		  <p class="fs14 mt5 lht-18">SBP : <b class="orange"><a href="<?php echo base_url();?>members/admin_quotes/sbp_list/<?php echo $val['quotation_id'];?>" title="<?php echo $count_sbp;?>" class="uu vendors"><?php echo $count_sbp;?></a></b> <b class="ml10 mr10">/</b> Dated : <b><?php echo date("d F, Y",strtotime($val['date_added']));?></b></p>
		  <div class="fs12 lht-16 mt15"><?php echo char_limiter($val['comments'],200);?></div>
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
		  <p class="mt10"><a href="<?php echo $dtl_link?>" class="btn1s vam radius-3 trans_eff">View Replies</a> <span class="fs16 ml15 orange">Status : <b><?php echo get_quote_status($val['quotation_mode']);?></b></span></p>
		</td>
		<td class="w15 ac"><a href="<?php echo base_url();?>members/admin_quotes/remove_quote/<?php echo $val['quotation_id'];?>" onclick="return confirm('Are you sure you want to remove this record');" title="Delete Record"><img src="<?php echo theme_url();?>images/m-no.png" width="20" height="24" alt=""></a></td>
	  </tr>
	  </table>
	</div>
  <?php
  }
}