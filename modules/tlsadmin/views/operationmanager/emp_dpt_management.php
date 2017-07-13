<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12"><br/>
								<h4 class="page-title">Employee Department Management</h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a>
									</li>
									<li class="active">
										Employee List
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
													<th>Name</th>
                                                    <th>Employee ID</th>
                                                    <th>Designation</th>
                                                    <th>Department</th>
                                                    <th>code</th>                                                    
													<th>Provide Password</th>
													<th>Online A/C status</th>
													<!--<th>HP2</th>
													<th>HP3</th>
													<th>HomePhone1</th>
													<th>HomePhone2</th>
													<th>PermanentAddress</th>
													<th>CommunicationAddress</th>
													<th>Status</th>-->
													<th style="width: 90px;text-align: center;">Option</th>
                                                </tr>
                                            </thead>


                                            <tbody>
											
                                                <tr>
												   <td>1</td>
                                                    <td>Mark White</td>
                                                    <td>12345</td>
                                                    
													 <td>Manager</td>
													   <td>Marketing</td>
													    <td>&nbsp;</td>
														 <td>&nbsp;</td>
														   <td>Active/Deactive</td>
													<td><a href="#"><i class="fa fa-edit"></i></a>&nbsp;<a href="#"><i class="fa fa-trash
													"></i></a></td>
													
                                                </tr>
												
												<tr>
												   <td>2</td>
                                                    <td>Mark White</td>
                                                    <td>12345</td>
                                                    
													 <td>Manager</td>
													   <td>Marketing</td>
													    <td>&nbsp;</td>
														 <td>&nbsp;</td>
														   <td>Active/Deactive</td>
													<td><a href="#"><i class="fa fa-edit"></i></a>&nbsp;<a href="#"><i class="fa fa-trash
													"></i></a></td>
													
                                                </tr>
												
												<tr>
												   <td>3</td>
                                                    <td>Mark White</td>
                                                    <td>12345</td>
                                                    
													 <td>Manager</td>
													   <td>Marketing</td>
													    <td>&nbsp;</td>
														 <td>&nbsp;</td>
														   <td>Active/Deactive</td>
													<td><a href="#"><i class="fa fa-edit"></i></a>&nbsp;<a href="#"><i class="fa fa-trash
													"></i></a></td>
													
                                                </tr>
												
												<tr>
												   <td>4</td>
                                                    <td>Mark White</td>
                                                    <td>12345</td>
                                                    
													 <td>Manager</td>
													   <td>Marketing</td>
													    <td>&nbsp;</td>
														 <td>&nbsp;</td>
														   <td>Active/Deactive</td>
													<td><a href="#"><i class="fa fa-edit"></i></a>&nbsp;<a href="#"><i class="fa fa-trash
													"></i></a></td>
													
                                                </tr>
												
												<tr>
												   <td>5</td>
                                                    <td>Mark White</td>
                                                    <td>12345</td>
                                                    
													 <td>Manager</td>
													   <td>Marketing</td>
													    <td>&nbsp;</td>
														 <td>&nbsp;</td>
														   <td>Active/Deactive</td>
													<td><a href="#"><i class="fa fa-edit"></i></a>&nbsp;<a href="#"><i class="fa fa-trash
													"></i></a></td>
													
                                                </tr>
												
												<tr>
												   <td>6</td>
                                                    <td>Mark White</td>
                                                    <td>12345</td>
                                                    
													 <td>Manager</td>
													   <td>Marketing</td>
													    <td>&nbsp;</td>
														 <td>&nbsp;</td>
														   <td>Active/Deactive</td>
													<td><a href="#"><i class="fa fa-edit"></i></a>&nbsp;<a href="#"><i class="fa fa-trash
													"></i></a></td>
													
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