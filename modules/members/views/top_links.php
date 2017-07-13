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
  <li><a href="<?php echo base_url();?>members" title="Dashboard" <?php echo $this->page_section_ct == 'myaccount' ? 'class="act"' : '';?>>Dashboard</a></li>
  <li><a href="<?php echo base_url();?>members/quotes" title="Manage Quote" <?php echo $this->page_section_ct == 'quotes' ? 'class="act"' : '';?>>Manage Quote</a></li>
  <li><a href="<?php echo base_url();?>members/admin_quotes" title="Quote via Admin" <?php echo $this->page_section_ct == 'admin_quotes' ? 'class="act"' : '';?>>Quote via Admin</a></li>
  <li><a href="javascript:void(0)" title="Payment History">Payment History</a></li>
  <li><a href="<?php echo base_url();?>members/edit_account" title="Manage Account" <?php echo $this->page_section_ct == 'editaccount' ? 'class="act"' : '';?>>Manage Account</a>
	<div>
	  <a href="<?php echo base_url();?>members/edit_account"  title="Edit Account" >Edit Account</a> 
	  <a href="<?php echo base_url();?>members/change_password" title="Change Password">Change Password</a>
	</div>
  </li>
  <li><a href="<?php echo base_url();?>members/reviews" title="Reviews" <?php echo $this->page_section_ct == 'reviews' ? 'class="act"' : '';?>>Reviews</a></li>
</ul>
<div class="cb"></div>
<div class="p15 ttl_bg2">
  <div class="fl mr10 thm_cont"><img src="<?php echo theme_url();?>images/usr.png" width="60" height="60" alt="" title=""></div>
  <p class="fs18 ttu b black"><?php echo  trim($this->mres['first_name'].$this->mres['last_name']); ?></p>
  <p class="fs13 mt3"><b>Mobile No.</b> : <?php echo formatCustomValue(array('val'=>$this->mres['mobile_number']));?> / <b>Address : </b> <?php echo formatCustomValue(array('val'=>$address));?></p>
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