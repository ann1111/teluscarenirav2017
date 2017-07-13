<?php
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
<ul class="emp_acc_link">
  <li style="width:12%"><a href="<?php echo base_url();?>vendors"  title="Dashboard" <?php echo $this->page_section_ct == 'myaccount' ? 'class="act"' : '';?>>Dashboard</a></li>
    <li style="width:13%"><a href="<?php echo base_url();?>vendors/my_profile" title="My Profile" <?php echo $this->page_section_ct == 'myprofile' ? 'class="act"' : '';?>>My Profile</a> </li>
    <li style="width:20%"><a href="<?php echo base_url();?>vendors/products" title="Manage Products/Services" <?php echo $this->page_section_ct == 'products' ? 'class="act"' : '';?>>Manage Products/Services</a>
     <div> 
		 <a href="<?php echo base_url();?>vendors/plan" title="Health Plan">Add Health Plan</a> 
		 <a href="<?php echo base_url();?>vendors/motor" title="Motor Plan">Add Motor Plan</a>		 		 <a href="<?php echo base_url();?>vendors/cleaning" title="Motor Plan">Add Cleaning Services</a>		 		 		 <a href="<?php echo base_url();?>vendors/motorservicing" title="Motor Servicing">Add Motor Services</a>		 <a href="<?php echo base_url();?>vendors/pestcontrol" title="Pest Control">Add Pest Control Service</a>
		 <a href="<?php echo base_url();?>vendors/quotes/view_feedback" title="Services">Feedbacks</a> 
	 </div>
	 
	 </li>
    <li style="width:18%"><a href="<?php echo base_url();?>vendors/quotes" title="Manage Quote Enquiry" <?php echo $this->page_section_ct == 'quotes' ? 'class="act"' : '';?>>Manage Quote Enquiry</a></li>
    <!--<li style="width:10%"><a href="javascript:void(0)" title="Payment">Payment</a></li>-->
  
  <li><a href="<?php echo base_url();?>vendors/edit_account" title="Manage Account" <?php echo $this->page_section_ct == 'editaccount' ? 'class="act"' : '';?>>Manage Account</a>
	<div>
	  <a href="<?php echo base_url();?>vendors/edit_account"  title="Edit Account" >Edit Account</a> 
	  <a href="<?php echo base_url();?>vendors/change_password" title="Change Password">Change Password</a>
	</div>
  </li>  <li style="width:10%"><a href="<?php echo base_url();?>vendors/myorders" title="Reviews" >My Orders</a></li>  
  <li style="width:10%"><a href="<?php echo base_url();?>vendors/reviews" title="Reviews" <?php echo $this->page_section_ct == 'reviews' ? 'class="act"' : '';?>>Reviews</a></li>
</ul>
<div class="cb"></div>
<div class="p15 ttl_bg2">
  <div class="fl mr10 thm_cont2"><img src="<?php echo get_image('company_logos',$this->mres['company_logo'],'113','60','R'); ?>"  alt="" title="" width="113" height="60"></div>
  <p class="fs18 ttu b black"><?php echo  trim($this->mres['first_name'].$this->mres['last_name']); ?></p>
  <p class="fs13 mt3"><b>Company Name</b> : <?php echo formatCustomValue(array('val'=>$this->mres['company_name']));?> /<b>Mobile No.</b> : <?php echo formatCustomValue(array('val'=>$this->mres['mobile_number']));?> / <b>Address : </b> <?php echo formatCustomValue(array('val'=>$address));?></p>
  <p class="fs12 mt5">Last Login : 
  <?php
  if(!is_null($this->mres['last_login_date']) && $this->mres['last_login_date']!='0000-00-00 00:00:00')
  {
	echo date("d/m/Y [h:iA]",strtotime($this->mres['last_login_date']));
  }
  else
  {
	echo "-";
  }
  ?>
   / <span class="red"><a href="<?php echo base_url();?>users/logout" class="uo ttu weight600" title="Logout!"><img src="<?php echo theme_url();?>images/lgt2.png" width="15" height="16" class="vam pb3 mr5" alt="" title="">Logout!</a></span></p>
</div>