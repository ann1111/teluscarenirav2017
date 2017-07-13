<?php $this->load->view('includes/face_header'); ?>
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
?>
<h2>Reply</h2>
<table width="100%" border="0" cellspacing="4" cellpadding="0" class="grey">
<tr>
  <td>
	<?php echo form_open_multipart('');?>
	<table border="0" width="100%" cellpadding=2 cellspacing=2>
	<tr>
	  <td>Subject</td>
	  <td>
		<input type="text" name="subject" value="<?php echo set_value('subject');?>" size="30" />
		<?php echo form_error('subject');?>
	  </td>
	</tr>
	<tr>
	  <td>Comments</td>
	  <td>
		<textarea name="comments" rows="8" cols="30"><?php echo set_value('comments');?></textarea>
		<?php echo form_error('comments');?>
	  </td>
	</tr>
	<tr>
	  <td>Attachment</td>
	  <td>
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
	  </td>
	</tr>
	<tr>
	  <td colspan="2">
		<input type="submit" name="post" value="Post" />
	  </td>
	</tr>
	</table>
	<?php echo form_close();?>
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
  </td>                
</tr>
</table>
</body>
</html>