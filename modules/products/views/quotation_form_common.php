<?php echo form_open_multipart('');?>
<div class="fl w60">
  <p>Comments</p>
  <p class="short_form mt6">
	<textarea name="comments" cols="50" rows="7" style="height:156px; width:100%"><?php echo set_value('comments');?></textarea>
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