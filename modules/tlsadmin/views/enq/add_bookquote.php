<?php

$id='';
$button='Add';
$button1='Add';
if(isset($edit))
{

$mq_state_of_quote = $quote[0]['mq_state_of_quote'];
$Feedback = $quote[0]['mq_feedback'];
$StatusofOrder = $quote[0]['mq_orderstatus'];
$button='Update';
$button1='Update';

}
?>
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">Manage Quote</h4>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a></li>
                                    <li class="active"><?= $button1 ?>Quote</li>
                                    
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
							<?php print_r($quote);  
							//print_r($this->session->userdata);?>
							<div class="col-lg-12">							
								<div class="card-box">
								
									<h4 class="m-t-0 header-title"><b><?= $button?> Quote</b></h4>
									<p class="text-muted font-13 m-b-30">
	                               <?php if($msg == true){ ?>
		
									<div class="alert alert-success">
									<strong>Success!</strong> Quote Updated successfully.
									</div>
									
									<?php } ?>
									
	                                </p>
	                                <?php //echo $this->uri->segment(3);  ?>
									<form class="form-horizontal" action="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/quote_bookededit/'.$this->uri->segment(5); ?>" method="post"  role="form"  data-parsley-validate novalidate >
									<div class="form-group">
									 <label for="POSTDATE" class="col-sm-3 control-label">Post Date </label>
									 <div class="col-sm-7"> <?php echo $quote[0]['mq_post_date']; ?></div>
									</div>
									<div class="form-group">
									 <label for="POSTDATE" class="col-sm-3 control-label">Service Type </label>
									 <div class="col-sm-7"> <?php echo $quote[0]['mq_product']; ?></div>
									</div>
									<div class="form-group">
									 <label for="POSTDATE" class="col-sm-3 control-label">Total Quote </label>
									 <div class="col-sm-7"> <?php echo $quote[0]['mq_total_quote']; ?> AED</div>
									</div>
									
									
									<div class="form-group">
                                       <label for="HP3" class="col-sm-3 control-label">Feedback</label>
                                       <div class="col-sm-7">
						<textarea   class="form-control" id="Remarks" name="Remarks" placeholder="Feedback/Remarks "><?php echo $Feedback; ?></textarea>
									   <input type="hidden" name="mq_id" value="<?php echo $quote[0]['mq_id']; ?>" />
									   <input type="hidden" name="mq_vendor_id" value="<?php echo $quote[0]['mq_vendor_id']; ?>" />
									   <input type="hidden" name="mq_user_id" value="<?php echo $quote[0]['mq_user_id']; ?>" />
									   </div>
                                    </div>
									<!--div class="form-group">
									<label for="ActiveStatus"class="col-sm-3 control-label">Status of Order*</label>
									<div class="col-sm-7">
										<select required  class="form-control" id="StatusofOrder" name="StatusofOrder">
											<option value="" <?php if($StatusofOrder==''){echo "selected";} ?>>Select Status Order</option>
											<option value="4" <?php if($StatusofOrder=='4'){echo "selected";} ?>>Pending</option>
											<option value="1" <?php if($StatusofOrder=='1'){echo "selected";} ?>>Complete</option>
											<option value="3" <?php if($StatusofOrder=='3'){echo "selected";} ?>>Change/Postpone</option>
											<option value="2" <?php if($StatusofOrder=='2'){echo "selected";} ?>>Cancle</option>
										</select>
									</div>
									</div-->
											<div class="form-group">
									<label for="ActiveStatus"class="col-sm-3 control-label">State of Quote*</label>
									<div class="col-sm-7">
										<select required  class="form-control" id="StatusofQuote" name="StatusofQuote">
											<option value="" <?php if($mq_state_of_quote==''){echo "selected";} ?>>Select Status Quote</option>
											<option value="B" <?php if($mq_state_of_quote=='B'){echo "selected";} ?>>Booked</option>
											<option value="S" <?php if($mq_state_of_quote=='S'){echo "selected";} ?>>Saved</option>
											<option value="BD" <?php if($mq_state_of_quote=='BD'){echo "selected";} ?>>Bid of Quote</option>
											<option value="N" <?php if($mq_state_of_quote=='N'){echo "selected";} ?>>Negotiate</option>
											<option value="C" <?php if($mq_state_of_quote=='C'){echo "selected";} ?>>Confirmed</option>
										</select>
									</div>
									</div>
							</div>																		
										
									<div class="form-group">
											<div class="col-sm-offset-4 col-sm-8">
											<input type="hidden" name="qid" id="qid" value="<?php echo $this->uri->segment(5);?>" >
												<button type="submit"  name="<?php echo $button;?>"class="btn btn-primary waves-effect waves-light" value="<?php echo $button; ?>">
													<?php echo $button; ?>
												</button>
												<button type="reset" class="btn btn-default waves-effect waves-light m-l-5" onclick="history.go(-1);">
													Cancel
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
                      
            		</div> <!-- container -->
                               
                </div> <!-- content -->
				<script type="text/javascript">
				<?php if($msg == true){ ?>
		
				  // Your application has indicated there's an error
					window.setTimeout(function(){

						// Move to a new location or you can do something else
						window.location.href = "<?php echo base_url(); ?>tlsadmin/enq/Manageenquiryonline/quote-booked";

					}, 3000);
					
				<?php } ?>
				
			$(document).ready(function() {
			
				$('form').parsley();
				$('#new').addClass('active');
				$('#clist').removeClass('active');
			
			jQuery('#DateOfBirth').datepicker({
                	autoclose: true,
                	todayHighlight: true,
					format:'dd-mm-yyyy'
                });
				jQuery('#DateOfJoin').datepicker({
                	autoclose: true,
                	todayHighlight: true,
					format:'dd-mm-yyyy'
                });
				jQuery('#DrivingLicenceDate').datepicker({
                	autoclose: true,
                	todayHighlight: true,
					format:'dd-mm-yyyy'
                });
				jQuery('#DrivingLicenceRenewDate').datepicker({
                	autoclose: true,
                	todayHighlight: true,
					format:'dd-mm-yyyy'
                });
				});
				
				function getotheroption(){
				
				var str= document.getElementById('company_code').value;
				//alert('hi');
				 
					  if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp=new XMLHttpRequest();
					  } else { // code for IE6, IE5
						xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
					  }
					  xmlhttp.onreadystatechange=function() {
						if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						 // alert(xmlhttp.responseText);
						  document.getElementById("DesignationID").innerHTML=xmlhttp.responseText;
						
						}
					  }
					  xmlhttp.open("GET","<?php echo base_url(); ?>index.php/Company/getdestinationcomp/"+str,true);
					  xmlhttp.send();
				
				 
					  if (window.XMLHttpRequest) {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp2=new XMLHttpRequest();
					  } else { // code for IE6, IE5
						xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
					  }
					  xmlhttp2.onreadystatechange=function() {
						if (xmlhttp2.readyState==4 && xmlhttp2.status==200) {
						 // alert(xmlhttp2.responseText);
						  document.getElementById("BankID").innerHTML=xmlhttp2.responseText;
						
						}
					  }
					  xmlhttp2.open("GET","<?php echo base_url(); ?>index.php/Company/getbankcomp/"+str,true);
					  xmlhttp2.send();
					  
				
				}

		</script>