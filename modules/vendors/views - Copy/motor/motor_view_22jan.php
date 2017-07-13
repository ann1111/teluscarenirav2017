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

<div class="w90 auto mt30">
<p class="fr mt1"><a href="<?php echo base_url(); ?>vendors/" class="btn1 radius-20t" title="�Go Back">Go Back</a> </p>
<p class="fr mt1"><a href="<?php echo base_url(); ?>vendors/motor/vendor_entries" class="btn1 radius-20t" title="�Go Back">Check Vendor Entries</a> </p>

	<?php 
			foreach($status as $ss){  if($ss['success']){ echo '<span class="success">'.$ss.'</span>'; }else{echo '<span class="red">'.$ss.'</span>'; } }
	?>

	<h2 class="bb1 pb5">EXCLUDE Vehicle Year Make Model</h2>
	<div class="cb mb15"></div>
	<h3>Updated Details </h3>
	<div class="cb mb15"></div>
	<table class="tg">
		<tr>
			<td class="tg-031e"> Excluded Year </td>
			<td class="tg-031e"> PAB Driver Charge</td>
			<td class="tg-031e"> Road Side Assistance Charge</td>
			<td class="tg-031e"> PAB Passanger Charge</td>
			<td class="tg-031e"> Rent Car Charge</td>
		</tr>
		<?php foreach($static_data as $s_details){ ?>
		<?php if(!empty($s_details['exc_vehicle_year'])){ ?>
		<tr>
			<td class="tg-4eph"> <?php echo $s_details['exc_vehicle_year']; ?> </td>
			<td class="tg-4eph"> <?php echo $s_details['PAB_driver']; ?> </td>
			<td class="tg-4eph"> <?php echo $s_details['RSA']; ?> </td>
			<td class="tg-4eph"> <?php echo $s_details['PAB_passanger']; ?> </td>
			<td class="tg-4eph"> <?php echo $s_details['ADD_rent_car']; ?> </td>
		</tr>
		<?php } ?>
		<?php } ?>
	</table>
	</br>
	
	<table class="tg">
		<tr>
			<td class="tg-031e"> Excluded Maker </td>
			<td class="tg-031e"> Excluded Models</td>
		</tr>
		<?php foreach($static_data as $s_details){ ?>
		<tr>
			<td class="tg-4eph"> <?php echo $s_details['exc_vehicle_name']; ?> </td>
			<td class="tg-4eph"> <?php echo $s_details['exc_vehicle_models']; ?> </td>
		</tr>
		<?php } ?>
	</table>
	
	<div class="cb mb15"></div>
	<?php echo form_open_multipart('/vendors/motor/add_vendor_excludes_cars'); ?>	
	<?php if($year_exist == 0){ ?>
	<div class="fl w32 short_form ml16">
			<p>VEHICLE YEAR <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
				<input type="text" name="vehicle_year" />
			</p>
	  </div>
	
	<div class="fl w32 short_form ml16">
			<p>VEHICLE REGISTERED <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="form-control" name="vehicle_register[]" id="vehicle_register" tabindex="-98" multiple="">
				<option value="">Select</option>
				<option value="1">Individual</option>
				<option value="2">Corporate(rent a car)</option>
				<option value="3">Corporate(transport company)</option>
				<option value="4">Corporate(recovery company)</option>
			</select>
			</p>
	  </div>	
	<?php } ?>
	<!--  <ADD NEW CODE HERE  */ -->
	
	<?php //echo '<pre>'; print_r($vehicle); exit;   ?>
	  
	<div class="fl w32 short_form ml16">
			<p>MAKER NAME <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="form-control" name="vehicle_name" id="vehicle_name" tabindex="-98">
					<option value="">Select</option>
			<?php foreach($vehicle as $vehicle_name){ ?>
                    <option value="<?php echo $vehicle_name['makeby']; ?>"><?php echo $vehicle_name['makeby']; ?></option>
			<?php } ?>       	
            </select>
			</p>
	  </div>
	  
	  <div class="fl w32 short_form ml16">
			<p>MODELS <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="form-control" name="vehicle_models[]" id="vehicle_models" tabindex="-98" multiple="">
					 
			    	
            </select>
			</p>
	  </div>
	  
	  
	  <div class="cb mb15"></div>
	  <?php if($year_exist == 0){ ?>
	  <div class="fl w22 short_form ml16">
			<p>PAB FOR DRIVER <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
				<input type="text" name="PAB_driver" value="" />
			</p>
	  </div>
	  <div class="fl w22 short_form ml16">
			<p>ROAD SIDE ASSISTANCE <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
				<input type="text" name="RSA" value="" />
			</p>
	  </div>
	  <div class="fl w22 short_form ml16">
			<p>PAB FOR PASSANGER (PER PERSON) <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
				<input type="text" name="PAB_passanger" value="" />
			</p>
	  </div>
	  <div class="fl w22 short_form ml16">
			<p>ADD RENT A CAR <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
				<input type="text" name="ADD_rent_car" value="" />
			</p>
	  </div>
	  
	  <div class="cb mb15"></div>
	  
	   <div class="fl w22 short_form ml16">
			<p>Upload Document 1<b class="red">*</b></p>
			<p class="mt6" style="width:100%">
				<input type="file" name="file1" value="" />
			</p>
	  </div>
	   <div class="fl w22 short_form ml16">
			<p>Upload Document 2 <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
				<input type="file" name="file2" value="" />
			</p>
	  </div>
	  <?php } ?>
		<div class="cb mb15"></div>
		
	   <div class="fl w32 short_form ml16">
		<p class="mt6" style="width:100%"></p>
	  </div>
		
	  <div class="fl w32 short_form ml16">
		<p class="mt6" style="width:66%;text-align:center;">
			<input name="sbt_btn" value="Submit" name="submit" class="btn3 radius-3 trans_eff" type="submit">
		</p>
	  </div>
	  
	  <?php echo form_close(); ?>
	  <div class="cb mb15"></div>
	
</div>
<div class="w90 auto mt30">
	
	<h2 class="bb1 pb5">Add Motor Plans</h2>
	<?php echo form_open('/vendors/motor/post_plan');  ?> 
	<div class="cb mb15"></div>
	
	  
	<div class="cb mb15"></div>
		<div class="fl w32 short_form ml16">
			<p>VEHICLE TYPE <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="form-control" name="vehicletype" id="Vehicle_type" tabindex="-98">
                    <option value="">Select</option>
                    <option value="1">Buses(abv 15 seats)</option>
					<option value="2">Heavy Vehicles</option>
					<option value="3">Saloon</option>
					<option value="4">Sports</option>
					<option value="5">Stationwagon</option>
					<option value="6">Vans,Buses(upto 15 seats)</option>		
            </select>
			</p>
	  </div>
		<div class="fl w32 short_form ml16">
			<p> EMIRATE OF REGISTRATION <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="p7" name="emirates" id="country_id">
					<option value="">Select</option>
					<option value="DUB">Dubai</option> 
					<option value="ABU">Abu Dhabi</option> 
					<option value="SHR">Sharjah</option> 
					<option value="RAK">Ras Al Khaimah</option> 
					<option value="AJM">Ajman</option> 
					<option value="FUI">Fujairah</option> 
					<option value="UAQ">Umm Al Quwain</option> 
			</select>
			</p>
		</div>
	  <div class="fl w32 short_form ml16">
		<p>SELECT GCC <b class="red">*</b></p>
		<p class="mt6">
			<select class="p7" name="gcc_status" >
					<option value="">Select</option>
					<option value="1">YES</option>
					<option value="0">NO</option>
			</select>
		 </p>
	  </div>
	 
	  <div class="cb mb15"></div>
	  
	  <div class="fl w32 short_form ml16">
			<p>DRIVING LICENCE <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="form-control current" id="drving" onchange="vaildationlicence();" name="Driving_Licence" tabindex="-98" >
		        <option value="" selected="selected">Select</option> 
				<option value="l6">less than 6 months</option> 
				<option value="l1">less than 1 year</option> 
				<option value="1">1 year</option> 
				<option value="2">2 years</option> 
				<option value="A2">Above 2 years</option> 
				
		    </select>
			</p>
	  </div>
	   <div class="fl w32 short_form ml16">
		<p>DRIVER AGE <b class="red">*</b></p>
		<p class="mt6">
			<select class="p7" name="driver_age" >
					<option value="">Select</option>
					<option value="1">Less than 25</option>
					<option value="2">20 to 25</option>
					<option value="3">More than 25</option>
			</select>
		 </p>
	  </div>
	  <div class="cb mb15"></div>
	  <div class="fl w32 short_form ml16">
			<h3 class="greenHeader"> 
				<div class="radioContainer" style="position:relative;width:500px;">
					<input type="checkbox" id="rd3_4" name="type_check" class="checkbox" onclick="show_agency();" value="comp">
					<label for="rd3_4" class="checkboxLabel">COMPREHENSIVE</label>
					<input type="checkbox" id="rd3_414" name="type_check" class="checkbox" onclick="show_tpl();" value="tpl"/>
					<label for="rd3_414" class="checkboxLabel"> THIRD PARTY LIABILITY </label>
				</div>
			</h3>
	  </div>	
	 
									
		<div style=" display: none;" id="agency_show">
			
			<div class="cb mb15"></div>
				
		        <div class="fl w32 short_form ml16">
					<div class="fldContainer">
					<label class="frmLabel">AGENCY TYPE</label>
					<select class="form-control" name="agencytype" id="agancy" onchange="agencytypeval();">
					<option value="">Select</option>
					<option value="1">Agency</option>
					<option value="2">NON-AGENCY(Standard)</option>
					<option value="3">NON-AGENCY(Superior)</option>
					</select>

					</div>
				</div>
					
				<div class="fl w32 short_form ml16">
		        	<div class="fldContainer">
		                  <label class="frmLabel" id="vLabel">MIN VALUE</label>
						  <input type="text" class="form-control" name="minvalue" id="current">
		             </div>
		        </div>
				
				<div class="fl w32 short_form ml16">
		            <div class="fldContainer">
		                  <label class="frmLabel" id="vLabel">PREMIUM VALUE IN (%)</label>
		                  <input type="text" class="form-control" name="premium_value" id="current">
		            </div>
		        </div>
                </div>
					
				<div class="companContainer">
					<div class="cb mb15"></div>							
					<div style="display:none;" class="col-md-6 pull-right" id="show_tpl">
						<div class="form-group">
							<div class="fl w32 short_form ml16">
							<label class="frmLabel">NO. OF CYLINDERS</label>

							<select class="form-control body_type" name="noofcylinders" id="body_id" onchange="bodytypeval();">
							<option value="">Select</option>
							<option value="4">4 Cylinder</option><option value="6">6 Cylinder</option><option value="8">8 Cylinder</option><option value="A8">8 Cylinder Above</option><option value="SC">Sports/Coupe</option>   	
							</select>
																		
							</div>
						</div>
						<div class="fl w32 short_form ml16">
							<div class="fldContainer">
								  <label class="frmLabel" id="vLabel">PREMIUM VALUE IN</label>
								  <input type="text" class="form-control" name="premiumvalue" id="current">
							</div>
						</div>
					</div>
				</div>
	   <div class="cb mb15"></div>
	  <div class="cb pb5"></div>
	  <input name="sbt_btn" value="Submit" name="submit" class="btn3 radius-3 trans_eff" type="submit">
	  <input name="btn_rst" value="Reset" class="btn3x radius-3 trans_eff" type="reset">
	  <?php echo form_close(); ?>	
</div>
	<div class="cb pb30"></div>
</div>

<script>
function show_agency(){
	if (($("#rd3_4:checked").length == 0)){
		$("#agency_show").hide();
		return false;
		}else{
       $("#agency_show").show();

	   return true;
     }    

}
function show_tpl(){
	if (($("#rd3_414:checked").length == 0)){
		$("#show_tpl").hide();
		return false;
		}else{
       $("#show_tpl").show();
	  
	  function bodytypeval(){
  //alert('haii');
  var username = $(".body_type").val();
    if(username == "") {
      $("#body_id_e").fadeIn();
        $(".body_type").focus();
          return false;
    }else{
      $("#body_id_e").fadeOut();
      return true;  
    }
  } 
 function bodyVehicle_Type() {
  	 var username = $("#pvsllon_id").val();
  	if(username == "") {
      $("#pvsllon_id_e").fadeIn();
        $("#pvsllon_id").focus();
          return false;
    }else{
      $("#pvsllon_id_e").fadeOut();
      return true;  
    }
  }
     }    

}
function validateagency(){
	if (($("#tpl1:checked").length == 0) && ($("#tpl2:checked").length == 0)){
		$("#tpl2_e").fadeIn();
		$("#tpl2").focus();
		return false;
		}else{
       $("#tpl2_e").fadeOut();
	   return true;
     }    
var username = $("#agency_type").val();
  	if(username == "") {
      $("#pvsllon_id_e").fadeIn();
        $("#pvsllon_id").focus();
          return false;
    }else{
      $("#pvsllon_id_e").fadeOut();
      return true;  
    }
	}
	
	function agencytypeval(){
  //alert('haii');
  var username = $("#agancy").val();
    if(username == "") {
      $("#agancy_e").fadeIn();
        $("#agancy").focus();
          return false;
    }else{
      $("#agancy_e").fadeOut();
      return true;  
    }
  }
 function bodytypeval(){
  //alert('haii');
  var username = $(".body_type").val();
    if(username == "") {
      $("#body_id_e").fadeIn();
        $(".body_type").focus();
          return false;
    }else{
      $("#body_id_e").fadeOut();
      return true;  
    }
  }   
  function vaildationlicence(){
  var username = $("#drving").val();
    if(username == "") {
      $("#drving_e").fadeIn();
        $("#drving").focus();
          return false;
    }else{
      $("#drving_e").fadeOut();
      return true;  
    }
  } 
  
  
  $('#body_id').on('change', function (e) {
					
		var optionSelected = $(this).val();
			
		if(optionSelected){
			$('#body_veh_id').show();
		}else{
			$('#body_veh_id').hide();
			}
	});
			

/* CONVERT JSON OBJECT VALUE TO ARRAY */			
$('#vehicle_name').change(function(){	

	var vehicle_name =	$(this).val();

	$('#vehicle_models').empty();
	 $.ajax({ 
        type      : 'POST', 
        url       : '<?php echo base_url(); ?>vendors/motor/get_vehicle_models', 
        data      : {'vehicle_name': vehicle_name},
		success   : function(data_w) {
			
				var cars = data_w;
				var array = [];
				
				for(var i in cars) {
						if(cars.hasOwnProperty(i) && !isNaN(+i)) {
							array[+i] = cars[i].model;
						}
						
					$('#vehicle_models').append($('<option>', { 
						value: cars[i].model,
						text : cars[i].model 
					}));
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