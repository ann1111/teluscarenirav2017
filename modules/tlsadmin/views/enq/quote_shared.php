<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12">
								<h4 class="page-title">Quote Saved</h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a>
									</li>
									<li class="active">
										Quote Saved List
									</li>
									
								</ol>
							</div>
						</div>

                        <?php //print_r($saving_data); ?>
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
                                                    <th>Request To</th>
                                                    <th>Quote via</th>
                                                    <th>State of Quote</th>
													<th>Kind of Product</th>
													<th>Kind of subproduct</th>
													<th>status of order</th>
													<th>Quote proof attachment</th>
													<th>Total</th>			
													<th>Action/Appointment</th>
													<th>Feedback by admin/Remark</th>																									
                                                </tr>
                                            </thead>


                                            <tbody>
											<?php 
											
											foreach($saving_data as $bdata){ 
											
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
											<td><?php echo $bdata['custname']; ?></td>
											<td><?php echo $bdata['user_name']; ?></td>
											<td><?php echo $bdata['mq_quote_via'].'Front End'; ?></td>
											<td><?php echo $stateofquote; ?></td>
											<td><?php echo $bdata['mq_product']; ?></td>
											<td><?php echo $bdata['mq_subproduct']; ?></td>
											<td><?php echo  $orderstatus; ?></td>
											<td><?php $docproof = explode('~',$bdata['mq_proof_attachment']); 
											$i = 1;
											foreach($docproof as $proof){
											
											echo '<a href="'. base_url().$proof . '">Doc  '.$i.'</a><br/>';
											
											$i++;
											
											}
											
											?></td>
											<td><?php echo $bdata['mq_total_quote']; ?> AED</td>
										    <td style="font-size:16px;text-align: center;"><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/quote_bookededit/'.$bdata['mq_id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="#"><!--i class="fa fa-trash
													"></i--></a>
											</td>
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
			   { "bSortable": false }
			] } );
			$('#datatable').dataTable();
			$('#clist').addClass('active');
			$('#new').removeClass('active');
		} );
        </script>