<?php $this->load->view('includes/header'); ?>  
<?php
$section = $this->input->post('section');
?>
 <div id="content">
  
  <div class="breadcrumb">
  
      <?php echo anchor('sitepanel/dashbord','Home'); ?>
 &raquo; <?php echo anchor('sitepanel/banners','Back To Listing'); ?> &raquo;  <?php echo $heading_title; ?> 
             
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">&nbsp;</div>
      
    </div>
    
    
	<div class="content">
    <?php echo validation_message('');?>
		<?php
		$bann_arr = $this->config->item('bannersz');
		?>
		<?php echo form_open_multipart('sitepanel/banners/add/');?>  
		<div id="tab_pinfo">
			<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
			<tr>
				<th colspan="2" align="center" > </th>
			</tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" ><span class="required">*</span> Section:</td>
				<td width="72%" align="left">
					<select name="section" onchange="change_ban_postions(this.value);">
						<option value="">Select Section</option>
						<?php 
						foreach ($this->config->item('bannersections')  as $key=>$val)
						{
							$sel = ($section==$key ) ? "selected" : "";
							?> 
							<option value="<?php echo $key;?>" <?php echo $sel;?> ><?php echo $val ;?></option> 
						<?php 
						} 
						?>  
					</select>
				</td>
			</tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" ><span class="required">*</span> Banner Position:</td>
				<td width="72%" align="left">
                <div id="ban_postion">
                
                <?php echo banner_postion_drop_down('banner_position',$this->input->post('banner_position'),$section);?>
					<?php /*?><select name="banner_position" >
						<option value="">Select position</option>
						<?php 
						foreach ($bann_arr  as $key=>$val)
						{
							$sel = ($this->input->post('banner_position')==$key ) ? "selected" : "";
							?> 
							<option value="<?php echo $key;?>" <?php echo $sel;?> ><?php echo $key ;?> &raquo; Best Banner Size (<?php echo $val; ?>)</option> 
						<?php 
						} 
						?>  
					</select><?php */?>
                    </div>
				</td>
			</tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" ><span class="required">*</span> Banner Image:</td>
				<td align="left">
					<input type="file" name="image1" id="image1" />
					<br />
				</td>
			</tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" >Banner Alt</td>
				<td align="left">
					<input type="text" name="banner_alt" value="<?php echo set_value('banner_alt');?>" />
					<br />
				</td>
			</tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" >Banner URL</td>
				<td align="left">
					<input type="text" name="banner_url" value="<?php echo set_value('banner_url');?>" />
					<br />
				</td>
			</tr>
             <tr class="trOdd" id="banner_cont_text" style="<?php echo set_value('banner_position')=='Home Top' ? '' : 'display:none;';?>">
				<td width="28%" height="26" align="right" >Banner Text</td>
				<td align="left">
					<textarea name="banner_text" rows="5" cols="50" id="text_banner" ><?php echo set_value('banner_text');?></textarea>
			<?php  echo display_ckeditor($ckeditor); ?>
				</td>
			</tr>
           
			<tr class="trOdd">
				<td align="left">&nbsp;</td>
				<td align="left">
					<input type="submit" name="sub" value="Add Banner" class="button2" />
					<input type="hidden" name="action" value="addbanner" />
				</td>
			</tr>
			</table>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
<script type="text/javascript">
function change_ban_postions(){
	$('#banner_cont_text').hide();
	var section = $('[name="section"]').val();
	
	if(section != '' && section != 'undefined')
	{
		$.ajax({
				  type: "POST",
				  url: "<?php echo base_url();?>sitepanel/banners/ajx_ban_postions",
				  data: { banner_section : section }
				}).done(function( data ) {
				  $('#ban_postion').html(data);
				});
		
		
	}
	return false;
	
}
$(document).ready(function(){
$('#ban_postion').delegate('select[name="banner_position"]','change',function(){
  if($(this).val()=='Home Top'){
	$('#banner_cont_text').show();
  }else{
	$('#banner_cont_text').hide();
  }
});
});
</script>
<?php $this->load->view('includes/footer'); ?>