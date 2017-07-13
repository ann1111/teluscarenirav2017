<?php
class run_cron extends My_Controller {

	public function __construct()
	{
		parent::__construct(); 			  
		$this->load->helper(array('thumbnail','string','text','file'));	 
		$this->load->library(array('securimage_library','Dmailer')); 
		$this->load->model(array('run_cron/cron_model'));
	}

	public function index()
	{
	  /*Please remove when cron is active */
	  $this->cron_model->requirement_matching_alerts();

	  echo "Daily Cron runned successfully";
	}

	public function requirement_matching_alerts()
	{
	  $this->cron_model->requirement_matching_alerts();
	}
}


/* End of file pages.php */

?>