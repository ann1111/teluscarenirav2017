<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cron_model extends MY_Model {

	public function requirement_matching_alerts($id='')
	{
		 $this->load->helper(array('thumbnail'));
		 $query1 = "SELECT * FROM wl_post_requirement WHERE status !='2' ";
		if($id>0)
		{
		  $query1 .= " AND sl='".$id."' ";
		}
		$query1 .= " LIMIT 0,400 ";

		$result1 = $this->db->query($query1)->result_array();
		if(!empty($result1) && is_array($result1))
		{
		  $this->load->model('property/property_model');
		  $curr_symbol = display_symbol();
		  $price_unit_opts = $this->config->item('price_unit_opts');
		  $build_area_unit_opts = $this->config->item('build_area_unit_opts');
		  $carpet_area_unit_opts = $this->config->item('carpet_area_unit_opts');
		  $property_society_opts = $this->config->item('property_society_opts');
		  $property_type_opts = $this->config->item('property_type_opts');
		  $amenities_opts = $this->config->item('amenities_opts');
		  $property_purpose_opts = $this->config->item('property_purpose_opts'); 
		  $property_age_opts = $this->config->item('property_age_opts');
		  $property_status_opts = $this->config->item('property_status_opts');
		  $facing_opts = $this->config->item('facing_opts');
		  $seller_type = $this->config->item('seller_type');
		  $config_total_images = $this->config->item('total_property_images');		  

		  foreach($result1 as $key1=>$val1)
		  {
			$query2 = "SELECT wlp.*,wlc.user_subtype,wlc.first_name,wlc.user_name,wlc.mobile_number FROM wl_property as wlp INNER JOIN wl_customers AS wlc ON wlc.customers_id=wlp.mem_id WHERE wlp.mem_id !='".$val1['mem_id']."' AND  wlc.status = '1' AND wlp.status ='1' AND wlp.admin_status ='1' AND wlp.price >='".$val1['budget_min']."' AND wlp.price <='".$val1['budget_max']."'";
			 
			$search_criterion = array();

			$property_type = (int) $val1['property_type'];

			if($property_type > 0)
			{
			  array_push($search_criterion," (wlp.property_type ='".$property_type."') ");
			}

			$property_purpose = (int) $val1['property_purpose'];

			if($property_purpose > 0)
			{
			  array_push($search_criterion," (wlp.property_purpose ='".$property_purpose."') ");
			}

			if($val1['location'] != '')
			{
			  array_push($search_criterion," (wlp.location ='".$val1['location']."') ");
			}

			$build_area = (int) $val1['build_area'];

			$build_unit = (int) $val1['build_unit'];

			if($build_area > 0 && $build_unit > 0)
			{
			  array_push($search_criterion," (wlp.build_area ='".$build_area."' AND wlp.build_unit ='".$build_unit."') ");
			}

			$carpet_area = (int) $val1['carpet_area'];

			$carpet_unit = (int) $val1['carpet_unit'];

			if($carpet_area > 0 && $carpet_unit > 0)
			{
			  array_push($search_criterion," (wlp.carpet_area ='".$carpet_area."' AND wlp.carpet_unit ='".$carpet_unit."') ");
			}
			
			if(!empty($search_criterion))
			{
				$query2 .= " AND ( ".implode(" OR ",$search_criterion) ." ) "; 
			}
			

			$query2 .= " AND wlp.property_id NOT IN(SELECT c.propertyId FROM wl_property_alerts AS c WHERE c.propertyId=wlp.property_id AND c.recv_id ='".$val1['mem_id']."') LIMIT 0,3";
			//echo "$query2 <br /><br />";
			$result2 = $this->db->query($query2)->result_array();
			if(!empty($result2) && is_array($result2))
			{
			   
			  $property_data = '';
			  foreach($result2 as $key2=>$val2)
			  {
				$media_image = "noimg3.jpg";

				$media_option = array('propertyid'=>$val2['property_id'],'media_type'=>'photo','section'=>'property');

				$res_photo_media = $this->property_model->get_property_media($config_total_images,0, $media_option);
		
				if(is_array($res_photo_media) && !empty($res_photo_media))
				{
				   foreach($res_photo_media as $key3=>$val3)
				   {
					  if($val3['media'] !='' && file_exists(UPLOAD_DIR."/property/".$val3['media']))
					  {
						$media_image = $val3['media'];

						break;
					  }
				   }
				}

				$price_unit = (int) $val2['price_unit'] ;
				$price_figure = (int) $val2['price_figure'];
				
				$detail_lk = base_url().'property/detail/'.$val2['property_id'];

				$data=array(
							  'recv_id'=>$val1['mem_id'],
							  'propertyId'=>$val2['property_id'],
							  'recv_date'=>$this->config->item('config.date.time')
							);
				$this->safe_insert('wl_property_alerts',$data,FALSE);
				$property_data.='<table width="100%" border="0" cellspacing="0" cellpadding="0">';
				$property_data .='<tr>
									<td width="20%"><a href="'.$detail_lk.'" title="'. escape_chars($val2['property_title']).'"><img src="'. get_image('property',$media_image,'160','150','R').'" alt=""></a></td>
									<td align="left" style="padding-left:15px;">
									<p style="color:#f00;">'.$val2['property_title'].'</p>
									<p style="color:#000;">'.$val2['property_address'].'</p>
									<p style="color:#000;">'.$val2['location'].'</p>
									<p style="color:#000;font-weight:bold;">Build Area : '.$val2['build_area'].' '.$build_area_unit_opts[$val2['build_unit']].'</p>
									<p style="color:#000;font-weight:bold;">Carpet Area : '.$val2['carpet_area'].' '.$carpet_area_unit_opts[$val2['carpet_unit']].'</p>
									<p style="color:#f00;font-weight:bold;">Price : ';
									if($price_figure > 0  && $price_unit > 0)
									{
									  $property_data .=  $curr_symbol." ". $price_figure." ".$price_unit_opts[$price_unit];
									}
									else
									{
									  $property_data .= " - ";
									}
				  $property_data .='</p>
									</td>
								  </tr>';

				$property_data.='</table>';
			  }
			  
			  /* Send alert mail to users */
			  $content_fld="email_content";
			  $subject_fld="email_subject";
			  $admin_email    =  $this->admin_info->admin_email;
			  $mail_content   =  get_content('wl_auto_respond_mails','21');	

			  $logo_url = get_mail_logo();

			  $body           =   $mail_content->$content_fld;		
			  $body			=	str_replace('{mem_name}',$val1['name'],$body);
			  $body			=	str_replace('{properties}',$property_data,$body);
			  $body			=	str_replace('{site_name}',$this->config->item('site_name'),$body);		
			  $body			=	str_replace('{link}','<a href="'.base_url().'">'.base_url().'</a>',$body);
			  $body			=	str_replace('{admin_email}',$admin_email,$body);
			  $body			=	str_replace('{logo}',$logo_url,$body);		
			  
			  			  
  
			  
			  $mail_conf =  array(
			  'subject'=>$mail_content->$subject_fld,
			  'to_email'=>$val1['email'],
			  'from_email'=>$admin_email,
			  'from_name'=> $this->config->item('site_name'),
			  'body_part'=>$body
			  );	
			  
			  $this->dmailer->mail_notify($mail_conf);
			}
		  }
		}	
	}
}