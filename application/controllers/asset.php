<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Asset extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('manage_model');
	}
	
	/*
	function index() {
		 redirect('das');
	}*/
	function add_category(){
		//if(isset($_POST['category_name'])) {
		$this->form_validation->set_rules('category_name', 'Category Name', 'xss_clean');
		if($this->form_validation->run() == true) {
			
			$this->manage_model->add_category($_POST);

			$this->data['message'] = $this->session->set_flashdata('message','<div class="alert  alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Added successfully.</div>');
		 	redirect(base_url().'asset/add_category');
		}
		else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->session->flashdata('message')));
			   
			$this->load->view('add_category_view',$this->data);
		}
	}

	function search_category(){

		$val = $this->input->post('val');
		
		$data = $this->manage_model->category_view($val);
		echo json_encode($data);
	}
	function category_details($id){
		$i = base64_decode($id);
		$i = base64_decode($i); 
		//echo $i;
	
		
		$data['record'] = $this->manage_model->indv_category($i);
		//echo json_encode($data['record']);
		$this->load->view('category_details_view',$data);
	}
	function list_category(){

		$this->load->model("manage_model");
		$data = $this->manage_model->category_list();

		$str = json_encode($data);
		$str = '{ "aaData": '. $str . '}';
		echo $str;

	}
	

	function delete_category(){
		
		$id = $this->input->post('id');
		//echo $id; die();
		$this->manage_model->delete_category($id);
	}

	function view_category_field(){
		$id = $this->input->post('id');
		//echo $id;
		$records = $this->manage_model->category_field_view($id);
		/*$name = "";
		$type = "";
		$value = "";*/
		$output_string = "<form class=\"form-horizontal\" id=\"edit_category_field\" method=\"POST\" action=\"\">";
		$output_string .= "<fieldset>";
		foreach ($records as $row) {
			$name = $row->category_field_name;
			$type = $row->category_field_type;
			$value = $row->category_field_default; 
		}
		$output_string .= "<div class=\"control-group\">";
		$output_string .= "<label class=\"control-label\">Detail name</label>";
        $output_string .= "<div class=\"controls\">";
        $output_string .= "<input type=\"text\" name=\"edit_detail_name\" id=\"edit_detail_name\" value=\"".$name."\">";
        $output_string .= "</div>";
        $output_string .= "</div>";

        $output_string .= "<div class=\"control-group\">";
        $output_string .= "<label class=\"control-label\">Detail type</label>";
        $output_string .= "<div class=\"controls\">";
        $output_string .= "<select name=\"edit_detail_type\">";
        $output_string .= "<option value=\"\"></option>";
        $output_string .= "<option value=\"text\"";
        if($type == "text"){ $output_string .= "selected";}
        $output_string .= ">text</option>";
        $output_string .= "<option value=\"select\" ";
        if($type == "select"){ $output_string .= "selected";}
        $output_string .= ">select</option>";
        $output_string .= "</select>";
        $output_string .= "</div>";
        $output_string .= " </div>";

        $output_string .= "<div class=\"control-group\" id=\"default_values\">";
        $output_string .= "<label class=\"control-label\">Default Values</label>";
        $output_string .= "<div class=\"controls\">";
        $output_string .= "<input type=\"text\" name=\"edit_detail_values\">";
        $output_string .= "<span class=\"help-block\">Separate values by comma(s). e.g.: asset code, capacity</span>";
        $output_string .= "</div>";
        $output_string .= "</div> ";
        $output_string .= "";
        $output_string .= "";

		$output_string .= "</fieldset>";
		$output_string .= "</form>";
		$this->output->set_output(json_encode($output_string));
	

	}
	function delete_category_field(){
		$id = $this->input->post('id');
		$this->manage_model->delete_category_field($id);
	}

	function add_category_details() {

		$this->load->model("manage_model");
		$this->manage_model->add_category_details($_POST);
		//$this->category_details(base64_encode(base64_encode($_POST['category_id'])));
		$id = base64_encode(base64_encode($_POST['category_id']));
		redirect(base_url().'asset/category_details/'.$id);
	}

	function add_asset(){

		if($this->session->userdata('is_logged_in')){
			
			$this->data['message'] = $this->session->flashdata('message');
			$this->data['records'] = $this->manage_model->category_list();
	 		$this->load->view('addasset_view',$this->data);
		}

		else 
		{
			$this->load->view('login_view');
		}
	
	}

	function add_asset_form(){
		$asset_code = $this->input->post('asset_code');
		$category_id = $this->input->post('category_id');

		$array = $_POST;
		unset($array['category_id']);
		$list = "";
		foreach($array as $column => $data) {
		    $list .= $column .  splitter2 . $data .  splitter;
			//$list .= $data;
		}
		//echo $list;
		$data = array(
			'asset_code' => $asset_code,
			'category_id' => $category_id,
			'asset_details' => $list,
			'date_added' => date('Y-m-d H:i:s')
			);
		
		$this->manage_model->add_asset($data);
		$this->data['message'] = $this->session->set_flashdata('message','<div class="alert  alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Added successfully.</div>');
		redirect(base_url().'asset/add_asset');
		/*
		foreach($_POST as $column => $data) {
		    echo $column, ' : ' , $data ,'<br>';
		}*/
	}

	function asset_form(){
		$id = $this->input->post('asset');
		
       
		$data = $this->manage_model->indv_category($id);
		$data2 = $this->manage_model->list_assets($id);

		//$data3 = array_values($this->manage_model->indv_category_field($id));
		$data3 = array();
		foreach ($data as $row) {
			$data3[] = $row->category_field_name;
		}
		if($data){
			$output_string['asset_form'] = "<form class=\"form-horizontal\" id=\"add_asset\" method=\"POST\" action=\"".base_url().'asset/add_asset_form'."\">";
			$output_string['asset_form'] .= "<fieldset>";
			$output_string['asset_form'] .= "<input type='hidden' name='category_id' value=".$id.">";
			foreach ($data as $row) {
				// id=\"'.$row->category_field_name.'\"
				$type = $row->category_field_type;
				$default = $row->category_field_default;
				$field1 = $row->category_field_name;
				$field = str_replace('_', ' ', $field1);
				$field = ucwords(strtolower($field));
				$output_string['asset_form'] .= "<div class=\"control-group\">";
					$output_string['asset_form'] .= "<label class=\"control-label\" for=\"".$field1."\">".$field."</label>";
					$output_string['asset_form'] .= "<div class=\"controls\">";
						if($type == "text"){
							$output_string['asset_form'] .= "<input type=\"text\" class=\"input-xlarge\" id=\"".$field1."\" name=\"".$field1."\" />";
						}
						if($type == "select"){
							//$string = str_replace(' ', '', $default);
							$val = explode(',', $default);
							$output_string['asset_form'] .= "<select id=\"select\" class=\"input-medium\" name=\"".$field1."\" >";
                         	$output_string['asset_form'] .= "<option value=\"\" title=\"null\">--Choose--</option>";
							for ($i = 0; $i < count($val); $i++) { 
								$output_string['asset_form'] .= "<option value=\"".$val[$i]."\">".$val[$i]."</option>";
							}
							
							$output_string['asset_form'] .= "</select>";

						}
					$output_string['asset_form'] .= "</div>";
				$output_string['asset_form'] .= "</div>";
				
			}
			$output_string['asset_form'] .= "<div class=\"form-actions\">";
	        $output_string['asset_form'] .= "<input type=\"submit\" class=\"btn btn-success\" value=\"Add Asset\"  id=\"search_category\"/>";
	        $output_string['asset_form'] .= "<input type=\"reset\" class=\"btn btn-default\" value=\"Reset\" />";
	        $output_string['asset_form'] .= "</div>";
			$output_string['asset_form'] .= "</fieldset>";
			$output_string['asset_form'] .= "</form>";

			$output_string['asset_table'] = "<table class='table table-striped table-bordered' id='table_asset'>";
			$output_string['asset_table'] .= "<thead><tr>";
				foreach ($data as $row) {
					$field1 = $row->category_field_name;
					$field = str_replace('_', ' ', $field1);
					$name = ucwords(strtolower($field));
					$output_string['asset_table'] .= "<th>"; 
					$output_string['asset_table'] .= $name; 
					$output_string['asset_table'] .= "</th>"; 
				}
			$output_string['asset_table'] .= "<th></th>";	
			$output_string['asset_table'] .= "</tr></thead>";


			$output_string['asset_table'] .= "<tbody>";
				foreach ($data2 as $row) {
					$details = $row->asset_details;
					$arr1 = explode(splitter,$details); 
					$output_string['asset_table'] .= "<tr>";
					for($i=0; $i < count($arr1);$i++) { 
						$arr2 = explode(splitter2,$arr1[$i]);
						if (in_array(trim($arr2[0]), $data3)) {
							$output_string['asset_table'] .= "<td>".$arr2[1]."</td>";
						}
						$output_string['asset_table'] .= "<td></td";
					}

					$output_string['asset_table'] .= "</tr>";
				}
			$output_string['asset_table'] .= "</tbody>";
			$output_string['asset_table'] .= "</table>";
		}
		else{
			$output_string['asset_form'] = "<div class=\"alert\">
							  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
							  <strong>Warning!</strong> There is no category details.
							</div>";
		}
		
		
		//echo json_encode($output_string);
		$this->output->set_output(json_encode($output_string));
	}
	

	function modify_asset(){
		if($this->session->userdata('is_logged_in')){
			$this->load->view('modify_asset_view');
		}
		else{
			$this->load->view('login_view');
		}
	}

	function delete_asset(){
		if($this->session->userdata('is_logged_in')){
			$this->load->view('delete_asset_view');
		}
		else{
			$this->load->view('login_view');
		}
	}

	function list_assets(){
		
		$data = $this->manage_model->list_assets();

		$str = json_encode($data);
		$str = '{ "aaData": '. $str . '}';
		echo $str;
	}

	function asset_view(){
		$id = $this->input->post('id');
		/*$id = "OAM 000733";*/
		$data = $this->manage_model->asset_code_view($id);
		
		if($data){
			foreach ($data as $row) {
				$asset_id = $row->id;
			 	$category_id =  $row->category_id;
			}

			$data2 = $this->manage_model->indv_category($category_id);
			$data3 = array();
			/*foreach ($data2 as $row) {
				$data3[] = $row->category_field_name;
			}*/
			
			$output_string = "<form class=\"form-horizontal\" id=\"update_asset\" method=\"POST\" action=\"\"";
			$output_string .= "<fieldset>";
			unset($data2[0]);
			/*echo "<pre>";
			print_r($data2);
			echo "</pre>";*/
			foreach ($data2 as $row) {
				
				$type = $row->category_field_type;
				$default = $row->category_field_default;
				$field1 = $row->category_field_name;
				$field = str_replace('_', ' ', $field1);
				$field = ucwords(strtolower($field));

				$data3[] = $field1;
				//var_dump($data3);
				$output_string .= "<input type='hidden' name='asset_id' value='".$asset_id."'>";
				$output_string .= "<input type='hidden' name='asset_code' value='".$id."'>";
				$output_string .= "<div class=\"control-group\">";
					$output_string .= "<label class=\"control-label\" for=\"".$field1."\">".$field."</label>";
					$output_string .= "<div class=\"controls\">";
						if($type == "text"){
							$output_string .= "<input type=\"text\" class=\"input-xlarge\" id=\"".$field1."\" name=\"".$field1."\" value =\"";
							foreach ($data as $row) {
								$details = $row->asset_details;
								$arr1 = explode(splitter,$details); 
								for($i=0; $i < count($arr1);$i++) { 
									$arr2 = explode(splitter2,$arr1[$i]);
									if (in_array(trim($arr2[0]), $data3)) {
										$output_string .= $arr2[1];	
									}
								}	
							}
							$output_string .= "\" />";
						}
						if($type == "select"){
							foreach ($data as $row) {
								$details = $row->asset_details;
								$arr1 = explode(splitter,$details); 
								for($i=0; $i < count($arr1);$i++) { 
									$arr2 = explode(splitter2,$arr1[$i]);
									if (in_array(trim($arr2[0]), $data3)) {
										$select = $arr2[1];
									}
								}
							}
							$val = explode(',', $default);
							$output_string .= "<select id=\"select\" class=\"input-medium\" name=\"".$field1."\" >";
	                     	$output_string .= "<option value=\"\" title=\"null\">--Choose--</option>";
							for ($i = 0; $i < count($val); $i++) {
							    $val2 = $val[$i]; 
								$output_string .= "<option value=\"".$val2."\" ";
								if($val2 == $select){
									$output_string .= "selected";
								}
								$output_string .=">".$val2."</option>";
							}
				
							$output_string .= "</select>";
						}
					$output_string .= "</div>";
				$output_string .= "</div>";
				
				$data3 = null;
			}
			$output_string .= "<div class=\"form-actions\">";
	        $output_string .= "<input type=\"submit\" class=\"btn btn-success\" value=\"Update Asset\" />";
	        $output_string .= "</div>";
			$output_string .= "</fieldset>";
			$output_string .= "</form>";
		}
		else{
			$output_string = "<div class=\"alert\">
							  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
							  <strong>Warning!</strong> There is no result.
							</div>";
		}
	
		$this->output->set_output(json_encode($output_string));
	}

	function update_asset(){

		$asset_code = $this->input->post('asset_code');
		$id = $this->input->post('asset_id');

		$array = $_POST;
		unset($array['asset_id']);
		$list = "";
		foreach($array as $column => $data) {
		    $list .= $column .  splitter2 . $data .  splitter;
			//$list .= $data;
		}
		//echo $list;
		$data = array(
			'asset_code' => $asset_code,
			//'category_id' => $category_id,
			'asset_details' => $list,
			'date_updated' => date('Y-m-d H:i:s')
			);
		
		$this->manage_model->update_asset($data,$id);
		echo json_encode($_POST);
		//$this->manage_model->update_asset($data,$code);
		//echo $code;
	}
    
    function asset_value(){
    	$id = $this->input->post('id');
		//$id = "OAM 000733";
		$data = $this->manage_model->asset_code_view($id);
		if($data){
			foreach ($data as $row) {
				$asset_id = $row->id;
			 	$category_id =  $row->category_id;
			}

			$data2 = $this->manage_model->indv_category($category_id);
			$data3 = array();

			foreach ($data2 as $row) {
				$data3[] = $row->category_field_name;
			}
			$output_string = "";
			$output_string .= "<button class=\"btn btn-danger\" onclick=\"delete_asset('".$asset_id."')\">Delete Asset</button><br><br>";
			$output_string .= "<table class=\"table table-striped\" width=\"100%\">";
			$output_string .= "<colgroup>";
			$output_string .= "<col width=\"20%\">";
			$output_string .= "<col width=\"80%\">";
			$output_string .= "</colgroup>";

			foreach ($data as $row) {
				$details = $row->asset_details;
				$arr1 = explode(splitter,$details); 
				for($i=0; $i < count($arr1);$i++) { 
					$arr2 = explode(splitter2,$arr1[$i]);
					if (in_array(trim($arr2[0]), $data3)) {
						//echo $arr2[0] . " : ".$arr2[1] . "<br>";
						$field1 = $arr2[0];
						$field = str_replace('_', ' ', $field1);
						$name = ucwords(strtolower($field));
						$output_string .= "<tr>";
							$output_string .= "<td>".$name."</td>";
							$output_string .= "<td>".$arr2[1]."</td>";
						$output_string .= "</tr>";
							
					}
					
				}	
			}
			$output_string .= "</table>";


		}
		else{
			$output_string = "<div class=\"alert\">
							  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
							  <strong>Warning!</strong> There is no result.
							</div>";
		}
	
		$this->output->set_output(json_encode($output_string));
    }

    function delete_asset_exec(){
    	$id = $this->input->post('id');
		$this->manage_model->delete_asset($id);

    }
	function asset_code_exist(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$asset_code = $this->input->post('asset_code');
			
			if ( $this->manage_model->asset_code_exist($asset_code) == TRUE ) {
		      echo json_encode(FALSE);
		    } else {
		      echo json_encode(TRUE);
	   	 	}

	   }
	   else {
		    header( 'Location: ../dashboard' );
		}
	
	}

	
}