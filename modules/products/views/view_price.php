<?php
$offset = (int) $this->input->get('offset');

$offset = $offset < 0 ? 0 : $offset;

$end_date = date("Y-m-d",strtotime("+60 days"));
$end_date_arr = explode("-",$end_date);
$end_month = $end_date_arr[1];
$end_day = $end_date_arr[2];

if($offset==0)
{
  $prev_offset = -1;
  $next_offset = 1;
  $loop_start_date = date("Y")."-".date("m")."-01";
}
else
{
  $prev_offset = $offset - 1;
  $loop_start_date = date("Y-m-01",strtotime("+$offset month"));
  $loop_start_arr = explode("-",$loop_start_date);
  $loop_month = $loop_start_arr[1];
  if($loop_month >= $end_month)
  {
	$next_offset = -1;
  }
  else
  {
	$next_offset = $offset + 1;
  }
}
$timestamp = strtotime($loop_start_date);
$offset_days=date("w",$timestamp);
$cal_days=date("t",$timestamp);
$loop_month_name = date("F",$timestamp);
$loop_year = date("Y",$timestamp);
$loop_month = date("m",$timestamp);

$loop_end_date = $loop_year."-".$loop_month."-".($next_offset<0 ? $end_day : $cal_days);

$day_price_vals = array();

$price_res = $this->db->query("SELECT package_date,price_value FROM wl_package_prices WHERE ref_package_id='".$packageId."' AND package_date >='".$loop_start_date."' AND package_date<='".$loop_end_date."'")->result_array();

if(is_array($price_res) && !empty($price_res))
{
  foreach($price_res as $val)
  {
	$db_day = date("j",strtotime($val['package_date']));
	$day_price_vals[$db_day] = $val['price_value'];
  }
}
?>
<!DOCTYPE HTML>
<html>
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Js Holiday</title>
	<link href="<?php echo theme_url();?>css/ak.css" rel="stylesheet" type="text/css">
	<link href="<?php echo theme_url();?>css/conditional_win.css" rel="stylesheet" type="text/css">
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->
  </head>
  <body>
	<div class="p10" >
	  <p class="fs22 b ttu roboto-slab orange"><img src="<?php echo theme_url();?>images/bul.png" class="mr8" alt="">View Prices</p>
	  <div class="border3 p10 mt10">
		<?php
		if($prev_offset >= 0)
		{
		  echo '<div class="b fl"><a href="'.base_url().'packages/view_price/'.$packageId.'?offset='.$prev_offset.'">Prev</a></div>';
		}
		if($next_offset > 0)
		{
		  echo '<div class="b fr"><a href="'.base_url().'packages/view_price/'.$packageId.'?offset='.$next_offset.'">Next</a></div>';
		}
		?>
		<div class="cb"></div>
		<div class="b fs14 ac"><?php echo $loop_month_name." ".$loop_year;?></div>
		<div class="cb pb10"></div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="pricecal ">
		 <thead>
			<tr class="bg-gray4 green2 roboto b fs14 ">
			  <th>SUN</th>
			  <th>MON</th>
			  <th>TUE</th>
			  <th>WED</th>
			  <th>THU</th>
			  <th>FRI</th>
			  <th>SAT</th>
			</tr>
		 </thead>
		  <?php
		  $jx = 0;
		  for($i=1;$i<=$cal_days;$i++)
		  {
			$mark_class = "mark2";

			if($jx%7==0)
			{
			?>
			  <tr>
			<?php
			}
			  if($i==1)
			  {
				while($jx < $offset_days)
				{
				  echo '<td></td>';
				  $jx++;
				}
			  }
			?>
			  <td>
				<?php
				if(array_key_exists($i,$day_price_vals))
				{
				  $mark_class = "mark";
				?>
				  <div class="price"><?php echo display_price($day_price_vals[$i]);?>/pp</div>
				<?php
				}
				?>
				<div class="date"><?php echo $i;?></div>
				<div class="<?php echo $mark_class;?>"></div>
			  </td>
			<?php
			$jx++;
			if($jx%7==0)
			{
			?>
			  </tr>
			<?php
			}
		  }
		  if($jx%7>0)
		  {
			$colspan_offset = 7 - $jx%7;
			$colspan_adjust = $colspan_offset > 1 ? ' colspan="'.$colspan_offset.'"' : '';
		  ?>
			  <td<?php echo $colspan_adjust;?>></td>
			</tr>
		  <?php
		  }
		  ?>
		  </table>
		</div>
	  </div>
  </body>
</html>
