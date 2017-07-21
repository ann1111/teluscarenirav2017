<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12">
								<h4 class="page-title">View Order</h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a>
									</li>
									<li class="active">
										View Order List
									</li>
									
								</ol>
							</div>
						</div>

                        

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
													<th>No.</th>
													<th>Order To</th>
                                                    <th>Order From </th>                                                 
													<th>Service	</th>
													<th>Quote ID</th>												
													<th>Order Status</th>
													<th>Order Date</th>
                                                </tr>
                                            </thead>


                                            <tbody>
											<?php 
											
											//print_r($vieworders);
											$i=1;
											foreach($vieworders as $vorder){ ?>
											
											 <tr>
										   <td><?php echo $vorder['id'];?></td>
											 <td><?php echo $vorder['vendor_id'];?></td>
											  <td><?php echo $vorder['user_id'];?></td>
											   <td><?php echo $vorder['service_name'];?></td>
											    <td><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/quote_bookededit/'.$vorder['manage_quote_id']; ?>"><?php echo $vorder['manage_quote_id'];?></a></td>
												 <td><?php echo $vorder['order_status'];?></td>
												  <td><?php echo $vorder['date_added'];?></td>
											
											</tr>
											
										<?php 	}
								
												?>
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