<?php
if ( ! function_exists('newsletter_subscriber'))
{
	function newsletter_subscriber($activity,$name,$email)
	{
		$CI = CI();
		if($activity=='Yes')
		{
			//New Joinee
			//echo "SELECT subscriber_email,status FROM wl_newsletters  WHERE subscriber_email='$email'";
			$newsletter_qry = $CI->db->query("SELECT subscriber_email,status FROM wl_newsletters  WHERE subscriber_email='$email' " );
			if( $newsletter_qry->num_rows() > 0 )
			{
				$row = $newsletter_qry->row_array();
				if($row['status']=='0')
				{
					$subdata = array('status' =>'1' );
					$CI->db->where('subscriber_email', $row['subscriber_email']);
					$CI->db->update('wl_newsletters', $subdata);	
				}
				return TRUE;
			}
			else
			{
				$CI->db->insert('wl_newsletters',array('status'=>'1','subscriber_name'=>$name,'subscriber_email'=>$email)); 
				return TRUE;
			}
		}
		else
		{
			//Unsubscribe user
			$subdata = array('status' =>'0' );
			$CI->db->where('subscriber_email', $email);
			$CI->db->update('wl_newsletters', $subdata);	
			return TRUE;
		}
	}
}