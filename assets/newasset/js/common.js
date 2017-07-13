		 $('document').ready(function() {

		 //alert(site_url);
		 
			//Set the carousel options
			$('#quote-carousel').carousel({
				pause: true,
				interval: 4000,
			  });
				  
				  
				  
				$('#home_page_se,#home_page_se1').on('click',function(){
					var get_clicble_val = $(this).attr('href');
					
					if(get_clicble_val == '#demo'){
						var chk_cls = $(this).find('i').attr('class');
						
						$(this).find('i').attr('class','');
						$('#home_page_se1').find('i').attr('class','');
						$(this).find('i').addClass('ion-chevron-down');
						$('#home_page_se1').find('i').addClass('ion-chevron-up');
					}
					
					if(get_clicble_val == '#demo1'){
						var chk_cls = $(this).find('i').attr('class');
						
					
						$(this).find('i').attr('class','');
						$('#home_page_se').find('i').attr('class','');
						$('#home_page_se').find('i').addClass('ion-chevron-up');
						$(this).find('i').addClass('ion-chevron-down');
						
					}
					
				});  
				  
			/* DATEPICKERS */
			
			$('#dateRangePicker').datepicker({ autoclose: true,format: 'yyyy-mm-dd' });
			$('#dateRangePicker0').datepicker({ autoclose: true,format: 'yyyy-mm-dd' });
			$('#dateRangePicker1').datepicker({ autoclose: true,format: 'dd/mm/yyyy' });
			$('#dateRangePicker2').datepicker({ autoclose: true,format: 'mm/dd/yyyy' });
			$('#dateRangePicker3').datepicker({ autoclose: true,format: 'dd/mm/yyyy' });
			$('#dateRangePicker4').datepicker({ autoclose: true,format: 'dd/mm/yyyy' });
			$('#dateRangePicker5').datepicker({ autoclose: true,format: 'dd/mm/yyyy' });
			$('#dateRangePicker6').datepicker({ autoclose: true,format: 'dd/mm/yyyy' });
			$('#dateRangePicker7').datepicker({ autoclose: true,format: 'dd/mm/yyyy' });
			$('#dateRangePicker8').datepicker({ autoclose: true,format: 'dd/mm/yyyy' });
			$('#dateRangePicker9').datepicker({ autoclose: true,format: 'dd/mm/yyyy' });
			
			
			
		});
		
		/* AJAX FORM SUBMIT */
			
			 $('document').ready(function() { 
					/* var options = { 
						target:        '#output1',   // target element(s) to be updated with server response 
						beforeSubmit:  showRequest,  // pre-submit callback 
						success:       showResponse,  // post-submit callback 
				 
						// other available options: 
						url:       'users/login',         // override for form's 'action' attribute 
						type:      'post',        // 'get' or 'post', override for form's 'method' attribute 
						dataType:  null,        // 'xml', 'script', or 'json' (expected server response type) 
						clearForm: true,        // clear all form fields after successful submit 
						resetForm: true        // reset the form after successful submit 
				 
						// $.ajax options can be used here too, for example: 
						//timeout:   3000 
					};  */
			 
					// bind form using 'ajaxForm'
						
					//$('#login-submit1').click(function(){ 
				
				
				/// USER LOGIN 
				
					$('.login-formc , .login-formsbp').ajaxForm({ 
						target: '#htmlExampleTarget',
						url:       site_url+'users/login',
						type:      'post',
						dataType: 'html',		
						//beforeSubmit:  showRequest,  // pre-submit callback 
						success:function(Response){
							if(Response == 'member'){
									//location.reload();
									window.location.href=site_url+"members/myaccount";
							} 
							if(Response == 'vendors'){
									window.location.href=site_url+"vendors/myaccount";
							}
							if(Response == 'Invalid'){
								$('#errorbox').modal('show');
								$('#errorbox').find('.panel-body').html('<span class="error">INVALID USER OR WRONG CREDENTIALS PLZ TRY AGAIN!!</span>');
							}
						},
					});

				/// USER REGISTRATION CUSTOMER				
					$('.customer_reg').ajaxForm({ 
						target: '#htmlExampleTarget',
						url:       site_url+'users/register',
						type:      'post',
						dataType: 'html',		
						//beforeSubmit:  showRequest,  // pre-submit callback 
						success:function(Response){
							if(Response == 'EMAIL EXITS'){
								$('#errorbox').modal('show');
								$('#errorbox').find('.panel-body').html('<span class="error">Email Address is already Exist.</span>');
							}else{
								$('#errorbox').modal('show');
								$('#errorbox').find('.panel-body').html('<span class="error">You are registered successfully.</span>');
								location.reload();
							}
							
							//.delay(5000).location.reload();
						},
					});					
				
				/// VENDOR REGISTRATION
					$('.sbp_reg').ajaxForm({ 
						target: '#htmlExampleTarget',
						url:       site_url+'users/vendor_register',
						type:      'post',
						dataType: 'html',		
						//beforeSubmit:  showRequest,  // pre-submit callback 
						success:function(Response){
							if(Response == 'EMAIL EXITS'){
								$('#errorbox').modal('show');
								$('#errorbox').find('.panel-body').html('<span class="error">Email Address is already Exist.</span>');
							}else{
								$('#errorbox').modal('show');
								$('#errorbox').find('.panel-body').html('<span class="error">You are registered successfully.</span>');
								location.reload();
							}
							
							//.delay(5000).location.reload();
						},
					});		
					
				function showRequest(formData, jqForm, options) { 
					var queryString = $.param(formData); 
					alert('About to submit: \n\n' + queryString); 
					return true; 
				} 
	  
				function showResponse(responseText, statusText, xhr, $form)  { 
					alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
						'\n\nThe output div should have already been updated with the responseText.'); 
				} 
				
				/* POP-UP REgistraion */
				
				$('#signup_details_home_pop').ajaxForm({ 
						target: '#htmlExampleTarget',
						url:       site_url+'motorinsurance/motor_data_popup',
						type:      'post',
						dataType: 'html',		
						//beforeSubmit:  showRequest,  // pre-submit callback 
						success:function(Response){
							if(Response == 'OK'){
								localStorage.setItem('popState','shown');
								$('#myModalpopupoffer').modal('hide');
								$('#errorbox').modal('show');
								$('#errorbox').find('.panel-body').html('<span class="error">Data Added Successfully. Thank you. Will get Back to you soon.</span>');
							}
							
							//.delay(5000).location.reload();
						},
					});		
				
				
				
				
				
				
				
			});
 
 
 
	