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
.short_form p{color:#888; font-weight:700;font-size:12px}

</style>

<div class="w90 auto mt90">
	<p class="fr mt1"><a href="<?php echo base_url(); ?>vendors/" class="btn1 radius-20t" title="�Go Back">Go Back</a> </p>
	<p class="fr mt1"><a href="<?php echo base_url(); ?>vendors/motor/vendor_entries" class="btn1 radius-20t" title="�Go Back">Check Vendor Entries</a> </p>

	<?php 
	
	foreach($status as $ss){  if($ss['success']){ echo '<span class="success">'.$ss.'</span>'; }else{echo '<span class="red">'.$ss.'</span>'; } }
	?>	

	<h2 class="bb1 pb5 black text-center"> Add - Motor Insurance - Plans - Rates - Services </h2>
	<div class="cb mb15"></div>
	<!--<h3>Updated Details </h3>
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
	</table>	-->
		<h3 class="text-center black" style="text-decoration:underline;"> Exclusion - Add List for Exclusion</h3>
	<div class="cb mb15"></div>
	
	<?php echo form_open_multipart('/vendors/motor/add_vendor_excludes_cars', 'id="exclude_data"'); ?>	
	<?php //if($year_exist == 0){ ?>
	<?php //echo '<pre>'; print_r($vehicle_types); exit;  ?>
	<div class="fl w25 short_form ml16">	
		<p>VEHICLE TYPE <b class="red">*</b></p>
		<p class="mt6" style="width:100%">	
			<select class="form-control" name="vehicletype" id="Vehicle_type" tabindex="-98">		
				<option value="">Select</option>	
				<?php foreach($vehicle_types as $vt){ ?>              
				<option value="<?php echo $vt['id'] ?>"><?php echo $vt['vehicle_type']; ?></option>	
				<?php } ?>					
			</select>			
		</p>	
	</div>	

	<div class="fl w25 short_form ml16">	
	<p>MAKER NAME <b class="red">*</b></p>	
		<p class="mt6" style="width:100%">		
			<select class="form-control" name="vehicle_name" id="vehicle_name" tabindex="-98">		
				<option value="">Select</option>		
				<?php foreach($vehicle as $vehicle_name){ ?>   
				<option value="<?php echo $vehicle_name['makeby']; ?>">
				<?php echo $vehicle_name['makeby']; ?></option>	
				<?php } ?>       	      
			</select>
		</p>	  
	</div>

	<div class="fl w25 short_form ml16">	
		<p>MODELS <b class="red"><small>select multiple </small>*</b></p>	
		<p class="mt6" style="width:100%">		
		<select class="form-control" name="vehicle_models[]" id="vehicle_models" tabindex="-98" multiple="">	
		</select>	
		</p>	
	</div>	 
	
	<div class="fl w16 short_form ml16">	
		<p>VEHICLE YEAR ONWORDS :<b class="red">*</b></p>		
		<select class="form-control" name="vehicle_year" id="vehicle_year">	
			<?php for($i= '1985'; $i <= date('Y'); $i++){ ?>	
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>	
			<?php } ?>		
		</select>
	</div>

	<div class="cb mb15"></div>
	<div class="fl w25 short_form ml16">
		<p>DRIVER AGE <b class="red">*</b></p>
		<p class="mt6">			
		<select class="p7" name="driver_age" id="driver_age">
			<option value="">Select</option>	
			<option value="1">Less than 21 Years</option>	
			<option value="2">More Than 21 Years and Less than 25 Years</option>
			<option value="3">More than 25 Years and Less than 30 Years</option>	
			<option value="4">More than 30 Years</option>	
		</select>	
		</p>	 
	</div>	  

	<div class="fl w25 short_form ml16">	
		<p>DRIVING LICENCE <b class="red">*</b></p>	
		<p class="mt6" style="width:100%">	
			<select class="form-control current" id="drving" onchange="vaildationlicence();" name="Driving_Licence" tabindex="-98" >
				<option value="" selected="selected">Select</option> 	
				<option value="l6">less than 6 months</option> 		
				<option value="l1">More than 6 months to less than 1 years</option> 
				<option value="1">More Than 1 year to less than 2 years</option> 
				<option value="A2">More than 2 years</option> 	
			</select>		
		</p>	
	</div>
	
	
		<div class="fl w25 short_form ml16">	
			<p> EMIRATE OF REGISTRATION <b class="red">*</b></p>	
			<p class="mt6" style="width:100%">	
				<select class="p7" name="emirates" id="country_id">	
					<option value="">Select</option>	
					<?php foreach($emirates_name as $emirate) { ?>	
					<option value="<?php echo $emirate['code'] ?>">
					<?php echo $emirate['emirate_name'] ?></option> 
					<?php } ?>		
				</select>		
			</p>	
		</div>	
		
		<div class="fl w16 short_form ml16">	
			<p>SELECT GCC <b class="red">*</b></p>	
			<p class="mt6">			
				<select class="p7" name="gcc_status" id="gcc_status">	
					<option value="">Select</option>
					<option value="1">YES</option>	
					<option value="0">NO</option>	
				</select>		
			</p>	
		</div>	

		<div class="cb mb15"></div>	  
		<div class="fl w25 short_form ml16">
			<p>VEHICLE REGISTERED <b class="red"><small>select multiple </small>*</b></p>
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
	<?php //} ?>
	<!--  <ADD NEW CODE HERE  */ -->
	
	<?php //echo '<pre>'; print_r($vehicle); exit;   ?>
	  <div class="cb mb15"></div>
	  <div class="fl w100 short_form ml16">
		<p class="mt6" style="width:100%"></p>
	  </div>
	 <div class="fl w100 short_form ml16">
		<p class="mt6" style="width:100%;text-align:center;">
			<input name="sbt_btn" value="Exclude Now" name="submit" id="exclude_button" class="btn3 radius-3 trans_eff" type="button">
		</p>
	 </div>
	 <?php echo form_close(); ?>
	 
	 <?php if($_SESSION['motor_exclude_data'] != ''){ ?>
	  <div class="cb mb15"></div>	
		<table class="w100">	
		  <tr class="tg"> 	
			  <th class="tg-031e"> Vehicle Type </th> 	
			  <th class="tg-031e"> Vehicle Name </th>	
			  <th class="tg-031e"> Vehicle Models </th>	
			  <th class="tg-031e"> Vehicle Year </th> 
			  <th class="tg-031e"> Driver Age </th> 
			  <th class="tg-031e"> Driving Licence</th>	
			  <th class="tg-031e"> Emirate </th>	
			  <th class="tg-031e"> GCC SPEC </th>		
			  <th class="tg-031e"> Vehicle Register </th>	
			  <th class="tg-031e"> Remove </th>	
			 
		  </tr>		
		  <?php foreach($_SESSION['motor_exclude_data'] as $key => $sess_data){ 
		  
		  
		  
		 //echo'<pre>'; print_r($sess_data);
		/* 	$vehicle_type[] = array($sess_data['vehicletype']);
			$vehicle_name[] = array($sess_data['vehicle_name']);
			$emirates[] = array($sess_data['emirates']);
		   */
			
		  ?>
		  <tr> 		
			  <td class="tg-031e" id="Vehicle_type_field"> 
			  <?php echo get_vehicle_type($sess_data['vehicletype']); ?> </td>	
			  <td class="tg-031e" id="vehicle_name_field"> <?php echo $sess_data['vehicle_name']; ?> </td>	
			  <td class="tg-031e" id="vehicle_models_field"> <?php foreach($sess_data['vehicle_models'] as $modal){ echo $modal; echo '<br>'; }  ?>
			  </td>		
			  <td class="tg-031e" id="vehicle_year_field"> <?php echo $sess_data['vehicle_year']; ?> </td> 	
			  <td class="tg-031e" id="driver_age_field"> <?php echo get_driver_age($sess_data['driver_age']); ?> </td> 
			  <td class="tg-031e" id="drving_field"> <?php echo get_driver_licence($sess_data['Driving_Licence']); ?> </td>
			  <td class="tg-031e" id="country_id_field"> <?php echo $sess_data['emirates']; ?> </td> 
			  <td class="tg-031e" id="gcc_status_field"> <?php echo get_gcc($sess_data['gcc_status']); ?> </td> 
			  <td class="tg-031e" id="vehicle_register_field"> 
			  <?php foreach($sess_data['vehicle_register'] as $vr){ echo get_vehicle_reg_for($vr); echo '<br>'; } ?> 
			  </td>	
			  <td class="tg-031e" id="gcc_status_field"> 
			<?php echo form_open_multipart('/vendors/motor/remove_vendor_excludes_cars', 'id="remove_exclude_data"'); ?>
			  <input type="hidden" name="exclude_remove" value="<?php echo $key; ?>"  /> 
			  <input type="submit" name="remove_exclude" class="btn3 radius-3 trans_eff btn-md" value="Remove" /> 
			 <?php echo form_close(); ?>
			  </td> 
		  </tr>	
		  <?php } 
		  
		 
		//  echo '<pre>'; print_r($emirates);   ?>
		  
	  </table>
	 <?php } ?>
	
</div>
<div class="w90 auto mt30">
	<h3 class="text-center black" style="text-decoration:underline;">Enter Rates</h3>
		<?php echo form_open('/vendors/motor/post_plan');  ?> 
		
	<div class="cb mb15"></div>	
	<div class="fl w25 short_form ">	
		<p>VEHICLE TYPE <b class="red">*</b></p>	
		<p class="mt6" style="width:100%">	
		<select class="form-control" name="vehicletype" id="Vehicle_type" tabindex="-98">	
			<option value="">Select</option>				
			<?php foreach($vehicle_types as $vt){ ?>     
			<option value="<?php echo $vt['id'] ?>"><?php echo $vt['vehicle_type']; ?></option>	
			<?php } ?>						        
		</select>		
		</p>
	</div>
		<div class="fl w25 short_form">
			<p> EMIRATE OF REGISTRATION <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="p7" name="emirates" id="country_id1">			
					<option value="">Select</option>			
					<?php foreach($emirates_name as $emirate) { 									
					if($emirate['code'] == $_SESSION['exclude_data']['emirates']){}else{	?>
					<option value="<?php echo $emirate['code'] ?>"><?php echo $emirate['emirate_name'] ?></option> 	
					<?php } ?>	
					<?php } ?>
			</select>
			</p>
		</div>
		
	  <div class="fl w25 short_form">	
		  <p>DRIVING LICENCE <b class="red">*</b></p>	
		  <p class="mt6" style="width:100%">	
		  <?php echo get_exclude_driver_licence(); ?>
		  </p>	
	  </div>	  

	  <div class="fl w25 short_form">		
	  <p>DRIVER AGE <b class="red">*</b></p>	
		  <p class="mt6">	
		  <?php	echo get_exclude_driver_age(); ?>	
		  </p>	 
	  </div>	
	  <!--<div class="fl w32 short_form ml16">
			<h3 class="greenHeader"> 
				<div class="radioContainer" style="position:relative;width:500px;">
					<input type="checkbox" id="rd3_4" name="type_check" class="checkbox" onclick="show_agency();" value="comp">
					<label for="rd3_4" class="checkboxLabel">COMPREHENSIVE</label>
					<input type="checkbox" id="rd3_414" name="type_check" class="checkbox" onclick="show_tpl();" value="tpl"/>
					<label for="rd3_414" class="checkboxLabel"> THIRD PARTY LIABILITY </label>
				</div>
			</h3>
	  </div>	-->
	 
									
		<div style="" id="agency_show">	
		<div class="cb mb15"></div>		
		<h3 class="greenHeader text-center"><label for="rd3_4" class="checkboxLabel black " style="text-decoration:underline;">COMPREHENSIVE</label></h3>	
		<div class="cb mb15"></div>		
				<div class="fl w100 short_form">				
					<div class="fldContainer">
					<table style="width:100%;border:1px solid #444;">
						<tr class="tg">
							<th class="frmLabel">AGENCY TYPE</th>
							<th colspan="2">Individual Rates</th>
							<th colspan="2">Commercial Rates</th>
						</tr>
						<tr class="tg">
							<th></th>
							<th>MIN VALUE</th>
							<th>PREMIUM VALUE IN (%)</th>
							<th>MIN VALUE</th>
							<th>PREMIUM VALUE IN (%)</th>
						</tr>
						<tr class="tg">
							<td>AGENCY</td>
							<td><input type="text" class="form-control" name="agency_type[1][minvalue]" id="current"></td>
							<td><input type="text" class="form-control" name="agency_type[1][premium_value]" id="current"></td>
							<td><input type="text" class="form-control" name="agency_type[1][comm_minvalue]" id="current"></td>
							<td><input type="text" class="form-control" name="agency_type[1][comm_premium_value]" id="current"></td>
						</tr>
						<tr class="tg">
							<td>NON-AGENCY(Standard)</td>
							<td><input type="text" class="form-control" name="agency_type[2][minvalue]" id="current"></td>
							<td><input type="text" class="form-control" name="agency_type[2][premium_value]" id="current"></td>
							<td><input type="text" class="form-control" name="agency_type[2][comm_minvalue]" id="current"></td>
							<td><input type="text" class="form-control" name="agency_type[2][comm_premium_value]" id="current"></td>
						</tr>
						<tr class="tg">
							<td>NON-AGENCY(Superior)</td>
							<td><input type="text" class="form-control" name="agency_type[3][minvalue]" id="current"></td>
							<td><input type="text" class="form-control" name="agency_type[3][premium_value]" id="current"></td>
							<td><input type="text" class="form-control" name="agency_type[3][comm_minvalue]" id="current"></td>
							<td><input type="text" class="form-control" name="agency_type[3][comm_premium_value]" id="current"></td>
						</tr>
					</table>
				</div>
        </div>
					
				<div class="companContainer">
					<div class="cb mb15"></div>												
						<h3 class="greenHeader text-center"><label for="rd3_414" class="checkboxLabel" style="text-decoration:underline;"> THIRD PARTY LIABILITY </label></h3>					
					<div class="cb mb15"></div>
					<table style="width:100%;border:1px solid #444;">
						<tr class="tg">
							<th class="frmLabel">NO. OF CYLINDERS</th>
							<th>Individual Rates</th>
							<th>Commercial Rates</th>
						</tr>
						<tr class="tg">
							<td>4 Cylinders</td>
							<td><input type="text" class="form-control" name="noofcylinders[4][individual][premiumvalue]" id="current"></td>
							<td><input type="text" class="form-control" name="noofcylinders[4][commercial][premiumvalue]" id="current"></td>
						</tr>
						<tr class="tg">
							<td>6 Cylinders</td>
							<td><input type="text" class="form-control" name="noofcylinders[6][individual][premiumvalue]" id="current"</td>
							<td><input type="text" class="form-control" name="noofcylinders[6][commercial][premiumvalue]" id="current"></td>
						</tr>
						<tr class="tg">
							<td>8 Cylinders</td>
							<td><input type="text" class="form-control" name="noofcylinders[8][individual][premiumvalue]" id="current"></td>
							<td><input type="text" class="form-control" name="noofcylinders[8][commercial][premiumvalue]" id="current"></td>
						</tr>
						<tr class="tg">
							<td>8 & Above Cylinders</td>
							<td><input type="text" class="form-control" name="noofcylinders[8A][individual][premiumvalue]" id="current"></td>
							<td><input type="text" class="form-control" name="noofcylinders[8A][commercial][premiumvalue]" id="current"></td>
						</tr>
					</table>
					<!--<div style="" class="col-md-6 pull-right" id="show_tpl">										
						<div class="form-group">
							<div class="fl w32 short_form ml16">
							<label class="frmLabel">NO. OF CYLINDERS</label><br>														4 Cylinders 	 <br>							6 Cylinders 	<br>							8 Cylinders 	<br>							8 & Above Cylinders 	<br>

							<!--<select class="form-control body_type" name="noofcylinders" id="body_id" onchange="bodytypeval();">
							<option value="">Select</option>
							<option value="4">4 Cylinder</option><option value="6">6 Cylinder</option><option value="8">8 Cylinder</option><option value="A8">8 Cylinder Above</option><option value="SC">Sports/Coupe</option>   	
							</select>--
																		
							</div>
						</div>
						<div class="fl w32 short_form ml16">
							<div class="fldContainer">
								  <label class="frmLabel" id="vLabel">Individual rates</label>	<br>	
								  <input type="text" class="form-control" name="noofcylinders[4][individual][premiumvalue]" id="current"> <input type="text" class="form-control" name="noofcylinders[6][individual][premiumvalue]" id="current"> <input type="text" class="form-control" name="noofcylinders[8][individual][premiumvalue]" id="current"><input type="text" class="form-control" name="noofcylinders[8A][individual][premiumvalue]" id="current">
							</div>
						</div>	

						<div class="fl w32 short_form ml16">
							<div class="fldContainer">	
								<label class="frmLabel" id="vLabel">Commercial rates</label>	<br>
								<input type="text" class="form-control" name="noofcylinders[4][commercial][premiumvalue]" id="current">
								<input type="text" class="form-control" name="noofcylinders[6][commercial][premiumvalue]" id="current">	
								<input type="text" class="form-control" name="noofcylinders[8][commercial][premiumvalue]" id="current">	
								<input type="text" class="form-control" name="noofcylinders[8A][commercial][premiumvalue]" id="current">
							</div>
						</div>						
					</div>-->
				</div>		

				
	  <div class="cb pb30"></div>	
</div>

	<div class="w90 auto mt30">
		 <h3 class="black text-center" style="text-decoration:underline;">AddOn Benefits</h3>	
		 <div class="cb mb15"></div>
		 <div class="fl w25 short_form">	
			 <p>PAB FOR DRIVER <b class="red">*</b></p>	
			 <p class="mt6" style="width:100%">		
				<input type="text" name="PAB_driver" value="" />
			 </p>	
		 </div>	
		 
		 <div class="fl w25 short_form">		
		 <p>ROAD SIDE ASSISTANCE <b class="red">*</b></p>	
			 <p class="mt6" style="width:100%">	
			 <input type="text" name="RSA" value="" />	
			 </p>	
		 </div>

		 
		 <div class="fl w25 short_form">		
		 <p>PAB FOR PASSANGER (PER PERSON) <b class="red">*</b></p>	
			 <p class="mt6" style="width:100%">		
			 <input type="text" name="PAB_passanger" value="" />	
			 </p>	 
		 </div>	
		 
		 <div class="fl w25 short_form">		
			 <p>ADD RENT A CAR <b class="red">*</b></p>	
			 <p class="mt6" style="width:100%">		
			 <input type="text" name="ADD_rent_car" value="" />	
			 </p>	
		 </div>	
		 
		 <div class="cb mb15"></div>	  

		 <div class="fl w32 short_form">	
			<p>Upload Document 1<b class="red">*</b></p>	
			 <p class="mt6" style="width:100%">		
			 <input type="file" name="file1" value="" />	
			 </p>	 
		 </div>	 
		 
		 <div class="fl w32 short_form">		
		 <p>Upload Document 2 <b class="red">*</b></p>	
			 <p class="mt6" style="width:100%">		
			 <input type="file" name="file2" value="" />	
			 </p>	 
		 </div>	  	
		 
		 <div class="cb pb30"></div>	 
	 </div>



	 <div class="w90 auto mt30">	
		 <h3 class="black text-center" style="text-decoration:underline;"> Do You Do Any Exceptional Cases:-  </h3>		
		 <div class="cb mb15"></div>	
		 <div class="fl w25 short_form">	
			 <p>Driver Licence <b class="red">*</b></p>	
			 <p class="mt6" style="width:100%">				
			 <input type="text" name="file2" value="" />	
			 </p>		
		 </div>		

		 <div class="fl w25 short_form">	
		 <p>Driver Age <b class="red">*</b></p>	
			 <p class="mt6" style="width:100%">		
			 <input type="text" name="file2" value="" />
			 </p>			
		 </div>	
		 
		 <div class="fl w25 short_form">
		 <p>Vehicle <b class="red">*</b></p>	
			 <p class="mt6" style="width:100%">		
			 <input type="text" name="file2" value="" />
			 </p>		
		 </div>		

		 <div class="fl w25 short_form">	
		 <p>Maker <b class="red">*</b></p>		
			 <p class="mt6" style="width:100%">		
			 <input type="text" name="file2" value="" />
			 </p>			
		 </div>		
		<div class="cb mb15"></div>	
		 <div class="fl w25 short_form">	
		 <p>Model <b class="red">*</b></p>	
			 <p class="mt6" style="width:100%">	
			 <input type="text" name="file2" value="" />	
			 </p>		
		 </div>		
	 
	</div>
	 
	 
	 
	 
 <div class="cb mb15"></div>	

	<div class="w90 auto mt30 mb15" style="text-align:center;">	
		 <div class="cb pb5"></div>	 
		 <input name="sbt_btn" value="Submit" name="submit" class="btn3 radius-3 trans_eff" type="submit">	
		 <input name="btn_rst" value="Reset" class="btn3x radius-3 trans_eff" type="reset">	 

		 <?php echo form_close(); ?>
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