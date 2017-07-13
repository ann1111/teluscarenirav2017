<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Welcome</title>
  <link href="<?php echo theme_url();?>css/win.css" type="text/css" rel="stylesheet">
  <link href="<?php echo theme_url();?>css/conditional_win.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="assurance.ico">
</head>
<body>
  <div class="p10 pl15 pr15">
	<h2 class="fs18">Vendors</h2>
	<div class="short_form mt6 mb15">
	  <div class="fls p7" style="width:100%;">
		<div style="height:185px; overflow-y:scroll">
		  <?php
		  if(is_array($res_vendors) && !empty($res_vendors))
		  {
			$sl = 0;
			foreach($res_vendors as $key=>$val)
			{
			  $cls = $sl%2==0 ? 'fl w48 p5' : 'fr w48 p5';

			  $prod_link = base_url().$val['friendly_url'];

			  $comp_link = base_url().$val['company_url'];
			?>
			  <div class="<?php echo $cls;?>">
				<p>Service : 
				  <?php
				  if($val['status']=='1' && $val['user_status']=='1')
				  {
				  ?>
					<a href="<?php echo $prod_link;?>" class="uu b" target="_blank"><?php echo $val['prod_title'];?></a>
				  <?php
				  }
				  else
				  {
				  ?>
					<?php echo $val['prod_title'];?>
				  <?php
				  }
				  ?>
				</p>
				<p class="fs13 mt3">Type : <?php echo get_product_type($val['prod_type']);?></p>
				<?php
				if($val['company_status']=='1')
				{
				?>
				  <p>SBP : <b class="orange b"><a href="<?php echo $comp_link;?>" title="<?php echo escape_chars($val['company_name']);?>" class="uo" target="_blank"><?php echo $val['company_name'];?></a></b></p>
				<?php
				}
				else
				{
				?>
				  <p>SBP : <b class="orange b"><?php echo $val['company_name'];?></b></p>
				<?php
				}
				?>
			  </div>
			<?php
			  $sl++;
			  if($sl%2 == 0)
			  {
				echo '<div class="cb pb15"></div>';
			  }
			}
		  }
		  else
		  {
			echo '<p class="fl b">'.$this->config->item('no_record_found').'</p>';	
		  }
		  ?>
		  <div class="cb"></div>
		</div>
	  </div>
	</div>
  </div>
</body>
</html>