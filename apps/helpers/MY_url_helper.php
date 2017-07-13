<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Philip Sturgeon
 */

// ------------------------------------------------------------------------

/**
 * Create URL Title - modified version
 *
 * Takes a "title" string as input and creates a
 * human-friendly URL string with either a dash
 * or an underscore as the word separator.
 * 
 * Added support for Cyrillic characters.
 *
 * @access	public
 * @param	string	the string
 * @param	string	the separator: dash, or underscore
 * @return	string
 */
if ( ! function_exists('url_title'))
{
	function url_title($str, $separator = 'dash', $lowercase = TRUE)
    {
        $CI =& get_instance();
        
        $foreign_characters = array(
            '/ä|æ|ǽ/' => 'ae',
            '/ö|œ/' => 'oe',
            '/ü/' => 'ue',
            '/Ä/' => 'Ae',
            '/Ü/' => 'Ue',
            '/Ö/' => 'Oe',
            '/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|А/' => 'A',
            '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|а/' => 'a',
            '/Б/' => 'B',
            '/б/' => 'b',
            '/Ç|Ć|Ĉ|Ċ|Č|Ц/' => 'C',
            '/ç|ć|ĉ|ċ|č|ц/' => 'c',
            '/Ð|Ď|Đ|Д/' => 'D',
            '/ð|ď|đ|д/' => 'd',
            '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Е|Ё|Э/' => 'E',
            '/è|é|ê|ë|ē|ĕ|ė|ę|ě|е|ё|э/' => 'e',
            '/Ф/' => 'F',
            '/ф/' => 'f',
            '/Ĝ|Ğ|Ġ|Ģ|Г/' => 'G',
            '/ĝ|ğ|ġ|ģ|г/' => 'g',
            '/Ĥ|Ħ|Х/' => 'H',
            '/ĥ|ħ|х/' => 'h',
            '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|И/' => 'I',
            '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|и/' => 'i',
            '/Ĵ|Й/' => 'J',
            '/ĵ|й/' => 'j',
            '/Ķ|К/' => 'K',
            '/ķ|к/' => 'k',
            '/Ĺ|Ļ|Ľ|Ŀ|Ł|Л/' => 'L',
            '/ĺ|ļ|ľ|ŀ|ł|л/' => 'l',
            '/М/' => 'M',
            '/м/' => 'm',
            '/Ñ|Ń|Ņ|Ň|Н/' => 'N',
            '/ñ|ń|ņ|ň|ŉ|н/' => 'n',
            '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|О/' => 'O',
            '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|о/' => 'o',
            '/П/' => 'P',
            '/п/' => 'p',
            '/Ŕ|Ŗ|Ř|Р/' => 'R',
            '/ŕ|ŗ|ř|р/' => 'r',
            '/Ś|Ŝ|Ş|Š|С/' => 'S',
            '/ś|ŝ|ş|š|ſ|с/' => 's',
            '/Ţ|Ť|Ŧ|Т/' => 'T',
            '/ţ|ť|ŧ|т/' => 't',
            '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|У/' => 'U',
            '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|у/' => 'u',
            '/В/' => 'V',
            '/в/' => 'v',
            '/Ý|Ÿ|Ŷ|Ы/' => 'Y',
            '/ý|ÿ|ŷ|ы/' => 'y',
            '/Ŵ/' => 'W',
            '/ŵ/' => 'w',
            '/Ź|Ż|Ž|З/' => 'Z',
            '/ź|ż|ž|з/' => 'z',
            '/Æ|Ǽ/' => 'AE',
            '/ß/'=> 'ss',
            '/Ĳ/' => 'IJ',
            '/ĳ/' => 'ij',
            '/Œ/' => 'OE',
            '/ƒ/' => 'f',
            '/Ч/' => 'Ch',
            '/ч/' => 'ch',
            '/Ю/' => 'Ju',
            '/ю/' => 'ju',
            '/Я/' => 'Ja',
            '/я/' => 'ja',
            '/Ш/' => 'Sh',
            '/ш/' => 'sh',
            '/Щ/' => 'Shch',
            '/щ/' => 'shch',
            '/Ж/' => 'Zh',
            '/ж/' => 'zh',
        );

        $str = preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $str);
        
        $replace = ($separator == 'dash') ? '-' : '_';
        
        $trans = array(
            '&\#\d+?;'                => '',
            '&\S+?;'                => '',
            '\s+'                    => $replace,
            '[^a-z0-9\-\._]' => '',
            $replace.'+'            => $replace,
            $replace.'$'            => $replace,
            '^'.$replace            => $replace,
            '\.+$'                    => ''
        );

        $str = strip_tags($str);

        foreach ($trans as $key => $val)
        {
            $str = preg_replace("#".$key."#i", $val, $str);
        }
        
        if ($lowercase === TRUE)
        {
            if( function_exists('mb_convert_case') )
            {
                $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
            }
            else
            {
                $str = strtolower($str);
            }
        }

        $str = preg_replace('#[^'.$CI->config->item('permitted_uri_chars').']#i', '', $str);        
        return trim(stripslashes($str));
     }
}


 function switch_account($type)
 {
		switch ($type )
		{
		    case 1: 
			
		      redirect('members', '');
			  
			break;
			
			default:
			
            redirect('members', '');
			
		}
			  
 }	


// ------------------------------------------------------------------------


/**
 * Theme URL
 *
 * Returns the Ionize current theme URL
 *
 * @access	public
 * @return	string
 */
 
if ( ! function_exists('resource_url'))
{
	function resource_url()
	{
		return base_url()."assets/designer/resources/";
	}
}
 
if ( ! function_exists('theme_url'))
{
	function theme_url()
	{
		return base_url()."assets/designer/themes/default/";
	}
}

if ( ! function_exists('img_url'))
{
	function img_url()
	{
		return base_url()."uploaded_files/";
	}
}

if ( ! function_exists('thumb_cache_url'))
{
	function thumb_cache_url()
	{
		return base_url()."uploaded_files/thumb_cache/";
	}
	
}

if ( ! function_exists('clear_search'))
{
  function clear_search ()
  {
	  
	   $ci            =  &get_instance(); 
	   $pagesz        = $ci->config->item('per_page');
	   $clear_search  = $ci->input->get();
	   $clear_search  = @array_filter( $clear_search);
	   $clear_search  = @array_filter( $clear_search);	
	   
	   if( is_array($clear_search) && array_key_exists('city',$clear_search) && ($clear_search['city']=='Search City'))
	   {
		   unset($clear_search['city']);
	   }
	   
		if( is_array($clear_search) && array_key_exists('plan',$clear_search) && ($clear_search['plan']=='all'))
	   {
		   unset($clear_search['plan']);
	   }
	   
	   if( is_array($clear_search) && array_key_exists('pagesize',$clear_search) && ($clear_search['pagesize']==$pagesz))
	   {
		   unset($clear_search['pagesize']);
	   }
	   
		unset($clear_search['search_x']);
		unset($clear_search['search_y']);
		unset($clear_search['input_x']);
		unset($clear_search['input_y']);
	   
	   
	   
	  ?>
	
					  <?php if(is_array( $clear_search) && !empty(  $clear_search)) 
					  {
						  ?>
						
						  <div class="paging_cntnr mt10" style="width:650px; margin-bottom:5px;">
							  <table width="80%" border="0" cellspacing="0" cellpadding="0">
							 <tr>
							 <td  class="tahoma b ft-10 black"> Clear Search : <td>
							 <td> 
						  <?php 
						  foreach( $clear_search as $k=>$v)
						  {
							  if(trim($k)!='')
							  {
							  ?>
							  
							<p class="fl ml30">                 
							<?php echo ucfirst($k);?>  <a href="<?php echo query_string('',array($v=>$k));?>"><img src="<?php echo base_url()?>assets/clear_search.jpg" class="v-mid mb2"  /></a> </p>                    
						
						
						<?php
							  }							
						  }
					   ?>
					   <p class="fl ml40">All <a href="<?php echo current_url();?>"><img src="<?php echo base_url()?>assets/clear_search.jpg"  /></a>  </p>
					   <?php
					   }
					   ?>
					  </td>
						</tr>
					</table>
					  </div>
					
  <?php
  } 
}
if(! function_exists('seo_url_title'))
{
  function seo_url_title($str)
  {
	$str = preg_replace("~[^a-zA-Z0-9-_/]~","-",$str);
	$str = preg_replace("~[-]{2,15}~","-",$str);
	$str = strtolower($str);
	return $str;
  }
}