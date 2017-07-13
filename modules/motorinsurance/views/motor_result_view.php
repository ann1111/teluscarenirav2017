<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>
<title> MOTOR INSURANCE </title>
<div class="container">

	<div class="p15 radius-3 white">
		<h1 class="fs24 black cc"><span> Result </span></h1>
    </div>
 
  <?php foreach($motor_vendor_details as $key => $details){  ?>
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
									
									   <button type="submit" class="btn-width btn btn-info btn-sm download" data-toggle="modal" data-target="#myModaldownload" id="<?php echo $key; ?>">
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
											<button type="button" class="btn-width btn btn-primary btn-sm save" data-toggle="modal" data-target="#myModalsave" id="<?php echo $key; ?>">
											  <span class="ion-locked"></span> Save Plan
											</button>
											<button type="button" class="btn-width btn btn-success btn-sm BOOK" data-toggle="modal" data-target="#myModalbook" title="USER DOCUMENTS" id="<?php echo $key; ?>">
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
	<?php foreach($motor_vendor_details as $mykey => $details){ $tot = 0;
	
	//echo $details['exclude_motors'];
	
	if($details['post_val']['type_check'] == 'comp'){ $service_type = 'COMPREHENSIVE';  }else{ $service_type = 'THIRD PARTY LIABILITIES'; }
	
	?>
	
	  <div id="<?php echo $mykey; ?>myModaldetails" class="modal fade" role="dialog" >
	  <div class="modal-dialog">
	  <div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"> Vehicle Details </h4>
		  </div>
			<div class="modal-body">
			 <table class="table">
			  <tbody>
					<tr><h2> <?php echo $service_type; ?> </h2></tr>
					<tr>
						<th><?php echo strtoupper($details['company_name']); ?></th>
					</tr>
					<?php if($details['exclude_motors'] == 1){ ?>
						Sorry For inconvenience. This maker <b><?php echo strtoupper($details['post_val']['vehicle_name']); ?></b> For Model <b><?php echo strtoupper($details['post_val']['vehicle_models']); ?></b> Are not available with this Vendor :( !  
					<?php }else{ ?>
					<tr>
						<th>Maker</th>
						<th>Model</th>
						<th>Reg Of Year</th>
					</tr>
					<tr>
						<td><?php echo strtoupper($details['post_val']['vehicle_name']); ?></td>
						<td><?php echo strtoupper($details['post_val']['vehicle_models']); ?></td>
						<td><?php echo strtoupper($details['post_val']['year_of_reg']); ?></td>
					</tr>
					<?php } ?>
					<tr>
						<th>Driver Licence</th>
						<th>Driver Age</th>
						<th>Registration Emirate</th>
						<th>GCC</th>
					</tr>
					<tr>
						<td><?php echo strtoupper(get_driver_licence($details['post_val']['Driving_Licence'])); ?></td>
						<td><?php echo strtoupper(get_driver_age($details['post_val']['driver_age'])); ?></td>
						<td><?php echo strtoupper(get_emirate_name($details['post_val']['emirates'])); ?></td>
						<td><?php echo strtoupper(get_gcc($details['post_val']['gcc_status'])); ?></td>
					</tr>
					<tr> <td colspan="3"> <h3> Benefit Types </h3> </td> </tr>
					<?php if($details['post_val']['type_check'] == 'comp') { ?>
					<?php foreach($details['summary_benefits'] as $key => $pst){ $tot += $pst; ?>					
						<tr> 
							<td><label> <?php echo strtoupper($key); ?> </label></td>
							<td> <?php echo $pst; ?> </td>
						</tr>
					 <?php } ?>
					 
					<tr><td> <label>No Of Passangers</label> </td><td> <?php if($details['post_val']['PAB_passangers_txt'] == ''){ echo 1; }else{ echo $details['post_val']['PAB_passangers_txt']; } ?> </td></tr>
					<tr><td> <label>Total</label> </td><td><label> AED <?php echo $tot; ?></label> </td></tr>
					<?php }else{ ?>
						<tr> <td> No Of Cylinder </td>	<td><?php echo $details['post_val']['noofcylinders']; ?></td> </tr>
					<?php } ?>
				</tbody>	
			  </table>
			</div>
	  </div> 
	  </div>
	  </div>
	 	
      <?php } ?>
  <!-- DETAILS BOX CLOSE -->
  
  
  
  <!-- BOOK FANCY BOX -->
  <?php foreach($motor_vendor_details as $details){ ?> 
  
  <div id="myModalbook" class="modal fade" role="dialog" >
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> BOOK NOW </h4>
	  </div>
		<div class="modal-body">
		<?php echo form_open_multipart('/motorinsurance/book_motor_service', array('id' => 'multiformupload')); ?>
	   <table class="table">
			<tr>
				<td><label>PASSPORT  <input type="file" class="form-control" name="file1" /></label> </td>
				<td><label>MULKIYA   <input type="file" class="form-control"name="file2" /></label> </td>
				<td><label>EMIRATES ID <input type="file" class="form-control" name="file3" /></label></td>
				<td><?php foreach($details['post_val'] as $key => $pst){ ?>			
				<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $pst; ?>" readyonly />
				<?php } ?>
				<input type="hidden" name="v_id" value="" id="v_id1" readyonly />
				</td>
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
  <div id="myModaldownload" class="modal fade" role="dialog" >
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> DOWNLOAD DOCUMENTS </h4>
	  </div>
		<div class="modal-body">
	<table>
	<?php foreach($motor_vendor_details as $key => $download){ 
		  foreach($download['downloadable_data'] as $dwn){ 
		 
			if(!empty($dwn['vendor_doc1'])){ ?>
		<?php echo form_open_multipart('/motorinsurance/download', array('id' => 'multiformupload')); ?>
	    <tr><td><input type="hidden" name="docu" value="<?php echo $dwn['vendor_doc1']; ?>" readyonly />
			
		<input type="submit" name="download_motorplan" id="download_motorplan"  class="btn3 trans_eff radius-3" value="DOWNLOAD DOC 1" />&nbsp;&nbsp;</td>
		 <?php echo form_close(); ?>
		 <?php } ?>
		 
		 <?php if(!empty($dwn['vendor_doc2'])){ ?>
		 <?php echo form_open_multipart('/motorinsurance/download', array('id' => 'multiformupload')); ?>
			
			<td>	<input type="hidden" name="docu" value="<?php echo $dwn['vendor_doc2']; ?>" readyonly />
				<input type="submit" name="download_plan" id="download_motorplan"  class="btn3 trans_eff radius-3" value="DOWNLOAD DOC 2" />&nbsp;&nbsp;</td>
		 <?php echo form_close(); ?>
		 <?php } ?>
		
		<?php } ?>
			 </tr>
		<?php } ?>
	</table>		
  
   </div>
  </div> 
  </div>
  </div>
  <!-- DOWNLOAD FANCY BOX CLOSE -->
  
  
  <!-- SAVE FANCY BOX -->
  <div id="myModalsave" class="modal fade" role="dialog" >
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> SAVE NOW </h4>
	  </div>
		<div class="modal-body">
		  
   <?php echo form_open_multipart('/motorinsurance/save_motor_service', array('id' => 'multiformupload')); ?> 
   <table>
	   <tr>
			<td>
			<?php foreach($motor_vendor_details as $details){ ?> 
			<?php foreach($details['post_val'] as $key => $pst){ ?> 
				<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $pst; ?>" readyonly />
			<?php } ?>	
			<?php } ?>	
				<input type="hidden" name="v_id" value="" id="v_id2" readyonly />
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="save_motorplan" id="save_motorplan"  class="btn3 trans_eff radius-3" value="YES" />&nbsp;&nbsp;<input type="button"  class="btn3 trans_eff radius-3" data-dismiss="modal" value="NO" /></td>
		</tr>		
	</table>		
   <?php echo form_close(); ?>
   </div>
  </div> 
  </div>
  </div>
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