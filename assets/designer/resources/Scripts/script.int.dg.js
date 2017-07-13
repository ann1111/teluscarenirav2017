function include(url){ 
document.write('<script src="'+ url + '" type="text/javascript"></script>'); 
}
include(resource_url+'Scripts/helpers.min.js');
include(resource_url+'Scripts/jquery.placeholder.js');
include(resource_url+'fancybox/jquery.fancybox.pack.js');

var Page = Page=='undefined' ? null : Page;

if(Page=='home'){
include(resource_url+'Scripts/fluid_dg.min.js');
}

else{
}
$(window).load(function(e){

$(".dg2").fancybox({'width' :450,'height' :360,'autoScale' : false,'type' : 'image'});

$('#logo').flash({src: resource_url+'swf/logo.swf', width: 286, height:88, 'allowfullscreen':true,'menu':'false','wmode': 'transparent', 'allowscriptaccess':'always','flashvars': {'Baseurl':site_url} }); 

$('.fancybox').fancybox();
$('.mygallery').fancybox({/*use class 'mygallery' and rel 'gallery' in 'A tag' */
wrapCSS    : 'fancybox-custom',closeClick : true, openEffect : 'none',
helpers : {
title : {type : 'inside'},
overlay : {css : {'background' : 'rgba(0,0,0,0.6)'}}
}
});

$('.forgot').fancybox({'width':395,'height':190,'type':'iframe',title:{type:'outside'}});
$('.newsletter').fancybox({'width':450,'height':230,'type':'iframe',title:{type:'outside'}});
$('.refer').fancybox({'width':450,'height':320,'type':'iframe',title:{type:'outside'}});
$('.invoice').fancybox({'width':800,'height':390,'type':'iframe',title:{type:'outside'}});
$('.vendors').fancybox({'width':800,'height':280,'type':'iframe',title:{type:'outside'}});
$('.confrm_sbp').fancybox({'width':695,'height':390,'type':'iframe',title:{type:'outside'}});


$('#xlistContainer').on('click','.ser-pop',function(e){
	e.preventDefault();
	$(this).removeClass('ser-pop').fancybox({'width' : 550,'height' :370,'autoScale' : false,'type':'iframe'}).trigger('click');
});

/*$('input.ser-pop').fancybox({'width' : 550,'height' :370,'autoScale' : false,'type':'iframe','href':'complaints.htm'})

$('input.ser-pop1').fancybox({'width' : 550,'height' :370,'autoScale' : false,'type':'iframe','href':'suggestion.htm'})
$('input.ser-pop2').fancybox({'width' : 550,'height' :370,'autoScale' : false,'type':'iframe','href':'queries.htm'})*/


$('input,textarea').placeholder();

$(function(){$(".pro_scroll").jCarouselLite({btnPrev:".prev",btnNext:".next",vertical: false,auto:2000,hoverPause:true,visible:5,speed:400});});
$(function(){$(".part_scroll").jCarouselLite({btnPrev:".prev2",btnNext:".next2",vertical: false,auto:2800,hoverPause:true,visible:4,speed:600});});
$(function(){$(".test_scroll").jCarouselLite({btnPrev:".prev3",btnNext:".next3",vertical: false,auto:3000,hoverPause:true,visible:1,speed:400});});


$('#xlistContainer').on('click','.mr_links',function(e){
	evt_obj = $(this);
	prt_obj = evt_obj.parents('.xitemContainer');
	if(evt_obj.hasClass('mr_linksx')){
		$('.more_det',prt_obj).slideUp(100,function(){
			$('.less_det',prt_obj).slideDown(100,function(){evt_obj.toggleClass('mr_linksx')});
		});
	}else{
		$('.less_det',prt_obj).slideUp(100,function(){
			$('.more_det',prt_obj).slideDown(100,function(){evt_obj.toggleClass('mr_linksx')});
		});
	}
	
});

/*$('.mr_links').click(
function(){
$(this).toggleClass('mr_linksx'),$(this).prev().toggleClass('h_auto');
})*/

$('.conv_ttl').click(function(){
$(this).toggleClass('conv_ttlx'),$(this).next().slideToggle('fast');
})

$(window).scroll(function() {if ($(this).scrollTop() > 91) {
$('.search_area_outer').addClass('top_fixer'),$('.top_space').addClass('top_space_outer');} 
else {$('.search_area_outer').removeClass('top_fixer'),$('.top_space').removeClass('top_space_outer');}
});


$("#back-top").hide();	
$(function () {$(window).scroll(function () {if ($(this).scrollTop() > 100) {$('#back-top').fadeIn();} else {$('#back-top').fadeOut();}});
$('#back-top a').click(function () {$('body,html').animate({scrollTop: 0}, 800);return false;});
});
//$('.tabs').click(function(){var dg=$(this).attr('href'); $('.form_box').css({'display':'none'});$(dg).css({'display':'block'}); $('.tabs').removeClass('act'); $(this).addClass('act'); return false})

$(".scroll").click(function(event){
event.preventDefault();
$('html,body').animate({scrollTop:$(this.hash).offset().top -135}, 1000);
});

if(Page=='home'){
$(function(){$('#fluid_dg_wrap_1').fluid_dg({thumbnails: false,height:"190px",fx:'scrollLeft,scrollRight,scrollTop,scrollBottom',loader:'none',playPause:'false',navigation:"false",hover:'false',time:3000});})
}

});

