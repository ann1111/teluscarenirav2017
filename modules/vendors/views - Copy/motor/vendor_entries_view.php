<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>

<style>

.divTable{
	display: table;
	width: 100%;
}
.divTableRow {
	display: table-row;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
}
.divTableCell, .divTableHead {
	border: 1px solid #999999;
	display: table-cell;
	padding: 3px 10px;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
	font-weight: bold;
}
.divTableFoot {
	background-color: #EEE;
	display: table-footer-group;
	font-weight: bold;
}
.divTableBody {
	display: table-row-group;
}

</style>


<div class="w90 auto mt90">
<p class="fr mt1"><a href="<?php echo base_url(); ?>vendors/motor" class="btn1 radius-20t" title="?Go Back">Go Back</a> </p>
<h2 class="bb1 pb5">FILTER HERE</h2>



<?php echo form_open('/vendors/motor/vendor_entries_show'); ?>

			<div class="fl short_form ml16">
			<p>INSURANCE TYPE <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="p7" name="insurance_type" id="insurance_type">
					<option value="">Select</option>
					<option value="comp" selected>Comprehensive</option>
					<option value="tpl">Third Party Liabilities</option>
			</select>
			</p>
			</div>
			
			<div class="fl short_form ml16" id="noofcylinders">
			<p> NO OF CYLINDER <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="form-control body_type" name="noofcylinders" >
				<option value="">Select</option>
				<option value="4">4 Cylinder</option>
				<option value="6">6 Cylinder</option>
				<option value="8">8 Cylinder</option>
				<option value="A8">8 Cylinder Above</option>
				<option value="SC">Sports/Coupe</option>   	
			</select>
			</p>
			</div>
			
			<div class="fl short_form ml16" id="agancy">
			<p> AGENCY TYPE <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="form-control" name="agencytype" >
					<option value="">Select</option>
					<option value="1">Agency</option>
					<option value="2">NON-AGENCY(Standard)</option>
					<option value="3">NON-AGENCY(Superior)</option>
			</select>
			</p>
			</div>
			
			<div class="fl short_form ml16">
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
			
			<div class="fl short_form ml16">
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
			
			<div class="fl w12 short_form ml16">
			<p>SELECT GCC <b class="red">*</b></p>	
			<p class="mt6" style="width:100%">
				<select class="p7" name="gcc_status">
						<option value="">Select</option>
						<option value="1">YES</option>
						<option value="0">NO</option>
				</select>
			</p>
			</div>
			
			<div class="fl short_form ml16">
			<p>DRIVING LICENCE <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="form-control current" id="drving" onchange="vaildationlicence();" name="Driving_Licence" tabindex="-98">
		        <option value="" selected="selected">Select</option> 
				<option value="l6">less than 6 months</option> 
				<option value="l1">less than 1 year</option> 
				<option value="1">1 year</option> 
				<option value="2">2 years</option> 
				<option value="A2">Above 2 years</option> 
			</select>
			</p>
			</div>
			
			<div class="fl short_form ml16">
			<p>DRIVING AGE <b class="red">*</b></p>
			<p class="mt6" style="width:100%">
			<select class="p7" name="driver_age">
					<option value="">Select</option>
					<option value="1">Less than 25</option>
					<option value="2">20 to 25</option>
					<option value="3">More than 25</option>
			</select>
			</p>
			</div>
			
			<div class="fl short_form ml16">
			<p> <b class="red"></b></p>
			<p class="mt20" style="width:100%">
				<input name="sbt_btn" value="Submit" name="submit" class="btn3 radius-3 trans_eff" type="submit">
			</p>	
			</div>
			 <div class="cb mb15"></div>
			 
			 
			 
			 <p class="fr mt1"> </p>
			 <h2 class="bb1 pb5">RESULT FOR <?php if($this->input->post('insurance_type') == 'comp'){ echo 'COMPREHENSIVE'; }else{ echo 'THIRD PARTY LIABILITY'; } ?></h2>
			 
			 <div class="divTable">
				<div class="divTableBody">
				<div class="divTableRow">
					<div class="divTableCell">Vehicle Type</div>
					<?php if($this->input->post('insurance_type') == 'comp'){ ?><div class="divTableCell">Agency type</div> <?php }else{ ?>
					<div class="divTableCell">No Of Cylinder</div><?php } ?>
					<div class="divTableCell">Registration Emirates</div>
					<div class="divTableCell">Driver Age</div>
					<div class="divTableCell">Driver Licence</div>
					<div class="divTableCell">GCC</div>
					<div class="divTableCell">Premium Value</div>
					
				</div>
				<?php foreach($results as $result){ ?>
				<div class="divTableRow">
					
					<div class="divTableCell"><?php echo get_vehicle_type($result['vehicle_type']); ?></div>
					
					<?php if($this->input->post('insurance_type') == 'comp'){ ?>
					<div class="divTableCell"><?php echo get_agency_type($result['agency_type']); ?></div>
					<?php }else{ ?>
								<div class="divTableCell"> <?php echo get_no_cylinder($result['noofcilender']); ?> </div>
					<?php } ?>
					
					<div class="divTableCell"><?php echo get_emirate_name($result['registration_emirates']); ?></div>
					
					<div class="divTableCell"><?php echo get_driver_age($result['driver_age']); ?></div>
					
					<div class="divTableCell"><?php echo get_driver_licence($result['d_licence']); ?></div>
					
					<div class="divTableCell"><?php echo get_gcc($result['gcc']); ?></div>
					
					<?php if($this->input->post('insurance_type') == 'comp'){ $prem_val = $result['premium_value'].' %'; }else{ $prem_val = $result['premiumvalue']; } ?>  
					<div class="divTableCell"><?php echo $prem_val; ?></div>
				</div>
				<?php } ?>
				</div>
			</div>

		 
<?php echo form_close(); ?>

<div class="cb mb15"></div>
</div>

<script type="text/javascript">

$(document).ready(function(){
	
	$('#agency').show(); $('#noofcylinders').hide();
	
	$('#insurance_type').change(function(){
		
		var state = $(this).val();
		if(state == 'tpl'){ $('#noofcylinders').show(); $('#agancy').hide(); }
		if(state == 'comp'){ $('#agancy').show(); $('#noofcylinders').hide(); }
		
	});
	
});
	
</script>


<?php $this->load->view("bottom_application");?>