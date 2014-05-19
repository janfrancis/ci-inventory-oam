<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Profile extends CI_Controller {

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
			$this->load->model('profile_model');
	
			//validate form input
			$this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean');
			$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean');
			//$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
			$this->form_validation->set_rules('department', 'Department Name', 'required|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'email|required|xss_clean');
	
			if ($this->form_validation->run() == true)
			{
	
				$data = array(
					'fname' => ucwords(strtolower($this->input->post('fname'))), 
					'lname' => ucwords(strtolower($this->input->post('lname'))), 
					'department' => $this->input->post('department'), 
					'email' => $this->input->post('email'), 
					'phone' => $this->input->post('phone'), 
				);
			
				
			}
			if ($this->form_validation->run() == true &&  $this->profile_model->update_user($data))
			{ 
			
		 		/*$this->data['message'] = $this->session->set_flashdata('message','<button type="button" class="close" data-dismiss="alert">&times;</button><div class="alert alert-success">Successfully Updated.</div>');
		 		redirect(base_url().'profile');*/
		 		//echo 'Add Staff Successfully';
		 		$this->data['message'] = $this->session->set_flashdata('message','<button type="button" class="close" data-dismiss="alert">&times;</button><div class="alert alert-success">Profile Successfully Updated!</div>');
		 		redirect(base_url().'profile');
			}
			else
			{ 

				//display the create user form
				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->session->flashdata('message')));
			    
			    $this->load->model('manage_model');
				$this->data['records'] = $this->manage_model->category_list();	

				$this->load->model('profile_model');
				$this->data['records2'] = $this->profile_model->user_info();
				
				$this->load->view('profile_view',$this->data);

				
			}
	 
			}
			else 
			{
				$this->load->view('login_view');
			}
	}


}

/* End of file authenticate.php */
/* Location: ./application/controllers/auth/verify_user.php */