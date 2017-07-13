<?php
if ( ! function_exists('get_quote_status'))
{
  function get_quote_status($val)
  {
	switch($val)
	{
	  case '1':
		$var = "Confirmed";
	  break;
	  case '2':
		$var = "Negotiation";
	  break;
	  case '3':
		$var = "Decline";
	  break;
	  default:
		$var = " Pending ";
	}
	return $var;
  }
}