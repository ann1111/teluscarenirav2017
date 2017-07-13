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
        <div class="modal-dialog-full">
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
													<h3>Parsonal Information :</h3>
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
																<input type="number" name="mobile_number" id="mobile" tabindex="2" class="form-control" placeholder="Mobile No" required>
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
																<label>City</label>
																<input type="text" name="city" id="city" tabindex="2" class="form-control" placeholder="City" required>
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
																<label>Country</label>
																<select class="form-control" id="country" name="country" required>
																	<option value="" selected="selected">Select Country</option>
																	<option value="Afghanistan">Afghanistan</option>
																	<option value="Albania">Albania</option>
																	<option value="American Samoa">American Samoa</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
													</div>
													<div class="row">	
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>PIn / Zip Code</label>
																<input type="text" name="zipcode" id="pincode" tabindex="2" class="form-control" placeholder="PIn / Zip Code" required>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
															<input type="text" name="recaptcha" required value="" id="recaptchaValidator1" style="visibility: hidden">	
															 <div class="g-recaptcha" data-sitekey="6LexbxIUAAAAANHaeY7ZY_5c1kgbeMvFEWW9zkrX"></div>
															  <div class="help-block with-errors"></div>
															</div>
														</div>
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
																<span class="termscond"><a href="<?php echo base_url(); ?>terms-and-conditions" target="_blank" title="Terms &amp; Conditions">Terms &amp; Conditions</a>of <b>TelUs Care.</b></span>
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
        <div class="modal-dialog-full">
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
															<label>Country</label>
															<select class="form-control" id="country" name="country" required>
																<option value="">Select</option>
																<option value="Afghanistan">Afghanistan</option>
																<option value="Albania">Albania</option></select>
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
															<input type="number" name="mobile_number" id="mobile" tabindex="2" class="form-control" placeholder="Mobile No" required>
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
															<label>Address</label>
															<textarea id="address" name="address" class="form-control" rows="2" placeholder="Your Address here.." required></textarea>
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
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
															<label>State</label>
															<input type="text" name="state" id="state" tabindex="2" class="form-control" placeholder="State" required>
															<div class="help-block with-errors"></div>
														</div>
													</div>
												</div>	
												<div class="row">
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
															<label>Contact Name</label>
															<input type="text" name="first_name" id="contact_name" tabindex="2" class="form-control" placeholder="Contact Name" required>
															<div class="help-block with-errors"></div>
														</div>
													</div>
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
															<label>PIn / Zip Code</label>
															<input type="text" name="zipcode" id="pincode" tabindex="2" class="form-control" placeholder="PIn / Zip Code" required>
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
													<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
														<div class="form-group">
														<input type="text" name="recaptcha" required value="" id="recaptchaValidator" style="visibility: hidden">	
															 <div class="g-recaptcha" data-sitekey="6LexbxIUAAAAANHaeY7ZY_5c1kgbeMvFEWW9zkrX"></div>
															  <div class="help-block with-errors"></div>
														</div>
													</div>
													
												</div>	
												<div class="row">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
														<div class="form-group text-center">
															<input type="checkbox" tabindex="3" class="" name="terms" id="remember" value="Y" required>
															<span class="termscond">I have read, understood and agree to the<br> 
																<a href="<?php echo base_url(); ?>terms-and-conditions" target="_blank" title="Terms &amp; Conditions">Terms &amp; Conditions</a>of <b>TelUs Care.</b></span>
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
        <div class="modal-dialog-full">
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
													<h1 class="pop_h1">Health Insurance Calculator</h1>
													<div class="row">
														<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center">
															<div class="btn-group" id="toggle_event_editing">
																<label>LOOKING FOR  </label>
																<button type="button" class="btn-accor btn-info locked_active">Employee<input type="radio" name="emptype" value="Emp" style="display:none;"/></button>
																<button type="button" class="btn-accor btn-default unlocked_inactive"> Dependent<input type="radio" name="emptype" value="Dep" style="display:none;"/></button>
																<div class="help-block with-errors"></div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Emirates</label>
																<select class="form-control" id="country_id" name="country_id" required>
																	<option value="">Select</option>
																	<option value="DUB">Dubai</option>
																	<option value="ABU">Abu Dhabi</option>
																	<option value="SHR">Sharjah</option>
																	<option value="RAK">Ras Al Khaimah</option>
																	<option value="AJM">Ajman</option>
																	<option value="UAQ">Umm Al Quwain</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Select Plan</label>
																<select class="form-control" id="plan_id" name="plan_id" required>
																	<option value="">Select</option>
																	<option value="BDHA">Basic</option>
																	<option value="SGOLD">Enhance Silver</option>
																	<option value="GGOLD">Enhance Gold</option>
																	<option value="PGOLD">Enhance Platinum</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Geographical Scope</label>
																<select class="form-control" id="geo_scope_id" name="geographicalscope">
																	<option value="">Select</option>
																	<option value="Worldwide">Worldwide</option>
																	<option value="UAE">UAE</option>
																	<option value="GCC">GCC</option>
																	<option value="USA">World Wide ex-USA</option>
																	<option value="middleeast">Middle East &amp; North Africa </option>
																</select>
															
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Benefits</label>
																<select class="form-control" id="benefits" name="benefits">
																	<option value="">Select</option>
																	<option value="dental">Dental</option>
																	<option value="maternity">Maternity</option>
																</select>
															</div>
														</div>
													</div>
													<div class="row">		
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Gender</label>
																<select class="form-control" iid="Gender" name="userdata[0][gender]" required>
																	<option value="">Select</option>
																	<option value="M">Male</option>
																	<option value="F">Female</option>
																	<option value="MF">Female- Merried</option>
																</select>
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
																		<button type="button" class="btn-accor btn-success tt addMemberBtn" style="display:none;margin: 10px 0;border-radius:10px;width:100%;" data-toggle="collapse" data-target="#add-input">Add Member</button>
																	</div>
																</div>
															</div>
															<div class="input_ll_add">
															</div>
													</div>
													</div>
													<div class="row">
													<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
														<ul class="nav nav-pills">
														  <li class="active"><a data-toggle="pill" href="#home">Home</a></li>
														  <li><a data-toggle="pill" href="#menu1">Menu 1</a></li>
														  <li><a data-toggle="pill" href="#menu2">Menu 2</a></li>
														</ul>

														<div class="tab-content">
														  <div id="home" class="tab-pane fade in active">
															<h3>HOME</h3>
															<p>Some content.</p>
														  </div>
														  <div id="menu1" class="tab-pane fade">
															<h3>Menu 1</h3>
															<p>Some content in menu 1.</p>
														  </div>
														  <div id="menu2" class="tab-pane fade">
															<h3>Menu 2</h3>
															<p>Some content in menu 2.</p>
														  </div>
														</div>
														</div>
													</div>
													<div class="form-group">
														<div class="row">
															<div class="col-sm-4 col-sm-offset-4">
																<input type="submit" name="register_me" tabindex="4" class="form-control btn btn-login" value="Filter Here!">
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
													$('input[value=Emp]').prop('checked', true);
														$('#toggle_event_editing button').click(function(){
															if($(this).hasClass('locked_active') || $(this).hasClass('unlocked_inactive')){
																/* code to do when unlocking */
																$(".tt").hide();
															}else{
																/* code to do when locking */
																 $(".tt").show();
															}
															var get_val = $(this).find('input[type=radio]').val(); 
															$('input[name=emptype]').prop('checked', false);  
															$('input[value='+get_val+']').prop('checked', true);
															
															/* reverse locking status */ 
															/* $('#toggle_event_editing button').eq(0).toggleClass('locked_inactive locked_active btn-default btn-info');
															$('#toggle_event_editing button').eq(1).toggleClass('unlocked_inactive unlocked_active btn-info btn-default'); */
														});
														
														$('.addMemberBtn').click(function(){
															
															var count = $('#input_ll_field').val();
															
															$('.input_ll_add').append('<div class="row"><div class="col-lg-4 col-sm-4 col-md-4 col-xs-12"><div class="form-group"><label>Name</label><input class="form-control" name="userdata['+ count +'][member_user_name]" type="text" placeholder="Name"></div></div><div class="col-lg-4 col-sm-4 col-md-4 col-xs-12"><div class="form-group input-group"><label>Date Of Birth</label><input class="form-control" name="userdata['+ count +'][dob]" id="datepicker'+ count +'" type="text" placeholder="dd-mm-yyyy"></div></div><div class="col-lg-4 col-sm-4 col-md-4 col-xs-12"><div class="form-group"><label>Gender</label><select class="changegen form-control" id="gender'+ count +'" name="userdata['+ count +'][gender]" ><option value="M"> Male </option><option value="F"> Female </option><option value="FM"> Female(MARRIED) </option><option value="MO"> Mother </option><option value="W"> Wife </option></select></div></div></div>');		
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
													<h1 class="pop_h1">Motor Insurance</h1>
													<h3>Vehicle Information :</h3>
													<div class="row">
													<?php //$get_cars = modules::load('module/controller/get_all_vehicle_info'); print_r($get_cars); ?>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Makers</label>
																 <select class="form-control" name="vehicle_name" id="vehicle_name" tabindex="-98">
																			<option value="">Select</option>
																			<option value="Ford">Ford</option>   
																			<option value="Chrysler">Chrysler</option>
																			<option value="Citroen">Citroen</option>
																			<option value="Hillman">Hillman</option>
																			<option value="Chevrolet">Chevrolet</option>
																			<option value="Cadillac">Cadillac</option>																			
																	</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Models</label>
																<select class="form-control" name="vehicle_models" id="vehicle_models" tabindex="-98">
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
													</div>
													<h3>Information Needed:</h3>
													<div class="row">
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Vehicle  Type</label>
																<select class="form-control" id="vehicletype" name="vehicletype" required>
																	<option value="">Select</option>
																	<option value="1">Buses(abv 15 seats)</option>
																	<option value="2">Heavy Vehicles</option>
																	<option value="3">Saloon</option>
																	<option value="4">Sports</option>
																	<option value="5">Stationwagon</option>
																	<option value="6">Vans,Buses(upto 15 seats)</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Year Of Registration</label>
																<select class="form-control" id="year_of_reg" name="year_of_reg">
																	<option value="">Select</option>
																	<option value="1985"> 1985</option>
																	<option value="1986"> 1986</option>
																	<option value="1987"> 1987</option>
																	<option value="1988"> 1988</option>
																	<option value="1989"> 1989</option>
																	<option value="1990"> 1990</option>
																	<option value="1991"> 1991</option>
																	<option value="1992"> 1992</option>
																	<option value="1993"> 1993</option>
																	<option value="1994"> 1994</option>
																	<option value="1995"> 1995</option>
																	<option value="1996"> 1996</option>
																	<option value="1997"> 1997</option>
																	<option value="1998"> 1998</option>
																	<option value="1999"> 1999</option>
																	<option value="2000"> 2000</option>
																	<option value="2001"> 2001</option>
																	<option value="2002"> 2002</option>
																	<option value="2003"> 2003</option>
																	<option value="2004"> 2004</option>
																	<option value="2005"> 2005</option>
																	<option value="2006"> 2006</option>
																	<option value="2007"> 2007</option>
																	<option value="2008"> 2008</option>
																	<option value="2009"> 2009</option>
																	<option value="2010"> 2010</option>
																	<option value="2011"> 2011</option>
																	<option value="2012"> 2012</option>
																	<option value="2013"> 2013</option>
																	<option value="2014"> 2014</option>
																	<option value="2015"> 2015</option>
																	<option value="2016"> 2016</option>
																</select>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Driving Licence</label>
																<select class="form-control" id="drving" name="Driving_Licence" required>
																	<<option value="" selected="selected">Select</option>
																	<option value="l6">less than 6 months</option>
																	<option value="1">1 year to 2 year</option>
																	<option value="2">2 year to 3 year</option>
																	<option value="A2">Above 2 years</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Driver Age</label>
																<select class="form-control" id="driver_age" name="driver_age" required>
																	<option value="">Select</option>
																	<option value="1">Less than 20</option>
																	<option value="2">20 to 25</option>
																	<option value="3">More than 25</option>
																</select>
																<div class="help-block with-errors"></div>
															</div>
														</div>
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Emirate of Registration</label>
																<select class="form-control" id="country_id" name="emirates" required>
																	<option value="">Select</option>
																	<option value="DUB">Dubai</option>
																	<option value="ABU">Abu Dhabi</option>
																	<option value="SHR">Sharjah</option>
																	<option value="RAK">Ras Al Khaimah</option>
																	<option value="AJM">Ajman</option>
																	<option value="FUI">Fujairah</option>
																	<option value="UAQ">Umm Al Quwain</option>
																</select>
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
														<!--<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group input-group">
																<label>Date Of Birth</label>
																<input type="text" id="datetimepicker4" name="birth_date" tabindex="2" class="form-control" placeholder="Date of Birth">
															</div>
														</div>-->
														
													</div>
													<div class="row">
														<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="text-align:center;margin-bottom:10px;">
															<div class="btn-group" id="toggle_event_editing_motor" >
																<label>Select Type</label><br>
																<button type="button" class="btn-accor btn-info locked_active">Comprehensive<input type="radio" name="type_check" value="comp" style="display:none;"/></button>
																<button type="button" class="btn-accor btn-default unlocked_inactive"> Third Party Liability<input type="radio" name="type_check" value="tpl" style="display:none;"/></button>
															</div>
														</div>
													</div>
													<div class="form-group moter">
														<div class="row">
															<!-- <div class="col-sm-4 col-sm-offset-4">
																<button type="button" class="btn-accor btn-success moter" style="display:none;margin: 10px 0;border-radius:10px;width:100%;" data-toggle="collapse" data-target="#add-input">Add Member</button>
															</div> -->
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
														<h3>Benifit Section</h3>
														<div class="row">
															<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
																<div class="form-group">
																	<label>Pay for Driver</label><br>
																	<label class="radio-inline">
																	  <input type="radio" name="PAB_driver" value="1"> Yes 
																	</label>
																	<label class="radio-inline">
																	  <input type="radio" name="PAB_driver" value="0" checked /> No
																	</label>
																</div>
															</div>
															<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
																<div class="form-group">
																	<label>Road Side Assitance</label><br>
																	<label class="radio-inline">
																	  <input type="radio" name="RSA" value="1"> Yes 
																	</label>
																	<label class="radio-inline">
																	  <input type="radio" name="RSA"  value="0" checked /> No
																	</label>
																</div>
															</div>
															<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
																<div class="form-group">
																	<label>Pab for passangers</label><br>
																	<label class="radio-inline">
																	  <input type="radio" name="PAB_passangers" value="1"> Yes 
																	</label>
																	<label class="radio-inline">
																	  <input type="radio" name="PAB_passangers" value="0" checked /> No
																	</label>
																	<div id="no_of_pass">
																		  <label for="country" > NO OF PASSANGERS :</label>
																		  <input type="text" name="PAB_passangers_txt" value="" id="PAB_passangers_txt" />
																	</div>
			  
																</div>
																
															</div>
															<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
																<div class="form-group">
																	<label>Rent A Car</label><br>
																	<label class="radio-inline">
																	  <input type="radio" name="ADD_rent_car" value="1"> Yes 
																	</label>
																	<label class="radio-inline">
																	  <input type="radio" name="ADD_rent_car" value="0" checked /> No
																	</label>
																</div>
															</div>
														</div>
													</div>
													
													<div class="form-group third-party">
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
													
													
													<div class="form-group">
														<div class="row">
															<div class="col-sm-4 col-sm-offset-4">
																<input type="submit" name="register_me" tabindex="4" class="form-control btn btn-login" value="Filter Here!">
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
													$(".moter").hide(); $('#no_of_pass').hide();
													$(".third-party").hide();
													$('#toggle_event_editing_motor button').click(function(){
														if($(this).hasClass('locked_active') || $(this).hasClass('unlocked_inactive')){
															/* code to do when unlocking */
															
														}
															var get_val = $(this).find('input[type=radio]').val(); 
															
															if(get_val == 'comp'){
																$(".moter").show();
																$(".third-party").hide();
															}else{
																$(".moter").hide();
																$(".third-party").show();
															}
															
															$('input[name=type_check]').prop('checked', false);  
															$('input[value='+get_val+']').prop('checked', true);
															
														/* reverse locking status */
														$('#toggle_event_editing_motor button').eq(0).toggleClass('locked_inactive locked_active btn-default btn-info');
														$('#toggle_event_editing_motor button').eq(1).toggleClass('unlocked_inactive unlocked_active btn-info btn-default');
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
        <div class="modal-dialog-full">
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
													<h1 class="pop_h1">Cleaning Insurance</h1>
													<h3>City Needed :</h3>
													<div class="row">
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>Emirate</label>
																<select class="form-control" id="emirateId" name="emirate" required>
																	<option value="" selected="">Select</option>
																	<option value="1">Abu Dabi</option>
																	<option value="2">Ajman</option>
																	<option value="3">Dubai</option>
																	<option value="4">Ras al-Khaymah</option>
																	<option value="5">Sharjah</option>
																	<option value="6">Sharjha</option>
																	<option value="7">Umm al Qaywayn</option>
																	<option value="8">al-Fujayrah</option>
																	<option value="9">ash-Shariqah</option>
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
													<h3>Information Needed:</h3>
													<div class="row">
														<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
															<div class="form-group">
																<label>NO Of Cleaners</label>
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
																<label>NO Of Hours</label>
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
																<label>Cleaning Per Month</label>
																<select class="form-control" id="cleanerfreq" name="cleanerfreq" required>
																	<option value="" selected="selected">Select</option>
																	<option value="1">1 Time Only</option>
																	<option value="2">2 Time Only</option>
																	<option value="4">4 Time Only</option>
																	<option value="8">8 Time Only</option>
																	<option value="12">12 Time Only</option>
																	<option value="15">15 Time Only</option>
																	<option value="30">Every Day</option>
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
																<input type="submit" name="register_me" tabindex="4" class="form-control btn btn-login" value="Filter Here!">
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
	
	<div id="errorbox" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
  <?php } ?>