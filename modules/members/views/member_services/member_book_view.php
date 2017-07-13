<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>

<div class="w90 auto mt30">
<p class="fr mt1"><a href="<?php echo base_url(); ?>members/myaccount" class="btn1 radius-20t" title="?Go Back">Go Back user Profile</a> </p>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/developers/js/ui/themes/base/jquery.ui.all.css">
  
  <h1> Booked Services </h1>
  <div class="cb pb30 mb10"></div>
   <style type="text/css">
		.tg  {border-collapse:collapse;border-spacing:0;}
		.tg td{font-family:Arial, sans-serif;font-size:14px;padding:1px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
		.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:1px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	</style>
	
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Health Insurance</a></li>
    <li><a href="#tabs-2">Motor Insurance</a></li>
    
  </ul>
  <div id="tabs-1">
    <table class="tg">
		<tr>   
			<th>  Customer Name </th>
			<th>  Date Of Birth  </th>
			<th>  Gender  </th>  
			<th>  Country  </th> 
			<th>  Plan  </th> 
			
		</tr>
		<?php foreach($book_data_health as $health){   ?>
		<tr>   
			<th>  <?php echo $health['Customer_name']; ?> </th>
			<th>  <?php echo $health['dob']; ?>   </th>
			<th>  <?php echo $health['gender']; ?>  </th>  
			<th>  <?php echo get_emirate_name($health['country_id']); ?>  </th> 
			<th>  <?php echo get_health_plan($health['plan_id']); ?>   </th> 
		</tr>
		<?php } ?>
	</table>
  </div>
  <div id="tabs-2">
    <table class="tg">
	
	<tr><td><h1>COMPREHENSIVE</h1></td>	</tr>
		<tr>   
			<th>  Vehicle Type  </th>
			<th>  Driving Licence  </th>  
			<th>  Driver Age  </th> 
			<th>  Emirates  </th> 
			<th>  Gcc  </th> 
			<th>  Agency Type  </th> 
		</tr>
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
	
	</table>
	</br>
	<table class="tg">
	<tr><td><h1>THIRD PARTY LIABILITIES</h1></td>
		</tr>
		<tr>   
			<th>  Vehicle Type  </th>
			<th>  Driving Licence  </th>  
			<th>  Driver Age  </th> 
			<th>  Emirates  </th> 
			<th>  Gcc  </th> 
			<th>  No Of Cylinder  </th> 
		</tr>
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
		
	</table>
  </div>
  
</div>

<div class="cb pb30 mb50"></div>

</div>
<script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
<?php $this->load->view("bottom_application");?>