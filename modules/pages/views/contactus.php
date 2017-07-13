<?php $this->load->view('top_application'); ?>
<?php $this->load->view('project_header'); ?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Contact Us</strong></span></div>
  </div>
</div>
<div class="wrapper pt30 pb30">
  <div class="border1 pl25">
	<?php error_message();?>
	<div class="fl w56 mt30"><?php echo $content;?></div>
	<div class="pt20 border1 bg-gray1 fr w42" style="border-width:0 0 0 1px">
	  <h3 class="fs16 orange weight600 ml25">Still need help?<br><b class="fs16">Just Fill the Below Information:</b></h3>
	  <?php echo form_open('');?>
	  <fieldset class="p25 pt10" style="border:none;">
	  <p>
		<input type="text" name="first_name" id="first_name" value="<?php echo set_value('first_name');?>" class="p7 w100" placeholder="First Name *">
		<?php echo form_error('first_name');?>
	  </p>
	  <p class="mt8">
		<input type="text" name="last_name" id="last_name" value="<?php echo set_value('last_name');?>" class="p7 w100" placeholder="Last Name">
		<?php echo form_error('last_name');?>
	  </p>
	  <p class="mt8">
		<input type="text" name="email" id="email" value="<?php echo set_value('email');?>" class="p7 w100" placeholder="Email *">
		<?php echo form_error('email');?>
	  </p>
	  <p class="mt8">
		<input type="text" name="mobile_number" id="mobile_number" value="<?php echo set_value('mobile_number');?>" class="p7 w100" placeholder="Mobile Number *">
		<?php echo form_error('mobile_number');?>
	  </p>
	  <p class="mt8">
		<input type="text" name="phone_number" id="phone_number" value="<?php echo set_value('phone_number');?>" class="p7 w100" placeholder="Phone Number">
		<?php echo form_error('phone_number');?>
	  </p>
	  <textarea name="message" id="description" cols="45" rows="12" class="p7 w100 mt8" style="height:100px; resize:none" placeholder="Enquiry / Comments *"><?php echo set_value('message');?></textarea>
	  <?php echo form_error('message');?>
	  <div class="cb pb10"></div>
	  <p class="fl">
		<input name="verification_code" id="verification_code" type="text" class="p7" style="width:150px;" placeholder="Word Verification *">
		
	  </p>
	  <p class="fl ml10"><img src="<?php echo site_url('captcha/normal/contactus'); ?>" alt="" title=""  class="vam p1" id="captchaimage"><a href="javascript:void(0);" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/contactus/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();"><img src="<?php echo theme_url();?>images/ref.png" alt="Refresh" title="Refresh"  class="vam ml10"></a></p>
	  <div class="cb"></div>
	  <?php echo form_error('verification_code');?>
	  <div class="cb"></div>
	  <div class="mt10">
		<input name="input" type="submit"  value="Submit" class="btn3 radius-3 trans_eff">
		<input name="input" type="reset" value="Reset" class="btn3x ml3 radius-3 trans_eff">
	  </div>
	  </fieldset>
	  <?php echo form_close();?>
	</div>
	<div class="cb"></div>
  </div>
</div>
<?php
$baddress = $this->db->get_where('wl_contact_address',array('status'=>'1'))->result_array();
?>
<!--textarea name="addres" id="address" cols="25" rows="10"></textarea-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false?api_key=AIzaSyAg-kEaNr3B0YlLNLZCLI_sJIecb5d-HtM"></script>
<script type="text/javascript">
// This example displays a marker at the center of Australia.
// When the user clicks the marker, an info window opens.
var geocoder = new google.maps.Geocoder(); 
function geocodePosition(pos) {
  geocoder.geocode({
	latLng: pos
	}, function(responses) {
	if (responses && responses.length > 0) {
	updateMarkerAddress(responses[0].formatted_address);
	} else {
	updateMarkerAddress('Cannot determine address at this location.');
	}
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
  document.getElementById('info').innerHTML = [
												latLng.lat(),
												latLng.lng()
											  ].join(', ');
}

function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
} 

function initialize() {

  var centre_map = new google.maps.LatLng(25.2048,55.2708);//dubai
  var zoomlabel = 4;  
  var mapOptions = {
					  zoom: zoomlabel,
					  center: centre_map,
					  mapTypeId: google.maps.MapTypeId.ROADMAP
					};


  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

 


  <?php
  if(!empty($baddress) && is_array($baddress))
  {
	$i = 0;
	foreach($baddress as $marker_detail)
	{
	  $i++;
	  $marker_lat = $marker_detail['latitude']; // Array of lat& lang
	  $marker_lng = $marker_detail['longitude'];	


	  ?>


	  /* Info Window Content */

	  var contentString<?=$i?> = '<div>';

	  contentString<?=$i?> +='<div id="">';

	  contentString<?=$i?> += '<h3 align="center">Address</h3><?php echo $marker_detail['address']?>';

	  contentString<?=$i?> += '</div><div class="cb"></div></div>';


	  var contentWindowDiv<?=$i?>= document.createElement("div");
	  contentWindowDiv<?=$i?>.className  = 'info_window';
	  contentWindowDiv<?=$i?>.innerHTML = contentString<?=$i?>;

	  /* Info Content Ends */

	  var infowindow<?=$i?> = new google.maps.InfoWindow({
								content: contentWindowDiv<?=$i?>
							  });



	  var marker_location = new google.maps.LatLng(<?=$marker_lat?>,<?=$marker_lng?>);

	  var marker<?=$i;?> = new google.maps.Marker({
							  position: marker_location,
							  map: map,
							  title: 'Address',
							  draggable : false
						   });





	  google.maps.event.addListener(marker<?=$i?>, 'mouseover', function() {
infowindow<?=$i?>.open(map,marker<?=$i?>);

});



	  google.maps.event.addListener(marker<?=$i?>, 'dragend', function(){
			geocodePosition(marker<?=$i?>.getPosition());
		}); 


	  google.maps.event.addListener(marker<?=$i?>, 'mouseout', function(){
  infowindow<?=$i?>.close();
	  });

	<?php 
	}
  }
  ?>
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
<div id="map-canvas" style="height:400px;width:1000px;"></div> 
<div class="cb bb1"></div>
<?php $this->load->view('bottom_application'); ?>