<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
* indra setiawan 
* author indrasetiawan0103gmail.com 
* CMF ( Change Managament Form)
* 10 April 2017
*/
class Auth extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('M_auth', 'auth'); 
		$this->load->model('M_sso','mSso');
		$this->load->model("M_memoDinas","mMemo");
		$this->load->model("M_generate","mGenerate");
		$this->template->use_layout('view');
	}
	function index()
	{	
		redirect('http://10.20.81.188:81/memoDinas/');
		$memodinas = $this->mMemo->count_memodinas("1");
		_at('memodinas',$memodinas->jum);
		$suratKeluar = $this->mMemo->count_SuratKeluar("2");
		_at('suratKeluar',$suratKeluar->jum);
		// dashboard admin
		$databoard_admin = $this->mMemo->count_dashboard();
		// print_r($databoard_admin); die();
		_at("dashboard_admin",$databoard_admin);
		$datatable = $this->mMemo->dashboardDatatable();
		if (!empty($datatable)) {
			foreach ($datatable as $key => $value) {
				$data[$key]['no']  = $key+1;
				$data[$key]['no_md']		= "<a href='".base_url()."request/mega/show/".fogit($value->id)."'>".$value->no_md." </a>" ;
				$data[$key]['modul']		= getModul($value->modul);
				$data[$key]['perihal']		= $value->perihal;
				$data[$key]['tujuan']		= $value->tujuan;
				$data[$key]['date_request'] = date('d M Y',strtotime($value->tgl_request));
			}
			$datatable = array_merge($data);
			_datatable($data);	
			_at('datatable',$datatable);
		}
		render();
	}

	function auth()
	{
		if ($_POST){
			$_POST = _post_clean();
		    $data['username'] = _post_clean('USER_ID');
		    $data['password'] = md5($_POST['USER_PASSWORD']);
			$login = $this->auth->auth($data);
		   	if ($login)
		    {
			$this->session->set_userdata('current_user', $login);	
			$this->session->set_userdata('is_login', true);
			$this->session->flashdata('current_user', $login);
			redirect('');
		    }
		    else 
		    {
		    	failed_message("Sorry, NIK and Password doesn't match.", '');
		    }
			 // koneksi ke usermaster  
			// $_POST = _post_clean();
		 //    $data['USER_ID'] = _post_clean('USER_ID');
		 //    $data['USER_PASSWORD'] = $_POST['USER_PASSWORD'];
			// $login = $this->mSso->validate($data);
		 //    if ($login)
		 //    {
			// $this->session->set_userdata('current_user', $login);	
			// $this->session->set_userdata('is_login', true);
			// $this->session->flashdata('current_user', $login);
			// redirect('');
		 //    }
		 //    else 
		 //    {
		 //    	failed_message("Sorry, NIK and Password doesn't match.", '');
		 //    }
		}
	} 

	function change_password()
	{
		if ($_POST) {
			$data['password'] = md5($_POST['password']);
			$update = $this->mGenerate->update($data,flow_user('id'),'login');
			if ($update) {
				failed_message("Password Successfully Updated","");
			}
		}
		render();
	}

	function logout()
	{
		$this->session->set_userdata('is_logged_in', false);
		$this->session->set_userdata('is_update_in', false);
		$this->session->set_userdata('current_user', false);
		$this->session->sess_destroy();
		redirect();
	}


// EOF
}