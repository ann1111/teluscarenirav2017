<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12">
								<h4 class="page-title">Added Order</h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo base_url().'index.php/Login/dashboard' ?>">Dashboard</a>
									</li>
									<li class="active">
										Added Order List
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
													<th>Vender/Seller/Company</th>
                                                    <th>Type of service</th>                                                 
													<th>Policy Status</th>
													<th>Order Status</th>												
													<th>Policy Doc</th>
													
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