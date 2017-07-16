<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


// Admin and modules

$route['sitepanel/(:any)']		= "sitepanel/$1";
$route['tlsadmin']		= "tlsadmin/login";
$route['consumer-dashboard']		= "tlsadmin/login";
$route['seller-dashboard']		= "tlsadmin/login";

$route['members/quotes/(complaint|suggestion|queries)/(:num)'] = 'members/quotes/feedback';

$route['individual/health-insurance'] = "healthinsurance/index";
$route['individual/motor-insurance'] = "motorinsurance/index";



$route['default_controller'] = "home";
$route['404_override'] = 'errors/a404';
$route['tlsadmin/enq/Manageenquiryonline/quote-booked']		= "tlsadmin/enq/Manageenquiryonline/quote_booked";
$route['tlsadmin/enq/Manageenquiryonline/quote_bookededit/(any:)']		= "tlsadmin/enq/Manageenquiryonline/quote_booked";
$route['tlsadmin/enq/Manageenquiryonline/quote-saved']		= "tlsadmin/enq/Manageenquiryonline/quote_shared";
$route['tlsadmin/enq/Manageenquiryonline/bid-for-quote']		= "tlsadmin/enq/Manageenquiryonline/bid_for_quote";
$route['tlsadmin/enq/Manageenquiryonline/quote-booked']		= "tlsadmin/enq/Manageenquiryonline/quote_booked";
$route['tlsadmin/enq/Manageenquiryonline/quote-booked']		= "tlsadmin/enq/Manageenquiryonline/quote_booked";
$route['tlsadmin/enq/Manageenquiryonline/requested-quote']		= "tlsadmin/enq/Manageenquiryonline/requested_quote";
$route['tlsadmin/enq/Manageenquiryonline/negotiate-on-quote']		= "tlsadmin/enq/Manageenquiryonline/negotiate_on_quote";

/*$route['tlsadmin/enq/Manageenquiryonline/requested-quote']		= "tlsadmin/enq/Manageenquiryonline/requested_quote";
$route['tlsadmin/enq/Manageenquiryonline/quote-shared']		= "tlsadmin/enq/Manageenquiryonline/quote_booked";
$route['tlsadmin/enq/Manageenquiryonline/quote-shared']		= "tlsadmin/enq/Manageenquiryonline/quote_booked";
$route['tlsadmin/enq/Manageenquiryonline/quote-shared']		= "tlsadmin/enq/Manageenquiryonline/quote_booked";
$route['tlsadmin/enq/Manageenquiryonline/quote-shared']		= "tlsadmin/enq/Manageenquiryonline/quote_booked";
$route['tlsadmin/enq/Manageenquiryonline/quote-shared']		= "tlsadmin/enq/Manageenquiryonline/quote_booked";*/
// cms pages 




/* End of file routes.php */
/* Location: ./application/config/routes.php */