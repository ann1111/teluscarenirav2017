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
  
  <div class="wrapper border2">
 
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
							  <table class="table-dash table table-hover panel-group" id="accordion">
								  <thead>
										<tr>
											<th>Order Id</th>
											<th>Customer Name</th>
											<th>Date Of Birth</th>
											<th>Gender</th>
											<th>Country</th>
											<th>Plan</th>
											<th>Total Premium Value</th>
											<th>Policy Status</th>
											<th>Customer docs</th>
											<th>Policy</th>
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
										<td> <input data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $hb1['id']; ?>" type="submit" value="Customer Docs" class="btn-primary btn_document" /> </td>
										<td><?php echo form_open_multipart('vendors/myorders/send_policy', array('id' => 'multiformupload')); ?>
											<input type="hidden" name="c" value="<?php echo $key; ?>"> 
											<input type="hidden" name="o" value="<?php echo $hb1['id']; ?>"> 
											<input type="hidden" name="t" value="1"> 
											<input type="submit" value="Send policy Doc" class="btn-success btn_document"/> 
											<?php echo form_close(); ?>	</td>
									</tr>
									<tr id="collapse<?php echo $hb1['id']; ?>" class="panel-collapse collapse">
								<?php if($hb1['doc1'] != ''){ ?>
										<td>
							<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>
										<input type="hidden" name="doc1" value="<?php echo $hb1['doc1']; ?>"> 
										<input type="submit" value="Download doc 1" class="btn-primary btn_document"/>
							<?php echo form_close(); ?>
										</td> 
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($hb1['doc2'] != ''){ ?>
										<td>
						<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>			<input type="hidden" name="doc2" value="<?php echo $hb1['doc2']; ?>">
										<input type="submit" value="Download doc 2" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>
										</td>
									<?php }else{ ?>
									<td class="panel-body"><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($hb1['doc3'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $hb1['doc3']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
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
								  <table class="table-dash table table-hover panel-group" id="accordion1">
									<caption>Comprehensive :</caption>
								  <thead>
										<tr>
											<th>Order Id</th>
											<th>Customer Name</th>
											<th>Service type</th>
											<th>Vehicle type</th>
											<th>Driver Licence</th>
											<th>Driver Age</th>
											<th>Emirate</th>
											<th>GCC</th>
											<th>Agency Type</th>
											<th>Current Year Value</th>
											<th>PAB Driver</th>
											<th>RSA</th>
											<th>PAB Passangers</th>
											<th>Rent Car</th>
											<th>Order Status</th>
											<th>Customer docs</th>
											<th>Policy Send</th>
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
											<td> <input data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $mi1['id']; ?>" type="submit" value="Customer Docs" class="btn-primary btn_document"/> </td>
											<td><?php echo form_open_multipart('vendors/myorders/send_policy', array('id' => 'multiformupload')); ?>
											<input type="hidden" name="c" value="<?php echo $key; ?>"> 
											<input type="hidden" name="o" value="<?php echo $mi1['id']; ?>"> 
											<input type="hidden" name="t" value="2"> 
											<input type="submit" value="Send policy Doc" class="btn-success btn_document"/> 
											<?php echo form_close(); ?>		</td>
										</tr>
										<tr id="collapse<?php echo $mi1['id']; ?>" class="panel-collapse collapse">
								<?php if($mi1['doc1'] != ''){ ?>
										<td>
							<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>
										<input type="hidden" name="doc1" value="<?php echo $mi1['doc1']; ?>"> 
										<input type="submit" value="Download doc 1" class="btn-primary btn_document"/>
							<?php echo form_close(); ?>
										</td> 
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($mi1['doc2'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>			<input type="hidden" name="doc2" value="<?php echo $mi1['doc2']; ?>">
										<input type="submit" value="Download doc 2" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($mi1['doc3'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $mi1['doc3']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
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
							  <table class="table-dash table table-hover panel-group" id="accordion2">
							  <thead>
									<tr>
										<th>Order Id</th>
										<th>Emirate Id</th>
										<th>Material Provided</th>
										<th>No Of Cleaners</th>
										<th>No Of Hours</th>
										<th>Frequency</th>
										<th>Premises</th>
										<th>Policy Status</th>
										<th>Customer docs</th>
										<th>Policy Send</th>
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
										<td> <input data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $cs1['id']; ?>" type="submit" value="Customer Docs" class="btn-primary btn_document"/> </td>
										<td><?php echo form_open_multipart('vendors/myorders/send_policy', array('id' => 'multiformupload')); ?>
										<input type="hidden" name="c" value="<?php echo $key; ?>"> 
										<input type="hidden" name="o" value="<?php echo $cs1['id']; ?>"> 
										<input type="hidden" name="t" value="3"> 
										<input type="submit" value="Send policy Doc" class="btn-success btn_document"/> 
										<?php echo form_close(); ?>		</td>
									</tr>
									<tr id="collapse<?php echo $cs1['id']; ?>" class="panel-collapse collapse">
								<?php if($cs1['doc1'] != ''){ ?>
										<td>
							<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>
										<input type="hidden" name="doc1" value="<?php echo $cs1['doc1']; ?>"> 
										<input type="submit" value="Download doc 1" class="btn-primary btn_document"/>
							<?php echo form_close(); ?>
										</td> 
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($cs1['doc2'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>			<input type="hidden" name="doc2" value="<?php echo $cs1['doc2']; ?>">
										<input type="submit" value="Download doc 2" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($cs1['doc3'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $cs1['doc3']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
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
							  <table class="table-dash table table-hover panel-group" id="accordion3">
							  <thead>
									<tr>
										<th>Order Id</th>
										<th>Vehicle Type</th>
										<th>Maker</th>
										<th>Model</th>
										<th>Level Of Servicing</th>
										<th>Feature Of Servicing</th>
										<th>Policy Status</th>
										<th>Customer docs </th>
										<th>Policy Send</th>
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
									<td> <input data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $ms1['id']; ?>" type="submit" value="Customer Docs" class="btn-primary btn_document"/> </td>
									<td><?php echo form_open_multipart('vendors/myorders/send_policy', array('id' => 'multiformupload')); ?>
											<input type="hidden" name="c" value="<?php echo $key; ?>"> 
											<input type="hidden" name="o" value="<?php echo $ms1['id']; ?>"> 
											<input type="hidden" name="t" value="4"> 
											<input type="submit" value="Send policy Doc" class="btn-success btn_document"/> 
											<?php echo form_close(); ?>	</td>
								</tr>
								<tr id="collapse<?php echo $ms1['id']; ?>" class="panel-collapse collapse">
								<?php if($ms1['doc1'] != ''){ ?>
										<td>
							<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>
										<input type="hidden" name="doc1" value="<?php echo $ms1['doc1']; ?>"> 
										<input type="submit" value="Download doc 1" class="btn-primary btn_document"/>
							<?php echo form_close(); ?>
										</td> 
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($ms1['doc2'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>			<input type="hidden" name="doc2" value="<?php echo $ms1['doc2']; ?>">
										<input type="submit" value="Download doc 2" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($ms1['doc3'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $ms1['doc3']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($ms1['doc4'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $ms1['doc4']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($ms1['doc5'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $ms1['doc5']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($ms1['doc6'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $ms1['doc6']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($ms1['doc7'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $ms1['doc7']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($ms1['doc8'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $ms1['doc8']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
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
							  <table class="table-dash table table-hover panel-group" id="accordion4">
								  <thead>
										<tr>
											<th>Order Id</td>
											<th>Type Of Service</th>
											<th> Type Of Premise</th>
											<th> Kind Of Premises</th>
											<th> Booking Date </th>
											<th> Policy Status </th>
											<th> Customer docs </th>
											<th>Policy Send</th>
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
										<td> <input data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $pc1['id']; ?>" type="submit" value="Customer Docs" class="btn-primary btn_document" /> </td>
										<td><?php echo form_open_multipart('vendors/myorders/send_policy', array('id' => 'multiformupload')); ?>
											<input type="hidden" name="c" value="<?php echo $key; ?>"> 
											<input type="hidden" name="o" value="<?php echo $pc1['id']; ?>"> 
											<input type="hidden" name="t" value="5"> 
											<input type="submit" value="Send policy Doc" class="btn-success btn_document"/> 
											<?php echo form_close(); ?>	</td>
									</tr>
									<tr id="collapse<?php echo $pc1['id']; ?>" class="panel-collapse collapse">
									<?php if($pc1['doc1'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $pc1['doc1']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
									<?php } ?>
									<?php if($pc1['doc2'] != ''){ ?>
										<td>
								<?php echo form_open_multipart('vendors/myorders/download', array('id' => 'multiformupload')); ?>	<input type="hidden" name="doc3" value="<?php echo $pc1['doc2']; ?>">
										<input type="submit" value="Download doc 3" class="btn-primary btn_document"/>
									<?php echo form_close(); ?>	
										</td>
									<?php }else{ ?>
									<td><input type="button" value="No Doc 2 Download" class="btn-primary btn_document"/></td>
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