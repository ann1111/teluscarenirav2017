countryObj = $('#country_id');
stateObj = $('#state_id');
cityObj = $('#city_id');

function updateLocation(){
	var countryval = countryObj.val();
	$('#state_id,#city_id').fadeOut(100,function(){$('.loading').addClass('red b').html('Loading...').show()});
	$('#state_id option:gt(0),#city_id option:gt(0)').remove();
	
	$.post(site_url+'sitepanel/location/load_states',{country_id:countryval,state_id:gpObj.state_id},function(data){
		stateObj.append(data);
		stateObj.prev().fadeOut(100,function(){stateObj.fadeIn()
			stateval = stateObj.val();
			if(cityObj.length){
				$.post(site_url+'sitepanel/location/load_cities',{country_id:countryval,state_id:stateval,city_id:gpObj.city_id},function(data){
					cityObj.append(data);
					cityObj.prev().fadeOut(100,function(){cityObj.fadeIn()});
				});
			}
		});
	});
	
	
}
function updateCity(){
	countryval = countryObj.val();
	stateval = stateObj.val();
	$('#city_id').fadeOut(100,function(){cityObj.prev().addClass('red b').html('Loading...').show()});
	$('#city_id option:gt(0)').remove();

	$.post(site_url+'sitepanel/location/load_cities',{country_id:countryval,state_id:stateval,city_id:0},function(data){
		cityObj.append(data);
		cityObj.prev().fadeOut(100,function(){cityObj.fadeIn()});
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