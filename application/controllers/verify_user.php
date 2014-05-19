<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Verify_user extends CI_Controller {

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

		$this->load->model('login_model');

		$result = $this->login_model->validate();

		$permission = $this->session->userdata('permission');

		if(!$result || !$this->session->userdata('is_logged_in')) {

        	redirect(base_url().'login');

		}
		else {
				
			redirect(base_url().'dashboard');
		}
	}
}

/* End of file authenticate.php */
/* Location: ./application/controllers/auth/verify_user.php */