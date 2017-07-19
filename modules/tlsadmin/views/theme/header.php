<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="TalesCare">
        <!-- App Favicon icon -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets2/images/favicon.ico">
        <!-- App Title -->
        <title>TelUs Care Admin</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets2/plugins/morris/morris.css">

        <link href="<?php echo base_url(); ?>assets2/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets2/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets2/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets2/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets2/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets2/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets2/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url(); ?>assets2/js/modernizr.min.js"></script>
    <style>
	#topnav .navigation-menu > li > a{
	 padding-right: 0px;
	
	}
	#topnav .has-submenu.active a {
    color: #000;
	}
	@media (min-width: 768px){

	.form-horizontal .control-label {
		padding-top: 0px;
		margin-bottom: 0;
		text-align: right;
	}
	}
	</style>
    </head>


    <body>


        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- Logo container-->
                    <div class="logo">
                        <a href="<?php echo base_url().'tlsadmin'; ?>" class="logo"><img src="http://www.teluscare.com/assets/newasset/image/assurance.png" style="width: 87px;" /></a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="navbar-c-items">
                                <form role="search" class="navbar-left app-search pull-left hidden-xs">
                                     <input type="text" placeholder="Search..." class="form-control">
                                     <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                            <li class="dropdown navbar-c-items">
                                <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                    <i class="icon-bell"></i> <span class="badge badge-xs badge-danger">3</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg">
                                    <li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification</li>
                                    <li class="list-group slimscroll-noti notification-list">
                                       <!-- list item-->
                                       <a href="javascript:void(0);" class="list-group-item">
                                          <div class="media">
                                             <div class="pull-left p-r-10">
                                                <em class="fa fa-diamond noti-primary"></em>
                                             </div>
                                             <div class="media-body">
                                                <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                <p class="m-0">
                                                    <small>There are new settings available</small>
                                                </p>
                                             </div>
                                          </div>
                                       </a>

                                       <!-- list item-->
                                       <a href="javascript:void(0);" class="list-group-item">
                                          <div class="media">
                                             <div class="pull-left p-r-10">
                                                <em class="fa fa-cog noti-warning"></em>
                                             </div>
                                             <div class="media-body">
                                                <h5 class="media-heading">New settings</h5>
                                                <p class="m-0">
                                                    <small>There are new settings available</small>
                                                </p>
                                             </div>
                                          </div>
                                       </a>

                                       <!-- list item-->
                                       <a href="javascript:void(0);" class="list-group-item">
                                          <div class="media">
                                             <div class="pull-left p-r-10">
                                                <em class="fa fa-bell-o noti-custom"></em>
                                             </div>
                                             <div class="media-body">
                                                <h5 class="media-heading">Updates</h5>
                                                <p class="m-0">
                                                    <small>There are <span class="text-primary font-600">2</span> new updates available</small>
                                                </p>
                                             </div>
                                          </div>
                                       </a>

                                       <!-- list item-->
                                       <a href="javascript:void(0);" class="list-group-item">
                                          <div class="media">
                                             <div class="pull-left p-r-10">
                                                <em class="fa fa-user-plus noti-pink"></em>
                                             </div>
                                             <div class="media-body">
                                                <h5 class="media-heading">New user registered</h5>
                                                <p class="m-0">
                                                    <small>You have 10 unread messages</small>
                                                </p>
                                             </div>
                                          </div>
                                       </a>

                                        <!-- list item-->
                                       <a href="javascript:void(0);" class="list-group-item">
                                          <div class="media">
                                             <div class="pull-left p-r-10">
                                                <em class="fa fa-diamond noti-primary"></em>
                                             </div>
                                             <div class="media-body">
                                                <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                <p class="m-0">
                                                    <small>There are new settings available</small>
                                                </p>
                                             </div>
                                          </div>
                                       </a>

                                       <!-- list item-->
                                       <a href="javascript:void(0);" class="list-group-item">
                                          <div class="media">
                                             <div class="pull-left p-r-10">
                                                <em class="fa fa-cog noti-warning"></em>
                                             </div>
                                             <div class="media-body">
                                                <h5 class="media-heading">New settings</h5>
                                                <p class="m-0">
                                                    <small>There are new settings available</small>
                                                </p>
                                             </div>
                                          </div>
                                       </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="list-group-item text-right">
                                            <small class="font-600">See all notifications</small>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown navbar-c-items">
                                <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo base_url(); ?>assets2/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="ti-user text-custom m-r-10"></i> Profile</a></li>
                                    <li><a href="javascript:void(0)"><i class="ti-settings text-custom m-r-10"></i> Settings</a></li>
                                    <li><a href="javascript:void(0)"><i class="ti-lock text-custom m-r-10"></i> Lock screen</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo base_url(); ?>tlsadmin/login/logoutuser"><i class="ti-power-off text-danger m-r-10"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>

                </div>
            </div>

            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li class="has-submenu" <?php if($this->uri->segment(3) == 'dashboard'){ ?> style="background: #2BBBAD;color: #fff;padding-right: 38px;border: 1px solid;margin-left: 10px;padding-left: 23px;    border-top: none;" <?php } ?>>
                                <a href="<?php echo base_url().'tlsadmin/login/dashboard'; ?>" <?php if($this->uri->segment(3) == 'dashboard'){ ?> style="color: #fff;" <?php } ?>	><i class="md md-dashboard"></i> Dashboard</a>
                            </li>
							 <!--li class="has-submenu">
                                <a href="#"><i class="md md-account-circle"></i>My Account</a>
                                <ul class="submenu">
                                    <li><a href="#"> Edit Account </a></li>
                                    <li><a href="#"> Change Password </a></li>                                 
                                </ul>
                            </li-->
							<?php
								if($this->session->userdata('is_blocked')){ 
								}
								else
								{
							?>
							  <?php if($this->session->userdata('usertype') != '2'){ ?>
                            <li class="has-submenu" <?php if($this->uri->segment(3) == 'Manageenquiryonline'){ ?> style="background: #2BBBAD;color: #fff;padding-right: 38px;border: 1px solid;margin-left: 10px;    border-top: none;" <?php } ?>>
                                <a href="#" <?php if($this->uri->segment(3) == 'Manageenquiryonline'){ ?> style="color: #fff;" <?php } ?>><img src="http://designer.weblink4you.com/ipost-network/images/ico-price.png" alt="" class="vam mr3"> Manage Quote</a>
                                <ul class="submenu">
                                    <li class="has-submenu"><a href="#" >Quote Management</a>
									 <ul class="submenu">
									 <!--li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/searchServices' ?>">Search Service</a></li-->
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/quote-booked' ?>">Quote Booked</a></li>
                                      <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/quote-saved' ?>">Quote Saved</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/bid-for-quote' ?>">Bid for  Quote</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/negotiate' ?>">Negotiate</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/confirmed' ?>">Confirmed</a></li>
									 </ul>
									 </li>
                                    <li class="has-submenu"><a href="javascript:void(0)">Quote Via Admin</a>
                                     <ul class="submenu">
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/requested-quote' ?>">Requested Quote</a></li>
                                      <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/negotiate-on-quote' ?>">Negotiation on Quote</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/confirmation' ?>">Confirmed</a></li>
									 </ul>
									 </li>
                                </ul>
                            </li>
                            <li class="has-submenu" <?php if($this->uri->segment(3) == 'Orderhistory'){ ?> style="background: #2BBBAD;color: #fff;padding-right: 38px;border: 1px solid;margin-left: 10px;    border-top: none;" <?php } ?>>
                                <a href="#" <?php if($this->uri->segment(3) == 'Orderhistory'){ ?> style="color: #fff;" <?php } ?> ><img src="http://designer.weblink4you.com/ipost-network/images/ico-history.png" alt="" class="vam mr3"> Order History</a>
                                <ul class="submenu">
                                    <li>
                                        <ul>
                                            <li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/vieworder' ?>"> View Order</a></li>
                                            <li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/completeorder' ?>">Complete Order</a></li>
                                            <li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/pendingorder' ?>">Pending Order</a></li>
                                            <li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/changeorder' ?>">Postpone/Change Orders</a></li>
                                            <li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/cancelorder' ?>">Cancel Orders/RTO</a></li>
                                            <!--li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/addedorder' ?>">Added Order</a></li-->
										</ul>
                                    </li>
								</ul>
                            </li>
							<li class="has-submenu"  <?php if($this->uri->segment(3) == 'Managelife'){ ?> style="background: #2BBBAD;color: #fff;padding-right: 38px;border: 1px solid;margin-left: 10px;    border-top: none;" <?php } ?>>
                                <a href="#" <?php if($this->uri->segment(3) == 'Managelife'){ ?> style="color: #fff;" <?php } ?> ><img src="http://designer.weblink4you.com/ipost-network/images/ico-delivery.png" alt="" class="vam mr3"> Manage  Policy/Services(Confirmed)</a>
								<ul class="submenu">
                                    <li class="has-submenu"><a href="#">Insurance</a>
									 <ul class="submenu">
									 <li><a href="<?php echo base_url().'tlsadmin/life/Managelife/life_motor' ?>">Insurance Motor</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/life/Managelife/life_medical' ?>">Medical Insurance</a></li></ul>
									 </li>
                                    <li class="has-submenu"><a href="javascript:void(0)">Facility Management</a>
                                     <ul class="submenu">
									  <li><a href="<?php echo base_url().'tlsadmin/life/Managelife/life_cleaning' ?>">Cleaning</a></li>
                                      <li><a href="<?php echo base_url().'tlsadmin/life/Managelife/life_pest' ?>">Pest</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/life/Managelife/life_paint' ?>">Paint</a></li>
									   <li><a href="#">Garage Services/ Vehicle</a></li> 
									 </ul>
									 </li>
                                </ul>
                             </li>
							
							<li class="has-submenu" <?php if($this->uri->segment(2) == 'ins'){ ?> style="background: #2BBBAD;color: #fff;padding-right: 38px;border: 1px solid;margin-left: 10px;    border-top: none;" <?php } ?>>
                                <a href="#" <?php if($this->uri->segment(2) == 'ins'){ ?> style="color: #fff;" <?php } ?>><img src="http://designer.weblink4you.com/ipost-network/images/ico-delivery.png" alt="" class="vam mr3"> Manage Claims/Services</a>
                                <ul class="submenu">
                                    <li class="has-submenu"><a href="#">Insurance Motor</a>
									 <ul class="submenu">
									 <li><a href="<?php echo base_url().'tlsadmin/ins/Insurance/ins_motor' ?>">Insurance Motor</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/ins/Insurance/medical_ins' ?>">Medical Insurance</a></li>
                                      
									 </ul>
									 </li>
                                    <li class="has-submenu"><a href="javascript:void(0)">Facility Management</a>
                                     <ul class="submenu">
									  <li><a href="<?php echo base_url().'tlsadmin/fam/Familymanagement/cleaning' ?>">Cleaning</a></li>
                                      <li><a href="<?php echo base_url().'tlsadmin/fam/Familymanagement/service' ?>">Service</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/fam/Familymanagement/pest' ?>">Pest</a></li>
									  <li><a href="#">Garage Services/ Vehicle</a></li> 
									 </ul>
									 </li>
                                </ul>
                            </li>
							<?php //} ?>
							
							<li class="has-submenu last-elements" style="float: right;">
                                <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-customer.png" alt="" class="vam mr3"> </a>
								<ul class="submenu">								 
									 <li class="has-submenu">  <a href="#">Customer Care</a>
                                     <ul class="submenu">
									    <li><a href="<?php echo base_url().'tlsadmin/custcare/Customercare/complains' ?>">Complains </a></li>
                                        <li><a href="<?php echo base_url().'tlsadmin/custcare/Customercare/queries' ?>">Queries</a></li>
                                        <li><a href="<?php echo base_url().'tlsadmin/custcare/Customercare/suggestions' ?>">Suggestions</a></li>
									 </ul>
									 </li>
									  <li class="has-submenu">  <a href="#">Post Sales Services</a>
                                     <ul class="submenu">
									   <li><a href="<?php echo base_url().'tlsadmin/post_sales_services/post_sales/post_reviews' ?>">Post Reviews</a></li>
                                       <li><a href="<?php echo base_url().'tlsadmin/post_sales_services/post_sales/messages' ?>">Messages</a></li>
                                       <li><a href="<?php echo base_url().'tlsadmin/post_sales_services/post_sales/notifications' ?>"> Notifications</a></li>
                                       <li><a href="<?php echo base_url().'tlsadmin/post_sales_services/post_sales/refer_to_friend' ?>">Refer to Friend & Earn</a></li>			
									 </ul>
									 </li>
								</ul>
                            </li>
							
							<li class="has-submenu" style="float: right;">
                                <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-sales.png" alt="" class="vam mr3"> </a>
								<ul class="submenu">
								 <li class="has-submenu"><a href="javascript:void(0)">Payment History/Reward</a>
                                     <ul class="submenu">
									  <li><a href="<?php echo base_url().'tlsadmin/cust/payment/pay_done' ?>">  Payment Done</a></li>  
									  <li><a href="<?php echo base_url().'tlsadmin/cust/payment/pay_cancel' ?>">  Payment Pending/Cancelled</a></li>		
									 </ul>
									 </li>
									 <li class="has-submenu">  <a href="<?php echo base_url().'tlsadmin/cust/payment/wallet' ?>">Wallet</a>
                                     <ul class="submenu">
									  <li><a href="<?php echo base_url().'tlsadmin/cust/payment/pay_refund' ?>">  Earn Points/Refereed/Refunded Payment</a></li>	
									  <li><a href="<?php echo base_url().'tlsadmin/cust/payment/pay_add' ?>">  Add Payment</a></li>
									 </ul>
									 </li>
									 
								</ul>
                           						
                            </li>
							<?php } ?>
							
							
							
							
							<?php if($this->session->userdata('usertype') == '2'){ ?>
                        	<!--<li class="has-submenu">
                             <a href="#"><i class="md md-folder-special"></i>Product & Services</a> 
								<ul class="submenu">
									<li><a href="<?php //echo base_url().'tlsadmin/enq/Manageenquiryonline/searchServices' ?>">Search Service</a></li>
									<li><a href="<?php //echo base_url().'tlsadmin/enq/Manageenquiryonline/quote-booked' ?>">Quote Booked</a></li>
                                    <li><a href="<?php //echo base_url().'tlsadmin/enq/Manageenquiryonline/quote-Saved' ?>">Quote Saved</a></li>
									<li><a href="<?php //echo base_url().'tlsadmin/enq/Manageenquiryonline/bid-for-quote' ?>">Bid for  Quote</a></li>
									<li><a href="<?php //echo base_url().'tlsadmin/enq/Manageenquiryonline/negotiate' ?>">Negotiate</a></li>
									<li><a href="<?php //echo base_url().'tlsadmin/enq/Manageenquiryonline/confirmed' ?>">Confirmed</a></li>
								</ul>
                            </li>-->
							
							<li class="has-submenu">
                                <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-add.png" alt="" class="md md-folder-special"> Manage Quote</a>
                                <ul class="submenu">
                                    <li class="has-submenu"><a href="#">Manage Quote Company</a>
									 <ul class="submenu">									 
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/quote-booked' ?>">Quote Booked</a></li>
                                      <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/quote-saved' ?>">Quote Saved</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/bid-for-quote' ?>">Bid for  Quote</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/negotiate' ?>">Negotiate</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/confirmed' ?>">Confirmed</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/add_quote' ?>">Quote Added</a></li>
									 </ul>
									 </li>
                                    <li class="has-submenu"><a href="javascript:void(0)">Manage Quote Individual</a>
                                     <ul class="submenu">
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/quote-booked' ?>">Quote Booked</a></li>
                                      <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/quote-saved' ?>">Quote Saved</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/requested-quote' ?>">Requested Quote</a></li>
                                      <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/negotiate-on-quote' ?>">Negotiation on Quote</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/confirmation' ?>">Confirmed</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/add_quote' ?>">Quote Added</a></li>
									 </ul>
									 </li>
									 <li class="has-submenu"><a href="javascript:void(0)">Quote Via Admin</a>
                                     <ul class="submenu">
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/requested-quote' ?>">Requested Quote</a></li>
                                      <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/negotiate-on-quote' ?>">Negotiation on Quote</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/enq/Manageenquiryonline/confirmation' ?>">Confirmed</a></li>
									 </ul>
									 </li>
                                </ul>
                            </li>
							
							<li class="has-submenu">
                                <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-agencies.png" alt="" class="md md-folder-special"> Operations Manager</a>
                                <ul class="submenu">
                                     <li><a href="<?php echo base_url().'tlsadmin/operationmanager/operation_management/emp_dpt_management' ?>">Employee Department Management</a></li>
									 <li><a href="<?php echo base_url().'tlsadmin/operationmanager/operation_management/emp_shedule_management' ?>">Employee Schedule Management</a></li>
									 <li><a href="#">Employee Location Management</a></li>
									 <li><a href="#">Employee Job Management</a></li>									
                                </ul>
                            </li>
							
							<li class="has-submenu">
                                <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-edit.png" alt="" class="md md-folder-special"> Order Manager</a> 
                                <ul class="submenu">
								<li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/addedorder' ?>">New Order/Reached</a></li>	
								<li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/pendingorder' ?>">Pending Order</a></li>
								<li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/pendingorder' ?>">In process Order</a></li>
								<li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/completeorder' ?>">Complete Order</a></li>								
                                    <li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/vieworder' ?>"> View Order</a></li>
									
									
									<li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/changeorder' ?>">Postpone/Change Orders</a></li>
									<li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/cancelorder' ?>">Cancel Orders/RTO</a></li>
									<li><a href="<?php echo base_url().'tlsadmin/order/Orderhistory/addedorder' ?>">New Order</a></li>		
                                </ul>
                            </li>
							
							<li class="has-submenu">
                                <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-delivery.png" alt="" class="vam mr3"> Manage  Policy/Services(Confirmed)</a>
								<ul class="submenu">
                                    <li class="has-submenu"><a href="#">Insurance</a>
									 <ul class="submenu">
									 <li><a href="<?php echo base_url().'tlsadmin/life/Managelife/life_motor' ?>">Insurance Motor</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/life/Managelife/life_medical' ?>">Medical Insurance</a></li></ul>
									 </li>
                                    <li class="has-submenu"><a href="javascript:void(0)">Facility Management</a>
                                     <ul class="submenu">
									  <li><a href="<?php echo base_url().'tlsadmin/life/Managelife/life_cleaning' ?>">Cleaning</a></li>
                                      <li><a href="<?php echo base_url().'tlsadmin/life/Managelife/life_pest' ?>">Pest</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/life/Managelife/life_paint' ?>">Paint</a></li>
									   <li><a href="#">Garage Services/ Vehicle</a></li> 
									 </ul>
									 </li>
                                </ul>
                             </li>
							 
							 <li class="has-submenu">
                                <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-delivery.png" alt="" class="vam mr3"> Manage Claims/Services</a>
                                <ul class="submenu">
                                    <li class="has-submenu"><a href="#">Insurance Motor</a>
									 <ul class="submenu">
									 <li><a href="<?php echo base_url().'tlsadmin/ins/Insurance/ins_motor' ?>">Insurance Motor</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/ins/Insurance/medical_ins' ?>">Medical Insurance</a></li>
                                      
									 </ul>
									 </li>
                                    <li class="has-submenu"><a href="javascript:void(0)">Facility Management</a>
                                     <ul class="submenu">
									  <li><a href="<?php echo base_url().'tlsadmin/fam/Familymanagement/cleaning' ?>">Cleaning</a></li>
                                      <li><a href="<?php echo base_url().'tlsadmin/fam/Familymanagement/service' ?>">Service</a></li>
									  <li><a href="<?php echo base_url().'tlsadmin/fam/Familymanagement/pest' ?>">Pest</a></li>
									  <li><a href="#">Garage Services/ Vehicle</a></li> 
									 </ul>
									 </li>
                                </ul>
                            </li>
							
							<li class="has-submenu">
                                <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-price.png" alt="" class="md md-folder-special">Manage Rate(product & Services)</a> 
                                <ul class="submenu">
								<li><a href="#">Manage product & services</a></li>	
								<li><a href="#">Manage Location</a></li>
								<li><a href="#">Exclusion</a></li>
								<li><a href="#">Manage Time</a></li>																
                                </ul>								
                            </li>
							
							<li class="has-submenu">
                                <a href="#"> <img src="http://designer.weblink4you.com/ipost-network/images/ico-subadmin.png" alt="" class="md md-folder-special">Manage HR</a>                               
								<ul class="submenu">
								<li><a href="<?php echo base_url().'tlsadmin/managehr/manage_hr/attendance' ?>">Attendance</a></li>	
								<li><a href="<?php echo base_url().'tlsadmin/managehr/manage_hr/addnewemployee' ?>">Add new Employee</a></li>
								<li><a href="<?php echo base_url().'tlsadmin/operationmanager/operation_management/emp_dpt_management' ?>">Employee Listing</a></li>
								<li><a href="<?php echo base_url().'tlsadmin/managehr/manage_hr/emp_work_status' ?>">Employee work status</a></li>
								<li><a href="<?php echo base_url().'tlsadmin/managehr/manage_hr/emp_reward_prg' ?>">Employee Reward Programme</a></li>
								<li><a href="<?php echo base_url().'tlsadmin/managehr/manage_hr/status_of_app_req' ?>">Status of Application</a></li>
								<li><a href="<?php echo base_url().'tlsadmin/managehr/manage_hr/status_of_app_req' ?>">Employee Performance</a></li>
                                </ul>
                            </li>
							
							<li class="has-submenu">
                                <a href="#"> <img src="http://designer.weblink4you.com/ipost-network/images/ico-edit.png" alt="" class="md md-folder-special">Manage A/C</a>                          
								<ul class="submenu">
								<li><a href="<?php echo base_url().'tlsadmin/payment/paymn/paymn_history' ?>">Payment History</a></li>	
								<li><a href="<?php echo base_url().'tlsadmin/payment/paymn/paymn_invoice' ?>">Payment Invoice</a></li>
								<li><a href="<?php echo base_url().'tlsadmin//payment/paymn/salary' ?>">Salary of employees</a></li>
								<li><a href="<?php echo base_url().'tlsadmin/payment/paymn/paymn_petty_cash' ?>">Petty Cash</a></li>
								<li><a href="<?php echo base_url().'tlsadmin/payment/paymn/rent_of_branch' ?>">Rent of Branch</a></li>
								<li><a href="<?php echo base_url().'tlsadmin/payment/paymn/utility_payment' ?>">Utility Payment</a></li>
								<li><a href="<?php echo base_url().'tlsadmin/payment/paymn/stationary' ?>">stationary</a></li>
								
                                </ul>
                            </li>
							
							<li class="has-submenu">
                                <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-sales.png" alt="" class="md md-folder-special"> Manange Sales Marketing</a>                          
                                <ul class="submenu">
								<li><a href="<?php echo base_url().'tlsadmin/post_sales_services/post_sales/prospect' ?>">Prospect</a></li>	
								<li><a href="<?php echo base_url().'tlsadmin/post_sales_services/post_sales/offers' ?>">Offers</a></li>																								
                                </ul>								
                            </li>
						
							<li class="has-submenu">
                                <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-customer.png" alt="" class="vam mr3"> Customer Support</a>
								<ul class="submenu">								 
									 <li class="has-submenu">  <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-customer.png" alt="" class="vam mr3">Customer Care</a>
                                     <ul class="submenu">
									    <li><a href="<?php echo base_url().'tlsadmin/custcare/Customercare/complains' ?>">Complains </a></li>
                                        <li><a href="<?php echo base_url().'tlsadmin/custcare/Customercare/queries' ?>">Queries</a></li>
                                        <li><a href="<?php echo base_url().'tlsadmin/custcare/Customercare/suggestions' ?>">Suggestions</a></li>
									 </ul>
									 </li>
									 <li class="has-submenu">  <a href="#"><i class="md md-folder-special"></i>Post Sales Services</a>
                                     <ul class="submenu">
									   <li><a href="<?php echo base_url().'tlsadmin/post_sales_services/post_sales/post_reviews' ?>">Post Reviews</a></li>
                                       <li><a href="<?php echo base_url().'tlsadmin/post_sales_services/post_sales/messages' ?>">Messages</a></li>
                                       <li><a href="<?php echo base_url().'tlsadmin/post_sales_services/post_sales/notifications' ?>"> Notifications</a></li>
                                       <li><a href="<?php echo base_url().'tlsadmin/post_sales_services/post_sales/refer_to_friend' ?>">Refer to Friend & Earn</a></li>			
									 </ul>
									 </li>
								</ul>
                           						
                            </li>
							
							<li class="has-submenu">
                                <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-bulk.png" alt="" class="vam mr3"> Payment History/Reward</a>
								<ul class="submenu">
								 <li class="has-submenu"><a href="javascript:void(0)">Payment History/Reward</a>
                                     <ul class="submenu">
									  <li><a href="<?php echo base_url().'tlsadmin/cust/payment/pay_done' ?>">  Payment Done</a></li>  
									  <li><a href="<?php echo base_url().'tlsadmin/cust/payment/pay_cancel' ?>">  Payment Pending/Cancelled</a></li>		
									 </ul>
									 </li>
									 <li class="has-submenu">  <a href="<?php echo base_url().'tlsadmin/cust/payment/wallet' ?>">Wallet</a>
                                     <ul class="submenu">
									  <li><a href="<?php echo base_url().'tlsadmin/cust/payment/pay_refund' ?>">  Earn Points/Refereed/Refunded Payment</a></li>	
									  <li><a href="<?php echo base_url().'tlsadmin/cust/payment/pay_add' ?>">  Add Payment</a></li>
									 </ul>
									 </li>
									 
								</ul>
                           						
                            </li>
							
							<?php } 
							
							}
							
							?>
                            <!--li class="has-submenu">
                             <a href="#"><i class="md md-folder-special"></i>Post Sales Services</a>
                                <ul class="submenu">
                                   <li>
                                        <ul>
                                           <li><a href="#">Post Reviews</a></li>
                                            <li><a href="#">Messages</a></li>
                                            <li><a href="#"> Notifications</a></li>
                                            <li><a href="#">Refer to Friend & Earn</a></li>			
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><img src="http://designer.weblink4you.com/ipost-network/images/ico-customer.png" alt="" class="vam mr3">Customer Care</a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="#">Complains </a></li>
                                            <li><a href="#">Queries</a></li>
                                            <li><a href="#">Suggestions</a></li>                                          
                                        </ul>
                                    </li>
								</ul>
                            </li>


                            <li class="has-submenu">
                                <a href="#"><i class="md md-folder-special"></i>Post Sales Services</a>
                                <ul class="submenu">
                                    <li>
                                        <ul>
                                            <li><a href="#">Post Reviews</a></li>
                                            <li><a href="#">Messages</a></li>
                                            <li><a href="#"> Notifications</a></li>
                                            <li><a href="#">Refer to Friend & Earn</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li-->
                        </ul>
                        <!-- End navigation menu        -->
                    </div>
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->

<div class="wrapper">
            <div class="container">
