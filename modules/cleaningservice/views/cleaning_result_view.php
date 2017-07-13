<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>
<title> Cleaning Services </title>


<div class="container">

	<div class="p15 radius-3 white">
		<h1 class="fs24 black cc"><span> Result </span></h1>
    </div>
 
	<?php //echo '<pre>'; print_r($cleaning_calculation);  exit;  ?>
	<?php foreach($cleaning_calculation as $key => $details){ //print_r($details['exclude_motors']); ?>
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
											<span>Emirate :</span>
										</div>
										<div class="label_div" id="total<?php echo $key; ?>" >
											<label><?php echo strtoupper(get_cleaner_city_name($details['city'])); ?></label>
										</div>
									</div>
									<div class="cta-desc">
										<div class="span_div">
											<span>Premium Total :</span>
										</div>
										<div class="label_div" id="total<?php echo $key; ?>" >
											<label>AED <?php echo $details['total']; ?></label>
										</div>
									</div>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 cta-contents">
									<div class="button-position-color">
								<?php echo form_open('/cleaningservice/download','style="display: inline;"');  ?>
									<input type="hidden"  name="file_download" value="<?php echo $details['vendor_doc']; ?>" />
									   <button type="submit" class="btn-width btn btn-info btn-sm download">
										  <span class="ion-chevron-down"></span> Download
										</button>
									<?php echo form_close(); ?>
									
										<button type="button" class="btn-width btn btn-warning btn-sm" data-toggle="modal" data-target="#<?php echo $key; ?>myModaldetails" id="<?php echo $key; ?>">
										  <span class="ion-clipboard"></span> Details
										</button>
										<?php $user_info = $this->session->all_userdata();$user_id = $user_info['user_id'];if($user_id == ''){ ?>
											<button type="button" class="btn-width btn btn-primary btn-sm" data-toggle="modal" title="Login" data-target="#loginModal">
											  <span class="ion-locked"></span> Save Plan
											</button>
											<button type="button" class="btn-width btn btn-success btn-sm" data-toggle="modal" title="Login" data-target="#loginModal">
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
	
	
	<?php foreach($detail_information as $mykey => $details){ $tot = 0; ?>
	
	  <div id="<?php echo $mykey; ?>myModaldetails" class="modal fade" role="dialog" >
	  <div class="modal-dialog">
	  <div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"> Cleaning Details </h4>
		  </div>
			<div class="modal-body">
			 <table class="table">
			  <tbody>
					<tr><h2> <?php //echo $details; ?> </h2></tr>
					<tr>
						<th><?php echo strtoupper($details['company_name']); ?></th>
					</tr>
					<tr>
						<td>EMIRATE</td>  
						<td><?php echo strtoupper(get_cleaner_city_name($details['city'])); ?></td>  
					</tr>
					<tr>
						<td>MATERIAL</td>  
						<td><?php $material = $details['material']==1 ? 'YES' : 'NO'; echo $material;?></td>  
					</tr>
					<tr>
						<td>MATERIAL COST</td>  
						<td><?php echo $details['material_cost']; ?></td>  
					</tr>
					<tr>
						<td>NUM OF CLEANERS</td>  
						<td><?php echo get_number_of_cleaners($details['noofcleaners']); ?></td>  
					</tr>
					<tr>
						<td>PREMISES TYPE</td>  
						<td><?php echo get_type_of_premise($details['premises']); ?></td>  
					</tr>
					<tr>
						<td>DISCOUNT</td>  
						<td><?php echo $details['discount_charge']; ?></td>  
					</tr>
					<tr>
						<td>DISCOUNT CHARGE MIN HOUR</td>  
						<td><?php echo $details['discount_min_hour']; ?></td>  
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
  
  <?php foreach($detail_information as $key => $details){  ?> 
  
  <div id="myModalbook" class="modal fade" role="dialog" >
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> BOOK NOW </h4>
	  </div>
		<div class="modal-body">
		<?php echo form_open_multipart('/cleaningservice/book_cleaning_service', array('id' => 'multiformupload')); ?>
	   <table class="table">
			<tr>
				<td><label>PASSPORT  <input type="file" class="form-control" name="file1" /></label> </td>
				<td><label>MULKIYA   <input type="file" class="form-control"name="file2" /></label> </td>
				<td><label>EMIRATES ID <input type="file" class="form-control" name="file3" /></label></td>
				<td><?php foreach($details as $newkey => $pst){  ?>			
				<input type="hidden" name="<?php echo $newkey; ?>" value="<?php echo $pst; ?>" readyonly />
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
	<?php foreach($cleaning_calculation as $key => $download){ 
		  foreach($download['downloadable_data'] as $dwn){ 
		 
			if(!empty($dwn['vendor_doc1'])){ ?>
		<?php echo form_open_multipart('/motorinsurance/download', array('id' => 'multiformupload')); ?>
	    <tr><td><input type="hidden" name="docu" value="<?php echo $dwn['vendor_doc1']; ?>" readyonly />
			
		<input type="submit" name="download_motorplan" id="download_motorplan"  class="btn3 trans_eff radius-3" value="DOWNLOAD DOC 1" />&nbsp;&nbsp;</td>
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
  <?php foreach($detail_information as $key => $details){  ?> 
   <?php echo form_open_multipart('/cleaningservice/save_cleaning_service', array('id' => 'multiformupload')); ?>
	  <div id="myModalsave" class="modal fade" role="dialog" >
	  <div class="modal-dialog">
	  <div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"> SAVE NOW </h4>
		  </div>
			<div class="modal-body">
			  
			   <table>
					<tr>
						<td><?php foreach($details as $newkey => $pst){  ?>			
							<input type="hidden" name="<?php echo $newkey; ?>" value="<?php echo $pst; ?>" readyonly />
							<?php } ?>	
							<input type="hidden" name="v_id" value="" id="v_id2" readyonly />
						</td>
					</tr>
					<tr>
						<td><input type="submit" name="save_motorplan" id="save_motorplan"  class="btn3 trans_eff radius-3" value="YES" />&nbsp;&nbsp;<input type="button"  class="btn3 trans_eff radius-3" data-dismiss="modal" value="NO" /></td>
					</tr>		
				</table>		
			  
			</div>
	  </div> 
	  </div>
	  </div>
   <?php echo form_close(); ?>
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