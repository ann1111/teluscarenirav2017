<div class="pt10">
<?php
if(is_array($res) && !empty($res))
{
  $arr_type_establishment = $this->db->select('fld_id,fld_value')->order_by('fld_value','asc')->get_where('wl_company_type',array('status'=>'1','cat_type'=>'banking_finance_insurance'))->result_array();

  $arr_type_establishment = (!is_array($arr_type_establishment) || empty($arr_type_establishment)) ? array() : $arr_type_establishment;

  $ref_type_establishment = array();

  foreach($arr_type_establishment as $val)
  {
	$ref_type_establishment[$val['fld_id']] = $val['fld_value'];
  }

  $arr_looking_for = $this->db->select('fld_id,fld_value')->order_by('fld_value')->get_where('wl_looking_for',array('status'=>'1','cat_type'=>'banking_finance_insurance'))->result_array();

  $arr_looking_for = (!is_array($arr_looking_for) || empty($arr_looking_for)) ? array() : $arr_looking_for;

  $ref_looking_for = array();

  foreach($arr_looking_for as $val)
  {
	$ref_looking_for[$val['fld_id']] = $val['fld_value'];
  }

  if($res['data_type']=='sme_corporate')
  {
  ?>
	<h2>SME Corporate Finance & Loan</h2>
	<div class="input_l"> 
	  <p class=" pt8 b">Name</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['name']));?>
	  </p>
	  <div class="cb pb15"></div>
	</div>

	<div class="input_r"> 
	  <p class="pt8 b">Landline No</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['landline_no']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>

	<div class="input_l"> 
	  <p class="pt8 b">Mobile No</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['mobile_no']));?>
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
	  <p class="pt8 b">Designation</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['designation']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>
	<div class="input_l">
		<p class=" pt8 b">Annual turnover of the company</p>
		<p class="mt3">
		  <?php echo formatCustomValue(array('val'=>$res['company_annual_turnover']));?>
		</p>
		<div class="cb pb5"></div>
	  </div>

	  <div class="input_r">
		<p class="pt8 b">How Old Company</p>
		<p class="mt3">
		  <?php echo formatCustomValue(array('val'=>$res['old_company']));?>
		</p>
		<div class="cb pb5"></div>
	  </div>
	  <div class="cb"></div>


	  <div class="input_l">
		<p class="pt8 b">Type of Company Establishment</p>
		<div class="mt3">
		  <?php echo formatCustomValue(array('val'=>$res['type_establishment'],'ref_arr'=>$ref_type_establishment));?>
		</div>
		<div class="cb pb5"></div>
	  </div>

	  <div class="input_r"> 
		<p class="pt8 b">Looking For</p>
		<p class="mt3">
		  <?php echo formatCustomValue(array('val'=>$res['looking_for'],'ref_arr'=>$ref_looking_for));?>
		</p>
		<div class="cb pb5"></div>
	  </div>
	  <div class="cb"></div>

	  <div class="input_l"> 
		<p class="pt8">No of Employes</p>
		<p class="mt3">
		  <?php echo formatCustomValue(array('val'=>$res['no_employees']));?>
		</p>
		<div class="cb pb5"></div>
	  </div>
	  <div class="input_r"> 
		<p class="pt8 b">Job Nature of company</p>
		<p class="mt3">
		 <?php echo formatCustomValue(array('val'=>$res['company_nature']));?> 
		</p>
		<div class="cb pb5"></div>
	  </div>
  <?php
  }
  if($res['data_type']=='individual_finance')
  {
  ?>
	<h2>Individual Finance</h2>
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
	  <p class="pt8 b">Email Id</p>
	  <div class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['email']));?>
	  </div>
	  <div class="cb pb5"></div>
	</div>
	<div class="cb"></div>
	<div class="input_l">      
	  <p class="pt8 b">Length of service in company</p>
	  <p class="mt3">
		<?php echo formatCustomValue(array('val'=>$res['length_service']));?>
	  </p>
	  <div class="cb pb5"></div>
	</div>

	<div class="input_r">      
	  <p class="pt8 b">Salary per month</p>
	  <p class="mt3">
		<?php echo display_price($res['salary_per_month']);?>
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
}
?>
</div>
<div class="cb"></div>