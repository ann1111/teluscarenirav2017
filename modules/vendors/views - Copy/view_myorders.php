<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<style type="text/css">
	.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
	.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
	.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
	.tg .tg-s6z2{text-align:center}
	.tg .tg-spn1{background-color:#f9f9f9;text-align:center}
	.tg .tg-4eph{background-color:#f9f9f9}
	.success{  font-size: 20px;  margin: 0 0 0 500px; color:green;}
</style>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>My Account</strong></span></div>
  </div>
</div>
<div class="wrapper pt20">
  <?php $this->load->view('vendors/top_links');?>
  <?php error_message();?>
  <div class="cb"></div>
  <div class="w80 auto mt70">
	
  </div>
</div>
  
  <div class="wrapper">
 
		<div class="tab-pane fade in" id="tabs">
				  <!-- <h3>This is tab 2</h3> -->
				  <ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#health">Health</a></li>
					<li><a data-toggle="tab" href="#motor">Motor</a></li>
					<li><a data-toggle="tab" href="#cleaning">Cleaning</a></li>
					<li><a data-toggle="tab" href="#motorservice">Motorservicing</a></li>
					<li><a data-toggle="tab" href="#pestcontrolervice">PestControlService</a></li>
				  </ul>

					  <div class="tab-content">
						<div id="health" class="tab-pane fade in active">
						  <h3>Health Insurance</h3>
						  <div class="table-responsive">
							  <table class="table-dash table table-hover">
							  <thead>
									<tr>
									<td> Order Id </td>
									<td> Customer Name </td>
									<td> Date Of Birth</td>
									<td> Gender</td>
									<td> Country</td>
									<td> Plan </td>
									<td> Total Premium Value </td>
									<td> Policy Status </td>
									<td> Customer docs </td>
									<td>  </td>
									</tr>
							  </thead>
							  <tbody>
									<?php // echo'<pre>'; print_r($health_books);exit; ?>
									<?php foreach($health_books as $key => $hb){ ?>
									<?php foreach($hb as $hb1){ ?>
									
									<tr id="<?php echo $key; ?>">
										<td> <?php echo $hb1['id']; ?> </td>
										<td> <?php echo $hb1['Customer_name']; ?> </td>
										<td> <?php echo $hb1['dob']; ?></td>
										<td> <?php echo $hb1['gender']; ?></td>
										<td> <?php echo $hb1['country_id']; ?></td>
										<td> <?php echo $hb1['plan_id']; ?> </td>
										<td> <?php echo $hb1['total_premium_val']; ?> </td>
										<td> <?php echo get_order_status_by_vendor_order_id($hb1['id'],1); ?> </td>
										<td> <input type="submit" value="customer Docs" class="btn-success" /> </td>
										<td><?php echo form_open_multipart('vendors/myorders/send_policy', array('id' => 'multiformupload')); ?>
											<input type="hidden" name="c" value="<?php echo $key; ?>"> 
											<input type="hidden" name="o" value="<?php echo $hb1['id']; ?>"> 
											<input type="hidden" name="t" value="1"> 
											<input type="submit" value="Send policy Doc" class="btn-primary"/> 
											<?php echo form_close(); ?>	</td>
									</tr>
									<tr >
								<?php if($hb1['doc1'] != ''){ ?>
										<td>
							<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>
										<input type="hidden" name="doc1" value="<?php echo $hb1['doc1']; ?>"> 
										<input type="submit" value="Download doc 1" class="btn-primary"/>
							<?php echo form_close(); ?>
										</td> 
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($hb1['doc2'] != ''){ ?>
										<td>
						<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>			<input type="hidden" name="doc2" value="<?php echo $hb1['doc2']; ?>">
										<input type="submit" value="Download doc 2" class="btn-primary"/>
									<?php echo form_close(); ?>
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($hb1['doc3'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $hb1['doc3']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									</tr>
									<?php } ?>
									
									<?php } ?>
							  </tbody>
								
							  </table>
						 </div>
					</div>
						<div id="motor" class="tab-pane fade">
						  <h3>Motor Insurance</h3>
							  <div class="table-responsive">
								  <table class="table-dash table table-hover">
									<caption>Comprehensive :</caption>
								  <thead>
										<tr>
											<td> Order Id </td>
											<td> Customer Name </td>
											<td> Service type </td>
											<td> Vehicle type </td>
											<td> Driver Licence</td>
											<td> Driver Age</td>
											<td> Emirate</td>
											<td> GCC</td>
											<td> Agency Type </td>
											<td> Current Year Value </td>
											<td> PAB Driver </td>
											<td> RSA </td>
											<td> PAB Passangers </td>
											<td> Rent Car </td>
											<td> Order Status </td>
											<td> Customer docs </td>
										</tr>
								  </thead>
								  <tbody>
								 
								  <?php foreach($motor_books as $key => $mi){ ?>
										<?php foreach($mi as $mi1){ ?>
										 <?php //echo '<pre>'; print_r($mi1); ?>
										<tr id="<?php echo $key; ?>">
											<td> <?php echo $mi1['id']; ?> </td>
											<td> Name </td>
											<td> <?php echo $mi1['service_type']; ?> </td>
											<td> <?php echo get_vehicle_type($mi1['vehicle_type']); ?> </td>
											<td> <?php echo get_driver_licence($mi1['driving_licence']); ?></td>
											<td> <?php echo get_driver_age($mi1['driver_age']); ?></td>
											<td> <?php echo get_emirate_name($mi1['r_emirate']); ?></td>
											<td> <?php echo get_gcc($mi1['gcc']); ?> </td>
											<td> <?php echo get_agency_type($mi1['agency_type']); ?> </td>
											<td> <?php echo $mi1['current_year_value']; ?> </td>
											<td> <?php echo $mi1['PAB_driver']; ?> </td>
											<td> <?php echo $mi1['RSA']; ?> </td>
											<td> <?php echo $mi1['PAB_passangers']; ?> </td>
											<td> <?php echo $mi1['ADD_rent_car']; ?> </td>
											<td> <?php echo get_order_status_by_vendor_order_id($mi1['id'],2); ?> </td>
											<td> <input type="submit" value="Customer Docs" class="btn-success"/> </td>
											<td><?php echo form_open_multipart('vendors/myorders/send_policy', array('id' => 'multiformupload')); ?>
											<input type="hidden" name="c" value="<?php echo $key; ?>"> 
											<input type="hidden" name="o" value="<?php echo $mi1['id']; ?>"> 
											<input type="hidden" name="t" value="2"> 
											<input type="submit" value="Send policy Doc" class="btn-primary"/> 
											<?php echo form_close(); ?>		</td>
										</tr>
										<tr>
								<?php if($mi1['doc1'] != ''){ ?>
										<td>
							<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>
										<input type="hidden" name="doc1" value="<?php echo $mi1['doc1']; ?>"> 
										<input type="submit" value="Download doc 1" class="btn-primary"/>
							<?php echo form_close(); ?>
										</td> 
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($mi1['doc2'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>			<input type="hidden" name="doc2" value="<?php echo $mi1['doc2']; ?>">
										<input type="submit" value="Download doc 2" class="btn-primary"/>
									<?php echo form_close(); ?>
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($mi1['doc3'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $mi1['doc3']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									</tr>
										<?php } ?>
										<?php } ?>
				
									</tbody>
									<tr></tr>
								  </table>
							 </div>
							 
						</div>
						<div id="cleaning" class="tab-pane fade">
						  <h3>CLEANING SERVICE</h3>
						   <div class="table-responsive">
							  <table class="table-dash table table-hover">
							  <thead>
									<tr>
										<td> Order Id </td>
										<td> Emirate Id </td>
										<td> Material Provided</td>
										<td> No Of Cleaners</td>
										<td> No Of Hours</td>
										<td> Frequency </td>
										<td> Premises </td>
										<td> Policy Status </td>
										<td> Customer docs </td>
										<td>  </td>
									</tr>
							  </thead>
							  <tbody>
							  <?php foreach($cleaning_books as $key => $cs){ ?>
									<?php foreach($cs as $cs1){ ?>
									
									<tr id="<?php echo $key; ?>">
										<td> <?php echo $cs1['id']; ?> </td>
										<td> <?php echo get_cleaner_city_name($cs1['emirate_id']); ?> </td>
										<td> <?php echo get_material_provided($cs1['material_provided']); ?></td>
										<td> <?php echo get_number_of_cleaners($cs1['noc']); ?></td>
										<td> <?php echo get_number_of_hours($cs1['noh']); ?></td>
										<td> <?php echo get_type_of_premise($cs1['frequency']); ?> </td>
										<td> <?php echo $cs1['premises']; ?> </td>
										<td> <?php echo get_order_status_by_vendor_order_id($cs1['id'],3); ?>  </td>
										<td> <input type="submit" value="Customer Docs" class="btn-success"/> </td>
										<td>
									<td><?php echo form_open_multipart('vendors/myorders/send_policy', array('id' => 'multiformupload')); ?>
									<input type="hidden" name="c" value="<?php echo $key; ?>"> 
									<input type="hidden" name="o" value="<?php echo $cs1['id']; ?>"> 
									<input type="hidden" name="t" value="3"> 
									<input type="submit" value="Send policy Doc" class="btn-primary"/> 
									<?php echo form_close(); ?>		</td>
									</tr>
									<tr>
								<?php if($cs1['doc1'] != ''){ ?>
										<td>
							<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>
										<input type="hidden" name="doc1" value="<?php echo $cs1['doc1']; ?>"> 
										<input type="submit" value="Download doc 1" class="btn-primary"/>
							<?php echo form_close(); ?>
										</td> 
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($cs1['doc2'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>			<input type="hidden" name="doc2" value="<?php echo $cs1['doc2']; ?>">
										<input type="submit" value="Download doc 2" class="btn-primary"/>
									<?php echo form_close(); ?>
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($cs1['doc3'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $cs1['doc3']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									</tr>
									<?php } ?>
									
									<?php } ?>
				
							  </tbody>
								<tr></tr>
							  </table>
						 </div>
						</div>
						
						<div id="motorservice" class="tab-pane fade">
						  <h3>MOTOR SERVICING</h3>
						   <div class="table-responsive">
							  <table class="table-dash table table-hover">
							  <thead>
									<tr>
										<td> Order Id </td>
										<td> Vehicle Type </td>
										<td> Maker</td>
										<td> Model</td>
										<td> Level Of Servicing</td>
										<td> Feature Of Servicing </td>
										<td> Policy Status </td>
										<td> Customer docs </td>
										<td>  </td>
									</tr>
							  </thead>
							  <tbody>
							 <?php foreach($motorservicing_books as $key => $ms){ ?>
								<?php foreach($ms as $ms1){ ?>
								
								<tr id="<?php echo $key; ?>">
									<td> <?php echo $ms1['id']; ?> </td>
									<td> <?php echo get_vehicle_type($ms1['vehicle_type']); ?> </td>
									<td> <?php echo $ms1['make']; ?></td>
									<td> <?php echo $ms1['model']; ?></td>
									<td> <?php echo get_level_of_serv($ms1['level_of_services']); ?></td>
									<td> <?php echo $ms1['feature_of_services']; ?> </td>
									<td> <?php echo get_order_status_by_vendor_order_id($ms1['id'],4); ?>  </td>
									<td> <input type="submit" value="Customer Docs" class="btn-success"/> </td>
									<td><?php echo form_open_multipart('vendors/myorders/send_policy', array('id' => 'multiformupload')); ?>
											<input type="hidden" name="c" value="<?php echo $key; ?>"> 
											<input type="hidden" name="o" value="<?php echo $ms1['id']; ?>"> 
											<input type="hidden" name="t" value="4"> 
											<input type="submit" value="Send policy Doc" class="btn-primary"/> 
											<?php echo form_close(); ?>	</td>
								</tr>
								<tr>
								<?php if($ms1['doc1'] != ''){ ?>
										<td>
							<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>
										<input type="hidden" name="doc1" value="<?php echo $ms1['doc1']; ?>"> 
										<input type="submit" value="Download doc 1" class="btn-primary"/>
							<?php echo form_close(); ?>
										</td> 
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($ms1['doc2'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>			<input type="hidden" name="doc2" value="<?php echo $ms1['doc2']; ?>">
										<input type="submit" value="Download doc 2" class="btn-primary"/>
									<?php echo form_close(); ?>
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($ms1['doc3'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $ms1['doc3']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($ms1['doc4'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $ms1['doc4']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($ms1['doc5'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $ms1['doc5']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($ms1['doc6'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $ms1['doc6']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($ms1['doc7'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $ms1['doc7']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($ms1['doc8'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $ms1['doc8']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									</tr>
								<?php } ?>
								<?php } ?>
							  </tbody>
								<tr></tr>
							  </table>
						 </div>
						</div>
						
						<div id="pestcontrolervice" class="tab-pane fade">
						  <h3>PEST CONTROL SERVICING</h3>
						   <div class="table-responsive">
							  <table class="table-dash table table-hover">
								  <thead>
										<tr>
											<td> Order Id </td>
											<td> Type Of Service </td>
											<td> Type Of Premise</td>
											<td> Kind Of Premises</td>
											<td> Booking Date </td>
											<td> Policy Status </td>
											<td> Customer docs </td>
											<td>  </td>
										</tr>
								  </thead>
								  <tbody>
									<?php foreach($pestcontrol_books as $key => $pc){ ?>
									<?php foreach($pc as $pc1){ ?>
									
									<tr id="<?php echo $key; ?>">
										<td> <?php echo $pc1['id']; ?> </td>
										<td> <?php echo get_types_of_services($pc1['type_of_service']); ?> </td>
										<td> <?php echo get_type_of_premise($pc1['type_of_premise']); ?></td>
										<td> <?php echo get_kind_of_premise($pc1['kind_of_premises'],$pc1['type_of_premise']); ?></td>
										
										<td> <?php echo $pc1['booking_date']; ?> </td>
										<td> <?php echo get_order_status_by_vendor_order_id($pc1['id'],5); ?> </td>
										<td> <input type="submit" value="Customer Docs" class="btn-success" /> </td>
										<td><?php echo form_open_multipart('vendors/myorders/send_policy', array('id' => 'multiformupload')); ?>
											<input type="hidden" name="c" value="<?php echo $key; ?>"> 
											<input type="hidden" name="o" value="<?php echo $pc1['id']; ?>"> 
											<input type="hidden" name="t" value="5"> 
											<input type="submit" value="Send policy Doc" class="btn-primary"/> 
											<?php echo form_close(); ?>	</td>
									</tr>
									<tr>
									<?php if($pc1['doc1'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $pc1['doc1']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									<?php if($pc1['doc2'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $pc1['doc2']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary"/></td>
									<?php } ?>
									
									</tr>
									<?php } ?>
									<?php } ?>
								  </tbody>
									<tr></tr>
							  </table>
						 </div>
						</div>
					  </div>
		</div>
	</div>

<?php $this->load->view("bottom_application");?>