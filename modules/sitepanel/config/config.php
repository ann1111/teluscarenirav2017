<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Global
|--------------------------------------------------------------------------
*/

$config['site_admin']              = "Inetwork Administrator Area";
$config['site_admin_name']         = "Inetwork";

$config['category.best.image.view']         = "( File should be .jpg, .png, .gif format and file size should not be more then 2 MB (2048 KB)) ( Best image size 400X267 )";


$config['testimonial.best.image.view']         = "( File should be .jpg, .png, .gif format and file size should not be more then 2 MB (2048 KB)) ( Best image size 140X140 )";

$config['acc.best.image.view']         = "( File should be .jpg, .png, .gif format and file size should not be more then 2 MB (2048 KB)) ( Best image size 290X290 )";

$config['product.doc.size']         = "( File should be .rtf, .txt, .pdf, .doc, .docx format and file size should not be more then 2 MB (2048 KB))";


$config['pagesize']                = "10";



$config['adminPageOpt']            = array(       
											$config['pagesize'],
											2*$config['pagesize'],
											3*$config['pagesize'],
											4*$config['pagesize'],
											5*$config['pagesize']											
											);
											
											
	

$config['bannersz'] =  array(
'Top'=>"980x173",
'Bottom'=>"909x169"
);	

$config['bannersections'] = array(
'category'=>"Category",
'subcategory'=>"Subcategory",
'product'=>"Product",
'login'=>"Login",
'register'=>"Registration",
'myaccount'=>"My Account",
'search'=>'Search',
'cart'=>"Cart",
'checkout'=>"Checkout",
'static'=>'Static Pages',
'testimonials'=>'Testimonials',
'faq'=>'FAQ',
'sitemap'=>'Sitemap',
'video'=>'Video',
'wholesale inquiry'=>'Wholesale Inquiry'
);	

$config['admin_groups'] =  array(
'2'=>"Half Admin Rights",
'3'=>"Low Admin Rights",
);

$config['package_set_as_config'] = array(''=>"Package Set As",
'best_deal'=>'Best Deal'
);

$config['package_unset_as_config'] = array(''=>"Package Unset As",
'best_deal'=>'Best Deal'
);

$config['service_set_as_config'] = array(''=>"Service Set As",
'paid'=>'Paid',
'unpaid'=>'Unpaid'
);											



/* End of file account.php */
/* Location: ./application/modules/sitepanel/config/sitepanel.php */