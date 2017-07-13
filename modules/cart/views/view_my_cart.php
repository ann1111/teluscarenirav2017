<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
$curr_symbol = display_symbol();
?>
<div class="tree minmax">
  <div class="wrapper"> YOUR ARE HERE : 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title"><img src="<?php echo theme_url();?>images/hm.png" class="vam pb3" alt=""></span></a></div>   
	<b>&gt;</b>   
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong>Shopping Cart</strong></span></div>
  </div>
</div>

<!-- MIDDLE STARTS -->

<section class="minmax mid_shed">
  <div class="wrapper pt30">
	<h1>Shopping <b>Cart</b></h1>
	<?php error_message();?>
	<?php if($this->cart->total_items() > 0 ) 
	{
	?>
	  <?php echo form_open('cart/','name="cart_frm" id="cart_frm" ');?>
	  <div class="p15 pl25 mt10 pr25 bg-gray border1 black osons fs16 weight300">
		<table class="w100">
		<tr>
		  <td class="w10 al"> S. No. </td>
		  <td class="al"><p class="tb-lnk">Products</p></td>
		  <td class="w30 al">Attributes / Accessories</td>
		  <td class="w10 ac">Amount</td>
		  <td class="w10 ac">Remove</td>
		</tr>
		</table>
	  </div>
	  <div>
	  <?php
	  $i= 0;
	  $attr=0;
	  $cart_total=0;
	  foreach($this->cart->contents() as $items)
	  {
		$item_attributes = $items['options']['Attributes'];

		$item_accessories = $items['options']['Accessories'];

		$item_total = $items['price'];

		$link_url = $items['friendly_url'];
	  ?>
		<div class="mylsttb mt7">
		  <table class="w100">
		  <tr>
		  <td class="w10 al"><b><?php echo ++$i;?>.</b></td>
		  <td class="al"><p class="fs16 b"><a href="<?php echo $link_url;?>" title="<?php echo escape_chars($items['product_alt']);?>"> <b class="fl thm_cont mr10"><img src="<?php echo get_image('product/images',$items['img'],'100','100','R'); ?>" alt="<?php echo escape_chars($items['product_alt']);?>" ></b><?php echo $items['origname'];?></a></p>
		  <p class="mt5 fs12">Code : <?php echo $items['code'];?></p>
		  <p class="black fs15 mt2">Price: 
		  <?php
		  if($items['discount_price'] > 0)
		  {
		  ?>
			<span class="gray through"><?php echo display_price($items['product_price']);?></span> <b class="red"><?php echo display_price($items['discount_price']);?></b>
		  <?php
		  }
		  else
		  {
		  ?>
			<b class="red"><?php echo display_price($items['product_price']);?></b>
		  <?php
		  }
		  ?>
		   / Quantity : <input type="text" class="input-bdr2" style="width:30px;" name="<?php echo $i; ?>[qty]" value = "<?php echo $items['qty'];?>" maxlength="2"></p>
			<input type="hidden" name="<?php echo $i; ?>[rowid]" id='cart_rowid_<?php echo $i; ?>' value="<?php echo $items['rowid']; ?>" />
		  </td>
		  <td class="w30 al">
		  <?php
		  if(!empty($item_attributes) || !empty($item_accessories))
		  {
			if(!empty($item_attributes))
			{
			  foreach($item_attributes as $gval)
			  {
				$loop_attr_price = floatval($gval['attr_price']);

				$item_total += $loop_attr_price;
			  ?>
				<p class="b fs14"><?php echo ++$attr;?>) <?php echo $gval['attr_name'];?> <a href="<?php echo base_url(); ?>cart/remove_item/<?php echo $items['rowid']; ?>?attr_id=<?php echo $gval['attr_id'];?>" onclick="return confirm('Are you sure you want to remove this item');"><img src="<?php echo theme_url();?>images/m-no.png" alt="" height=15></a></p>
				<?php
				if($loop_attr_price > 0)
				{
				?>
				  <p class="black fs12 ml17">Price: <b class="red"><?php echo display_price($loop_attr_price);?></b></p>
			  <?php
				}
			  }
			}
			if(!empty($item_accessories))
			{
			  foreach($item_accessories as $gval)
			  {
				$loop_acc_disc_price = floatval($gval['acc_disc_price']);

				$loop_acc_price = $loop_acc_disc_price > 0 ? $loop_acc_disc_price : $gval['acc_price'];

				$loop_acc_price = floatval($loop_acc_price);

				$item_total += $loop_acc_price;
			  ?>
				<p class="b fs14"><?php echo ++$attr;?>) <?php echo $gval['acc_name'];?> <a href="<?php echo base_url(); ?>cart/remove_item/<?php echo $items['rowid']; ?>?acc_id=<?php echo $gval['acc_id'];?>" onclick="return confirm('Are you sure you want to remove this item');"><img src="<?php echo theme_url();?>images/m-no.png" alt="" height=15></a></p>
				<?php
				if($loop_acc_price > 0)
				{
				  ?>
				  <p class="black fs12 ml17">Price:
				  <?php
				  if($loop_acc_disc_price > 0)
				  {
				  ?>
					<span class="gray through"><?php echo display_price($gval['acc_price']);?></span> <b class="red"><?php echo display_price($loop_acc_disc_price);?></b>
				  <?php
				  }
				  else
				  {
				  ?>
					<b class="red"><?php echo display_price($loop_acc_price);?></b>
				  <?php
				  }
				  ?>
				  </p>
				<?php
				}
			  }
			}
		  }
		  else
		  {
			echo '<p class="b fs14">NA<b class="red"></b></p>';
		  }
		  $item_subtotal = $item_total * $items['qty'];

		  $cart_total += $item_subtotal;
		  ?>
		  </td>
		  <td class="w10 ac"><p class="b black fs18" ><?php echo display_price($item_subtotal);?></p></td>
		  <td class="w10 ac"><a href="<?php echo base_url(); ?>cart/remove_item/<?php echo $items['rowid']; ?>" onclick="return confirm('Are you sure you want to remove this item');"><img src="<?php echo theme_url();?>images/m-no.png" alt=""></a></td>
		  </tr>
		  </table>
		</div>
	  <?php
	  }
	  $set_shipping_id = $this->session->userdata('shipping_id')=='' ? '' : $this->session->userdata('shipping_id');

	  $tax_cent  = $this->configuration_res['vat_charge'];

	  $tax_cent = fmtZerosDecimal($tax_cent);

	  $tax = ($cart_total*$tax_cent)/100;

	  $shipping_total  = array_key_exists('shipment_rate',$shipping_res) ?  $shipping_res['shipment_rate'] : 0;

	  $grand_total      = $cart_total + $shipping_total + $tax;

	  $this->session->set_userdata('shipping_rate',$shipping_total) ;
	  $this->session->set_userdata('shipping_type',$set_shipping_id) ;
	  ?>
	  </div>
	  <div class="mt20" style="min-height:80px;">
		<div class="w40 fl">
		  <?php
		  if(is_array($shipping_methods) && !empty($shipping_methods))
		  {
		  ?>
		  <div class="mt5 b p10">Select Shipping State : &nbsp;
			<select name="shipping_method" style="padding:6px; width:205px; font-weight:bold" class="vam" onchange="this.form.submit();">
			  <option value="">Select</option>
			  <?php
			  foreach($shipping_methods as $val)
			  {
			  ?>
				<option value="<?php echo $val['shipping_id'];?>" <?php if($set_shipping_id==$val['shipping_id']) { ?> selected="selected" <?php } ?> ><?php echo $val['shipping_type'];?></option>
			  <?php
			  }
			  ?>
			</select>
			<?php echo form_error('shipping_method');?>
		  </div>
		  <?php
		  }
		  ?>
		</div>
		<div class="fr w25 ar mr20">
		  <p class="w60 fl ar b">Subtotal :</p>
		  <p class="fr ar b"><?php echo display_price($cart_total);?></p>
		  <div class="cb pb5"></div>
		  <p class="w60 fl ar">Shipping Charges (Fedex)	:</p>
		  <p class="fr ar"><?php echo display_price($shipping_total);?></p>
		  <div class="cb pb5"></div>
		  <p class="w60 fl ar">Tax (<?php echo $tax_cent;?>%)	:</p>
		  <p class="fr ar"><?php echo display_price($tax);?></p>
		  <div class="cb pb5"></div>
		  <p class="w60 fl ar b fs16 black">Estimated Total :</p>
		  <p class="fr ar b fs16 red"><?php echo display_price($grand_total);?></p>
		  <div class="cb"></div>
		</div>
		<div class="cb"></div>
	  </div>
	  <div class="mt25 p25 border1 bg-gray">
		<p class="ac">
		  <input name="" type="button" class="btn3 radius-3 shadow1" value="Continue Shopping" onClick="window.location.href='<?php echo base_url();?>category';">
		  &nbsp;
		  <input name="EmptyCart" type="submit" class="btn2 radius-3 shadow1" value="Clear Cart" onclick="return confirm('Are you sure you want to clear the cart');">
		  &nbsp;
		  <input name="Update_Qty" id="Update_Qty" type="submit" class="btn2 radius-3 shadow1" value="Update Quantity">
		  <?php if($this->session->userdata('user_id')=='')
		  {
		  ?> 
		  &nbsp;
		  <input name="GustCheckout" type="submit" class="btn3 radius-3 shadow1" value="Checkout Without Registration">
		  <?php
		  }
		  ?>
		  &nbsp;
		  <input name="UserCheckout" type="submit" class="btn2 radius-3 shadow1" value="Checkout">
		</p>
		<div class="cb"></div>
	  </div>
	<?php
	  echo form_close();
	}
	else
	{
	?>
	  <div class="mt10 p10 fs13 bg4 radius-5 shadow1"><strong>Your Cart is empty</strong></div>
	<?php
	}
	?>
  </div>
</section>
<?php $this->load->view("bottom_application");?>