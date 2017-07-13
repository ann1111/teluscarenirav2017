<?php
if(is_array($res) && !empty($res))
{
  foreach($res as $val)
  {
	if(is_array($selected_id))
	{
	  $selected = in_array($val[$option_val_field],$selected_id) ? ' selected="selected"' : '';
	}
	else
	{
	  $selected = $val[$option_val_field]==$selected_id ? ' selected="selected"' : '';
	}
  ?>
	<option value="<?php echo $val[$option_val_field];?>"<?php echo $selected;?>><?php echo $val[$option_text_field];?></option>
<?php
  }
}
