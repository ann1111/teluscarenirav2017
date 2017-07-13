<?php
class Configuration extends Admin_Controller 
{
  public function __construct() 
  {
    parent::__construct();
	$this->load->model(array('sitepanel/configuration_model'));
	$this->config->set_item('menu_highlight','other management');
	$this->form_validation->set_error_delimiters("<div class='required'>","</div>");
  }

  public  function index($page = NULL)
  {
	  
	$this->thresholds();
		
  }
  
  

  public  function thresholds($page = NULL)
  {
	$data['heading_title'] = 'Configuration';

	$this->form_validation->set_rules('vat_charge', 'Value','required|less_than[100]|xss_clean');

	if ($this->form_validation->run() == TRUE)
	{
	  $this->configuration_model->saveThresholds();
	  $this->session->set_userdata('msg_type','success');
	  $this->session->set_flashdata('success',lang('successupdate'));
	  redirect('sitepanel/configuration');
	}
	$data['result'] = $this->configuration_model->getThresholds();
	$this->load->view('configuration/configuration_view',$data); 	
  }
}
// End of controller