<?php $this->load->view('includes/header'); ?> 
   
 <div id="content">
  
  <div class="breadcrumb">
  
       <?php echo anchor('sitepanel/dashbord','Home'); ?>
 &raquo; <?php echo anchor('sitepanel/staticpages?parent_id='.$parent_result['page_id'],'Back To Listing'); ?> &raquo;  <?php echo $heading_title; ?>
             
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">&nbsp;</div>
      
    </div>
   
     <script type="text/javascript">function serialize_form() { return $('#pagingform').serialize(); } </script> 
      
     <div class="content">
      <?php  echo error_message(); ?>
     
   <?php echo form_open(current_url_query_string());?>  

	<table width="90%"  class="tableList" align="center">
		<tr>
			<th colspan="2" align="center" > </th>
		</tr>
		<tr class="trOdd">
			<td height="26" align="right">Section :</td>
			<td><strong><?php echo $parent_result['page_name'];?></strong></td>
		</tr>
		<?php
		$pre_seo_url  = base_url().$parent_result['friendly_url']."/";

		$default_params = array(
							'heading_element' => array(
													  'field_heading'=>"Page Name",
													  'field_name'=>"page_name",
													  'field_placeholder'=>"Your Page Name",
													  'exparams' => 'size="60"'
													),
							'url_element'  => array(
													  'field_heading'=>"Page URL",
													  'field_name'=>"friendly_url",
													  'field_placeholder'=>"Your Page URL",
													  'exparams' => 'size="30"',
													  'pre_seo_url' => $pre_seo_url,
													  'pre_url_tag'=>TRUE
												   )

						  );
		seo_add_form_element($default_params);
		?>
		
		<tr class="trEven">
			<td width="187" height="26" align="right">Description : </td>
			<td width="648" style="f">
			<textarea name="page_description" rows="5" cols="50" id="page_desc" ><?php echo set_value('page_description');?></textarea>
			<?php
			echo display_ckeditor($ckeditor); ?>
			<?php echo form_error('page_description');?>
			</td>
		</tr>
		<tr class="trEven">
			<td align="left">&nbsp;</td>
			<td align="left">
			<input type="submit" name="sub" value="Add" class="button2" />
			</td>
		</tr>
	</table>
<?php echo form_close(); ?>
  </div>
</div>
<?php $this->load->view('includes/footer'); ?>