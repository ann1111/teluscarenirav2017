<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12">
								<h4 class="page-title">Quote Negotiate</h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a>
									</li>
									<li class="active">
										Quote Negotiate List
									</li>
									
								</ol>
							</div>
						</div>

                        <?php //print_r($negotiate); ?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
													<th>Post Date</th>
                                                    <th>Kind Of Request</th>
                                                    <th>Request From</th>
                                                    <th>Request To</th>
                                                    <th>Quote via</th>
                                                    <th>State of Quote</th>
													<th>Kind of Product</th>
													<th>Kind of subproduct</th>
													<th>status of order</th>
													<th>quote proof attachment</th>
													<th>Action/Appointment</th>
													<th>Feedback by admin/Remark</th>												
                                                </tr>
                                            </thead>


                                            <tbody>
											<?php foreach($negotiate as $bdata){ ?>
											
											<tr>
											<td><?php echo $bdata['id']; ?></td>
											<td><?php echo $bdata['added_date']; ?></td>
											<td>Individual</td>
											<td><?php echo $bdata['Customer_name']; ?></td>
											<td>vendor</td>
											<td>Admin</td>
											<td>Book</td>
											<td>Adhar</td>
											<td>Insurance</td>
											<td>Health</td>
											<td>Confirm</td>
											<td>Bid To Quote</td>
											<td>Good</td>
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