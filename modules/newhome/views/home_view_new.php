<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>Register Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

		 <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/asset/css/reset.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/asset/css/supersized.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/asset/css/style.css">
		


        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<style>
		input[type=radio] { width:15px !important; margin-right:10px; height: 10px;}
		#consumerform label {margin-right:25px;}
		.title-text{ background:#e1e1e1 none repeat scroll 0 0;opacity:0.74;border: 3px solid gray;  border-radius: 45px; margin: 3%;  padding: 13px;}
		.coming-soon{  color: orangered;font-family: cursive;font-size: 41px;margin: 20px  auto; opacity:0.67;}
		.tt-text{ color: orangered;font-family: cursive;font-size: 44px;}
		.logo{ width:30%;margin-top: 18px; }
		.middle{ width:40%;margin-top: 18px; }
		.other_off{width:30%;float:right;color:#fff;font-weight: bold;margin-top:9%;font-size:larger;}
		.header1{ width: 100%;}
		.clock_hd{margin: 2% 25% 0;}
		.register-link{  color: orangered !important; font-size: 25px; font-weight:bold; margin: 0 auto; opacity: 0.67; padding: 15px;width: 220px;background: #fff none repeat scroll 0 0;
		border: 1px solid gray;cursor:pointer;border-radius: 35px;}}
		.modal-header .close{}
		.register-link > a { color: orangered;}.register-link > a:hover{color:orangered;}

		</style>

    </head>

    <body>
	<div class="container">
	<div class="row">
		<div class="header1">
		
			<div class="logo col-xs-12 col-lg-4">
				<img src="<?php echo base_url(); ?>/assets/asset/img/telus_new.png" title="TelUs Care" />
			</div>
			<div class="middle  col-xs-12 col-lg-4"> </div>
			<div class="other_off  col-xs-12 col-lg-4"> Need Help? +971 55825 2726 </div>
		</div>
	</div>
	<div class="row">
		<div class="title-text hidden-lg hidden-md">
			<div class="tt-text">Register Before 31st Dec 2016 and get up to  45% discount on Car Washing and Car Servicing or equivalent Coupon<span style="font-size:20px;">*</span> </div>
		</div>	
	</div>
	
	<div class="row">	
		<div class="register-link" data-toggle="modal" data-target="#myModal">
			<a href="#" >REGISTER HERE</a>
		</div>
	</div>
	
	<div class="row">	
		<div class="coming-soon">
			* COMING SOON *
		</div>
	</div>	
		
	</div>
       
		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" style="width:35px !important;">&times;</button>
				<h4 class="modal-title">Registration:</h4>
			  </div>
			  <div class="modal-body">
				<div class="tab-pane fade in active" id="Registration">
          	<form action="<?php echo base_url(); ?>/motorinsurance/userregister" method="post" id="motor_form2">
	        	<div class="calTabContent">
	        	
	            	<div class="row">
	                    <div class="col-md-12">
                        	<div class="row">
							 <div class="col-xs-12">
							   </div> 
                            <div class="col-xs-12">
                               <div class="form-group" id="vehicle_val">
		                        	<div class="fldContainer">
		                               <label class="frmLabel" id="vLabel">Name*</label>
		                               <input class="form-control" name="Name" id="Name" required="" type="text">
		                              
		                            </div>
		                        </div>
                             </div> 
							  <div class="col-md-3">
							   </div>
								</div>	
								 </div> 
							
					 </div> 
					 <div class="row">
							   	 <div class="col-md-3">
							   </div> 
								<div class="col-xs-12">
								   <div class="form-group" id="vehicle_val">
										<div class="fldContainer">
										   <label class="frmLabel" id="vLabel">Phone No*</label>
										   <input class="form-control" name="phone" id="phone" required="" type="text">
										  
										</div>
									</div>
								 </div> 
								  <div class="col-md-3">
								   </div> 
							</div>
						<div class="row">							   
							   	 <div class="col-md-3">
							   </div> 
                            <div class="col-xs-12">
                               <div class="form-group" id="vehicle_val">
		                        	<div class="fldContainer">
		                               <label class="frmLabel" id="vLabel">Email Id*</label>
		                               <input class="form-control" name="Email" id="Email" required="" type="email">
		                              
		                            </div>
		                        </div>
                             </div> 
							  <div class="col-md-3">
							   </div>
						</div> 
						<div class="row">							   
							   	 <div class="col-md-3">
							   </div> 
                            <div class="col-xs-12">
                               <div class="form-group" id="vehicle_val">
		                        	<div class="fldContainer">
		                               <label class="frmLabel" id="vLabel">Car Type</label>
		                               <!--<input type="text" class="form-control" name="cartype" id="cartype">-->
									   <div class="btn-group bootstrap-select form-control">
									   <select class="form-control" name="cartype" id="cartype" tabindex="-98">
									   <option value="">selected</option>
									   <option value="saloon">Saloon</option>
									    <option value="stationwagon">Stationwagon</option>
										 <option value="sports">Sports</option>
										  <option value="vans-buses-upto-15-seats">Vans,Buses(upto 15 seats)</option>
										   <option value="buses-abv-15-seats)">Buses(abv 15 seats)</option>
										    <option value="heavy-vehicles">Heavy Vehicles</option>
										    <option value="Others">Others</option>
									   </select></div>
		                              
		                            </div>
		                        </div>
                             </div> 
							  <div class="col-md-3">
							   </div> 
						</div> 
						 <div class="row">
							   	 <div class="col-md-3">
							   </div> 
                            <div class="col-xs-12">
                               <div class="form-group" id="vehicle_val">
		                        	<div class="fldContainer">
		                               <label class="frmLabel" id="vLabel">Renewal Month</label>
									   <select class="form-control" name="renewvaldate" id="renewvaldate" tabindex="-98">
									   <option value="">selected</option>
									   <option value="January">January</option>
									    <option value="February">February</option>
										 <option value="March">March</option>
										  <option value="April">April</option>
										   <option value="May">May</option>
										    <option value="June">June</option>
										    <option value="July">July</option>
										    <option value="August">August</option>
										    <option value="September">September</option>
										    <option value="Octomber">Octomber</option>
										    <option value="November">November</option>
										    <option value="December">December</option>
									   </select>
									</div>
		                        </div>
                             </div> 
							  <div class="col-md-3">
							   </div> 
						 </div> 
						<div class="row">
							   	 <div class="col-md-3">
							   </div> 
                            <!--<div class="col-xs-12">
                               <div class="form-group" id="vehicle_val">
		                        	<div class="fldContainer">
		                               <label class="frmLabel" id="vLabel">Location</label>
		                             
		                              <div class="btn-group bootstrap-select form-control">
									  <select class="form-control" name="Location" id="Location" tabindex="-98">
											<option value="" selected="selected">Select</option> 
											    <option value="Dubai">Dubai</option> 
											    <option value="Abu Dhabi">Abu Dhabi</option> 
											    <option value="Sharjah">Sharjah</option> 
											    <option value="Ras Al Khaimah">Ras Al Khaimah</option> 
											    <option value="Ajman">Ajman</option> 
											    <option value="Fujairah">Fujairah</option> 
											    <option value="Umm Al Quwain">Umm Al Quwain</option> 
		                                </select></div>
		                            </div>
		                        </div>
								</div> -->
								<div class="col-md-3">
							   </div> 
                        </div> 
							  
						<div class="row">
							   	 <div class="col-md-3">
							   </div> 
                            <div class="col-xs-12">
                               <div class="form-group" id="vehicle_val">
		                        	<div class="fldContainer">
		                               <label class="frmLabel" id="vLabel">Message</label>
		                               <input class="form-control" name="Message" id="Message" type="text">
		                              
		                            </div>
		                        </div>
                             </div>
							<div class="col-md-3">
							   </div> 							 
						</div> 
						 
							  <div class="col-md-3">
							   </div> 
							
                        <div class="row">
							<div class="col-md-3">
								   </div>    <div class="col-xs-12"><br> <input name="submit" class="btn btn-warning pull-right calBtncxc" style="width:120px;" value="Register" id="health_submitcc" type="submit"> </div> 
								  <div class="col-md-3">
								   </div> 
						</div> 
		         </div> 
			        	
					</form> 
				</div>
			  </div>
				 <!--  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div> -->
			</div>

		  </div>
		</div>
			
		<!--- FLIP CLOCK -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/asset/flipclock/compiled/flipclock.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
		
		<div class="clock_hd" ><div class="clock" style="margin:2em;"></div></div>

		<script type="text/javascript">
			var clock;
			
			$(document).ready(function() {
				// Set dates.
				var futureDate  = new Date("December 24, 2016 12:02 PM EDT");
				var currentDate = new Date();

				// Calculate the difference in seconds between the future and current date
				var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

				// Calculate day difference and apply class to .clock for extra digit styling.
				function dayDiff(first, second) {
					return (second-first)/(1000*60*60*24);
				}

				if (dayDiff(currentDate, futureDate) < 100) {
					$('.clock').addClass('twoDayDigits');
				} else {
					$('.clock').addClass('threeDayDigits');
				}

				if(diff < 0) {
					diff = 0;
				}

				// Instantiate a coutdown FlipClock
				clock = $('.clock').FlipClock(diff, {
					clockFace: 'DailyCounter',
					countdown: true
				});
			});
		</script>
		
		
        <!-- Javascript -->
        <script src="<?php echo base_url(); ?>/assets/asset/js/jquery-1.8.2.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/asset/js/supersized.3.2.7.min.js"></script>
        <script src="<?php echo base_url(); ?>/assets/asset/js/supersized-init.js"></script>
        <script src="<?php echo base_url(); ?>/assets/asset/js/scripts.js"></script>
		<script src="<?php echo base_url(); ?>/assets/asset/flipclock/compiled/flipclock.js"></script>
		
    </body>
	
<script>

$('document').ready(function(){
	
	$('#SBPform').hide();
	
	$('#Consumer').click(function(){
		$('#SBPform').hide();
		$('#SBPform').find('input').text('');
		$('#consumerform').show();
		
	});
	
	$('#SBP').click(function(){
		$('#consumerform').hide();
		$('#Consumer').find('input').text('');
		$('#SBPform').show();
	});
	
});

</script>
<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="width:25px;">&times;</button>
        <h4 class="modal-title">Thank You !</h4>
      </div>
      <div class="modal-body">
        <p> We will get back to you soon...</p>
      </div>
      
    </div>

  </div>
   <button type="button" id="successbtnsbmt" class="" data-toggle="modal" data-target="#myModal1"></button>
</div>
 

    <?php if($this->input->get('success') == true){ ?>
	<script>
    
	$(document).ready(function () {
	$('#successbtnsbmt').hide();
	
    $('#successbtnsbmt').click();
   
	});
	</script>
	
	<?php } ?>
    
</html>