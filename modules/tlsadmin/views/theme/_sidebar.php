<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
   <div class="sidebar-inner slimscrollleft">
      <!--- Divider -->
      <div id="sidebar-menu">
         <ul>
         <li class="text-muted menu-title">Navigation</li>
         <li>						
            <a href="<?php echo base_url().'index.php/Login/dashboard' ?>" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span> </a>
         </li>
         <li class="has_sub">
            <a href="#" class="waves-effect " <?php if($this->uri->segment(1)=='Company'){ echo 'subdrop'; } ?>><i class="ti-pencil-alt"></i> <span> Company</span> </a>
            <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Company'){ echo 'style="display: block;"'; } ?>>
               <li id="clist"><a href="<?php echo base_url().'index.php/Company/company_list'?>">Company List</a></li>
               <li id="new"><a href="<?php echo base_url().'index.php/Company' ?>">Add Company</a></li>
            </ul>
         </li>
		<li class="has_sub">
                                <a href="#" class="waves-effect" <?php if($this->uri->segment(1)=='Employee'){ echo 'subdrop'; } ?>><i class="ti-pencil-alt"></i> <span>Employee </span> </a>
                               <ul class="list-unstyled"  <?php if($this->uri->segment(1)=='Employee'){ echo 'style="display: block;"'; } ?>>
									<li id="clist"><a href="<?php echo base_url().'index.php/Employee/employee_list'?>">Employee List</a></li>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Employee' ?>">Add Employee</a></li>
                               </ul>
         </li>
        <!-- <li class="has_sub">
            <a href="#" class="waves-effect"><i class="ti-user"></i> <span>Manage User Info. </span> </a>                               
            <ul class="list-unstyled">
               <li id="clist"><a href="<?php echo base_url().'index.php/Users/users_list'?>">User Info List</a></li>
               <li id="new"><a href="<?php echo base_url().'index.php/Users' ?>">Add User Info</a></li>
            </ul>
         </li>-->
         <li class="has_sub" <?php if($this->uri->segment(1)=='Vehicle'){ echo 'subdrop'; } ?>>
            <a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Manage Vehicle </span> </a>                               
            <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Vehicle'){ echo 'style="display: block;"'; } ?>>
			  <li id="clist"><a href="<?php echo base_url().'index.php/Vehicle/vehicle_list'?>">Vehicle List</a></li>
               <li id="new"><a href="<?php echo base_url().'index.php/Vehicle' ?>">Add Vehicle</a></li>
            </ul>
         </li>
        <li class="has_sub">
            <a href="#" class="waves-effect" <?php if($this->uri->segment(1)=='Vehical_type'){ echo 'subdrop'; } ?>><i class="ti-pencil-alt"></i> <span>Manage Vehicle Type </span> </a>                               
            <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Vehical_type'){ echo 'style="display: block;"'; } ?>>
               <li id="clist"><a href="<?php echo base_url().'index.php/Vehical_type/vehicaltype_list'?>" >Vehicle Type List</a></li>
               <li id="new"><a href="<?php echo base_url().'index.php/Vehical_type' ?>">Add Vehicle Type</a></li>
            </ul>
         </li>
		 
		  <li class="has_sub <?php if($this->uri->segment(1)=='Location'){ echo 'subdrop'; } ?>">
            <a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span> Location </span> </a>                               
            <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Location'){ echo 'style="display: block;"'; } ?>>
               <li id="clist"><a href="<?php echo base_url().'index.php/Location/location_list'?>">Location List</a></li>
               <li id="new"><a href="<?php echo base_url().'index.php/Location' ?>">Add Location</a></li>
            </ul>
         </li>
		 
		 
		 <li class="has_sub <?php if($this->uri->segment(1)=='Triplocation'){ echo 'subdrop'; } ?>">
            <a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span> TripLocation </span> </a>                               
            <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Triplocation'){ echo 'style="display: block;"'; } ?>>
               <li id="clist"><a href="<?php echo base_url().'index.php/Triplocation/triplocation_list'?>">TripLocation List</a></li>
               <li id="new"><a href="<?php echo base_url().'index.php/Triplocation' ?>">Add TripLocation</a></li>
            </ul>
         </li>
		 
         <li class="has_sub <?php if($this->uri->segment(1)=='State'){ echo 'subdrop'; } ?>">
            <a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span> State </span> </a>                               
            <ul class="list-unstyled" <?php if($this->uri->segment(1)=='State'){ echo 'style="display: block;"'; } ?>>
               <li id="clist"><a href="<?php echo base_url().'index.php/State/state_list'?>">State List</a></li>
               <li id="new"><a href="<?php echo base_url().'index.php/State' ?>">Add State</a></li>
            </ul>
         </li>
		 
		 <li class="has_sub <?php if($this->uri->segment(1)=='Bank'){ echo 'subdrop'; } ?>">
				<a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Bank Manager </span> </a>
			   <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Bank'){ echo 'style="display: block;"'; } ?>>
					<li id="clist"><a href="<?php echo base_url().'index.php/Bank/bank_list'?>">Bank List</a></li>
					<li id="new"><a href="<?php echo base_url().'index.php/Bank' ?>">Add Bank Details</a></li>
				</ul>
			</li>
			
		 <li class="has_sub <?php if($this->uri->segment(1)=='Bodybuilder'){ echo 'subdrop'; } ?>">
			<a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Body Builder Manager </span> </a>
		   <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Bodybuilder'){ echo 'style="display: block;"'; } ?>>
				<li id="clist"><a href="<?php echo base_url().'index.php/Bodybuilder/bodybuilder_list'?>">Body Builder  List</a></li>
				<li id="new"><a href="<?php echo base_url().'index.php/Bodybuilder' ?>">Add Body Builder Details</a></li>
			</ul>
		</li>	
		
		 <li class="has_sub <?php if($this->uri->segment(1)=='Financer'){ echo 'subdrop'; } ?>">
			<a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Financer Manager </span> </a>
		   <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Financer'){ echo 'style="display: block;"'; } ?>>
				<li id="clist"><a href="<?php echo base_url().'index.php/Financer/financer_list'?>">Financer  List</a></li>
				<li id="new"><a href="<?php echo base_url().'index.php/Financer' ?>">Add Financer Details</a></li>
			</ul>
		</li>	
		
		<li class="has_sub <?php if($this->uri->segment(1)=='Axletype'){ echo 'subdrop'; } ?>">
				<a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Axle Type </span> </a>
			   <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Axletype'){ echo 'style="display: block;"'; } ?>>
			   	<li id="clist"><a href="<?php echo base_url().'index.php/Axletype/axletype_list'?>">Axle Type List</a></li>
				<li id="new"><a href="<?php echo base_url().'index.php/Axletype' ?>">Axle Type</a></li>
				</ul>
			</li>
			<!--<li class="has_sub <?php if($this->uri->segment(1)=='Axletype'){ echo 'subdrop'; } ?>">
				<a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span> Code Value </span> </a>
			   <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Axletype'){ echo 'style="display: block;"'; } ?>>
			   	<li id="clist"><a href="<?php echo base_url().'index.php/Axletype/axletype_list'?>">Code Value List</a></li>
				<li id="new"><a href="<?php echo base_url().'index.php/Axletype' ?>">Code Value </a></li>
				</ul>
			</li>-->
			<li class="has_sub <?php if($this->uri->segment(1)=='Rtopc'){ echo 'subdrop'; } ?>">
			<a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Rtopc </span> </a>
		   <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Rtopc'){ echo 'style="display: block;"'; } ?>>
				<li id="new"><a href="<?php echo base_url().'index.php/Rtopc' ?>">Add Rtopc</a></li>
				<li id="clist"><a href="<?php echo base_url().'index.php/Rtopc/rtopc_list'?>">Rtopc List</a></li>
				
			</ul>
		</li>
		<li class="has_sub <?php if($this->uri->segment(1)=='paymentmode'){ echo 'subdrop'; } ?>">
			<a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Payment Mode</span> </a>
		   <ul class="list-unstyled" <?php if($this->uri->segment(1)=='paymentmode'){ echo 'style="display: block;"'; } ?>>
				<li id="new"><a href="<?php echo base_url().'index.php/paymentmode' ?>">Add Paymentmode</a></li>
				<li id="clist"><a href="<?php echo base_url().'index.php/paymentmode/paymentmode_list'?>">Paymentmode List</a></li>    
			</ul>
		</li>
							<li class="has_sub <?php if($this->uri->segment(1)=='employee_designation'){ echo 'subdrop'; } ?>">
                                <a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Designation </span> </a>
                       <ul class="list-unstyled" <?php if($this->uri->segment(1)=='employee_designation'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Employee_designation' ?>">Designation</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Employee_designation/designation_list'?>">Designation List</a></li>
                                    
                                </ul>
                            </li>
								<li class="has_sub <?php if($this->uri->segment(1)=='Sales_type'){ echo 'subdrop'; } ?>">
                                <a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Sales Type </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Sales_type'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Sales_type' ?>">Sales Type</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Sales_type/sales_type_list'?>">Sales Type List</a></li>
                                    
                                </ul>
                            </li>
								<li class="has_sub <?php if($this->uri->segment(1)=='Sales_agent'){ echo 'subdrop'; } ?>">
                                <a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Sales Agent </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Sales_agent'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Sales_agent' ?>">Sales Agent</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Sales_agent/sales_agent_list'?>">Sales Agent List</a></li>
                                    
                                </ul>
                            </li>
								<li class="has_sub <?php if($this->uri->segment(1)=='Maintainance'){ echo 'subdrop'; } ?>">
                                <a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Maintainance </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Maintainance'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Maintainance' ?>">Maintainance</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Maintainance/maintainance_list'?>">Maintainance List</a></li>
                                    
                                </ul>
                            </li>
								<li class="has_sub <?php if($this->uri->segment(1)=='Miscellaneous'){ echo 'subdrop'; } ?>">
                                <a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Miscellaneous </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Miscellaneous'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Miscellaneous' ?>">Miscellaneous</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Miscellaneous/Miscellaneous_list'?>">Miscellaneous List</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="has_sub <?php if($this->uri->segment(1)=='Salary'){ echo 'subdrop'; } ?>">
                                <a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Salary </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Salary'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Salary' ?>">Salary</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Salary/salary_list'?>">Salary List</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="has_sub <?php if($this->uri->segment(1)=='Loadtype'){ echo 'subdrop'; } ?>">
                                <a href="#" class="waves-effect" ><i class="ti-pencil-alt"></i> <span>Load type </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Loadtype'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Loadtype' ?>">Load type </a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Loadtype/loadtype_list'?>">Load Type List</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="has_sub">
                                <a href="#" class="waves-effect  <?php if($this->uri->segment(1)=='Loadsession'){ echo 'subdrop'; } ?>" ><i class="ti-pencil-alt"></i> <span>Load Season </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Loadsession'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Loadsession' ?>">Load Season </a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Loadsession/loadsession_list'?>">Load Season List</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="has_sub">
                                <a href="#" class="waves-effect  <?php if($this->uri->segment(1)=='Loadname'){ echo 'subdrop'; } ?>" ><i class="ti-pencil-alt"></i> <span>Load Name </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Loadname'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Loadname' ?>">Load Name </a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Loadname/loadname_list'?>">Load Name List</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="has_sub">
                                <a href="#" class="waves-effect  <?php if($this->uri->segment(1)=='Director'){ echo 'subdrop'; } ?>" ><i class="ti-pencil-alt"></i> <span>Director </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Director'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Director' ?>">Director </a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Director/director_list'?>">Director List</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="has_sub">
                                <a href="#" class="waves-effect  <?php if($this->uri->segment(1)=='Documenttype'){ echo 'subdrop'; } ?>" ><i class="ti-pencil-alt"></i> <span>Document Type </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Documenttype'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Documenttype' ?>">Document Type </a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Documenttype/documenttype_list'?>">Document Type List</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="has_sub">
                                <a href="#" class="waves-effect  <?php if($this->uri->segment(1)=='Documentagent'){ echo 'subdrop'; } ?>" ><i class="ti-pencil-alt"></i> <span>Document Agent </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Documentagent'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Documentagent' ?>">Document Agent </a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Documentagent/documentagent_list'?>">Document Agent List</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="has_sub">
                                <a href="#" class="waves-effect  <?php if($this->uri->segment(1)=='Commission'){ echo 'subdrop'; } ?>" ><i class="ti-pencil-alt"></i> <span>Commission </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Commission'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Commission' ?>">Commission </a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Commission/commission_list'?>">Commission List</a></li>
                                    
                                </ul>
                            </li>

							<li class="has_sub">
                                <a href="#" class="waves-effect  <?php if($this->uri->segment(1)=='Tyreshop'){ echo 'subdrop'; } ?>" ><i class="ti-pencil-alt"></i> <span>Tyre Shop </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Tyreshop'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Tyreshop' ?>">Tyre Shop </a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Tyreshop/tyreshop_list'?>">Tyre Shop List</a></li>
                                    
                                </ul>
                            </li>

							<li class="has_sub">
                                <a href="#" class="waves-effect  <?php if($this->uri->segment(1)=='Tyresalesbroker'){ echo 'subdrop'; } ?>" ><i class="ti-pencil-alt"></i> <span>Tyre Sales Broker </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Tyresalesbroker'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Tyresalesbroker' ?>">Tyre Sales Broker </a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Tyresalesbroker/tyresalesbroker_list'?>">Tyre Sales Broker List</a></li>
                                    
                                </ul>
                            </li>	
						
							<li class="has_sub">
                                <a href="#" class="waves-effect  <?php if($this->uri->segment(1)=='Tyre_sales'){ echo 'subdrop'; } ?>" ><i class="ti-pencil-alt"></i> <span>Tyre Sales </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Tyre_sales'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Tyre_sales' ?>">Tyre Sales </a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Tyre_sales/tyre_sales_list'?>">Tyre sales List</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="has_sub">
                                <a href="#" class="waves-effect  <?php if($this->uri->segment(1)=='Tyre_purchase'){ echo 'subdrop'; } ?>" ><i class="ti-pencil-alt"></i> <span>Tyre Purchase </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Tyre_purchase'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Tyre_purchase' ?>">Tyre Purchase </a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Tyre_purchase/tyre_purchase_list'?>">Tyre Purchase List</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="has_sub">
                                <a href="#" class="waves-effect  <?php if($this->uri->segment(1)=='Tyre_transaction'){ echo 'subdrop'; } ?>" ><i class="ti-pencil-alt"></i> <span>Tyre Transaction </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Tyre_transaction'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Tyre_transaction' ?>">Tyre Transaction </a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Tyre_transaction/tyre_transaction_list'?>">Tyre Transaction List</a></li>
                                    
                                </ul>
                            </li>
							
							<li class="has_sub <?php if($this->uri->segment(1)=='ReTyre_booking'){ echo 'subdrop'; } ?>">
                                <a href="#" class="waves-effect"><i class="ti-pencil-alt"></i> <span>Retyre Booking </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='ReTyre_booking'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/ReTyre_booking' ?>">Retyre Booking</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/ReTyre_booking/retyre_booking_list'?>">Retyre booking List</a></li>
                                    
                                </ul>
                            </li>
							<li class="has_sub">
                                <a href="#" class="waves-effect  <?php if($this->uri->segment(1)=='ReTyre_company'){ echo 'subdrop'; } ?>" ><i class="ti-pencil-alt"></i> <span>Retyre Company </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='ReTyre_company'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/ReTyre_company' ?>">Retyre Company</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/ReTyre_company/reTyre_company_list'?>">Retyre Company List</a></li>
                                    
                                </ul>
                            </li>
							<li class="has_sub">
                                <a href="#" class="waves-effect <?php if($this->uri->segment(1)=='Hire_outstanding'){ echo 'subdrop'; } ?>"><i class="ti-pencil-alt"></i> <span>Hire Outstanding </span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Hire_outstanding'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Hire_outstanding' ?>">Hire Outstanding</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Hire_outstanding/hire_outstanding_list'?>">Hire Outstanding List</a></li>
                                    
                                </ul>
                            </li>
							<li class="has_sub">
                                <a href="#" class="waves-effect <?php if($this->uri->segment(1)=='Cheque'){ echo 'subdrop'; } ?>"><i class="ti-pencil-alt"></i> <span>Cheque</span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Cheque'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Cheque' ?>">Cheque</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Cheque/cheque_list'?>">Cheque List</a></li>
                                    
                                </ul>
                            </li>
							<li class="has_sub">
                                <a href="#" class="waves-effect <?php if($this->uri->segment(1)=='Bunk'){ echo 'subdrop'; } ?>"><i class="ti-pencil-alt"></i> <span>Bunk</span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Bunk'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Bunk' ?>">Bunk</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Bunk/Bunk_list'?>">Bunk List</a></li>
                                    
                                </ul>
                            </li>
								<li class="has_sub">
                                <a href="#" class="waves-effect <?php if($this->uri->segment(1)=='Booking_office'){ echo 'subdrop'; } ?>"><i class="ti-pencil-alt"></i> <span>Booking Office</span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Booking_office'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Booking_office' ?>">Booking Office</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Booking_office/list_booking_office'?>">Booking Office List</a></li>
                                    
                                </ul>
                            </li>
							<li class="has_sub">
                                <a href="#" class="waves-effect <?php if($this->uri->segment(1)=='Bata'){ echo 'subdrop'; } ?>"><i class="ti-pencil-alt"></i> <span>Bata</span> </a>
                               <ul class="list-unstyled" <?php if($this->uri->segment(1)=='Bata'){ echo 'style="display: block;"'; } ?>>
                                    <li id="new"><a href="<?php echo base_url().'index.php/Bata' ?>">Bata</a></li>
                                    <li id="clist"><a href="<?php echo base_url().'index.php/Bata/list_bata'?>">Bata List</a></li>
                                    
                                </ul>
                            </li>
							 <li class="has_sub">
								<a href="#" class="waves-effect" <?php if($this->uri->segment(1)=='Vehicle_document'){ echo 'subdrop'; } ?>><i class="ti-pencil-alt"></i> <span> Vehicle Document </span> </a>                               
								<ul class="list-unstyled" <?php if($this->uri->segment(1)=='Vehicle_document'){ echo 'style="display: block;"'; } ?>>
								   <li id="clist"><a href="<?php echo base_url().'index.php/Vehicle_document/vehicle_document_list'?>" >Vehicle Document List</a></li>
								   <li id="new"><a href="<?php echo base_url().'index.php/Vehicle_document' ?>">Add Vehicle Document</a></li>
								</ul>
							</li>
							 <li class="has_sub">
								<a href="#" class="waves-effect" <?php if($this->uri->segment(1)=='Tyre_fix'){ echo 'subdrop'; } ?>><i class="ti-pencil-alt"></i> <span> Type Fix</span> </a>                               
								<ul class="list-unstyled" <?php if($this->uri->segment(1)=='Tyre_fix'){ echo 'style="display: block;"'; } ?>>
								   <li id="clist"><a href="<?php echo base_url().'index.php/Tyre_fix/tyrefix_list'?>" >Type Fix List</a></li>
								   <li id="new"><a href="<?php echo base_url().'index.php/Tyre_fix' ?>">Add Type Fix</a></li>
								</ul>
							</li>
							<li class="has_sub">
								<a href="#" class="waves-effect" <?php if($this->uri->segment(1)=='Vehicle_sales'){ echo 'subdrop'; } ?>><i class="ti-pencil-alt"></i> <span> Vehicle Sales</span> </a>                               
								<ul class="list-unstyled" <?php if($this->uri->segment(1)=='Vehicle_sales'){ echo 'style="display: block;"'; } ?>>
								   <li id="clist"><a href="<?php echo base_url().'index.php/Vehicle_sales/vehicle_sales_list'?>" >Vehicle Sales List</a></li>
								   <li id="new"><a href="<?php echo base_url().'index.php/Vehicle_sales' ?>">Add Vehicle Sales</a></li>
								</ul>
							</li>
         <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
<!-- Left Sidebar End --> 
<div class="content-page">