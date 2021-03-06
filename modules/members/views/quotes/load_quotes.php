<?php
if(is_array($res) && !empty($res))
{
  $sl = $offset;
  foreach($res as $key=>$val)
  {
	$exclass= $sl > 0 ? 'mt10' : '';

	$dtl_link = base_url().'members/quotes/quote_details/'.$val['quotation_id'];

	$prod_link = base_url().$val['friendly_url'];

	$comp_link = base_url().$val['company_url'];

	$res_attachment =  $this->db->select('media,sl')->get_where('wl_attachments',array('ref_id'=>$val['quotation_id'],'media_type'=>'docs','media_section'=>'request_quotation'))->result_array();
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
		<?php
		if($val['company_status']=='1')
		{
		?>
		  <p class="fs14 mt5 b lht-18">SBP : <a href="<?php echo $comp_link;?>" title="<?php echo escape_chars($val['company_name']);?>" class="uo"><?php echo $val['company_name'];?></a></p>
		<?php
		}
		else
		{
		?>
		  <p class="fs14 mt5 b lht-18">SBP : <?php echo $val['company_name'];?> <span class="red">(<?php echo $val['company_status']==0 ? 'Inactive' : 'Deleted';?>)</span></p>
		<?php
		}
		?>
		<p>Type : <b><?php echo get_product_type($val['prod_type']);?></b> /  Dated : <b><?php echo date("d F, Y",strtotime($val['date_added']));?></b></p>
		<div class="mt10 fs12 lht-14"><?php echo char_limiter($val['comments'],200);?><a href="<?php echo $dtl_link;?>" title="More" class="uu">More&raquo;</a></div>
		<p class="mt10"><a href="<?php echo $dtl_link?>" class="btn1s vam radius-3 trans_eff">View Replies</a> 
		<a href="<?php echo base_url();?>members/quotes/view_feedback?quot_id=<?php echo $val['quotation_id'];?>" class="btn1s vam radius-3 trans_eff">View Feedbacks</a>
		<span class="fs16 ml15 orange">Status : <b><?php echo get_quote_status($val['quotation_mode']);?></b></span></p>
		
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

		<div class="mt10 b">
		<a href="<?php echo base_url();?>members/quotes/complaint/<?php echo $val['quotation_id'];?>" class="vam ser-pop" > Complaints</a> &nbsp;
		<a href="<?php echo base_url();?>members/quotes/suggestion/<?php echo $val['quotation_id'];?>" class="ml10 vam ser-pop" > Suggestions</a> &nbsp;
		<a href="<?php echo base_url();?>members/quotes/queries/<?php echo $val['quotation_id'];?>" class="ml10 vam ser-pop" > Queries</a> &nbsp;
		</div>
		</td>
		<td class="w15 ac"><a href="<?php echo base_url();?>members/quotes/remove_quote/<?php echo $val['quotation_id'];?>" onclick="return confirm('Are you sure you want to remove this record');" title="Delete Record"><img src="<?php echo theme_url();?>images/m-no.png" width="20" height="24" alt=""></a></td>
	  </tr>
	  </table>
	</div>
  <?php
  }
}