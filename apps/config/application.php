<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['default_curr_code'] = '&pound;';
$config['bottom.debug'] = 0;
$config['site.status']	= '1';
$config['site_name']	= 'Inetwork';

$config['auth.password_min_length']	= '6';
$config['auth.password_force_numbers']	= '0';
$config['auth.password_force_symbols']	= '0';
$config['auth.password_force_mixed_case']	= '0';


$config['allow.imgage.dimension']	= '1200x1800';
$config['allow.file.size']	        = '2048'; //In KB


$config['allow.frame.image.dimension']	= '250x166';
$config['allow.frame.file.size']	        = '2048'; //In KB



$config['allow_discount_option'] = 1;

$config['config.date.time']	= date('Y-m-d H:i:s');
$config['config.date']	    = date('Y-m-d');

$config['analytics_id']	    = 'UA-38999330-1';

$config['no_record_found'] = "No record(s) Found !";

$config['property_set_as_config'] = array(''=>"Property Set As",
'featured'=>'Featured');


$config['property_unset_as_config']	= array(''=>"Property Unset As",
'featured'=>'Featured');

$config['category_set_as_config'] = array(''=>"Category Set As",
'set_home'=>'Home');


$config['category_unset_as_config']	= array(''=>"Category Unset As",
'set_home'=>'Home');

$config['user_title'] =  array(""=>"Select","Mr."=>"Mr.","Miss."=>"Miss.");


$config['register_thanks']            = "Thanks for registering with <site_name>. We look forward to serving you. ";

$config['register_thanks_activate']   = "Thanks for registering with <site_name>.Please Check your mail account to activate your account on the <site_name>. ";


$config['enquiry_success']              = "Your enquiry has been submitted successfully.We will revert back to you soon.";
$config['feedback_success']             = "Your Feedback has been submitted successfully.We will revert back to you soon.";
$config['product_enquiry_success']      = "Your product enquiry  has been submitted successfully.We will revert back to you soon.";
$config['product_referred_success']     = "This product has been referred to your friend successfully.";
$config['site_referred_success']        = "Site has been referred to your friend successfully.";
$config['forgot_password_success']      = "Your password has been sent to your email address.Please check your email account.";

$config['exists_user_id']              = "Email id  already exists. Please use different email id.";
$config['email_not_exist']             = "Email id does not exist.";

$config['login_failed']             = "Invalid Username/Password";


$config['newsletter_subscribed']           =  "You have been subscribed successfully for our newsletter service.";
$config['newsletter_already_subscribed']   =  "You are already a subscribed member  of our newsletter service.";
$config['newsletter_unsubscribed']         =  "You have been unsubscribed from our newsletter service.";
$config['newsletter_not_subscribe']        =  "You are not the subscribe member of our news letter service.";
$config['newsletter_already_unsubscribed']   =  "You have already un-subscribed the newsletter service.";




$config['testimonial_post_success']     = "Thank you for your testimonial to <site_name>. Your message will be posted after review by the <site_name> team.";


$config['advertisement_request']          = "Your advertisement request has been submitted successfully.We will revert back to you soon.";
$config['myaccount_update']               = "Your account information has been updated successfully.";
$config['myaccount_password_changed']     = "Password has been changed successfully.";
$config['myaccount_password_not_match']   = "Old Password does  not match.Please try again.";
$config['member_logout']                  = "Logout successfully.";


$config['wish_list_add']               = "Product has been added to your wish list successfully.";
$config['wish_list_delete']            = "Product has been deleted from your wishlist.";
$config['wish_list_product_exists']    = "This product already exists in your wish list.";

$config['cart_add']                  =  "Product has been added to your Shopping Cart.";
$config['cart_quantity_update']      =  "Product quantity has been updated successfully.";
$config['cart_product_exist']        =  "Product is already exist in your cart.";
$config['cart_delete_item']          =  "Product(s) has been deleted successfully.";
$config['cart_empty']                 =  "Cart has been cleared successfully.";
$config['cart_available_quantity']   =  "Maximum available quantity  is <quantity>.You can not add  more then available Quantity.";

$config['shipping_required']         =  "Shipping selection is required.";

$config['payment_success']           =  "Thank you for shopping with us. Your transaction is successful.";
$config['payment_failed']            =  "Your transaction is failed due to some technical error.";

$config['invalid_card_expiry']       =  "Card is expired";


$config['bannersz'] =  array(
'Home Top'=>"980x190",
'Home Right'=>"250x250",
'Bottom'=>"469x90",
'Right'=>"245x328"
);	

$config['bannersections'] = array(
'common'=>"All Pages",
'home'=>"Home"
);
/* KEY PAIR OF SECTION AND POSTION */
$config['banner_section_positions'] = array(
'home'=>array('Home Top','Home Right'),
'common'=>array('Bottom','Right')
);	


$config['heard_site_opts'] = array(
					  '1'=>'Google',
					  '2'=>'Facebook',
					  '3'=>'Newspaper',
					  '4'=>'Magazines'
					);



$config['total_product_images']    = "1";

$config['price_range_opts']=array("0-100"=>"0-100","101-500"=>"101-500","501-1000"=>"501-1000",">1000"=>"Above 1000");



$config['product.best.image.view']          = "( File should be  .jpg, .png, .gif format and file size should not be more then 2 MB (2048 KB)) ( Best image size 500X400 )";

$config['comp.logo.best.image.view']          = "( File should be  .jpg, .png, .gif format and file size should not be more then 2 MB (2048 KB)) ( Best image size 170X90 )";



$config['rating_opts'] = array(
								1=>'Poor',
								2=>'Average',
								3=>'Fair',
								4=>'Good',
								5=>'Excellent'
							  );

$config['individual_url_prefix'] = 'individual';

$config['corporate_url_prefix'] = 'corporate';

$config['cat_vendor_url_suffix'] = 'vendor';

$config['max_request_quotation_attachment'] = 6;