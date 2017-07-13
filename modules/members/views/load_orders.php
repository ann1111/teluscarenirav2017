<div class="p10 border1">
  <p class="fl">Showing :
  <?php echo front_record_per_page('per_page1'); ?>
  </p>
  <p class="paging fr ar w60 mt2"><?php echo $page_links; ?></p>
  <div class="cb"></div>
</div>
<div class="mt10">
<?php
if(is_array($res) && !empty($res))
{
?>
  <table class="w100 tab-bdr2 fs13">
  <tr class="verd black fs12 b  lht-20">
	<td class="w10">S. No.</td>
	<td>Order/Invoice No.</td>
	<td class="w30">Status</td>
	<td class="w10 ac">View</td>
  </tr>
  <?php
  $sl = $offset;
  foreach($res as $val)
  {
	$shipping_total  = $val['shipping_amount'];

	$grand_total      = $val['total_amount'] + $shipping_total + $val['vat_amount'];	
	?>
	<tr>
	  <td> <?php echo ++$sl;?>.</td>
	  <td><p class="black fs16">Order No. <a href="<?php echo base_url();?>members/print_invoice/<?php echo $val['order_id'];?>" class="invoice underline"><?php echo $val['invoice_number'];?></a></p>
	  <p class="mt2">Paid Amount : <b class="black"><?php echo display_price($grand_total);?></b>, Dated : <?php echo date("d/m/Y",strtotime($val['order_received_date']));?></p></td>
	  <td>
		<p class="lht-18">Payment Status : <b class="green"><?php echo $val['payment_status'];?></b></p>
		<p class="lht-18">Delivery Status : <b class="green"><?php echo $val['order_status'];?></b></p>
	  </td>
	  <td class="ac"><a href="<?php echo base_url();?>members/print_invoice/<?php echo $val['order_id'];?>" class="invoice"><img src="<?php echo theme_url();?>images/vie.png" width="21" height="25" alt=""></a></td>
	</tr>
  <?php
  }
  ?>
  </table>
<?php
}
?>
</div>
<div class="p10 border1">
  <p class="fl">Showing :
	<?php echo front_record_per_page('per_page2'); ?>
  </p>
  <p class="paging fr ar w60 mt2"><?php echo $page_links; ?></p>
  <div class="cb"></div>
</div>