<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>

<?php
 if($this->uri->uri_string == 'vendors/myaccount')
  { 
  ?>

<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>My Account</strong></span></div>
  </div>
</div>
<div class="wrapper pt20 pb20" style="min-height:300px;">
  <?php $this->load->view('members/top_links');?>
  <?php error_message();?>
  <div class="cb"></div>
  <div class="w80 auto mt70">
	<p class="fs32 ac black weight300 ttu">Welcome to Assurance Solutions!!!</p>
	<p class="fs16 b ac mt20 mb70 ttu">-: Account Stats :-</p>
	<div class="fl my_circle ac weight300 fs18 black bg1 ml42 trans_eff">
	  <p class="red pt60 fs51"><?php echo $total_confirmed_inquiry;?></p>
	  <p class="mt15 p10 fs24 lht-28">Confirmed
Quotations</p>
	</div>
	<div class="fl my_circle ac weight300 fs18 black ml50 bg5 trans_eff">
	  <p class="red pt60 fs51"><?php echo $total_admin_tenders;?></p>
	  <p class="mt15 p10 fs24 lht-28">Tenders to 
Admin</p>
	</div>
	<div class="fl my_circle ac weight300 fs18 black ml50 bg1 trans_eff">
	  <p class="red pt60 fs51">0</p>
	  <p class="mt15 p10 fs24 lht-28">Successfull 
Payment</p>
	</div>
	<a href="members/member_save"><div class="fl my_circle ac weight300 fs18 black ml50 bg1 trans_eff">
	  <p class="red pt60 fs51"><?php echo $member_saves; ?></p>
	  <p class="mt15 p10 fs24 lht-28">Services</br>
SAVED</p>
	</div></a>
	<a href="members/member_book" ><div class="fl my_circle ac weight300 fs18 black ml50 bg1 trans_eff">
	  <p class="red pt60 fs51"><?php echo $member_booked; ?></p>
	  <p class="mt15 p10 fs24 lht-28">Services 
BOOKED</p>
	</div></a>
	<div class="cb pb30 mb50"></div>
  </div>
</div>
<?php
if(is_array($recent_inquiry) && !empty($recent_inquiry))
{
?>
  <div class="bg-gray1 bt minmax"> <img src="<?php echo theme_url();?>images/rq.png" class="db auto" style="margin-top:-16px" alt="">
	<div class="wrapper">
	  <?php
	  foreach($recent_inquiry as $key=>$val)
	  {
		$exclass= $key > 0 ? 'ml18' : '';

		$dtl_link = base_url().'members/quotes/quote_details/'.$val['quotation_id'];

		$prod_link = base_url().$val['friendly_url'];
	  ?>
		<div class="mt20 fl w32 <?php echo $exclass;?>">
		  <p><i class="orange">Request for :</i> <br>
		  <?php
		  if($val['status']=='1' && $val['user_status']=='1')
		  {
		  ?>
			<b class="blue"><a href="<?php echo $prod_link;?>" class="uu b" target="_blank"><?php echo $val['prod_title'];?></a></b>
		  <?php
		  }
		  else
		  {
		  ?>
			<b class="blue"><?php echo $val['prod_title'];?></b><span class="red">(<?php echo ($val['status']==2 || $val['user_status']==2) ? 'Deleted' : 'Inactive';?>)</span>
		  <?php
		  }
		  ?>
		  </p>
		  <p>Type : <b><?php echo get_product_type($val['prod_type']);?></b></p>
		  <div class="mt10 fs12 lht-14"><?php echo char_limiter($val['comments'],200);?> <a href="<?php echo $dtl_link;?>" title="More" class="uu">More&raquo;</a></div>
		  <a href="<?php echo $dtl_link;?>#reply" class="btn1s mt10 radius-3 trans_eff" title="View Replies">View Replies</a>
		</div>
	  <?php
	  }
	  ?>
	  <div class="cb"></div>
	  <p class="b orange fs14 mt25"><a href="<?php echo base_url();?>members/quotes" class="uu" title="View All Requests">View All Requests&raquo;</a></p>
	</div>
	<div class="mt35" style="border-bottom:3px solid #e79721"></div>
  </div>
<?php
}
?>

  <?php }else{ ?>

<?php
$address_arr = array();
if($this->mres['address']!='')
{
  array_push($address_arr,$this->mres['address']);
}
if($this->mres['city']!='')
{
  array_push($address_arr,$this->mres['city']);
}
if($this->mres['state']!='')
{
  array_push($address_arr,$this->mres['state']);
}
if($this->mres['zipcode']!='')
{
  array_push($address_arr," - ".$this->mres['zipcode']);
}
if($this->mres['country']!='')
{
  array_push($address_arr,$this->mres['country']);
}
$address = implode(",",$address_arr);
$address = preg_replace("~(,\s*-)~"," -",$address);
?>


<div class="container">
	  <div class="col-lg-12 col-sm-12">
		<div class="card hovercard">
			<div class="card-background">
				<img class="card-bkimg" alt="" src="<?php echo base_url(); ?>assets/newasset/image/9.jpg">
				<!-- http://lorempixel.com/850/280/people/9/ -->
			</div>
			<div class="useravatar">
				<img alt="" src="<?php echo base_url(); ?>assets/newasset/image/Avatar_girl_face.png">
			</div>
			<div class="card-info"> <span class="card-title"><?php echo trim(strtoupper($this->mres['first_name'].$this->mres['last_name'])); ?></span>

			</div>
		</div>
		<div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
			<div class="btn-group btn-border" role="group">
				<button type="button" id="stars" class="btn btn-primary" href="#my_account" data-toggle="tab"><span class="ion-person" aria-hidden="true"></span>
					<div>My Account</div>
				</button>
			</div>
			<div class="btn-group btn-border" role="group">
				<button type="button" id="favorites" class="btn btn-default" href="#my_save" data-toggle="tab"><span class="ion-briefcase" aria-hidden="true"></span>
					<div>My Save</div>
				</button>
			</div>
			<div class="btn-group btn-border" role="group">
				<button type="button" id="following" class="btn btn-default" href="#my_book" data-toggle="tab"><span class="ion-checkmark" aria-hidden="true"></span>
					<div>My Book</div>
				</button>
			</div>
			<div class="btn-group btn-border" role="group">
				<button type="button" id="following" class="btn btn-default" href="#my_orders" data-toggle="tab"><span class="ion-checkmark" aria-hidden="true"></span>
					<div>My Orders</div>
				</button>
			</div>
		</div>

			<div class="well-dash">
			  <div class="tab-content">
				
				<div class="tab-pane fade in active table-responsive" id="my_account">
				<table >
				   <tr><td><b>Name</b></td> <td><h4><?php echo trim($this->mres['first_name'].$this->mres['last_name']); ?> </h4></td></tr>
				    <tr><td><b>Address</b></td> <td><h4><?php echo $address; ?></h4></td></tr>
				    <tr><td><b>Mobile</b></td> <td><h4><?php echo formatCustomValue(array('val'=>$this->mres['mobile_number']));?></h4></td></tr>
				    <tr><td><b>Last Login</b></td> <td><h4>Last Login : 
							  <?php
							  if(!is_null($this->mres['last_login_date']) && $this->mres['last_login_date']!='0000-00-00 00:00:00')
							  {
								echo date("d/m/Y [h:iA]",strtotime($this->mres['last_login_date']));
							  }
							  else
							  {
								echo "-";
							  }
							  ?></h4></td></tr>
						<tr><td><h4><a href="<?php echo base_url();?>users/logout" ><img src="<?php echo theme_url();?>images/lgt2.png"  style="margin-right:10px;width:15px;" alt="" title="">Logout</a></h4></td> </tr>	  
				</table> 
				</div>
				<div class="tab-pane fade in" id="my_save">
				  <!-- <h3>This is tab 2</h3> -->
				  <ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#health">Health</a></li>
					<li><a data-toggle="tab" href="#motor">Motor</a></li>
					<li><a data-toggle="tab" href="#cleaning">Cleaning</a></li>
					<li><a data-toggle="tab" href="#MotorServicing">MotorServicing</a></li>
					<li><a data-toggle="tab" href="#pestcontrol">Pest Control</a></li>
				  </ul>

					  <div class="tab-content">
						<div id="health" class="tab-pane fade in active">
						  <h3>Health Insurance</h3>
						  <div class="table-responsive">
							  <table class="table-dash table table-hover">
							  <thead>
									<tr>
										<th>Customer Name</th>
										<th>Date Of Birth</th>
										<th>Gender</th>
										<th>Country</th>
										<th>PLan</th>
									</tr>
							  </thead>
							  <tbody>
								<?php foreach($save_data_health as $health){   ?>
									<tr>   
										<th>  <?php echo $health['Customer_name']; ?> </th>
										<th>  <?php echo $health['dob']; ?>   </th>
										<th>  <?php echo $health['gender']; ?>  </th>  
										<th>  <?php echo get_emirate_name($health['country_id']); ?>  </th> 
										<th>  <?php echo get_health_plan($health['plan_id']); ?>   </th> 
									</tr>
									<?php } ?>
							  </tbody>
								<tr></tr>
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
											<th>Vehicle Type</th>
											<th>Driving Licence</th>
											<th>Driver Age</th>
											<th>Emirates</th>
											<th>Gcc</th>
											<th>Agency Type</th>
										</tr>
								  </thead>
								  <tbody>
										<?php foreach($save_data_motor_tpl as $motor){  ?>
										<tr>   
											<th>  <?php echo get_vehicle_type($motor['vehicle_type']); ?>   </th>
											<th>  <?php echo get_driver_licence($motor['driving_licence']); ?>  </th>  
											<th>  <?php echo get_driver_age($motor['driver_age']); ?>  </th> 
											<th>  <?php echo get_emirate_name($motor['r_emirate']); ?>   </th> 
											<th>  <?php echo get_gcc($motor['gcc']); ?>   </th> 
											<th>  <?php echo get_agency_type($motor['agency_type']); ?>   </th> 
										</tr>
										<?php } ?>
								  </tbody>
									<tr></tr>
								  </table>
							 </div>
							 
							 <div class="table-responsive">
								  <table class="table-dash table table-hover">
									<caption>Third Party Liabilites :</caption>
								  <thead>
										<tr>
											<th>Vehicle Type</th>
											<th>Driving Licence</th>
											<th>Driver Age</th>
											<th>Emirates</th>
											<th>Gcc</th>
											<th>No of Cylinder</th>
										</tr>
								  </thead>
								  <tbody>
										<?php foreach($save_data_motor_tpl as $motortpl){   ?>
											<tr>   
												<th>  <?php echo get_vehicle_type($motortpl['vehicle_type']); ?>   </th>
												<th>  <?php echo get_driver_licence($motortpl['driving_licence']); ?>  </th>  
												<th>  <?php echo get_driver_age($motortpl['driver_age']); ?>  </th> 
												<th>  <?php echo get_emirate_name($motortpl['r_emirate']); ?>   </th> 
												<th>  <?php echo get_gcc($motortpl['gcc']); ?>   </th> 
												<th>  <?php echo get_no_cylinder($motortpl['noofcilender']); ?>   </th> 
											</tr>
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
										<th>Emirate</th>
										<th>Material Provided</th>
										<th>No Of Cleaners</th>
										<th>No Of Hours</th>
										<th>Frequency</th>
										<th>Premises</th>
										<th>Cleaning Date</th>
									</tr>
							  </thead>
							  <tbody>
									<?php foreach($save_data_cleaning as $cleaning){   ?>
									<tr>   
										<th>  <?php echo get_cleaner_city_name($cleaning['emirate_id']); ?>  </th>
										<th>  <?php echo get_material_provided($cleaning['material_provided']); ?>   </th>
										<th>  <?php echo get_number_of_cleaners($cleaning['noc']); ?>  </th>  
										<th>  <?php echo get_number_of_hours($cleaning['noh']); ?>  </th>  
										<th>  <?php echo get_frequency($cleaning['frequency']); ?>  </th>  
										<th>  <?php echo get_type_of_premise($cleaning['premises']); ?>  </th> 
										<th>  <?php echo $cleaning['cleaning_date']; ?>   </th> 
									</tr>
									<?php } ?>
							  </tbody>
								<tr></tr>
							  </table>
						 </div>
						</div>
						<div id="MotorServicing" class="tab-pane fade in active">
						  <h3>Motor Servicing</h3>
							  <div class="table-responsive">
								  <table class="table-dash table table-hover">
								  <thead>
										<tr>
											<th>Vehicle Type</th>
											<th>Maker</th>
											<th>Model</th>
											<th>Level Of Service</th>
											<th>Feature Of Service</th>
											<th>Booking Date</th>
										</tr>
								  </thead>
								  <tbody>
									<?php foreach($save_data_motor_services as $motorserv){   ?>
										<tr>   
											<th> <?php echo get_vehicle_type($motorserv['vehicle_type']); ?> </th>
											<th> <?php echo $motorserv['make']; ?></th>
											<th> <?php echo $motorserv['model']; ?></th>
											<th> <?php echo get_level_of_serv($motorserv['level_of_services']); ?></th>
											<th> <?php echo $motorserv['feature_of_services']; ?> </th>
											<th> <?php echo $motorserv['booking_date']; ?> </th>
										</tr>
									<?php } ?>
								  </tbody>
									<tr></tr>
								  </table>
							 </div>
						</div>
						<div id="pestcontrol" class="tab-pane fade in active">
						  <h3>Pest Control</h3>
							  <div class="table-responsive">
								  <table class="table-dash table table-hover">
								  <thead>
										<tr>
											<th>Type Of Service</th>
											<th>Type Of Premise</th>
											<th>Kind Of Premise</th>
											<th>Booking Date</th>
										</tr>
								  </thead>
								  <tbody>
									<?php foreach($save_data_pestcontrol as $pestc){   ?>
										<tr>   
											<th> <?php echo get_types_of_services($pestc['type_of_service']); ?> </th>
											<th> <?php echo get_type_of_premise($pestc['type_of_premise']); ?></th>
											<th> <?php echo get_kind_of_premise($pestc['kind_of_premises'],$pestc['type_of_premise']); ?></th>
											<th> <?php echo $pestc['booking_date']; ?> </th> 
										</tr>
										<?php } ?>
								  </tbody>
									<tr></tr>
								  </table>
							 </div>
						</div>
					  </div>
				</div>
				
				<div class="tab-pane fade in" id="my_book">
				  <!-- <h3>This is tab 2</h3> -->
				  <ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#health-book">Health</a></li>
					<li><a data-toggle="tab" href="#motor-book">Motor</a></li>
					<li><a data-toggle="tab" href="#cleaning-book">Cleaning</a></li>
					<li><a data-toggle="tab" href="#motorservicing-book">Motor Servicing</a></li>
					<li><a data-toggle="tab" href="#pestcontrol-book">Pest Control</a></li>
				  </ul>

					  <div class="tab-content">
						<div id="health-book" class="tab-pane fade in active">
						  <h3>Health Insurance</h3>
						  <div class="table-responsive">
							  <table class="table-dash table table-hover">
							  <thead>
									<tr>
										<th>Customer Name</th>
										<th>Date Of Birth</th>
										<th>Gender</th>
										<th>Country</th>
										<th>PLan</th>
									</tr>
							  </thead>
							  <tbody>
									<?php foreach($book_data_health as $health){   ?>
									<tr>   
										<th>  <?php echo $health['Customer_name']; ?> </th>
										<th>  <?php echo $health['dob']; ?>   </th>
										<th>  <?php echo $health['gender']; ?>  </th>  
										<th>  <?php echo get_emirate_name($health['country_id']); ?>  </th> 
										<th>  <?php echo get_health_plan($health['plan_id']); ?>   </th> 
									</tr>
									<?php } ?>
							  </tbody>
								<tr></tr>
							  </table>
						 </div>
						</div>
						<div id="motor-book" class="tab-pane fade">
						  <h3>Motor Insurance</h3>
							  <div class="table-responsive">
								  <table class="table-dash table table-hover">
									<caption>Comprehensive :</caption>
								  <thead>
										<tr>
											<th>Vehicle Type</th>
											<th>Driving Licence</th>
											<th>Driver Age</th>
											<th>Emirates</th>
											<th>Gcc</th>
											<th>Agency Type</th>
										</tr>
								  </thead>
								  <tbody>
										<?php foreach($book_data_motor_tpl as $motor){  ?>
										<tr>   
											<th>  <?php echo get_vehicle_type($motor['vehicle_type']); ?>   </th>
											<th>  <?php echo get_driver_licence($motor['driving_licence']); ?>  </th>  
											<th>  <?php echo get_driver_age($motor['driver_age']); ?>  </th> 
											<th>  <?php echo get_emirate_name($motor['r_emirate']); ?>   </th> 
											<th>  <?php echo get_gcc($motor['gcc']); ?>   </th> 
											<th>  <?php echo get_agency_type($motor['agency_type']); ?>   </th> 
										</tr>
										<?php } ?>
								  </tbody>
									<tr></tr>
								  </table>
							 </div>
							 
							 <div class="table-responsive">
								  <table class="table-dash table table-hover">
									<caption>Third Party Liabilites :</caption>
								  <thead>
										<tr>
											<th>Vehicle Type</th>
											<th>Driving Licence</th>
											<th>Driver Age</th>
											<th>Emirates</th>
											<th>Gcc</th>
											<th>No of Cylinder</th>
										</tr>
								  </thead>
								  <tbody>
										<?php foreach($book_data_motor_tpl as $motortpl){   ?>
										<tr>   
											<th>  <?php echo get_vehicle_type($motortpl['vehicle_type']); ?>   </th>
											<th>  <?php echo get_driver_licence($motortpl['driving_licence']); ?>  </th>  
											<th>  <?php echo get_driver_age($motortpl['driver_age']); ?>  </th> 
											<th>  <?php echo get_emirate_name($motortpl['r_emirate']); ?>   </th> 
											<th>  <?php echo get_gcc($motortpl['gcc']); ?>   </th> 
											<th>  <?php echo get_no_cylinder($motortpl['noofcilender']); ?>   </th> 
										</tr>
										<?php } ?>
								  </tbody>
									<tr></tr>
								  </table>
							 </div>
						</div>
						<div id="cleaning-book" class="tab-pane fade">
						  <h3>CLEANING SERVICE</h3>
						   <div class="table-responsive">
							  <table class="table-dash table table-hover">
							 <thead>
									<tr>
										<th>Emirate</th>
										<th>Material Provided</th>
										<th>No Of Cleaners</th>
										<th>No Of Hours</th>
										<th>Frequency</th>
										<th>Premises</th>
										<th>Cleaning Date</th>
									</tr>
							  </thead>
							  <tbody>
									<?php foreach($book_data_cleaning as $cleaning){   ?>
									<tr>   
										<th>  <?php echo get_cleaner_city_name($cleaning['emirate_id']); ?>  </th>
										<th>  <?php echo get_material_provided($cleaning['material_provided']); ?>   </th>
										<th>  <?php echo get_number_of_cleaners($cleaning['noc']); ?>  </th>  
										<th>  <?php echo get_number_of_hours($cleaning['noh']); ?>  </th>  
										<th>  <?php echo get_frequency($cleaning['frequency']); ?>  </th>  
										<th>  <?php echo get_type_of_premise($cleaning['premises']); ?>  </th> 
										<th>  <?php echo $cleaning['cleaning_date']; ?>   </th> 
									</tr>
									<?php } ?>
							  </tbody>
								<tr></tr>
							  </table>
						 </div>
						</div>
						<div id="motorservicing-book" class="tab-pane fade in active">
						  <h3>Motor Servicing</h3>
						  <div class="table-responsive">
							  <table class="table-dash table table-hover">
							  <thead>
									<tr>
										<th>Vehicle Type</th>
										<th>Maker</th>
										<th>Model</th>
										<th>Level Of Service</th>
										<th>Feature Of Service</th>
										<th>Booking Date</th>
									</tr>
							  </thead>
							  <tbody>
									<?php foreach($book_data_motorservicing as $motorserv){   ?>
										<tr>   
											<th> <?php echo get_vehicle_type($motorserv['vehicle_type']); ?> </th>
											<th> <?php echo $motorserv['make']; ?></th>
											<th> <?php echo $motorserv['model']; ?></th>
											<th> <?php echo get_level_of_serv($motorserv['level_of_services']); ?></th>
											<th> <?php echo $motorserv['feature_of_services']; ?> </th>
											<th> <?php echo $motorserv['booking_date']; ?> </th>
										</tr>
									<?php } ?>
							  </tbody>
								<tr></tr>
							  </table>
						 </div>
						</div>
						<div id="pestcontrol-book" class="tab-pane fade in active">
						 <h3>Pest Control</h3>
						 <div class="table-responsive">
							  <table class="table-dash table table-hover">
							  <thead>
									<tr>
										<th>Type Of Service</th>
										<th>Type Of Premise</th>
										<th>Kind Of Premise</th>
										<th>Booking Date</th>
									</tr>
							  </thead>
							  <tbody>
									<?php foreach($book_data_pestcontrol as $pestc){   ?>
										<tr>   
											<th> <?php echo get_types_of_services($pestc['type_of_service']); ?> </th>
											<th> <?php echo get_type_of_premise($pestc['type_of_premise']); ?></th>
											<th> <?php echo get_kind_of_premise($pestc['kind_of_premises'],$pestc['type_of_premise']); ?></th>
											<th> <?php echo $pestc['booking_date']; ?> </th> 
										</tr>
										<?php } ?>
							  </tbody>
								<tr></tr>
							  </table>
						 </div>
						</div>
					  </div>
				</div>
				
				<div class="tab-pane fade in" id="my_orders">
				
				<?php //echo '<pre>'; print_r($user_orders); exit; ?>
					<div class="table-responsive">
						<table class="table-dash table table-hover">
							<caption>My Approved Orders :</caption>
							  <thead>
								<tr>
									<th>Order Id</th>
									<th>Type Of Services</th>
									<th>Policy Status</th>
									<th>Order Status</th>
									<th>Policy Doc</th>
									<th>Premium</th>
									<th>Order Updated On</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach($user_orders as $orders){   ?>
									<tr>   
										<td>  <?php echo $orders['id']; ?>   </td>
										<td>  <?php echo get_type_of_calc_service($orders['type_of_service']); ?>  </td>  
										<td>  <?php echo get_order_status($orders['policy_status']); ?>  </td> 
										<td>  <?php echo get_order_status($orders['order_status']); ?>   </td> 
										<td>  
										<?php echo form_open_multipart('members/download', array('id' => 'multiformupload')); ?>
										<input type="hidden" name="doc1" value="<?php echo $orders['policy_doc']; ?>"/>
										<input type="submit" name="submit_policy_doc" value="Download Policy" /> 
										<?php echo form_close(); ?>
										</td> 
										<td>  <?php echo $orders['premium']; ?>   </td> 
										<td>  <?php echo $orders['date_added']; ?> </td> 
									</tr>
										<?php } ?>
								</tbody>
								<tr></tr>
						</table>
					</div>
				</div>
			  </div>
			</div>
		
	</div>
				
		
	</div>
	<script>
		$(document).ready(function() {
$(".btn-pref .btn").click(function () {
    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).removeClass("btn-default").addClass("btn-primary");   
});
});
	</script>
  <?php } ?>
	
<?php $this->load->view("bottom_application");?>