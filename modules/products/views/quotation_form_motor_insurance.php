<?php
$data_type = set_value('data_type');
$type_establishment = set_value('type_establishment');
$looking_for1 = set_value('looking_for1');
$looking_for2 = set_value('looking_for2');

$arr_type_establishment = $this->db->select('fld_id,fld_value')->order_by('fld_value')->get_where('wl_company_type',array('status'=>'1','cat_type'=>'motor_insurance'))->result_array();

$arr_type_establishment = (!is_array($arr_type_establishment) || empty($arr_type_establishment)) ? array() : $arr_type_establishment;

$arr_looking_for = $this->db->select('fld_id,fld_value')->order_by('fld_value')->get_where('wl_looking_for',array('status'=>'1','cat_type'=>'motor_insurance'))->result_array();

$arr_looking_for = (!is_array($arr_looking_for) || empty($arr_looking_for)) ? array() : $arr_looking_for;
?>
<?php echo form_open_multipart('');?>
<div class="mt15 p25 border1 bg-gray1 bb fs16 bg-gray1 p20 border1 radius-5">
  <div class="mt15 mb15">
	<div class="fl w20 "></div>
	<div class="fl w65">
	  <p class="myinput">
		<label ><input type="radio" name="data_type" value="group_fleet" id="RadioGroup1_0" class="check1" <?php echo $data_type=='group_fleet' ? ' checked="checked"' : '';?>>Group/Fleet </label>

		<label class="check2 ml20"><input type="radio" name="data_type" value="individual_motor" id="RadioGroup1_1" class="check2" <?php echo $data_type=='individual_motor' ? ' checked="checked"' : '';?>>
Individual Motor</label>
		<br>
		<?php echo form_error('data_type');?>
	  </p>
	</div> 
	<div class="cb"></div>
  </div>
  <div class="form_box short_form fs14 <?php echo $data_type!=='group_fleet' ? 'dn"' : '';?>" id="form_1">
	<fieldset class=" mt30 p10" >
	  <legend class="b fs18 b mb30 blue"> Company Information :</legend>
	  <!--p class="w36 pt8"><label for="name">Are You Assurance Member  :</label></p>
	  <p class="w62 pt8">
		<label><input type="radio" name="RadioGroup2" value="radio" id="RadioGroup2_0">Yes</label>
		<label class="ml20"><input type="radio" name="RadioGroup2" value="radio" id="RadioGroup2_1">No</label>
		<br>
	  </p>

	  <div class="cb pb5"></div-->
	  <div class="input_l"> 
		<p class=" pt8"><label for="name1">Name <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="name1" id="name1" type="text" value="<?php echo set_value('name1');?>">
		  <?php echo form_error('name1');?>
		</p>
		<div class="cb pb15"></div>
	  </div>

	  <div class="input_r"> 
		<p class="pt8"><label for="designation">Designation. <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="designation" id="designation" type="text" value="<?php echo set_value('designation');?>">
		  <?php echo form_error('designation');?>
		</p>
		<div class="cb pb5"></div>
	  </div>
	  <div class="cb"></div>

	  <div class="input_l"> 
		<p class="pt8"><label for="Landline">Landline No. <b class="red">*</b> :</label> </p>
		<p class="mt3">
		  <input name="landline_no" id="Landline" type="text" value="<?php echo set_value('landline_no');?>">
		  <?php echo form_error('landline_no');?>
		</p>
		<div class="cb pb5"></div>
	  </div>

	  <div class="input_r"> 
		<p class="pt8"><label for="email">Email. <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="email" id="email" type="text" value="<?php echo set_value('email');?>">
		  <?php echo form_error('email');?>
		</p>
		<div class="cb pb5"></div>
	  </div>
	  <div class="cb"></div>

	  <div class="input_l"> 
		<p class="pt8"><label for="country1">Country <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <?php echo CountrySelectBox(array('name'=>'country1','format'=>'','current_selected_val'=>set_value('country1') )); ?>
		  <?php echo form_error('country1');?>
		</p>
		<div class="cb pb5"></div>
	  </div>

	  <div class="input_r">       
		<p class=" pt8"><label for="city1">City <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="city1" id="city1" type="text" value="<?php echo set_value('city1');?>">
		  <?php echo form_error('city1');?>
		</p>
		<div class="cb pb5"></div>
	  </div>
	  <div class="cb"></div>

	  <div class="input_l"> 
		<p class="pt8"><label for="company_name1">Company Name  <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="company_name1" id="company_name1" type="text" value="<?php echo set_value('company_name1');?>">
		  <?php echo form_error('company_name1');?>
		</p>
		<div class="cb pb5"></div>
	  </div>

	  <div class="input_r"> 
		<p class="pt8"> <label for="company_estab">Type Of Establishment  <b class="red">*</b> :</label></p>
		<div class="mt3">
		  <select name="type_establishment" id="company_estab">
			<option value="">Select</option>
			<?php
			if(is_array($arr_type_establishment) && !empty($arr_type_establishment))
			{
			  foreach($arr_type_establishment as $val)
			  {
			  ?>
				<option value="<?php echo $val['fld_id'];?>"<?php echo $type_establishment==$val['fld_id'] ? ' selected="selected"' : '';?>><?php echo $val['fld_value'];?></option>
			<?php
			  }
			}
			?>
		  </select>
		  <?php echo form_error('type_establishment');?>
		</div>
		<div class="cb pb5"></div>
	  </div>
	  <div class="cb"></div>

	  <div class="input_l"> 
		<p class="pt8"><label for="company_nature">Job Nature of company   <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="company_nature" id="company_nature" type="text" value="<?php echo set_value('company_nature');?>">
		  <?php echo form_error('company_nature');?>
		</p>
		<div class="cb pb5"></div>
	  </div>

	  <div class="input_r"> 
		<p class="pt8"><label for="no_vehicles">No of vehicles   <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="no_vehicles" id="no_vehicles" type="text" value="<?php echo set_value('no_vehicles');?>">
		  <?php echo form_error('no_vehicles');?>
		</p>
		<div class="cb pb5"></div>
	  </div>
	  <div class="cb"></div>

	  <div class="input_l"> 
		<p class="pt8"><label for="looking_for1">Looking For    <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <select name="looking_for1" id="looking_for1">
			<option value="">Select</option>
			<?php
			if(is_array($arr_looking_for) && !empty($arr_looking_for))
			{
			  foreach($arr_looking_for as $val)
			  {
			  ?>
				<option value="<?php echo $val['fld_id'];?>"<?php echo $looking_for1==$val['fld_id'] ? ' selected="selected"' : '';?>><?php echo $val['fld_value'];?></option>
			<?php
			  }
			}
			?>
		  </select>
		  <?php echo form_error('looking_for1');?>
		</p>
		<div class="cb pb5"></div>
	  </div>
	</fieldset>
	<div class="cb p8"></div>
  </div>

  <div class="form_box short_form <?php echo $data_type!=='individual_motor' ? 'dn' : '';?> fs14" id="form_2">
	<fieldset class=" mt30 p10" >
	  <legend class="b fs18 b mb30 blue"> Personal Information :</legend>
	  <!--p class="w36 pt8"><label for="name">Are You Assurance Member  :</label></p>
	  <p class="w62 pt8">
		<label><input type="radio" name="RadioGroup2" value="radio" id="RadioGroup2_0">Yes</label>
		<label class="ml20"><input type="radio" name="RadioGroup2" value="radio" id="RadioGroup2_1">No</label>
		<br>
	  </p>

	  <div class="cb pb5"></div-->
	  <div class="input_l"> 
		<p class=" pt8"><label for="name2">Name <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="name2" id="name2" type="text" value="<?php echo set_value('name2');?>">
		  <?php echo form_error('name2');?>
		</p>
		<div class="cb pb5"></div>
	  </div>

	  <div class="input_r"> 
		<p class="pt8"><label for="model_name">Model Name . <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="model_name" id="model_name" type="text" value="<?php echo set_value('model_name');?>">
		  <?php echo form_error('model_name');?>
		</p>
		<div class="cb pb5"></div>
	  </div>
	  <div class="cb"></div>

	  <div class="input_l">      
		<p class="pt8"><label for="make_year">Make Year . <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="make_year" id="make_year" type="text" value="<?php echo set_value('make_year');?>">
		  <?php echo form_error('make_year');?>
		</p>
		<div class="cb pb5"></div>
	  </div>

	  <div class="input_r">      
		<p class="pt8"><label for="value">Value of Motor . <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="value_motor" id="value" type="text" value="<?php echo set_value('value_motor');?>">
		  <?php echo form_error('value_motor');?>
		</p>
		<div class="cb pb5"></div>
	  </div>
	  <div class="cb"></div>

	  <div class="input_l"> 
		<p class=" pt8"><label for="country2">Country <b class="red">*</b> :</label> </p>
		<p class="mt3">
		  <?php echo CountrySelectBox(array('name'=>'country2','format'=>'','current_selected_val'=>set_value('country2') )); ?>
		  <?php echo form_error('country2');?>
		</p>
		<div class="cb pb5"></div>
	  </div>

	  <div class="input_r">       
		<p class="pt8"><label for="city2">City <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="city2" id="city2" type="text" value="<?php echo set_value('city2');?>">
		  <?php echo form_error('city2');?>
		</p>
		<div class="cb pb5"></div>
	  </div>
	  <div class="cb"></div>
	  <div class="input_l"> 
		<p class="pt8"><label for="company_name2">Company Name  <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <input name="company_name2" id="company_name2" type="text" value="<?php echo set_value('company_name2');?>">
		  <?php echo form_error('company_name2');?>
		</p>
		<div class="cb pb5"></div>
	  </div>


	  <div class="input_r">       
		<p class="pt8"><label for="looking_for2">Looking For    <b class="red">*</b> :</label></p>
		<p class="mt3">
		  <select name="looking_for2" id="looking_for2">
			<option value="">Select</option>
			<?php
			if(is_array($arr_looking_for) && !empty($arr_looking_for))
			{
			  foreach($arr_looking_for as $val)
			  {
			  ?>
				<option value="<?php echo $val['fld_id'];?>"<?php echo $looking_for2==$val['fld_id'] ? ' selected="selected"' : '';?>><?php echo $val['fld_value'];?></option>
			<?php
			  }
			}
			?>
		  </select>
		  <?php echo form_error('looking_for2');?>
		</p>
		<div class="cb pb5"></div>
	  </div>
	  <div class="cb"></div>
	</fieldset>

  </div>

  <fieldset class=" mt20 p10" >
	<legend class="b fs18 b mb10 blue"> Comments and Attachment</legend>
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
  </fieldset>
  <div class="cb p8"></div>
  <input name="post" type="submit" value="Submit" class="btn3 radius-3 trans_eff">
  <input name="rst_btn" type="reset" value="Reset" class="btn3x radius-3 trans_eff">
</div>
<?php echo form_close();?>
<div class="cb p8"></div>