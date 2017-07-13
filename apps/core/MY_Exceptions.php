<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions 
{

    function __construct()
    {
        parent::__construct();
        log_message('debug', 'MY_Exceptions Class Initialized');
    }
    
	 function show_404($page = '', $log_error = TRUE)
    { 
		redirect('errors/a404');
		exit;

        
    }
   
}

/* End of file MY_Exceptions.php */
/* Location: ./system/application/libraries/MY_Exceptions.php */ 
