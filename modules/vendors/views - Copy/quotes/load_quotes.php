<?php
if(is_array($res) && !empty($res))
{
  $sl = $offset;
  foreach($res as $key=>$val)
  {
	$exclass= $sl > 0 ? 'mt10' : '';

	$dtl_link = base_url().'vendors/quotes/quote_details/'.$val['quotation_id'];

	$prod_link = base_url().$val['friendly_url'];

	//$res_attachment =  $this->db->select('media,sl')->get_where('wl_attachments',array('ref_id'=>$val['quotation_id'],'media_type'=>'docs','media_section'=>'request_quotation'))->result_array();
	?>
	<div class="mybox1 trans_eff <?php echo $exclass;?> xitemContainer">
	  <table class="w100 tab-bdr2x fs13">
	  <tr>
		<td class="w10 b ac"> <?php echo ++$sl;?>.</td>
		<td><p><i class="orange">Request for :</i> <br>
		<?php
		if($val['status']=='1' && $val['user_status']=='1')
		{
		?>
		  <b class="blue fs14"><a href="<?php echo $prod_link;?>" class="uu b" target="_blank"><?php echo $val['prod_title'];?></a></b>
		<?php
		}
		else
		{
		?>
		  <b class="blue fs14"><?php echo $val['prod_title'];?></b><span class="red">(<?php echo ($val['status']==2 || $val['user_status']==2) ? 'Deleted' : 'Inactive';?>)</span>
		<?php
		}
		?>
		</p>
		<p>Type : <b><?php echo get_product_type($val['prod_type']);?></b></p>
		<p class="mt15 fs16 mb5">From : <b><?php echo $val['first_name'];?></b></p>

        <p>Email ID : <b><?php echo $val['user_name'];?></b> /  Mobile No. : <b><?php echo $val['mobile_number'];?></b>  /  Dated : <b><?php echo date("d F, Y",strtotime($val['date_added']));?></b></p>
		 
		<div class="mt10 fs12 lht-14"><?php echo char_limiter($val['comments'],200);?><a href="<?php echo $dtl_link;?>" title="More" class="uu">More&raquo;</a></div>
		<p class="mt10">
		  <?php
		  if($val['status']==1)
		  {
		  ?>
			<a href="<?php echo $dtl_link?>#reply" class="btn1s vam radius-3 trans_eff">Send Reply</a>
		  <?php
		  }
		  ?> 
		<a href="<?php echo base_url();?>vendors/quotes/view_feedback?quot_id=<?php echo $val['quotation_id'];?>" class="btn1s vam radius-3 trans_eff">View Feedbacks</a>
		<span class="fs16 ml15 orange">Status : <b><?php echo get_quote_status($val['quotation_mode']);?></b></span>
		</p>
		</td>
		<td class="w15 ac"><a href="<?php echo base_url();?>vendors/quotes/remove_quote/<?php echo $val['quotation_id'];?>" onclick="return confirm('Are you sure you want to remove this record');" title="Delete Record"><img src="<?php echo theme_url();?>images/m-no.png" width="20" height="24" alt=""></a></td>
	  </tr>
	  </table>
	</div>
  <?php
  }
}