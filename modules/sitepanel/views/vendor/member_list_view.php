<?php $this->load->view('includes/header'); ?>
<?php
$this->load->helper('products/product');
$member_cat_arr = array();

$root_cat_qry = $this->db->select('category_name,category_id')->get_where('wl_categories',array('parent_id'=>'0','status'=>'1'))->result_array();

if(is_array($root_cat_qry) && !empty($root_cat_qry))
{
  foreach($root_cat_qry as $val)
  {
	$member_cat_arr[$val['category_id']] = $val['category_name'];
  }
}
?>
  <div id="content">
  <div class="breadcrumb">
     <?php echo anchor('sitepanel/dashbord','Home'); ?> &raquo; <?php echo $heading_title;?>        
      </div>
      
      <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">&nbsp;</div>
    </div>
    <div class="content">
    
   
     <div class="required">                        
                <strong> Total Record(s) Found : <?php echo $total_rec; ?></strong>  
         </div>
                  
      <?php   echo form_open("sitepanel/vendors",'id="search_form" method="get" ');    ?>
       <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
   
    <table width="100%"  border="0" cellspacing="3" cellpadding="3">
    <?php 
	 
	
                if(error_message() !=''){
               	   echo error_message();
                }
                ?> 
      <tr>
        <td width="32%" align="right" valign="top" >
          <strong>Search </strong>
          <input name="keyword" type="text" value="<?php echo trim($this->input->get_post('keyword'));?>" size="25" placeholder="name,username,user_no" />&nbsp;</td>
        <td width="42%">
            <select name="status">
            
            <option value="">Status</option>
            <option value="1" <?php echo $this->input->get_post('status')==='1' ? 'selected="selected"' : '';?>>Active</option>
            <option value="0" <?php echo $this->input->get_post('status')==='0' ? 'selected="selected"' : '';?>>In-active</option>
            
            </select>&nbsp;
			<select name="is_verified">
            
            <option value="">Verified?</option>
            <option value="1" <?php echo $this->input->get_post('is_verified')==='1' ? 'selected="selected"' : '';?>>Verified</option>
            <option value="0" <?php echo $this->input->get_post('is_verified')==='0' ? 'selected="selected"' : '';?>>Non-verified</option>
            
            </select>&nbsp;
			<select name="vendor_type">
            
            <option value="">Type</option>
            <option value="1" <?php echo $this->input->get_post('vendor_type')==='1' ? 'selected="selected"' : '';?>>Individual</option>
            <option value="2" <?php echo $this->input->get_post('vendor_type')==='2' ? 'selected="selected"' : '';?>>Corporate</option>
            
            </select>&nbsp;
			<select name="cat_id">
			  <option value="">Select</option>
			  <?php
			  foreach($member_cat_arr as $key=>$val)
			  {
			  ?>
			  <option value="<?php echo $key;?>"<?php echo $this->input->get_post('cat_id')==$key ? ' selected="selected"' : '';?>><?php echo $val;?></option>
			  <?php
			  }
			  ?>
			</select>
        </td>
        
        
        <td width="19%" align="left" ><a  onclick="$('#search_form').submit();" class="button"><span>GO </span></a>&nbsp;
        <?php
            if( $this->input->get_post('keyword')!='' || $this->input->get_post('status')!='' || $this->input->get_post('vendor_type')!='' || $this->input->get_post('cat_id')!='' )
            {             
			   echo anchor("sitepanel/vendors/",'<span>Clear Search</span>');
            }
            ?></td>
	  </tr>
			</table>
        <?php   echo form_close();     ?>
	   <br /><br />
    
	<?php
	if( count($pagelist) > 0 )
    {
      ?>
	  <?php  echo form_open("sitepanel/vendors/",'id="data_form"');?>         
  
	  <table class="list" width="100%" id="my_data">
	  <?php

		  $atts = array(
							'width'      => '650',
							'height'     => '600',
							'scrollbars' => 'yes',
							'status'     => 'yes',
							'resizable'  => 'yes',
							'screenx'    => '0',
							'screeny'    => '0'
						);
	  ?>	
      <thead>
        <tr>
          <td width="31" style="text-align: center;">
          <input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" /></td>
		  <td width="295" class="left">Company Profile</td>
          <td width="295" class="left">Name</td>
          <td width="217" class="left">Username</td>
          <td width="148" class="left">Password</td>
          <td width="174" align="left" >Reg. Date </td>
          <td width="169" class="right">Status</td>
        </tr>
      </thead>
      <tbody>
      <?php
      
      foreach($pagelist as $catKey=>$pageVal)
      {
		  $member_name = trim($pageVal['first_name'].' '.$pageVal['last_name']);

		  $overall_rating = product_overall_rating($pageVal['customers_id'],'customer');
		?>
        <tr>
          <td style="text-align: center;"><input type="checkbox" name="arr_ids[]" value="<?php echo $pageVal['customers_id'];?>" /></td>
		  <td><div><img src="<?php echo get_image('company_logos',$pageVal['company_logo'],'113','60','R'); ?>"  alt="" title="" width="113" height="60"></div>
		  <b><?php echo $pageVal['company_name'];?></b>
		  <p><?php echo rating_html($overall_rating,5);?></p>
		  <?php
		  if($pageVal['short_description']!='')
		  {
		  ?>
			<a href="#"  onclick="$('#dialog_<?php echo $pageVal['customers_id'];?>').dialog({ width: 650 });"><?php echo char_limiter($pageVal['short_description'],100);?></a>
              
		   <div id="dialog_<?php echo $pageVal['customers_id'];?>" title="Description" style="display:none;">
			<b>Short Description</b><br /><?php echo $pageVal['short_description'];?><br /><br />
			<b>Full Description</b><br /><?php echo $pageVal['detail_description'];?>
		   </div>             
		  <?php
		  }
		  ?>
		  </td>
          <td class="left">
            <?php echo $member_name;?><br />
			User No:<?php echo formatCustomValue(array('val'=>$pageVal['user_no']));?> <br />
			Type:<span class="green"><?php echo formatCustomValue(array('val'=>$pageVal['vendor_type'],'ref_arr'=>$this->vendor_type_arr));?></span><br />
			Category:<span class="red"><?php echo formatCustomValue(array('val'=>$pageVal['ref_cat_id'],'ref_arr'=>$member_cat_arr));?></span>            
             <br /> <br />
               <?php echo anchor_popup('sitepanel/vendors/details/'.$pageVal['customers_id'], 'View Details!', $atts);?><br /><br />
				<?php echo anchor('sitepanel/products?vendor_id='.$pageVal['customers_id'], 'Products/Services', array('target'=>'_blank'));?>
			    <?php //echo anchor_popup('sitepanel/members/products_viewed/'.$pageVal['customers_id'], 'Products Viewed [ '.$product_viewed.' ] ', $atts);?>
          </td>
          <td class="left"><?php echo $pageVal['user_name'];?></td>
          <td class="left"><?php echo $this->safe_encrypt->decode($pageVal['password']);?></td>
          <td class="left"><?php echo getDateFormat($pageVal['account_created_date'],7);?></td>
          <td class="right"><?php echo ($pageVal['status']=='1')?"Active":"Inactive";?>
		  <br />
		  <span class="red b"><?php echo ($pageVal['is_verified']=='1')?"Verified":"Non-Verified";?></span>
		  <p><?php echo anchor("sitepanel/vendor_reviews?ref_id=$pageVal[customers_id]",'Reviews','target="_blank"'); ?></p>
        
          </td>
          
        </tr>
        <?php
      }
      ?>
     </tbody>
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
	<table class="list" width="100%"> 
     <tr>
      		<td align="left" style="padding:5px">
			<?php
			if($this->activatePrvg===TRUE)
			{
			?>
			  <input name="status_action" type="submit"  value="Activate" class="button2" id="Activate" onClick="return validcheckstatus('arr_ids[]','Activate','Record','u_status_arr[]');"/>
			<?php
			}
			if($this->deactivatePrvg===TRUE)
			{
			?>
			<input name="status_action" type="submit" class="button2" value="Deactivate" id="Deactivate"  onClick="return validcheckstatus('arr_ids[]','Deactivate','Record','u_status_arr[]');"/>
			<?php
			}
      		?>
            <?php
			if($this->deletePrvg===TRUE)
			{
			?>    
   			<input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onClick="return validcheckstatus('arr_ids[]','delete','Record');"/>
			<?php
			}
			?> 
            
		
            </td>
   		</tr>
      </tbody>
	  </table>
	  <?php echo form_close(); ?>
    <?php
    }
    else{
      echo "<div class='ac b'> No record(s) found !</div>" ;
    }
    ?>
 </div>
</div>
<script type="text/javascript">		
	$('.export').click(function(e){
	  e.preventDefault();
	  lobj = $(this);
	  $('#excel_form').attr('action',lobj.attr('href')).submit();
	  
	});	
</script>
<?php $this->load->view('includes/footer'); ?>