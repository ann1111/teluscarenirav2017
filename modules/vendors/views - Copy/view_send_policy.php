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
  <?php // echo'<pre>'; print_r($motor_result);exit; ?>
  <?php if($health_result != ''){ ?>
			<div id="health" >
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
									<?php foreach($health_result as $key => $hb){ ?>
									<tr id="<?php echo $key; ?>">
										<td> <?php echo $hb['id']; ?> </td>
										<td> <?php echo $hb['Customer_name']; ?> </td>
										<td> <?php echo $hb['dob']; ?></td>
										<td> <?php echo $hb['gender']; ?></td>
										<td> <?php echo $hb['country_id']; ?></td>
										<td> <?php echo $hb['plan_id']; ?> </td>
										<td> <?php echo $hb['total_premium_val']; ?> </td>
										<td> <?php echo get_order_status_by_vendor_order_id($hb['id'],1); ?> </td>
										<td> <input type="submit" value="customer Docs" class="btn-success" data-toggle="modal" data-target="#myModalhealth"/> </td>
									</tr>
										<tr>		
											<?php echo form_open_multipart('vendors/myorders/order_insert', array('id' => 'multiformupload')); ?>
											<td> <input type="file" name="v_doc1" /></td>
											<td>
												<select name="order_status">
												<option value="1"> Pending </option> 	
												<option value="2"> Complete </option> 	
												<option value="3"> cancel </option> 	
												<option value="4"> Under-Process </option> 	
												</select>
											</td>
											<td> 
												<input type="hidden" name="o_id" value="<?php echo $hb['id']; ?>"> 
												<input type="hidden" name="user_id" value="<?php echo $hb['user_id']; ?>" />
												<input type="hidden" name="type" value="1"> 
												<input type="submit" value="Send policy Doc" name="submit_order" class="btn-warning"/> 
											</td>
											
											<?php echo form_close(); ?>
											
										</tr>
									<?php } ?>
							  </tbody>
								
							  </table>
						 </div>
					</div>
  <?php } ?>	
  
 <?php if($motor_result != ''){ ?>	
 <?php //echo'<pre>'; print_r($motor_result);exit; ?>	
				<div id="motor" >
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
								 
								  <?php foreach($motor_result as $key => $mi){ ?>
										
										 <?php //echo '<pre>'; print_r($mi); ?>
										<tr id="<?php echo $key; ?>">
											<td> <?php echo $mi['id']; ?> </td>
											<td> Name </td>
											<td> <?php echo $mi['service_type']; ?> </td>
											<td> <?php echo get_vehicle_type($mi['vehicle_type']); ?> </td>
											<td> <?php echo get_driver_licence($mi['driving_licence']); ?></td>
											<td> <?php echo get_driver_age($mi['driver_age']); ?></td>
											<td> <?php echo get_emirate_name($mi['r_emirate']); ?></td>
											<td> <?php echo get_gcc($mi['gcc']); ?> </td>
											<td> <?php echo get_agency_type($mi['agency_type']); ?> </td>
											<td> <?php echo $mi['current_year_value']; ?> </td>
											<td> <?php echo $mi['PAB_driver']; ?> </td>
											<td> <?php echo $mi['RSA']; ?> </td>
											<td> <?php echo $mi['PAB_passangers']; ?> </td>
											<td> <?php echo $mi['ADD_rent_car']; ?> </td>
											<td> <?php echo get_order_status_by_vendor_order_id($mi['id'],2); ?> </td>
											<td> <input type="submit" value="Customer Docs" class="btn-success"/> </td>
											<td> <input type="submit" value="Send policy Doc" class="btn-primary"/> </td>
										</tr>
										<tr>		
											<?php echo form_open_multipart('vendors/myorders/order_insert', array('id' => 'multiformupload')); ?>
											<td> <input type="file" name="v_doc1" /></td>
											<td>
												<select name="order_status">
												<option value="1"> Pending </option> 	
												<option value="2"> Complete </option> 	
												<option value="3"> cancel </option> 	
												<option value="4"> Under-Process </option> 	
												</select>
											</td>
											<td> 
												<input type="hidden" name="o_id" value="<?php echo $mi['id']; ?>"> 
												<input type="hidden" name="user_id" value="<?php echo $mi['user_id']; ?>" />
												<input type="hidden" name="type" value="2"> 
												<input type="submit" value="Send policy Doc" name="submit_order" class="btn-warning"/> 
											</td>
											
											<?php echo form_close(); ?>
											
										</tr>
										
										<?php } ?>
				
									</tbody>
									<tr></tr>
								  </table>
							 </div>
							 
						</div>	
					
	<?php } ?>	
					
  <?php if($cleaning_result != ''){ ?>
 <?php //echo '<pre>'; print_r($cleaning_result); exit; ?>	

						<div id="cleaning" >
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
								  
								  <?php foreach($cleaning_result as $key => $cs){ ?>
										<tr id="<?php echo $key; ?>">
											<td> <?php echo $cs['id']; ?> </td>
											<td> <?php echo get_cleaner_city_name($cs['emirate_id']); ?> </td>
											<td> <?php echo get_material_provided($cs['material_provided']); ?></td>
											<td> <?php echo get_number_of_cleaners($cs['noc']); ?></td>
											<td> <?php echo get_number_of_hours($cs['noh']); ?></td>
											<td> <?php echo get_type_of_premise($cs['frequency']); ?> </td>
											<td> <?php echo $cs['premises']; ?> </td>
											<td> <?php echo get_order_status_by_vendor_order_id($cs['id'],3); ?> </td>
										</tr>
										<tr>		
											<?php echo form_open_multipart('vendors/myorders/order_insert', array('id' => 'multiformupload')); ?>
											<td> <input type="file" name="v_doc1" /></td>
											<td>
												<select name="order_status">
												<option value="1"> Pending </option> 	
												<option value="2"> Complete </option> 	
												<option value="3"> cancel </option> 	
												<option value="4"> Under-Process </option> 	
												</select>
											</td>
											<td> 
												<input type="hidden" name="o_id" value="<?php echo $cs['id']; ?>"> 
												<input type="hidden" name="user_id" value="<?php echo $cs['user_id']; ?>" />
												<input type="hidden" name="type" value="3"> 
												<input type="submit" value="Send policy Doc" name="submit_order" class="btn-warning"/> 
											</td>
											
											<?php echo form_close(); ?>
											
										</tr>
										<?php } ?>
								  </tbody>
								<tr></tr>
							  </table>
						 </div>
						</div>
  <?php } ?>
	 <?php if($motorservicing_result != ''){ ?>					
			<div id="motorservice" >
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
							 <?php foreach($motorservicing_result as $key => $ms1){ ?>
								
								<tr id="<?php echo $key; ?>">
									<td> <?php echo $ms1['id']; ?> </td>
									<td> <?php echo get_vehicle_type($ms1['vehicle_type']); ?> </td>
									<td> <?php echo $ms1['make']; ?></td>
									<td> <?php echo $ms1['model']; ?></td>
									<td> <?php echo get_level_of_serv($ms1['level_of_services']); ?></td>
									<td> <?php echo $ms1['feature_of_services']; ?> </td>
									<td> <?php echo get_order_status_by_vendor_order_id($ms1['id'],4); ?> </td>
									<td> <input type="submit" value="Customer Docs" class="btn-success"/> </td>
									<td> <input type="submit" value="Send policy Doc" class="btn-primary"/> </td>
								</tr>
								<tr>		
									<?php echo form_open_multipart('vendors/myorders/order_insert', array('id' => 'multiformupload')); ?>
											<td> <input type="file" name="v_doc1" /></td>
											<td>
												<select name="order_status">
												<option value="1"> Pending </option> 	
												<option value="2"> Complete </option> 	
												<option value="3"> cancel </option> 	
												<option value="4"> Under-Process </option> 	
												</select>
											</td>
											<td> 
												<input type="hidden" name="o_id" value="<?php echo $ms1['id']; ?>"> 
												<input type="hidden" name="user_id" value="<?php echo $ms1['user_id']; ?>" />
												<input type="hidden" name="type" value="4"> 
												<input type="submit" value="Send policy Doc" name="submit_order" class="btn-warning"/> 
											</td>
											
											<?php echo form_close(); ?>
										</tr>
								<?php } ?>
							  </tbody>
								<tr></tr>
							  </table>
						 </div>
						</div>				
			 <?php } ?>			
		<?php if($pestcontrol_result != ''){ ?>						
			<div id="pestcontrolervice" >
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
									<?php foreach($pestcontrol_result as $key => $pc1){ ?>
									
									<tr id="<?php echo $key; ?>">
										<td> <?php echo $pc1['id']; ?> </td>
										<td> <?php echo get_types_of_services($pc1['type_of_service']); ?> </td>
										<td> <?php echo get_type_of_premise($pc1['type_of_premise']); ?></td>
										<td> <?php echo get_kind_of_premise($pc1['kind_of_premises'],$pc1['type_of_premise']); ?></td>
										
										<td> <?php echo $pc1['booking_date']; ?> </td>
										<td> <?php echo get_order_status_by_vendor_order_id($pc1['id'],5); ?> </td>
										<td> <input type="submit" value="Customer Docs" class="btn-success" /> </td>
										<td> <input type="submit" value="Send policy Doc" class="btn-primary" /> </td>
									</tr>
									<tr>		
									<?php echo form_open_multipart('vendors/myorders/order_insert', array('id' => 'multiformupload')); ?>
											<td> <input type="file" name="v_doc1" /></td>
											<td>
												<select name="order_status">
												<option value="1"> Pending </option> 	
												<option value="2"> Complete </option> 	
												<option value="3"> cancel </option> 	
												<option value="4"> Under-Process </option> 	
												</select>
											</td>
											<td> 
												<input type="hidden" name="o_id" value="<?php echo $pc1['id']; ?>"> 
												<input type="hidden" name="user_id" value="<?php echo $pc1['user_id']; ?>" />
												<input type="hidden" name="type" value="5"> 
												<input type="submit" value="Send policy Doc" name="submit_order" class="btn-warning"/> 
											</td>
											
											<?php echo form_close(); ?>
									</tr>
									
									<?php } ?>
								  </tbody>
									<tr></tr>
							  </table>
						 </div>
						</div>			
		<?php } ?>			
						
		
				 

					 
		</div>
	
  
<?php $this->load->view("bottom_application");?>