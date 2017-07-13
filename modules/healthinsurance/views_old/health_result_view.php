<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>

<title> HEALTH INSURANCE </title>
<style>
body{background-color:#efeff4 none repeat scroll 0 0 !important;}
.shad{background: #f5ffff none repeat scroll 0 0; border: 3px solid #e0edfa;  border-radius: 13px; width:800px; margin:0 auto;}
.shad:hover {box-shadow:1px 1px 1px 1px #e8e8e8;}.premium_val{ font-size:55px; color:skyblue;}
.currency{font-weight:bold;font-size:25px;}
.co_name{font-size:25px;}
.cc { border:3px solid #d5d5d5; margin-top:20px;}
</style>
<div class="container">

<div class="p15 radius-3 white cc">
	<h1 class="fs24 black"><span> Result </span></h1>
</div>
</br>

  <?php //echo '<pre>'; print_r($show_post_data); ?>
  
  <!-- SHOW VENDOR DETAILS INFORMATION ON POPUP table-bordered -->
  
  <?php if(!empty($show_post_data)){ ?>
  <?php foreach($show_post_data as $vendor_info){ $vendor_id = $vendor_info['vendor_id']; $arr[] = array('vendor_id' => $vendor_id); ?>
  <div class="shad">
	<table class="table">
	 <thead class="thead-default">
		<tr>
			<th>PREMIUM TOTAL</th>
			<th>COMPANY NAME</th>
			<th>VENDOR PLAN</th>
			<th>VENDOR COUNTRY</th>
		</tr>
     </thead>
    <tbody>
		 <tr>
			<?php $tot = 0; foreach($total[$vendor_info['vendor_id']] as $tt){ $tot += $tt; ?>
			<?php } ?>
			<td id="total<?php echo $vendor_info['vendor_id']; ?>"><span class="currency">AED</span><span class="premium_val"> <?php echo $tot; ?> <span></td>
			<td id="company_name<?php echo $vendor_info['vendor_id']; ?>"><span class="co_name"><?php echo strtoupper($vendor_info['company_name']); ?></span></td>
			<td id="vendor_plan_id<?php echo $vendor_info['vendor_id']; ?>"><span class="co_name"><?php echo $vendor_info['vendor_plan_id']; ?> </span></td>
			<td id="vendor_country_id<?php echo $vendor_info['vendor_id']; ?>"><span class="co_name"><?php echo $vendor_info['vendor_country_id']; ?></span></td>
		 </tr>
		 
		 <tr>
			<td>
			
			 <?php echo form_open('/healthinsurance/download');  ?><input type="hidden"  name="file_download" value="<?php echo $vendor_plan_doc[$vendor_info['vendor_id']][0]; ?>" />
			 <input name="submit_book" value="DOWNLOAD" class="btn btn-info btn-sm" type="submit">
			 </td>
			<?php echo form_close(); ?>
			
			 <td><a data-toggle="modal" data-target="#myModal<?php echo $vendor_info['vendor_id']; ?>" id="<?php echo $vendor_info['vendor_id']; ?>" class="btn btn-warning btn-sm hd" title="Vendor Customers INFO">Details</a></td>
			 <!-- data-toggle="modal" data-target="#myModal1" class="btn btn-primary btn-sm save" -->
			 <td><a  title="SAVE INFO" data-toggle="modal" data-target="#myModal1" class="btn btn-primary btn-sm save" id="<?php echo $vendor_info['vendor_id']; ?>">Save Plan</a>
			 </td>
			 
			 <td><a class="btn btn-success btn-sm BOOK" data-toggle="modal" data-target="#myModal" title="USER DOCUMENTS" id="<?php echo $vendor_info['vendor_id']; ?>">Book Plan</a></td>
		 
		 </tr>
		</tbody> 
			
	</table>
	</div>
	</br>
	<?php } ?>
	
	<!-- SHOW CUSTOMERS INFORMATION ON POPUP -->
	
		<?php foreach($arr as $vid){  ?>
		<div id="myModal<?php echo $vid['vendor_id']; ?>" class="modal fade" role="dialog" >
		  <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"> Customer Information </h4>
			  </div>
				<table class="table"  >
					<?php if(!empty($user_value[$vid['vendor_id']])){ ?>
					  <tr id="<?php echo $vid['vendor_id']; ?>">
						<th>NAME</th>
						<th>AGE</th>
						<th>GENDER</th>
						<th>PREMIUM VALUE</th>
					  </tr>
					 <?php foreach($user_value[$vid['vendor_id']] as $user_info){ ?>
					 <tr>
						<td><?php echo $user_info['user_name']; ?></td>
						<td><?php echo $user_info['age']; ?> </td>
						<td><?php echo $user_info['gender']; ?></td>
						<td><?php echo $user_info['Premium_value']; ?></td>
					 </tr>
					<?php } ?>
					<?php } ?>
				</table>
				</div>
			</div>
		</div>
		<?php } ?>
	
	
	<?php }else{ ?>
	 <table class="table">
		  <tr>
			<th>NO DATA FOUND ##</th>
		  </tr>
	 </table>
   <?php } ?>

   
   
   
	<script src="<?php echo base_url(); ?>assets/designer/resources/fancybox/jquery.fancybox.js"> </script>  
  <script>
	$('document').ready(function(){
			
		$(".various").fancybox({
				maxWidth	: 500,
				maxHeight	: 600,
				fitToView	: false,
				width		: '70%',
				height		: '70%',
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'
		});
	
	$('.BOOK').click(function(){
		
		var id = $(this).attr('id');
		
		$('input[name=vendor_id1]').val(id);
		
	});
	
	$('.save').click(function(){
		
		var id = $(this).attr('id');
		
		$('input[name=vendor_id]').val(id);
		
	});
	
	});
  
  </script>
  
 
  <!-- SAVE FANCY BOX -->
  <?php //echo '<pre>'; print_r($_SESSION['save_p_data']); exit;  ?>
  
  
  <div id="myModal1" class="modal fade" role="dialog" >
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> Are You Sure want to SAVE </h4>
	  </div>
	  <div class="modal-body">
		<?php echo form_open_multipart('/healthinsurance/save', array('id' => 'multiformupload')); ?> 
		<table>
			 <tr><td><input type="hidden" name="country_id" value="<?php echo $_SESSION['save_p_country_id']; ?>" id="country_id" readyonly />
			 <input type="hidden" name="plan_id" id="plan_id" value="<?php echo $_SESSION['save_p_plan_id']; ?>" readyonly />
			 <input type="hidden" name="vendor_id" id="vendor_id" readyonly />
			<input type="submit" name="save_plan_files" id="save_plan_files"  class="btn3 trans_eff radius-3" value="YES" />&nbsp;&nbsp;<input type="button"  class="btn3 trans_eff radius-3" data-dismiss="modal" value="NO" /></td></tr>
		</table>
		<?php echo form_close(); ?>
	   </div>
  </div> 
  </div>
  </div>
  
  
  <div id="inlinesave" style="width:600px;display: none;" >
   
  </div>
  
  
  <!-- BOOK FANCY BOX -->
  <div id="myModal" class="modal fade" role="dialog" >
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"> BOOK NOW </h4>
	  </div>
		<div class="modal-body">
		  
   <?php echo form_open_multipart('/healthinsurance/book_health_service', array('id' => 'multiformupload')); ?> 
   <table class="table">
	    <tr>
			<td><label>PASSPORT  <input type="file" class="form-control" name="file1" /></label> </td>
			<td><label>MULKIYA   <input type="file" class="form-control"name="file2" /></label> </td>
			<td><label>EMIRATES ID <input type="file" class="form-control" name="file3" /></label></td>
		</tr>	
		<tr>
			<td>
				<input type="hidden" name="vendor_plan_id1" value="<?php echo $_SESSION['save_p_plan_id']; ?>"  readyonly />
				<input type="hidden" name="vendor_country_id1" value="<?php echo $_SESSION['save_p_country_id']; ?>" readyonly />
				<input type="hidden" name="vendor_id1" id="vendor_id1" readyonly />
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
  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script>
		var $j = jQuery.noConflict();
	</script>
</div>
<?php $this->load->view("bottom_application");?>