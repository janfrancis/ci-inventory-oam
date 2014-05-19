<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard extends CI_Controller {

	function __construct() {

		parent::__construct();
	}

	/**
	 * Verify Login
	 *
	 * @access	public
	 * @param	
	 * @return	void
	 */

	function index() {

		if($this->session->userdata('is_logged_in')){
			$this->load->model('manage_model');
			$this->data['records'] = $this->manage_model->category_list();
	 		$this->load->view('dashboard_view',$this->data);
			
		}
		else 
		{
			$this->load->view('login_view');
		}
	}
}

/* End of file authenticate.php */
/* Location: ./application/controllers/auth/verify_user.php */