<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>

		<div class="container">
			<div class="row">
				<div class="col-md-offset-2 col-md-8 text-center">
					<h2 style="color:#000;">Contact Us</h2>
					<hr class="primary">
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-1 col-md-10">
					<div class="row">
						<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
							<div class="about_p">
								<div class="fl w56 mt30"><div class="bb pb30">
									<h3 class="fs16 orange weight600"><span style="color:#A52A2A;">How to Reach</span></h3>

									<p class="ttu b fs24 mt25 blue">TelUs Care FZE</p>

									<p class="mt25 lht-28 fs18"><img alt="" class="vab mr10" src="contactus_files/eml.htm"> <span class="black"><a class="uu" href="http://localhost/inetwork/pages/contactus#">support@teluscare.com</a></span></p>
									</div>

									<div class="mt30 pb30">
									<h3 style="color:#A52A2A;">Complaints</h3>

									<p class="mt15 lht-16">If you are not happy with our SBP(Strategic 
									Business Partner/Provider&nbsp;services/products) provide feedback and 
									review on your online portal.</p>
										<p><b class="gray mt35 normal fs20 db i arial">If your concern still remains unresolved,</b><span style="line-height: 20.7999992370605px;">...</span><span style="line-height: 20.7999992370605px;">&nbsp;</br>send an email on below id,&nbsp;Our complaint handling executive would attend to your issue straightaway</span></p>

									<p class="lht-22 fs14 mt5">Email us : <span class="black"><a class="uu" href="http://localhost/inetwork/pages/contactus#">complaint@teluscare.com</a></span></p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
							<div class="about_p">
								<h3>Still need help?</h3>
								<p>Just Fill the Below Information:</p>
									  <form action="http://teluscare.com/contactus" method="post" accept-charset="utf-8">	  
										<fieldset class="input-fieldset-size" style="border:none;">
										  <p>
											<input class="text-input" name="first_name" id="first_name" placeholder="First Name *" type="text">
												  </p>
										  <p class="mt8">
											<input class="text-input" name="last_name" id="last_name" placeholder="Last Name" type="text">
												  </p>
										  <p class="mt8">
											<input class="text-input" name="email" id="email" placeholder="Email *" type="text">
												  </p>
										  <p class="mt8">
											<input class="text-input" name="mobile_number" class="" placeholder="Mobile Number *" type="text">
												  </p>
										  <p class="mt8">
											<input class="text-input" name="phone_number" class="" placeholder="Phone Number" type="text">
												  </p>
										  <textarea class="text-area" name="message" id="description" rows="4" placeholder="Enquiry / Comments *"></textarea>
										  <div class="cb"></div>
											  <div class="row">
													<div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
														<p>
															<input class="text-input" name="verification_code" id="verification_code" style="width:150px;" placeholder="Word Verification *" type="text">
														</p>
													</div>
													<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
														<p><img src="image/contactus.gif" alt="" title="" class="vam p1" id="captchaimage"></p>
													</div>
													<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
														<p><a href="javascript:void(0);" onclick="document.getElementById('captchaimage').src='http://teluscare.com/captcha/normal/contactus/1484575988587cd4f41d683'+Math.random(); document.getElementById('verification_code').focus();"><img src="image/ref.png" alt="Refresh" title="Refresh" class="vam ml10"></a></p>
													</div>
													<!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
														<p class="fl">
															<input class="text-input" name="verification_code" id="verification_code" style="width:150px;" placeholder="Word Verification *" type="text">
														</p>
													</div> -->
											  </div>
										  <div class="cb"></div>
											  <div class="cb"></div>
										  <div class="mt10">
											<input name="input" value="Submit" class="btn3" type="submit">
											<input name="input" value="Reset" class="btn3x" type="reset">
										  </div>
										  </fieldset>
									  </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
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

 


  

	  /* Info Window Content */

	  var contentString1 = '<div>';

	  contentString1 +='<div id="">';

	  contentString1 += '<h3 align="center">Address</h3>B-3, Ajman Free Zone ,Ajman UAE';

	  contentString1 += '</div><div class="cb"></div></div>';


	  var contentWindowDiv1= document.createElement("div");
	  contentWindowDiv1.className  = 'info_window';
	  contentWindowDiv1.innerHTML = contentString1;

	  /* Info Content Ends */

	  var infowindow1 = new google.maps.InfoWindow({
								content: contentWindowDiv1							  });



	  var marker_location = new google.maps.LatLng(25.4258179,55.5285206);

	  var marker1 = new google.maps.Marker({
							  position: marker_location,
							  map: map,
							  title: 'Address',
							  draggable : false
						   });





	  google.maps.event.addListener(marker1, 'mouseover', function() {
infowindow1.open(map,marker1);

});



	  google.maps.event.addListener(marker1, 'dragend', function(){
			geocodePosition(marker1.getPosition());
		}); 


	  google.maps.event.addListener(marker1, 'mouseout', function(){
  infowindow1.close();
	  });

	

	  /* Info Window Content */

	  var contentString2 = '<div>';

	  contentString2 +='<div id="">';

	  contentString2 += '<h3 align="center">Address</h3>B3-K2 wing, MIDC Ambernath , Thane , Maharastra';

	  contentString2 += '</div><div class="cb"></div></div>';


	  var contentWindowDiv2= document.createElement("div");
	  contentWindowDiv2.className  = 'info_window';
	  contentWindowDiv2.innerHTML = contentString2;

	  /* Info Content Ends */

	  var infowindow2 = new google.maps.InfoWindow({
								content: contentWindowDiv2							  });



	  var marker_location = new google.maps.LatLng(19.2010666,73.1866224);

	  var marker2 = new google.maps.Marker({
							  position: marker_location,
							  map: map,
							  title: 'Address',
							  draggable : false
						   });





	  google.maps.event.addListener(marker2, 'mouseover', function() {
infowindow2.open(map,marker2);

});



	  google.maps.event.addListener(marker2, 'dragend', function(){
			geocodePosition(marker2.getPosition());
		}); 


	  google.maps.event.addListener(marker2, 'mouseout', function(){
  infowindow2.close();
	  });

	}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
<div id="map-canvas" style="height:350px;width:100%;"><div style="height: 100%; width: 100%;"></div></div> 
<div class="cb bb1"></div>
		</div>
		
		<?php $this->load->view("bottom_application");?>
