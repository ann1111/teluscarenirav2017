<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('CI')){
	 
	function CI()
	{
		if (!function_exists('get_instance')) return FALSE;
		$CI =& get_instance();
		return $CI;
	}
}
 

function invoice_content ($ordmaster,$orddetail )
{
		$CI = CI();
		$curr_symbol = display_symbol();

		$bill_info = $ordmaster['billing_address'].',<br />'.
		$ordmaster['billing_city'].',<br />'.
		$ordmaster['billing_state'].' - '.$ordmaster['billing_country'].' - '.$ordmaster['billing_zipcode'];
		
		$ship_info = $ordmaster['shipping_address'].',<br />'.
		$ordmaster['shipping_city'].',<br />'.
		$ordmaster['shipping_state'].' - '.$ordmaster['shipping_country'].' - '.$ordmaster['shipping_zipcode'];

		$tax_cent  = $ordmaster['vat_applied_cent'];

		$tax_cent = fmtZerosDecimal($tax_cent);

		$tax = $ordmaster['vat_amount'];

		$shipping_total  = $ordmaster['shipping_amount'];

		$grand_total      = $ordmaster['total_amount'] + $shipping_total + $tax;	
 ?>
  <div>
	<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1">
	<tr>
	  <td align="left"><p style="padding-top:2px; margin:0px; color:#333; line-height:18px;"><strong style="color:#e00">HOISTS ONLINE</strong><br>
	33/33A, Industrial Area, Kirti Nagar - 110018, <strong>India</strong><br>
	<br>
	<span style="padding-top:3px; font-size:18px">Email Us : <a href="#" style="color:#000; font-weight:bold;">customercare@hoistsonline.com</a></span> Phone : +353 (0)87 9034796 </p>
	<br></td>
	  <td align="right" valign="middle"><img src="<?php echo theme_url();?>images/hoists.png" alt="" width="154" height="111"></td>
	</tr>
	</table>
	<br>
	<div style="width:27%; border:10px solid #eee; padding:15px; min-height:170px; float:left">
	  <div style="font:bold 16px/20px Arial, Helvetica, sans-serif; color:#333; border-bottom:1px solid #ccc; margin-bottom:10px">Order Summary</div>
	  <div style="margin-top:5px; font:normal 12px/20px Arial, Helvetica, sans-serif"><b>Invoce No. : <?php echo $ordmaster['invoice_number'];?></b><br>
Dated : <?php echo date("d/m/Y",strtotime($ordmaster['order_received_date']));?> [<?php echo $ordmaster['payment_status'];?> ]</div>
	  <div style="margin-top:10px; font:normal 12px/20px Arial, Helvetica, sans-serif">Subtotal Amount : <?php echo display_price($ordmaster['total_amount']);?><br>
Shipping Charge  : <?php echo display_price($shipping_total);?><br>
Tax (<?php echo $tax_cent;?>%) : <?php echo display_price($tax);?><br><b style="font:bold 16px/30px Arial, Helvetica, sans-serif; color:#000">Total Payable Amount : <?php echo display_price($grand_total);?></b></div>
	</div>
	<div style="width:27%; border:10px solid #eee; padding:15px; min-height:170px; float:left; margin-left:20px">
	  <div style="font:bold 16px/20px Arial, Helvetica, sans-serif; color:#333; border-bottom:1px solid #ccc; margin-bottom:10px">Billing Details</div>
	  <div style="margin-top:5px; font:normal 12px/20px Arial, Helvetica, sans-serif"><b><?php echo $ordmaster['billing_name'];?></b><br>
Mobile No. <?php echo $ordmaster['billing_mobile'];?></div>
	  <div style="margin-top:10px; font:normal 12px/20px Arial, Helvetica, sans-serif"><b>Address</b>
		<br>
		<?php echo $bill_info;?>
	  </div>
	</div>
	<div style="width:27%; border:10px solid #eee; padding:15px; min-height:170px; float:right;">
	  <div style="font:bold 16px/20px Arial, Helvetica, sans-serif; color:#333; border-bottom:1px solid #ccc; margin-bottom:10px">Shipping Details</div>
	  <div style="margin-top:5px; font:normal 12px/20px Arial, Helvetica, sans-serif"><b><?php echo $ordmaster['shipping_name'];?></b><br>
Mobile No. <?php echo $ordmaster['shipping_mobile'];?></div>
	  <div style="margin-top:10px; font:normal 12px/20px Arial, Helvetica, sans-serif"><b>Address</b>
		<br><?php echo $ship_info;?>
	  </div>
	</div>
	<div style="clear:both"></div>
	<br>
	<div style="font:bold 22px/20px 'Trebuchet MS', Arial, Helvetica, sans-serif; color:#000; margin-top:10px">Product Details</div>
	<?php
	$i= 0;
	$attr=0;
	$cart_total=0;
	
	if(is_array($orddetail)	 && !empty($orddetail) )
	{	
	  ?>
	  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" style="margin-top:10px;">
	  <tr style="font-size:13px; color:#fff; line-height:36px; background:#111">
		<td width="10%" align="center" style="line-height:20px; width:10%"><strong>S.No</strong></td>
		<td align="left" colspan="2"><strong>Products</strong></td>
		<td width="10%" align="left" style="width:30%"><strong>Attributes / Accessories</strong></td>
		<td width="10%" align="center" style="width:10%"><b>Amount</b></td>
	  </tr>
	  <?php	
	  foreach ($orddetail as $val)
	  { 
		$item_total = $val['product_price'];

		$item_attributes = $val['product_attr'];

		$item_attributes = explode("^~^",$item_attributes);

		$item_attributes = array_filter($item_attributes);

		$item_attr_price = $val['product_attr_price'];

		$item_attr_price = explode("^~^",$item_attr_price);

		$item_accessories = $val['product_acc'];

		$item_accessories = explode("^~^",$item_accessories);

		$item_accessories = array_filter($item_accessories);

		$item_acc_price = $val['product_acc_price'];

		$item_acc_price = explode("^~^",$item_acc_price);
		?>
	
		<tr align="center">
		  <td colspan="5" valign="top" ><img src="<?php echo theme_url();?>images/spacer.gif" width="1" height="1" alt=""></td>
		</tr>
		<tr>
		  <td align="center" valign="top" style="border-bottom:1px solid #ddd; padding-bottom:10px;"><?php echo ++$i;?>.</td>
		  <td align="left" valign="top" style="border-bottom:1px solid #ddd; padding-bottom:10px;"><img src="<?php echo base_url();?>cart/display_cart_image/<?php echo $val['orders_products_id'];?>" alt="" width="100" height="100" style="margin-right:10px; border:1px solid #ccc; padding:5px"></td>
		  <td align="left" valign="top" style="border-bottom:1px solid #ddd; padding-bottom:10px;"><p style="color:#333; font-size:13px; padding-top:5px; margin:0px; line-height:18px"> <strong style="font-size:18px"><?php echo $val['product_name'];?></strong> <span style="font-size:11px; display:block; padding-top:8px; font-family:Verdana, Geneva, sans-serif">Code : <?php echo $val['product_code'];?><br>
		  Unit Price: <b><?php echo display_price($val['product_price']);?></b> / Quantity : <?php echo $val['quantity'];?></span> </p></td>
		  <td align="left" valign="top" style="border-bottom:1px solid #ddd; padding-bottom:10px;">
		  <?php
		  if(!empty($item_attributes) || !empty($item_accessories))
		  {
			if(!empty($item_attributes))
			{
			  foreach($item_attributes as $gkey=>$gval)
			  {
				$loop_acc_price = floatval($item_attr_price[$gkey]);

				$item_total += $loop_acc_price;
			  ?>
				<div><b><?php echo ++$attr;?>) <?php echo $gval;?></b>
				<?php
				if($loop_acc_price > 0)
				{
				?>
				  (Price: <b style="color:#f00"><?php echo display_price($loop_acc_price);?></b>)
				<?php
				}
				?>
				</div>
			  <?php
			  }
			}
			if(!empty($item_accessories))
			{
			  foreach($item_accessories as $gkey=>$gval)
			  {
				$loop_acc_price = floatval($item_acc_price[$gkey]);

				$item_total += $loop_acc_price;
			  ?>
				<div><b><?php echo ++$attr;?>) <?php echo $gval;?></b>
				<?php
				if($loop_acc_price > 0)
				{
				?>
				  (Price: <b style="color:#f00"><?php echo display_price($loop_acc_price);?></b>)
				<?php
				}
				?>
				</div>
			  <?php
			  }
			}
		  }
		  else
		  {
			echo "NA";
		  }
		  ?>
		  </td>
		  <?php
		  $item_subtotal = $item_total * $val['quantity'];
		  ?>
		  <td align="center" valign="top" style="border-bottom:1px solid #ddd; padding-bottom:10px;"><b><?php echo display_price($item_subtotal);?></b></td>
		</tr>
	  <?php
	  }
	  ?>
	  <tr>
		<td colspan="5" align="left" valign="top" ><img src="<?php echo theme_url();?>images/spacer.gif" width="1" height="1" alt=""></td>
	  </tr>
	  </table>
	<?php
	}
	?>
	  <br>
	  <div style="text-align:right; font:bold 14px/18px Arial, Helvetica, sans-serif; color:#333; border-top:10px solid #000; padding-bottom:15px">Sub Total : <?php echo display_price($ordmaster['total_amount']);?></div>
	  

	
  </div>
<?php
}