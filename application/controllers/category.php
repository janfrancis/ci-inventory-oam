<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Category extends CI_Controller {

	function __construct() {

		parent::__construct();
		$this->load->model('manage_model');
	}


	public function asset_list($id='') {

		if($this->session->userdata('is_logged_in')){
			if($id){
				//echo $id;
				/*$data = $this->manage_model->list_assets($id);
				echo '<pre>';
				print_r($data);
				echo '</pre>';*/
				$this->data['records'] = $this->manage_model->category_list();	
				$data = $this->manage_model->indv_category($id);
				$data2 = $this->manage_model->list_assets($id);

				//$data3 = array_values($this->manage_model->indv_category_field($id));
				$data3 = array();
				foreach ($data as $row) {
					$data3[] = $row->category_field_name;
				}

				$this->data['asset_table'] = "<table class='table table-striped table-bordered' id='table_asset'>";
				$this->data['asset_table'] .= "<thead><tr>";
					foreach ($data as $row) {
						$field1 = $row->category_field_name;
						$field = str_replace('_', ' ', $field1);
						$name = ucwords(strtolower($field));
						$this->data['asset_table'] .= "<th>"; 
						$this->data['asset_table'] .= $name; 
						$this->data['asset_table'] .= "</th>"; 
					}
				$this->data['asset_table'] .= "<th></th>";	
				$this->data['asset_table'] .= "</tr></thead>";
				$this->data['asset_table'] .= "<tbody>";
				foreach ($data2 as $row) {
						$details = $row->asset_details;
						$arr1 = explode(splitter,$details); 
						$this->data['asset_table'] .= "<tr>";
						for($i=0; $i < count($arr1);$i++) { 
							$arr2 = explode(splitter2,$arr1[$i]);
							if (in_array(trim($arr2[0]), $data3)) {
								$this->data['asset_table'] .= "<td>".$arr2[1]."</td>";
							}
							$this->data['asset_table'] .= "<td></td";
						}

						$this->data['asset_table'] .= "</tr>";
					}
				$this->data['asset_table'] .= "</tbody>";
				$this->data['asset_table'] .= "</table>";

				//echo $this->data['asset_table'];
				$this->load->view('indv_category_list_view',$this->data);
			}
			else
			{
				redirect(base_url().'dashboard');
			}
			//echo $id;
			
		}
		else 
		{
			$this->load->view('login_view');
		}
	}
	
}

/* End of file authenticate.php */
/* Location: ./application/controllers/auth/verify_user.php */