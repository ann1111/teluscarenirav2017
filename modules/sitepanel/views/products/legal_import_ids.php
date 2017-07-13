<?php $this->load->view('includes/face_header'); ?>
<table width="100%" border="0" cellspacing="4" cellpadding="0" class="grey">
<tr>
  <td>
  <?php
  $final_cat_res = $this->db->query("SELECT category_name,category_id FROM wl_categories as a WHERE a.status!='2' AND (SELECT count(*) FROM wl_categories as b WHERE b.parent_id=a.category_id AND b.status!='2')=0")->result_array();

  if(is_array($final_cat_res) && !empty($final_cat_res))
  {
	echo '<table width="100%" border="1"><tr><th>Category</th><th>Category Id</th></tr>';
	foreach($final_cat_res as $val1)
	{
	  echo '<tr><td width="50%">';
	  $loop_cats = get_parent_categories($val1['category_id'],"AND status='1'","category_id,parent_id,category_name");
	  
	  $loop_cats = array_reverse($loop_cats);
	  $sptr = "";
	  foreach($loop_cats as $val2)
	  {
		echo $sptr.$val2['category_name'];
		$sptr = " &raquo; ";
	  }
	  echo '</td><td align="center" valign="top">'.$val1['category_id'];
	  echo '</td></tr>';
	}
	echo '</table>';
  }
  $final_attr_res = $this->db->query("SELECT attr_name,attr_id,attr_parent_id FROM wl_attributes as a WHERE a.status!='2' AND (SELECT count(*) FROM wl_attributes as b WHERE b.attr_parent_id=a.attr_id AND b.status!='2')=0")->result_array();

  if(is_array($final_attr_res) && !empty($final_attr_res))
  {
	echo '<table width="100%" border="1"><tr><th>Attributes</th><th>Attribute Id</th></tr>';
	foreach($final_attr_res as $val1)
	{
	  $loop_attr = "";
	  if($val1['attr_parent_id'] > 0)
	  {
		$parent_attr_res = $this->db->select('attr_name')->get_where('wl_attributes',array('attr_id'=>$val1['attr_parent_id']))->row();

		if(is_object($parent_attr_res))
		{
		  $loop_attr .= $parent_attr_res->attr_name." &raquo; ";
		}
	  }
	  $loop_attr .= $val1['attr_name'];
	  echo '<tr><td width="50%">'.$loop_attr.'</td><td align="center" valign="top">'.$val1['attr_id'];
	  echo '</td></tr>';
	}
	echo '</table>';
  }
  $final_acc_res = $this->db->query("SELECT acc_name,acc_id FROM wl_accessories as a WHERE a.status!='2'")->result_array();

  if(is_array($final_acc_res) && !empty($final_acc_res))
  {
	echo '<table width="100%" border="1"><tr><th>Accessories</th><th>Accessory Id</th></tr>';
	foreach($final_acc_res as $val1)
	{
	  echo '<tr><td width="50%">'.$val1['acc_name'].'</td><td align="center" valign="top">'.$val1['acc_id'];
	  echo '</td></tr>';
	}
	echo '</table>';
  }
  ?>
  </td>                
</tr>
</table>
</body>
</html>