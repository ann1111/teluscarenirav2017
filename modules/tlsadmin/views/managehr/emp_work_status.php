<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12"><br/>
								<h4 class="page-title">Employee work Status</h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a>
									</li>
									<li class="active">
										Employee work Status
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
													<th>Employee Name</th>
                                                    <th>Employee ID</th>
                                                    <th>Designation</th>
                                                    <th>iPost Code</th>
                                                    <th>Reason</th>                                                    
													<th>Requested For</th>
													<th>Date (From)</th>
													<th>Date (To)</th>
													<th style="width: 90px;text-align: center;">Option</th>
													<th>See Application</th>
                                                </tr>
                                            </thead>


                                            <tbody>
											
                                                <tr>												   
                                                    <td>Mark White</td>
                                                    <td>uro_53753</td>                                                    
													<td>Lorem ipsum</td>
													<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
													<td>02/02/2015</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td><a href="#"><i class="fa fa-edit"></i></a>&nbsp;<a href="#"><i class="fa fa-trash
													"></i></a></td>
													<td>Download</td>
                                                </tr>
												
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