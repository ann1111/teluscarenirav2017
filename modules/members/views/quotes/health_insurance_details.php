<div class="pt10">
<?php
if(is_array($res) && !empty($res))
{
  $arr_type_establishment = $this->db->select('fld_id,fld_value')->order_by('fld_value','asc')->get_where('wl_company_type',array('status'=>'1','cat_type'=>'health_insurance'))->result_array();

  $arr_type_establishment = (!is_array($arr_type_establishment) || empty($arr_type_establishment)) ? array() : $arr_type_establishment;

  $ref_type_establishment = array();

  foreach($arr_type_establishment as $val)
  {
	$ref_type_establishment[$val['fld_id']] = $val['fld_value'];
  }

  $arr_looking_for = $this->db->select('fld_id,fld_value')->order_by('fld_value')->get_where('wl_looking_for',array('status'=>'1','cat_type'=>'health_insurance'))->result_array();

  $arr_looking_for = (!is_array($arr_looking_for) || empty($arr_looking_for)) ? array() : $arr_looking_for;

  $ref_looking_for = array();

  foreach($arr_looking_for as $val)
  {
	$ref_looking_for[$val['fld_id']] = $val['fld_value'];
  }

  if($res['data_type']=='group_health')
  {
  ?>
	<h2>Group Health</h2>
	<div class="input_l"> 
	  <p class=" pt8 b">Name</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['name']));?>
	  </p>
	  <div class="cb pb15"></div>
	</div>

	<div class="input_r">
	  <p class="pt8 b">Designation</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['designation']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l"> 
	  <p class="pt8 b">Landline No</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['landline_no']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>

	<div class="input_r">
	  <p class="pt8 b">Mobile No</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['mobile_no']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l">
	  <p class="pt8 b">Email</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['email']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>

	<div class="input_r">
	  <p class="pt8 b">Country</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['country']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l">
	  <p class=" pt8 b">City</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['city']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>

	<div class="input_r">
	  <p class="pt8 b">Company Name</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['company_name']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l">
	  <p class="pt8 b">Type Of Establishment</p>
	  <div class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['type_establishment'],'ref_arr'=>$ref_type_establishment));?>
	  </div>
	  <div class="cb pb5"></div>
	</div>

	<div class="input_r"> 
	  <p class="pt8 b">Job Nature of company</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['company_nature']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>
	<div class="input_l"> 
	  <p class="pt8 b">Approx no. of Employees</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['approx_employees']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<div class="input_r"> 
	  <p class="pt8 b">Looking For</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['looking_for'],'ref_arr'=>$ref_looking_for));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
  <?php
  }
  if($res['data_type']=='individual_family')
  {
  ?>
	<h2>Individual & Family</h2>
	<div class="input_l"> 
	  <p class=" pt8 b">Name</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['name']));?>
	  </p>
	  <div class="cb pb15"></div>
	</div>

	<div class="input_r"> 
	  <p class="pt8 b">Age</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['age']));?> years
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l"> 
	  <p class="pt8 b">Country</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['country']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>

	<div class="input_r">       
	  <p class=" pt8 b">City</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['city']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l"> 
	  <p class="pt8 b">Company Name</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['company_name']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>

	<div class="input_r"> 
	  <p class="pt8 b">Looking For</p>
	  <div class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['looking_for'],'ref_arr'=>$ref_looking_for));?>
	  </div>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>
	<div class="input_l">      
	  <p class="pt8 b">No. of Members</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['no_members']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<?php
	if(!is_null($res['member_details']))
	{
	  $arr_mem_detail = unserialize($res['member_details']);
	  if(is_array($arr_mem_detail) && !empty($arr_mem_detail))
	  {
		//trace($arr_mem_detail);
	  ?>
		<div class="cb pb5"></div>
		<h4>Member Details</h4>
		<table width="60%" border=0 cellpadding=0 cellspacing=0 style="border:1px solid #000;">
		<tr>
		  <th align="center">Sl.</th>
		  <th align="center">Name</th>
		  <th align="center">Age</th>
		  <th align="center">Sex</th>
		</tr>
		<?php
		$ix=0;
		foreach($arr_mem_detail['age'] as $key=>$val)
		{
		?>
		  <tr>
			<td width="10%" align="center"><?php echo ++$ix;?></td>
			<td width="20%" align="center"><?php echo array_key_exists('name',$arr_mem_detail) ? $arr_mem_detail['name'][$key] : '';?></td>
			<td width="15%" align="center"><?php echo $val;?> years</td>
			<td width="15%" align="center"><?php echo $arr_mem_detail['sex'][$key]=='M' ? 'Male' : 'Female';?></td>
		  </tr>
		<?php
		}
		?>
		</table>
		<div class="cb"></div>
	  <?php
	  }
	}
  }
}
?>
</div>
<div class="cb"></div>