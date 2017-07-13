<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12">
								<h4 class="page-title">Requested Quote</h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a>
									</li>
									<li class="active">
										Requested Quote List
									</li>
									
								</ol>
							</div>
						</div>

                        

                       
                        <div class="row">
                            <div>
                                <div class="card-box" style="overflow-x: scroll;">
                                    <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
													<th>Post Date</th>
                                                    <th style="width:135px;">Kind Of Request</th>
                                                    <th >Request From</th>
                                                    <th>Vendor/Seller/Agent</th>
                                                    <th>Quote via</th>
                                                    <th>State of Quote</th>
													<th>Kind of Product</th>													
													<th>Status of Order</th>														
													<th>Total</th>												
													<th>Request</th>
													<th>Feedback by admin/Remark</th>
																																							
                                                </tr>
                                            </thead>


                                            <tbody>
											<?php 
											
											foreach($requastaquote as $bdata){ 
											
											switch ($bdata['mq_state_of_quote']) {
											
											case 'B':
											$stateofquote = 'Booked'; 
											break;
											case 'C':
												$stateofquote = 'Confirmed'; 
											break;
											case 'N':
											$stateofquote = 'Negotiate'; 
											break;
											case 'BD':
											$stateofquote = 'Bid of Quote'; 
											   break;
											case 'S':
											$stateofquote = 'Saved'; 
											    break;
											default:
												$stateofquote = 'Saved'; 
										}

											switch ($bdata['mq_orderstatus']) {
											
											case '1':
											$orderstatus = 'Completed'; 
											break;
											case '2':
											$orderstatus = 'Postpone/Change'; 
											break;
											case '3':
											$orderstatus = 'Cancel/RTO'; 
											break;
											case '4':
											$orderstatus = 'Pending'; 
											   break;
											
											default:
												$orderstatus = 'Pending'; 
										}
											//print_r($bdata); ?>
											
											<tr>
											<td><?php echo $bdata['mq_id']; ?></td>
											<td><?php echo  $bdata['mq_post_date']	; ?></td>
											<td><?php echo  ($bdata['mq_kind_of_request'] == '1')?'Customer':'Vendor'; ?></td>
											<td><?php echo $bdata['mq_request_from']; ?></td>
											<td><?php echo $bdata['user_name']; ?></td>
											<td><?php echo $bdata['mq_quote_via'].'Front End'; ?></td>
											<td><?php echo $stateofquote; ?></td>
											<td><?php echo $bdata['mq_product']; ?></td>											
											<td><?php echo  $orderstatus; ?></td>											
											<td><?php echo $bdata['mq_total_quote']; ?> AED</td>										 
											<td><button type="submit" name="Update" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal<?php echo $bdata['mq_id']; ?>" value="Update">
													Request Quote												</button>
													<!-- Modal -->
												<div id="myModal<?php echo $bdata['mq_id']; ?>" class="modal fade" role="dialog">
												  <div class="modal-dialog">

													<!-- Modal content-->
													<div class="modal-content">
													  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Request A Quote</h4>
													  </div>
													  <div class="modal-body">
<form class="form-horizontal" action="<?php echo base_url(); ?>tlsadmin/enq/Manageenquiryonline/postrequestquote" method="post" role="form" >
									
									<div class="form-group">
									<label for="ActiveStatus" class="col-sm-3 control-label">Subject*</label>
									<div class="col-sm-7">
									<input type="text" class="form-control" id="Subject" name="Subject" placeholder="Subject" required/>
									<input type="hidden" class="form-control" id="quoteid" name="quoteid" placeholder="Subject" value="<?php echo $bdata['mq_id']; ?>" required/>
									</div>
									</div>
									
									   <div class="form-group">
                                       <label for="HP3" class="col-sm-3 control-label">Request*</label>
                                       <div class="col-sm-7">
										<textarea class="form-control" id="Remarks" name="Remarks" placeholder="Request" required></textarea>
										</div>
                                        </div>
						
											<div class="form-group">
											<label for="ActiveStatus" class="col-sm-3 control-label">Preferred Quote*</label>
											<div class="col-sm-7">
											<input type="text" class="form-control" id="PreferredQuote" name="PreferredQuote" placeholder="Preferred Quote" required/> AED
											</div>
											</div>
											<center><input type="submit" class="btn btn-success" value="Request" /></center>
									</form>
													  </div>
													  <div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													  </div>
													</div>

												  </div>
												</div></td>
											<td><?php echo $bdata['mq_feedback']; ?></td>
											
											</tr>
											
											<?php } ?>
											</tbody>
                                        </table>
                                </div>
                            </div>
                        </div>


                    </div> <!-- container -->
                               
                </div> <!-- content -->
				<script type="text/javascript">
           $(document).ready(function() {
			    
			$('#datatable').dataTable( {
			"aoColumns": [
			null,
			null,
			null,
			null,
			null,
			 null,
			  null,
			  null,
			  null,
			  null,				  
			   { "bSortable": true }
			] } );
			$('#datatable').dataTable();
			$('#clist').addClass('active');
			$('#new').removeClass('active');
		} );
        </script>
		<script>
<?php if($this->input->get('success') == true){?>

alert('Request send successfully !');

<?php } ?>
</script>