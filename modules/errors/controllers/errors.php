<?php
class Errors extends Public_Controller
{
	
	public function __construct()
	{
		parent::__construct();  
	}
	
	public function a404()
	{
		$this->is404 = TRUE;
		set_status_header('404');
		$this->page_section_ct = 'other';
		$this->load->view('errors/error_404','');
	}
	
	
	
}
/* End of file member.php */
/* Location: .application/modules/products/controllers/products.php */
