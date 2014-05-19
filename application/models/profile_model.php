<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model{

    function __construct() {

        parent::__construct();
    }

    function user_info(){
        $id = $this->session->userdata('user_id');

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    function update_user($data){
        $id = $this->session->userdata('user_id');
        $this->db->where('id', $id);
        return $this->db->update('user', $data); 

    }

   

}