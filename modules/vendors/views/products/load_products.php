<?php
if(is_array($res) && !empty($res))
{
  $sl = $offset;
  foreach($res as $val)
  {
	$link_url = base_url().$val['friendly_url'];
	?>
	<tr class="xitemContainer">
	  <td class="b"> <?php echo ++$sl;?>.</td>
	  <td>
		<div class="pro_pcx fl mr15">
		  <div class="pro_pcx2">
			<figure><a href="<?php echo $link_url;?>" title="<?php echo escape_chars($val['product_alt']);?>"><img src="<?php echo get_image('product/images',$val['product_image'],'146','100','R'); ?>" alt="<?php echo escape_chars($val['product_alt']);?>" title="<?php echo escape_chars($val['product_alt']);?>"></a></figure>
		  </div>
		</div> 

		<p><b class="blue fs14"><a href="<?php echo $link_url;?>" class="uu b" target="_blank"><?php echo $val['prod_title'];?></a></b></p>
		<p class="mt3">Type : <b><?php echo get_product_type($val['prod_type']);?></b> / For : <b><?php echo get_product_for($val['prod_for']);?></b> / Last Modified : <?php echo !is_null($val['date_updated']) ? date("d F, Y",strtotime($val['date_updated'])) : ' - ';?></p>

		<div class="mt10 fs12 lht-14"><?php echo char_limiter($val['short_description'],200);?></div>

		<div class="cb"></div>     
	  </td>
	  <td class="ac">
		<a href="<?php echo base_url();?>vendors/products/edit_product/<?php echo $val['products_id'];?>" title="Edit Details"><img src="<?php echo theme_url();?>images/edt.png" class="vam mr10" alt=""></a>
		<a href="<?php echo base_url();?>vendors/products/remove_product/<?php echo $val['products_id'];?>" onclick="return confirm('Are you sure you want to remove this record');" title="Delete Record"><img src="<?php echo theme_url();?>images/m-no.png" class="vam" alt=""></a>
	  </td>
	</tr>
  <?php
  }
}