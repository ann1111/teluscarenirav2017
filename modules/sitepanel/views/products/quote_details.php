<?php $this->load->view('includes/face_header');?>
<link href="<?php echo theme_url(); ?>css/win.css" rel="stylesheet" type="text/css" />
<link href="<?php echo theme_url(); ?>css/conditional_win.css" rel="stylesheet" type="text/css" />
<div class="pl5">
  <?php
  $data['res']=$res;
  $this->load->view($view,$data);
  ?>
  <div class="p10 b"><?php echo $res['comments'];?></div>
</div>
</body>
</html>