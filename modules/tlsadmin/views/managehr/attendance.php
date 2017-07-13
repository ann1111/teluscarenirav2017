<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12">
								<h4 class="page-title">Attendance</h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a>
									</li>
									<li class="active">
										Attendance
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
                                                    <th>Select</th>
													<th>Employee Details</th>
                                                    <th>Employee ID</th>
													<th>Desgination</th>
                                                    <th>Assigned branch name</th>
                                                    <th>Kind of identity</th>
                                                    <th>Ipost code</th>													
													<th>Status</th>
                                                </tr>
                                            </thead>


                                            <tbody>
											<tr><td>1.</td>
											<td>Matt Henry <br> matt_henry@gmail.com <br>07025365421</td>
											<td>12345</td>
											<td>Manager</td>
											<td>&nbsp;</td>
											<td>hub/sbu or sbp which will come from add hub sbu n sbp</td>
											<td>from add of own hub sbp n sbu</td>
											<td>Present</td></tr>										
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