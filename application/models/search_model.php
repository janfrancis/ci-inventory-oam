<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model{

    function __construct() {

        parent::__construct();
    }

    public function search_asset($input)
    {
    	$query = $this->db->query('SELECT * FROM asset_list_tbl LEFT JOIN category_tbl ON category_tbl.category_id=asset_list_tbl.category_id WHERE asset_code="'.trim($input['search']).'"');
    	$data = $query->result();
	    if($input['is_advance']=='inactive') {	
	    	if(count($data) == 0) {
	    		$search = preg_replace( '/\s+/', ' ', $input['search']);
	    		$search_array = explode(" ", $search);
	    		$count = count($search_array);
	    		$like = "";
	    		$or = "";
	    		for($i = 0; $i < $count; $i++) {
	    			if ($i != $count - 1 ) {
	    				$or = ' OR ';
	    			}
	    			else {
	    				$or = '';
	    			}
	    			$like .= ' asset_code LIKE "%'.$search_array[$i].'%" '.$or;
	    		}
	    		$query_string = 'SELECT alt.*,
				ct.category_name
				FROM asset_list_tbl alt 
				LEFT JOIN category_tbl ct
				ON ct.category_id = alt.category_id
				WHERE ';
	    		$query = $this->db->query($query_string.$like);
	    		$data = $query->result();
	    		return $data;
	    	}
	    	else {
	    		return $data;
	    	}
	    }
	    else {
	    	$like = "";
	    	$keyword = trim($input['keyword']);
	    	$brand = trim($input['brand']);
	    	$model = trim($input['model']);
	    	$location = trim($input['location']);
	    	$accountability = trim($input['accountability']);
	    	$search_array = array();
	    	if($keyword!='') {
	    		$search_array[] = ' asset_details LIKE "%'.$keyword.'%`*&*`%"';
	    	}
	    	if($brand!='') {
	    		$search_array[] = ' asset_details LIKE "%brand`&&`%'.$brand.'%`*&*`%"';
	    	}
	    	if($model!='') {
	    		$search_array[] = ' asset_details LIKE "%model`&&`%'.$model.'%`*&*`%"';
	    	}
	    	if($location!='') {
	    		$search_array[] = ' asset_details LIKE "%location`&&`%'.$location.'%`*&*`%"';
	    	}
	    	if($accountability!='') {
	    		$search_array[] = ' asset_details LIKE "%accountability`&&`%'.$accountability.'%`*&*`%"';
	    	}
	    	for ($i=0; $i < count($search_array); $i++) { 
	    		if ($i != count($search_array) - 1 ) {
    				$like .= $search_array[$i].' AND ';
    			}
    			else {
    				$like .= $search_array[$i].'';
    			}
	    	}	
	    	$query_string = "SELECT al.asset_code, al.asset_details, ct.category_name FROM asset_list_tbl al LEFT JOIN category_tbl ct ON al.category_id = ct.category_id WHERE ";
			$query_string .= $like;
			//die($query_string);
			$query = $this->db->query($query_string);
			return $query->result();

	    }
    }
}
