<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{

    function __construct() {

        parent::__construct();
    }

    /**
     * Validate Login
     *
     * @access  public
     * @param   
     * @return  bool
     */
    
    function validate() {
        
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        
        $query = $this->db->get('user');

        if($query->num_rows == 1) {
            
            $row = $query->row();

            $data = array(
                'user_id' => $row->id,
                'username' => $row->username,
                'password' => $row->password,
                'fname' => $row->fname,
                'lname' => $row->lname,
                'department' => $row->department,
                'role' => $row->role,
                'email' => $row->email,
                'phone' => $row->phone,
                'is_logged_in' => true,
                
            );


            $this->session->set_userdata($data);
            
            
            return true;
        }

        // If the previous process did not validate
        // then return false.
        $this->session->set_flashdata('error_msg', '<label style="font-size:12px;"><i class="fa fa-asterisk red"></i> Invalid username and/or password.</label>');
        
        return false;
    }

}