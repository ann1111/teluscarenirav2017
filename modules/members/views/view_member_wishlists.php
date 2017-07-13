<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<div class="tree minmax">
  <div class="wrapper"> YOUR ARE HERE : 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title"><img src="<?php echo theme_url();?>images/hm.png" class="vam pb3" alt=""></span></a></div>   
	<b>&gt;</b> 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>members" itemprop="url"><span itemprop="title">My Account</span></a></div>   
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong>My Favorites</strong></span></div>
  </div>
</div>
<!-- MIDDLE STARTS -->
<section class="minmax mid_shed">
  <script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>

  <?php echo form_open("",'id="myform" method="post" ');?>
  <input type="hidden" name="per_page" value="<?php echo $this->input->post('per_page');?>">
  <input type="hidden" name="offset" id="pg_offset" value="0">
  <?php echo form_close();?>
  <div class="wrapper pt20"> <br>

	<h1 class="mb5">My <b>Favorites</b></h1>
	<?php $this->load->view('members/top_links');?>
	<div class="cb"></div>
	<div class="mt2">
	  <div>
		<div class="p1 pt2 bg-white">
		  <?php $this->load->view('members/subtop');?>
		  <!-- left ends -->
		  <?php error_message();?>  
		  <div class="auto w80 mt30" id="my_data">
		  <?php
		  if(is_array($res) && !empty($res))
		  {
			$data['res'] = $res;
			$data['offset'] = $offset;
			$data['page_links'] = $page_links;
			$this->load->view('members/load_wishlist',$data);
		  }
		  else
		  {
			echo '<p class="fl b">'.$this->config->item('no_record_found').'</p>';	
		  }
		  ?>
		  </div>
		</div>
	  </div>
	</div>
	<div class="cb"></div>
  <br>
  <br>
  </div>
  <script type="text/javascript">
  jQuery(document).ready(function(e) {
	jQuery('[id ^="per_page"]').live('change',function(){	
		  per_page_val = jQuery(this).val();	
		  $("[id ^='per_page'] option[value=" + per_page_val + "]").attr('selected', 'selected');
		  $(":hidden[name='per_page']","#myform").val(per_page_val);
		  $("#pg_offset","#myform").val(0);
		  jQuery('#myform').submit();
	  });	
  });
  </script>
</section>
<?php $this->load->view("bottom_application");?>