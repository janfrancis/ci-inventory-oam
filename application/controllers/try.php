<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Asset extends CI_Controller {

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
			$this->session->userdata('is_logged_in')){
			$this->load->model('add_asset');

			$this->form_validation->set_rules('asset_code', 'Asset Code', 'required|xss_clean');
			$this->form_validation->set_rules('ip_address', 'IP Address', 'required|xss_clean');
			$this->form_validation->set_rules('serial', 'Serial', 'required|xss_clean');
			$this->form_validation->set_rules('brand', 'Brand', 'required|xss_clean');
			$this->form_validation->set_rules('model', 'Model', 'xss_clean');
			$this->form_validation->set_rules('type', 'Type', 'required|xss_clean');
			$this->form_validation->set_rules('location', 'Location', 'required|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
			$this->form_validation->set_rules('note', 'Note', 'xss_clean');			


			if ($this->form_validation->run() == true)
			{
	
				$data = array(
					'asset_code' => $this->input->post('asset_code'), 
					'ip_address' => $this->input->post('ip_address'), 
					'serial' => $this->input->post('serial'), 
					'brand' => $this->input->post('brand'), 
					'model' => $this->input->post('model'),
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
		 		
				$this->load->model('profile_model');
				$this->data['records'] = $this->profile_model->user_info();
				//echo json_encode($records);
				$this->load->view('profile_view',$this->data);

				
			}
	 
			}
	
	function add_asset(){
	$this->load->view('add_asset_view')
	}