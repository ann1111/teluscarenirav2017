<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Global
|--------------------------------------------------------------------------
*/

$lang['activate']             = "Record has been activated successfully.";
$lang['deactivate']           = "Record has been de-activated successfully.";
$lang['deleted']              = "Record has been deleted successfully.";
$lang['successupdate']        = "Record has been updated successfully.";
$lang['order_updated']        = "The Selected Record(s) has been re-ordered.";
$lang['password_incorrect']   = "The Old Password is incorrect";
$lang['recordexits']          = "Record address already exists.";
$lang['success']              = "Record added successfully.";
$lang['paysuccess']           = "Payment added successfully.";
$lang['admin_logout_msg']     = "Logout successfully ..";
$lang['admin_mail_msg']       = "Mail sent Successfully...";
$lang['forgot_msg']           = "Email Id does not exist in database";
$lang['admin_reply_msg']      = "Enquiry reply sent Successfully...";
$lang['pic_uploaded']         = 'Photos has been uploaded successfully.';
$lang['pic_uploaded_err']	  = 'Please upload at least one photo.';
$lang['pic_delete']			  = 'Photo has been deleted successfully.';

$lang['child_to_deactivate']     =  "The selected record(s) has some products/categories.Please de-activate them first";
$lang['child_to_activate']       =  "The selected record(s) has some products/categories.Please activate them first";
$lang['child_to_delete']         =  "The selected record(s) has some products/categories.Please delete them first";

$lang['child_to_deactivate_mix']     =  "But some selected record(s) has some products/categories.Please de-activate them first";

$lang['child_to_delete_mix']     =  "But some selected record(s) has some products/categories.Please de-activate them first";


 $lang['marked_paid']        = "The selected record(s) has been marked as Paid";
 $lang['payment_succeeded']  = "The payment has been made successfully.";
 $lang['payment_failed']     = "The payment has been canceled.";
 $lang['email_sent']	     = "The Email has been sent successfully to the selected Users/Members.";
 

$lang['top_menu_list'] = array( "Dashboard"=>"sitepanel/dashbord/",
  
  
  "Product Management"=>    array( 
								   
								   "Manage Category"=>"sitepanel/category/",
								   "Manage Products"=>"sitepanel/products/",
								   "Manage Quotation"=>"sitepanel/products/quotation",
"Feedbacks"=>"sitepanel/products/quotation_feedback",
									"Manage Company Type"=>"sitepanel/company_type/",
								   "Manage Looking For"=>"sitepanel/looking_for/",
							),

"Member Management"     =>array(
									"Manage Members"			=>"sitepanel/members/"
						
								  ),
"Vendor Management"     =>array(
									"Manage Vendors"			=>"sitepanel/vendors/",
									"Manage Reviews"			=>"sitepanel/vendor_reviews/"
						
								  ),

"Tender Request"     =>array(
									"Manage Tender Request"			=>"sitepanel/admin_tenders/",
									"Manage Tender Replies"			=>"sitepanel/admin_tenders/tender_reply"
						
								  ),					  	
  "Enquiry Management"     =>array(
									"General Enquiry"			=>"sitepanel/enquiry/",
									"Advertisement Enquiry"=>"sitepanel/advertise/"
						
								  ),

  "Newsletter" =>array(                     
					  "Manage Newsletter"			    =>"sitepanel/newsletter/"
                      ),
					  		
  "Other Management"  =>array(
					  "Manage Contact Address"=>"sitepanel/contact_address/",        
                      "Static Pages"=>"sitepanel/staticpages/",
					   
                       "Manage Banners"=>"sitepanel/banners/",
					   "Manage Testimonial"		    =>"sitepanel/testimonial/" , 	 
                       "Manage Faq"=>"sitepanel/faq/",
					   
					   
					   "Manage  Meta Tags"=>"sitepanel/meta/"   , 
                       " Admin Settings"=>"sitepanel/setting/"                      
                      ),
                    
                    
 );		
 
 
$lang['top_menu_icon'] = array(   
  "Product Management"=>"maintenance.png", 
  "Members Management"=>"manage-sec.png",  					  	
  "Orders Management"=>"order2.png",
  "Newsletter"=>"news-lt-.png",  
  "Other Management"=>"management.png",
 );			  

/* Location: ./application/modules/sitepanel/language/admin_lang.php */