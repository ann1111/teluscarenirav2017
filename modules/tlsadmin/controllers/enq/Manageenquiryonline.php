<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manageenquiryonline extends Private_Controller{

	private $mId;

	public function __construct()
	{
		parent::__construct(); 	
		//	$this->load->model(array('members/members_model','comments/comments_model'));
			$this->load->model('tlsadmin/Manageenquiryonline_model');
		
	}
	
	
	public function  searchServices(){
	
	$data = '';
			
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('enq/searchservices',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function postrequestquote(){
	
		//print_r($this->input->post()); exit;

		$to = "sanuj27_jan@hotmail.com,niravphp1111@gmail.com";
		$subject = "Request for quote ID ".$this->input->post('quoteid');

		$message = "
		<html>
		<head>
		<title>Request for quote </title>
		</head>
		<body>
		<p>You have got the request for qoute by User ID ".$this->input->post('quoteid')."</p>
		<table>
		<tr>
		<th>Subject</th>
		<th>Remarks</th>
		<th>PreferredQuote</th>
		<th>Quote ID</th>
		</tr>
		<tr>
		<td>".$this->input->post('Subject')."</td>
		<td>".$this->input->post('Remarks')."</td>
		<td>".$this->input->post('PreferredQuote')."</td>
		<td>".$this->input->post('quoteid')."</td>
		</tr>
		</table>
		</body>
		</html>
		";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <support@talescare.com>' . "\r\n";
	
		mail($to,$subject,$message,$headers);

		redirect(base_url('tlsadmin/enq/Manageenquiryonline/requested-quote?success=1'));
	
	}
	
	
	public function  quote_booked(){
	
			$usrid = $this->session->userdata('user_id');
		
			$data['booking_data'] = $this->Manageenquiryonline_model->getbookedquote($usrid);
			
			
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('enq/quote_booked',$data);

			$this->load->view('theme/footer');

	
	}
	
	
	public function quote_bookededit(){
	
	$editquote=$this->uri->segment(5);
	$data['edit'] = '1';
	
	if($this->input->post('Update') == true){
	
	$data['updatequote'] = $this->Manageenquiryonline_model->updatebookquote($editquote); 
	$data['msg'] = 'Quote Update Successfully';
	
	
	//print_r($this->input->post()); exit;
	
	}
	
    $data['quote'] = $this->Manageenquiryonline_model->edit($editquote);
		
	$this->load->view('theme/header',$data);
	//$this->load->view('theme/sidebar');
	$this->load->view('enq/add_bookquote',$data);
	$this->load->view('theme/footer');
	
	}
	
	public function  quote_shared(){
	
	$data = '';
	//print_r($this->session->all_userdata());
	$usrid = $this->session->userdata('user_id');
	$data['saving_data'] = $this->Manageenquiryonline_model->getsavedquote($usrid);
			
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('enq/quote_shared',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	
	public function  bid_for_quote(){
	
	$data = '';
	$usrid = $this->session->userdata('user_id');
	$data['bid_for_quote'] = $this->Manageenquiryonline_model->getbifforquote($usrid);
	
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('enq/bid_for_quote',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  negotiate(){
	
	$data = '';
	$usrid = $this->session->userdata('user_id');
	$data['negotiate'] = $this->Manageenquiryonline_model->getnegotiatequote($usrid); 
	
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('enq/negotiate',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  confirmed(){
	
	$data = '';
	
	$usrid = $this->session->userdata('user_id');
	$data['confirmed'] = $this->Manageenquiryonline_model->getconfirmedquote($usrid); 
	

	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('enq/confirmed',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  requested_quote(){
	
	$data = '';
	
	$usrid = $this->session->userdata('user_id');
	$data['requastaquote'] = $this->Manageenquiryonline_model->requastaquote($usrid); 
	

	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('enq/requested_quote',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  negotiate_on_quote(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('enq/negotiate-on-quote',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  confirmation(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('enq/confirmation',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  add_quote(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('enq/add_quote',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	public function  add_health_plan(){
	
	$data = '';
	
			$this->load->view('theme/header',$data);

			//$this->load->view('theme/sidebar');

			$this->load->view('enq/add_health_plan',$data);

			$this->load->view('theme/footer');

	
	
	
	}
	
	}

	
