<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>

<title> HEALTH INSURANCE </title>

<div class="container">

<div class="p15 radius-3 white cc">
	<h1 class="fs24 black"><span> Result </span></h1>
</div>
</br>

  <?php //echo '<pre>'; print_r($show_post_data); ?>
  
  <!-- SHOW VENDOR DETAILS INFORMATION ON POPUP table-bordered -->
  
  		<?php if(!empty($show_post_data)){ ?>
		  <?php foreach($show_post_data as $vendor_info){ $vendor_id = $vendor_info['vendor_id']; $arr[] = array('vendor_id' => $vendor_id); ?>
		  <?php $tot = 0; foreach($total[$vendor_info['vendor_id']] as $tt){ $tot += $tt; ?>
			<?php } ?>
						<div class="bs-calltoaction bs-calltoaction-default">
							<div class="row">
								<div class="col-lg-3 col-sm-12 col-md-3 col-xs-12 cta-contents">
										<a href="#"><img src="<?php echo base_url(); ?>assets/newasset/image/comapny_sumit.jpg" class="img-responsive border-shadow"/></a>
										<span class="company_name" id="company_name<?php echo $vendor_info['vendor_id']; ?>"><?php echo strtoupper($vendor_info['company_name']); ?></span>
								</div>
								<div class="col-lg-4 col-sm-12 col-md-4 col-xs-12 cta-contents result_shown">
									<div class="cta-desc">
										<div class="span_div">
											<span>Premium Total :</span>
										</div>
										<div class="label_div" id="total<?php echo $vendor_info['vendor_id']; ?>" >
											<label>AED <?php echo $tot; ?></label>
										</div>
									</div>
									<div class="cta-desc">
										<div class="span_div">
											<span>vender Plan :</span>
										</div>
										<div class="label_div" id="vendor_plan_id<?php echo $vendor_info['vendor_id']; ?>">
											<label><?php echo $vendor_info['vendor_plan_id']; ?></label>
										</div>
									</div>
									<div class="cta-desc">
										<div class="span_div">
											<span>vender Country :</span>
										</div>
										<div class="label_div" id="vendor_country_id<?php echo $vendor_info['vendor_id']; ?>">
											<label><?php echo $vendor_info['vendor_country_id']; ?></label>
										</div>
									</div>
								</div>
								<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 cta-contents">
									<div class="button-position-color">
									<?php echo form_open('/healthinsurance/download','style="display: inline;"');  ?>
									    <input type="hidden"  name="file_download" value="<?php echo $vendor_plan_doc[$vendor_info['vendor_id']][0]; ?>" />
										<button type="submit" class="btn-width btn btn-info">
										  <span class="ion-chevron-down"></span> Download
										</button>
									<?php echo form_close(); ?>	
									
										<button type="button" class="btn-width btn btn-warning hd" data-toggle="modal" data-target="#myModal<?php echo $vendor_info['vendor_id']; ?>" id="<?php echo $vendor_info['vendor_id']; ?>">
										  <span class="ion-clipboard"></span> Details
										</button>
										<?php $user_info = $this->session->all_userdata();$user_id = $user_info['user_id'];if($user_id == ''){ ?>
										<button type="button" class="btn-width btn btn-primary save" data-toggle="modal" title="Login" data-target="#loginModal">
										  <span class="ion-locked"></span> Save Plan
										</button>
										<button type="button" class="btn-width btn btn-success BOOK" data-toggle="modal" title="Login" data-target="#loginModal">
										  <span class="ion-checkmark-round"></span> Book Plan
										</button>
										<?php }else{ ?>
										<button type="button" class="btn-width btn btn-primary save" data-toggle="modal" data-target="#myModal1" id="<?php echo $vendor_info['vendor_id']; ?>">
										  <span class="ion-locked"></span> Save Plan
										</button>
										<button type="button" class="btn-width btn btn-success BOOK" data-toggle="modal" data-target="#myModal" title="USER DOCUMENTS" id="<?php echo $vendor_info['vendor_id']; ?>">
										  <span class="ion-checkmark-round"></span> Book Plan
										</button>
										<?php } ?>
									</div>
								</div>
							</div>
					</div>
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
					<tr>
						<td></td>
						<td>AddOn</td>
						<?php foreach($addOns[$vendor_info['vendor_id']] as $key => $addosn){?>
						<td><?php echo strtoupper($key);  ?></td>
						<td><?php echo $addosn;	  ?></td>
						<?php } ?>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td>Total</td>
						<td><?php echo $tot; ?></td>
					</tr>
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
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<input type="hidden" name="country_id" value="<?php echo $_SESSION['save_p_country_id']; ?>" id="country_id" readyonly />
				<input type="hidden" name="plan_id" id="plan_id" value="<?php echo $_SESSION['save_p_plan_id']; ?>" readyonly />
				<input type="hidden" name="vendor_id" id="vendor_id" readyonly />
				<input type="submit" name="save_plan_files" id="save_plan_files"  class="btn3 btn btn-primary radius-3" value="YES" style="float:left;"/>
				<input type="button"  class="btn3 trans_eff radius-3" data-dismiss="modal" value="NO" style="float:right;"/>
			</div>
		</div>
		<?php echo form_close(); ?>
	   </div>
  </div> 
  </div>
  </div>
  
  
  <div id="inlinesave" style="display: none;" >
   
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
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<label>PASSPORT</label>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<input type="file" class="form-control" name="file1" />
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<label>MULKIYA</label>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<input type="file" class="form-control"name="file2" />
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<label>EMIRATES ID</label>
			</div>
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<input type="file" class="form-control" name="file3" />
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<input type="hidden" name="benefits" value="<?php echo $_SESSION['save_p_benefits']; ?>"  readyonly />
				<input type="hidden" name="vendor_plan_id1" value="<?php echo $_SESSION['save_p_plan_id']; ?>"  readyonly />
				<input type="hidden" name="vendor_country_id1" value="<?php echo $_SESSION['save_p_country_id']; ?>" readyonly />
				<input type="hidden" name="vendor_id1" id="vendor_id1" readyonly />
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center">
				<input type="submit" name="submit_user_files" id="submit_user_files"  class="btn3 trans_eff radius-3" value="BOOK NOW" />
			</div>
		</div>
   <?php echo form_close(); ?>
   </div>
   
  </div> 
  
  </div>
  </div>
  
</div>
<?php $this->load->view("bottom_application");?>