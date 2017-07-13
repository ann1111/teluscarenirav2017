<?php
if(is_array($res) && !empty($res))
{
  $sl = $offset;
  foreach($res as $key=>$val)
  {
	$exclass= $sl > 0 ? 'mt10' : '';

	$res_attachment =  $this->db->select('media,sl')->get_where('wl_attachments',array('ref_id'=>$val['reply_id'],'media_type'=>'docs','media_section'=>'reply_quotation'))->result_array();
	?>
	<div class="mybox2 trans_eff <?php echo $exclass;?> xitemContainer">
	  <p class="robotoC fs18 p10 hand conv_ttl <?php if($this->userId!=$val['posted_by']){echo 'orange';}?>"><img src="<?php echo theme_url();?>images/<?php echo $this->userId==$val['posted_by'] ? 'art1.png' : 'art2.png';?>" class="vab mr2" alt=""> <b>
	  <?php if($this->userId==$val['posted_by']){echo 'Me';}else{echo $mem_name;}?> - </b> <?php echo date("d F, Y H:i A",strtotime($val['date_added']));?></p>
	  <div class="mt10 p10">
		<p><?php echo $val['subject'];?></p>
		<div class="mt5"><?php echo $val['comments'];?></div>
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
			  <?php echo $sptr;?><a href="<?php echo base_url();?>vendors/quotes/download_attachment/<?php echo $dval['sl'];?>" class="uu dib">-<?php echo $dval['media'];?></a>
			<?php
			  $sptr = '<br />';
			}
			?>
		  </p>
		<?php
		}
		?>
	  </div>
	</div>
  <?php
	$sl++;
  }
}