<?php
if ( ! function_exists('you_save'))
{	
	function you_save($price,$discount_price)
	{  
		
		if($price!='' && $discount_price!='')
		{
			$you_save = (($price-$discount_price)/$price)*100;
			return $you_save;		
		}
		
	}
}

if ( ! function_exists('rating_html'))
{
	function rating_html($rating,$max_rating,$img_arr=array())
	{
	  if(!is_array($img_arr))
	  {
		$img_arr = array();
	  }
	  if(!array_key_exists('glow',$img_arr))
	  {
		$img_arr['glow'] = '<img alt="" src="'.theme_url().'images/sb1.png">';
	  }
	  if(!array_key_exists('fade',$img_arr))
	  {
		$img_arr['fade'] = '<img alt="" src="'.theme_url().'images/sb2.png">';
	  }
	  $rating = ceil($rating);
	  $rating = $rating > $max_rating ? $max_rfating : $rating;
	  $var = "";
	  $nostar = $max_rating - $rating;
	  
	  for($jx=1;$jx<=$rating;$jx++)
	  {
		$var.=$img_arr['glow'];
	  }

	  for($jx=1;$jx<=$nostar;$jx++)
	  {
		$var.=$img_arr['fade'];
	  }

	  return $var;
	}
}

if ( ! function_exists('product_overall_rating'))
{
	function product_overall_rating($product_id,$entity_type)
	{
		$CI = CI();
		$res = $CI->db->query("SELECT AVG(ads_rating) as rating FROM wl_review WHERE entity_id ='".$product_id."' AND entity_type='".$entity_type."' AND status ='1' ")->row();
		return $res->rating;
	}
}

if ( ! function_exists('load_products'))
{	
  function load_products()
  {
	  $ci = CI();

	  $ci->load->model('products/product_model');

	  $ci->page_section_ct = 'product';

	  $fetch_type = "product";

	  $heading_title = 'Product List';

	  $base_url               = $ci->uri->uri_string;

	  $search                 =  $ci->input->get_post('search');

	  if(is_array($ci->meta_info) && array_key_exists('entity_id',$ci->meta_info))
	  {
		$catId = (int) $ci->meta_info['entity_id'];
	  }
	  else
	  {
		$catId = (int) $ci->input->get_post('cat_id');
	  }


	  $record_per_page        = (int) $ci->input->get_post('per_page');
	  
			  
	  $config['per_page']		= ( $record_per_page > 0 ) ? $record_per_page : $ci->config->item('per_page');
	  
	  $offset                 =  (int) $ci->input->get_post('offset');

	  

	  $condtion_array = array(
								'where'=>"a.status ='1' AND e.status ='1'",
								'offset'=>$offset,
								'limit'=>$record_per_page,
								'debug'=>FALSE
							  );

	  $condtion_array['exjoin'] = array();

	  $condtion_array['exjoin'][] = array('tbl'=>'wl_customers as e','condition'=>"e.customers_id=a.mem_id");

	  $loc_country = $ci->session->userdata('loc_country');
	  if($loc_country !='')
	  {
		$condtion_array['where'] .= " AND e.country ='".$loc_country."'";
	  }

	  if(preg_match("~latest-products$~",$base_url))
	  {
		$condtion_array['orderby'] = "date_added DESC";

		$fetch_type = "latest";

		$heading_title = "Latest Products";
	  }
	  elseif($catId > 0)
	  {
		$condtion_array['where'] .= " AND c.category_id='".$catId."'";

		$condtion_array['exjoin'][] = array('tbl'=>'wl_product_category as c','condition'=>"a.products_id=c.ref_product_id");
	  
		if($search == '')
		{	
		  $heading_title = get_db_field_value('wl_categories','category_name',"WHERE category_id='$catId'");

		  $fetch_type = "category";

		  
		}
	  }

	  $data['cat_id'] = $catId;

	  if(preg_match('~(('.$ci->config->item('individual_url_prefix').'|'.$ci->config->item('corporate_url_prefix').')/?)~',$base_url,$matches))
	  {
		$data['cat_type'] = $matches[2];

		if($matches[2] == $ci->config->item('individual_url_prefix'))
		{
		  $condtion_array['where']        .= " AND (prod_for ='3' OR prod_for ='1') ";
		}
		else
		{
		  $condtion_array['where']        .= " AND (prod_for ='3' OR prod_for ='2') ";
		}
	  }
	  else
	  {
		//$condtion_array['where']        .= " AND (prod_for ='3' OR prod_for ='1') ";
		$data['cat_type'] =  $ci->config->item('individual_url_prefix');
	  }
	  

	  $prange                 =  $ci->input->get_post('prange',TRUE);

	  if($search !='')
	  {	
		$fetch_type = "search";

		$heading_title = "Search Result";

		$keyword			=   trim($ci->input->get_post('srch_keyword',TRUE));
						
		$keyword			=   $ci->db->escape_str($keyword);

		if($keyword!='')
		{
						
			  $condtion_array['where']        .= " AND (prod_title LIKE '%".$keyword."%' )";
		}
	  }

	  $res_array              =  $ci->product_model->get_products($condtion_array);
					
	  $config['total_rows']	=  get_found_rows();

	 //$data['page_links']     = front_pagination("$base_url",$config['total_rows'],$config['per_page'],$offset);

	  $data['heading_title'] = $heading_title;

	  $data['res'] = $res_array; 

	  $data['total_records'] = $config['total_rows'];

	  $data['base_url'] = $base_url;

	  $data['fetch_type'] = $fetch_type;	
	
	  
	  $ajx_req = $ci->input->is_ajax_request();
	  if($ajx_req !='')
	  {
		$ci->load->view('products/load_products',$data);
	  }
	  else
	  {
		$ci->load->view('products/view_products',$data);
	  }
  }
}

if ( ! function_exists('get_product_type'))
{
  function get_product_type($val)
  {
	switch($val)
	{
	  case '1':
		$var = "Product";
	  break;
	  case '2':
		$var = "Service";
	  break;
	  default:
		$var = " - ";
	}
	return $var;
  }
}

if ( ! function_exists('get_product_for'))
{
  function get_product_for($val)
  {
	switch($val)
	{
	  case '1':
		$var = "Individual";
	  break;
	  case '2':
		$var = "Corporate/SME";
	  break;
	  case '3':
		$var = "Both";
	  break;
	  default:
		$var = " - ";
	}
	return $var;
  }
}

function update_prod_url()
{
  $ci = CI();

  $prod_res = $ci->db->select('products_id,product_name,product_code,product_alt,product_friendly_url,products_description')->get_where('wl_products',array('status !='=>'2'))->result_array();

  if(is_array($prod_res ) && !empty($prod_res ))
  {
	foreach($prod_res as $val)
	{
	  $productId = $val['products_id'];

	  $product_alt = $val['product_alt']=='' ? $val['product_name'] : $val['product_alt'];

	  $product_alt = $ci->db->escape_str($product_alt);

	  $pre_friendly_url = seo_url_title($val['product_name']);

	  $friendly_url = $pre_friendly_url;

	  $meta_res = $ci->db->select('meta_id')->get_where('wl_meta_tags',array('entity_type'=>'products/detail/'.$productId,'entity_id'=>$productId))->row();

	  if(!is_object($meta_res))
	  {
		$unique_url = FALSE;

		$ic = 1;

		while(!$unique_url)
		{
		  
		  $meta_qry  = $ci->db->select('meta_id')->from('wl_meta_tags')->where(array('page_url'=>$friendly_url))->get();

		  if(!$meta_qry->num_rows())
		  {
			$unique_url = TRUE;
		  }
		  else
		  {
			$friendly_url = $pre_friendly_url."-".$ic;
			$ic++;
		  }
		  

		}

		if($unique_url===TRUE)
		{
			$meta_array  = array(
								'entity_type'=>'products/detail/'.$productId,
								'entity_id'=>$productId,
								'page_url'=>$friendly_url,
								'meta_title'=>get_text($val['product_name'],80),
								'meta_description'=>get_text($val['products_description']),
								'meta_keyword'=>get_keywords($val['products_description'])
								);

			trace($meta_array);


			create_meta($meta_array);

			//echo "UPDATE wl_products SET product_friendly_url='".$friendly_url."' WHERE products_id='".$productId."'";

			$ci->db->query("UPDATE wl_products SET product_friendly_url='".$friendly_url."',product_alt='".$product_alt."' WHERE products_id='".$productId."'");

			$ci->db->query("UPDATE wl_mirror_products SET product_friendly_url='".$friendly_url."',product_alt='".$product_alt."' WHERE ref_product_id='".$productId."'");
		}
	  }
	}
  }
}

function update_cat_url()
{
  $ci = CI();

  $prod_res = $ci->db->select('category_id, 	category_name,category_alt,friendly_url,category_description')->get_where('wl_categories',array('status !='=>'2'))->result_array();

  if(is_array($prod_res ) && !empty($prod_res ))
  {
	foreach($prod_res as $val)
	{
	  $category_id = $val['category_id'];

	  $category_alt = $val['category_alt']=='' ? $val['category_name'] : $val['category_alt'];

	  $category_alt = $ci->db->escape_str($category_alt);

	  $pre_friendly_url = seo_url_title($val['category_name']);

	  $friendly_url = $pre_friendly_url;

	  $meta_res = $ci->db->select('meta_id')->get_where('wl_meta_tags',array('entity_type'=>'category/index/'.$category_id,'entity_id'=>$category_id))->row();

	  if(!is_object($meta_res))
	  {
		$unique_url = FALSE;

		$ic = 1;

		while(!$unique_url)
		{
		  
		  $meta_qry  = $ci->db->select('meta_id')->from('wl_meta_tags')->where(array('page_url'=>$friendly_url))->get();

		  if(!$meta_qry->num_rows())
		  {
			$unique_url = TRUE;
		  }
		  else
		  {
			$friendly_url = $pre_friendly_url."-".$ic;
			$ic++;
		  }
		  

		}

		if($unique_url===TRUE)
		{
			$meta_array  = array(
								'entity_type'=>'category/index/'.$category_id,
								'entity_id'=>$category_id,
								'page_url'=>$friendly_url,
								'meta_title'=>get_text($val['category_name'],80),
								'meta_description'=>get_text($val['category_description']),
								'meta_keyword'=>get_keywords($val['category_description'])
								);

			trace($meta_array);


			create_meta($meta_array);

			//echo "UPDATE wl_products SET product_friendly_url='".$friendly_url."' WHERE products_id='".$productId."'";

			$ci->db->query("UPDATE wl_categories SET friendly_url='".$friendly_url."',category_alt='".$category_alt."' WHERE category_id='".$category_id."'");

			
		}
	  }
	}
  }
}