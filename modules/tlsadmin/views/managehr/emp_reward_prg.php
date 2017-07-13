<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12"><br/>
								<h4 class="page-title">Employee Reward Programme</h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a>
									</li>
									<li class="active">
										Employee Reward Programme
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
                                                    <th>S.No.</th>
													<th>Employee Name</th>
                                                    <th>Employee ID</th>
                                                    <th>Designation</th>
                                                    <th>Rewards</th>
                                                    <th>Comments</th>
													<th style="width: 90px;text-align: center;">Option</th>
                                                </tr>
                                            </thead>


                                            <tbody>
											
                                                <tr>
												   <td>1</td>
                                                    <td>Mark White</td>
                                                    <td>ywot_4262</td>
                                                    <td>Designer</td>
													<td>Increment<br>$12.00</td>
													<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</td>
													<td><a href="#"><i class="fa fa-trash
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