<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
* indra setiawan 
* author indrasetiawan0103gmail.com 
* fix asset management
* 06 APRIL 2018
*/
class Generator extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model("M_generate","mGenerate"); 
		$this->template->use_layout('view');
		_at('role',current_user('role'));
	}
	function index($table="",$id="", $action="")
	{
		if (!empty($id)) {
			$id = defog($id);
		}
		if ($_POST) {
			$input['department'] = $_POST['nama'];
			$input['singkatan']	 = $_POST['singkatan'];
			if (!empty($id)) {
				$save = $this->mGenerate->update($input,$id,'department');
			}else{
				$save = $this->mGenerate->save($input,'department');
				
			}

			if ($save) {
			failed_message("Data Successfully Saved","/admin/Generator/index/department");
			}
		}

		if (!empty($action)) {
			$action = defog($action);
			$delete = $this->mGenerate->delete($id,'department');
			if ($delete) {
				failed_message("Data Successfully Deleted","");
			}
		}

		if (!empty($id)) {
			$getMaster = $this->mGenerate->get(array("id" => $id),'department',TRUE);
			_at("id",$id);
			_at("MasterData",$getMaster);
		}

		$masterdata  = $this->mGenerate->get(array(),'department');	
		if (!empty($masterdata)) {
			foreach ($masterdata as $key => $value) {
				$data[$key]['no'] 	= $key+1;
				$data[$key]['nama']	= $value->department;
				$data[$key]['singkatan'] = $value->singkatan;
				$data[$key]['action'] = '<a href="'.base_url().'admin/Generator/index/department/'.fogit($value->id).'"> <i class="fa fa-edit"> </i> </a>  <a href="'.base_url().'admin/Generator/index/department/'.fogit($value->id).'/'.fogit("delete").'"> <i class="fa fa-trash"> </i> </a>';
			}
			$datatable = array_merge($data);
			_datatable_fixed_col($data);	
			_at('datatable',$datatable);
		}
		render();
	}

	function user()
	{
		if ($_POST) {
			// save user 
				$user['nik']			= $_POST['nik'];
				$user['full_name']		= $_POST['full_name'];
				$user['department_id']  = $_POST['department_id'];
				$user['extension']		= $_POST['extension'];
				$user['status']			= '1';
				$save = $this->mGenerate->save($user,'user');
				$id_user = $this->db->insert_id();
			// save login
				$login['user_id']	= $id_user; 
				$login['username']  = $_POST['username'];
				$login['password']  = md5($_POST['password']);
				$login['role_id']	= $_POST['role_id'];
				$this->mGenerate->save($login,'login');

			if ($save) {
				failed_message("Data Successfully Saved","admin/Generator/user");	
			}
		}

		$MasterUSer = $this->mGenerate->get(array(),'user');
		if (!empty($MasterUSer)) {
			foreach ($MasterUSer as $key => $value) {
				$getDept = $this->mGenerate->get(array("id" => $value->department_id),'department',TRUE);
				$data[$key]['no'] = $key+1;
				$data[$key]['nik']	= $value->nik;
				$data[$key]['full_name']	= $value->full_name;
				$data[$key]['department'] 	= empty($value->department_id) ? '' : $getDept->department;
				$data[$key]['extension']	= $value->extension;
				$data[$key]['status']		= $this->status($value->status);
				$data[$key]['Action']		= '<a href="'.base_url().'admin/Generator/change_password/'.fogit($value->id).'"> <i class="fa fa-key"> </i> </a> ';
			}
			$datatable = array_merge($data);
			_datatable_fixed_col($data);	
			_at('datatable',$datatable);
		}
		_at('department',$this->mGenerate->get(array(),'department'));
		_at('role',$this->mGenerate->get(array(),'role'));
		render();
	}

	function change_password($id_user='')
	{
		$id_user = defog($id_user);
		if ($_POST) {
			$data['password'] = md5($_POST['password']);
			$update = $this->mGenerate->update($data,$id_user,'login');
			if ($update) {
				failed_message("Password Successfully Updated","");
			}
		}
		_at("id_user",$id_user);
		render();
	}

	function status($status)
	{
		switch ($status) {
			case '1':
				$result = "Aktif";
				break;
			case '2':
				$result = "None Aktif";
				break;
			
			default:
				$result = "None Aktif";
				break;
		}
		return $result;
	}

// EOF
}