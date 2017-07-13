<?php $this->load->view("top_application");?>
<?php $this->load->view("project_header");?>
<?php
if(is_array($_POST) && !empty($_POST))
{
  //plz change if any other type file column added
  $attachment_length = count($_FILES);
}
else
{
  $attachment_length = 3;
}
$attachment_length = $attachment_length > $max_attachment ? $max_attachment : $attachment_length;

$data['attachment_length'] = $attachment_length;
$data['max_attachment'] = $max_attachment;
//trace($res);
?>
<div class="breadcrumb">
  <div class="wrapper"> You are here :
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo base_url();?>" itemprop="url"><span itemprop="title">Home</span></a></div>
	<b>&gt;</b>
	<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><strong>Request for Quotation</strong></span></div>
  </div>
</div>
<div class="wrapper pt30">
  <h1>Request for Quotation</h1>


  <p class="orange fs16 b mt20 mb5"><b class="gray">Request for :</b> <a href="<?php echo base_url().$res['friendly_url'];?>" class="uu"><?php echo $res['prod_title'];?></a></p>
<p>Type : <b><?php echo get_product_type($res['prod_type']);?></b></p>


  <!--div class="mt15 p25 border1 bg-gray1 bb fs16 weight600"-->
	<?php
	 switch($cat_type)
     {
		case 'common':
		  $this->load->view('quotation_form_common',$data);
		break;
		case 'motor_insurance':
		  $this->load->view('quotation_form_motor_insurance',$data);
		break;
		case 'health_insurance':
		  $this->load->view('quotation_form_health_insurance',$data);
		break;
		case 'banking_finance_insurance':
		  $this->load->view('quotation_form_banking_finance_insurance',$data);
		break;
	 }
	 ?>
  <!--/div-->
  <script type="text/javascript">
	$(document).ready(function(){
	  $('#more_attach').click(function(e){
		e.preventDefault();
		var parent_container = $('#attachment_container');
		var cloneObj = $('.attachment:eq(0)',parent_container).clone();
		cloneObj.find('.error').remove();
		pre_attachment_obj = $('.attachment',parent_container);
		counter_start = pre_attachment_obj.length+1;
		cloneObj.find('.attch_sl').html(counter_start);
		cloneObj.find(':file').attr('name','attachment'+counter_start);
		parent_container.append(cloneObj);
		//alert(attachment_obj.length);
		attachment_obj = $('.attachment',parent_container);
		if(attachment_obj.length >= <?php echo $max_attachment;?>){
		  $(this).addClass('dn');
		}

	  });

	  $('.check1').click(function(){
		$('#form_2').hide(0,function(){$('#form_1').show(0)});
	  });
	  $('.check2').click(function(){
		$('#form_1').hide(0,function(){$('#form_2').show(0)});
	  });
	  <?php
	  if($cat_type=='health_insurance')
	  {
	  ?>
		$('#no_members').change(function(){
		  var loop_val = $(this).val();
		  var tobj = $('.detail_container','.detail-box');
		  var tobj_length = tobj.length;
		  var toggle_obj = 1;
		  if(loop_val==''){
			$('.detail_container:gt(0)','.detail-box').remove();
			var wobj = $('.detail_container:eq(0)','.detail-box');
			$('.required',wobj).remove();
			
			$(':input',wobj).val('');
			$('.detail-box').hide();
		  }
		  if(loop_val==1){
			$('.detail-box').show();
		  }
		  if(tobj_length > loop_val){
			$('.detail_container:gt('+(loop_val-1)+')').remove();
		  }
		  if(tobj_length < loop_val){
			
			
			
			while(tobj_length < loop_val){
			  clone_obj = $('.detail_container:eq(0)','.detail-box').clone();
			
			  $(':input',clone_obj).val('');
			  $('.required',clone_obj).remove();
			  $('.detail-box').append(clone_obj);
			  tobj_length++;
			}
			
			if(toggle_obj){
			  $('.detail-box').show();
			}
		  }
		});
	 <?php
	  }
	  ?>
	});
  </script>

  <!-- left ends -->



  <!-- right ends -->

  <div class="cb"></div>
</div>
<?php $this->load->view("bottom_application");?>