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
	function get_nested_dropdown_menu($parent,$selectId="",$pad="|__",$category_chain="")
	{
		
		 $ci = CI();
		 $selId =( !is_array( $selectId ) ) ? array() : $selectId;		 
		 $var="";
		 if($parent>0)
		 {
		  $category_chain.="~".$parent;
		 }
		 		 
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
					
					
				    $var .= '<optgroup label="'.$pad.'&nbsp;'.$category_name.'" >'.$category_name; 				  
					$var .= get_nested_dropdown_menu($row['category_id'],$selId,'&nbsp;&nbsp;&nbsp;'.$pad,$category_chain);
					$var .= '</optgroup>'; 
					 
				  }else
				  {	
				  	 $category_chain1 = $category_chain."~".$row['category_id'];
  
					 $category_chain1 = ltrim($category_chain1,"~");
			  
					 $sel=( in_array($row['category_id'],$selId) ) ? "selected='selected'" : "";						 			 
					 $var .= '<option value="'.$row['category_id'].'" '.$sel.' data-category="'.$category_chain1.'">'.$pad.$category_name.'  </option>'; 
				   
				  }     
			   }    
		   }
	 
      return $var;
   } 
   
}

if ( ! function_exists('get_nested_dropdown_menu_shifting'))
{
	function get_nested_dropdown_menu_shifting($parent,$selectId="",$pad="|__")
	{
		
		 $ci = CI();
		 $selId =( $selectId!="" ) ? $selectId : "";		 
		 $var="";		 
		 $sql="SELECT * FROM wl_categories WHERE parent_id=$parent AND status='1' ";		 
		 $query=$ci->db->query($sql);
		 $num_rows     =  $query->num_rows();
		 		  
		  if ($num_rows > 0  )
		  {
			 
		    foreach( $query->result_array() as $row )
		    {
			   $category_name=ucfirst(strtolower($row['category_name']));
			    $sel=( $selectId==$row['category_id'] ) ? "selected='selected'" : "";		
		   
			   if ( has_child($row['category_id']) )
			   {
					
				    $var .= '<option value="'.$row['category_id'].'" '.$sel.'>'.$pad.$category_name; 				  
					$var .= get_nested_dropdown_menu_shifting($row['category_id'],$selId,'&nbsp;&nbsp;&nbsp;'.$pad);
					$var .= '</option>'; 
					 
				  }else
				  {	
					  $condtion_product   =  "AND category_id='".$row['category_id']."'";

					  $count_prod = count_products($condtion_product);
				  				  
					
					if($count_prod > 0)
					{					 			 
					  $var .= '<optgroup label="'.$pad.'&nbsp;'.$category_name.'">'.$pad.$category_name.'  </optgroup>'; 
					}
					else
					{
					  $var .= '<option value="'.$row['category_id'].'" '.$sel.'>'.$pad.$category_name.'  </option>'; 
					}
				   
				  }     
			   }    
		   }
	 
      return $var;
   } 
   
}

if ( ! function_exists('get_nested_dropdown_menu_subadmin'))
{
	function get_nested_dropdown_menu_subadmin($parent,$selectId="",$cond='',$pad="|__")
	{
		
		 $ci = CI();
		 $selId =( $selectId!="" ) ? $selectId : "";		 
		 $var="";		 
		 $sql="SELECT * FROM wl_categories WHERE parent_id=$parent AND status='1' $cond ";		 
		 $query=$ci->db->query($sql);
		 $num_rows     =  $query->num_rows();
		 		  
		  if ($num_rows > 0  )
		  {
			 
		    foreach( $query->result_array() as $row )
		    {
			   $category_name=ucfirst(strtolower($row['category_name']));	
		   
			   if ( has_child($row['category_id']) )
			   {
					
				    $var .= '<optgroup label="'.$pad.'&nbsp;'.$category_name.'" >'.$category_name; 				  
					$var .= get_nested_dropdown_menu_subadmin($row['category_id'],$selId,'','&nbsp;&nbsp;&nbsp;'.$pad);
					$var .= '</optgroup>'; 
					 
				  }else
				  {	
				  				  
					 $sel=( $selectId==$row['category_id'] ) ? "selected='selected'" : "";						 			 
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
		 $condtion = "status ='1' ".$condtion;	 
		 $sql="SELECT COUNT(category_id)  AS total_subcategories FROM wl_categories WHERE $condtion ";		 
		 $query=$ci->db->query($sql)->row_array();
		 return  $query['total_subcategories'];
		 
	}
}


if ( ! function_exists('count_products'))
{
	function count_products($condtion='')
	{		
		 $ci = CI();
		 $sql="SELECT COUNT(products_id)  AS total_product FROM wl_products as a $condtion ";		 
		 $query=$ci->db->query($sql)->row_array();
		 return  $query['total_product'];
		 
	}
}

if ( ! function_exists('category_breadcrumbs'))
{
	function category_breadcrumbs($catid,$segment='',$type='')
	{
		$link_cat=array();	
		$ci = CI();		  
		$sql="SELECT category_name,category_id,parent_id,friendly_url
		FROM wl_categories WHERE category_id='$catid' AND status='1' ";		 
		$query=$ci->db->query($sql);		
		$num_rows     =  $query->num_rows();
		//$segment      = $ci->uri->segment($segment,0);
			 
		  if ($num_rows > 0)
		  {
			 	  
		  
				  foreach( $query->result_array() as $row )
				  {
						
						$link_url = base_url().$type.'/'.$row['friendly_url'];	 
						if ( has_child( $row['parent_id'] ) )
						{
								
								
								
								if( $segment!='' && ( $row['category_id']==$segment ) )
								{
									
									$link_cat[]='<b>&gt;</b>   
			<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong>'.$row['category_name'].'</strong></span></div>';
									
								}else
								{
									
								  $link_cat[]=' <b>&gt;</b>   
			<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><a href="'.$link_url.'">'.$row['category_name'].'</a></span></div>';
								  
								}
								
								$link_cat[] = category_breadcrumbs($row['parent_id'],$segment,$type);
							 
						  }else
						  {	
											  
							$link_cat[]='<b>&gt;</b>   
			<div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><a href="'.$link_url.'">'.$row['category_name'].'</a></span></div>';	
									   
						  }     
					}    
		 }else
		 {
			  $link_url = base_url()."category/".$type;
			  //$link_cat[]='<span class="pr2 fs14">»</span> <a href='.$link_url.'>Category</a>';
			
		 }
		 
		 $link_cat = array_reverse($link_cat);
		 $var=implode($link_cat);
		 return $var;
		
	}
	
}

 if(!function_exists('get_category_root_parent'))
{
	function get_category_root_parent($id_current_category)
	{
		$ci = CI();	
		
		
			$ci->db->select('category_id,parent_id,category_name');
			$catRes = $ci->db->get_where("wl_categories",array('category_id'=>$id_current_category))->row();
			
			if($catRes->parent_id >0)
			{
				return get_category_root_parent($catRes->parent_id);
			}
			else
			{
				return $catRes->category_id;
			}
			
	
		
	}
} 