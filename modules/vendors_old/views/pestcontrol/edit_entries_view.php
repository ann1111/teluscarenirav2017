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
<p class="fr mt1"><a href="<?php echo base_url(); ?>vendors/pestcontrol" class="btn1 radius-20t" title="�Go Back">Go Back</a> </p>
<h2 class="bb1 pb5"> Edit & Update - Rates - Pest Control Service </h2>
		<table class="tg">
			<tr>
				<td>TYPE OF SERVICE</td>
				<td>TYPE OF PREMISES</td>
				<td>KIND OF PREMISES</td>
				<td>APPROX AREA</td>
				<td>RATE</td>
				<td></td>
			</tr>
			<?php foreach($vendor_data as $vd){ ?>
			<tr>
				<td><?php echo get_types_of_services($vd['type_of_service']); ?></td>
				<td><?php echo get_type_of_premise($vd['type_of_premises']); ?></td>
				<td><?php echo get_kind_of_premise($vd['kind_of_premises'],$vd['type_of_premises']); ?></td>
				<td><?php echo get_approx_area($vd['approx_area']); ?></td>
				<td><?php echo $vd['rate']; ?></td>
				<td><?php echo form_open('/vendors/pestcontrol/submit_vehicle_type', 'id="vend_vehicle_data"'); ?>
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

	<h2 class="bb1 pb5 scroll_upto"> Edit & Update - Rates - Pest Control Service</h2>
	<div class="cb mb15"></div>
	
	<?php echo form_open_multipart('/vendors/pestcontrol/update_vehicle_info', 'id="update_vehicle_data"'); ?>	
	
	<div class="fl w32 short_form ml16">	
		<p>TYPE OF SERVICE <b class="red">*</b></p>
		<p class="mt6" style="width:100%">	
		<?php echo get_pest_type_of_service_field('type_of_service','type_of_service',$type_of_service); ?>
		</p>	
		<input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	</div>	

	<div class="fl w32 short_form ml16">	
	<p>TYPE OF PREMISES <b class="red">*</b></p>	
		<p class="mt6" style="width:100%">		
			<?php echo get_type_of_premises_field('premises','premises',$type_of_premises); ?>
		</p>	  
	</div>

	
	<div class="fl w32 short_form ml16 kop">	
		<p>KIND OF PREMISES <b class="red">*</b></p>	
		<?php  $data = $kind_of_premises != '' ? $kind_of_premises : $approx_area;  ?>
		<?php echo get_kind_of_premises_field('kind_premises','kind_premises',$data,$type_of_premises); ?>
			
	</div>	 
	
	

	<div class="cb mb15"></div>
	<!--<div class="fl w32 short_form ml16">
		<p>APPROX AREA<b class="red">*</b></p>
		<p class="mt6">			
			<?php echo get_area_sqrt_field('area','area',$approx_area); ?>
		</p>	 
	</div>	 --> 

		
		<div class="fl w32 short_form ml16">	
			<p> ENTER RATE (AED) <b class="red">*</b></p>	
			<p class="mt6" style="width:100%">	
				<input type="text" name="rate" class="form-control" value="<?php echo $rate; ?>"/>	
			</p>	
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
.multiselect {    width:20em;    height:15em;    border:solid 1px #c0c0c0;    overflow:auto;}.multiselect label {    display:block;	font-weight:600;}.multiselect-on {    color:#ffffff;    background-color:#000099;}
</style>
	<script>

				$('document').ready(function(){
					
					$('.premises').on('change',function(){
						var get_val = $(this).val();
						if(get_val == 1 || get_val == 3 ){
							
							$('.kop').html('<p>Kind of Premises<b class="red">*</b></p><p class="mt6" style="width:100%"><select id="kind_premises" name="kind_premises" class="form-control"></select></p>');
							if(get_val == 3){
								var elem = ["STUDIO","1 BHK","2 BHK","3 BHK","4 BHK","5 BHK"];  
							}else{
								var elem = ["Select","1 BHK","2 BHK","3 BHK","4 BHK","5 BHK"];     
							}
							
							var sel = document.getElementById('kind_premises');
							for(var i = 0; i < elem.length; i++) {
								var opt = document.createElement('option');
								opt.innerHTML = elem[i];
								opt.value = i;
								sel.appendChild(opt);
							}
							
						}if(get_val == 2 || get_val == 4 || get_val == 5){
							$('.kop').html('<p>Approx Area<b class="red">*</b></p><p class="mt6" style="width:100%"><select id="area" name="area" class="form-control"></select></p>');
							
							var elem = ["Select","below 500 sqft","500 sqft to 1000 sqft","1000 sqft to 2000 sqft","2000 sqft to 3000 sqft","3000 sqft to 4000 sqft","4000 sqft to 5000 sqft","5000 sqft to 7000 sqft","7000 sqft to 10000 sqft","10000 sqft to 20000 sqft","20000 sqft & above"];     

							var sel = document.getElementById('area');
							for(var i = 0; i < elem.length; i++) {
								var opt = document.createElement('option');
								opt.innerHTML = elem[i];
								opt.value = i;
								sel.appendChild(opt);
							}
						}
						
					});
				});
			
			
</script>
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