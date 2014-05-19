<?php

class Manage_model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }

    function username_exists($username){
        $this->db->where('username',$username);
        $this->db->from('user');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }

    }


    function add_user($data){ 
        return $this->db->insert('user', $data);
        //return (isset($id)) ? $id : FALSE;  
    }

  
    function list_staff() {
        $role='Staff';
        $this->db->select('CONCAT(fname, " ", lname) AS name, department, email, phone,date_created',false);
        $this->db->where('role',$role);
        $this->db->from('user');
        $query = $this->db->get(); 
        return $query->result();
    } 

     function list_admin() {
        $role='Admin';
        $this->db->select('CONCAT(fname, " ", lname) AS name, department, email, phone,date_created',false);
        $this->db->where('role',$role);
        $this->db->from('user');
        $query = $this->db->get(); 
        return $query->result();
    } 





    #Categories
    public function add_category($data)
    {
        $this->db->insert('category_tbl',array('category_name' => $data['category_name'],
                        'date_created' => date('Y-m-d H:i:s'),));
    }

    function category_list(){
        $this->db->select('category_id, category_name, date_created, category_id as o_id');
        $this->db->from('category_tbl');
        $this->db->order_by("category_name", "asc"); 
        //$this->db->where('category_name',$name);
        $query = $this->db->get();
        return $query->result();

    }
    function delete_category($id){
       $tables = array('category_tbl', 'category_fields_tbl');
       $this->db->where('category_id', $id);
       $this->db->delete('category_tbl');
    }
    function delete_category_field($id){
       $tables = array('category_fields_tbl');
       $this->db->where('category_field_id', $id);
       $this->db->delete($tables);
    }

  /*  function category_details($id){
        $this->db->select('*');
        $this->db->from('category_fields_tbl');
    }*/
    function indv_category($id){
        $this->db->select('*');
        $this->db->from('category_fields_tbl');
        $this->db->where('category_id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    function indv_category_field($id){
        $this->db->select('category_field_name');
        $this->db->from('category_fields_tbl');
        $this->db->where('category_id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    function add_category_details($data) {
        $lowcase = strtolower($data['detail_name']);
        $name = str_replace(' ', '_', $lowcase);
        $this->db->insert('category_fields_tbl',
                        array(
                            'category_field_name' => $name,
                            'category_field_type' => $data['detail_type'],
                            'category_field_default' => $data['detail_values'],
                            'category_id' => $data['category_id'],
                        ));
    }
    function category_field_view($id){
        $this->db->select('*');
        $this->db->from('category_fields_tbl');
        $this->db->where('category_field_id',$id);
        $query = $this->db->get();
        return $query->result();
    }    
    #Assets  
    function add_asset($data){
       /* $tbl = $category . '_tbl';
        $this->db->insert($tbl,$data);*/
        $this->db->insert('asset_list_tbl',$data);
        $id = $this->db->insert_id();
        return(isset($id))? $id: FALSE;
    }
    function asset_view($id){
        $this->db->select('*');
        $this->db->from('asset_list_tbl');
        $this->db->where('asset_code',$id);
        $query = $this->db->get();
        return $query->result();
    }
    function asset_list($asset, $category){
        $data = array(
           'asset_code' => $asset ,
           'category_id' => $category
        );
        $this->db->insert('asset_list',$data);
        $id = $this->db->insert_id();
        return(isset($id))? $id: FALSE;
        //location.reload();
    }



    function list_assets($id){
        $this->db->select('asset_details');
        $this->db->from('asset_list_tbl');
        $this->db->where('category_id',$id);
        $query = $this->db->get();
        return $query->result();

    }
    
    function asset_code_view($id){
        $this->db->select('*');
        $this->db->from('asset_list_tbl');
        $this->db->where('asset_code',$id);
        $query = $this->db->get();
        return $query->result();

    }


    function update_asset($data,$id){
        $this->db->where('id', $id);
        return $this->db->update('asset_list_tbl', $data); 

    }


    function asset_code_exist($asset_code){
        $this->db->where('asset_code',$asset_code);
        $this->db->from('asset_list_tbl');
        $query = $this->db->get();
        if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }

    }

    function delete_asset($id){        
        $this->db->where('id', $id);
        $this->db->delete('asset_list_tbl');

    }

}  