<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('home');
	}

	public function search()
	{
		$this->load->model('search_model');
		$data = $this->search_model->search_asset($_POST);
		$response = "";
		$search_query = array();
		foreach ($data as $row) {
			$search_query[] = explode('`*&*`',$row->asset_details.'category_name`&&`'.$row->category_name.'`*&*`');
		}
		$response .= '<div class="alert alert-success"><center>'.count($search_query).' record(s) found.</center></div>';
		$response .= '<table class="table table-striped"><thead>';
		
		for ($i=0; $i < count($search_query); $i++) {
			//$response .= '<div class="well">';
			$response .= '<tr>';
			for ($j=0; $j < count($search_query[$i]) - 1; $j++) {
				$sub_search = explode('`&&`',$search_query[$i][$j]);
				$field1 = $sub_search[0];
				$field = str_replace('_', ' ', $field1);
				$name = ucwords(strtolower($field));
				if($sub_search[0]!='asset_code'&&
					$sub_search[0]!='brand'&&
					$sub_search[0]!='model'&&
					$sub_search[0]!='serial'&&
					$sub_search[0]!='location'&&
					$sub_search[0]!='category_name') continue;
				else
				$response .= '<th>'.$name.'</th>';
				
			}
			$response .= '</tr>';
			break;
		}
		$response .= '</thead><tbody>';

		for ($i=0; $i < count($search_query); $i++) {
			//$response .= '<div class="well">';
			$response .= '<tr>';
			for ($j=0; $j < count($search_query[$i]) - 1; $j++) {
				$sub_search = explode('`&&`',$search_query[$i][$j]);
				$field1 = $sub_search[0];
				$field = str_replace('_', ' ', $field1);
				$name = ucwords(strtolower($field));
				/*if($sub_search[0]=='asset_code') {
					$response .= '<b>'.$name.'</b> : <a  data-toggle="modal" onclick="showDetails('.$i.');" href="#myModal" role="button"><u>'.$sub_search[1].'</u></a><br>';
					continue;
				}*/
				if($sub_search[0]!='asset_code'&&
					$sub_search[0]!='brand'&&
					$sub_search[0]!='model'&&
					$sub_search[0]!='serial'&&
					$sub_search[0]!='location'&&
					$sub_search[0]!='category_name') continue;
				if($sub_search[0]=='asset_code')
				{
					$response .= '<td><a  data-toggle="modal" onclick="showDetails('.$i.');" href="#myModal" role="button"><u>'.$sub_search[1].'</u></a></td>';
				}
				else {
					$response .= '<td>'.$sub_search[1].'</td>';
				}
			}
			$response .= '</tr>';
			
		}

		$response .= '</tbody></table>';
		echo $response;
	}
	public function search_details() {
		$this->load->model('search_model');
		$data = $this->search_model->search_asset($_POST);
		$response = "";
		$search_query = array();
		foreach ($data as $row) {
			$search_query[] = explode('`*&*`',$row->asset_details.'category_name`&&`'.$row->category_name.'`*&*`');
		}
		for ($i=0; $i < count($search_query); $i++) {	
			if($_POST['id']!=$i) continue;
			$response .= '<span id="'.$i.'">';
			$response .= '<center><img src="'.base_url().'assets/images/300x3001.gif"></center><hr>';
			$response .= '<table class="table table-bordered table-striped">';
			for ($j=0; $j < count($search_query[$i]) - 1; $j++) {
				$sub_search = explode('`&&`',$search_query[$i][$j]);
				$field1 = $sub_search[0];
				$field = str_replace('_', ' ', $field1);
				$name = ucwords(strtolower($field));
				$response .= '<tr>';
				if($sub_search[0]=='asset_code') {
					$response .= '<td>'.$name.'</td><td>'.$sub_search[1].'</td></tr>';
					continue;
				}
				$response .= '<td>'.$name.'</td><td> '.$sub_search[1].'</td>';
				$response .= '</tr>';
			}
			$response .= '</table>';
			$response .= '</span>';
		}
		echo $response;

	}
}
