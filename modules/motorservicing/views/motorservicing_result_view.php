<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>
<title> MOTOR INSURANCE </title>
<div class="container">

	<div class="p15 radius-3 white">
		<h1 class="fs24 black cc"><span> Result </span></h1>
    </div>
 
  <?php 
		//echo '<pre>';		print_r($motorservices_vendor_details);exit;
  
  foreach($motorservices_vendor_details as $key => $details){  ?>
		<?php if($details['company_name']){ ?>
					<div class="bs-calltoaction bs-calltoaction-default">
							<div class="row">
								<div class="col-lg-3 col-sm-12 col-md-3 col-xs-12 cta-contents">
										<a href="#"><img src="<?php echo base_url(); ?>assets/newasset/image/comapny_sumit.jpg" class="img-responsive border-shadow"/></a>
										<span class="company_name" id="company_name<?php echo $key; ?>"><?php echo strtoupper($details['company_name']); ?></span>
								</div>
								<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 cta-contents result_shown">
									<div class="cta-desc">
										<div class="span_div">
											<span>Premium Total :</span>
										</div>
										<div class="label_div" id="total<?php echo $key; ?>" >
											<label>AED <?php echo $details['total']; ?></label>
										</div>
									</div>
									<div class="cta-desc">
										<div class="span_div">
											<span>Vehicle Type :</span>
										</div>
										<div class="label_div" id="vendor_plan_id<?php echo $key; ?>">
											<label><?php echo strtoupper($details['vehicle_type']); ?></label>
										</div>
									</div>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 cta-contents">
									<div class="button-position-color">
									
									   <button type="submit" class="btn-width btn btn-info btn-sm download" data-toggle="modal" data-target="#myModaldownload<?php echo $key; ?>" id="<?php echo $key; ?>">
										  <span class="ion-chevron-down"></span> Download
										</button>
									
									
										<button type="button" class="btn-width btn btn-warning btn-sm" data-toggle="modal" data-target="#<?php echo $key; ?>myModaldetails" id="<?php echo $key; ?>">
										  <span class="ion-clipboard"></span> Details
										</button>
										<?php $user_info = $this->session->all_userdata();$user_id = $user_info['user_id'];if($user_id == ''){ ?>
											<button type="button" class="btn-width btn btn-primary btn-sm save" data-toggle="modal" title="Login" data-target="#loginModal">
											  <span class="ion-locked"></span> Save Plan
											</button>
											<button type="button" class="btn-width btn btn-success btn-sm BOOK" data-toggle="modal" title="Login" data-target="#loginModal">
											  <span class="ion-checkmark-round"></span> Book Plan
											</button>
										<?php }else{ ?>
											<button type="button" class="btn-width btn btn-primary btn-sm save" data-toggle="modal" data-target="#myModalsave<?php echo $key; ?>" id="<?php echo $key; ?>">
											  <span class="ion-locked"></span> Save Plan
											</button>
											<button type="button" class="btn-width btn btn-success btn-sm BOOK" data-toggle="modal" data-target="#myModalbook<?php echo $key; ?>" title="USER DOCUMENTS" id="<?php echo $key; ?>">
											  <span class="ion-checkmark-round"></span> Book Plan
											</button>
											
										<?php } ?>
									</div>
								</div>
							</div>
					</div>
	
	<?php } ?>
	<?php } ?>
	
	
	
</div>

<!-- DETAILS BOX -->
	<?php foreach($motorservices_vendor_details as $mykey => $details){ 	?>
	
	  <div id="<?php echo $mykey; ?>myModaldetails" class="modal fade" role="dialog" >
	  <div class="modal-dialog">
	  <div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"> Details </h4>
		  </div>
			<div class="modal-body">
			 <table class="table">
			  <tbody>
					<tr>
						<th><?php echo strtoupper($details['company_name']); ?></th>
					</tr>
					
					<tr>
						<th>Maker</th>
						<th>Model</th>
						
					</tr>
					<tr>
						<td><?php echo strtoupper($details['maker']); ?></td>
						<td><?php echo strtoupper($details['model']); ?></td>
						
					</tr>
					<tr>
						<th>Level Of Services</th> 
						<td> <?php echo strtoupper(get_level_of_serv($details['level_of_services'])); ?> </td>
					</tr>
					<tr>
						<th>Feature Of Services</th> 
						<td> <?php echo strtoupper(get_feature_of_serv($details['feature_of_services'])); ?> </td>
					</tr>
					<tr>
						<th>Add Ons</th> 
						<td> <?php echo strtoupper($details['add_ons']); ?> </td>
					</tr>
					
					
					<tr>
						<th><h3>Vendor Info</h3></th>
					</tr>
					<tr>
						<th>Address</th>
						<td> <?php echo strtoupper($details['vendor_address']['address']); ?> </td>
					</tr>
					<tr>
						<th>City</th>
						<td> <?php echo strtoupper($details['vendor_address']['city']); ?> </td>
					</tr>
					<tr>
						<th>Emirates</th>
						<td> <?php echo strtoupper($details['vendor_address']['state']); ?> </td>
					</tr>
					<tr>
						<th>Zip code</th>
						<td> <?php echo strtoupper($details['vendor_address']['zipcode']); ?> </td>
					</tr>
				</tbody>	
			  </table>
			</div>
	  </div> 
	  </div>
	  </div>
	 	
      <?php } ?>
  <!-- DETAILS BOX CLOSE -->
  
  
  
  <!-- BOOK FANCY BOX -->
  <?php foreach($motorservices_vendor_details as $key => $details){ ?> 
  
  <div id="myModalbook<?php echo $key; ?>" class="modal fade" role="dialog" >
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> BOOK NOW </h4>
	  </div>
		<div class="modal-body">
		<?php echo form_open_multipart('/motorservicing/book_motorservicing', array('id' => 'multiformupload')); ?>
	   <table class="table">
				<tr>
				<td><label>PASSPORT /  EMIRATES ID</label></td>
				<td> <input type="file" class="form-control" name="file1" />(front)</td><td><input type="file" class="form-control" name="file2" />(Backside)</td> 
				</tr>
				
				<tr>
				<td><label>Driving Licence </label></td><td><input type="file" class="form-control" name="file3" />(front)</td><td><input type="file" class="form-control" name="file4" />(Backside) </td>
				</tr>
				<tr>
				<td><label>MULKIYA   </label><td><input type="file" class="form-control" name="file5" />(front)</td><td><input type="file" class="form-control" name="file6" />(Backside) </td>
				</tr>
				<tr><td><label>Passing doc </label>  <input type="file" class="form-control" name="file7" /> </td>
				<td><label> Other docs</label><input type="file" class="form-control" name="file8" /> </td></tr>
				
			<tr>
				
				<input type="hidden" name="v_id" value="<?php echo $key; ?>" readyonly />
				<input type="hidden" name="vehicletype" value="<?php echo $details['vehicle_type_id']; ?>" readyonly />
				<input type="hidden" name="vehicle_makers" value="<?php echo $details['maker']; ?>" readyonly />
				<input type="hidden" name="vehicle_models_selected" value="<?php echo $details['model']; ?>" readyonly />
				<input type="hidden" name="services_level" value="<?php echo $details['level_of_services']; ?>" readyonly />
				<input type="hidden" name="id" value="<?php echo $details['id']; ?>" readyonly />
				<input type="hidden" name="date_motor_servicing" value="<?php echo $details['date_motor_servicing']; ?>" readyonly />
				<input type="hidden" name="feature_of_services" value="<?php echo $details['feature_of_services']; ?>" readyonly />
			</tr>
			<tr>
				<td><input type="submit" name="submit_user_files" id="submit_user_files"  class="btn3 trans_eff radius-3" value="BOOK NOW" /></td>
			</tr>		
		</table>		
   <?php echo form_close(); ?>
   </div>
  </div> 
  </div>
  </div>
  <?php } ?>	
  <!-- BOOK FANCY BOX CLOSE -->
  
  <!-- DOWNLOAD FANCY BOX -->
  <?php foreach($motorservices_vendor_details as $key => $download){ ?>
  
  <div id="myModaldownload<?php echo $key; ?>" class="modal fade" role="dialog" >
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> DOWNLOAD DOCUMENTS </h4>
	  </div>
		<div class="modal-body">
		<?php echo form_open_multipart('/motorservicing/download', array('id' => 'multiformupload')); ?>
		<table>
			<tr>
				<?php  if($download['download_doc'] != ''){ ?>
					<td><input type="hidden" name="docu" value="<?php echo $download['download_doc']; ?>" readyonly />
					
				<input type="submit" name="download_motorplan" id="download_motorplan"  class="btn3 trans_eff radius-3" value="DOWNLOAD DOC 1" />&nbsp;&nbsp;</td>
				 
				 <?php }else{ ?>
				 
					<td>
				<input type="button" name="download_motorplan" id="download_motorplan"  class="btn3 trans_eff radius-3" value="No Document uploaded" />&nbsp;&nbsp;</td>
				 
				 <?php } ?>
		
			 </tr>
		
		</table>
	<?php echo form_close(); ?>	
  
   </div>
  </div> 
  </div>
  </div>
 
  <?php } ?>
  <!-- DOWNLOAD FANCY BOX CLOSE -->
  
  
  <!-- SAVE FANCY BOX -->
  <?php  foreach($motorservices_vendor_details as $key => $details){ ?> 
  <div id="myModalsave<?php echo $key; ?>" class="modal fade" role="dialog" >
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> SAVE NOW </h4>
	  </div>
		<div class="modal-body">
		  
   <?php echo form_open_multipart('/motorservicing/save_motorservice', array('id' => 'multiformupload')); ?> 
   <table>
	   <tr>
			<td>
			
				<input type="hidden" name="v_id" value="<?php echo $key; ?>" readyonly />
				<input type="hidden" name="vehicletype" value="<?php echo $details['vehicle_type_id']; ?>" readyonly />
				<input type="hidden" name="vehicle_makers" value="<?php echo $details['maker']; ?>" readyonly />
				<input type="hidden" name="vehicle_models_selected" value="<?php echo $details['model']; ?>" readyonly />
				<input type="hidden" name="services_level" value="<?php echo $details['level_of_services']; ?>" readyonly />
				<input type="hidden" name="date_motor_servicing" value="<?php echo $details['date_motor_servicing']; ?>" readyonly />
				<input type="hidden" name="id" value="<?php echo $details['id']; ?>" readyonly />
				<input type="hidden" name="feature_of_services" value="<?php echo $details['feature_of_services']; ?>" readyonly />
			
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="save_motorservplan" id="save_motorservplan"  class="btn3 trans_eff radius-3" value="YES" />&nbsp;&nbsp;<input type="button" class="btn3 trans_eff radius-3" data-dismiss="modal" value="NO" /></td>
		</tr>		
	</table>		
   <?php echo form_close(); ?>
   </div>
  </div> 
  </div>
  </div>
  <?php } ?>	
  <!-- BOOK FANCY BOX CLOSE -->
<script>
	$(document).ready(function(){
		$('.BOOK').click(function(){
			var id = $(this).attr('id');
			//alert(id);
			$('#v_id1').val(id);
		});
				
		$('.save').click(function(){
			var id = $(this).attr('id');
			//alert(id);
			$('#v_id2').val(id); 
		});
				
	});
</script>
	
<?php $this->load->view("bottom_application");?>