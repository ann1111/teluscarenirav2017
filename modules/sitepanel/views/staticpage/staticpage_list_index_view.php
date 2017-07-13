<?php $this->load->view('includes/header'); ?>
<?php $parent_id = $this->input->get_post('parent_id');?>  
<div id="content">
  <div class="breadcrumb">
       <?php echo anchor('sitepanel/dashbord','Home'); ?>
		<?php
		if(is_array($parent_result) && !empty($parent_result))
		{
			echo '&raquo; ';
			echo anchor('sitepanel/staticpages','Static Pages');
			echo '&raquo; '.$parent_result['page_name'];
		}
		else
		{
		  echo '&raquo; Static Pages';
		}
        ?>
      </div>
      
      <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
	  <?php
	  if($parent_id > 0)
	  {
	  ?>
		<div class="buttons"> <?php echo anchor("sitepanel/staticpages/add/".$parent_id,'<span>Add Pages</span>','class="button" ' );?> </div>
	  <?php
	  }
	  ?>
    </div>
    <div class="content">
    
      <script type="text/javascript">function serialize_form() { return $('#pagingform').serialize(); } </script> 
      
       <?php  echo error_message(); ?>
		
        
        <?php echo form_open("sitepanel/staticpages/",'id="search_form" method="get" '); ?>
        
		<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
		  
          <tr>
			<td align="center" >Search [ page name ] 
            
				<input type="text" name="keyword" value="<?php echo $this->input->get_post('keyword');?>"  />&nbsp;

				<input type="hidden" name="parent_id" value="<?php echo $parent_id;?>"  />&nbsp;
                
				<a  onclick="$('#search_form').submit();" class="button"><span> GO </span></a>
                
			
				<?php 
				if($this->input->get_post('keyword')!='')
				{ 
				  echo anchor("sitepanel/staticpages?parent_id=".$parent_id,'<span>Clear Search</span>');
				} 
				?>
			</td>
		</tr>     
        <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
           
		</table>
		<?php echo form_close();?>
        
   
            
   <?php
   
    if( is_array($pagelist) && !empty($pagelist) )
	{
    echo form_open("sitepanel/staticpages/",'id="data_form" ');?>
   
  
      <table class="list" width="100%" id="my_data">
      
          <thead>
            <tr>
              <td width="1" style="text-align: center;">
			  <?php
			  if($parent_id > 0)
			  {
			  ?>
				<input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" />
			  <?php
			  }
			  else
			  {
			  ?>
			  Sl.
			  <?php
			  }
			  ?>
			  </td>
              <td class="left">Page Name
                </td>
              <td class="right">Details</td>
              <td class="left">Status </td>
              <td class="right">Action</td>
            </tr>
          </thead>
          <tbody>
          
           
          <?php
			$i = $offset;
		  	foreach($pagelist as $val)
			{ 
			  $i++;
          ?>
            <tr>
              <td style="text-align: center;">
			  <?php
			  if($parent_id > 0)
			  {
			  ?>
			    <input type="hidden" name="friendly_url_<?php echo $val['page_id'];?>" value="<?php echo $val['friendly_url'];?>" />
				<input type="checkbox" name="arr_ids[]" value="<?php echo  $val['page_id'];?>" />
			  <?php
			  }
			  else
			  {
				echo $i;
			  }
			  ?>
			  </td>
              
              <td class="left">
				<?php 
				if($val['is_nested'] == 'Y')
				{
				  echo anchor("sitepanel/staticpages?parent_id=$val[page_id]",$val['page_name']);
				}
				else
				{
				  echo $val['page_name'];
				}
				?></td>    
              
            
              <td class="right"><a href="#"  onclick="$('#dialog_<?php echo $val['page_id'];?>').dialog({ width: 650 });">view</a>
              
			  <div id="dialog_<?php echo $val['page_id'];?>" title="Description" style="display:none;">
			    <?php echo $val['page_description'];?>
               </div>             
              </td>
              <td class="left"><?php echo ($val['status']==1)? "Active":"In-active";?></td>
              <td class="right">    
			  <?php
			  if($val['is_nested'] == 'Y')
			  {
				echo '[ '.anchor("sitepanel/staticpages/add/$val[page_id]/",'Add').' ]';
			  }
			  if($this->editPrvg===TRUE)
			  {
			  ?>
				  [ <?php echo anchor("sitepanel/staticpages/edit/$val[page_id]/".query_string(),'Edit'); ?> ]
			  <?php
			  }
			  ?>
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
		if($parent_id > 0)
		{
		?>
		  <table class="list" width="100%">
		  <tr>
			<td align="left" style="padding:2px" height="35">
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
			  if($this->deletePrvg===TRUE)
			  {
			  ?>
				<input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onClick="return validcheckstatus('arr_ids[]','delete','Record');"/>
			  <?php
			  }
			  ?>
			  <input type="hidden" name="parent_id" value="<?php echo $parent_id;?>"  />
			</td>
		  </tr>
		  </table>
		<?php
		}
		?>
			
    <?php echo form_close();
	 }else{
	    echo "<center><strong> No record(s) found !</strong></center>" ;
	 }
	?> 
  </div>
</div>
<?php $this->load->view('includes/footer'); ?>