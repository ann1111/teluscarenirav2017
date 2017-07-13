<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>
<title> Cleaning </title>
<style>
.input_ll{width:32%;float:left;margin-right:5px;margin-left:22px;}
.input_rr{width:32%;float:left;margin-right:5px;}
.input_lll{width:32%;float:left;}
.cc { border:3px solid #d5d5d5;  }
</style>
<div class="wrapper pt20 pb20" style="min-height:300px">
  <div class="p25 radius-3 white cc">
	<h1 class="fs24 black">Cleaning</h1>
  </div>
  <?php echo form_open('cleaningservice/cleaning_post'); ?>
  <div class="fl w100 mt20 short_form fs14 bg-gray1 p20 border1 radius-5" style="background:#f5ffff;">
  <fieldset class="pb15" style="border:0; border-bottom:1px solid #f1f1f1">
		<legend class="b fs18 b mb20 blue"> City Needed :</legend>
		
		<div class="input_ll">
		  <p class=" pt8"><label for="No Of Cleaners">SELECT EMIRATE :<b class="red">*</b></label></p>
		 	<p class="mt6" style="width:100%">
				<select name="emirate" class="form-control emirate" id="emirateId" required="required">
					<option value="" selected>Select</option>
					<option value="1">Abu Dabi</option>
					<option value="2">Ajman</option>
					<option value="3">Dubai</option>
					<option value="4">Ras al-Khaymah</option>
					<option value="5">Sharjah</option>
					<option value="6">Sharjha</option>
					<option value="7">Umm al Qaywayn</option>
					<option value="8">al-Fujayrah</option>
					<option value="9">ash-Shariqah</option>
				</select>
			</p>
		  <div class="cb pb5"></div>
		</div>

		<div class="input_rr">    
		  <p class=" pt8"><label for="No Of Hours">No Of Hours :<b class="red">*</b></label></p>
			<select class="form-control" name="sub_city" id="sub_city" tabindex="-98" >
				
			</select>
		  <div class="cb pb5"></div>
		</div>
  
  
  </fieldset>
  
  
  
	<fieldset class="pb15" style="border:0; border-bottom:1px solid #f1f1f1">
		<legend class="b fs18 b mb20 blue"> Information Needed :</legend>
		<div class="input_ll">
		  <p class=" pt8"><label for="No Of Cleaners">No Of Cleaners :<b class="red">*</b></label></p>
		 	<p class="mt6" style="width:100%">
				<select name="noofcleaners" class="form-control noofcleaners" id="noofcleaners" required="required" style="width:90%; padding:5px;">
					<option value="" selected>Select State</option>
					<?php for($i = 1; $i < 11; $i++ ){ ?>
					<option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
					<?php } ?>
				</select>
			</p>
		  <div class="cb pb5"></div>
		</div>

		<div class="input_rr">    
		  <p class=" pt8"><label for="No Of Hours">No Of Hours :<b class="red">*</b></label></p>
		 <select name="noofhours" id="noofhours" style="width:90%; padding:5px;">
			  <option value="">Select</option>
			  <?php for($i = 1; $i < 11; $i++ ){ ?>
			  <option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
			  <?php } ?>
		 </select>
		  <div class="cb pb5"></div>
		</div>
		<!--<div class="cb"></div>-->

		<div class="input_lll">
		  <p class=" pt8"><label for="Driving licence">Cleanings per month<b class="red">*</b> :</label></p>
		  <div class="mt3">
			<select name="cleanerfreq" id="cleanerfreq" style="width:90%; padding:5px;">
			  <option value="1">1 Time only</option>
			  <option value="2">2 Time only</option>
			  <option value="4">4 Time only</option>
			  <option value="8">8 Time only</option>
			  <option value="12">12 Time only</option>
			  <option value="15">15 Time only</option>
			  <option value="30">EveryDay</option>
			</select>
		  </div>
		  <div class="cb pb5"></div>
		</div>
	</fieldset>
	
	<fieldset class="pb15 mt10" style="border:0; border-bottom:1px solid #f1f1f1">
		<div class="input_ll">      
		  <p class="pt8"><label for="material provider">Material Provided by Customer <b class="red">*</b> :</label></p>
		  <div class="mt3">
			<select class="p7" name="material_provide" id="material_provide" style="width:90%; padding:5px;">
					<option value="">Select</option>
					<option value="1">Yes</option>
					<option value="0">NO</option>
			</select>
		  </div>
		  <div class="cb pb5"></div>
		</div>
		
		<div class="input_rr">
		  <p class="pt8"><label for="country" >Type Of Premises <b class="red">*</b> :</label></p>
		  <div class="mt3">
			<select class="p7" name="premises" id="premises" style="width:90%; padding:5px;">
					<option value="">Select</option>
					<option value="1">Villa</option>
					<option value="2">Office</option>
					<option value="3">Apartment</option>
					<option value="4">Warehouse</option>
			</select>		
		  </div>
		  <div class="cb pb5"></div>
		</div>
		
		<div class="input_rr">
		  <p class="pt8"><label for="Date Of Cleaning" >Date Of Cleaning <b class="red">*</b> :</label></p>
		  <div class="mt3">
			<input name="cleaning_date" id="datepicker" class="dob" style="width:90%; padding:5px;" readonly="readonly" type="text" placeholder=" 00/00/0000">	
		  </div>
		  <div class="cb pb5"></div>
		</div>
		
		<div class="cb"></div>
		
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
	  
	 
    $("#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	});
	
	
	/* $('#submit').click(function(){
		
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
			
		
		
	}); */
	
	
	$('#emirateId').change(function(){	

	var city_id =	$(this).val();

	$('#sub_city').empty();
	
	 $.ajax({ 
        type      : 'POST', 
        url       : '<?php echo base_url(); ?>vendors/cleaning/get_sub_city', 
		dataType  : 'json',
        data      : {'city_id': city_id},
		success   : function(data_w) {
			
				var cars = data_w;
				var array = [];
				
				for(var i in cars) {
						if(cars.hasOwnProperty(i) && !isNaN(+i)) {
							array[+i] = cars[i].name;
							
						}
						
						
					 $('#sub_city').append($('<option>', { 
						value: cars[i].id,
						text : cars[i].name 
					})); 
				}
			}
		});
	
	});
	});
  </script>
</div>

<?php $this->load->view("bottom_application");?>