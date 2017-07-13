<?php
Class Seo extends CI_Controller
{
	public function __construct()
	{
		
	    parent::__construct(); 
		$this->load->helper('xml');		 		
		
	}		

     public  function sitemap()
     {
		
		$result = array();

		$page_array  = $this->config->item('controller_name');

		if( is_array( $page_array ) && !empty(  $page_array ))
		{
		  foreach(  $page_array as $k=>$v )
		  {
			array_push($result,$k);
		  }
		}

		$rwcont = $this->db->query("SELECT friendly_url FROM wl_cms_pages WHERE status ='1' LIMIT 0 , 100")->result_array();

		if(is_array($rwcont) && count($rwcont) > 0 )
		{
		
			foreach($rwcont as $contVal)
			{
				$reclink = $contVal['friendly_url'];

				array_push($result,$reclink);
			}
		}

		

		$rwcont = $this->db->query("SELECT friendly_url FROM wl_categories WHERE status ='1' LIMIT 0 , 100")->result_array();

		if(is_array($rwcont) && count($rwcont) > 0 )
		{
		
			foreach($rwcont as $contVal)
			{
				$reclink=$this->config->item('corporate_url_prefix')."/".$contVal['friendly_url'];

				array_push($result,$reclink);

				$reclink=$this->config->item('individual_url_prefix')."/".$contVal['friendly_url'];

				array_push($result,$reclink);
			}
		}

		$this->load->model('products/product_model');

		$qry_option = array(
								'fields' => "a.friendly_url",
								'where' => "a.status ='1' AND a.user_status ='1'",
								'offset'=>0,
								'limit'=>500
							  );

		$rwcont               =  $this->product_model->get_products($qry_option);

		if(is_array($rwcont) && count($rwcont) > 0 )
		{
		
			foreach($rwcont as $contVal)
			{
				$reclink=$contVal['friendly_url'];

				array_push($result,$reclink);
			}
		}

		$data['result'] = $result;
		header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("seo/sitemap",$data);
     }
	 
	 public function rss_feed()
	 {
			$base_url = base_url();
		    $data['encoding'] = 'utf-8';
	        $data['feed_name'] = $base_url;
	        $data['feed_url'] = $base_url;
	        $data['page_description'] = 'Welcome to '.$base_url.' feed page';
	        $data['page_language'] = 'en-us';
	        $data['creator_email'] = 'abc@gmail.com';

			$result = array();

			$rwcont = $this->db->query("SELECT testimonial_id,poster_name,testimonial_description FROM wl_testimonial WHERE status ='1' LIMIT 0 , 100")->result_array();

			if(is_array($rwcont) && count($rwcont) > 0 )
			{
			
				foreach($rwcont as $contVal)
				{
					$reclink = "testimonials/details/".$contVal['testimonial_id'];

					$result[] = array(
										'title'=>$contVal['poster_name'],										'url'=>$reclink,
										'description'=>$contVal['testimonial_description']
									 );
				}
			}
						
	        $data['result'] = $result;
				
		    header("Content-Type: application/rss+xml");
	        $this->load->view('rss', $data);
		
	}
	
	public function create_seo_url()
	{ 
	  $this->load->config('seo/config');

	  $seo_url_length = $this->config->item('seo_url_length');
	  $msg_arr = array();
	  $rec_id = (int) $this->input->post('rec_id');
	  $pg_title = $this->input->post('title',TRUE);
	  $pg_title = str_replace(base_url(),"",$pg_title);
	  $pre_title = $this->input->post('pre_title',TRUE);
	  $pre_title = str_replace(base_url(),"",$pre_title);
	  $pg_title = seo_url_title($pg_title);
	  
	  if($pre_title!=''){
		  
		$friendly_url = $pre_title.$pg_title;
	  }
	  else
	  {
		$friendly_url = $pg_title;
	  }
	  $this->db->select('meta_id');
	  $this->db->from('wl_meta_tags');
	  $this->db->where('page_url',$friendly_url);
	  if($rec_id > 0)
	  {
		$this->db->where('entity_id !=',$rec_id);
	  }
	  $meta_qry = $this->db->get();

	  if($meta_qry->num_rows() > 0)
	  {
		  $msg_arr['error'] = 1;
		  $msg_arr['msg'] = 'URL already exists';
	  }
	  elseif(strlen($friendly_url) > $seo_url_length)
	  {
		  $msg_arr['error'] = 1;
		  $msg_arr['msg'] = 'URL must not be greater than '.$seo_url_length.' characters';
	  }
	  else
	  {
		$msg_arr['error'] = 0;
		$msg_arr['msg'] = 'URL passed';
	  }
	  $msg_arr['friendly_name'] = $pg_title;
	  echo json_encode($msg_arr);
	}

	public function create_listing_page_links()
	{
	  create_listing_page_meta();
	}
}