<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends CI_Controller {

	/**
	 * Logout
	 *
	 * @access	public
	 * @param	
	 * @return	void
	 */

 	public function index () {

 		$this->session->sess_destroy();

 		redirect(base_url(), 'refresh');
 	}

}