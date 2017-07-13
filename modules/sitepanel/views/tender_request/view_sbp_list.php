<?php $this->load->view('includes/face_header'); ?>
<table width="90%" align="left" cellpadding="1" cellspacing="1" class="list" style="margin-top:10px;">
<thead>
<tr>
	<td colspan="4" height="30"><?php echo $heading_title; ?>
		
	</td>
</tr>
</thead>
</table>

<?php 
if (is_array($res_vendors) && !empty ($res_vendors) )
{ 
?>
  <table width="90%" align="left" cellpadding="1" cellspacing="1" class="list" style="margin-top:10px;">
  <thead>
	<tr>
	  <td width="20" style="text-align: center;">Sl.</td>
	  <td width="139" class="left">Service</td>
	  <td width="239" class="left">SBP</td>
	  <td width="131" align="left">Posted</td>
  </tr>
  </thead>
  <?php 
  $atts = array(
				'width'      => '740',
				'height'     => '600',
				'scrollbars' => 'yes',
				'status'     => 'yes',
				'resizable'  => 'yes',
				'screenx'    => '0',
				'screeny'    => '0'
			   ); 
  $sl = $offset;
  foreach($res_vendors as $key=>$val)
  {
	
	?>
	<tr>
	  <td><?php echo ++$sl;?></td>
	  <td>
		<p>
		<?php
		if($val['status']!='2')
		{
		?>
		  <?php echo anchor_popup('sitepanel/products/details/'.$val['ref_product_id'], $val['prod_title'], $atts);?>
		<?php
		}
		else
		{
		  echo $val['prod_title'];
		}
		?>
	  </p>
	  <p class="fs13 mt3">Type : <?php echo get_product_type($val['prod_type']);?></p>
	  </td>
	  <td>
		<?php echo anchor_popup('sitepanel/vendors/details/'.$val['vendor_id'], $val['company_name'], $atts);?>
	  </td>
	  <td><?php echo date("d F, Y H:i A",strtotime($val['date_added']));?></td>
	</tr>
  <?php
  }
  ?>
  </table>
  <?php
  if($page_links!='')
  {
  ?>
	<table class="list" width="100%">
	<tr><td align="right" height="30"><?php echo $page_links; ?></td></tr>     
	</table>
  <?php
  }
  ?>
<?php  
}else{
	echo "<div><center><strong> No record(s) found !</strong></center></div>" ;
}
?>
</body>
</html>