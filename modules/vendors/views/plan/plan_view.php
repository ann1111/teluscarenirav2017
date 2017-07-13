<?php $this->load->view("top_application");?><?php $this->load->view("project_header");?><style type="text/css">.tg  {border-collapse:collapse;border-spacing:0;}.tg td{font-family:Arial, sans-serif;font-size:14px;padding:2px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:2px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}.tg .tg-baqh{text-align:center;vertical-align:top}.tg .tg-yw4l{vertical-align:top}</style><?php echo form_open_multipart('/vendors/plan/post_plan'); ?> <div class="w90 auto mt90">	<p class="fr mt1"><a href="<?php echo base_url() ?>vendors" class="btn1 radius-20t" title="�Go Back">Go Back</a> </p>	<h2 class="bb1 pb5 black text-center">Add - Health Insurance - Plans - Rates - Services - Features</h2>  <span class="green"> <?php echo $success; ?>  </span>	 <div class="fl w25 short_form">					<label>SELECT STATE <b class="red">*</b></label>			<p class="mt6" style="width:100%">			<?php echo get_emirates_field('country_id','emirates'); ?>						</p>	  </div>	  <div class="fl w25 short_form">		<label>SELECT PLAN <b class="red">*</b></label>		<p class="mt6">			<?php echo get_health_plan_field('plan_id','plan'); ?> 		</p>	  </div>	  		<div class="fl w25 short_form">		<label>Map Network <b class="red">*</b></label>		<p class="mt6">			<?php echo get_health_maps_field('geo_scope_id','geographicalscope'); ?> 		 </p>	  </div>			<div class="fl w25 short_form">		<label>UPLOAD PLAN <b class="red">*</b> <small>gif|jpg|png|jpeg|txt|pdf|doc</small> </p>		<p class="mt6">			<input type="file" name="upload_health_doc" /> 		 </p>	</div>	 <p class="red"> <?php echo $error; ?> </p>	 	  <div class="cb mb15"></div>	  <div class="fl w25 short_form">		<label>Special Features can be added <b class="red">*</b></label>		<p class="mt6">			<textarea name="special_features_dec" maxlength="500"> </textarea>		</p>	  </div>	  	  <div class="fl w25 short_form">		<label>Custom plan Name <b class="red">*</b></label>		<p class="mt6">			<input type="text" name="custom_plan_name" /> 		</p>	  </div>	  <div class="fl w25 short_form">		<label>Insurance Company Name <b class="red">*</b></label>		<p class="mt6">			<input type="text" name="insu_comp_name" /> 		</p>	  </div>	  	  <div class="fl w25 short_form">		<label>Silent Cover Features <b class="red">*</b></label>		<p class="mt6">			<select class="form-control" id="Silent" name="silent_features" multiple>				<option value="">Select</option>				<option value="hospital">Hospital</option>				<option value="clinic">Clinic</option>				<option value="pharmacy">Pharmacy</option>				<option value="diagnose">Diagnose</option>			</select> 		</p>	  </div>	  	 <?php if($_SESSION['health_exclude_data'] != ''){ ?>	  <div class="cb mb15"></div>			<table>			  <tr class="tg"> 				  <td class="tg-031e"> Selected State </td> 				  <td class="tg-031e"> Selected Plan </td>				  <td class="tg-031e"> Map Network </td>				  <td class="tg-031e"> Special Feature </td> 			  <td class="tg-031e"> Your Plan Name </td> 			  <td class="tg-031e"> Insurance Company Name</td>				  <td class="tg-031e"> Silent Cover Feature </td>			  </tr>				  <tr> 					  <td class="tg-031e" id="Vehicle_type_field"> 			  <?php echo get_vehicle_type($_SESSION['motor_exclude_data']['vehicletype']); ?> </td>				  <td class="tg-031e" id="vehicle_name_field"> <?php echo $_SESSION['motor_exclude_data']['vehicle_name']; ?> </td>				  <td class="tg-031e" id="vehicle_models_field"> <?php foreach($_SESSION['motor_exclude_data']['vehicle_models'] as $modal){ echo $modal; echo '<br>'; }  ?>			  </td>					  <td class="tg-031e" id="vehicle_year_field"> <?php echo $_SESSION['motor_exclude_data']['vehicle_year']; ?> </td> 				  <td class="tg-031e" id="driver_age_field"> <?php echo get_driver_age($_SESSION['motor_exclude_data']['driver_age']); ?> </td> 			  <td class="tg-031e" id="drving_field"> <?php echo get_driver_licence($_SESSION['motor_exclude_data']['Driving_Licence']); ?> </td>			  <td class="tg-031e" id="country_id_field"> <?php echo $_SESSION['motor_exclude_data']['emirates']; ?> </td> 		  </tr>		  </table>	 <?php } ?>		<div class="cb mb15"></div>		<h3 class="bb1 pb5 black text-center">AddOns Features</h3>	<div>	 <div class="cb mb15"></div>		  <div class="fl w25 short_form">		<label>Dental <b class="red">*</b></label>		<p class="mt6">			<input type="text" name="dental" class="form-control"/> 		</p>	  </div>	   <div class="fl w25 short_form">		<label>Maternity <b class="red">*</b></label>		<p class="mt6">			<input type="text" name="maternity" class="form-control"/> 		</p>	  </div>	   <div class="fl w25 short_form">		<label>Eye <b class="red">*</b></label>		<p class="mt6">			<input type="text" name="eye" class="form-control"/> 		</p>	  </div>	</div>		<div class="cb mb15"></div>				<h3 class="bb1 pb5 black text-center">Add Rates</h3>	 <div class="cb mb15"></div>				<div class="input_ll_add">	 <div class="cb mb15"></div>		  <div class="fl w25 short_form">		<label>Age Start <b class="red">*</b></label>		<p class="mt6">			<input type="text" name="userdata[0][agestart]" class="form-control"/> 		</p>	  </div>	  <div class="fl w25 short_form">		<label>Age End <b class="red">*</b></label>		<p class="mt6">			<input type="text" name="userdata[0][ageend]" class="form-control"/> 		</p>	  </div>	  <div class="fl w25 short_form">		<label>Select <b class="red">*</b></label>		<p class="mt6">			<?php echo get_relations_field('','userdata[0][relation]') ?>		</p>	  </div>	  <div class="fl w25 short_form">		<label>Premium Value <b class="red">*</b></label>		<p class="mt6">			<input type="text" name="userdata[0][premium_val]" class="form-control"/> 		</p>	  </div>	</div>			<div>			<input type="hidden" id="input_ll_field" value="1" />		</div>		  <div class="cb pb5"></div>	<button name="add_relation_rates" id="addMemberBtn" class="btn3 radius-3 trans_eff"> Click to Add New Rates </button>	  <div class="cb pb5"></div>		<div class="text-center">			<input name="sbt_btn" value="Submit" name="submit" class="btn3 radius-3 trans_eff" type="submit">			<input name="btn_rst" value="Reset" class="btn3x radius-3 trans_eff mr13" type="reset">		</div>	  	 </div> <?php echo form_close(); ?>		<div class="cb pb30"></div><script>$('#addMemberBtn').click(function(){						var count = $('#input_ll_field').val();						$('.input_ll_add').append('<div class="cb mb15"></div><div class="fl w19 short_form ml16"><p>Age Start <b class="red">*</b></p><p class="mt6"><input type="text" name="userdata['+count+'][agestart]" class="form-control"/></p></div><div class="fl w19 short_form ml16"><p>Age End <b class="red">*</b></p><p class="mt6"><input type="text" name="userdata['+count+'][ageend]" class="form-control" /></p> </div><div class="fl w25 short_form ml16"><p>Select <b class="red">*</b></p><p class="mt6"><select name="userdata['+count+'][relation]" class="form-control"><option value=""> Select </option><option value="CM"> Child Male </option><option value="CF"> Child Female </option><option value="M"> Married </option><option value="UM"> Unmarried </option><option value="MF"> Married Female </option><option value="F"> Father </option><option value="MO"> Mother </option><option value="MCS"> Maid/Cleaner/Servent </option><option value="P"> Partner </option><option value="E"> Employee </option></select></p></div><div class="fl w25 short_form ml16"><p>Premium Value <b class="red">*</b></p><p class="mt6"><input type="text" name="userdata['+count+'][premium_val]" class="form-control" /></p></div>');								count++;						$('#input_ll_field').val(count);			return false;				});</script><?php $this->load->view("bottom_application");?>