var page = 1;
var triggeredPaging = 0;

$(window).scroll(function (){
var scrollTop = $( window ).scrollTop();
var scrollBottom = (scrollTop + $( window ).height());
listing_container = $(gObj.listingContainer);
var containerTop = listing_container.offset().top;
var containerHeight = listing_container.height();
var containerBottom = Math.floor(containerTop + containerHeight);
var scrollBuffer = 0;


	
if((containerBottom - scrollBuffer) <= scrollBottom) {

  page = $(gObj.itemContainer).length;

  var actual_count = gObj.actual_count;

  if(!triggeredPaging && page < actual_count){
	triggeredPaging=1;
	data_frm_obj = $(gObj.data_frm);
	$(':hidden[name="offset"]',data_frm_obj).val(page);
	data_frm = data_frm_obj.serialize();
	$.ajax({
		  type: "POST",
		  url: site_url+gObj.req_url,
		  data:data_frm,
		  error: function(res) {
			triggeredPaging = 0;
		  },
		  beforeSend: function(jqXHR, settings){
			$('#loadingdiv').show();
		  },
		  success: function(res) {
			$('#loadingdiv').hide();
			//res +='<div class="cb"></div>';
			listing_container.append(res);
			triggeredPaging = 0;
			//console.log(res);
			
			$(gObj.itemContainer).fadeTo(500, 0.5, function() {
			  $(this).fadeTo(100, 1.0);
			});
		  }
		});
	}
  }
});

$('.pgsize').change(function(){
	listing_container = $(gObj.listingContainer);
	$('.pgsize').val($(this).val());
	data_frm_obj = $(gObj.data_frm);
	$(':hidden[name="start"]',data_frm_obj).val(0);
	$(':hidden[name="pagesize"]',data_frm_obj).val($(this).val());
	data_frm = data_frm_obj.serialize();
	listing_container.html("Loading....");
	//data_frm_obj.method = 'get';
	//data_frm_obj.submit();
	$.post(gObj.req_url,data_frm,function(data){
		listing_container.html(data);
	})
});