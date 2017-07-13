<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-s6z2{text-align:center}
.tg .tg-spn1{background-color:#f9f9f9;text-align:center}
.tg .tg-4eph{background-color:#f9f9f9}
.success{  font-size: 20px;  margin: 0 0 0 500px; color:green;}

</style>

<div class="w90 auto mt90 ">
<p class="fr mt1"><a href="<?php echo base_url(); ?>vendors/motorservicing" class="btn1 radius-20t" title="�Go Back">Go Back</a> </p>
<h2 class="bb1 pb5 black text-center"> Edit & Update - Rates - Motor Servicing</h2>
		<table class="tg w100 mt40 mb40">
			<tr class="bg_gray">
				<th>VEHICLE TYPE</th>
				<th>MAKER NAME</th>
				<th>MODELS</th>
				<th>LEVEL OF SERVICES</th>
				<th>FEATURE OF SERVICES</th>
				<th>ADDON</th>
				<th>RATE</th>
				<td></td>
			</tr>
			<?php foreach($vendor_data as $vd){ /* echo '<pre>'; print_r($vd); */?>
			<tr class="text-center">
				<td><?php echo get_vehicle_type($vd['vehicle_type']); ?></td>
				<td><?php echo $vd['maker']; ?></td>
				<td><?php echo $vd['model']; ?></td>
				<td><?php echo $vd['level_of_services']; ?></td>
				<td><?php echo $vd['feature_of_services']; ?></td>
				<td><?php echo $vd['add_ons']; ?></td>
				<td><?php echo $vd['rate']; ?></td>
				<td><?php echo form_open('/vendors/motorservicing/submit_vehicle_type', 'id="vend_vehicle_data"'); ?>
				<input type="hidden" name="id" value="<?php echo $vd['id']; ?>" />
				<input type="submit" name="submit" value="EDIT" name="submit" />
				<?php echo form_close(); ?></td>
			</tr>
			<?php } ?>
		
		</table>
			



	<?php 
	$models = explode(',',$selected_model);  
	foreach($status as $ss){  if($ss['success']){ echo '<span class="success">'.$ss.'</span>'; }else{echo '<span class="red">'.$ss.'</span>'; } }
	?>	

	<h2 class="bb1 pb5 black text-center"> Edit & Update - Rates - Motor Servicing</h2>
	<div class="cb mb15"></div>
	
	<?php echo form_open_multipart('/vendors/motorservicing/update_vehicle_info', 'id="update_vehicle_data"'); ?>
<div class="mt20 w80 short_form fs14 auto p20 border1">

	  <fieldset class="pb15 mt30" style="border:0;">

		<p class="w36 pt8">

		  <label for="type_service">VEHICLE TYPE : <b class="red">*</b></label>
		</p>

		<div class="w62">
			<select class="form-control" name="vehicletype" id="Vehicle_type" tabindex="-98">		
				<option value="">Select</option>	
				<?php foreach($vehicle_types as $vt){ 
					if($selected_v_type == $vt['vehicle_type']){
				?>              
				<option value="<?php echo $vt['vehicle_type'] ?>" selected><?php echo get_vehicle_type($vt['vehicle_type']); ?></option>	
				<?php }else{ ?>	
				<option value="<?php echo $vt['vehicle_type'] ?>"><?php echo get_vehicle_type($vt['vehicle_type']); ?></option>
				<?php } ?>					
				<?php } ?>					
			</select>	
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
		</div>

		<div class="cb pb10"></div>
		<p class="w36 pt8">

		  <label for="upload_doc">MAKER NAME : <b class="red">*</b></label>

		</p>
		<div class="w62">
			<select class="form-control" name="vehicle_name" id="vehicle_name" tabindex="-98">		
				<option value="">Select</option>		
				<?php foreach($vehicle as $vehicle_name){
						if($selected_maker == $vehicle_name['makeby']){
				?>   
				<option value="<?php echo $vehicle_name['makeby']; ?>" selected>
				<?php echo $vehicle_name['makeby']; ?></option>	
				<?php }else{ ?>   
				<option value="<?php echo $vehicle_name['makeby']; ?>">
				<?php echo $vehicle_name['makeby']; ?></option>	
				<?php } ?>       	      
				<?php } ?>       	      
			</select>	
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">

		  <label for="upload_doc">MODELS : <b class="red">*</b></label>

		</p>
		<div class="w62">
			<label><input type="checkbox" id="select_all" name="sel_all" value="1" />Select All</label>
			<div id="vehicle_models" class="multiselect">			
			</div>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">

		  <label for="upload_doc">Level Of Services : <b class="red">*</b></label>

		</p>
		<div class="w62">
			<?php echo get_level_of_services_field('level_of_services','level_of_services',$selected_level_of_services);   ?>			
			</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">

		  <label for="upload_doc">Feature Of Services : <b class="red">*</b></label>

		</p>
		<div class="w62">
			<textarea id="featureofServices" name="featureofServices" maxlength="250"><?php echo $selected_feature_of_services; ?></textarea>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
			<label for="upload_doc">ADD ON : <b class="red">*</b></label>
		</p>
		<div class="w62">
			<textarea name="addon" maxlength="250" ><?php echo $selected_add_ons; ?></textarea>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
			<label for="upload_doc">Enter Rate (AED) : <b class="red">*</b></label>
		</p>
		<div class="w62">
			<input type="text" name="rate" class="form-control" value="<?php echo $selected_rate; ?>"/>
		</div>
	</fieldset>

	</div>	
	  <div class="cb mb15"></div>
	  <div class="fl w25 short_form ml16">
		<p class="mt6" style="width:100%"></p>
	  </div>
	 <div class="fl w70 short_form ml16">
		<p class="mt6" style="width:50%;text-align:center;">
			<input name="sbt_btn" value="Update Information" id="Update_rates" class="btn3 radius-3 trans_eff" type="submit">
		</p>
	 </div>
	 
	 <?php echo form_close(); ?>
	 
</div>


	 
 <div class="cb mb15"></div>	
<style>
.multiselect {padding: 5px;width: 65%;height:100px;border-radius: 5px;border: 1px solid #999;font-size: 14px;cursor: pointer;}.multiselect-on {    color:#ffffff;    background-color:#000099;}
</style>
	
<script>

  $("#select_all").click(function(){  //"select all" change
	var status = this.checked; // "select all" checked status
    $('.multiselect input[type=checkbox]').each(function(){ //iterate all listed checkbox items
        this.checked = status; //change ".checkbox" checked status
    });
});
  
  $('#body_id').on('change', function (e) {
					
		var optionSelected = $(this).val();
			
		if(optionSelected){
			$('#body_veh_id').show();
		}else{
			$('#body_veh_id').hide();
			}
	});/* SHOW EXCLUDE VALUES  */
	$('#exclude_button').click(function(){$.ajax({    
	type      : 'POST', 
	url       : '<?php echo base_url(); ?>vendors/motor/add_vendor_exclude_in_session', 
	data      : $('#exclude_data').serialize(),	
	success   : function(data_w) {			
	location.reload();		
	
	/* var vehicle_t = $('#Vehicle_type').val();	
	var vehicle_name = $('#vehicle_name').val();	
	var vehicle_models = $('#vehicle_models').val();
	var vehicle_year = $('#vehicle_year').val();	
	var driver_age = $('#driver_age').val();	
	var drving = $('#drving').val();			
	var country_id = $('#country_id').val();		
	var gcc_status = $('#gcc_status').val();		
	var vehicle_register = $('#vehicle_register').val();

	if(vehicle_t != ''){  $('#Vehicle_type_field').html(vehicle_t); }	
	if(vehicle_name != ''){  $('#vehicle_name_field').html(vehicle_name); }	
	if(vehicle_models != ''){  $('#vehicle_models_field').html(vehicle_models); }	
	if(vehicle_year != ''){  $('#vehicle_year_field').html(vehicle_year); }		
	if(driver_age != ''){  $('#driver_age_field').html(driver_age); }			
	if(drving != ''){  $('#drving_field').html(drving); }			
	if(country_id != ''){  $('#country_id_field').html(country_id); }	
	if(gcc_status != ''){  $('#gcc_status_field').html(gcc_status); }		
	if(vehicle_register != ''){  $('#vehicle_register_field').html(vehicle_register); } */							
	}	
	});	
	});	
			
$(document).ready(function(){
	
	$('#vehicle_models').empty();
	 $.ajax({ 
        type      : 'POST', 
        url       : '<?php echo base_url(); ?>vendors/motorservicing/get_vehicle_models', 
        data      : {'vehicle_name': '<?php echo $selected_maker; ?>'},
		success   : function(data_w) {
			
				var cars = data_w;
				var array = [];
				var arraynd = [<?php $models; ?>];
				
				for(var i in cars) {
						if(cars.hasOwnProperty(i) && !isNaN(+i)) {
							array[+i] = cars[i].model;
						}
						
						$('#vehicle_models').append(
						'<label><input type="checkbox" name="vehicle_models[]" value='+cars[i].model+' />'+cars[i].model+'</label>');
					
				}
			}
		});
	
	
	
	
});
			
			
/* CONVERT JSON OBJECT VALUE TO ARRAY */			
$('#vehicle_name').change(function(){	

	var vehicle_name =	$(this).val();

	$('#vehicle_models').empty();
	 $.ajax({ 
        type      : 'POST', 
        url       : '<?php echo base_url(); ?>vendors/motorservicing/get_vehicle_models', 
        data      : {'vehicle_name': vehicle_name},
		success   : function(data_w) {
			
				var cars = data_w;
				var array = [];
				
				for(var i in cars) {
						if(cars.hasOwnProperty(i) && !isNaN(+i)) {
							array[+i] = cars[i].model;
						}
						
					$('#vehicle_models').append(
					'<label><input type="checkbox" name="vehicle_models[]" value='+cars[i].model+' />'+cars[i].model+'</label>'
					);
				}
			}
		});
		
	$("input:checkbox").on('click', function() {
  
	  var $box = $(this);
	  if ($box.is(":checked")) {
	   var group = "input:checkbox[name='" + $box.attr("name") + "']";
		$(group).prop("checked", false);
		$box.prop("checked", true);
	  } else {
		$box.prop("checked", false);
	  }
	});
	
});
</script>
<?php $this->load->view("bottom_application");?>