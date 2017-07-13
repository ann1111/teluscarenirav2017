<?php $this->load->view('includes/face_header'); ?>
<table width="90%" align="left" cellpadding="1" cellspacing="1" class="list" style="margin-top:10px;">
<thead>
<tr>
	<td colspan="4" height="30"><?php echo $heading_title; ?>
		
	</td>
</tr>
</thead>
</table>

<?php 
if (is_array($res) && !empty ($res) )
{ 
?>
  <table width="90%" align="left" cellpadding="1" cellspacing="1" class="list" style="margin-top:10px;">
  <thead>
	<tr>
	  <td width="20" style="text-align: center;">Sl.</td>
	  <td width="139" class="left">Posted By </td>
	  <td width="239" class="left">Details </td>
	  <td width="174" align="left">Attachments</td>
	  <td width="131" align="left">Posted</td>
  </tr>
  </thead>
  <?php 
  $sl = $offset;
  foreach($res as $key=>$val)
  {
	$res_attachment =  $this->db->select('media,sl')->get_where('wl_attachments',array('ref_id'=>$val['reply_id'],'media_type'=>'docs','media_section'=>'reply_quotation'))->result_array();
	?>
	<tr>
	  <td><?php echo ++$sl;?></td>
	  <td>
		<?php if($val['company_name']!=''){echo $val['company_name'];}else{echo $val['first_name'];}?>
	  </td>
	  <td>
		<p><?php echo $val['subject'];?></p>
		<div class="mt5"><?php echo $val['comments'];?></div>
	  </td>
	  <td>
		<?php
		if(is_array($res_attachment) && !empty($res_attachment))
		{
		?>
		  <p class="mt10 blue1 i fs13 b">
			<?php
			$sptr = '';
			foreach($res_attachment as $dval)
			{
			?>
			  <?php echo $sptr;?><a href="<?php echo base_url();?>sitepanel/products/download_attachment/<?php echo $dval['sl'];?>" class="uu dib">-<?php echo $dval['media'];?></a>
			<?php
			  $sptr = '<br /><br />';
			}
			?>
		  </p>
		<?php
		}
		?>
	  </td>
	  <td><?php echo date("d F, Y H:i A",strtotime($val['date_added']));?></td>
	</tr>
  <?php
  }
  ?>
  </table>
  <?php
  if($page_links!='')
  {
  ?>
	<table class="list" width="100%">
	<tr><td align="right" height="30"><?php echo $page_links; ?></td></tr>     
	</table>
  <?php
  }
  ?>
<?php  
}else{
	echo "<div><center><strong> No record(s) found !</strong></center></div>" ;
}
?>
</body>
</html>