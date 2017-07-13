	<div>		  <div class="wrapper">				<div class="card hovercard">					<div class="card-background">						<img class="card-bkimg" alt="" src="<?php echo base_url(); ?>assets/newasset/image/9.jpg">						<!-- http://lorempixel.com/850/280/people/9/ -->					</div>					<div class="useravatar">						<img alt="" src="<?php echo base_url(); ?>assets/newasset/image/Avatar_girl_face.png">					</div>					<div class="card-info"> <span class="card-title"><?php echo trim(strtoupper($this->mres['first_name'].$this->mres['last_name'])); ?></span>					</div>				</div>						</div>										</div>	<?php
$address_arr = array();
if($this->mres['address']!='')
{
  array_push($address_arr,$this->mres['address']);
}
if($this->mres['city']!='')
{
  array_push($address_arr,$this->mres['city']);
}
if($this->mres['state']!='')
{
  array_push($address_arr,$this->mres['state']);
}
if($this->mres['zipcode']!='')
{
  array_push($address_arr," - ".$this->mres['zipcode']);
}
if($this->mres['country']!='')
{
  array_push($address_arr,$this->mres['country']);
}
$address = implode(",",$address_arr);
$address = preg_replace("~(,\s*-)~"," -",$address);
?>
<ul class="emp_acc_link" style="width:100%;">
  <li style="width:12.1%"><a href="<?php echo base_url();?>vendors"  title="Dashboard" <?php echo $this->page_section_ct == 'myaccount' ? 'class="act"' : '';?>>Dashboard</a></li>
    <li style="width:13.1%"><a href="<?php echo base_url();?>vendors/my_profile" title="My Profile" <?php echo $this->page_section_ct == 'myprofile' ? 'class="act"' : '';?>>My Profile</a> </li>
    <li style="width:20.1%"><a href="<?php echo base_url();?>vendors/products" title="Manage Products/Services" <?php echo $this->page_section_ct == 'products' ? 'class="act"' : '';?>>Manage Products/Services</a>
     <div> 
		 <a href="<?php echo base_url();?>vendors/plan" title="Health Plan">Add Health Plan</a> 
		 <a href="<?php echo base_url();?>vendors/motor" title="Motor Plan">Add Motor Plan</a>		 		 <a href="<?php echo base_url();?>vendors/cleaning" title="Motor Plan">Add Cleaning Services</a>		 		 		 <a href="<?php echo base_url();?>vendors/motorservicing" title="Motor Servicing">Add Motor Services</a>		 <a href="<?php echo base_url();?>vendors/pestcontrol" title="Pest Control">Add Pest Control Service</a>
		 <a href="<?php echo base_url();?>vendors/quotes/view_feedback" title="Services">Feedbacks</a> 
	 </div>
	 
	 </li>
    <li style="width:18.1%"><a href="<?php echo base_url();?>vendors/quotes" title="Manage Quote Enquiry" <?php echo $this->page_section_ct == 'quotes' ? 'class="act"' : '';?>>Manage Quote Enquiry</a></li>
    <!--<li style="width:10%"><a href="javascript:void(0)" title="Payment">Payment</a></li>-->
  
  <li><a href="<?php echo base_url();?>vendors/edit_account" title="Manage Account" <?php echo $this->page_section_ct == 'editaccount' ? 'class="act"' : '';?>>Manage Account</a>
	<div>
	  <a href="<?php echo base_url();?>vendors/edit_account"  title="Edit Account" >Edit Account</a> 
	  <a href="<?php echo base_url();?>vendors/change_password" title="Change Password">Change Password</a>
	</div>
  </li>  <li style="width:10%"><a href="<?php echo base_url();?>vendors/myorders" title="Reviews" >My Orders</a></li>  
  <li style="width:10.1%"><a href="<?php echo base_url();?>vendors/reviews" title="Reviews" <?php echo $this->page_section_ct == 'reviews' ? 'class="act"' : '';?>>Reviews</a></li>
</ul>
<div class="cb"></div>
	<div class="p15" style="border:1px solid #999;">		<table class="black">				   <tr><td><b>Name :-</b></td> <td><h5><?php echo  trim($this->mres['first_name'].$this->mres['last_name']); ?> </h5></td></tr>				    <tr><td><b>Company Name :-</b></td> <td><h5><?php echo formatCustomValue(array('val'=>$this->mres['company_name']));?> </h5></td></tr>				    <tr><td><b>Address :-</b></td> <td><h5><?php echo formatCustomValue(array('val'=>$address));?></h5></td></tr>				    <tr><td><b>Mobile No :-</b></td> <td><h5><?php echo formatCustomValue(array('val'=>$this->mres['mobile_number']));?></h5></td></tr>				    <tr><td><b>Last Login :-</b></td> <td><h5>							  <?php							  if(!is_null($this->mres['last_login_date']) && $this->mres['last_login_date']!='0000-00-00 00:00:00')							  {								echo date("d/m/Y [h:iA]",strtotime($this->mres['last_login_date']));							  }							  else							  {								echo "-";							  }		  ?></h5></td></tr>						<tr><td><h5><a href="<?php echo base_url();?>users/logout" ><img src="<?php echo theme_url();?>images/lgt2.png"  style="margin-right:10px;width:15px;" alt="" title="">Logout</a></h5></td> </tr>	  		</table>
	</div>