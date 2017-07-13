<?php 

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

  if (strpos($url,'vendors') === false) {
    
?>
	<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body" style="padding:0;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-login" style="margin-bottom:0;">
								<div class="panel-heading">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<a href="#" class="active" id="login-form-link">CONSUMER</a>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<a href="#" id="register-form-link">SBP</a>
										</div>
									</div>
									<hr>
								</div>
								<div class="panel-body">
									<div class="row">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<form id="login-form" data-toggle="validator" class="login-input-style login-formc" action="<?php echo base_url(); ?>users/login" method="post" role="form" style="display: block;">
													<div class="form-group">
														<input type="email" name="login_username" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
														<div class="help-block with-errors"></div>
													</div>
													<div class="form-group">
														<input type="password" name="login_password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
														<div class="help-block with-errors"></div>
													</div>
													<div class="form-group text-center">
														<input name="login_usertype" value="1" class="login_usertype" type="hidden">
														<input name="action" value="Y" type="hidden">
														<label for="remember"><input type="checkbox" tabindex="3" class="" name="remember" id="remember"> Remember Me</label>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-6 col-sm-offset-3">
																<input type="submit" name="btn_sbt" id="login-submit1" tabindex="4" class="form-control btn btn-login" value="Login">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-lg-12">
																<div class="text-center">
																	<a href="<?php echo base_url(); ?>users/forgotten_password" tabindex="5" class="forgot-password">Forgot Password?</a>
																</div>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-6 col-sm-offset-3">
																<input data-toggle="modal" href="#consumert-account" type="button"  name="btn_sbt" id="login-submit" tabindex="4" class="form-control btn btn-login cr" value="Create Account">
															</div>
														</div>
													</div>
												</form>
												<form id="register-form" data-toggle="validator" class="login-input-style login-formsbp" action="<?php echo base_url(); ?>users/login" method="post" role="form" style="display: none;">
													<div class="form-group">
														<input type="email" name="login_username" id="email" tabindex="1" class="form-control" placeholder="Email" value="" required>
														<div class="help-block with-errors"></div>
													</div>
													<div class="form-group">
														<input type="password" name="login_password" id="password" tabindex="2" class="form-control" placeholder="Password" value="" required>
														<div class="help-block with-errors"></div>
													</div>
													<div class="form-group">
														<input type="text" name="login_user_no" id="user_no" tabindex="1" class="form-control" placeholder="User No" value="" required>
														<div class="help-block with-errors"></div>
													</div>
													<div class="form-group text-center">
														<input name="login_usertype" value="2" class="login_usertype" type="hidden">
														<input name="action" value="Y" type="hidden">
														<label for="remember"><input tabindex="3" class="" name="remember" id="remember" type="checkbox"> Remember Me</label>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-6 col-sm-offset-3">
																<input type="submit" name="btn_sbt" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Login">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-lg-12">
																<div class="text-center">
																	<a href="<?php echo base_url(); ?>users/forgotten_password" tabindex="5" class="forgot-password">Forgot Password?</a>
																</div>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-6 col-sm-offset-3">
																<input  data-toggle="modal" href="#sbp-account" type="button"  name="btn_sbt" id="login-submit" tabindex="4" class="form-control btn btn-login sbtr" value="Create Account">
															</div>
														</div>
													</div>
												</form>
											</div>
									</div>
									<button class="btn btn-primary btn-lg center-block" style="background-color:#000;border:none;padding:0 8px;" data-dismiss="modal" aria-hidden="true"><i class="ion-android-close"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
	
	<div id="consumert-account" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog-full" style="z-index: 1050 !important;">
			<div class="modal-content">
				<div class="modal-body" style="padding:0;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-login">
								<div class="panel-body">
									<div class="row">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<form id="login-form" data-toggle="validator" class="customer_reg" action="<?php echo base_url(); ?>users/register" method="post" role="form" style="display: block;">
													<button class="btn btn-primary btn-lg center-block" style="background-color:#000;margin-right:0;border:none;padding:0 8px;" data-dismiss="modal" aria-hidden="true"><i class="ion-android-close"></i></button>
													<h3>Login Information :</h3>
													<div class="row">
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Email ID</label>
																<input type="email" name="user_name" id="email" tabindex="1" class="form-control" placeholder="Email" value="" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Password</label>
																<input type="password" name="password" id="password1" tabindex="2" class="form-control" placeholder="Password" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Confirm Password</label>
																<input type="password" name="confirm_password" id="confirm_password" tabindex="2" class="form-control" data-match="#password1" data-match-error="Whoops, these don't match" required placeholder="Confirm Password" >
																<div class="help-block with-errors"></div>
															</div>
														</div>
													</div>
													<h3>Personal Information :</h3>
													<div class="row">
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Name</label>
																<input type="text" name="first_name" id="name" tabindex="1" class="form-control" placeholder="Name" value="" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group input-group">
																<label>Date Of Birth</label>
																<div class="input-group input-append date" id="dateRangePicker">
																<input type="text" class="form-control" name="birth_date" placeholder="Date of Birth" required/>
																<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar" ></span></span>
															</div>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Mobile No</label>
																<input type="text" name="mobile_number" id="mobile" tabindex="2" class="form-control" placeholder="Mobile No" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
													</div>
													<div class="row">	
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Landline No</label>
																<input type="text" name="phone_number" id="Landline" tabindex="2" class="form-control" placeholder="Landline No">

															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Fax No</label>
																<input type="text" name="fax_number" id="fax_number" tabindex="2" class="form-control" placeholder="Fax No">
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Address</label>
																<textarea id="address" name="address" class="form-control" rows="2" placeholder="Your Address here.." required></textarea>
																<div class="help-block with-errors"></div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Country</label>
																<select class="form-control" id="country" name="country" >
																	<option value="UAE" selected="selected">UAE</option>
																	
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>State</label>
																<input type="text" name="state" id="state" tabindex="2" class="form-control" placeholder="State" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>City</label>
																<input type="text" name="city" id="city" tabindex="2" class="form-control" placeholder="City" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
													</div>
													<div class="row">	
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>PO Box</label>
																<input type="text" name="zipcode" id="pincode" tabindex="2" class="form-control" placeholder="PO Box" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<!--<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
															<input type="text" name="recaptcha" required value="" id="recaptchaValidator1" style="visibility: hidden">	
															 <div class="g-recaptcha" data-sitekey="6LexbxIUAAAAANHaeY7ZY_5c1kgbeMvFEWW9zkrX"></div>
															  <div class="help-block with-errors"></div>
															</div>
														</div>-->
														<div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
															<div class="form-group">
																<input type="hidden">
															</div>
														</div>
													</div>
													<div class="row">	
														<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
														<div class="form-group text-center">
															<input type="checkbox" tabindex="3" class="" name="terms" id="remember" value="Y" required>
																<span class="termscond">I have read, understood and agree to the<br></span>
																<span class="termscond"><a href="<?php echo base_url(); ?>pages/infopages/team_condition" target="_blank" title="Terms &amp; Conditions">Terms &amp; Conditions </a>of <b>TelUs Care.</b></span>
														</div>
														</div>
													</div>
													
													<div class="form-group">
														<div class="row">
															<div class="col-sm-4 col-sm-offset-4">
																<input type="submit" name="register_me" tabindex="4" class="form-control btn btn-login" value="Register Now!" required>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-4 col-sm-offset-4">
																<input type="reset" name="reset" tabindex="4" class="form-control btn btn-login" value="Reset">
															</div>
														</div>
													</div>
												</form>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	<script>function captcha_onclick() {$('#recaptchaValidator1').val(1).trigger('input');}</script>
	
	<div id="sbp-account" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog-full" style="z-index: 1050 !important;">
			<div class="modal-content">
				<div class="modal-body" style="padding:0;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-login" >
								<div class="panel-body">
									<div class="row">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<form id="login-form" data-toggle="validator" class="sbp_reg" action="<?php echo base_url(); ?>users/vendor_register" method="post" role="form" style="display: block;">
													<button class="btn btn-primary btn-lg center-block" style="background-color:#000;margin-right:0;border:none;padding:0 8px;" data-dismiss="modal" aria-hidden="true"><i class="ion-android-close"></i></button>
													<h3>Login Information :</h3>
													<div class="row">
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
															<label>Email ID</label>
																<input type="email" name="user_name" id="email" tabindex="1" class="form-control" placeholder="Email" value="" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
															<label>Password</label>
																<input type="password" name="password" id="password2" tabindex="2" class="form-control" placeholder="Password" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
															<label>Confirm Password</label>
																<input type="password" name="confirm_password" id="confirm_password" tabindex="2" class="form-control" data-match="#password2" placeholder="Confirm Password" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
													</div>
													
												<h3>Other Information :</h3>
												<div class="row">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
														<div class="form-group" style="text-align:center;">
															<label>Your Identity  </label>
															<label class="radio-inline">
															  <input type="radio" value="1" name="vendor_type" required> Individual  
															</label>
															<label class="radio-inline">
															  <input type="radio" value="2" name="vendor_type" required> Corporate/SME
															</label>
															<div class="help-block with-errors"></div>
														</div>
													</div>
												</div>	
												<div class="row">
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
														<label>Company Name</label>
															<input type="text" name="company_name" id="company_name" tabindex="1" class="form-control" placeholder="Name" value="" required>
															<div class="help-block with-errors"></div>
														</div>
													</div>
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
															<label>Contact Name</label>
															<input type="text" name="first_name" id="contact_name" tabindex="2" class="form-control" placeholder="Contact Name" required>
															<div class="help-block with-errors"></div>
														</div>
													</div>
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
														<label>Date Of Birth</label>
															<div class="input-group input-append date" id="dateRangePicker0">
																<input type="text" class="form-control" name="birth_date" placeholder="Date of Birth" required/>
																<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar" ></span></span>
															</div>
															<div class="help-block with-errors"></div>
														</div>
													</div>

													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
															<label>Mobile No</label>
															<input type="text" name="mobile_number" id="mobile" tabindex="2" class="form-control" placeholder="Mobile No" required>
															<div class="help-block with-errors"></div>
														</div>
													</div>
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
															<label>Landline No</label>
															<input type="text" name="phone_number" id="Landline" tabindex="2" class="form-control" placeholder="Landline No">
														</div>
													</div>
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
															<label>Fax No</label>
															<input type="text" name="fax_number" id="fax_number" tabindex="2" class="form-control" placeholder="Fax No">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
															<label>Country</label>
															<select class="form-control" id="country" name="country" >
																<option value="UAE" selected="selected">UAE</option>
																<!--<option value="Afghanistan">Afghanistan</option>
																<option value="Albania">Albania</option>-->
															</select>
															<div class="help-block with-errors"></div>
														</div>
													</div>
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
															<label>State</label>
															<input type="text" name="state" id="state" tabindex="2" class="form-control" placeholder="State" required>
															<div class="help-block with-errors"></div>
														</div>
													</div>
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>City</label>
																<input type="text" name="city" id="city" tabindex="2" class="form-control" placeholder="City" required>
																<div class="help-block with-errors"></div>
															</div>
													</div>
												</div>	
												<div class="row">
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
															<label>Address</label>
															<textarea id="address" name="address" class="form-control" rows="2" placeholder="Your Address here.." required></textarea>
															<div class="help-block with-errors"></div>
														</div>
													</div>
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
															<label>PO Box</label>
															<input type="text" name="zipcode" id="pincode" tabindex="2" class="form-control" placeholder="PO Box" required>
															<div class="help-block with-errors"></div>
														</div>
													</div>
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
													<div class="form-group">
															<label>Nature Of Business</label>
															<select name="cat_id" class="form-control" id="nature_business" >
																<option value="" >Select</option>
																<option value="15">Facility Management Services(FM)</option>
																<option value="18">Banking and Finance Facilities</option>
																<option value="19">Insurance</option>
																<option value="46">Rent A Car</option>
															</select>
															<div class="help-block with-errors"></div>
														</div>
													</div>
													<!--<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
														<input type="text" name="recaptcha" required value="" id="recaptchaValidator" style="visibility: hidden">	
															 <div class="g-recaptcha" data-sitekey="6LexbxIUAAAAANHaeY7ZY_5c1kgbeMvFEWW9zkrX"></div>
															  <div class="help-block with-errors"></div>
														</div>
													</div>-->
													
												</div>	
												<div class="row">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
														<div class="form-group text-center">
															<input type="checkbox" tabindex="3" class="" name="terms" id="remember" value="Y" required>
															<span class="termscond">I have read, understood and agree to the<br> 
																<a href="<?php echo base_url(); ?>pages/infopages/team_condition" target="_blank" title="Terms &amp; Conditions">Terms &amp; Conditions</a> of <b>TelUs Care.</b></span>
																<div class="help-block with-errors"></div>
														</div>
													</div>
												</div>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-4 col-sm-offset-4">
																<input type="submit" name="register_me" tabindex="4" class="form-control btn btn-login" value="Register Now!">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-4 col-sm-offset-4">
																<input type="reset" name="reset" tabindex="4" class="form-control btn btn-login" value="Reset">
															</div>
														</div>
													</div>
												</form>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
	<script>function captcha_onclick() {$('#recaptchaValidator').val(1).trigger('input');}</script>
	
	
	<div id="health-calculator" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog-full" style="z-index: 1050 !important;">
			<div class="modal-content">
				<div class="modal-body" style="padding:0;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-login" >
								<div class="panel-body">
									<div class="row">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<form id="login-form" data-toggle="validator" action="<?php echo base_url(); ?>healthinsurance/health_result" method="post" role="form" style="display: block;">
													<button class="btn btn-primary btn-lg center-block" style="background-color:#000;margin-right:0;border:none;padding:0 8px;" data-dismiss="modal" aria-hidden="true"><i class="ion-android-close"></i></button>
													<h1 class="pop_h1" style="color:#42ceb2;"><i class="ion-heart"></i> Health Insurance Calculator</h1>
													<div class="row">
														<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center">
															<div class="btn-group" id="toggle_event_editing">
															<label>LOOKING FOR  </label>
															<ul class="nav nav-pills">
															  <li class="active"><a data-toggle="pill" href="#members">Employee<input type="radio" name="emptype" value="Emp" style="display:none;"/></a></li>
															  <li><a data-toggle="pill" href="#Dependent">Dependent<input type="radio" name="emptype" value="Dep" style="display:none;"/></a></li>
															</ul>
																<div class="help-block with-errors"></div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center">
															<div class="tab-content">
																<div id="members" class="tab-pane fade in active">
																	<div class="col-xs-12 text-center">
																		<span class="span_black">No of Members</span> <input class="input_black" type="text" name="noofmem" id="noofperson" style="width:20% !important;"/>
																	</div>
																</div>
																<div id="Dependent" class="tab-pane fade">
																   <div class="col-xs-12 text-center">
																		<span class="span_black">No of Dependent</span> <input  type="text" name="noofmem"  class="input_black" id="noofdec" style="width:20% !important;"/>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Emirates</label>
																<?php echo get_emirates_field('country_id','country_id'); ?> 
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Select Plan</label>
																<?php echo get_health_plan_field('plan_id','plan_id'); ?> 
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Geographical Scope</label>
																<?php echo get_health_maps_field('geo_scope_id','geographicalscope'); ?> 
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Addon Benefits</label>
																<select class="form-control" id="benefits" name="benefits">
																	<option value="">Select</option>
																	<option value="dental">Dental</option>
																	<option value="maternity">Maternity</option>
																	<option value="Eye">Eye</option>
																	<option value="NA">Not Applicable</option>
																</select>
															</div>
														</div>
													</div>
													<div class="row">		
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Gender</label>
																<?php echo get_health_gender_field('Gender','userdata[0][gender]') ?>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Name</label>
																<input type="text" name="userdata[0][member_user_name]" id="contact_name" tabindex="1" class="form-control" placeholder="Name" value="" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group input-group">
																<label>Date Of Birth</label>
																<input type="text" id="dateRangePicker1" name="userdata[0][dob]" tabindex="2" class="form-control" placeholder="Date of Birth" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														
													</div>
													<div class="row">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
															<div class="form-group">
																<div class="row">
																<div class="col-sm-4 col-sm-offset-4">
																<div id="addmember" >
																			<button type="button" class="btn-accor btn-success addMemberBtn" style="margin: 10px 0;border-radius:10px;width:100%;" data-toggle="collapse" data-target="#add-input">Add Member</button>
																		  </div>
																	
																</div>
																</div>
															<div class="input_ll_add">
															</div>
															</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-4 col-sm-offset-4">
																<input type="submit" name="register_me" tabindex="4" class="form-control btn btn-login" value="Calculate">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-4 col-sm-offset-4">
																<input type="hidden" id="input_ll_field" value="1" />
																<input type="reset" name="reset" tabindex="4" class="form-control btn btn-login" value="Reset">
															</div>
														</div>
													</div>
												</form>
												
												<script>
												$(document).ready(function(){
													$('#addmember').hide();
													
													$('input[value=Emp]').prop('checked', true);
														$('#toggle_event_editing button').click(function(){
															
															var get_val = $(this).find('input[type=radio]').val(); 
															$('input[name=emptype]').prop('checked', false);  
															$('input[value='+get_val+']').prop('checked', true);
															
														});
														
														$('#noofperson , #noofdec').blur(function(){
															var getnoofperson = $(this).val();
															if(getnoofperson > 1){
																$('#addmember').show();
															}else{
																$('#addmember').hide();
															}
														});
														
														$('.addMemberBtn').click(function(){
															
															var count = $('#input_ll_field').val();
															
															$('.input_ll_add').append('<div class="row"><div class="col-lg-4 col-sm-4 col-md-4 col-xs-12"><div class="form-group"><label>Name</label><input class="form-control" name="userdata['+ count +'][member_user_name]" type="text" placeholder="Name"></div></div><div class="col-lg-4 col-sm-4 col-md-4 col-xs-12"><div class="form-group input-group"><label>Date Of Birth</label><input class="form-control" name="userdata['+ count +'][dob]" id="datepicker'+ count +'" type="text" placeholder="dd/mm/yyyy"></div></div><div class="col-lg-4 col-sm-4 col-md-4 col-xs-12"><div class="form-group"><label>Gender</label><select class="changegen form-control" id="gender'+ count +'" name="userdata['+ count +'][gender]" ><option value="">Select</option><option value="M">Male(Primary)</option><option value="F">Female(Primary)</option><option value="FM">Married Female(Primary)</option><option value="CM">Child Male</option><option value="CF">Child Female</option><option value="MA">Married</option><option value="UM">Unmarried</option><option value="FA">Father</option><option value="MO">Mother</option><option value="MCS">Maid/Cleaner/Servent</option><option value="P">Partner</option><option value="E">Employee</option></select></div></div>');		
																count++;
															$('#input_ll_field').val(count);
															
															return false;
																		
														});
														
													});
												</script>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	</div>
	
	<div id="motor-calculator" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog-full">
			<div class="modal-content">
				<div class="modal-body" style="padding:0;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-login" >
								<div class="panel-body">
									<div class="row">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<form id="login-form" data-toggle="validator" action="<?php echo base_url(); ?>motorinsurance/motor_result" method="post" role="form" style="display: block;">
													<button class="btn btn-primary btn-lg center-block" style="background-color:#000;margin-right:0;border:none;padding:0 8px;" data-dismiss="modal" aria-hidden="true"><i class="ion-android-close"></i></button>
													<h1 class="pop_h1" style="color:#de6d75;"><i class="ion-model-s"></i> Motor Insurance Calculator</h1>
													<div class="row">
													
													<div class="row">
														<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center">
															<div class="btn-group" id="toggle_event_editing_motor">
															<label>LOOKING FOR  </label>
															
															<ul class="nav nav-pills" >
															  <li class="active"><a data-toggle="pill" href="#Comprehensive">Comprehensive<input type="radio" name="type_check" value="comp" style="display:none;" /></a></li>
															  <li><a data-toggle="pill" href="#tpl">Third Party Liability<input type="radio" name="type_check" value="tpl" style="display:none;"/></a></li>
															</ul>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center" >
														<div class="btn-group" id="private_comm">
														<label> IT IS  </label>
															<ul class="nav nav-pills" >
															  <li class="active"><a data-toggle="pill" href="#Private">Private
															  <input type="radio" name="business_check" value="pvt" style="display:none;"/></a></li>
															  <li><a data-toggle="pill" href="#Commercial">Commercial
															  <input type="radio" name="business_check" value="comm" style="display:none;"/></a></li>
															</ul>
														</div>
														</div>
													</div>
															
															
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Vehicle  Type</label>
																
																<?php echo get_vehicle_type_form_field(); ?>
																
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Makers</label>
																
																<?php echo get_all_vehicle_info_form(); ?>
																
																<div class="help-block with-errors"></div>
															</div>
														</div>
														
														<div class="col-lg-2 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Models</label>
																<select class="form-control" name="vehicle_models" id="vehicle_models" tabindex="-98">
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-2 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Year Of Reg</label>
																
																<?php echo get_years_field('1985','year_of_reg','year_of_reg'); ?>
																
																<div class="help-block with-errors"></div>
															</div>
														</div>
													</div>
													
													<div class="row">
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Driving Licence</label>
																<select class="form-control" id="drving" name="Driving_Licence" required>
																	<<option value="" selected="selected">Select</option>
																	<option value="l6">less than 6 months</option>
																	<option value="l1">More than 6 months to less than 1 years</option>
																	<option value="1">More Than 1 year to less than 2 years</option>
																	<!--<option value="2">2 year to 3 year</option>-->
																	<option value="A2">More than 2 years</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Driver Age</label>
																<select class="form-control" id="driver_age" name="driver_age" required>
																	<option value="">Select</option>
																	<option value="1">Less than 21 Years</option>
																	<option value="2">More Than 21 Years and Less than 25 Years</option>
																	<option value="3">More than 25 Years and Less than 30 Years</option>
																	<option value="4">More than 30 Years</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Emirate of Registration</label>
																<?php echo get_emirates_field('country_id','emirates'); ?> 
																
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>GCC SPEC</label>
																<select class="form-control" id="gcc_status" name="gcc_status" required>
																	<<option value="">Select</option>
																	<option value="1">YES</option>
																	<option value="0">NO</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
													</div>
													
													<div class="tab-content">
													<div class="form-group tab-pane fade in active" id="Comprehensive">
														<div class="row">
															<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																<div class="form-group">
																	<label>Agency</label>
																	<select class="form-control" id="agancy" name="agencytype">
																		<option value="">Select</option>
																		<option value="1">Agency</option>
																		<option value="2">NON-AGENCY(Standard)</option>
																		<option value="3">NON-AGENCY(Superior)</option>
																	</select>
																</div>
															</div>
															<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																<div class="form-group">
																	<label>Last Year Value</label>
																	<input type="text" name="last_year_val" id="last_year_val" tabindex="1" class="form-control" placeholder="Last Year Value" value="">
																</div>
															</div>
															<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																<div class="form-group input-group">
																	<label>Current Year Value</label>
																	<input type="text" id="current_year_val"  name="current_year_val" tabindex="2" class="form-control" placeholder="Current Year Value">
																</div>
															</div>
														</div>
														<h3>Addon Benefits</h3>
														<div class="row">
															<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
																<div class="form-group">
																	<label>Pay for Driver</label><br>
																	<label class="radio-inline">
																	  <input type="radio" name="PAB_driver" value="1" checked> Yes 
																	</label>
																	<label class="radio-inline">
																	  <input type="radio" name="PAB_driver" value="0" /> No
																	</label>
																</div>
															</div>
															<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
																<div class="form-group">
																	<label>PAB for passangers</label><br>
																	<label class="radio-inline">
																	  <input type="radio" name="PAB_passangers" value="1" checked> Yes 
																	</label>
																	<label class="radio-inline">
																	  <input type="radio" name="PAB_passangers" value="0"/> No
																	</label>
																	<div id="no_of_pass">
																		  <label for="country" > NO OF PASSANGERS :</label>
																		  <input type="text" name="PAB_passangers_txt" class="form-control" value="" id="PAB_passangers_txt" />
																	</div>
																</div>
															</div>
															<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
																<div class="form-group">
																	<label>Road Side Assitance</label><br>
																	<label class="radio-inline">
																	  <input type="radio" name="RSA" value="1" checked > Yes 
																	</label>
																	<label class="radio-inline">
																	  <input type="radio" name="RSA"  value="0" /> No
																	</label>
																</div>
															</div>
															
															<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
																<div class="form-group">
																	<label>Rent A Car</label><br>
																	<label class="radio-inline">
																	  <input type="radio" name="ADD_rent_car" value="1" checked > Yes 
																	</label>
																	<label class="radio-inline">
																	  <input type="radio" name="ADD_rent_car" value="0"/> No
																	</label>
																</div>
															</div>
														</div>
													</div>
													
													<div class="form-group tab-pane fade" id="tpl">
														<div class="row">
															<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																<div class="form-group">
																	<label>No Of Cylinders</label>
																	<select class="form-control" id="noofcylinders" name="noofcylinders">
																		<option value="">Select</option>
																		<option value="4">4 Cylinder</option>
																		<option value="6">6 Cylinder</option>
																		<option value="8">8 Cylinder</option>
																		<option value="A8">8 Cylinder Above</option>
																		<option value="SC">Sports/Coupe</option>
																	</select>
																</div>
															</div>
														</div>
													</div>
													</div>
													<h3> Declaration:-  </h3>
													<div class="row">
														<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
															<ol class="declaration_spacing"> 
																<li> Your Information is same as provided documents while making Insurance (<input type="radio" name="info_provided" required checked > Yes  <input type="radio" name="info_provided" required > No)</li>
																<li> No Claim Declaration <select> 
																<option selected value="0"> Self Declaration  </option> 
																<option value="1"> 1 Year NCD  </option> 
																<option value="2"> 2 Years NCD  </option> 
																<option value="3"> 3 Years NCD  </option> 
																<option value="4"> More than 3 Years NCD  </option>
																	</select>															
																</li>
																<li> No gap Insurance OR Just Bought a Car 
																(<input type="radio" name="gap_cert" required checked > Yes  <input type="radio" name="gap_cert" required> No)</li> </li>
															</ol>
														</div>
													</div>	
													
													<div class="form-group">
														<div class="row">
															<div class="col-sm-4 col-sm-offset-4">
																<input type="submit" name="register_me" tabindex="4" class="form-control btn btn-login" value="Calculate">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-4 col-sm-offset-4">
																<input type="reset" name="reset" tabindex="4" class="form-control btn btn-login" value="Reset">
															</div>
														</div>
													</div>
												</form>
												<script>
												$(document).ready(function(){
												    $('#no_of_pass').hide();
													$('input[value=comp]').prop('checked', true);
													$('input[value=pvt]').prop('checked', true);
													$('#toggle_event_editing_motor li').click(function(){
														
														var get_val = $(this).find('input[type=radio]').val(); 
														
															$('input[name=type_check]').prop('checked', false);  
															$('input[value='+get_val+']').prop('checked', true);
													
													});
													$('#private_comm li').click(function(){
														
															var get_val = $(this).find('input[type=radio]').val(); 
															
															//alert(get_val);
															$('input[name=business_check]').prop('checked', false);  
															$('input[value='+get_val+']').prop('checked', true);
													
													});
													$('input[name=PAB_passangers]').click(function(){
		
														var num_pass = $(this).val();
														
														if(num_pass == 1){ $('#no_of_pass').show();  }
														if(num_pass == 0){ $('#no_of_pass').hide();  }
														
													});
													
													$('#last_year_val').blur(function(){
		
														var cur_val = $(this).val(); 
														var f_current_val = Number(cur_val) - Number(cur_val) * 20 / 100;
														$('#current_year_val').val(f_current_val);
														
													});
													
													 $('#current_year_val').blur(function(){
														
														var cur_val = $(this).val(); 
														var f_current_val = Number(cur_val) + Number(cur_val) * 20 / 100;
														$('#last_year_val').val(f_current_val);
														
													}); 
													
													$('#vehicle_name').change(function(){	

													var vehicle_name =	$(this).val();

													$('#vehicle_models').empty();
													 $.ajax({ 
														type      : 'POST', 
														url       : '<?php echo base_url(); ?>motorinsurance/get_vehicle_models',
														datatype  : 'html',			
														data      : {'vehicle_name': vehicle_name},
														success   : function(data_w) {
															
																var cars = data_w;
																var array = [];
																
																for(var i in cars) {
																		if(cars.hasOwnProperty(i) && !isNaN(+i)) {
																			array[+i] = cars[i].model;
																		}
																		
																	$('#vehicle_models').append($('<option>', { 
																		value: cars[i].model,
																		text : cars[i].model 
																	}));
																}
															}
														});
													});
	
	
												});	
												</script>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	
	<div id="cleaning" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog-full" style="z-index: 1050 !important;">
			<div class="modal-content">
				<div class="modal-body" style="padding:0;">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-login" >
								<div class="panel-body">
									<div class="row">
											<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
												<form id="login-form" data-toggle="validator" action="<?php echo base_url(); ?>cleaningservice/cleaning_post" method="post" role="form" style="display: block;">
													<button class="btn btn-primary btn-lg center-block" style="background-color:#000;margin-right:0;border:none;padding:0 8px;" data-dismiss="modal" aria-hidden="true"><i class="ion-android-close"></i></button>
													<h1 class="pop_h1" style="color:#e6a65a;"><i class="ion-trash-a"></i> Cleaning Rate  Calculator Service</h1>
													<div class="row">
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Emirate</label>
																<select class="form-control" id="emirateId" name="emirate" required>
																	<option value="" selected="">Select</option>
																	<option value="3">Dubai</option>
																	<option value="1">Abu Dhabi</option>
																	<option value="4">Al Ain</option>
																	<option value="5">Sharjah</option>
																	<option value="8">Fujairah</option>
																	<option value="6">Ras Al Khaimah</option>
																	<option value="2">Ajman</option>
																	<option value="7">Umm Al Quwain</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Sub City</label>
																<select class="form-control" id="sub_city" name="sub_city">
																	
																</select>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>No Of Cleaners</label>
																<select class="form-control" id="noofcleaners" name="noofcleaners" required>
																	<option value="">Select</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																	<option value="6">6</option>
																	<option value="7">7</option>
																	<option value="8">8</option>
																	<option value="9">9</option>
																	<option value="10">10</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>No Of Hours</label>
																<select class="form-control" id="noofhours" name="noofhours" required>
																	<option value="">Select</option>
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>
																	<option value="4">4</option>
																	<option value="5">5</option>
																	<option value="6">6</option>
																	<option value="7">7</option>
																	<option value="8">8</option>
																	<option value="9">9</option>
																	<option value="10">10</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label><small>How Often need cleaning in a month Or ?</small></label>
																<select class="form-control" id="cleanerfreq" name="cleanerfreq" required>
																	<option value="" selected="selected">Select</option>
																	<option value="1">1 Time Only</option>
																	<option value="2">2 Times Only</option>
																	<option value="4">4 Times Only</option>
																	<option value="8">8 Times Only</option>
																	<option value="12">12 Times Only</option>
																	<option value="15">15 Times Only</option>
																	<option value="30">Every Day except public holiday</option>
																	<option value="365">Annual Contract</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Material Provide by Customer</label>
																<select class="form-control" id="material_provide" name="material_provide" required>
																	<<option value="">Select</option>
																	<option value="1">YES</option>
																	<option value="0">NO</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Type of Premises</label>
																<select class="form-control" id="premises" name="premises" required>
																	<option value="" selected="selected">Select</option>
																	<option value="1">Villa</option>
																	<option value="2">Office</option>
																	<option value="3">Apartment</option>
																	<option value="4">Warehouse</option>
																	<option value="5">In Our Own Company Premises</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group input-group">
																<label>Date Of Cleaning</label>
																<input type="text" id="dateRangePicker2" name="cleaning_date" tabindex="2" class="form-control" placeholder="Date of Cleaning" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
													</div>
												
													<div class="form-group">
														<div class="row">
															<div class="col-sm-4 col-sm-offset-4">
																<input type="submit" name="register_me" tabindex="4" class="form-control btn btn-login" value="Calculate">
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-4 col-sm-offset-4">
																<input type="reset" name="reset" tabindex="4" class="form-control btn btn-login" value="Reset">
															</div>
														</div>
													</div>
												</form>
												
												<script>
													
													
												</script>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	
	<div id="motor-service-calculator" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog-full">
				<div class="modal-content">
					<div class="modal-body" style="padding:0;">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-login" >
									<div class="panel-body">
										<div class="row">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
													<form id="login-form" data-toggle="validator" action="<?php echo base_url(); ?>motorservicing/motorservicing_result" method="post" role="form" style="display:block;">
														<button class="btn btn-primary btn-lg center-block" style="background-color:#000;margin-right:0;border:none;padding:0 8px;" data-dismiss="modal" aria-hidden="true"><i class="ion-android-close"></i></button>
													<h1 class="pop_h1" style="color:#4B76C2;"><i class="ion-settings"></i> Motor Service Calculator</h1>
														<div class="row">
																<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																	<div class="form-group">
																		<label>Vehicle  Type</label>
																		<?php echo get_vehicle_type_form_field('vehicletype','vehicletype'); ?>
																		
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
																<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																	<div class="form-group">
																			<label>Maker</label>
														<?php echo get_all_makers_hel('vehicle_makers','vehicle_makers'); ?>
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
																<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																	<div class="form-group">
																		<label>Model Type</label>
																		<select class="form-control" name="vehicle_models" 	id="vehicle_models1" required>
																			<option value="">Select</option>
																		</select>
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
														</div>
														<div class="row">
															<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																		<div class="form-group">
																			<label>Level Of Services</label>
											<?php echo get_level_of_services_field('services_level','services_level'); ?>			<div class="help-block with-errors"></div>
																		</div>
															</div>
															<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																	<div class="form-group input-group">
																		<label>Date Of Motor servicing</label>
																		<input type="text" id="dateRangePicker3" name="date_motor_servicing" tabindex="2" class="form-control" placeholder="Date of Cleaning" required>
																		<div class="help-block with-errors"></div>
																	</div>
															</div>
															<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																<div class="form-group">
																	<input type="hidden">
																</div>
															</div>
														</div>
														
																			
														<div class="form-group">
															<div class="row">
																<div class="col-sm-4 col-sm-offset-4">
																	<input type="submit" name="register_me" tabindex="1" class="form-control btn btn-login" value="Calculate">
																</div>
															</div>
														</div>
														
														<div class="form-group">
															<div class="row">
																<div class="col-sm-4 col-sm-offset-4">
																	<input type="reset" name="reset" tabindex="4" class="form-control btn btn-login" value="Reset">
																</div>
															</div>
														</div>
													</form>
													<script>
													$(document).ready(function(){
														
													$('#vehicle_makers').change(function(){	

														var vehicle_name =	$(this).val();

														$('#vehicle_models1').empty();
														 $.ajax({ 
															type      : 'POST', 
															url       : '<?php echo base_url(); ?>motorinsurance/get_vehicle_models',
															datatype  : 'html',			
															data      : {'vehicle_name': vehicle_name},
															success   : function(data_w) {
																
																	var cars = data_w;
																	var array = [];
																	
																	for(var i in cars) {
																			if(cars.hasOwnProperty(i) && !isNaN(+i)) {
																				array[+i] = cars[i].model;
																			}
																			
																		$('#vehicle_models1').append($('<option>', { 
																			value: cars[i].model,
																			text : cars[i].model 
																		}));
																	}
																}
															});
													});
													
		
													});	
													</script>
												</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	<div id="pest-control" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog-full">
				<div class="modal-content">
					<div class="modal-body" style="padding:0;">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-login" >
									<div class="panel-body">
										<div class="row">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
													<form id="login-form" data-toggle="validator" action="<?php echo base_url(); ?>pestcontrol/pestcontrol_result" method="post" role="form" style="display: block;">
														<button class="btn btn-primary btn-lg center-block" style="background-color:#000;margin-right:0;border:none;padding:0 8px;" data-dismiss="modal" aria-hidden="true"><i class="ion-android-close"></i></button>
														<h1 class="pop_h1" style="color:#D17447;"><i class="fa fa-bug"></i> Pest Control Services Calculator</h1>
														<div class="row">
																<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																	<div class="form-group">
																		<label>Type Of Services</label>
																		<?php echo get_pest_type_of_service_field('type_of_service','type_of_service',00); ?>
																		
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
																<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																	<div class="form-group">
																		<label>Type of Premises</label>
																		<?php echo get_type_of_premises_field('premises','premises',00); ?>
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
																<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 kop" >
																	<div class="form-group">
																		<label>Select Premises</label>
																		<select name="" class="form-control">
																		</select>
																	</div>	
																</div>
															<!--<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12 kop" >
																	<div class="form-group">
																		<label>Kind of Premises</label>
																		<?php echo get_kind_of_premises_field('kind_premises','kind_premises',00); ?>
																		<div class="help-block with-errors"></div>
																	</div>
																</div>-->
																
														</div>
														<div class="row">
																	<!--<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																		<div class="form-group">
																			<label>Approx Area</label>
																		<?php echo get_area_sqrt_field('area','area',00); ?>
																			<div class="help-block with-errors"></div>
																		</div>
																	</div>-->
																	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																			<div class="form-group input-group">
																				<label>Date Of Pest Control</label>
																				<input type="text" id="dateRangePicker4" name="date_pest" tabindex="2" class="form-control" placeholder="Date of Cleaning" required>
																				<div class="help-block with-errors"></div>
																			</div>
																	</div>
																	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																		<div class="form-group">
																			<input type="hidden">
																		</div>
																	</div>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-sm-4 col-sm-offset-4">
																	<input type="submit" name="register_me" tabindex="4" class="form-control btn btn-login" value="Calculate">
																</div>
															</div>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-sm-4 col-sm-offset-4">
																	<input type="reset" name="reset" tabindex="4" class="form-control btn btn-login" value="Reset">
																</div>
															</div>
														</div>
													</form>
													
												</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
				$('document').ready(function(){
					
					$('.premises').on('change',function(){
						var get_val = $(this).val();
						if(get_val == 1 || get_val == 3 ){
							
							$('.kop').html('<div class="form-group"><label>Kind of Premises</label><select id="kind_premises" name="kind_premises" class="form-control"></select><div class="help-block with-errors"></div></div>');
							if(get_val == 3){
								var elem = ["Select","STUDIO","1 BHK","2 BHK","3 BHK","4 BHK","5 BHK"];  
							}else{
								var elem = ["Select","1 BHK","2 BHK","3 BHK","4 BHK","5 BHK"];     
							}
							
							var sel = document.getElementById('kind_premises');
							for(var i = 0; i < elem.length; i++) {
								var opt = document.createElement('option');
								opt.innerHTML = elem[i];
								opt.value = i;
								sel.appendChild(opt);
							}
							
						}if(get_val == 2 || get_val == 4 || get_val == 5){
							$('.kop').html('<div class="form-group"><label>Approx Area</label><select id="area" name="area" class="form-control"></select><div class="help-block with-errors"></div></div>');
							
							var elem = ["Select","below 500 sqft","500 sqft to 1000 sqft","1000 sqft to 2000 sqft","2000 sqft to 3000 sqft","3000 sqft to 4000 sqft","4000 sqft to 5000 sqft","5000 sqft to 7000 sqft","7000 sqft to 10000 sqft","10000 sqft to 20000 sqft","20000 sqft & above"];     

							var sel = document.getElementById('area');
							for(var i = 0; i < elem.length; i++) {
								var opt = document.createElement('option');
								opt.innerHTML = elem[i];
								opt.value = i;
								sel.appendChild(opt);
							}
						}
						
					});
				});
			</script>
		</div>
		
	<div id="paint-services" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog-full">
				<div class="modal-content">
					<div class="modal-body" style="padding:0;">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-login" >
									<div class="panel-body">
										<div class="row">
												<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
													<form id="login-form" data-toggle="validator" action="<?php echo base_url(); ?>motorinsurance/motor_result" method="post" role="form" style="display: block;">
														<button class="btn btn-primary btn-lg center-block" style="background-color:#000;margin-right:0;border:none;padding:0 8px;" data-dismiss="modal" aria-hidden="true"><i class="ion-android-close"></i></button>
														<h1 class="pop_h1" style="color:#D9679C;"><i class="ion-paintbrush"></i> Paint Services Calculator</h1>
														<div class="row">
																<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																	<div class="form-group">
																		<label>Type of Premises</label>
																		<select class="form-control" id="premises" name="premises" required>
																			<option value="" selected="selected">Select</option>
																			<option value="1">Villa</option>
																			<option value="2">Office</option>
																			<option value="3">Apartment</option>
																			<option value="4">Warehouse</option>
																			<option value="5">In Our Own Company Premises</option>
																		</select>
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
																<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																	<div class="form-group">
																		<label>Kind of Premises</label>
																		<select class="form-control" id="kind_premises" name="kind_premises" required>
																			<option value="" selected="selected">Select</option>
																			<option value="1">Studio</option>
																			<option value="2">1 BR goes to 5 BR</option>
																			<option value="3">Apartment</option>
																			<option value="4">Warehouse</option>
																		</select>
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
																<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																	<div class="form-group">
																		<label>Approx Area</label>
																		<select class="form-control" id="area" name="area" required>
																			<option value="" selected="selected">Select</option>
																			<option value="1">below 500 sqft</option>
																			<option value="2">500 sqft to 1000 sqft</option>
																			<option value="3">1000 sqft to 2000 sqft</option>
																			<option value="4">2000 sqft to 3000 sqft</option>
																			<option value="5">3000 sqft to 4000 sqft</option>
																			<option value="6">4000 sqft to 5000 sqft</option>
																			<option value="7">5000 sqft to 7000 sqft</option>
																			<option value="8">7000 sqft to 10000 sqft</option>
																			<option value="9">10000 sqft to 20000 sqft</option>
																			<option value="10">20000 sqft & above</option>
																		</select>
																		<div class="help-block with-errors"></div>
																	</div>
																</div>
																
														</div>
														<div class="row">
																	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center" >
																		<div class="btn-group" id="private_comm">
																			<label> Need Paint ?  </label>
																			<ul class="nav nav-pills" >
																			  <li class="active"><a data-toggle="pill" href="#">I will supply the paint.<input type="radio" name="type_check1" value="comp" style="display:none;"/></a></li>
																			  <li><a data-toggle="pill" href="#">I need paint supplied by vender Telus.<input type="radio" name="type_check1" value="tpl" style="display:none;"/></a></li>
																			</ul>
																		</div>
																	</div>
														</div>
														<div class="row">
															<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																	<div class="form-group">
																		<label>Do You Need Painting ?</label>
																		<select class="form-control" id="painting_partial" name="painting_partial" required>
																			<option value="" selected="selected">Select</option>
																			<option value="1">Partial Painting with 1 color</option>
																			<option value="2">Partial Painting with 2 colors</option>
																			<option value="3">Partial Painting with 3 or more colors</option>
																			<option value="4">Full premises painting with 2 colors</option>
																			<option value="5">Full premises painting with 3 or more colors</option>
																		</select>
																		<div class="help-block with-errors"></div>
																	</div>
															</div>
															<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																	<div class="form-group input-group">
																		<label>Date Of Pest Coontrol</label>
																		<input type="text" id="dateRangePicker2" name="date_pest" tabindex="2" class="form-control" placeholder="Date of Cleaning" required>
																		<div class="help-block with-errors"></div>
																	</div>
															</div>
															<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
																<div class="form-group">
																	<input type="hidden">
																</div>
															</div>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-sm-4 col-sm-offset-4">
																	<input type="submit" name="register_me" tabindex="4" class="form-control btn btn-login" value="Calculate">
																</div>
															</div>
														</div>
														<div class="form-group">
															<div class="row">
																<div class="col-sm-4 col-sm-offset-4">
																	<input type="reset" name="reset" tabindex="4" class="form-control btn btn-login" value="Reset">
																</div>
															</div>
														</div>
													</form>
													
												</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		
		
		
	<div id="errorbox" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="z-index:9999999;">
        <div class="modal-dialog-full">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">MESSAGE WINDOWS</h4>
			</div>
				<div class="modal-body" style="padding:0;">
						<div class="panel panel-login" >
							<div class="panel-body alert alert-danger">
							</div>
						</div>		
				</div>
			</div>
		</div>
	</div>
	
	<div id="ComingSoon" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog-full">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<div class="modal-title">Coming Soon</div>
			</div>
				<div class="modal-body" style="padding:0;">
						<div class="panel panel-login" >
							<div class="panel-body">
								<div class="pop_h1">We Will Get Back to you soon. Stay Cool.</div>
							</div>
						</div>		
				</div>
			</div>
		</div>
	</div>
	
	<?php   //if($_SESSION['check_popup']){ ?>
  <!-- POP-up offers Modal -->  
	  <div class="modal fade" id="myModalpopupoffer" role="dialog">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<!--<div class="modal-header header_imp">
			 
			  <h4 class="modal-title">Insurance</h4> 
			</div>-->
			<div class="modal-body" style="padding:0;background:url(<?php echo base_url(); ?>assets/newasset/image/motorins.png);background-size:cover;">
			 <button type="button" class="close" data-dismiss="modal" style="right: 10px;position: relative;top: 5px;z-index:99;">&times;</button>
			  <div class="row modal_row">
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 col_pad_imp">
					    <style>
							#myModalpopupoffer ul li{line-height:30px;font-size:14px;color:#444;list-style-type: square;letter-spacing:1px;}
						</style>
					  <p style="color:#DE6D75; text-align: center; font-size: 22px;letter-spacing:1px;font-weight: 600;"><u>Register On before 31st March 2017</u></p>
					  <ul style="margin-left: 25px;">
						<li> Get 30-50 % OFF On Car Washing.</li>
						<li> Get 10-30 % OFF On Car Servicing.</li>
						<li> Get Reward points Upto AED 350.</li>
						<li style="list-style-type:none;font-size:12px;"><b>Register and avail the above offers.</b><span><a href="pages/infopages/team_condition" target="_blank" style="color:red;font-size:8px;">T&C Apply</a></span></li>
					  </ul>
					  <!--<img src="<?php echo base_url(); ?>assets/newasset/image/star_broker.jpg" class="img-responsive w3-animate-left">-->
					</div>
					<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 col_pad_imp" style="margin-top:-20px;">
						<div class="row form_row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_pad_imp form_border">
									<div class="p_heading">
										<h2>Hurry Register Now</h2>
										<?php //print_r($_COOKIE['reg_popup']); ?>
										<!-- <p>Today for a chance to win...</p> -->
									</div>							
									<div id="signup_submit_div_err"> </div>	
									<form id="signup_details_home_pop" data-toggle="validator" action="<?php echo base_url(); ?>motorinsurance/motor_data_popup" method="post" role="form" >									
										<div class="form-group form-group-mb">
											<label for="sel1">Name :</label>
											<input class="input_width" id="full_name" name="fullname" placeholder="Full Name" type="text" required>
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group form-group-mb">
											<label for="sel1">Mobile Number:</label>
											<input class="input_width" id="mobile_number" name="mobile_number" placeholder="Mobile Number" type="text" required>
											<div class="help-block with-errors"></div>
										</div>
										<div class="form-group form-group-mb">
											<label for="sel1">Email ID:</label>
											<input class="input_width" id="email_id" name="email" placeholder="Email ID" type="email" required>
											<div class="help-block with-errors"></div>
										</div>
										 <div class="form-group form-group-mb">
											  <label for="sel1">Car Renewal Month:</label>
											  <select class="form-control input_width" name="month" id="month" required>
												<option value="">Select</option>
												<option value="1">January</option>
												<option value="2">February</option>
												<option value="3">March</option>
												<option value="4">April</option>
												<option value="5">May</option>
												<option value="6">June</option>
												<option value="7">July</option>
												<option value="8">August</option>
												<option value="9">September</option>
												<option value="10">October</option>
												<option value="11">November</option>
												<option value="12">December</option>
											  </select>
											  <div class="help-block with-errors"></div>
										</div>
										<div class="form-group form-group-mb">
											  <label for="sel1">Select Motor Type:</label>
												<select class="form-control input_width" id="product_type" name="product_type" required>
																	<option value="">Select</option>
																	<option value="25">Sports/Coupe</option>
																	<option value="1">Saloon Hatchback</option>
																	<option value="2">4X4 / SUV</option>
																	<option value="3">Van</option>
																	<option value="4">Bus(15 seats)</option>
																	<option value="5">Bus(26 seats)</option>
																	<option value="6">Bus(56 seats)</option>
																	<option value="7">Bus(83 seats)</option>
																	<option value="8">Motor Bike</option>
																	<option value="9">Pick Up (1 ton)</option>
																	<option value="10">Pick Up (2 ton)</option>
																	<option value="11">Pick Up (upto 3 ton)</option>
																	<option value="12">Pick Up (More than 3 ton)</option>
																	<option value="13">Rent a Car</option>
																	<option value="14">Taxi</option>
																	<option value="15">Truck</option>
																	<option value="16">Trails</option>
																	<option value="17">Tanker (Upto 2 Gallons)</option>
																	<option value="18">Tanker (Upto 5 Gallons)</option>
																	<option value="19">Gas Pick up</option>
																	<option value="20">Tanker (chemical)</option>
																	<option value="21">Tanker (Diesel)</option>
																	<option value="22">Fork lift</option>
																	<option value="23">Dumper</option>
																	<option value="24">Heavy Equipment</option>
																	<option value="26">Light Equipment</option>
												</select>
												<div class="help-block with-errors"></div>
										</div>
										<div class="form-group form-group-mb text-center">
											<input type="submit" class="btn btn-danger" id="button-register-home-popup" value="Register" >
										</div>
									</form>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		  </div>
		</div>
	  </div>
	  <style>
			.form_border {
				font-size: 12px !important;
				background-color:#fff;
				opacity:0.8;
				box-shadow:1px 1px 8px #999;
			}
			.header_imp {
				border: none !important;
				padding: 0 !important;
				background:#fff;
			}
			.modal_row {
				margin-left: 0 !important;
				margin-right: 0 !important;
			}
			.col_pad_imp {
				padding: 7px !important;
			}
			.form_row {
				margin-left: 0 !important;
				margin-right: 0 !important;
			}
			.p_heading h2{
				font-size:23px;
				color: #DE6D75;
				font-family: arial;
				letter-spacing: 1px !important;
				text-align:center;
				font-weight:700;
			}
			.form_position {
				margin-top:5px !important;
				padding-left: 30px !important;
				padding-right: 30px !important;
				display: block !important;
			}
			#signup_details_home_pop input[type="text"], input[type="password"] {
				height: 30px !important;
			}
			.input_width {
				width: 100% !important;
				border: 1px solid #DE6D75 !important;
				padding: 5px !important;
				border-radius:3px;
				color:#000;
			}
			.form-group-mb {
				margin-bottom: 5px;
			}
			.form-group-mb label{
				color:#000;
			}
	  </style>
	   <script src="<?php echo base_url(); ?>assets/newasset/js/halma-localstorage.js"></script>
	  <script>
		   $(document).ready(function(){ 
			var h_path = window.location.pathname;
			 if(h_path == '/'){ 
				if(localStorage.getItem('popState') != 'shown'){
				   $('#myModalpopupoffer').modal('show'); 	
				}
			  }
			});
	  </script>
  <?php //} ?>
  <?php } ?>
  
  