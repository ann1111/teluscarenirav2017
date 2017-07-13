countryObj = $('#country_id');
stateObj = $('#state_id');
cityObj = $('#city_id');

function updateLocation(){
	var countryval = countryObj.val();
	$('#state_id,#city_id').addClass('bck_loading');
	$('#state_id option:gt(0),#city_id option:gt(0)').remove();
	
	$.post(site_url+'location/load_states',{country_id:countryval,state_id:gpObj.state_id},function(data){
		stateObj.append(data);
		stateObj.removeClass('bck_loading');
		
		stateval = stateObj.val();
		if(cityObj.length){
			$.post(site_url+'location/load_cities',{country_id:countryval,state_id:stateval,city_id:gpObj.city_id},function(data){
				cityObj.removeClass('bck_loading');
				cityObj.append(data);;
			});
		}
		
	});
	
	
}
function updateCity(){
	countryval = countryObj.val();
	stateval = stateObj.val();
	cityObj.addClass('bck_loading');
	$('#city_id option:gt(0)').remove();

	$.post(site_url+'location/load_cities',{country_id:countryval,state_id:stateval,city_id:0},function(data){
		cityObj.append(data);
		cityObj.removeClass('bck_loading');
	});
}
(function($){
	$(document).ready(function(){
		countryObj.change(function(){
			updateLocation();
		});
		if(cityObj.length){
			stateObj.change(function(){
				updateCity();
			});
		}

	});
})(jQuery);