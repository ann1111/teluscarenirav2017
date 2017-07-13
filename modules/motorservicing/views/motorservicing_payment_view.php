<?php $this->load->view("top_application");?>
<?php $this->load->view('project_header'); ?>
<title> MOTOR INSURANCE </title>
<?php echo form_open('/motorinsurance/book_view'); ?> 

<?php foreach($status as $message){  echo $message; }  ?>
<div class="w90 auto mt30">
	<p class="fr mt1"><a href="/" class="btn1 radius-20t" title="?Go Back">Go Back</a> </p>
<div class="container-fluid">
	
			<div class="container">
				<div class="row">
					<div class="col-md-offset-2 col-md-8 text-center">
						<h2 style="color:#000;">Select Payment Method </h2>
						<hr class="primary">
					</div>
				</div>
				<div class="row well-thank">
					<div class="col-md-offset-3 col-md-6">
						   <form class="form-horizontal">
								<!-- <div class="form-group">
								  <label class="control-label col-sm-2" for="pwd">Password:</label>
								  <div class="col-sm-10">          
									<input type="password" class="form-control" id="pwd" placeholder="Enter password">
								  </div>
								</div> -->
								<div class="row">
									<div class="col-lg-3">
										<div class="form-group-payment">
											<label class="radio-inline">
												<input type="radio" name="make_payment">Net Banking
											</label>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group-payment">        
											<label class="radio-inline">
												<input type="radio" name="make_payment">Debit Card
											</label>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group-payment">
											<label class="radio-inline">
												<input type="radio" name="make_payment">Credit Card
											</label>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="form-group-payment">        
											<label class="radio-inline">
												<input type="radio" name="make_payment">PayPal
											</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-offset-4 col-md-4">
										<div class="form-group-payment">        
										  <button type="submit" class="btn btn-lg btn-success" style="border-radius:0;">Submit</button>
										</div>
									</div>
								</div>
						  </form>
					</div>
				</div>
			</div>
		</div>

</div>

<?php echo form_close(); ?>

<?php $this->load->view("bottom_application");?>