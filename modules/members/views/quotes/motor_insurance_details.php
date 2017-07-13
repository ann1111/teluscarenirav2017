<div class="pt10">
<?php
if(is_array($res) && !empty($res))
{
  $arr_type_establishment = $this->db->select('fld_id,fld_value')->order_by('fld_value','asc')->get_where('wl_company_type',array('status'=>'1','cat_type'=>'motor_insurance'))->result_array();

  $arr_type_establishment = (!is_array($arr_type_establishment) || empty($arr_type_establishment)) ? array() : $arr_type_establishment;

  $ref_type_establishment = array();

  foreach($arr_type_establishment as $val)
  {
	$ref_type_establishment[$val['fld_id']] = $val['fld_value'];
  }

  $arr_looking_for = $this->db->select('fld_id,fld_value')->order_by('fld_value')->get_where('wl_looking_for',array('status'=>'1','cat_type'=>'motor_insurance'))->result_array();

  $arr_looking_for = (!is_array($arr_looking_for) || empty($arr_looking_for)) ? array() : $arr_looking_for;

  $ref_looking_for = array();

  foreach($arr_looking_for as $val)
  {
	$ref_looking_for[$val['fld_id']] = $val['fld_value'];
  }

  if($res['data_type']=='group_fleet')
  {
  ?>
	<h2>Group/Fleet</h2>
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
	  <p class="pt8 b">Email</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['email']));?>
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
	  <p class="pt8 b">Type Of Establishment</p>
	  <div class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['type_establishment'],'ref_arr'=>$ref_type_establishment));?>
	  </div>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l"> 
	  <p class="pt8 b">Job Nature of company</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['company_nature']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>

	<div class="input_r"> 
	  <p class="pt8 b">No of vehicles</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['no_vehicles']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l"> 
	  <p class="pt8 b">Looking For</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['looking_for'],'ref_arr'=>$ref_looking_for));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
  <?php
  }
  if($res['data_type']=='individual_motor')
  {
  ?>
	<h2>Individual Motor</h2>
	<div class="input_l"> 
	  <p class=" pt8 b">Name</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['name']));?>
	  </p>
	  <div class="cb pb15"></div>
	</div>

	<div class="input_r"> 
	  <p class="pt8 b">Model Name</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['model_name']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l"> 
	  <p class="pt8 b">Make Year</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['make_year']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>

	<div class="input_r"> 
	  <p class="pt8 b">Value Of Motor</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['value_motor']));?>
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
	  <p class="pt8 b">looking For</p>
	  <div class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['looking_for'],'ref_arr'=>$ref_looking_for));?>
	  </div>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>
  <?php
  }
}
?>
</div>
<div class="cb"></div>