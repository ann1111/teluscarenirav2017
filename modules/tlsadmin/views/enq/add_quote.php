<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12">
								<h4 class="page-title">Quote Booked</h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a>
									</li>
									<li class="active">
										Quote booked List
									</li>
									
									
									<select required="" class="form-control" id="addq" name="addq" data-parsley-id="8" onchange="gotoPage(this)">
									<option value="">Manage Products/Services</option>
									<option value="add_health_plan">Add Health Plan</option>
									<option value="2">Add Motor Plan</option>
									<option value="3">Add Cleaning Services</option>
									<option value="4">Add Motor Services</option>
									<option value="5">Add Pest Control Service</option>
									</select>
									
								</ol>
							</div>
						</div>

                        

                        


                    </div> <!-- container -->
                               
                </div> <!-- content -->
				<script type="text/javascript">
				function gotoPage(select){
					window.location = select.value;
				}
				</script>