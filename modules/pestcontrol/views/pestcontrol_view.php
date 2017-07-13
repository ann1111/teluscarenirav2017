<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>
<title> PEST CONTROL SERVICE </title>
<style>
.input_ll{width:32%;float:left;margin-right:5px;margin-left:22px;}
.input_rr{width:32%;float:left;margin-right:5px;}
.input_lll{width:32%;float:left;}
.cc { border:3px solid #d5d5d5;  }
</style>
<div class="wrapper pt20 pb20" style="min-height:300px">
  <div class="p25 radius-3 white cc">
	<h1 class="fs24 black">PEST CONTROL SERVICE</h1>
  </div>
  <?php echo form_open('motorinsurance/motor_result'); ?>
  <div class="fl w100 mt20 short_form fs14 bg-gray1 p20 border1 radius-5" style="background:#f5ffff;">
  
	<fieldset class="pb15" style="border:0; border-bottom:1px solid #f1f1f1">
		<legend class="b fs18 b mb20 blue"> Vehicle Information :</legend>
		<div class="input_ll">
		  <p class="pt8"><label for="makers">Makers<b class="red">*</b> :</label></p>
		  <select class="form-control" name="vehicle_name" id="vehicle_name" tabindex="-98">
					<option value="">Select</option>
				<?php foreach($vehicle as $vehicle_name){ ?>
                    <option value="<?php echo $vehicle_name['makeby']; ?>"><?php echo $vehicle_name['makeby']; ?></option>
				<?php } ?>       	
            </select>
		  <div class="cb pb5"></div>
		</div>
		<div class="input_rr">    
		  <p class=" pt8"><label for="Models">Models</label></p>
		 <select class="form-control" name="vehicle_models" id="vehicle_models" tabindex="-98" >
		 </select>
		  <div class="cb pb5"></div>
		</div>
	</fieldset>	
	<fieldset class="pb15" style="border:0; border-bottom:1px solid #f1f1f1">
		<legend class="b fs18 b mb20 blue"> Information Needed :</legend>
		<div class="input_ll">
		  <p class="pt8"><label for="vehicletype">Vehicle Type<b class="red">*</b> :</label></p>
		  <select name="vehicletype" id="vehicletype" style="width:90%; padding:5px;">
			  <option value="">Select</option>
			  <option value="1">Buses(abv 15 seats)</option>
				<option value="2">Heavy Vehicles</option>
				<option value="3">Saloon</option>
				<option value="4">Sports</option>
				<option value="5">Stationwagon</option>
				<option value="6">Vans,Buses(upto 15 seats)</option>
			</select>
		  <div class="cb pb5"></div>
		</div>

		<div class="input_rr">    
		  <p class=" pt8"><label for="Year Of Registration">Year Of Registration :</label></p>
		 <select name="year_of_reg" id="year_of_reg" style="width:90%; padding:5px;">
			  <option value="">Select</option>
			  <?php for($i = 1985; $i < date('Y'); $i++ ){ ?>
			  <option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
			  <?php } ?>
			 
			</select>
		  <div class="cb pb5"></div>
		</div>
		<!--<div class="cb"></div>-->

		<div class="input_lll">
		  <p class=" pt8"><label for="Driving licence">Driving Licence<b class="red">*</b> :</label></p>
		  <div class="mt3">
			<select  id="drving" name="Driving_Licence" tabindex="-98" style="width:90%; padding:5px;">
		        <option value="" selected="selected">Select</option> 
				<option value="l6">less than 6 months</option> 
				<option value="1">1 year to 2 year</option> 
				<option value="2">2 year to 3 year</option> 
				<option value="A2">Above 2 years</option> 
			</select>
		  </div>
		  <div class="cb pb5"></div>
		</div>
	</fieldset>
	
	<fieldset class="pb15 mt10" style="border:0; border-bottom:1px solid #f1f1f1">
		<div class="input_ll">      
		  <p class="pt8"><label for="date_of_birth">Driver Age <b class="red">*</b> :</label></p>
		  <div class="mt3">
			<select class="p7" name="driver_age" id="driver_age">
					<option value="">Select</option>
					<option value="1">Less than 20</option>
					<option value="2">20 to 25</option>
					<option value="3">More than 25</option>
			</select>
		  </div>
		  <div class="cb pb5"></div>
		</div>
		
		<div class="input_rr">
		  <p class="pt8"><label for="country" >EMIRATE OF REGISTRATION <b class="red">*</b> :</label></p>
		  <div class="mt3">
			<select class="p7" name="emirates" id="country_id" style="width:90%; padding:5px;">
					<option value="">Select</option>
					<option value="DUB">Dubai</option> 
					<option value="ABU">Abu Dhabi</option> 
					<option value="SHR">Sharjah</option> 
					<option value="RAK">Ras Al Khaimah</option> 
					<option value="AJM">Ajman</option> 
					<option value="FUI">Fujairah</option> 
					<option value="UAQ">Umm Al Quwain</option> 
			</select>		
		  </div>
		  <div class="cb pb5"></div>
		</div>
		
		<div class="input_rr">
		  <p class="pt8"><label for="country" >GCC SPEC <b class="red">*</b> :</label></p>
		  <div class="mt3">
			<select class="p7" name="gcc_status" style="width:90%; padding:5px;" id="gcc_status">
					<option value="">Select</option>
					<option value="1">YES</option>
					<option value="0">NO</option>
			</select>		
		  </div>
		  <div class="cb pb5"></div>
		</div>
		
		<div class="cb"></div>
		
		<div class="input_ll">      
		  <p class="pt8"><label for="date_of_birth">Date of Birth :</label></p>
		  <div class="mt3">
			<input name="birth_date" id="datepicker" class="dob" style="width:90%; padding:5px;" readonly="readonly" type="text" placeholder=" 00/00/0000">
		  </div>
		  <div class="cb pb5"></div>
		</div>
		
		<div class="cb"></div>
		
		<div class="fl w32 short_form ml16">
			<h3 class="greenHeader"> 
				<div class="radioContainer" style="position:relative;width:500px;">
					<input id="type_check" name="type_check" class="checkbox" value="comp"  type="checkbox">
					<label for="rd3_4" class="checkboxLabel">COMPREHENSIVE</label>
					<input id="type_check1" name="type_check" class="checkbox" value="tpl" type="checkbox">
					<label for="rd3_414" class="checkboxLabel"> THIRD PARTY LIABILITY </label>
				</div>
			</h3>
		</div>
		
		<div class="cb"></div>
		
		
		<div class="comprehensive">
		
			<div class="input_ll">
			  <p class="pt8"><label for="country" >AGENCY <b class="red">*</b> :</label></p>
			  <div class="mt3">
				<select class="form-control" name="agencytype" id="agancy" >
						<option value="">Select</option>
						<option value="1">Agency</option>
						<option value="2">NON-AGENCY(Standard)</option>
						<option value="3">NON-AGENCY(Superior)</option>
				</select>		
			  </div>
			  <div class="cb pb5"></div>
			</div>
			
			<div class="input_rr">
			  <p class="pt8"><label for="country" > LAST YEAR VALUE <b class="red">*</b> :</label></p>
			  <div class="mt3">
				<input name="last_year_val" id="last_year_val" class="dob" style="width:90%; padding:5px;" type="text" >	
			  </div>
			  <div class="cb pb5"></div>
			</div>
			
			<div class="input_rr">
			  <p class="pt8"><label for="country" > CURRENT YEAR VALUE <b class="red">*</b> :</label></p>
			  <div class="mt3">
				<input name="current_year_val" id="current_year_val" class="dob" style="width:90%; padding:5px;" type="text" >	
			  </div>
			  <div class="cb pb5"></div>
			</div>
			
			
			<h3>Benefit Section</h3>
			
			<div class="input_ll">
			  <p class="pt8"><label for="country" >PAB for Driver <b class="red">*</b> :</label></p>
			  <div class="mt3">
				
				<label for="country" >	YES </label> <input type="radio" name="PAB_driver" value="1"/>
				<label for="country" >	NO </label>	 <input type="radio" name="PAB_driver" value="0" checked/>
			  </div>
			  <div class="cb pb5"></div>
			</div>
			
			<div class="input_rr">
			  <p class="pt8"><label for="country" >ROAD SIDE ASSISTANCE <b class="red">*</b> :</label></p>
			  <div class="mt3">
				
				<label for="country" >	YES </label> <input type="radio" name="RSA" value="1"/>
				<label for="country" >	NO </label>	 <input type="radio" name="RSA" value="0" checked/>
			  </div>
			  <div class="cb pb5"></div>
			</div>
			
			<div class="input_rr">
			  <p class="pt8"><label for="country" >PAB FOR PASSANGERS <b class="red">*</b> :</label></p>
			  <div class="mt3">
				
				<label for="country" >	YES </label> <input type="radio" name="PAB_passangers" value="1"/>
				<label for="country" >	NO </label>	 <input type="radio" name="PAB_passangers" value="0" checked/>
			  </div>
			  <div class="cb pb5"></div>
			  <div id="no_of_pass">
				  <p class="pt8"><label for="country" > NO OF PASSANGERS <b class="red">*</b> :</label></p>
				  <input type="text" name="PAB_passangers_txt" value="" id="PAB_passangers_txt" />
			  </div>
			</div>
			
			
			<div class="input_ll">
			  <p class="pt8"><label for="country" > RENT A CAR <b class="red">*</b> :</label></p>
			  <div class="mt3">
				<label for="country" >	YES </label> <input type="radio" name="ADD_rent_car" value="1"/>
				<label for="country" >	NO </label>	 <input type="radio" name="ADD_rent_car" value="0" checked/>
			  </div>
			  <div class="cb pb5"></div>
			</div>
			
		</div>
		
		<div class="third_party_liab">
			
			<div class="input_ll">
			  <p class="pt8"><label for="country" >No Of Cylinders <b class="red">*</b> :</label></p>
			  <div class="mt3">
					<select class="form-control body_type" name="noofcylinders" id="noofcylinders" >
						<option value="">Select</option>
						<option value="4">4 Cylinder</option>
						<option value="6">6 Cylinder</option>
						<option value="8">8 Cylinder</option>
						<option value="A8">8 Cylinder Above</option>
						<option value="SC">Sports/Coupe</option>   	
					</select>
			  </div>
			  <div class="cb pb5"></div>
			</div>
		
		</div>
		
	<div class="cb"></div>
	</fieldset>
	<p class="mt15 w62 osons">
	  <input name="filter_me" value="Filter Here!" id="submit" class="btn3 trans_eff radius-3" type="submit">
	  <input name="reset" value="Reset" class="btn3 trans_eff radius-3" type="reset">
	</p>
	<div class="cb"></div>
  </div>
  <?php echo form_close();?>  
  </div>
  <div class="cb"></div>
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <script>
  $('document').ready(function() {
	  
	   $('#no_of_pass').hide();
	   $('.third_party_liab').hide();
	   $('.comprehensive').hide();
	   
    $("#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: "1900:2016"
    });
	
	$('input[name=PAB_passangers]').click(function(){
		
		var num_pass = $(this).val();
		
		if(num_pass == 1){ $('#no_of_pass').show();  }
		if(num_pass == 0){ $('#no_of_pass').hide();  }
		
	});
	
	$('input[name=type_check]').click(function(){
		var chk_type = $(this).val();
		
		//alert(chk_type);
			
		if(chk_type == 'comp'){ $('.comprehensive').show(); $('.third_party_liab').hide();  }
		if(chk_type == 'tpl'){  $('.third_party_liab').show();  $('.comprehensive').hide(); }
		
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
	
	$('#last_year_val').blur(function(){
		
		var cur_val = $(this).val(); 
		var f_current_val = Number(cur_val) - Number(cur_val) * 20 / 100;
		$('#current_year_val').val(f_current_val);
		
	});
	
	 $('#current_year_val').blur(function(){
		
		var cur_val = $(this).val(); 
		var f_current_val = Number(cur_val) + Number(cur_val) * 20 / 100;
		$('#last_year_val').val(f_current_val);
		
	}); 
	//$curentvalue + $curentvalue * 15 / 100
	
	$('#submit').click(function(){
		
		if($('#vehicletype').val() == ''){
			alert('Please select Vehicle Type');
			return false;
		}
		if($('#drving').val() == ''){
			alert('Please select Driving Licences');
			return false;
		}
		if($('#driver_age').val() == ''){
			alert('Please select Driver Age');
			return false;
		}
		if($('#country_id').val() == ''){
			alert('Please select Registation Of Emirates');
			return false;
		}
		if($('#gcc_status').val() == ''){
			alert('Please select GCC Spec');
			return false;
		}
		
		if(!$('#type_check').prop("checked") && !$('#type_check1').prop("checked")){
			alert('Please select Insurance Type');
			return false;
			
		} 
		var checkedValue = $('#type_check:checked').val();
		var checkedValue1 = $('#type_check1:checked').val();
		
		if(checkedValue == 'comp'){
			$('#noofcylinders').get(0).selectedIndex = 0;
			if($('#agancy').val() == ''){
				
				alert('Please select Agency');
				return false;
			}
			if($('#last_year_val').val() == ''){
				
				alert('Please select Last Year Value');
				return false;
			}
		}
		if(checkedValue1 == 'tpl'){
			$('#last_year_val').get(0).selectedIndex = 0;
			$('#agancy').get(0).selectedIndex = 0;
			
			if($('#noofcylinders').val() == ''){
				
				alert('Please select No Of Cylinders');
				return false;
			}
			
		}
			
		
		
	});
	
	
	$('#vehicle_name').change(function(){	

	var vehicle_name =	$(this).val();

	$('#vehicle_models').empty();
	 $.ajax({ 
        type      : 'POST', 
        url       : '<?php echo base_url(); ?>motorinsurance/get_vehicle_models', 
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
	});
	
  });
  </script>
</div>

<?php $this->load->view("bottom_application");?>