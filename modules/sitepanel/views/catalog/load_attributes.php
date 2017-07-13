<?php
if(is_array($res) && !empty($res))
{
  foreach($res as $val)
  {
  ?>
	<option value="<?php echo $val[$option_val_field];?>"<?php echo $val[$option_val_field]==$selected_id ? ' selected="selected"' : '';?>><?php echo $val[$option_text_field];?></option>
<?php
  }
}
