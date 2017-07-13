catObj = $('#pcategory');
function updateAttributes(){
	var catval = catObj.val();
	$('#brand_id,#material_id,#frame_type_id').fadeOut(100,function(){$('.loading').addClass('red b').html('Loading...').show()});
	$('#brand_id option:gt(0),#material_id option:gt(0),#frame_type_id option:gt(0)').remove();
	
	$.post(site_url+'sitepanel/products/load_materials',{catid:catval,material_id:gpObj.material_id},function(data){
		$('#material_id').append(data);
		$('#material_id').prev().fadeOut(100,function(){$('#material_id').fadeIn()});
	});
	$.post(site_url+'sitepanel/products/load_brands',{catid:catval,brand_id:gpObj.brand_id},function(data){
		$('#brand_id').append(data);
		$('#brand_id').prev().fadeOut(100,function(){$('#brand_id').fadeIn()});
	});
	$.post(site_url+'sitepanel/products/load_frame_types',{catid:catval,type_id:gpObj.frame_type_id},function(data){
		$('#frame_type_id').append(data);
		$('#frame_type_id').prev().fadeOut(100,function(){$('#frame_type_id').fadeIn()});
	});
}
(function($){
	$(document).ready(function(){
		$('#pcategory').change(function(){
			//catObj = $(this);
			updateAttributes();
		});
	});
})(jQuery);