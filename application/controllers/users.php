<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users extends CI_Controller {

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

	/*function index() {	

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
			
		 		$this->data['message'] = $this->session->set_flashdata('message','<button type="button" class="close" data-dismiss="alert">&times;</button><div class="alert alert-success">Successfully Updated.</div>');
		 		redirect(base_url().'profile');
			}
			else
			{ 

				//display the create user form
				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->session->flashdata('message')));
			    //$this->data['message'] = $this->session->set_flashdata('message','<button type="button" class="close" data-dismiss="alert">&times;</button><div class="alert alert-success">Successfully Updated.</div>');
		 		$this->load->model('manage_model');
				$this->data['records'] = $this->manage_model->category_list();	

				$this->load->model('profile_model');
				$this->data['records'] = $this->profile_model->user_info();
				//echo json_encode($records);
				$this->load->view('profile_view',$this->data);

				
			}
	 
			}
			else 
			{
				$this->load->view('login_view');
			}
	}*/
	function add_admin() {	

		if($this->session->userdata('is_logged_in')){
			$this->load->model('manage_model');
	
			//validate form input
			$this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean');
			$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean');
			$this->form_validation->set_rules('department', 'Department Name', 'required|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'email|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
			$this->form_validation->set_rules('username', 'username', 'required|xss_clean');
	
			if ($this->form_validation->run() == true)
			{
	
				$data = array(
					'fname' => ucwords(strtolower($this->input->post('fname'))), 
					'lname' => ucwords(strtolower($this->input->post('lname'))), 
					'department' => $this->input->post('department'), 
					'email' => $this->input->post('email'), 
					'phone' => $this->input->post('phone'), 
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password'),
					'role'	=> 'Admin',
					'date_created' => date('Y-m-d H:i:s')
				);
			
				
			}
			if ($this->form_validation->run() == true &&  $this->manage_model->add_user($data))
			{ 
			
		 		/*$this->data['message'] = $this->session->set_flashdata('message','<button type="button" class="close" data-dismiss="alert">&times;</button><div class="alert alert-success">Successfully Updated.</div>');
		 		redirect(base_url().'profile');*/
		 		//echo 'Add Admin Successfully';
		 		$this->data['message'] = $this->session->set_flashdata('message','<button type="button" class="close" data-dismiss="alert">&times;</button><div class="alert alert-success">Admin account added successfully.</div>');
		 		redirect(base_url().'users/add_admin');
			}
			else
			{ 

				//display the create user form
				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->session->flashdata('message')));
			    //$this->data['message'] = $this->session->set_flashdata('message','<button type="button" class="close" data-dismiss="alert">&times;</button><div class="alert alert-success">Successfully Updated.</div>');
		 		$this->data['records'] = $this->manage_model->category_list();	
				//echo json_encode($records);
				$this->load->view('add_admin_view',$this->data);

				
			}
 
		}
		else 
		{
			$this->load->view('login_view');
		}
	}
	function add_staff() {	

		if($this->session->userdata('is_logged_in')){
			$this->load->model('manage_model');
	
			//validate form input
			$this->form_validation->set_rules('fname', 'First Name', 'required|xss_clean');
			$this->form_validation->set_rules('lname', 'Last Name', 'required|xss_clean');
			$this->form_validation->set_rules('department', 'Department Name', 'required|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'email|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
			$this->form_validation->set_rules('username', 'username', 'required|xss_clean');
	
			if ($this->form_validation->run() == true)
			{
	
				$data = array(
					'fname' => ucwords(strtolower($this->input->post('fname'))), 
					'lname' => ucwords(strtolower($this->input->post('lname'))), 
					'department' => $this->input->post('department'), 
					'email' => $this->input->post('email'), 
					'phone' => $this->input->post('phone'), 
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password'),
					'role'	=> 'Staff',
					'date_created' => date('Y-m-d H:i:s')
				);
			
				
			}
			if ($this->form_validation->run() == true &&  $this->manage_model->add_user($data))
			{ 
			
		 		/*$this->data['message'] = $this->session->set_flashdata('message','<button type="button" class="close" data-dismiss="alert">&times;</button><div class="alert alert-success">Successfully Updated.</div>');
		 		redirect(base_url().'profile');*/
		 		//echo 'Add Staff Successfully';
		 		$this->data['message'] = $this->session->set_flashdata('message','<button type="button" class="close" data-dismiss="alert">&times;</button><div class="alert alert-success">Staff account added successfully.</div>');
		 		redirect(base_url().'users/add_staff');
			}
			else
			{ 

				//display the create user form
				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->session->flashdata('message')));
			    //$this->data['message'] = $this->session->set_flashdata('message','<button type="button" class="close" data-dismiss="alert">&times;</button><div class="alert alert-success">Successfully Updated.</div>');
		 		$this->data['records'] = $this->manage_model->category_list();	
				//echo json_encode($records);
				$this->load->view('add_staff_view',$this->data);

				
			}
	 
			}
			else 
			{
				$this->load->view('login_view');
			}
	}

	function username_exists(){ 
   	 	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$username = $this->input->post('username');
			$this->load->model('manage_model');
			if ( $this->manage_model->username_exists($username) == TRUE ) {
		      echo json_encode(FALSE);
		    } else {
		      echo json_encode(TRUE);
	   	 	}

	   }
	   else {
		    header( 'Location: ../dashboard' );
		}
	}

	function list_staff(){

		$this->load->model("manage_model");
		$data = $this->manage_model->list_staff();

		$str = json_encode($data);
		$str = '{ "aaData": '. $str . '}';
		echo $str;

	}

	function list_admin(){

		$this->load->model("manage_model");
		$data = $this->manage_model->list_admin();

		$str = json_encode($data);
		$str = '{ "aaData": '. $str . '}';
		echo $str;

	}


}

/* End of file authenticate.php */
/* Location: ./application/controllers/auth/verify_user.php */