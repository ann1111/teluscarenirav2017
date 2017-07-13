<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
$curr_symbol = display_symbol();
?>
<div class="tree minmax">
  <div class="wrapper"> YOUR ARE HERE : 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title"><img src="<?php echo theme_url();?>images/hm.png" class="vam pb3" alt=""></span></a></div>   
	<b>&gt;</b> 
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?php echo base_url();?>members" itemprop="url"><span itemprop="title">My Account</span></a></div>   
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong>My Orders</strong></span></div>
  </div>
</div>
<!-- MIDDLE STARTS -->
<section class="minmax mid_shed">
  <script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>

  <?php echo form_open("",'id="myform" method="post" ');?>
  <input type="hidden" name="keyword" value="<?php echo $this->input->post('keyword');?>" />
<input type="hidden" name="from_date" value="<?php echo $this->input->post('from_date');?>" />
<input type="hidden" name="to_date" value="<?php echo $this->input->post('to_date');?>" />
  <input type="hidden" name="per_page" value="<?php echo $this->input->post('per_page');?>">
  <input type="hidden" name="offset" id="pg_offset" value="0">
  <?php echo form_close();?>
  <div class="wrapper pt20"> <br>

	<h1 class="mb5">My <b>Orders</b></h1>
	<?php $this->load->view('members/top_links');?>
	<div class="cb"></div>
	<div class="mt2">
	  <div>
		<div class="p1 pt2 bg-white">
		  <?php $this->load->view('members/subtop');?>
		  <!-- left ends -->
		  <?php error_message();?>  
		  <div class="auto w80 mt30">
			<div class="bg-gray border1 p10 pl15">
			  <p class="fl">
				<input name="keyword" type="text" class="p3 pl7" style="width:238px" placeholder="Order/Invoice No." value="<?php echo $this->input->post('keyword');?>">
			  </p>
			  <p class="fl ml10">
				<input name="from_date" type="text" class="p3 vam start_date1" style="width:238px" value="<?php echo $this->input->post('from_date');?>" placeholder="From">
				<img src="<?php echo theme_url();?>images/calendar.png" class="vam ml3 start_date" alt="">
			  </p>
			  <p class="fl ml10">
				<input name="to_date" type="text" class="p3 vam end_date1" style="width:238px" placeholder="To" value="<?php echo $this->input->post('to_date');?>">
				<img src="<?php echo theme_url();?>images/calendar.png" class="vam ml3 end_date" alt="">
			  </p>
			  <p class="fl ml10">
				<input name="input" type="button" class="btn1 btn_sbt2" value="Search">
			  </p>
			  <div class="cb"></div>
			</div>
			<div id="my_data" class="delegate_data">
			  <?php
			  if(is_array($res) && !empty($res))
			  {
				$data['res'] = $res;
				$data['offset'] = $offset;
				$data['page_links'] = $page_links;
				$this->load->view('members/load_orders',$data);
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
	</div>
	<div class="cb"></div>

	<br>
	<br>
  </div>
</section>
<script type="text/javascript" src="<?php echo base_url();?>assets/developers/js/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="<?php echo base_url();?>assets/developers/js/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<?php 
$default_date = '2014-10-01';
$posted_start_date = $this->input->post('from_date');
?>
<script type="text/javascript">
  $(document).ready(function(){
	$('[id ^="per_page"]').live('change',function(){	
		$(':hidden[name="per_page"]','#myform').val($(this).val());	
		$("#pg_offset","#myform").val(0);
		$('#myform').submit();
	});	
	$('.btn_sbt2').live('click',function(e){
		e.preventDefault();
		$start_date = $('.start_date1:eq(0)').val();
		$end_date = $('.end_date1:eq(0)').val();
		$start_date = $start_date=='From' ? '' : $start_date;
		$end_date = $end_date=='To' ? '' : $end_date;
		$(':hidden[name="keyword"]','#myform').val($('input[type="text"][name="keyword"]').val());
		$(':hidden[name="from_date"]','#myform').val($start_date);
		$(':hidden[name="to_date"]','#myform').val($end_date);
		$("#myform").submit();
	});
	$('.start_date,.end_date').live('click',function(e){
	  e.preventDefault();
	  cls = $(this).hasClass('start_date') ? 'start_date1' : 'end_date1';
	  $('.'+cls+':eq(0)').focus();
	});
	$( ".start_date1").live('focus',function(){
			$(this).datepicker({
			showOn: "focus",
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			defaultDate: 'y',
			buttonText:'',
			minDate:'<?php echo $default_date;?>' ,
			maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
			yearRange: "c-100:c+100",
			buttonImageOnly: true,
			onSelect: function(dateText, inst) {
						  $('.start_date1').val(dateText);
						  $( ".end_date1").datepicker("option",{
							minDate:dateText ,
							maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
						});

					  }
		});
	});
	$( ".end_date1").live('focus',function(){
			$(this).datepicker({
					  showOn: "focus",
					  dateFormat: 'yy-mm-dd',
					  changeMonth: true,
					  changeYear: true,
					  defaultDate: 'y',
					  buttonText:'',
					  minDate:'<?php echo $posted_start_date!='' ? $posted_start_date :  $default_date;?>' ,
					  maxDate:'<?php echo date('Y-m-d',strtotime(date('Y-m-d',time())."+180 days"));?>',
					  yearRange: "c-100:c+100",
					  buttonImageOnly: true,
					  onSelect: function(dateText, inst) {
						$('.end_date1').val(dateText);
					  }
				  });
	  });
	  
  });
</script>
<?php $this->load->view("bottom_application");?>