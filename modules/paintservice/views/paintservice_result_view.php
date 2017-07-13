<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>
<title> PAINT SERVICE </title>
<div class="container">

	<div class="p15 radius-3 white">
		<h1 class="fs24 black cc"><span> Result </span></h1>
    </div>
 
  <?php 
		//echo '<pre>';		print_r($motorservices_vendor_details);exit;
  
  foreach($pestcontrol_vendor_details as $key => $details){  ?>
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
											<span>Type Of Service:</span>
										</div>
										<div class="label_div" id="vendor_plan_id<?php echo $key; ?>">
											<label><?php echo strtoupper(get_types_of_services($details['type_of_service'])); ?></label>
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
	<?php foreach($pestcontrol_vendor_details as $mykey => $details){ //print_r($details);	?>
	
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
					<tr>
						<th><?php echo strtoupper($details['company_name']); ?></th>
					</tr>
					<tr>
						<th>Type Of Service</th>
					</tr>
					<tr>
						<td><?php echo strtoupper(get_types_of_services($details['type_of_service'])); ?></td>
					</tr>
					<tr>
						<th>Type Of Premises</th>
						<th>Kind Of Premises</th>
					</tr>
					<tr>
						<td><?php echo strtoupper(get_type_of_premise($details['type_of_premises'])); ?></td>
						<td><?php echo strtoupper(get_kind_of_premise($details['kind_of_premises'])); ?></td>
						
					</tr>
					<tr>
						<th>Approx Area</th> 
						<td> <?php echo strtoupper(get_approx_area($details['approx_area'])); ?> </td>
					</tr>
					<tr>
						<th>Total</th> 
						<td> AED <?php echo strtoupper($details['total']); ?> </td>
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
  <?php foreach($pestcontrol_vendor_details as $key => $details){ ?> 
  
  <div id="myModalbook<?php echo $key; ?>" class="modal fade" role="dialog" >
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> BOOK NOW </h4>
	  </div>
		<div class="modal-body">
		<?php echo form_open_multipart('/pestcontrol/book_pestcontrol', array('id' => 'multiformupload')); ?>
	   <table class="table">
			<tr>
				<td><label>UPLOAD DOCS1</label></td>
				<td> <input type="file" class="form-control" name="file1" /></td>
			</tr>
			<tr>
				<td><label>UPLOAD DOCS2</label></td>
				<td><input type="file" class="form-control" name="file2" /> </td> 
			</tr>
					
			<tr>
				
				<input type="hidden" name="v_id" value="<?php echo $key; ?>" readyonly />
				<input type="hidden" name="type_of_service" value="<?php echo $details['type_of_service']; ?>" readyonly />
				<input type="hidden" name="type_of_premises" value="<?php echo $details['type_of_premises']; ?>" readyonly />
				<input type="hidden" name="kind_of_premises" value="<?php echo $details['kind_of_premises']; ?>" readyonly />
				<input type="hidden" name="approx_area" value="<?php echo $details['approx_area']; ?>" readyonly />
				<input type="hidden" name="booking_date" value="<?php echo $details['book_date']; ?>" readyonly />
				<input type="hidden" name="id" value="<?php echo $details['id']; ?>" readyonly />
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
  <?php foreach($pestcontrol_vendor_details as $key => $download){ ?> 
  <div id="myModaldownload<?php echo $key; ?>" class="modal fade" role="dialog" >
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> DOWNLOAD DOCUMENTS </h4>
	  </div>
		<div class="modal-body">
	<table>
	
		 
		<?php if(!empty($download['download_doc'])){ ?>
		<?php echo form_open_multipart('/pestcontrol/download', array('id' => 'multiformupload')); ?>
			<tr>
			<td><input type="hidden" name="docu" value="<?php echo $download['download_doc']; ?>" readyonly />
			
		<input type="submit" name="download_motorplan" id="download_motorplan"  class="btn3 trans_eff radius-3" value="DOWNLOAD DOC 1" />&nbsp;&nbsp;</td>
		 <?php echo form_close(); ?>
		 <?php }else{ ?>
		 <tr>
			<td>
		<input type="button" name="download_motorplan" id="download_motorplan"  class="btn3 trans_eff radius-3" value="No Document uploaded" />&nbsp;&nbsp;</td>
		 
		 <?php } ?>
		
			 </tr>
		
	</table>		
  
   </div>
  </div> 
  </div>
  </div>
  <?php } ?>
  <!-- DOWNLOAD FANCY BOX CLOSE -->
  
  
  <!-- SAVE FANCY BOX -->
  <?php  foreach($pestcontrol_vendor_details as $key => $details){ /* print_r($details); */ ?>
  <div id="myModalsave<?php echo $key; ?>" class="modal fade" role="dialog" >
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> SAVE NOW </h4>
	  </div>
		<div class="modal-body">
		  
   <?php echo form_open_multipart('/pestcontrol/save_pestcontrol', array('id' => 'multiformupload')); ?> 
   <table>
	   <tr>
			<td>
			 
				<input type="hidden" name="v_id" value="<?php echo $key; ?>" readyonly />
				<input type="hidden" name="type_of_service" value="<?php echo $details['type_of_service']; ?>" readyonly />
				<input type="hidden" name="type_of_premises" value="<?php echo $details['type_of_premises']; ?>" readyonly />
				<input type="hidden" name="kind_of_premises" value="<?php echo $details['kind_of_premises']; ?>" readyonly />
				<input type="hidden" name="approx_area" value="<?php echo $details['approx_area']; ?>" readyonly />
				<input type="hidden" name="booking_date" value="<?php echo $details['book_date']; ?>" readyonly />
				<input type="hidden" name="id" value="<?php echo $details['id']; ?>" readyonly />
			
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