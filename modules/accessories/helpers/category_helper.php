<?php
if ( ! function_exists('has_child'))
{	
	function has_child($catid,$condtion="AND status='1'")
	{
		  $ci = CI();
		  $sql="SELECT category_id FROM wl_categories WHERE parent_id=$catid $condtion ";
		  $query = $ci->db->query($sql);
		  $num_rows     =  $query->num_rows();			  		
		  return $num_rows >= 1 ? TRUE : FALSE;
	}	
}


/*

   Get child records of passed parent id  { default all records } 
      
	$res = get_all_categories();
	$res = get_all_categories(1);
	$res = get_all_categories('','','category_id,parent_id,category_name');	
	Result will give array consisting of parent itself with key parent and child  
	eg:   [1] => Array
         (
            [parent] => Array
                (
                    [category_id] => 1
                    [parent_id] => 0
                    [category_name] => Computers
                )

            [child] => Array
                (
                    [2] => Array
                        (
                            [parent] => Array
                                (
                                    [category_id] => 2
                                    [category_name] => Printers & Scanners
                                    [friendly_url] => printers_scanners
                                )

                            [child] => Array
                                (
                                )

                        )
				)
		)

*/


if ( ! function_exists('get_child_categories'))
{
   function get_child_categories($parent='0',$condtion="AND status='1'", $fields='SQL_CALC_FOUND_ROWS*')
   {
	     $parent = (int) $parent;
	     $ci     = CI();
         $output        = array();
		 $sql           = "SELECT  $fields FROM wl_categories WHERE parent_id=$parent $condtion  ";		 
		 $query         = $ci->db->query($sql);		
         $num_rows      =  $query->num_rows();	
        
        if ( $num_rows > 0) { 
		
            foreach( $query->result_array() as $row )
			{ 
			   
			    $output[$row['category_id']]['parent'] = $row;
				$output[$row['category_id']]['child'] = array();
							  
                if ( has_child($row['category_id'] ))
				{ 
                    $output[$row['category_id']]['child'] = get_child_categories($row['category_id'], $condtion, $fields); 
					
                }
				
            } 
        } 
        
        return $output;
    } 

}

/*
$res = get_parent_categories('6','','category_id,parent_id,category_name');

*/

if ( ! function_exists('get_parent_categories'))
{

   function get_parent_categories($category_id,$condtion="AND status='1'", $fields='*')
   {	 
         $category_id   = (int) $category_id;  
	     $ci            = CI();
         $output        = array();
		 $sql           = "SELECT $fields FROM wl_categories WHERE category_id=$category_id $condtion  ";		 		 
		 $query         = $ci->db->query($sql);		
         $num_rows      =  $query->num_rows();	
		         
        if ( $num_rows > 0)
		{ 
		
		    foreach( $query->result_array() as $row )
			{ 
			     $parent_id =  $row['parent_id'];
			     $output[$row['category_id']] = $row;
				 
				 while( $parent_id>0 )
				 {
					 $sql           = "SELECT $fields FROM wl_categories WHERE category_id=$parent_id $condtion  ";		 		 
					 $query         = $ci->db->query($sql);		
					 $num_rows      =  $query->num_rows();	
							 
					 if ( $num_rows > 0)
					 { 
					
						foreach( $query->result_array() as $row )
						{
							$parent_id = $row['parent_id'];
							$output[$row['category_id']] = $row;
						}
					 }
					 else
					 {
						$parent_id = 0;	 
					 }
				 }
				 
			}
					
		}
		
	    return $output;
	   
   }
   

}


if ( ! function_exists('get_nested_dropdown_menu'))
{
	function get_nested_dropdown_menu($parent,$selectId=array(),$pad="|__")
	{
		
		 $ci = CI();
		 $selId =( !is_array( $selectId ) ) ? array() : $selectId;		 
		 $var="";		 
		 $sql="SELECT * FROM wl_categories WHERE parent_id=$parent AND status='1' ";		 
		 $query=$ci->db->query($sql);
		 $num_rows     =  $query->num_rows();
		 		  
		  if ($num_rows > 0  )
		  {
			 
		    foreach( $query->result_array() as $row )
		    {
			   $category_name=ucfirst(strtolower($row['category_name']));	
		   
			   if ( has_child($row['category_id']) )
			   {
					
				    $var .= '<optgroup label="'.$pad.'&nbsp;'.$category_name.'" >'.$category_name.'</optgroup>'; 				  
					$var .= get_nested_dropdown_menu($row['category_id'],$selId,'&nbsp;&nbsp;&nbsp;'.$pad); 
					 
				  }else
				  {	
				  				  
					 $sel=( in_array($row['category_id'],$selectId) ) ? "selected='selected'" : "";						 			 
					 $var .= '<option value="'.$row['category_id'].'" '.$sel.'>'.$pad.$category_name.'  </option>'; 
				   
				  }     
			   }    
		   }
	 
      return $var;
   } 
   
}


/*

$cond = "AND parent_id =".$pageVal['category_id'];
echo count_category($cond);

*/
				
if ( ! function_exists('count_category'))
{
	function count_category($condtion='')
	{		
		 $ci = CI();
		 $condtion = "status !='2' ".$condtion;	 
		 $sql="SELECT COUNT(category_id)  AS total_subcategories FROM wl_categories WHERE $condtion ";		 
		 $query=$ci->db->query($sql)->row_array();
		 return  $query['total_subcategories'];
		 
	}
}


if ( ! function_exists('count_products'))
{
	function count_products($condtion='')
	{		
		  return 0;
		 $ci = CI();
		 $condtion = "a.status !='2' AND b.status !='2' ".$condtion;	 
		 $sql="SELECT COUNT(a.products_id)  AS total_prducts FROM wl_products as a INNER JOIN wl_customers as b ON b.customers_id=a.added_by INNER JOIN wl_product_category AS c ON a.products_id=c.product_id WHERE  $condtion ";	 
		 $query=$ci->db->query($sql)->row_array();
		 return  !is_array($query) || empty($query) ? 0 : $query['total_prducts'];
		 
	}
}

if ( ! function_exists('category_breadcrumbs'))
{
	function category_breadcrumbs($catid,$segment='')
	{
		$link_cat=array();	
		$ci = CI();

		$category_type = $ci->input->get_post('type');

		if($category_type == '')
		{
		  $product_type = $ci->input->get_post('product_type');

		  if($product_type == 1)
		  {
			$category_type = "buy";
		  }
		  elseif($product_type == 2)
		  {
			$category_type = "sell";
		  }
		  if($product_type == 3)
		  {
			$category_type = "rental";
		  }
		}

		$qstring = $category_type != '' ? "?type=".$category_type : "";
		  
		$sql="SELECT category_name,category_id,parent_id,friendly_url
		FROM wl_categories WHERE category_id='$catid' AND status='1' ";		 
		$query=$ci->db->query($sql);		
		$num_rows     =  $query->num_rows();
		//$segment      = $ci->uri->segment($segment,0);
		 
		if ($num_rows > 0)
		{
			  $cat_section  = 'index';	
			  $product_section  = 'products';			  
				foreach( $query->result_array() as $row )
				{
						   
					  if ( has_child( $row['parent_id'] ) )
					  {
							  
							  /*$condtion_product   =  "AND category_id='".$row['category_id']."'";				
							  $product_count      = count_products($condtion_product);
							  
							  if($product_count>0)
							  {
								  $link_url = base_url()."$product_section/index/".$row['category_id'];
								  
							  }else
							  {							
								  $link_url = base_url()."category/$cat_section/".$row['category_id'];								
							  }*/

							  $link_url = base_url().$row['friendly_url'].$qstring;
							  
							  if( $segment!='' && ( $row['category_id']==$segment ) )
							  {
								  
								  $link_cat[]=''.$row['category_name'];
								  
							  }else
							  {
								  
								$link_cat[]=' <a href='.$link_url.'>'.ucwords($row['category_name']).'</a>';
								
							  }
							  
							  $link_cat[] = category_breadcrumbs($row['parent_id'],$segment);
						   
						}else
						{	
						  $link_url = base_url()."category/index/".$row['category_id'];				  
						  $link_cat[] ='<a href='.$link_url.'>'.ucwords($row['category_name']).'</a>';	
									 
						}     
				  }    
	   }else
	   {
			$cat_section  = '';
			$link_url = base_url()."category".$cat_section;
			//$link_cat[]='<span class="pr2 fs14">»</span> <a href='.$link_url.'>Category</a>';
		  
	   }
	   
	   $link_cat = array_reverse($link_cat);
	   $var=implode($link_cat);
	   return $var;
		
	}
	
}