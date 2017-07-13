<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>My Account</strong></span></div>
  </div>
</div>
<div class="wrapper pt20 pb20" style="min-height:300px;">
  <?php $this->load->view('vendors/top_links');?>
  <?php error_message();?>
  <div class="cb"></div>
  <div class="w80 auto mt70">
	<p class="fs32 ac black weight300 ttu">Welcome to TelUs Care!!!</p>
	<p class="fs16 b ac mt20 mb70 ttu">-: Account Stats :-</p>
	<div class="fl my_circle ac weight300 fs18 black bg1 ml42 trans_eff">
	  <p class="red pt60 fs51"><?php echo $total_products;?></p>
	  <p class="mt15 p10 fs24 lht-28">Products /
Services</p>
	</div>
	<div class="fl my_circle ac weight300 fs18 black ml50 bg5 trans_eff">
	  <p class="red pt60 fs51"><?php echo $total_confirmed_inquiry;?></p>
	  <p class="mt15 p10 fs24 lht-28">Approved Tenders</p>
	</div>
	
	<div class="fl my_circle ac weight300 fs18 black ml50 bg1 trans_eff">
	  <p class="red pt60 fs51"><?php echo $total_inquiry;?></p>
	  <p class="mt15 p10 fs24 lht-28">Quotation Requests</p>
	</div>
	<div class="fl my_circle ac weight300 fs18 black ml50 bg1 trans_eff">
	  <p class="red pt60 fs51"><?php echo $books;?></p>
	  <p class="mt15 p10 fs24 lht-28">BOOK SERVICES</p>
	</div>
	<div class="fl my_circle ac weight300 fs18 black ml50 bg1 trans_eff">
	  <p class="red pt60 fs51"><?php echo $saves;?></p>
	  <p class="mt15 p10 fs24 lht-28">SAVE SERVICES</p>
	</div>
	<div class="cb pb30 mb50"></div>
  </div>
</div>
<?php
if(is_array($recent_inquiry) && !empty($recent_inquiry))
{
?>
<div class="bg-gray1 bt minmax"> <img src="<?php echo theme_url();?>images/rq.png" class="db auto" style="margin-top:-16px" alt="">
  <div class="wrapper">
  <?php
  foreach($recent_inquiry as $key=>$val)
  {
	$exclass= $key > 0 ? 'ml18' : '';

	$dtl_link = base_url().'vendors/quotes/quote_details/'.$val['quotation_id'];

	$prod_link = base_url().$val['friendly_url'];
  ?>
	<div class="mt20 fl w32 <?php echo $exclass;?>">
	  <p><i class="orange">Request for :</i> <br>
	  <?php
	  if($val['status']=='1' && $val['user_status']=='1')
	  {
	  ?>
		<b class="blue"><a href="<?php echo $prod_link;?>" class="uu b" target="_blank"><?php echo $val['prod_title'];?></a></b>
	  <?php
	  }
	  else
	  {
	  ?>
		<b class="blue"><?php echo $val['prod_title'];?></b><span class="red">(<?php echo ($val['status']==2 || $val['user_status']==2) ? 'Deleted' : 'Inactive';?>)</span>
	  <?php
	  }
	  ?>
	  </p>
	  <p>Type : <b><?php echo get_product_type($val['prod_type']);?></b></p>
	  <div class="mt10 fs12 lht-14"><?php echo char_limiter($val['comments'],200);?> <a href="<?php echo $dtl_link;?>" title="More" class="uu">More&raquo;</a></div>
	  <a href="<?php echo $dtl_link;?>#reply" class="btn1s mt10 radius-3 trans_eff" title="Send Reply">Send Reply</a>
	</div>
  <?php
  }
  ?>
	<div class="cb"></div>
	<p class="b orange fs14 mt25"><a href="<?php echo base_url();?>vendors/quotes" class="uu" title="View All Requests">View All Requests&raquo;</a></p>
  </div>
  <div class="mt35" style="border-bottom:3px solid #e79721"></div>
</div>
<?php
}
?>
<?php //$this->load->view("bottom_application");?>