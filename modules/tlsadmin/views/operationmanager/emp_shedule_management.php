<div class="content">
					<div class="container">

						<!-- Page-Title -->
						<div class="row">
							<div class="col-sm-12"><br/>
								<h4 class="page-title">Employee Shedule Management</h4>
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
													<th>AWB/Inv.</th>
                                                    <th>reference no.</th>
                                                    <th>Courier compnay</th>
                                                    <th>Company Name </th>
                                                    <th>Phone No.</th>                                                    
													<th>Delivery Address</th>
													<th>Received Date n time</th>
													<th>Expected date of delivery</th>
													<th>Assigned to courier boys</th>
													<th>Delivery Process</th>
													<th>Transactional status</th>
													<th>Handover to</th>
													<th>Handover to Branch</th>
													<th>Status updated by</th>
													<th>Status</th>
													<th>Payment Mode</th>
													<th>Amt</th>
                                                </tr>
                                            </thead>


                                            <tbody>
											
                                                <tr>
												   <td>1</td>
                                                    <td>02145748</td>
                                                    <td>02145748</td>
                                                    
													 <td>DHL</td>
													   <td>DHL</td>
													    <td>02145748417</td>
														 <td>33 & 33A, Rama Road Industrial Area, Kirti Nagar, NewYork - 110015 (USA)</td>
														   <td>22th Feb, 2013</td>
													<td>22th Feb, 2013</td>
													<td>&nbsp;</td>
													<td>Process</td>
													<td>---</td>
													<td>---</td>
													<td>---</td>
													<td>Rose White</td>
													<td>New</td>
													<td>Cash</td>
													<td>&nbsp;</td>
													
                                                </tr>
												
												<tr>
												   <td>2</td>
                                                    <td>02145748</td>
                                                    <td>02145748</td>
                                                    
													 <td>DHL</td>
													   <td>DHL</td>
													    <td>02145748417</td>
														 <td>33 & 33A, Rama Road Industrial Area, Kirti Nagar, NewYork - 110015 (USA)</td>
														   <td>22th Feb, 2013</td>
													<td>22th Feb, 2013</td>
													<td>&nbsp;</td>
													<td>Process</td>
													<td>---</td>
													<td>---</td>
													<td>---</td>
													<td>Rose White</td>
													<td>New</td>
													<td>Cash</td>
													<td>&nbsp;</td>
													
                                                </tr>
												
												<tr>
												   <td>3</td>
                                                    <td>02145748</td>
                                                    <td>02145748</td>
                                                    
													 <td>DHL</td>
													   <td>DHL</td>
													    <td>02145748417</td>
														 <td>33 & 33A, Rama Road Industrial Area, Kirti Nagar, NewYork - 110015 (USA)</td>
														   <td>22th Feb, 2013</td>
													<td>22th Feb, 2013</td>
													<td>&nbsp;</td>
													<td>Process</td>
													<td>---</td>
													<td>---</td>
													<td>---</td>
													<td>Rose White</td>
													<td>New</td>
													<td>Cash</td>
													<td>&nbsp;</td>
													
                                                </tr>
												
												<tr>
												   <td>4</td>
                                                    <td>02145748</td>
                                                    <td>02145748</td>
                                                    
													 <td>DHL</td>
													   <td>DHL</td>
													    <td>02145748417</td>
														 <td>33 & 33A, Rama Road Industrial Area, Kirti Nagar, NewYork - 110015 (USA)</td>
														   <td>22th Feb, 2013</td>
													<td>22th Feb, 2013</td>
													<td>&nbsp;</td>
													<td>Process</td>
													<td>---</td>
													<td>---</td>
													<td>---</td>
													<td>Rose White</td>
													<td>New</td>
													<td>Cash</td>
													<td>&nbsp;</td>
													
                                                </tr>
												
												<tr>
												   <td>5</td>
                                                    <td>02145748</td>
                                                    <td>02145748</td>
                                                    
													 <td>DHL</td>
													   <td>DHL</td>
													    <td>02145748417</td>
														 <td>33 & 33A, Rama Road Industrial Area, Kirti Nagar, NewYork - 110015 (USA)</td>
														   <td>22th Feb, 2013</td>
													<td>22th Feb, 2013</td>
													<td>&nbsp;</td>
													<td>Process</td>
													<td>---</td>
													<td>---</td>
													<td>---</td>
													<td>Rose White</td>
													<td>New</td>
													<td>Cash</td>
													<td>&nbsp;</td>
													
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