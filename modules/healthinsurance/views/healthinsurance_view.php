<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>
<title> HEALTH INSURANCE </title>
<style>
.input_ll{width:32%;float:left;margin-right:5px;margin-left:22px;}
.input_rr{width:32%;float:left;margin-right:5px;}
.input_lll{width:32%;float:left;}
.bhdw{backgroud:#000 !important;}
.cc { border:3px solid #d5d5d5;  }
</style>

<div class="wrapper pt20 pb20 " style="min-height:300px">
  <div class="p15 radius-3 white cc">
	<h1 class="fs24 black">Health Insurance</h1>
  </div>
  <?php echo form_open('healthinsurance/health_result');?>
  
  <div class="fl w100 mt20 bhdw fs14 p20 border1 radius-5" style="background:#f5ffff;">
	<fieldset class="pb15" style="border:0; border-bottom:1px solid #f1f1f1">
		<legend class="b fs18 b mb20 blue"> Information Needed :</legend>
		<div class="input_ll">
		  <p class="pt8"><label for="Country ID">EMIRATES<b class="red">*</b> :</label></p>
		  <select name="country_id" id="country_id" style="width:90%; padding:5px;">
			<option value="">Select</option>
					<option value="DUB">Dubai</option> 
					<option value="ABU">Abu Dhabi</option> 
					<option value="SHR">Sharjah</option> 
					<option value="RAK">Ras Al Khaimah</option> 
					<option value="AJM">Ajman</option> 
					<option value="FUI">Fujairah</option> 
					<option value="UAQ">Umm Al Quwain</option> 
			</select>
		  <div class="cb pb5"></div>
		</div>

		<div class="input_rr">    
		  <p class=" pt8"><label for="Plan">Select Plan <b class="red">*</b> :</label></p>
		 <select name="plan_id" id="plan_id" style="width:90%; padding:5px;">
			  <option value="">Select</option>
					<option value="BDHA">Basic</option>
					<option value="SGOLD">Enhance Silver</option>
					<option value="GGOLD">Enhance Gold</option>
					<option value="PGOLD">Enhance Platinum</option>
			 
			</select>
		  <div class="cb pb5"></div>
		</div>
		<!--<div class="cb"></div>-->

		<div class="input_lll">
		  <p class=" pt8"><label for="Driving licence">Geographical Scope<!--<b class="red">*</b>--> :</label></p>
		  <div class="mt3">
		  
		  <select class="form-control" name="geographicalscope" onchange="geoscope();" id="geo_scope_id" tabindex="-98" style="width:90%; padding:5px;">
				<option value="">Select</option>
                <option value="Worldwide">Worldwide</option>
                <option value="UAE">UAE</option>
                <option value="GCC">GCC</option>
                <option value="USA">World Wide ex-USA</option>
                <option value="middleeast">Middle East &amp; North Africa </option>
            </select>
			
			 </div>
		  <div class="cb pb5"></div>
		</div>
	</fieldset>
	
	<fieldset class="pb15 mt10" style="border:0; border-bottom:1px solid #f1f1f1">
		<div class="input_ll">
		  <p class="pt8"><label for="state">BENEFITS <!--<b class="red">*</b>--> :</label></p>
		  <div class="mt3">
			<select class="form-control" id="benefits" name="benefits" tabindex="-98" style="width:90%; padding:5px;">
	            <option value="">Select</option>
	            <option value="dental">Dental</option>
	             <option value="maternity">Maternity</option>
	        </select>
				  </div>
		  <div class="cb pb5"></div>
		</div>
		
		


		<!--<div class="input_rr">
		  <p class="pt8"><label for="User Type"> User Type   :</label></p>
		  <div class="mt3">
			<select class="form-control" name="user_type" onchange="Gender();" tabindex="-98" style="width:90%; padding:5px;">
	            <option value="">Select</option>
	            <option value="1">Employee</option>
	            <option value="2">Dependent</option>										
	        </select>		
		  </div>
		  <div class="cb pb5"></div>
		</div>-->
		
		<div class="cb"></div>
		<div class="input_ll">
		  <p class="pt8"><label for="Gender"> Gender  <b class="red">*</b> :</label></p>
		  <div class="mt3">
			<select name="userdata[0][gender]" id="Gender" style="width:90%; padding:5px;">
			  <option value="">Select</option>
			  <option value="M">Male</option>
			  <option value="F">Female</option>
			  <option value="MF">Female- Merried</option>
			</select>
		  </div>
		  <div class="cb pb5"></div>
		</div>
		

		<div class="input_rr">
		  <p class="pt8"><label for="contact_name">Contact Name <b class="red">*</b> :</label></p>
		  <div class="mt3">
			<input name="userdata[0][member_user_name]" id="contact_name" value="" style="width:90%; padding:5px;" type="text">
				  </div>
		  <div class="cb pb5"></div>
		</div>

		<div class="input_rr">      
		  <p class="pt8"><label for="date_of_birth">Date of Birth <b class="red">*</b> :</label></p>
		  <div class="mt3">
			<input name="userdata[0][dob]" id="datepicker" class="dob" style="width:90%; padding:5px;" type="text" >
				  </div>
		  <div class="cb pb5"></div>
		</div>
		<div class="cb"></div>
		<div class="input_ll">
			<div class="mt3">
			<label> Employee  <input type="radio" name="emptype" value="Emp"/></label>
			<label> Dependent <input type="radio" name="emptype" value="Dep"/></label>
		  <div class="cb pb5"></div>
		</div>
		</div>
		<div class="input_ll_add">
			<input type="hidden" id="input_ll_field" value="1" />
		</div>
		
		<div class="input_ll">
			<div class="mt3">
			<a href="#" class="addMemberBtn btn3 trans_eff radius-3"><i class="fa fa-plus"></i>Add Member</a></div>
		  <div class="cb pb5"></div>
		</div>
		
		
		
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
  
  <style>
  /* DivTable.com */
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
  
  
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $('document').ready(function() {
	  
	$('.addMemberBtn').hide();
	  
    $("#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: "1900:2016"
    });
	
	$('input[name=emptype]').click(function(){
		var value_ty = $(this).val();
		if(value_ty == 'Emp'){
			$('.addMemberBtn').show();
		}
		if(value_ty == 'Dep'){
			$('.addMemberBtn').hide();
		}
	});
	
	$('.addMemberBtn').click(function(){
			
			var count = $('#input_ll_field').val();
			
			$('.input_ll_add').append('<div class="divTable"><div class="divTableBody first" id="'+ count +'"><div class="divTableRow"><div class="divTableCell">Name:- <input class="form-control" name="userdata['+ count +'][member_user_name]" type="text"></div><div class="divTableCell">DOB<input class="form-control" name="userdata['+ count +'][dob]" id="datepicker'+ count +'" type="text" placeholder="dd-mm-yyyy"></div><div class="divTableCell"><select class="changegen" id="gender'+ count +'" name="userdata['+ count +'][gender]" ><option value="M"> Male </option><option value="F"> Female </option><option value="FM"> Female(MARRIED) </option><option value="MO"> Mother </option><option value="W"> Wife </option></select></div></div></div></div>');		
			
			count++;
			
			$('#input_ll_field').val(count);
			return false;
			
	});
	
	$('.changegen').live('change',function(){
		
		var gen = $(this).attr('id');
		
		
	});
	
	$('#submit').click(function(){
		
		if($('#country_id').val() == ''){
			alert('Please select Registration Of Emirates');
			return false;
			
		}
		if($('#plan_id').val() == ''){
			alert('Please select Plan');
			return false;
			
		}
		if($('#Gender').val() == ''){
			alert('Please select Gender');
			return false;
			
		}
		if($('#contact_name').val() == ''){
			alert('Please select Contact Name');
			return false;
			
		}
		
		if($('#datepicker').val() == ''){
			alert('Please select Birth Date');
			return false;
			
		}
		if($('input[name=emptype]').prop("checked") == false){
			alert('Please select Employee Type');
			return false;
			
		}
		
	});
	
	
  });
  
  </script>
</div>

<?php $this->load->view("bottom_application");?>