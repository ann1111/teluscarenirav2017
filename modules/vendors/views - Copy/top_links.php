
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
		 <a href="<?php echo base_url();?>vendors/motor" title="Motor Plan">Add Motor Plan</a>
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
  </li>
  <li style="width:10.1%"><a href="<?php echo base_url();?>vendors/reviews" title="Reviews" <?php echo $this->page_section_ct == 'reviews' ? 'class="act"' : '';?>>Reviews</a></li>
</ul>
<div class="cb"></div>
	<div class="p15" style="border:1px solid #999;">
	</div>