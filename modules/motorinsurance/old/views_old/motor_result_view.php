<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>
<title> MOTOR INSURANCE </title>
<style type="text/css">
body{background-color:#efeff4 none repeat scroll 0 0 !important;}
.shad{background: #f5ffff none repeat scroll 0 0; border: 3px solid #e0edfa;  border-radius: 13px; width:800px; margin:0 auto;}
.shad:hover {box-shadow:1px 1px 1px 1px #e8e8e8;}.premium_val{ font-size:55px; color:skyblue;}
.currency{font-weight:bold;font-size:25px;}
.co_name{font-size:25px;}
.cc { border:3px solid #d5d5d5; margin-top:20px;padding:15px;}
.benefits{margin:10px; font-size:15px;font-weight:bold;margin: 0 auto;}
</style>

<div class="w90 auto mt30">

	<div class="p15 radius-3 white">
		<h1 class="fs24 black cc"><span> Result </span></h1>
    </div>
  <div class="cb mb15"></div>
  
  <?php foreach($motor_vendor_details as $key => $details){ ?>
		<?php if($details['company_name']){ ?>
	<div style="margin:0 auto;text-align:center;" class="shad"> 
	<table class="table">
	<thead class="thead-default">
		<tr>
			<th>COMPANY NAME</th>
			<th>VEHICLE TYPE</th>
			<th>PREMIUM TOTAL</th>
		</tr>
	</thead>	
	<tbody>
		<tr>
			<td ><span class="co_name"><?php echo strtoupper($details['company_name']); ?></span></td>
			<td ><span class="co_name"><?php echo strtoupper($details['vehicle_type']); ?></span></td>
			<td ><span class="currency">AED </span><span class="premium_val"><?php echo $details['total']; ?></span></td>
		</tr>
		<tr>
		<td> <a class="btn btn-success btn-sm BOOK" data-toggle="modal" data-target="#myModalbook" title="USER DOCUMENTS" id="<?php echo $key; ?>">BOOK PLAN</a> </td>
			
		<td><a class="btn btn-success btn-sm save" data-toggle="modal" data-target="#myModalsave" id="<?php echo $key; ?>">SAVE</a> </td>
			
		<td>
		<input type="hidden" name="v_id" value="<?php echo $key; ?>" />
			<a class="btn btn-success btn-sm download" data-toggle="modal" data-target="#myModaldownload" id="<?php echo $key; ?>">DOWNLOAD</a> 
		</td>
		</tr>
		<tr>
		<td colspan="4"><?php foreach($details['summary_benefits'] as $sm){ ?>
				<?php if(!empty($sm)){ ?><span class="benefits glyphicon glyphicon-ok"><?php echo strtoupper($sm);  ?>&nbsp; </span> <?php } ?>
		<?php } ?></td>
		</tr>
		
	</tbody>	
	</table>
	<div class="cb mb15"></div>
		
	</div>
	</br>
	<?php } ?>
	<?php } ?>
	
</div>


  <!-- BOOK FANCY BOX -->
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
		</tr>	
		<tr>
			<td>
			<?php foreach($motor_vendor_details as $details){ ?> 
			<?php foreach($details['post_val'] as $key => $pst){ ?> 
				<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $pst; ?>" readyonly />
			<?php } ?>	
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
	    <tr><td><input type="hidden" name="docu" value="<?php echo $dwn['vendor_doc1']; ?>" id="v_id2" readyonly />
			
		<input type="submit" name="download_motorplan" id="download_motorplan"  class="btn3 trans_eff radius-3" value="DOWNLOAD DOC 1" />&nbsp;&nbsp;</td>
		 <?php echo form_close(); ?>
		 <?php } ?>
		 
		 <?php if(!empty($dwn['vendor_doc2'])){ ?>
		 <?php echo form_open_multipart('/motorinsurance/download', array('id' => 'multiformupload')); ?>
			
			<td>	<input type="hidden" name="docu" value="<?php echo $dwn['vendor_doc2']; ?>" id="v_id2" readyonly />
				<input type="hidden" name="v_id" value="<?php echo $key; ?>" id="v_id2" readyonly />
			
			<input type="submit" name="download_plan" id="download_motorplan"  class="btn3 trans_eff radius-3" value="DOWNLOAD DOC 2" />&nbsp;&nbsp;</td></tr>
		 <?php echo form_close(); ?>
		 <?php } ?>
		 
		<?php } ?>
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
				<input type="hidden" name="v_id" id="v_id3" readyonly />
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
  
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script>
		var $j = jQuery.noConflict();
	</script>
<script>
	$(document).ready(function(){
		$('.BOOK').click(function(){
			var id = $(this).attr('id');
			var rr = $('#v_id1').val(id);
		});
				
		$('.save').click(function(){
			var id = $(this).attr('id');
			$('#v_id3').val(id); 
			
		});
				
	});
</script>
	
<?php $this->load->view("bottom_application");?>