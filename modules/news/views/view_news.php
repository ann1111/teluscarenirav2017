<?php $this->load->view('top_application'); ?>
<?php $this->load->view('project_header'); ?>
<!--body-->
<div class="container">
  <p class="breadcrumb"><a href="<?php echo base_url();?>"><img src="<?php echo theme_url();?>images/tree-home.png" alt="" class="vat"></a> News &amp; Events</p>

  <div class="p10">
	<script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>

	<?php echo form_open("",'id="myform" method="post" ');?>
	<input type="hidden" name="per_page" value="<?php echo $this->input->post('per_page');?>">
	<input type="hidden" name="offset" id="pg_offset" value="0">
	<?php echo form_close();?>

	<div class="bg-line mb15">
	  <div class="bg-heading"><h1>News &amp; Events</h1></div>
	  <p class="cb"></p>
	</div>

	<div id="my_data">
	  <?php
	  if(is_array($res) && !empty($res))
	  {
	  ?>
		<div class="fs11 mt10 p5 radius-5 shadow">
		  <?php echo $page_links;?>
		  <p class="fr">Show Results :
			<?php echo front_record_per_page('per_page1'); ?>
		  </p>
		  <p class="cb"></p>
		</div>
		<?php
		foreach($res as $val)
		{
		?>
		<div class="p10 bb">
		  <div class="fr w92 mb10 pr10">
			<p class="yel fs17"><a href="<?php echo base_url().$val['friendly_url'];?>" title="<?php echo escape_chars($val['news_title']);?>" alt="<?php echo escape_chars($val['news_title']);?>"><?php echo $val['news_title'];?></a></p>
			<div class="lh18px fs13"><?php echo char_limiter($val['news_description'],550);?></div>
			<p class="fr uu yel mt5"><a href="<?php echo base_url().$val['friendly_url'];?>">View Details</a></p>
			<p class="mt5">( <?php echo date("F d, Y",strtotime($val['recv_date']));?> )</p>    
		  </div>
		  <img src="<?php echo theme_url();?>images/col.jpg" alt="" class="mt10">
		  <p class="cb"></p>
		</div>
		<?php
		}
		?>


		<div class="fs11 mt10 p5 radius-5 shadow">
		  <?php echo $page_links;?>
		  <p class="fr">Show Results :
			<?php echo front_record_per_page('per_page2'); ?>
		  </p>
		  <p class="cb"></p>
		</div>
	  <?php
	  }
	  else
	  {
		echo '<p class="ac b">'.$this->config->item('no_record_found').'</p>';
	  }
	  ?>
	</div>
  </div>

</div>
<script>
jQuery(document).ready(function(e) {
  jQuery('[id ^="per_page"]').live('change',function(){	
		per_page_val = jQuery(this).val();	
		$("[id ^='per_page'] option[value=" + per_page_val + "]").attr('selected', 'selected');
		$(":hidden[name='per_page']","#myform").val(per_page_val);
		jQuery('#myform').submit();
	});	
});
</script>
<!--body end-->

<?php $this->load->view("bottom_application");?>