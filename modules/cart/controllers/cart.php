<?php
class Cart extends Public_Controller
{

	public function __construct()
	{
		
		parent::__construct();
		$this->load->helper(array('cart','products/product'));	 
		$this->load->model(array('products/product_model','members/members_model','cart_model'));		 
		$this->form_validation->set_error_delimiters("<div class='required'>","</div>");

		$this->page_section_ct = 'cart';
		
	}

	public function index()
	{			
		$order_cart_id = $this->session->userdata('working_order_id');
		if($order_cart_id!='')
		{
		  redirect('cart/invoice');
		}
		
		if( $this->input->post('EmptyCart')!="")
		{
			$this->empty_cart();
			$this->session->set_userdata(array('msg_type'=>'success'));
			$this->session->set_flashdata('success',$this->config->item('cart_empty')); 
			redirect('cart');
		}
		
		if($this->input->post('Update_Qty')!="")
		{			
			$this->session->set_userdata(array('msg_type'=>'success'));
		    $this->session->set_flashdata('success',$this->config->item('cart_quantity_update'));
			$this->update_cart_qty();			
			redirect('cart');
		}
		
		
		$posted_coupon_code    =  $this->input->post('coupon_code');	
		$set_coupon_code       = $this->session->userdata('coupon_id');	
		$coupon_code           = ($set_coupon_code!='' ) ? $set_coupon_code : $posted_coupon_code;			
	    $discount_res          =  $this->cart_model->get_discount( $coupon_code);				  		  
		$this->apply_coupon_code( $discount_res );	
		
			  
				
			
		$shipping_methods           =  $this->product_model->get_shipping_methods();				
		$posted_shipping_method     =  $this->input->post('shipping_method');
		
		if( $posted_shipping_method!='' )
		{
			$this->session->set_userdata('shipping_id',$posted_shipping_method);
		}
		
		$set_shipping_id = $this->session->userdata('shipping_id');
		$shipping_id     = ($set_shipping_id!='' ) ? $set_shipping_id : $posted_shipping_method;

		$shipping_res    =  $this->cart_model->get_shipping_rate( $shipping_id );
		$shipping_res    = is_array($shipping_res) ? $shipping_res  : array();		
		
		//$tax_cent = $this->cart_model->get_vat();
		
		$data['shipping_methods']   = $shipping_methods;
		$data['shipping_res']       = $shipping_res;	
		$data['discount_res']       = $discount_res;
			
		
		
		if($this->input->post('UserCheckout')!="")
		{
			
			$this->form_validation->set_rules('shipping_method', 'Shipping State','trim|xss_clean');
			$this->form_validation->set_message('required',$this->config->item('shipping_required'));
			
			if($this->form_validation->run()==TRUE)
			{
				
				if( $this->session->userdata('user_id') > 0 )
				{
					redirect('cart/checkout'); 
					
				}else
				{
					redirect('users/login?ref=cart/checkout'); 
				}
			}
		}
		
		if($this->input->post('GustCheckout')!="")
		{
			
			$this->form_validation->set_rules('shipping_method', 'Shipping State','xss_clean');
			
			if($this->form_validation->run()==TRUE)
			{
				
				redirect('cart/checkout');
			}
		}						
		$data['title']              = "Cart";	
		$this->load->view('view_my_cart',$data);
		
		
	}
	
	
	public function apply_coupon_code($discount_res)
	{
	   if( is_array($discount_res) && !empty($discount_res))
	   {
		    $cart_total      = $this->cart->total();
		    $discount_type   =  $discount_res['coupon_type'];
		  
		  if( $discount_res['minimum_order_amount']!='' && $discount_res['minimum_order_amount']!='0.0000'  )
		  {
			 
			if( $discount_type=='p' )
			 {
				 				 
				 	$discount_amount  = ($cart_total*$discount_res['coupon_discount']/100);
					
					 if( ($cart_total >= $discount_amount) &&  ($cart_total >= $discount_res['minimum_order_amount']) )
					 {	
					     $this->session->set_userdata(array('coupon_id'=>$discount_res['coupon_id'],
						                                    'discount_amount'=>$discount_amount) );
					 
					 }
					
			 }else
			 {
				  $discount_amount  = $discount_res['coupon_discount'];	
				  				
				  if( ($cart_total >= $discount_amount)  &&  ($cart_total >= $discount_res['minimum_order_amount']) )
				  {	
					 $this->session->set_userdata(array('coupon_id'=>$discount_res['coupon_id'],
					                                    'discount_amount'=>$discount_amount) );
				 
				  }
				  				 
			 }
			 
			 
		 }else
		 {		
			 			 
			 if( $discount_type=='p' )
			 {
				 				 
				 	 $discount_amount  = ($cart_total*$discount_res['coupon_discount']/100);
										
					 if( $cart_total >= $discount_amount )
					 {	
					     $this->session->set_userdata(array('coupon_id'=>$discount_res['coupon_id'],
						                                    'discount_amount'=>$discount_amount) );
					 
					 }
					
			 }else
			 {
				  $discount_amount  = $discount_res['coupon_discount'];		
				  			
				  if( $cart_total >= $discount_amount )
				  {	
					 $this->session->set_userdata(array('coupon_id'=>$discount_res['coupon_id'],
					                                    'discount_amount'=>$discount_amount) );
				 
				  }
				  				 
			 }
			 			 
			 
		  }
		 
		}
		
	}

	public function make_payment()
	{
		$this->load->view('view_make_payment','');	
	}
	
	public function checkout()
	{
				
		    if( ( !$this->cart->total_items() > 0 ) )
			{
			
			  redirect('cart');	
			
			}

			$shipping_res    =	$this->cart_model->get_shipping_rate( $this->session->userdata('shipping_id') );

			if(!is_array($shipping_res) || empty($shipping_res))
			{
			   //$this->session->set_userdata(array('msg_type'=>'error'));
			   //$this->session->set_flashdata('error',$this->config->item('shipping_required'));
			   //redirect('cart');	
			}	

			
			
			//trace($this->session->userdata);
		    $is_same_bill_ship =   $this->input->post('is_same',TRUE);	
		    $mres = $this->members_model->get_member_row( $this->session->userdata('user_id') );	
				
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|alpha|xss_clean');
		   $this->form_validation->set_rules('last_name', 'Last Name', 'trim|alpha|xss_clean');
		   $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'trim|max_length[25]|xss_clean');	
			$this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[80]');			
			$this->form_validation->set_rules('billing_name', 'Billing Name','trim|required|xss_clean|max_length[32]');
			$this->form_validation->set_rules('billing_landmark', 'Billing Landmark','trim|max_length[50]|xss_clean');
			$this->form_validation->set_rules('billing_address', 'Billing Address','trim|required|max_length[200]|xss_clean');
			$this->form_validation->set_rules('billing_mobile', 'Billing Mobile','trim|required|max_length[25]|xss_clean');
			$this->form_validation->set_rules('billing_zipcode', 'Billing Post Code','trim|required|max_length[25]|xss_clean');
			$this->form_validation->set_rules('billing_country', 'Billing Country','trim|required|max_length[80]|xss_clean');
			$this->form_validation->set_rules('billing_state', 'Billing State','trim|required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('billing_city', 'Billing City','trim|required|max_length[50]|xss_clean');

			$this->form_validation->set_rules('verification_code','Verification code','trim|required|valid_captcha_code[checkout]');
			
			if( $is_same_bill_ship!='Y')
			{
				$this->form_validation->set_rules('shipping_name', 'Shipping Name','trim|required|xss_clean|max_length[32]');
				//$this->form_validation->set_rules('shipping_landmark', 'Shipping Landmark','trim|max_length[50]|xss_clean');
				$this->form_validation->set_rules('shipping_address', 'Shipping Address','trim|required|max_length[200]|xss_clean');
				$this->form_validation->set_rules('shipping_mobile', 'Shipping Mobile','trim|required|max_length[25]|xss_clean');
				$this->form_validation->set_rules('shipping_zipcode', 'Shipping Post Code','trim|required|max_length[25]|xss_clean');
				$this->form_validation->set_rules('shipping_country', 'Shipping Country','trim|required|max_length[80]|xss_clean');
				$this->form_validation->set_rules('shipping_state', 'Shipping State','trim|required|max_length[50]|xss_clean');
				$this->form_validation->set_rules('shipping_city', 'Shipping City','trim|required|max_length[50]|xss_clean');
		
			}
			
			$posted_data = array(	
			'email'               =>$this->input->post('email')=='' ? null : $this->input->post('email'),
			'title'               =>$this->input->post('title')=='' ? null : $this->input->post('title'),
			'first_name'          =>$this->input->post('first_name'),
			'last_name'           =>$this->input->post('last_name')=='' ? null : $this->input->post('last_name'),
			'mobile_number' => $this->input->post('mobile_number')=='' ? null : $this->input->post('mobile_number'),	
			'phone_number'           =>$this->input->post('phone_number'),								
			'billing_name'        => $this->input->post('billing_name'),
			'billing_address'     => $this->input->post('billing_address') !=''  ?  $this->input->post('billing_address') : null,	
			'billing_landmark'     => null,				
			'billing_phone'       => $this->input->post('billing_phone') !=''  ?  $this->input->post('billing_phone') : null,
			'billing_mobile'       => $this->input->post('billing_mobile') !=''  ?  $this->input->post('billing_mobile') : null,			
			'billing_zipcode'     => $this->input->post('billing_zipcode') !=''  ?  $this->input->post('billing_zipcode') : null,
			'billing_country'     => $this->input->post('billing_address') !=''  ?  $this->input->post('billing_country') : null,
			'billing_state'       => $this->input->post('billing_state') !=''  ?  $this->input->post('billing_state') : null,
			'billing_city'        => $this->input->post('billing_city') !=''  ?  $this->input->post('billing_city') : null,		
			'shipping_name'       => $this->input->post('shipping_name') !=''  ?  $this->input->post('shipping_name') : null,
			'shipping_address'    => $this->input->post('shipping_address') !=''  ?  $this->input->post('shipping_address') : null,
			'shipping_landmark'     => null,					
			'shipping_phone'      => $this->input->post('shipping_phone') !=''  ?  $this->input->post('shipping_phone') : null,
			'shipping_mobile'      => $this->input->post('shipping_mobile') !=''  ?  $this->input->post('shipping_mobile') : null,			
			'shipping_zipcode'    => $this->input->post('shipping_zipcode') !=''  ?  $this->input->post('shipping_zipcode') : null,
			'shipping_country'    => $this->input->post('shipping_country') !=''  ?  $this->input->post('shipping_country') : null,
			'shipping_state'      => $this->input->post('shipping_state') !=''  ?  $this->input->post('shipping_state') : null,
			'shipping_city'       => $this->input->post('shipping_city') !=''  ?  $this->input->post('shipping_city') : null
			);
			
		if( $is_same_bill_ship=='Y')
		{
		  $posted_data1 = array(	
			'shipping_name'       => $posted_data['billing_name'],
			'shipping_address'    => $posted_data['billing_address'],
			'shipping_landmark'   => null,					
			'shipping_phone'      => $posted_data['billing_phone'],
			'shipping_mobile'     => $posted_data['billing_mobile'],				'shipping_zipcode'    => $posted_data['billing_zipcode'],
			'shipping_country'    => $posted_data['billing_country'],
			'shipping_state'      => $posted_data['billing_state'],
			'shipping_city'       => $posted_data['billing_city']
			);
		  $posted_data = array_merge($posted_data,$posted_data1);
		}
	
		if( is_array($mres) && !empty($mres) )
		{			
			if ($this->form_validation->run() === FALSE)
			{
				
				$mres_address = $this->members_model->get_member_address_book($mres['customers_id']);
				$mres_bill =	 $mres_address[0];
				$mres_ship =	 $mres_address[1];
				
				$mres =array(	
				'email'           => $mres['user_name'],			
				'title'               => $mres['title'],
				'first_name'          => $mres['first_name'],
				'last_name'           => $mres['last_name'],
				'mobile_number'       => $mres['mobile_number'],
				'phone_number'        => $mres['phone_number'],									
				'billing_name'        => $mres_bill['name'],
				'billing_landmark'    => $mres_bill['landmark'],
				'billing_address'     => $mres_bill['address'],					
				'billing_phone'       => $mres_bill['phone'],
				'billing_mobile'      => $mres_bill['mobile'],			
				'billing_zipcode'     => $mres_bill['zipcode'],
				'billing_country'     => $mres_bill['country'],
				'billing_state'       => $mres_bill['state'],
				'billing_city'        => $mres_bill['city'],		
				'shipping_name'       => $mres_ship['name'],
				'shipping_address'    => $mres_ship['address'],
				'shipping_landmark'   => $mres_ship['landmark'],					
				'shipping_phone'      => $mres_ship['phone'],
				'shipping_mobile'      =>$mres_ship['mobile'],			
				'shipping_zipcode'    => $mres_ship['zipcode'],
				'shipping_country'    => $mres_ship['country'],
				'shipping_state'      => $mres_ship['state'],
				'shipping_city'       => $mres_ship['city']
				);	

				$this->set_shipping($mres['shipping_country'],$mres['shipping_state']);
				
				$data['mres'] = $mres;				
				$this->load->view('view_cart_checkout',$data);	
				
			}else
			{		
				$this->set_shipping($posted_data['shipping_country'],$posted_data['shipping_state']);
			
				$this->add_customer_order($posted_data,$is_same_bill_ship);
			} 
			
			
		}else
		{		
				$this->set_shipping($posted_data['shipping_country'],$posted_data['shipping_state']);
	
				if ($this->form_validation->run() == FALSE)
				{		
													
					$data['mres'] =  $posted_data; 
					$this->load->view('view_cart_checkout',$data);				
					
				}else
				{
					
					$this->add_customer_order($posted_data,$is_same_bill_ship);
					 
				}	
				
					 
		}
		
		
	
  }

	private function add_customer_order($costumer_data = array(),$is_same_bill_ship)
	{
		if( $this->cart->total_items() > 0 )
		{
			
			$userId            = $this->session->userdata('user_id');				
			$invoice_number    = "Wl_".get_auto_increment('wl_order');	
			$coupon_id         = $this->session->userdata('coupon_id');
			$discount_amount   = 0;//$this->session->userdata('discount_amount');
			$currency_code     = $this->session->userdata('currency_code');
			$currency_value    = $this->session->userdata('currency_value');
			$customers_id   =  ( $userId!='') ? $userId : 0;

			$shipment_rate            = $this->session->userdata('shipping_rate');

			$shipping_type            = $this->session->userdata('shipping_type');	
														
			/*$shipping_res    =  array(
										'shipping_type' => $shipping_type,
										'shipment_rate' => $shipment_rate
									  );*/

			$shipping_res    =	$this->cart_model->get_shipping_rate( $this->session->userdata('shipping_id') );

			$cart_total      = $this->cart->total();

			$tax_cent  = $this->configuration_res['vat_charge'];

			$taxable_amt = 0;

			$tax = 0;
			
				 if($is_same_bill_ship=='Y')
				 {
					 $costumer_data['shipping_name']    = $costumer_data['billing_name'];
					 $costumer_data['shipping_address'] = $costumer_data['billing_address'];
					 $costumer_data['shipping_mobile'] = $costumer_data['billing_mobile'];
					 $costumer_data['shipping_phone']   = $costumer_data['billing_phone'];
					 $costumer_data['shipping_zipcode'] = $costumer_data['billing_zipcode'];
					 $costumer_data['shipping_country'] = $costumer_data['billing_country'];
					 $costumer_data['shipping_state']   = $costumer_data['billing_state'] ;
					 $costumer_data['shipping_city']    = $costumer_data['billing_city'];
					 
				 }
				  
				  $data_order = 
				   array(
				    'customers_id'        =>$customers_id,
					'invoice_number'      => $invoice_number,					
					'first_name'          => $costumer_data['first_name'],
					'last_name'           => $costumer_data['last_name'],
					'mobile' => $costumer_data['mobile_number'],
					'email'               => $costumer_data['email'],					
					'billing_name'        => $costumer_data['billing_name'],
					'billing_address'     => $costumer_data['billing_address'],	
					'billing_mobile'     => $costumer_data['billing_mobile'],				
					'billing_phone'       => $costumer_data['billing_phone'],					
					'billing_zipcode'     => $costumer_data['billing_zipcode'],
					'billing_country'     => $costumer_data['billing_country'],
					'billing_state'       => $costumer_data['billing_state'],
					'billing_city'        => $costumer_data['billing_city'],					
					'shipping_name'       => $costumer_data['shipping_name'],
					'shipping_address'    => $costumer_data['shipping_address'],	
					'shipping_mobile'    => $costumer_data['shipping_mobile'],				
					'shipping_phone'      => $costumer_data['shipping_phone'],					
					'shipping_zipcode'    => $costumer_data['shipping_zipcode'],
					'shipping_country'    => $costumer_data['shipping_country'],
					'shipping_state'      => $costumer_data['shipping_state'],
					'shipping_city'       => $costumer_data['shipping_city'],						
					'shipping_method'     =>$shipping_res['shipping_type'],
					'discount_coupon_id'  =>$coupon_id,
					'coupon_discount_amount'=>$discount_amount,
					'shipping_amount'     =>$shipping_res['shipment_rate'],
					'total_amount'        =>$cart_total,
					'vat_amount'		  =>$tax,
					'vat_applied_cent'	  =>$tax_cent,
					'currency_code'       =>$currency_code ,
					'currency_value'      =>$currency_value,				
					'order_status'       => 'Pending',
					'order_received_date' =>$this->config->item('config.date.time'),
					'payment_method'    =>'',
					'payment_status'   => 'Unpaid'
				);
				
			
			if(!$this->cart_model->is_order_no_exits($invoice_number) )
			{
				$cart_total = 0;

				$orderId = $this->cart_model->safe_insert('wl_order',$data_order,FALSE);		
				$this->session->set_userdata( array('working_order_id'=>$orderId) );				
				
				foreach($this->cart->contents() as $items)
				{
					$thumbc['width'] =100;
					$thumbc['height']=100;
					$thumb_name = "thumb_".$thumbc['width']."_".$thumbc['height']."_".$items['img'];					
					$image_file  = IMG_CACH_DIR."/".$thumb_name;

					$default_no_img = FCROOT."assets/developers/images/noimg1.gif";
												
					$file_data   = ( file_exists($image_file) ) ?  file_get_contents($image_file) : file_get_contents($default_no_img);

					$loop_total = $items['price'];

					//Attributes

					$prod_attrs = "";
					$prod_attrs_price = "";

					$item_attributes = $items['options']['Attributes'];

					if(!empty($item_attributes))
					{
						foreach($item_attributes as $gval)
						{
						  $loop_attr_price = floatval($gval['attr_price']);

						  $loop_attr_price = $loop_attr_price > 0 ? $loop_attr_price : 0;

						  $loop_total += $loop_attr_price;

						  $prod_attrs = $prod_attrs.$gval['attr_name']."^~^"; 

						  $prod_attrs_price = $prod_attrs_price.$loop_attr_price."^~^"; 
						}
					}

					$prod_attrs = trim($prod_attrs,"^~^");

					$prod_attrs_price = trim($prod_attrs_price,"^~^");

					$prod_attrs = $prod_attrs=='' ? null : $prod_attrs;

					$prod_attrs_price = $prod_attrs_price=='' ? null : $prod_attrs_price;

					//Accessories
				    $prod_acc = "";
					$prod_acc_price = "";

					$item_accessories = $items['options']['Accessories'];

					if(!empty($item_accessories))
					{
						foreach($item_accessories as $gval)
						{
						  $loop_acc_disc_price = floatval($gval['acc_disc_price']);

						  $loop_acc_price = $loop_acc_disc_price > 0 ? $loop_acc_disc_price : $gval['acc_price'];

						  $loop_acc_price = floatval($loop_acc_price);

						  $loop_acc_price = $loop_acc_price > 0 ? $loop_acc_price : 0;

						  $loop_total += $loop_acc_price;

						  $prod_acc = $prod_acc.$gval['acc_name']."^~^"; 

						  $prod_acc_price = $prod_acc_price.$loop_acc_price."^~^"; 
						}
					}

					$prod_acc = trim($prod_acc,"^~^");

					$prod_acc_price = trim($prod_acc_price,"^~^");

					$prod_acc = $prod_acc=='' ? null : $prod_acc;

					$prod_acc_price = $prod_acc_price=='' ? null : $prod_acc_price;

					$cart_total += $loop_total*$items['qty'];

					

					$data = array(
						'orders_id'      => $orderId,											'products_id'    => $items['pid'],
						'product_name'   => $items['origname'],
						'product_attr'   => $prod_attrs,
						'product_attr_price'   => $prod_attrs_price,
						'product_acc'    => $prod_acc,
						'product_acc_price'   => $prod_acc_price,
						'product_code'   => $items['code'],
						'product_image'  => $file_data,											'product_price'  => $items['price'],									'quantity'       => $items['qty']
					);
						
					/*
					
					 $data_qty_used  = array('used_qty' =>$items['qty']);
					 $where          = "product_id = ".$items['pid']." ";
					 $this->cart_model->safe_update('tbl_products',$data_qty_used,$where,FALSE);
				
					*/
						
				 $this->cart_model->safe_insert('wl_orders_products',$data,FALSE);
				
					
				}
				$tax = ($cart_total*$tax_cent)/100;
				$tax = number_format($tax,2,'.','');
				$data_order  = array('total_amount' =>$cart_total,'vat_amount'=>$tax);
				$where       = "order_id = ".$orderId." ";
				$this->cart_model->safe_update('wl_order',$data_order,$where,FALSE);

				$user_id = $this->session->userdata('user_id');
				
				if( $coupon_id!="" && $user_id!='' )
				{				
					$where = "coupon_id = '". $coupon_id."' AND customer_id ='".$user_id ."' ";
					$data = array('status'=>'1');
					$this->cart_model->safe_update('wl_coupon_customers',$data,$where,FALSE);
									
				}
				
				$this->cart->destroy();
				$data = array('shipping_id' => 0,'coupon_id'=>0,'discount_amount'=>0);
				$this->session->unset_userdata($data);
				redirect('cart/invoice','');
			}		
		}
	}


	public function invoice_mail_data($ordId)
	{
		if( $ordId !="")
		{
			$msgdata      = invoice_data($ordId);	
			$msgdata      = str_replace('bgcolor="#333333"','',$msgdata);
			$msgdata      = str_replace('Print','',$msgdata);
			$msgdata      = str_replace('Close','',$msgdata);
			return $msgdata;
		}
	}

	public function invoice()
	{
		if( $this->session->userdata('working_order_id') > 0 )
		{
			$this->load->model(array('order/order_model'));
			$data['title'] = "Checkout";
			$order_res = $this->order_model->get_order_master( $this->session->userdata('working_order_id') );
			$order_details_res = $this->order_model->get_order_detail($order_res['order_id']);			
			$data['orddetail']  = $order_details_res;
			$data['ordmaster']  = $order_res;				
			$data['ordId']      = $order_res['order_id'];			
			$data['unq_section'] = "Checkout";	
			$this->load->view('view_cart_invoice',$data);
			
		}else
		{
			redirect('cart', '');
		}
	}

	public function print_invoice()
	{
		$this->load->model(array('order/order_model'));
		$ordId              = (int) $this->session->userdata('working_order_id');
		$order_res          = $this->order_model->get_order_master( $ordId );
		$order_details_res  = $this->order_model->get_order_detail($order_res['order_id']);			
		$data['orddetail']  = $order_details_res;
		$data['ordmaster']  = $order_res;			
		$this->load->view('view_invoice_print',$data);
	}

	public function add_to_wishlist()
	{		
	   	   
		if( $this->session->userdata('user_id') > 0 )
		{
			$product_id = (int) $this->uri->segment(3);
			if($product_id > 0 )
			{
			  $this->cart_model->add_wislists($product_id,$this->session->userdata('user_id'));	
			  redirect('members/wishlist');
			}
			else
			{
				$this->session->set_userdata(array('msg_type'=>'error'));
				$this->session->set_flashdata('success','Invalid request');
				redirect('members/wishlist');
			}
			
		}else
		{
		    $product_id = (int) $this->uri->segment(3);
			
			redirect('users/login?ref=cart/add_to_wishlist/'.$product_id.''); 
		}
	}

	public function add_to_cart()
	{		
		 $this->add_cart();
			
    }

   public function check_product_exits_into_cart($pres)
   {	
	  $attributes = $this->input->post('attributes');

	  if(is_array($attributes) && !empty($attributes))
	  {
		$attributes = implode(",",$attributes);
	  }

	  $accessories = $this->input->post('accessories');

	  if(is_array($accessories) && !empty($accessories))
	  {
		$accessories = implode(",",$accessories);
	  }


      $cart_array =  $this->cart->contents(); 
	  	 
	  $insert_flag=FALSE;		
	  if( is_array( $cart_array ) && !empty($cart_array))
	  {
	   	foreach($this->cart->contents() as $item )
		{
				$cart_attributes = $item['options']['Attributes'];
				$cart_attributes = implode(",",$cart_attributes);

				$cart_accessories = $item['options']['Accessories'];
				$cart_accessories = implode(",",$cart_accessories);


				if(array_key_exists('pid' ,$item ))
				{								
						if( $item['pid']==$pres['products_id'] && $attributes==$cart_attributes && $accessories==$cart_accessories)
						{
															
							 $insert_flag=TRUE;					
							  break;
						}
						
						
					}
						
		       }
		  }
		  
		return $insert_flag;
   }
   

	private function add_cart()
	{
		
		$productId  = (int) $this->input->get_post('pid');
		$option     = array('productid'=>$productId);		
		$pres       =  $this->product_model->get_product_by_id($productId, "AND status='1'");

		if( (is_array($pres) && !empty($pres)))
		{
			
			
			$qty         = applyFilter('NUMERIC_GT_ZERO',$this->input->post('qty'));		
			$qty         = ($qty > 0) ? $qty: 1;
  
			$pres['product_discounted_price'] = floatval($pres['product_discounted_price']);
		
			$cart_price  = ( $pres['product_discounted_price']>0) ? $pres['product_discounted_price'] : $pres['product_price'];
							
			$is_exits_inot_cart = $this->check_product_exits_into_cart($pres);
			
			if( $is_exits_inot_cart )
			{
				$this->session->set_userdata(array('msg_type'=>'warning'));
				$this->session->set_flashdata('warning',$this->config->item('cart_product_exist'));								
				redirect('cart');
				
			}else
			{	
				// Attributes

				$prod_attr = array();
	
				$attributes = $this->input->post('attributes');

				if(is_array($attributes) && !empty($attributes))
				{
				  $attr_option = array(
					  'fields'=>"a.attr_name,a.attr_id,d.attr_price",
					  'where' => "a.status ='1' AND d.ref_product_id='".$pres['products_id']."' AND a.attr_id IN(".implode(',',$attributes).")"
					);
				  $attr_res = $this->product_model->get_product_attributes($attr_option);

				  if(is_array($attr_res) && !empty($attr_res))
				  {
					foreach($attr_res as $gval)
					{
					  $prod_attr[$gval['attr_id']] = $gval;
					}
				  }
				}

				// Accessories

				$prod_acc = array();
				
				$accessories = $this->input->post('accessories');

				if(is_array($accessories) && !empty($accessories))
				{
				  $acc_option = array(
					  'fields'=>"a.acc_name,a.acc_alt,a.acc_image,a.acc_id,d.acc_price,d.acc_disc_price",
					  'where' => "a.status ='1' AND d.ref_product_id='".$pres['products_id']."' AND a.acc_id IN(".implode(',',$accessories).")"
					);
				  $acc_res = $this->product_model->get_product_accessories($acc_option);

				  if(is_array($acc_res) && !empty($acc_res))
				  {
					foreach($acc_res as $gval)
					{
					  $prod_acc[$gval['acc_id']] = $gval;
					}
				  }
				}

				$param_media = array(
									  'where'=>"ref_id ='".$pres['products_id']."' AND media_section='products' AND media_type='photo'"
									);

				$res_media = $this->product_model->get_media(1,0,$param_media);
  
				if(is_array($res_media) && !empty($res_media))
				{
				  $product_image = $res_media['media'];
				}
				else
				{
				  $product_image = "noimg.jpg";
				}

				
				
				$cart_data  = array(
				'id'             => random_string(),		   
				'qty'            => $qty,
				'price'          => $cart_price,
				'product_price'  => $pres['product_price'],
				'discount_price' => $pres['product_discounted_price'],
				'name'           => url_title($pres['product_name']),
				'origname'       => $pres['product_name'],								'product_alt'    => $pres['product_alt'],
				'friendly_url'   => $pres['friendly_url'],				
				'pid'            => $pres['products_id'],								'img'            => $product_image,										'code'           => $pres['product_code'],
				'options'		 => array(
										  'Attributes'=>$prod_attr,
										  'Accessories'=>$prod_acc
										  )
				);
									
				$this->cart->insert($cart_data);
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',$this->config->item('cart_add'));
				redirect('cart');
				
			}	
			
			
		}else
		{
			redirect("category");
			
		}
		
	}


	public function empty_cart()
	{
		$this->cart->destroy();
		$data2 = array(
		  'shipping_id' => 0,
		  'shipping_rate' => 0,
		  'shipping_type' => 0,
		  'coupon_id' => 0,
		  'discount_amount'=>0
		);
		
		$this->session->unset_userdata($data2);
		redirect('cart');
		
	}

	public function remove_item()
	{
		$row_id =  $this->uri->segment(3);
		$attr_id =  (int) $this->input->get('attr_id');
		$acc_id =  (int) $this->input->get('acc_id');
		
		$session_cart_array = $this->session->userdata('cart_contents');

		$actual_cart_array =  $this->cart->contents(); 

		$cart_array = array_values($actual_cart_array);

		//trace($session_cart_array);	exit;	
		for($i=0; $i<$this->cart->total_items(); $i++)
		{
			
			if($row_id == $cart_array[$i]['rowid'])
			{
				if($attr_id > 0 && array_key_exists($attr_id,$cart_array[$i]['options']['Attributes']))
				{
				  unset($session_cart_array[$row_id]['options']['Attributes'][$attr_id]);
				}
				elseif($acc_id > 0 && array_key_exists($acc_id,$cart_array[$i]['options']['Accessories']))
				{
				  unset($session_cart_array[$row_id]['options']['Accessories'][$acc_id]);
				}
				else
				{
				  $session_cart_array['total_items']--;
				  unset($session_cart_array[$row_id]);
				}
			}
		}

		$this->session->set_userdata(array('cart_contents' => $session_cart_array));

		/*
		if($this->cart->total_items()==0)
		{
			//$this->session->unset_userdata(array('coupon_id'=>0,'discount_amount'=>0));
			
		}else
		{		 	
		 	  //$discount_res          =  $this->cart_model->get_discount( $this->session->userdata('coupon_id') );	
	          //$this->apply_coupon_code( $discount_res );	
		}
		*/

		
		
		//exit;		
		if(!$this->input->is_ajax_request())
		{
		  $this->session->set_userdata(array('msg_type'=>'success'));
		  $this->session->set_flashdata('success',$this->config->item('cart_delete_item'));
				
		  redirect('cart','');
		}  
		
	}

	public function update_cart_qty()
	{
		
		$cart_array =  $this->cart->contents(); 		
		for($i=1; $i<=$this->cart->total_items(); $i++)
		{
			$item = $this->input->post($i);	

			$pid = $cart_array[$item['rowid']]['pid'];
			
			 $data = array(
				  'rowid' => $item['rowid'],
				  'qty' => $item['qty']
			  );
			  $this->cart->update($data);
			
			
		}	
			
		if($this->cart->total_items()==0)
		{
			//$this->session->unset_userdata(array('coupon_id'=>0,'discount_amount'=>0));
			
		}else
		{		 
		      //$discount_res          =  $this->cart_model->get_discount( $this->session->userdata('coupon_id') );	
	          //$this->apply_coupon_code( $discount_res );	
		}
		
	}	

	public function count_cart_item()
	{
		return $this->cart->total_items();
	}
	
	public function cart_total_amount()
	{
		$total = $this->cart->total();	
		return $total;
	}
	
	public function display_cart_image($orders_products_id)
	{ 	
		 $binary_data =  get_db_field_value('wl_orders_products','product_image',array('orders_products_id'=>$orders_products_id));
		 header("Content-Type: image/jpeg");			 
		 echo $binary_data; 
		 		
	}
	
	public function thanksorder()
	{
		
		$data['page_text']=cms_page_content(15);		
		$data['page_title'] = "Thanks";		 
		$this->load->view('view_order_thanks',$data);
	}

	public function cart_summary()
	{
			
		/*$set_coupon_code       = $this->session->userdata('coupon_id');	
		$coupon_code           = ($set_coupon_code!='' ) ? $set_coupon_code : '';			
	    $discount_res          =  $this->cart_model->get_discount( $coupon_code);				  		  
		$this->apply_coupon_code( $discount_res );*/	
		
			  
				
			
		//$shipping_methods           =  $this->product_model->get_shipping_methods();				
		
		if(is_array($this->input->get()) && array_key_exists('shipping_method',$this->input->get()))
		{
		  $shipping_method = $this->input->get('shipping_method');

		  $shipping_res = $this->db->get_where('wl_shipping',array('shipping_type'=>$shipping_method,'status'=>'1'))->row_array();

		  if(is_array($shipping_res) && !empty($shipping_res))
		  {
			$shipping_id = $shipping_res['shipping_id'];
		  }
		}
		else
		{
		  $shipping_id = (int) $this->session->userdata('shipping_id');

		  $shipping_res    =  $this->cart_model->get_shipping_rate( $shipping_id );

		}
		
		$shipping_res    = is_array($shipping_res) ? $shipping_res  : array();	
		
		$tax_cent  = $this->configuration_res['vat_charge'];
		
		//$data['shipping_methods']   = $shipping_methods;
		$data['shipping_res']       = $shipping_res;	
		//$data['discount_res']       = $discount_res;
		$data['tax_cent'] = $tax_cent;

		$this->load->view('cart_container_ajax',$data);
	}

	private function set_shipping($shipping_country,$shipping_state)
	{
		$shipping_method = "";

		$shipping_id = 0;

		if($shipping_country=='United States')
		{
		  if($shipping_state!='')
		  {
			$shipping_method = $shipping_state;
		  }
		}

		if($shipping_method !='')
		{
		  $shipping_res = $this->db->get_where('wl_shipping',array('shipping_type'=>$shipping_method,'status'=>'1'))->row_array();

		  if(is_array($shipping_res) && !empty($shipping_res))
		  {
			$shipping_id = $shipping_res['shipping_id'];
		  }
		}
		$this->session->set_userdata('shipping_id',$shipping_id);
	}
  
}
/* End of file member.php */
/* Location: .application/modules/products/controllers/cart.php */