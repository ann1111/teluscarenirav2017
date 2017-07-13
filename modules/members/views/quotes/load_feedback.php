<?php
if(is_array($res) && !empty($res))
{
  $sl = $offset;
  foreach($res as $key=>$val)
  {
	$exclass= $sl > 0 ? 'mt10' : '';

	$prod_link = base_url().$val['friendly_url'];

	$dtl_link = base_url().'members/quotes/quote_details/'.$val['ref_quot_id'];
	?>
	
	  <tr class="w100 tab-bdr2 fs13 xitemContainer">
		<td class="w10 ac"> <?php echo ++$sl;?>.</td>
		<td>
		<p><i class="orange">Subject :</i> <br>
		  <?php echo $val['subject'];?>
		</p>
		<div class="mt10 fs12 lht-14"><?php echo $val['feedback'];?></div>

		<p class="mt10"><i class="orange">Request for :</i> <br>
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
		<p class="mt15 fs16 mb5">From : <b><?php echo $val['poster_id']==$this->userId ? 'Me' : $val['first_name'];?></b></p>

        <p>Email ID : <b><?php echo $val['user_name'];?></b>   /  Dated : <b><?php echo date("d F, Y",strtotime($val['date_added']));?></b></p>
		 
		<div class="mt10 fs12 lht-14"><?php echo char_limiter($val['comments'],200);?><a href="<?php echo $dtl_link;?>" title="More" class="uu" target="_blank">More&raquo;</a></div>
		</td>
		<td class="w15 ac">
		  <?php
		  if($val['poster_id'] != $this->userId)
		  {
		  ?>
		  <p class="mt10"> <a href="javascript:void(0);" class="btn1s radius-3 trans_eff vam scroll" title="Send Reply" data-id="<?php echo $val['feedback_id'];?>">Send Reply</a> </p>
		  <?php
		  }
		  ?>
		</td>
		<td class="w15 ac">
		<?php
		//if($val['poster_id'] == $this->userId)
		//{
		?>
		  <a href="<?php echo base_url();?>members/quotes/remove_feedback/<?php echo $val['feedback_id'];?>" onclick="return confirm('Are you sure you want to remove this record');" title="Delete Record"><img src="<?php echo theme_url();?>images/m-no.png"  alt=""></a>
		<?php
		//}
		?>
		</td>
	  </tr>
  <?php
  }
}