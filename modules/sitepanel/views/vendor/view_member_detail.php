<?php $this->load->view('includes/face_header'); ?>
<?php
$this->load->helper('products/product'); 
$overall_rating = product_overall_rating($mres['customers_id'],'customer');
?>
<table width="100%" border="0" cellspacing="4" cellpadding="0" class="grey">
<tr valign="top" >
  <td colspan="4" align="right" >
	<p><?php echo rating_html($overall_rating,5);?></p>
	<table width="100%"  border="0" cellspacing="2" cellpadding="2">
	<tr align="left" bgcolor="#1588BB" class="white">
	  <td colspan="7" bgcolor="#CCCCCC" ><strong> Personal Details : </strong></td>
	</tr>
	<!--tr valign="top" >
	  <td align="left" ><strong>Title : </strong></td>
	  <td align="left" ><?php echo $mres['title'];?></td>
	  <td align="left" >&nbsp;</td>
	  <td align="left" >&nbsp;</td>
	</tr-->
	<tr valign="top" >
	  <td width="19%" align="left" ><strong>  Name : </strong></td>
	  <td width="25%" align="left" >
		<?php echo $mres['first_name'];?> <?php echo $mres['last_name'];?>
	  </td>
	  <td width="21%" align="left" ><strong>Register Date : </strong></td>
	  <td width="35%" align="left" > <?php echo $mres['account_created_date'];?></td>
	</tr>
	<tr valign="top" >
	  <td align="left" ><strong>User Id : </strong></td>
	  <td align="left" ><?php echo $mres['user_name'];?></td>
	  <td align="left" ><strong>Password. :</strong></td>
	  <td align="left" ><?php echo $this->safe_encrypt->decode($mres['password']);?></td>
	</tr>
	<tr valign="top" >
	  <td align="left" ><strong>Type : </strong></td>
	  <td align="left" ><?php echo formatCustomValue(array('val'=>$mres['vendor_type'],'ref_arr'=>$this->vendor_type_arr));?></td>
	  <td align="left" ><strong>Category. :</strong></td>
	  <td align="left" ><?php echo get_db_field_value('wl_categories','category_name',"WHERE category_id='".$mres['ref_cat_id']."' AND status='1'");?></td>
	</tr>
	<tr valign="top" >
	  <td align="left" ><strong>Landline : </strong></td>
	  <td align="left" ><?php echo formatCustomValue(array('val'=>$mres['phone_number']));?></td>
	  <td align="left" ><strong>Mobile : </strong></td>
	  <td align="left" ><?php echo formatCustomValue(array('val'=>$mres['mobile_number']));?></td>
	</tr>
	<tr valign="top" >
	  <td align="left" ><strong>User No : </strong></td>
	  <td align="left" ><?php echo formatCustomValue(array('val'=>$mres['user_no']));?></td>
	  <td align="left" ><strong>Date of Birth : </strong></td>
	  <td align="left" >
	  <?php
	  if(!is_null($mres['birth_date']))
	  {
		echo date("M d,Y",strtotime($mres['birth_date']));
	  }
	  else
	  {
		echo "-";
	  }
	  ?>
	  </td>
	</tr>
	<tr>
	  <td colspan="4">&nbsp;</td>
	</tr>
	</table>
  
	<table width="100%"  border="0" cellspacing="2" cellpadding="2">
	<tr align="left" bgcolor="#1588BB" class="white">
	  <td colspan="4" bgcolor="#CCCCCC" ><strong> Address : </strong></td>
	</tr>

	<tr valign="top" >
	  <td align="left" ><strong>  Address : </strong></td>
	  <td align="left" ><?php echo formatCustomValue(array('val'=>$mres['address']));?></td>
	  <td align="left" ><strong> City : </strong></td>
	  <td align="left" ><?php echo formatCustomValue(array('val'=>$mres['city']));?></td>
	</tr>
	<tr valign="top" >
	  <td align="left" ><strong>  State : </strong></td>
	  <td align="left" ><?php echo formatCustomValue(array('val'=>$mres['state']));?></td>
	  <td align="left" ><strong> Country : </strong></td>
	  <td align="left" ><?php echo formatCustomValue(array('val'=>$mres['country']));?></td>
	</tr>


	<tr valign="top" >
	  <td align="left" ><strong> Postal code : </strong></td>
	  <td align="left" ><?php echo formatCustomValue(array('val'=>$mres['zipcode']));?></td>
	  <td align="left" ><strong> Fax : </strong></td>
	  <td align="left" ><?php echo formatCustomValue(array('val'=>$mres['fax_number']));?></td>
	</tr>
	<tr align="left" valign="top" >
	  <td colspan="4" align="left">&nbsp;</td>
	</tr>
	</table>
	<table width="100%"  border="0" cellspacing="2" cellpadding="5">
	<tr align="left" bgcolor="#1588BB" class="white">
	  <td colspan="2" bgcolor="#CCCCCC" ><strong> Company Profile</strong></td>
	</tr>
	<tr>
	  <td><strong> Logo : </strong</td>
	  <td><div><img src="<?php echo get_image('company_logos',$mres['company_logo'],'113','60','R'); ?>"  alt="" title="" width="113" height="60"></div></td>
	</tr>
	<tr valign="top" >
	  <td align="left" width="30%"><strong> Company Name : </strong></td>
	  <td align="left" ><?php echo formatCustomValue(array('val'=>$mres['company_name']));?></td>
	</tr>
	<tr valign="top" >
	  <td align="left" width="30%"><strong> Short Description : </strong></td>
	  <td align="left" ><?php echo formatCustomValue(array('val'=>$mres['short_description']));?></td>
	</tr>
	<tr valign="top" >
	  <td align="left" ><strong> Why Us : </strong></td>
	  <td align="left" valign="top">
	  <?php 
	  if(!is_null($mres['why_us']))
	  {
		$why_us_arr = unserialize($mres['why_us']);
		echo '<ol style="margin:0px;padding-left:15px;">';
		foreach($why_us_arr as $val)
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
	<tr valign="top" >
	  <td align="left" valign="top"><strong> USP : </strong></td>
	  <td align="left" valign="top">
	  <?php 
	  if(!is_null($mres['usp']))
	  {
		$usp_arr = unserialize($mres['usp']);
		echo '<ol style="margin:0px;padding-left:15px;">';
		foreach($usp_arr as $val)
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