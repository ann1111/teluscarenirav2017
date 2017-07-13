<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
if(empty($_POST))
{
  $usp=$mres['usp'];
  if(!is_null($usp))
  {
	$usp = unserialize($usp);
  }
  $usp = !is_array($usp) ? array() : $usp;

  $why_us=$mres['why_us'];
  if(!is_null($why_us))
  {
	$why_us = unserialize($why_us);
  }
  $why_us = !is_array($why_us) ? array() : $why_us;
}
else
{
  $usp = $this->input->post('usp');
  $why_us = $this->input->post('why_us');
}
?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>vendors" itemprop="url"><span itemprop="title">My Account</span></a></div>
    <b>&gt;</b>
    <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>My Profile</strong></span></div>
  </div>
</div>
<div class="wrapper pt20 pb20" style="min-height:300px;">
  <?php $this->load->view('vendors/top_links');?>
  <div class="w90 auto mt30">
	<h2 class="bb1 pb5">My Profile</h2>
	<?php error_message();?>
	<?php echo form_open_multipart(''); ?>
	<div class="mt40 w80 short_form fs14 auto bg-gray1 p20 border1">
	  <fieldset class="pb15 mt30" style="border:0;">
		<p class="w36 pt8">
		  <label for="company_logo">Company Logo  :</label>
		</p>
		<div class="w62">
		  <span class="fls"><input name="company_logo" id="company_logo" type="file" style="border:0;width:100%"></span>
		  <?php
			if( $mres['company_logo']!='' && file_exists(UPLOAD_DIR."/company_logos/".$mres['company_logo']) )
			{ 
			?>
			  <p class="fl" style="display:inline;color:red;"><a href="<?php echo base_url().'uploaded_files/company_logos/'.$mres['company_logo'];?>"  class="dg2" style="color:red;">View</a>
			| <input type="checkbox" name="comp_logo_delete" value="Y" /> Delete </p>
			
			<?php	
			}
			?>
		  </b>
		  <?php echo form_error('company_logo');?>
		  <p class="cb"></p>
		  [ <?php echo $this->config->item('comp.logo.best.image.view');?> ]
		</div>
		<div class="cb pb10"></div>

		<p class="w36 pt8">
		  <label for="short_description">Short Description <b class="red">*</b> :</label>
		</p>
		<div class="w62">
		  <textarea name="short_description" cols="40" rows="4" id="short_description"><?php echo set_value('short_description',$mres['short_description']);?></textarea>
		  <?php echo form_error('short_description');?>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
		  <label>USP <b class="red">*</b> :</label>
		</p>
		<div class="w62">
		  <?php
		  for($i=0;$i<=4;$i++)
		  {
			$loop_value = array_key_exists($i,$usp) ? $usp[$i] : '';
		  ?>
			<div<?php echo $i>0 ? ' class="pt5"' : '';?>><input type="text" name="usp[]" value="<?php echo set_value('usp',$loop_value);?>" /></div>
			<?php echo form_error("usp[$i]");?>
		  <?php
		  }
		  ?>
		</div>
		<div class="cb pb10"></div>
		<p class="w36 pt8">
		  <label for="detailed_description">Why Us <b class="red">*</b> :</label>
		</p>
		<div class="w62">
		  <?php
		  for($i=0;$i<=9;$i++)
		  {
			$loop_value = array_key_exists($i,$why_us) ? $why_us[$i] : '';
		  ?>
			<div<?php echo $i>0 ? ' class="pt5"' : '';?>><input type="text" name="why_us[]" value="<?php echo set_value('why_us',$loop_value);?>" /></div>
			<?php echo form_error("why_us[$i]");?>
		  <?php
		  }
		  ?>
		</div>
		<div class="cb pb10"></div>
	  </fieldset>
	  <p class="w62 osons">
		<input name="edt_btn" type="submit" value="Update Now!" class="btn3 trans_eff radius-3">
		<input name="reset" type="reset" value="Reset" class="btn3x trans_eff radius-3">
	  </p>
	  <div class="cb"></div>
	</div>
	<?php echo form_close();?>
	<div class="cb pb30"></div>
  </div>
</div>
<?php $this->load->view("bottom_application");?>