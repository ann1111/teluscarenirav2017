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
.short_form p{color:#888;font-weight:700;}

</style>

<div class="w90 auto mt90">
<p class="fr mt1"><a href="<?php echo base_url(); ?>vendors/" class="btn1 radius-20t" title="�Go Back">Go Back</a> </p>
<!--<p class="fr mt1"><a href="<?php echo base_url(); ?>vendors/motor/vendor_entries" class="btn1 radius-20t" title="�Go Back">Check Vendor Entries</a> </p>-->

	<?php 
			echo $error;
		//	print_r($status);
			foreach($status as $ss){  if($ss['success']){ echo '<span class="success">'.$ss.'</span>'; }else{echo '<span class="red">'.$ss.'</span>'; } }
	?>

	<h2 class="bb1 pb5 black text-center">Cleaning Service</h2>
	<div class="cb mb15"></div>
	
	<?php echo form_open_multipart('/vendors/cleaning/post_cleaning'); ?>	
	
	<div class="fl w32 short_form ml16">
			<p>SELECT EMIRATE <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
				<select name="emirate" class="form-control emirate" id="emirateId" required="required">
					<option value="" selected>Select State</option>
					<option value="1">Abu Zabi</option>
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
	  </div>
	
	<div class="fl w32 short_form ml16">
			<p>SUB CITY <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="form-control" name="sub_city" id="sub_city" tabindex="-98" >
				
			</select>
			</p>
	  </div>

		<div class="fl w32 short_form ml16">
			<p>Upload Document 1 <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
				<input type="file" name="file1" value="" />
			</p>
	  </div>
	   	  
	
	<?php //echo '<pre>'; print_r($vehicle); exit;   ?>
	  
	  
	  <div class="cb mb15"></div>
	  <div class="fl w100 short_form ml16">
	   <table class="tg" style="width:100%;">
			<tr>
				<td class="tg-spn1"> Premise Types </td>
				<td class="tg-spn1"> <label> Villa </label> <input type="checkbox" name="villa[type]"/>	</td>
				<td class="tg-spn1"> <label> Office </label> <input type="checkbox" name="office[type]"/>	</td>	
				<td class="tg-spn1"> <label> Apartment </label> <input type="checkbox" name="apart[type]"/>	</td>
				<td class="tg-spn1"> <label> WareHouse </label> <input type="checkbox" name="House[type]"/>	</td>
			</tr>
			<tr>
				<td class="tg-spn1"> Material Provided </td>
				<td class="tg-spn1"> <select name="villa[material]"><option value="1">YES</option><option value="0">NO</option> </select>	</td>
				<td class="tg-spn1"> <select name="office[material]"><option value="1">YES</option><option value="0">NO</option>	</td>	
				<td class="tg-spn1"> <select name="apart[material]"><option value="1">YES</option><option value="0">NO</option>		</td>
				<td class="tg-spn1"> <select name="House[material]"><option value="1">YES</option><option value="0">NO</option>		</td>
			</tr>
			<tr>
				<td class="tg-spn1"> Material Cost </td>
				<td class="tg-spn1"> <input type="text" name="villa[material_cost]"/> </td>
				<td class="tg-spn1"> <input type="text" name="office[material_cost]"/></td>	
				<td class="tg-spn1"> <input type="text" name="apart[material_cost]"/> </td>
				<td class="tg-spn1"> <input type="text" name="House[material_cost]"/> </td>
			</tr>
			<tr>
				<td class="tg-spn1"> Number Of Cleaners </td>
				<td class="tg-spn1"> <select name="villa[cleaners]"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option> </select>	</td>
				<td class="tg-spn1"> <select name="office[cleaners]"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>	</select></td>	
				<td class="tg-spn1"> <select name="apart[cleaners]"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>	</select>	</td>
				<td class="tg-spn1"> <select name="House[cleaners]"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>	</select>	</td>
			</tr>
			
			<tr>
				<td class="tg-spn1"> Charges Per Cleaner(PerHour) Weekend </td>
				<td class="tg-spn1"> <input type="text" name="villa[charges_weekend]"/> </td>
				<td class="tg-spn1"> <input type="text" name="office[charges_weekend]"/> </td>	
				<td class="tg-spn1"> <input type="text" name="apart[charges_weekend]"/> </td>
				<td class="tg-spn1"> <input type="text" name="House[charges_weekend]"/> </td>
			</tr>
			<tr>
				<td class="tg-spn1"> Charges Per Cleaner(PerHour) Weekdays </td>
				<td class="tg-spn1"> <input type="text" name="villa[charges_weekdays]"/> </td>
				<td class="tg-spn1"> <input type="text" name="office[charges_weekdays]"/> </td>	
				<td class="tg-spn1"> <input type="text" name="apart[charges_weekdays]"/> </td>
				<td class="tg-spn1"> <input type="text" name="House[charges_weekdays]"/> </td>
			</tr>
			<tr>
				<td class="tg-spn1"> Discount on min Hours </td>
				<td class="tg-spn1"> <input type="text" name="villa[discounthours]"> </td>
				<td class="tg-spn1"> <input type="text" name="office[discounthours]"/> </td>	
				<td class="tg-spn1"> <input type="text" name="apart[discounthours]"/> </td>
				<td class="tg-spn1"> <input type="text" name="House[discounthours]"/> </td>
			</tr>
			<tr>
				<td class="tg-spn1"> Discount Charges(%) </td>
				<td class="tg-spn1"> <input type="text" name="villa[discounthourscharge]"/> </td>
				<td class="tg-spn1"> <input type="text" name="office[discounthourscharge]"/> </td>	
				<td class="tg-spn1"> <input type="text" name="apart[discounthourscharge]"/> </td>
				<td class="tg-spn1"> <input type="text" name="House[discounthourscharge]"/> </td>
			</tr>
		</table>	   
	  </div>
	  
	  <div class="cb mb15"></div>
	  <div class="fl w100 short_form ml16">
		<p class="mt6" style="width:100%;text-align:center;">
			<input name="sbt_btn" value="Submit" name="submit" class="btn3 radius-3 trans_eff" type="submit">
		</p>
	  </div>
	  
	  <?php echo form_close(); ?>
	  <div class="cb mb15"></div>
	
</div>

	<div class="cb pb30"></div>


<script>

/* CONVERT JSON OBJECT VALUE TO ARRAY */			
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
</script>
<?php $this->load->view("bottom_application");?>