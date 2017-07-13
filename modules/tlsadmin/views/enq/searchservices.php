<?php

$button='Search';
$button1='Search';

?>
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">Search Services</h4>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a></li>
                                    <li class="active"><?= $button1 ?> Services</li>
                                    
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
							
							
							<div class="col-lg-12">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b><?= $button?> Service</b></h4>
									<p class="text-muted font-13 m-b-30">
	                                    
	                                </p>
	                                
									<form class="form-horizontal" action="" method="post"  role="form"  data-parsley-validate novalidate >
										<div class="form-group">
											<label for="servicename" class="col-sm-2 control-label">Service Type*</label>
											<div class="col-sm-7">
										
											<select  name="servicetype" id="servicetype" required  class="form-control">
											<option>Select Services</option>
										    <option value="health-calculator">Health Insurance</option>
											<option value="motor-calculator">Motor Insurance</option>
											<option value="cleaning">Cleaning Services</option>
											<option value="motor-service-calculator">Vehicle Servicing</option>
											<option value="pest-control">Pest Controlling</option>
											</select>	</div>
								
										
										<div class="form-group">
										<br/><br/>
											<div class="col-sm-offset-4 col-sm-8" style="
    margin-top: 38px;
">
													<button type="submit" class="btn btn-primary waves-effect waves-light">
													<?php echo $button; ?>
												</button>
												<button type="reset" class="btn btn-default waves-effect waves-light m-l-5" onclick="history.go('-1')">
													Cancel
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
                      
            		</div> <!-- container -->
                               
                </div> <!-- content -->
				<script type="text/javascript">
			$(document).ready(function() {
				$('form').parsley();
				$('#new').addClass('active');
				$('#clist').removeClass('active');
			});
		</script>