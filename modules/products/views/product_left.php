<h2><b>Filter Your Results </b></h2>
<?php
$cat_res = $this->db->select('category_name,friendly_url,category_alt')->get_where('wl_categories',array('parent_id'=>'0','status'=>'1'))->result_array();
if(is_array($cat_res) && !empty($cat_res))
{
?>
<p class="ttu fs14 mt5 b bb2">Categories</p>
<div class="ref_box">
  <div class="filt_bar2">
	<p class="mt20 catlinks">
	  <?php
	  foreach($cat_res as $val)
	  {
	  ?>
		<a href="<?php echo base_url().$val['friendly_url'];?>" title="<?php echo escape_chars($val['category_alt']);?>"><?php echo $val['category_name'];?></a>
	  <?php
	  }
	  ?>
	  <a href="<?php echo base_url();?>category"><b class="i">View All  &raquo;</b></a>
	</p>
  </div>
</div>
<?php
}
?>
<script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>
<?php echo form_open("",'id="myform" method="post" ');?>
<input type="hidden" name="per_page" value="<?php echo $this->input->post('per_page');?>">
<input type="hidden" name="search" value="<?php echo $this->input->get_post('search');?>">
<input type="hidden" name="prange" value="<?php echo $this->input->get_post('prange');?>">
<input type="hidden" name="keyword" value="<?php echo $this->input->get_post('keyword');?>">
<input type="hidden" name="cat_id" value="<?php echo $cat_id;?>">
<input type="hidden" name="offset" id="pg_offset" value="0">
<?php
$attrs = $this->input->get_post('attrs');

$attrs =!is_array($attrs) ? array() : $attrs;

$attr_res = $this->db->query("SELECT attr_name,attr_id FROM wl_attributes as a WHERE a.attr_parent_id='0' AND a.status='1' AND (SELECT count(b.attr_id) as total FROM wl_attributes as b WHERE b.attr_parent_id=a.attr_id AND b.status='1') > 0")->result_array();

if(is_array($attr_res) && !empty($attr_res))
{
  foreach($attr_res as $val1)
  {
	$subattr_res = $this->db->select('attr_name,attr_id')->get_where('wl_attributes',array('attr_parent_id'=>$val1['attr_id'],'status'=>'1'))->result_array();
  ?>
	<p class="ttu fs14 mt25 b bb2"><?php echo $val1['attr_name'];?></p>
	<div class="ref_box">
	  <div class="filt_bar">
		<div class="fs12 gray1">
		  <?php
		  foreach($subattr_res as $val2)
		  {
		  ?>
			<p class="mt3"><label><input name="attrs[]" type="checkbox" value="<?php echo $val2['attr_id'];?>" class="fl mr10 mt2 xfilter"<?php echo in_array($val2['attr_id'],$attrs) ? ' checked="checked"' : '';?>><?php echo $val2['attr_name'];?></label></p>
		  <?php
		  }
		  ?>
		</div>
	  </div>
	</div>
<?php
  }
}
echo form_close();
?>
<script type="text/javascript">
  $('.xfilter').click(function(){
	$(":hidden[name='offset']","#myform").val(0);
	$(":hidden[name='search']","#myform").val('Y');
	$('#myform').attr('action',site_url+'products').submit();
  });
</script>
<?php $this->load->view('banner/left_banner');?>