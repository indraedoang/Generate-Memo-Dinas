<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
* indra setiawan 
* author indrasetiawan0103gmail.com 
* Memo Dinas
* 07 Febuari 2020
*/
class Mega extends CI_Controller {
	function __construct()
	{
		parent::__construct(); 
		$this->load->model("M_generate","mGenerate");
		$this->load->model("M_memoDinas","mMemo");
		$this->template->use_layout('view');
		_at('role',current_user('role'));
	}
	function index($modul="")
	{
		// print_r(date('y')); die();
		$modul = defog($modul);
		if (empty($modul)) {
			failed_message("Access Denied, Please call admin ","");
		}
		$masterModul  = $this->mGenerate->get(array("id" => $modul),'modul',TRUE);	
		if (!empty($_FILES['dokument']['name'])) 
		{
			foreach ($_FILES as $key => $value) 
			{
				$config['upload_path'] = "content/";
				$config['allowed_types'] = 'pdf|docx|jpg|png|xlsx|csv|xls';
				$data2  = $this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload(($key)))
				{
					$result = array('status' => 0, 'error' => $this->upload->display_errors());
				}
				else
				{
					$result = array('status' => 1, 'upload_data' => $this->upload->data());
				}
				if ($result['status'] == '1') 
				{
					$input['document'] = @$result['upload_data']['file_name'];
				}
				else{
					failed_message("Your request was not sent, Unregistered Document Format ","");
				}
			}
		}

		if ($_POST) {	
			$data['no_md']			= $this->mGenerate->format_no_memo($modul);
			$data['user_id'] 		= flow_user('user_id');
			$data['perihal']		= $_POST['perihal'];
			$data['tujuan']			= $_POST['tujuan'];
			$data['keterangan']		= $_POST['keterangan'];
			$data['tgl_request']	= date('Y-m-d');
			$data['modul']			= $modul;
			$data['status']			= '1';
			$data['dokument']		= !isset($input) ? '' : $input['document'];
			$data['dept_id']		= get_department_id();
			$save = $this->mGenerate->save($data,'memodinas');
			$id_memo = $this->db->insert_id();
			if ($save) 
			{
			 	failed_message("Generate Memo Dinas Successfully","/request/mega/show/".fogit($id_memo)."");
			} 	
		}
		_at("masterModul",$masterModul->nama);
		_at("modul",$modul);
		render();
	}

	function show($id_memo)
	{
		$id_memo = defog($id_memo);
		$MasterMemo = $this->mGenerate->get(array("id" => $id_memo),'memodinas',TRUE);
		_at("MasterMemo",$MasterMemo);
		render();
	}

	function memodinas($modul='')
	{
		$modul = defog($modul);
		$master = $this->mMemo->GetMemo($modul);

		if (!empty($master)) {
			foreach ($master as $key => $value) {
				$data[$key]['no']  			= $key+1;
				$data[$key]['no_md']		= "<a href='".base_url()."request/mega/show/".fogit($value->id)."'>".$value->no_md." </a>" ;
				// $data[$key]['modul']		= $value->modul;
				$data[$key]['perihal']		= $value->perihal;
				$data[$key]['tujuan']		= $value->tujuan;
			}
			$datatable = array_merge($data);
			_datatable_fixed_col($data);	
			_at('datatable',$datatable);
		}
		_at('modul',$modul);
		render();
	}

	function adminDasfboard($dept_id='')
	{
		$dept_id = defog($dept_id);
		$MasterMemo = $this->mGenerate->get(array("dept_id" => $dept_id),'memodinas');
		if (!empty($MasterMemo)) {
			foreach ($MasterMemo as $key => $value) {
				$data[$key]['no']  			= $key+1;
				$data[$key]['no_md']		= "<a href='".base_url()."request/mega/show/".fogit($value->id)."'>".$value->no_md." </a>" ;
				$data[$key]['modul']		= getModul($value->modul);
				$data[$key]['deptartment']	= get_department_name($value->dept_id);
				$data[$key]['perihal']		= $value->perihal;
				$data[$key]['tujuan']		= $value->tujuan;
			}
			$datatable = array_merge($data);
			_datatable_fixed_col($data);	
			_at('datatable',$datatable);
		}
		_at("dept_id",$dept_id);
		render();
	}

// EOF
}