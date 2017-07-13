var gObj=gObj ||  {};
$.extend(gObj,{re_mail:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z])+$/,re_vldname:/^[ a-zA-Z]+$/});

function validcheckstatus(name,action,text)
{
	var chObj	=	document.getElementsByName(name);
	var result	=	false;	
	for(var i=0;i<chObj.length;i++){
	
		if(chObj[i].checked){
		  result=true;
		  break;
		}
	}
 
	if(!result){
		 alert("Please select atleast one "+text+" to "+action+".");
		 return false;
	}else if(action=='delete'){
			 if(!confirm("Are you sure you want to delete this.")){
			   return false;
			 }else{
				return true;
			 }
	}else{
		return true;
	}
}



function increment(id)
{ 

var obj = document.getElementById(id);
var max_qty ;
max_qty = 100;//document.getElementById('aval_qty').value;
max_qty = parseInt(max_qty);


			var val=obj.value;	
			if( parseInt(val)< max_qty ) {
				
			   obj.value=(+val + 1);
			   
			}else{
				if(max_qty==0){
					alert("None quantity is available.");
				}else{
					alert("Maximum available quantity is "+max_qty+". You can not add  more then available Quantity.");
			 	}
			}
}
function decrement(id)
{ 
   var obj = document.getElementById(id);
	var val=obj.value
	if(val==1 || val <1)
		val=1;
	else
	  val=(val - 1);
		
	obj.value=val || 1;
}


function show_dialogbox()
{
	$("#dialog_overlay").fadeIn(100);
	$("#dialog_box").fadeIn(100);
}
function hide_dialogbox()
{
	$("#dialog_overlay").fadeOut(100);
	$("#dialog_box").fadeOut(100);
}

function showloader(id)
{
	$("#"+id).after("<span id='"+id+"_loader'><img src='"+site_url+"/assets/developers/images/loader.gif'/></span>");
}


function hideloader(id)
{
	$("#"+id+"_loader").remove();
}
												
												
function load_more(base_uri,more_container,formid)
{	
  showloader(more_container);
  $("#more_loader_link"+more_container).remove();
   if(formid!='0')
   {
	   form_data=$('#'+formid).serialize();
   }
   else
   {
	   form_data=null;
   }
  $.post
	  (
		  base_uri,
		  form_data,
		  function(data)
		  { 
		  
		  
			 var dom = $(data);
			
			dom.filter('script').each(function(){
			$.globalEval(this.text || this.textContent || this.innerHTML || '');
			});
			
			var currdata = $( data ).find('#'+more_container).html(); $('#'+more_container).append(currdata);
			hideloader(more_container);
		  }
	  );
}


 



function join_newsletter()
{	
	var form = $("#chk_newsletter");	
	showloader('newsletter_loder');
	$(".btn").attr('disabled', true);		
	$.post(site_url+"pages/join_newsletter",
		  $(form).serialize(),		   
		   function(data){
			
			     $("#my_newsletter_msg").html(data);				
				 $(".btn").attr('disabled', false);				 
			     hideloader('newsletter_loder');
				 $('input').val('');					 
			   });
	
	return false;
	
}


$(document).ready(function() {
	
	
	
	$(':checkbox.ckblsp').click(function()
    {
	 
		$(':input','#ship_container').val('');
		
		if($(this).attr('checked'))
		{
			$('#ship_container').hide();
			
		}else{
			
			$('#ship_container').show();
				
		}	
	}); 
	
	
	$('.cpg_link').live('click',function(e){
		e.preventDefault();
		link_obj = $(this);
		pg_offset_val = link_obj.attr('data-offset');
		pg_refresh = link_obj.attr('data-refresh');
		if(pg_refresh ==1){
			link_href = link_obj.attr('href');
			data_form_obj = link_obj.attr('data-form');
			data_form_obj = $(data_form_obj);
			$('#pg_offset',data_form_obj).val(pg_offset_val);
			data_form_obj.attr({'action':link_href,'method':'get'});
			data_form_obj.submit();
		}
		else{
			
			$('#pg_offset').val(pg_offset_val);
			parent_reflector_raw = link_obj.attr('data-parent');
			parent_reflector = $(parent_reflector_raw);
			parent_reflector.fadeTo(100,0.3,function(){
				link_href = link_obj.attr('href');
				
				$.post(link_href,serialize_form(),function(data){
					//var currdata = $( data ).find(parent_reflector_raw).html();
					
					parent_reflector.fadeTo(100,1,function(){parent_reflector.html(data)});
				});
			});
		}
	});
	
  $('.reset').click(function(){
	$('#country_id').val('');
	$('#state_id option :gt(0)').remove();
	$('#city_id option :gt(0)').remove();
	if($('.prod_category').length){
		$('.prod_category :gt(0)').remove();
		$('.prod_category :eq(0)').val('');
	}
  });

  $('.hasDatepicker').live('keyup',function(){
	cobj = $(this);
	cval = cobj.val();
	cobj.val(!/\d{4}\-\d{2}\-\d{2}/.test(cval) ? '' : cval);
	  
  });
	
});