<?php
if(is_array($res) && !empty($res))
{
  $sl = $offset;
  foreach($res as $key=>$val)
  {
	//trace($val);
	?>
	<tr class="xitemContainer">
	  <td class="w10 b ac"> <?php echo ++$sl;?>.</td>
	  <td>
		<div class="">
		  <div class="rev_text">
			<p class="fs18 black mb10 b robotoC"><a href="user-dtl.htm" target="_blank"><?php echo $val['mem_name'];?></a></p>
			<p class="fl">Rating : <?php echo rating_html($val['ads_rating'],5);?></p>
			<p class="fl ml15">Posted On - <?php echo date("d m, Y",strtotime($val['review_date']));?></p>
			<div class="cb"></div>
			<div class="p10 gray1 fs13 i mt5 border1 bg-gray1"><?php echo $val['text'];?></div>
		  </div>
		</div>
	  </td>
	  <td class="w15 ac"><a href="<?php echo base_url();?>vendors/remove_review/<?php echo $val['review_id'];?>" onclick="return confirm('Are you sure you want to remove this record');" title="Delete Record"><img src="<?php echo theme_url();?>images/m-no.png" width="20" height="24" alt=""></a></td>
	</tr>
  <?php
  }
}