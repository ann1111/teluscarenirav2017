<?php $this->load->view('includes/face_header'); ?>
<table width="100%" border="0" cellspacing="4" cellpadding="0" class="grey">
<tr valign="top" >
  <td colspan="4" align="right" >
	<table width="100%"  border="0" cellspacing="2" cellpadding="2">
	<tr align="left" bgcolor="#1588BB" class="white">
	  <td colspan="7" bgcolor="#CCCCCC" ><strong>General Details : </strong></td>
	</tr>
	
	<tr valign="top" >
	  <td width="19%" align="left" ><strong>  Posted Date : </strong></td>
	  <td width="25%" align="left" ><?php echo date("F d,Y",strtotime($mres['date_added']));?></td>
	  <td width="21%" align="left" ><strong>Last Updated : </strong></td>
	  <td width="35%" align="left" > <?php echo is_null($mres['date_updated']) ? " - " : date("F d,Y",strtotime($mres['date_updated']));?></td>
	</tr>
	<tr valign="top" >
	  <td width="19%" align="left" ><strong>  Posted By : </strong></td>
	  <td width="25%" align="left" >
		<?php echo get_db_field_value('wl_customers','company_name',"WHERE customers_id='".$mres['mem_id']."' AND status !='2'");?>
	  </td>
	  <td width="21%" align="left" ><strong>Category : </strong></td>
	  <td width="35%" align="left" > <?php echo get_db_field_value('wl_categories','category_name',"WHERE category_id='".$mres['category_id']."' AND status='1'");?></td>
	</tr>
	<tr valign="top" >
	  <td align="left" ><strong>Type : </strong></td>
	  <td align="left" ><?php echo get_product_type($mres['prod_type']);?></td>
	  <td align="left" ><strong>For :</strong></td>
	  <td align="left" ><?php echo get_product_for($mres['prod_for']);?></td>
	</tr>
	<tr>
	  <td colspan="4">&nbsp;</td>
	</tr>
	</table>
  
	<table width="100%"  border="0" cellspacing="2" cellpadding="2">
	<tr align="left" bgcolor="#1588BB" class="white">
	  <td colspan="4" bgcolor="#CCCCCC" ><strong> More Details : </strong></td>
	</tr>
	<tr>
	  <td><strong> Image : </strong</td>
	  <td colspan="3"><div><img src="<?php echo get_image('product/images',$mres['product_image'],50,50,'AR');?>"></div></td>
	</tr>
	<tr valign="top" >
	  <td align="left" width="20%"><strong>  Title : </strong></td>
	  <td align="left" colspan="3"><?php echo formatCustomValue(array('val'=>$mres['prod_title']));?></td>
	</tr>
	<tr>
	  <td align="left" ><strong> Short Description : </strong></td>
	  <td align="left" colspan="3"><?php echo formatCustomValue(array('val'=>$mres['short_description']));?></td>
	</tr>
	<tr valign="top" >
	  <td align="left" ><strong>  Detail Description : </strong></td>
	  <td align="left" colspan="3">
	  <?php 
	  if(!is_null($mres['detail_description']))
	  {
		$detail_description_arr = unserialize($mres['detail_description']);
		echo '<ol style="margin:0px;padding-left:15px;">';
		foreach($detail_description_arr as $val)
		{
		  echo '<li>'.$val.'</li>';
		}
		echo '</ol>';
	  }
	  else
	  {
		echo "-";
	  }
	  ?>
	  </td>
	</tr>
	<tr>
	  <td align="left" ><strong> Why to Choose : </strong></td>
	  <td align="left" colspan="3">
	  <?php 
	  if(!is_null($mres['why_to_choose']))
	  {
		$why_to_choose_arr = unserialize($mres['why_to_choose']);
		echo '<ol style="margin:0px;padding-left:15px;">';
		foreach($why_to_choose_arr as $val)
		{
		  echo '<li>'.$val.'</li>';
		}
		echo '</ol>';
	  }
	  else
	  {
		echo "-";
	  }
	  ?>
	  </td>
	</tr>
	</table>
  </td>
</tr>
</table>
</body>
</html>