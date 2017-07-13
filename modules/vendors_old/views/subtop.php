<div class="p15 bg-gray border1 acc_title"><img src="<?php echo theme_url();?>images/user.png" width="42" height="43" class="fl mr10" alt="">
	<p class="fs18 ttu b black">Welcome <?php echo  trim($this->fname.$this->lname); ?>!</p>
	<p class="mt5">Last Login : 
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
	 / <span class="red"><a href="<?php echo base_url();?>users/logout" class="underline"><img src="<?php echo theme_url();?>images/lgt.png" width="17" height="17" class="vam mr5" alt="">Logout!</a></span></p>
</div>