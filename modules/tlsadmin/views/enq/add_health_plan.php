<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12">
								<h4 class="page-title">Quote Booked</h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a>
									</li>
									<li class="active">
										Quote booked List
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
													<th>Quote booked</th>
                                                    <th>Quote List</th>
                                                    <!--<th>DateOfBirth</th>
                                                    <th>DesignationID</th>
                                                    <th>DateOfJoin</th>
                                                    <th>BasicSalary</th>-->
													<th>Contact No.</th>
													<th>Permanent Address</th>
													<!--<th>HP2</th>
													<th>HP3</th>
													<th>HomePhone1</th>
													<th>HomePhone2</th>
													<th>PermanentAddress</th>
													<th>CommunicationAddress</th>-->
													<th>Status</th>
													<th style="width: 90px;text-align: center;">Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
											<?php 
											$i=1;
											/*foreach($employee_list as $e) { ?>
                                                <tr>
												   <td><?php echo $i;?></td>
                                                    <td><?php foreach($company_list as $company){

										echo ($e->CompanyCode == $company->SID)?$company->CompanyName:''; 

										} ?><?php echo $e->CompanyCode;?></td>
                                                    <td><?php echo $e->EmployeeFirstName." ".$e->EmployeeLastName;?></td>
                                                    <!--<td><?php echo date('d-m-Y',strtotime($e->DateOfBirth));?></td>
                                                    <td><?php echo $e->DesignationID;?></td>
                                                    <td><?php echo date('d-m-Y',strtotime($e->DateOfJoin));?></td>
                                                    <td><?php echo $e->BasicSalary;?></td>-->
													 <td><?php echo $e->HP1;?><?php echo ($e->HP2 == true)?'/'.$e->HP2:'';?><?php echo ($e->HP3 == true)?'/'.$e->HP3:'';?></td>
													   <td><?php echo $e->PermanentAddress;?></td>
													    <!--<td><?php echo $e->HomePhone1;?></td>
														 <td><?php echo $e->HomePhone2;?></td>
														   <td><?php echo $e->PermanentAddress;?></td>
														 <td><?php echo $e->CommunicationAddress;?></td>-->
														  <td align="center"><?php echo ($e->ActiveStatus == '1')?'Yes':'No';?></td>
													<td style="font-size:16px;text-align: center;"><a href="<?php echo base_url().'index.php/Employee/edit/'.$e->SID ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="<?php echo base_url().'index.php/Employee/employee_delete/'.$e->SID ?>"><i class="fa fa-trash
													"></i></a></td>
													
                                                </tr>
												<?php
												$i++;
											}*/
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