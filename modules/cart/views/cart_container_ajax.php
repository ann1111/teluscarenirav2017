<h3 class="mb20">Your Cart Items</h3>
<?php
$curr_symbol = display_symbol();
if($this->cart->total_items() > 0 ) 
{
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
	<div class="bb2 ajx_item_crt">
	  <p class="fs14 b black"><a href="<?php echo $link_url;?>" title="<?php echo escape_chars($items['product_alt']);?>"> <b class="fl thm_cont mr10"><img src="<?php echo get_image('product/images',$items['img'],'100','100','R'); ?>" alt="<?php echo escape_chars($items['product_alt']);?>" ></b><?php echo $items['origname'];?></a></p>
	  <p class="fs11">Code : <?php echo $items['code'];?></p>
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
	   / Quantity : <?php echo $items['qty'];?></p>
	  <div class="cb"></div>
	  <p class="b mt10 mb7">Attributes / Accessories</p>
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
			<p class="fs14"><?php echo ++$attr;?>) <?php echo $gval['attr_name'];?><a href="#" data-attr="<?php echo $gval['attr_id'];?>" data-rowid="<?php echo $items['rowid']; ?>" class="rmcart" ><img src="<?php echo theme_url();?>images/m-no.png" alt="" height=15></a> 
			<?php
			if($loop_attr_price > 0)
			{
			?>
			  (Price:  <b class="red"><?php echo display_price($loop_attr_price);?></b>)
		  <?php
			}
			?>
			</p>
		  <?php
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
			<p class="fs14"><?php echo ++$attr;?>) <?php echo $gval['acc_name'];?><a href="#" data-acc="<?php echo $gval['acc_id'];?>" data-rowid="<?php echo $items['rowid']; ?>" class="rmcart" ><img src="<?php echo theme_url();?>images/m-no.png" alt="" height=15></a>
			<?php
			if($loop_acc_price > 0)
			{
			  ?>
			  (Price:
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
			  echo ')';
			}
			?> 
			</p>
		  <?php
		  }
		}
	  }
	  else
	  {
		echo '<p class="fs14">NA</p>';
	  }
	  $item_subtotal = $item_total * $items['qty'];

	  $cart_total += $item_subtotal;
	  ?>
	  <p class="mt15 p10 bg-gray"><b>Amount : <?php echo display_price($item_subtotal);?></b> / <span class="red"><a href="#" data-rowid="<?php echo $items['rowid']; ?>" class="rmcart"><b>X</b> Remove</a></span></p>
	  <div class="cb"></div>
	</div>
  <?php
  }
  $set_shipping_id = $this->session->userdata('shipping_id')=='' ? '' : $this->session->userdata('shipping_id');

  $tax_cent = fmtZerosDecimal($tax_cent);

  $tax = ($cart_total*$tax_cent)/100;

  $shipping_total  = array_key_exists('shipment_rate',$shipping_res) ?  $shipping_res['shipment_rate'] : 0;

  $grand_total      = $cart_total + $shipping_total + $tax;

  $this->session->set_userdata('shipping_rate',$shipping_total) ;
  $this->session->set_userdata('shipping_type',$set_shipping_id) ;
  ?>
  <p class="mt20 fs16">Shipping Charges  : <b><?php echo display_price($shipping_total);?></b> / Tax (<?php echo $tax_cent;?>%)	: <b><?php echo display_price($tax);?></b></p>
  <p class="mt10 fs18 b">Estimated Total : <b class="red"><?php echo display_price($grand_total);?></b></p>
<?php
}
else
{
  echo '<div>No item(s) added in your cart</div>';
}
