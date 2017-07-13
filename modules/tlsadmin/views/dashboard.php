    <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            <button type="button" class="btn btn-default dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false" 
							style="margin-bottom: 15px;">Settings <span class="m-l-5"><i class="fa fa-cog"></i></span></button>
                            <ul class="dropdown-menu drop-menu-right" role="menu">
                                <li><a href="#">Change Password</a></li>
                                <li><a href="#">Edit Account</a></li>
                                <li><a href="<?php echo base_url(); ?>index.php/Login/logoutuser">Log Out</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Manage Dashboard</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
				
				 <?php
				 if($this->session->userdata('usertype') == '2'){ ?>
				  <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 text-center  bg-white">
                          <img src="http://www.o24shop.net/img/commodity/s/noimage.jpg" alt="user-img" class="img-circle" style="width: 170px;"/>
						<br/><div class="pull-righct" style="margin-top: 14px;"><?php 	echo 'Welcome <b>'. $this->session->userdata('first_name'). ' !</b>'; ?>
						<br/><br/><?php 	echo 'User Type : <b>'. "Vendor". ' </b>'; ?>
						<br/><br/>1001, Burj Khalifa , Dubai, UAE
						</div>					
                        </div>
						<br/>
                    </div>
					<div class="col-md-6 col-sm-6 col-lg-9">
					 <div class="row">
					  <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">Quote Received</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup">185</span></h2>
                            <p class="text-muted">Total sales: 12398 <span class="pull-right"><i class="fa fa-caret-down text-danger m-r-5"></i>7.85%</span></p>
                        </div>
                    </div>
					<div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">Quote InProcess </h4>
                            <h2 class="text-warning text-center"><span data-plugin="counterup">874</span></h2>
                            <p class="text-muted">Total Quote: 2398 <span class="pull-right"><i class="fa fa-caret-down text-danger m-r-5"></i>7.85%</span></p>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">Tenders In Admin</h4>
                            <h2 class="text-success text-center">AED<span data-plugin="counterup">9562</span></h2>
                            <p class="text-muted">Total Payment: $22506 <span class="pull-right"><i class="fa fa-caret-up text-primary m-r-5"></i>10.25%</span></p>
                        </div>
                    </div>
					<div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">Payment Success</h4>
                            <h2 class="text-success text-center">AED<span data-plugin="counterup">9562</span></h2>
                            <p class="text-muted">Total Payment: $22506 <span class="pull-right"><i class="fa fa-caret-up text-primary m-r-5"></i>10.25%</span></p>
                        </div>
                    </div>
					</div>
					<div class="row">
					<div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">Complains</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup">185</span></h2>
                            <p class="text-muted">Total sales: 12398 <span class="pull-right"><i class="fa fa-caret-down text-danger m-r-5"></i>7.85%</span></p>
                        </div>
                    </div>
					<div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">Queue</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup">185</span></h2>
                            <p class="text-muted">Total sales: 12398 <span class="pull-right"><i class="fa fa-caret-down text-danger m-r-5"></i>7.85%</span></p>
                        </div>
                    </div>
					<div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">Suggestions</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup">185</span></h2>
                            <p class="text-muted">Total sales: 12398 <span class="pull-right"><i class="fa fa-caret-down text-danger m-r-5"></i>7.85%</span></p>
                        </div>
                    </div>
					</div>
					</div>
				  </div>
				  
				  
				  
				 <div class="row">				 
				 <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Manage Your Documents
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover mails m-0 table table-actions-bar">
                                            <thead>
                                                <tr>
                                                    <th style="min-width: 95px;">
                                                       
                                                        <div class="btn-group dropdown">
                                                           
                                                        </div>
                                                    </th>
                                                    <th>Document Name</th>
													<th>Document Type</th>
                                                    <th>Url</th>                                                    
													<th>Status</th>
                                                    <th style="min-width: 90px;">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr class="active">
                                                    <td>
                                                       
                                                        <img src="<?php echo base_url(); ?>assets2/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm">
                                                    </td>

                                                    <td>
                                                       Nirav Chauhan
                                                    </td>
													<td>
                                                        Driving Licence
                                                    </td>

                                                    <td>
                                                        <a href="#">dddd.com/picencepic.jpg</a>
                                                    </td>

                                                    <td>
                                                        <b>Approved</b>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>

                                                  <tr class="active">
                                                    <td>
                                                       
                                                        <img src="<?php echo base_url(); ?>assets2/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm">
                                                    </td>

                                                    <td>
                                                       Nirav Chauhan
                                                    </td>
													<td>
                                                        Driving Licence
                                                    </td>

                                                    <td>
                                                        <a href="#">dddd.com/picencepic.jpg</a>
                                                    </td>

                                                    <td>
                                                        <b>Approved</b>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>

                                                 <tr class="active">
                                                    <td>
                                                       
                                                        <img src="<?php echo base_url(); ?>assets2/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm">
                                                    </td>

                                                    <td>
                                                       Nirav Chauhan
                                                    </td>
													<td>
                                                        Driving Licence
                                                    </td>

                                                    <td>
                                                        <a href="#">dddd.com/picencepic.jpg</a>
                                                    </td>

                                                    <td>
                                                        <b>Approved</b>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>

                                                 <tr class="active">
                                                    <td>
                                                       
                                                        <img src="<?php echo base_url(); ?>assets2/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm">
                                                    </td>

                                                    <td>
                                                       Nirav Chauhan
                                                    </td>
													<td>
                                                        Driving Licence
                                                    </td>

                                                    <td>
                                                        <a href="#">dddd.com/picencepic.jpg</a>
                                                    </td>

                                                    <td>
                                                        <b>Approved</b>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
					</div>
				  
				 <?php } ?>
                <?php if($this->session->userdata('usertype') != '2'){
				//print_r($this->session->userdata);
				?>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 text-center  bg-white">
                          <img src="http://www.o24shop.net/img/commodity/s/noimage.jpg" alt="user-img" class="img-circle" style="width: 170px;" />
						<br/><div class="pull-righct" style="margin-top: 14px;"><?php 	echo 'Welcome <b>'. $this->session->userdata('first_name'). ' !</b>'; ?>
						<br/><br/><?php 	echo 'User Type : <b>'. "Consumer". ' </b>'; ?>
						<br/><br/>1001, Burj Khalifa , Dubai, UAE
						</div>
					
                        </div>
						<br/>
                    </div>
					<div class="col-lg-9">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Manage Vendors
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover mails m-0 table table-actions-bar">
                                            <thead>
                                                <tr>
                                                    <th style="min-width: 95px;">
                                                       
                                                        <div class="btn-group dropdown">
                                                           
                                                        </div>
                                                    </th>
                                                    <th>Vendor Name</th>
													<th>Service Type</th>
                                                    <!--th>Email</th>
                                                    <th>Phone</th-->
                                                    <th>Start Date</th>
													<th>Status</th>
                                                    <th style="min-width: 90px;">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr class="active">
                                                    <td>
                                                       
                                                        <img src="<?php echo base_url(); ?>assets2/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm">
                                                    </td>

                                                    <td>
                                                        Vendor 1
                                                    </td>
													<td>
                                                        Cleaning
                                                    </td>

                                                    <!--td>
                                                        <a href="#">tomaslau@dummy.com</a>
                                                    </td>

                                                    <td>
                                                        <b><a href="" class="text-dark"><b>356</b></a> </b>
                                                    </td-->

                                                    <td>
                                                        01/5/2017
                                                    </td>
													 <td>
													 In Process 
													 </td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                         <img src="<?php echo base_url(); ?>assets2/images/users/avatar-1.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm">
                                                    </td>

                                                    <td>
                                                         Vendor 2
                                                    </td>
													<td>
                                                        Cleaning
                                                    </td>
                                                    <!--td>
                                                        <a href="#">chadengle@dummy.com</a>
                                                    </td>

                                                    <td>
                                                        <b><a href="" class="text-dark"><b>568</b></a> </b>
                                                    </td-->

                                                    <td>
                                                        01/5/2017
                                                    </td>
													 <td>
													Completed
													 </td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                       
                                                        <img src="<?php echo base_url(); ?>assets2/images/users/avatar-3.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm">
                                                    </td>

                                                    <td>
                                                         Vendor 3
                                                    </td>
<td>
                                                        Pest
                                                    </td>
                                                    <!--td>
                                                        <a href="#">stillnotdavid@dummy.com</a>
                                                    </td>
                                                    <td>
                                                        <b><a href="" class="text-dark"><b>201</b></a> </b>
                                                    </td-->

                                                    <td>
                                                        12/5/2017
                                                    </td>
													 <td>
													 In Process 
													 </td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                         <img src="<?php echo base_url(); ?>assets2/images/users/avatar-4.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm">
                                                    </td>

                                                    <td>
                                                         Vendor 4
                                                    </td>
													<td>
                                                        Cleaning
                                                    </td>
                                                    <!--td>
                                                        <a href="#">kurafire@dummy.com</a>
                                                    </td>

                                                    <td>
                                                        <b><a href="" class="text-dark"><b>56</b></a> </b>
                                                    </td-->

                                                    <td>
                                                        14/5/2017
                                                    </td>
													 <td>
													 In Process 
													 </td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                 
                </div>
				 <div class="row">
				 
				 <div class="col-lg-12">

                        <div class="portlet"><!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark text-uppercase">
                                    Manage Your Documents
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="portlet2" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover mails m-0 table table-actions-bar">
                                            <thead>
                                                <tr>
                                                    <th style="min-width: 95px;">
                                                       
                                                        <div class="btn-group dropdown">
                                                           
                                                        </div>
                                                    </th>
                                                    <th>Document Name</th>
													<th>Document Type</th>
                                                    <th>Url</th>                                                    
													<th>Status</th>
                                                    <th style="min-width: 90px;">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr class="active">
                                                    <td>
                                                       
                                                        <img src="<?php echo base_url(); ?>assets2/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm">
                                                    </td>

                                                    <td>
                                                       Nirav Chauhan
                                                    </td>
													<td>
                                                        Driving Licence
                                                    </td>

                                                    <td>
                                                        <a href="#">dddd.com/picencepic.jpg</a>
                                                    </td>

                                                    <td>
                                                        <b>Approved</b>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>

                                                  <tr class="active">
                                                    <td>
                                                       
                                                        <img src="<?php echo base_url(); ?>assets2/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm">
                                                    </td>

                                                    <td>
                                                       Nirav Chauhan
                                                    </td>
													<td>
                                                        Driving Licence
                                                    </td>

                                                    <td>
                                                        <a href="#">dddd.com/picencepic.jpg</a>
                                                    </td>

                                                    <td>
                                                        <b>Approved</b>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>

                                                 <tr class="active">
                                                    <td>
                                                       
                                                        <img src="<?php echo base_url(); ?>assets2/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm">
                                                    </td>

                                                    <td>
                                                       Nirav Chauhan
                                                    </td>
													<td>
                                                        Driving Licence
                                                    </td>

                                                    <td>
                                                        <a href="#">dddd.com/picencepic.jpg</a>
                                                    </td>

                                                    <td>
                                                        <b>Approved</b>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>

                                                 <tr class="active">
                                                    <td>
                                                       
                                                        <img src="<?php echo base_url(); ?>assets2/images/users/avatar-2.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm">
                                                    </td>

                                                    <td>
                                                       Nirav Chauhan
                                                    </td>
													<td>
                                                        Driving Licence
                                                    </td>

                                                    <td>
                                                        <a href="#">dddd.com/picencepic.jpg</a>
                                                    </td>

                                                    <td>
                                                        <b>Approved</b>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                        <a href="#" class="table-action-btn"><i class="md md-close"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
					
				 
				 </div>
				 <div class="row">
					<div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">Quote Received</h4>
                            <h2 class="text-pink text-center"><span data-plugin="counterup">185</span></h2>
                            <p class="text-muted">Total sales: 12398 <span class="pull-right"><i class="fa fa-caret-down text-danger m-r-5"></i>7.85%</span></p>
                        </div>
                    </div>
					<div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">Quote Under In Process </h4>
                            <h2 class="text-warning text-center"><span data-plugin="counterup">874</span></h2>
                            <p class="text-muted">Total Quote: 2398 <span class="pull-right"><i class="fa fa-caret-down text-danger m-r-5"></i>7.85%</span></p>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">Tenders to Admin</h4>
                            <h2 class="text-success text-center">AED<span data-plugin="counterup">9562</span></h2>
                            <p class="text-muted">Total Payment: $22506 <span class="pull-right"><i class="fa fa-caret-up text-primary m-r-5"></i>10.25%</span></p>
                        </div>
                    </div>
					<div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card-box widget-box-1 bg-white">
                            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                            <h4 class="text-dark">Payment Success</h4>
                            <h2 class="text-success text-center">AED<span data-plugin="counterup">9562</span></h2>
                            <p class="text-muted">Total Payment: $22506 <span class="pull-right"><i class="fa fa-caret-up text-primary m-r-5"></i>10.25%</span></p>
                        </div>
                    </div>
					
					 </div>
					 
				<?php if($this->session->userdata('usertype') != '1'){ ?>		
                <!-- BAR Chart -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="portlet">
                            <!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark"> Total Revenue </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default1"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="bg-default1" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="text-center">
                                        <ul class="list-inline chart-detail-list">
                                            <li>
                                                <h5><i class="fa fa-circle m-r-5" style="color: #3ac9d6;"></i>Series A</h5>
                                            </li>
                                            <li>
                                                <h5><i class="fa fa-circle m-r-5" style="color: #f9c851;"></i>Series B</h5>
                                            </li>
                                            <li>
                                                <h5><i class="fa fa-circle m-r-5" style="color: #ebeff2;"></i>Series C</h5>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="morris-bar-example" style="height: 300px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="300" version="1.1" width="550" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; left: -0.453125px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="33.5" y="261" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#eeeeee" d="M46,261H525" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="202" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">25</tspan></text><path fill="none" stroke="#eeeeee" d="M46,202H525" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="143" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">50</tspan></text><path fill="none" stroke="#eeeeee" d="M46,143H525" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="84" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75</tspan></text><path fill="none" stroke="#eeeeee" d="M46,84H525" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">100</tspan></text><path fill="none" stroke="#eeeeee" d="M46,25H525" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="490.7857142857143" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2015</tspan></text><text x="353.92857142857144" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013</tspan></text><text x="217.07142857142858" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan></text><text x="80.21428571428572" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2009</tspan></text><rect x="54.55357142857143" y="25" width="15.107142857142856" height="236" rx="0" ry="0" fill="#3ac9d6" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="72.66071428571428" y="48.60000000000002" width="15.107142857142856" height="212.39999999999998" rx="0" ry="0" fill="#f9c851" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="90.76785714285714" y="166.60000000000002" width="15.107142857142856" height="94.39999999999998" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="122.98214285714286" y="84" width="15.107142857142856" height="177" rx="0" ry="0" fill="#3ac9d6" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="141.08928571428572" y="107.6" width="15.107142857142856" height="153.4" rx="0" ry="0" fill="#f9c851" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="159.19642857142856" y="213.8" width="15.107142857142856" height="47.19999999999999" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="191.41071428571428" y="143" width="15.107142857142856" height="118" rx="0" ry="0" fill="#3ac9d6" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="209.51785714285714" y="166.60000000000002" width="15.107142857142856" height="94.39999999999998" rx="0" ry="0" fill="#f9c851" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="227.625" y="143" width="15.107142857142856" height="118" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="259.8392857142857" y="84" width="15.107142857142856" height="177" rx="0" ry="0" fill="#3ac9d6" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="277.94642857142856" y="107.6" width="15.107142857142856" height="153.4" rx="0" ry="0" fill="#f9c851" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="296.05357142857144" y="36.80000000000001" width="15.107142857142856" height="224.2" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="328.26785714285717" y="143" width="15.107142857142856" height="118" rx="0" ry="0" fill="#3ac9d6" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="346.375" y="166.60000000000002" width="15.107142857142856" height="94.39999999999998" rx="0" ry="0" fill="#f9c851" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="364.4821428571429" y="209.08" width="15.107142857142856" height="51.91999999999999" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="396.6964285714286" y="84" width="15.107142857142856" height="177" rx="0" ry="0" fill="#3ac9d6" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="414.80357142857144" y="107.6" width="15.107142857142856" height="153.4" rx="0" ry="0" fill="#f9c851" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="432.91071428571433" y="128.84" width="15.107142857142856" height="132.16" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="465.125" y="25" width="15.107142857142856" height="236" rx="0" ry="0" fill="#3ac9d6" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="483.23214285714283" y="48.60000000000002" width="15.107142857142856" height="212.39999999999998" rx="0" ry="0" fill="#f9c851" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="501.3392857142857" y="119.4" width="15.107142857142856" height="141.6" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect></svg><div class="morris-hover morris-default-style" style="left: 442.286px; top: 101px; display: none;"><div class="morris-hover-row-label">2015</div><div class="morris-hover-point" style="color: #3ac9d6">
  Series A:
  100
</div><div class="morris-hover-point" style="color: #f9c851">
  Series B:
  90
</div><div class="morris-hover-point" style="color: #ebeff2">
  Series C:
  60
</div></div></div>
                                </div>
                            </div>
                        </div>
                        <!-- /Portlet -->
                    </div>
                    <!-- col -->
                    <div class="col-lg-6">
                        <div class="portlet">
                            <!-- /primary heading -->
                            <div class="portlet-heading">
                                <h3 class="portlet-title text-dark"> Sales Analytics </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="ion-minus-round"></i></a>
                                    <span class="divider"></span>
                                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="bg-default" class="panel-collapse collapse in">
                                <div class="portlet-body">
                                    <div class="text-center">
                                        <ul class="list-inline chart-detail-list">
                                            <li>
                                                <h5><i class="fa fa-circle m-r-5" style="color: #4793f5;"></i>Mobiles</h5>
                                            </li>
                                            <li>
                                                <h5><i class="fa fa-circle m-r-5" style="color: #ff3f4e;"></i>Tablets</h5>
                                            </li>
                                            <li>
                                                <h5><i class="fa fa-circle m-r-5" style="color: #bbbbbb;"></i>Desktops</h5>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="morris-area-example" style="height: 300px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="300" version="1.1" width="550" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; left: -0.5px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="33.5" y="261" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#eef0f2" d="M46,261H525" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="202" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">50</tspan></text><path fill="none" stroke="#eef0f2" d="M46,202H525" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="143" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">100</tspan></text><path fill="none" stroke="#eef0f2" d="M46,143H525" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="84" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">150</tspan></text><path fill="none" stroke="#eef0f2" d="M46,84H525" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">200</tspan></text><path fill="none" stroke="#eef0f2" d="M46,25H525" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="525" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2015</tspan></text><text x="445.2031036056595" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2014</tspan></text><text x="365.40620721131904" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013</tspan></text><text x="285.39068918302144" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012</tspan></text><text x="205.59379278868096" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan></text><text x="125.79689639434048" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010</tspan></text><text x="46" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2009</tspan></text><path fill="#e9e9e9" stroke="none" d="M46,190.2C65.94922409858512,157.75,105.84767229575536,69.25,125.79689639434048,60.400000000000006C145.7461204929256,51.55000000000001,185.64456869009584,119.4,205.59379278868096,119.4C225.54301688726608,119.4,265.44146508443635,60.400000000000006,285.39068918302144,60.400000000000006C305.39456869009587,60.400000000000006,345.4023277042446,119.4,365.40620721131904,119.4C385.35543130990413,119.4,425.25387950707443,69.25,445.2031036056595,60.400000000000006C465.1523277042446,51.55000000000001,505.0507759014149,51.55000000000002,525,48.60000000000002L525,261L46,261Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#bbbbbb" d="M46,190.2C65.94922409858512,157.75,105.84767229575536,69.25,125.79689639434048,60.400000000000006C145.7461204929256,51.55000000000001,185.64456869009584,119.4,205.59379278868096,119.4C225.54301688726608,119.4,265.44146508443635,60.400000000000006,285.39068918302144,60.400000000000006C305.39456869009587,60.400000000000006,345.4023277042446,119.4,365.40620721131904,119.4C385.35543130990413,119.4,425.25387950707443,69.25,445.2031036056595,60.400000000000006C465.1523277042446,51.55000000000001,505.0507759014149,51.55000000000002,525,48.60000000000002" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="46" cy="190.2" r="0" fill="#bbbbbb" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="125.79689639434048" cy="60.400000000000006" r="0" fill="#bbbbbb" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="205.59379278868096" cy="119.4" r="0" fill="#bbbbbb" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="285.39068918302144" cy="60.400000000000006" r="0" fill="#bbbbbb" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="365.40620721131904" cy="119.4" r="0" fill="#bbbbbb" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="445.2031036056595" cy="60.400000000000006" r="0" fill="#bbbbbb" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="525" cy="48.60000000000002" r="0" fill="#bbbbbb" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><path fill="#f09ca3" stroke="none" d="M46,225.6C65.94922409858512,193.15,105.84767229575536,104.65,125.79689639434048,95.80000000000001C145.7461204929256,86.95000000000002,185.64456869009584,154.8,205.59379278868096,154.8C225.54301688726608,154.8,265.44146508443635,95.80000000000001,285.39068918302144,95.80000000000001C305.39456869009587,95.80000000000001,345.4023277042446,154.8,365.40620721131904,154.8C385.35543130990413,154.8,425.25387950707443,104.65,445.2031036056595,95.80000000000001C465.1523277042446,86.95000000000002,505.0507759014149,86.95,525,84L525,261L46,261Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#ff3f4e" d="M46,225.6C65.94922409858512,193.15,105.84767229575536,104.65,125.79689639434048,95.80000000000001C145.7461204929256,86.95000000000002,185.64456869009584,154.8,205.59379278868096,154.8C225.54301688726608,154.8,265.44146508443635,95.80000000000001,285.39068918302144,95.80000000000001C305.39456869009587,95.80000000000001,345.4023277042446,154.8,365.40620721131904,154.8C385.35543130990413,154.8,425.25387950707443,104.65,445.2031036056595,95.80000000000001C465.1523277042446,86.95000000000002,505.0507759014149,86.95,525,84" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="46" cy="225.6" r="0" fill="#ff3f4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="125.79689639434048" cy="95.80000000000001" r="0" fill="#ff3f4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="205.59379278868096" cy="154.8" r="0" fill="#ff3f4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="285.39068918302144" cy="95.80000000000001" r="0" fill="#ff3f4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="365.40620721131904" cy="154.8" r="0" fill="#ff3f4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="445.2031036056595" cy="95.80000000000001" r="0" fill="#ff3f4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="525" cy="84" r="0" fill="#ff3f4e" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><path fill="#9ec0ec" stroke="none" d="M46,249.2C65.94922409858512,230.02499999999998,105.84767229575536,178.4,125.79689639434048,172.5C145.7461204929256,166.6,185.64456869009584,202,205.59379278868096,202C225.54301688726608,202,265.44146508443635,172.5,285.39068918302144,172.5C305.39456869009587,172.5,345.4023277042446,202,365.40620721131904,202C385.35543130990413,202,425.25387950707443,178.4,445.2031036056595,172.5C465.1523277042446,166.6,505.0507759014149,159.22500000000002,525,154.8L525,261L46,261Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#4793f5" d="M46,249.2C65.94922409858512,230.02499999999998,105.84767229575536,178.4,125.79689639434048,172.5C145.7461204929256,166.6,185.64456869009584,202,205.59379278868096,202C225.54301688726608,202,265.44146508443635,172.5,285.39068918302144,172.5C305.39456869009587,172.5,345.4023277042446,202,365.40620721131904,202C385.35543130990413,202,425.25387950707443,178.4,445.2031036056595,172.5C465.1523277042446,166.6,505.0507759014149,159.22500000000002,525,154.8" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="46" cy="249.2" r="0" fill="#4793f5" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="125.79689639434048" cy="172.5" r="0" fill="#4793f5" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="205.59379278868096" cy="202" r="0" fill="#4793f5" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="285.39068918302144" cy="172.5" r="0" fill="#4793f5" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="365.40620721131904" cy="202" r="0" fill="#4793f5" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="445.2031036056595" cy="172.5" r="0" fill="#4793f5" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="525" cy="154.8" r="0" fill="#4793f5" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="left: 0px; top: 141px; display: none;"><div class="morris-hover-row-label">2009</div><div class="morris-hover-point" style="color: #4793f5">
  Mobiles:
  10
</div><div class="morris-hover-point" style="color: #ff3f4e">
  Tablets:
  20
</div><div class="morris-hover-point" style="color: #bbbbbb">
  Desktops:
  30
</div></div></div>
                                </div>
                            </div>
                        </div>
                        <!-- /Portlet -->
                    </div>
                    <!-- col -->
                </div>
                <!-- End row-->
				<?php } ?>

             
				<?php } ?>