<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* indra setiawan 
* author indrasetiawan0103gmail.com 
* Memo Dinas
* 07 Febuari 2020
*/
class M_sso extends CI_Model{
    function __construct(){
        parent::__construct();
         $this->pri_index 	  = 'id';
         $this->dbsso 		  = $this->load->database('dbsso', TRUE);
         // $this->load->model('M_generate', 'mGenerate');
    }
	public function update(Array $data, $where = array(),$table=NULL) {
        $this->{$table} = $table;
        if ($table !== NULL ) {
            $table = $this->$table;
        } else {
            $table = $this->{$table};
        }

        if (!is_array($where)) {
            $where = array($this->pri_index => $where);
        }
        $this->dbsso->update($table, $data, $where);
        $update = $this->dbsso->affected_rows();
        if(!empty($update))
        {
            return true;
        } else {
            return false;
        }
    }

    public function validate_session($data='')
    {
    	if (!empty($data)) {
			$this->dbsso->select("USER_IDX,NIK,FULL_NAME,EMAIL,GRADE,FOTO,USER_ID,USER_NAME,UNIT_ID,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME,GROUP_DESCRIPTION,USER_RECORDSTATUS,USER_PASSWORD, [dbo].[DECRYPT](user_id,user_password)as pass  ");
			$this->dbsso->FROM('tbl_mst_user');
			$this->dbsso->where("USER_IDX = '".$data."' ");
			$this->dbsso->where("USER_RECORDSTATUS != '3'");
			$cekUser = $this->dbsso->get(); 
	        $cekUser->result();
	        $result = $cekUser->row();
	        // print_r($result); die;
	        if (!empty($result)) {
	        	$row = $cekUser->row();
	        		 $data = array(
                    'USER_IDX' 			=> $result->USER_IDX,
                    'NIK'				=> $result->NIK,
                    'FULL_NAME'			=> $result->FULL_NAME,
                    'EMAIL'				=> $result->EMAIL,
                    'GRADE'				=> $result->GRADE,
                    'FOTO' 				=> $result->FOTO,
                    'USER_ID'			=> $result->USER_ID,
                    'USER_NAME' 		=> $result->USER_NAME,
                    'UNIT_ID' 			=> $result->UNIT_ID,
                    'DEPARTMENT_ID' 	=> $result->DEPARTMENT_ID,
                    'DIVISION_ID' 		=> $result->DIVISION_ID,
                    'BRANCHBSMI_ID' 	=> $result->BRANCHBSMI_ID,
                    'GROUP_NAME' 		=> $result->GROUP_NAME,
                    'GROUP_DESCRIPTION' => $result->GROUP_DESCRIPTION,
                    'USER_PASSWORD' 	=> $result->USER_PASSWORD,
                    'validated' 		=> true
                 );
	        	return $data;
	        }
	        return false;
    	}
    }

	public function validate($data=""){

		$USER_ID = $data['USER_ID'];
		$USER_PASSWORD = $data['USER_PASSWORD'];
		$this->dbsso->select("USER_IDX,NIK,FULL_NAME,EMAIL,GRADE,FOTO,USER_ID,USER_NAME,UNIT_ID,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME,GROUP_DESCRIPTION,USER_RECORDSTATUS,USER_PASSWORD, [dbo].[DECRYPT](user_id,user_password)as pass  ");
		$this->dbsso->FROM('tbl_mst_user');
		$this->dbsso->where("USER_ID = '".$USER_ID."' ");
		$this->dbsso->where("USER_RECORDSTATUS != '3'");
		$cekUser = $this->dbsso->get(); 
        $cekUser->result();
        $result = $cekUser->row();
    // echo "<pre>";    print_r($result); echo "</pre>";
    // echo "<pre>"; print_r($USER_PASSWORD); 
    //  die();
        if (!empty($result)) {
	        if ($USER_PASSWORD == $result->pass) {
	        	$row = $cekUser->row();
	        		 $data = array(
                    'USER_IDX' 			=> $result->USER_IDX,
                    'NIK'				=> $result->NIK,
                    'FULL_NAME'			=> $result->FULL_NAME,
                    'EMAIL'				=> $result->EMAIL,
                    'GRADE'				=> $result->GRADE,
                    'FOTO' 				=> $result->FOTO,
                    'USER_ID'			=> $result->USER_ID,
                    'USER_NAME' 		=> $result->USER_NAME,
                    'UNIT_ID' 			=> $result->UNIT_ID,
                    'DEPARTMENT_ID' 	=> $result->DEPARTMENT_ID,
                    'DIVISION_ID' 		=> $result->DIVISION_ID,
                    'BRANCHBSMI_ID' 	=> $result->BRANCHBSMI_ID,
                    'GROUP_NAME' 		=> $result->GROUP_NAME,
                    // 'GROUP_DESCRIPTION' => $result->GROUP_DESCRIPTION,
                    // 'USER_PASSWORD' 	=> $result->USER_PASSWORD,
                    'validated' 		=> true
                 );
	        	return $data;
	        }else{
	        	return false;
	        }
        }
        return false;
    }
	public function simpan_trx_session(){
		//simpan log
		$session = $this->session->userdata('current_user');
		$USER_ID 	= $session['USER_ID'];
		$correct_ip_address = $_SERVER['REMOTE_ADDR']; 
		$created_on = date('Y-m-d H:i:s');
		$data=array(
		'USER_ID'=>$USER_ID,
		'APP_ID'=>'Aplikasi RSS',
		'SESSION_WKIP'=>$correct_ip_address,
		'SESSION_STARTLOGIN'=>$created_on,
		'SESSION_LOGINFLAG'=>1		
		);
		$save = 	$this->dbsso->insert('tbl_trx_session',$data);		
	}
	public function destroy_trx_session(){
		$session = $this->session->userdata('current_user');
		$USER_ID 	= $session['USER_ID'];
		$correct_ip_address = $_SERVER['REMOTE_ADDR']; 
		$created_on = date('Y-m-d H:i:s');
		$data=array(
		'SESSION_ENDLOGIN'=>$created_on,
		'SESSION_LOGINFLAG'=>0	
		);
		$this->dbsso->where('USER_ID', $USER_ID);
		$this->dbsso->where('SESSION_LOGINFLAG', 1);
		$update = 	$this->dbsso->update('tbl_trx_session', $data); 
	}
	public function get($table="",$id="")
	{
		switch ($table) {
			case 'BRANCHBSMI_ID':
				$this->dbsso->select('BRANCHBSMI_IDX AS id, BRANCHBSMI_NAME as nama');
				$this->dbsso->from('tbl_mst_branchbsmi');
				if (!empty($id)) {
					$this->dbsso->where("BRANCHBSMI_IDX = '".$id."' ");
				}
				$query = $this->dbsso->get();
				$result = $query->result();
				if (!empty($id)) {
					return array_shift($result);
				}else{
					return $result;
				}
				break;
			case 'DEPARTMENT_ID':
				$this->dbsso->select('DEPARTMENT_ID AS id, DEPARTMENT_NAME as nama');
				$this->dbsso->from('tbl_mst_department');
				if (!empty($id)) {
					$this->dbsso->where("DEPARTMENT_ID = '".$id."' ");
				}
				$query = $this->dbsso->get();
				$result =  $query->result();
				if (!empty($id)) {
					return array_shift($result);
				}else{
					return $result;
				}
				break;
			case 'DIVISION_ID':
				$this->dbsso->select('DIVISION_ID AS id, DIVISION_NAME as nama');
				$this->dbsso->from('tbl_mst_division');
				if (!empty($id)) {
					$this->dbsso->where("DIVISION_ID = '".$id."' ");
				}
				$query = $this->dbsso->get();
				$result = $query->result();
				if (!empty($id)) {
					  $result=  array_shift($result);
				}else{
					 $result;
				}
				return $result;
				break;
			
			default:
				if (!empty($id)) {
					$result =  $this->mGenerate->get(array("id" => $id),'tbl_'.$table.'',TRUE);
					return $result;
				}else{
					return $this->mGenerate->get(array(),'tbl_'.$table.'');
				}
				break;
		}
	}

	public function branch($id="")
	{
		$this->dbsso->select('BRANCHBSMI_ID AS id, BRANCHBSMI_NAME as nama');
		$this->dbsso->from('tbl_mst_branchbsmi');
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function get_cabang($id="")
	{
		$this->dbsso->select('BRANCHBSMI_ID AS id, BRANCHBSMI_NAME as nama');
		$this->dbsso->from('tbl_mst_branchbsmi');
		$this->dbsso->where("BRANCHBSMI_ID = '".$id."' ");
		$query = $this->dbsso->get();
		$result = $query->result();
		return array_shift($result);
	}
	public function get_division($id="")
	{
		$this->dbsso->select('DIVISION_ID AS id, DIVISION_NAME as nama');
		$this->dbsso->from('tbl_mst_division');
		$this->dbsso->where("DIVISION_ID = '".$id."' ");
		$query = $this->dbsso->get();
		$result = $query->result();
		return array_shift($result);
	}
	public function get_all_division($value='')
	{
		$this->dbsso->select('DIVISION_ID,DIVISION_NAME,DIVISION_RECORDSTATUS');
		$this->dbsso->from('tbl_mst_division');
		$this->dbsso->where("DIVISION_RECORDSTATUS = '1' ");
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}
	public function get_department($id="")
	{
		$this->dbsso->select('DEPARTMENT_ID AS id, DEPARTMENT_NAME as nama');
		$this->dbsso->from('tbl_mst_department');
		$this->dbsso->where("DEPARTMENT_ID = '".$id."' ");
		$query = $this->dbsso->get();
		$result = $query->result();
		return array_shift($result);
	}

	public function get_department_name($id="")
	{
		$this->dbsso->select('DEPARTMENT_ID AS id, DEPARTMENT_NAME as nama');
		$this->dbsso->from('tbl_mst_department');
		$this->dbsso->where("DIVISION_ID = '".$id."' ");
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function get_detail_employee($id='')
	{
		$this->dbsso->select('*');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("USER_IDX = '".$id."' ");
		$query = $this->dbsso->get();
		$result = $query->result();
		return array_shift($result);
	}


	public function get_dept_head($dept="",$div="",$bracnh='')
	{
		$this->dbsso->select('*');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("DEPARTMENT_ID = '".$dept."' ");
		$this->dbsso->where("DIVISION_ID = '".$div."' ");
		$this->dbsso->where("BRANCHBSMI_ID = '".$bracnh."' ");
		$this->dbsso->where("GROUP_NAME = 'APP_1'");
		$query = $this->dbsso->get();
		$result = $query->result();
		return array_shift($result);
	}

	public function get_dept_head_ga($dept="",$div="",$bracnh='')
	{
		$this->dbsso->select('*');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("DEPARTMENT_ID = '".$dept."' ");
		$this->dbsso->where("DIVISION_ID = '".$div."' ");
		$this->dbsso->where("BRANCHBSMI_ID = '".$bracnh."' ");
		$this->dbsso->where("GROUP_NAME = 'APP_3'");
		$query = $this->dbsso->get();
		$result = $query->result();
		return array_shift($result);
	}

	public function get_div_head($div="",$bracnh="")
	{
		$this->dbsso->select('*');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("DIVISION_ID = '".$div."' ");
		$this->dbsso->where("BRANCHBSMI_ID = '".$bracnh."' ");
		$this->dbsso->where("GROUP_NAME = 'APP_2'");
		$query = $this->dbsso->get();
		$result = $query->result();
		return array_shift($result);
	}

	public function TM_ACL()
	{
		$this->dbsso->select('*');
		$this->dbsso->from('tbl_mst_user A');
		$this->dbsso->join('TM_ACL B','A.GROUP_NAME = B.GROUP_NAME','LEFT');
		$this->dbsso->where("A.GROUP_NAME = '".flow_user('GROUP_NAME')."'");
		$query = $this->dbsso->get();
		$result = $query->result();
		return array_shift($result);
	}

	public function sidebar()
	{
		$N_ID_APLIKASI  = TM_ACL('N_ID_APLIKASI');
		$N_Group_IDX 	= TM_ACL('N_Group_IDX');
		$this->dbsso->select('a.n_id_aplikasi,a.n_id_level,a.id_menu,b.order_id,b.nama_menu,b.url_menu,b.css_style,b.update_by,b.last_update,b.istatus,b.is_have_child');
		$this->dbsso->distinct();
		$this->dbsso->from('tm_acl_child a');
		$this->dbsso->join('tm_menu b','a.id_menu =b.id_menu','LEFT');
		$this->dbsso->join('tm_acl_group c','a.n_id_level = c.n_id_level','LEFT');
		$this->dbsso->join('tm_acl d','c.id_acl_group = d.id_acl','LEFT');
		$this->dbsso->where('1=1');
		$this->dbsso->where("a.N_ID_APLIKASI = '".$N_ID_APLIKASI."' ");
		$this->dbsso->where("a.istatus		  ='1' ");
		$this->dbsso->where("d.N_Group_IDX   ='".$N_Group_IDX."'");
		$this->dbsso->where("a.id_menu_child is null ");
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function parent_sidebar($parent_id="",$id_aplikasi="")
	{
		$N_Group_IDX 	= TM_ACL('N_Group_IDX');
		$this->dbsso->select('
			a.n_id_level
			,b.id_menu_child
			,b.parent_id
			,b.nama_menu
			,b.url_menu
			,b.css_style
			,b.update_by
			,b.last_update
			,b.istatus');
		$this->dbsso->from('tm_acl_child a');
		$this->dbsso->join('tm_menu_child b',' on a.ID_MENU_CHILD = b.ID_MENU_CHILD','LEFT');
		$this->dbsso->join('tm_acl_group c',' on a.n_id_level = c.n_id_level');
		$this->dbsso->join('tm_acl d',' c.id_acl_group = d.id_acl');
		$this->dbsso->where("b.parent_id='".$parent_id."'");
		$this->dbsso->where("a.n_id_aplikasi='".$id_aplikasi."' ");
		$this->dbsso->where("d.N_Group_IDX ='".$N_Group_IDX."' ");
		$this->dbsso->where("a.ID_MENU_CHILD > 0  ");
		$this->dbsso->where("a.istatus='1' ");
		$this->dbsso->order_by('b.id_menu_child',' ASC');
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function dept_get_user()
	{
		$this->dbsso->select('NIK,USER_IDX,USER_NAME,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("DEPARTMENT_ID = '".flow_user("DEPARTMENT_ID")."' ");
		$this->dbsso->where("DIVISION_ID = '".flow_user("DIVISION_ID")."' ");
		$this->dbsso->where("BRANCHBSMI_ID = '".flow_user("BRANCHBSMI_ID")."' ");
		$this->dbsso->where("GROUP_NAME = 'requester'");
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function direksi($nik="")
	{
		$this->dbsso->select('USER_IDX as id,USER_ID,USER_NAME as nama,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("GROUP_NAME = 'DIRECTORS' OR GROUP_NAME = 'APP_4' ");
		if (!empty($nik)) {
			$this->dbsso->where("USER_IDX = '".$nik."'");
		}
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function get_direksi($nik="")
	{
		$this->dbsso->select('USER_IDX as id,USER_ID,USER_NAME as nama,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME');
		$this->dbsso->from('tbl_mst_user');
		// $this->dbsso->where("GROUP_NAME = 'DIRECTORS' OR GROUP_NAME = 'APP_4' ");
		// if (!empty($nik)) {
			$this->dbsso->where("USER_IDX = '".$nik."'");
		// }
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function general_affair()
	{
		$this->dbsso->select('USER_ID,USER_NAME,UNIT_ID,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME,GROUP_DESCRIPTION');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("GROUP_NAME = 'APP_3'");
		$query = $this->dbsso->get();
		$result = $query->result();
		return array_shift($result);
	}

	public function pic()
	{
		$this->dbsso->select('USER_ID,USER_IDX,USER_NAME,UNIT_ID,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME,GROUP_DESCRIPTION,FULL_NAME');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("GROUP_NAME = 'PIC'");
		$this->dbsso->WHERE("DEPARTMENT_ID = '".flow_user('DEPARTMENT_ID')."' " );
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function get_pic()
	{
		$this->dbsso->select('USER_ID,USER_IDX,USER_NAME,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME,GROUP_DESCRIPTION,FULL_NAME');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("GROUP_NAME = 'PIC'");
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function get_division_ngad()
	{
		$this->db->select('code_division,division_id,division_name');
		$this->db->from('tbl_division_role');
		$this->db->where("id = '1'");
		$query = $this->db->get();
		// print_r($this->db->last_query()); die(); 
		$result = $query->result();
		return array_shift($result);
	}

	public function div_head_ga($division_id='')
	{
		$this->dbsso->select('USER_IDX,NIK,FULL_NAME,USER_ID,EMAIL,USER_NAME,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("GROUP_NAME = 'APP_4'");
		$this->dbsso->where("DIVISION_ID = '".$division_id."'");
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function divAkunting()
	{
		$this->dbsso->select('USER_IDX,NIK,FULL_NAME,USER_ID,EMAIL,USER_NAME,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("GROUP_NAME = 'Akunting'");
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function get_dept_head_it($department_id='')
	{
		$this->dbsso->select('USER_IDX,NIK,FULL_NAME,USER_ID,EMAIL,USER_NAME,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("GROUP_NAME = 'APP_3'");
		$this->dbsso->where("DEPARTMENT_ID = '".$department_id."'");
		$query = $this->dbsso->get();
		$result = $query->result();
		return array_shift($result);
	}

	public function get_divisi_head_it($divisi_id='')
	{
		$this->dbsso->select('USER_IDX,NIK,FULL_NAME,USER_ID,EMAIL,USER_NAME,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME');
		$this->dbsso->from('tbl_mst_user');
		$this->dbsso->where("GROUP_NAME = 'APP_4'");
		$this->dbsso->where("DIVISION_ID = '".$divisi_id."'");
		$this->dbsso->where("USER_RECORDSTATUS = '1'");
		$query = $this->dbsso->get();
		// print_r($this->dbsso->last_query()); die();
		$result = $query->result();
		return array_shift($result);
	}

	public function group_name($id="")
	{
		$this->dbsso->select('ID_ACL as id,Group_NAME,Group_DESCRIPTION as nama,N_ID_APLIKASI');
		$this->dbsso->from('TM_ACL');
		$this->dbsso->where("N_ID_APLIKASI = '7015'");
		if (!empty($id)) {
			$this->dbsso->where("ID_ACL = '".$id."'");
		}
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function get_employee_name($id="")
	{
		if (!empty($id)) {
			$this->dbsso->select('*');
			$this->dbsso->from('tbl_mst_user');
			$this->dbsso->where("USER_IDX = '".$id."'");
			$query = $this->dbsso->get();
			if(!empty($query)):
				$result = $query->result();
				return array_shift($result);
			endif;
		}
	}

	public function get_name_employee($nik="")
	{
		if (!empty($nik)) {
			$this->dbsso->select('*');
			$this->dbsso->from('tbl_mst_user');
			$this->dbsso->where("NIK = '".$nik."'");
			$query = $this->dbsso->get();
			$result = $query->result();
			return array_shift($result);
		}
	}

	public function get_group_name($nik="")
	{
		if (!empty($nik)) {
			$this->dbsso->select('*');
			$this->dbsso->from('tbl_mst_user');
			$this->dbsso->where("USER_IDX = '".$nik."'");
			$query = $this->dbsso->get();
			$result = $query->result();
			return array_shift($result);
		}
	}

	public function get_address_branch($BRANCHBSMIID="")
	{

		if (!empty($BRANCHBSMIID)) {
			$this->dwh_backup->SELECT('jdbr,jdname,jdaddr');
			$this->dwh_backup->FROM('jhdata');
			$this->dwh_backup->where("jdbr = '".$BRANCHBSMIID."'");
			$query = $this->dwh_backup->get();
			$result = $query->result();
			return array_shift($result);
		}
	}

	public function getAdress($value='')
	{
		if (!empty($value)) {
			$this->dwh_backup->SELECT('RMSNDCD AS id, RMNMBRN AS nama,RMADDR as address');
			$this->dwh_backup->FROM('RMSKNPAR2');
			$this->dwh_backup->where("RMSNDBNK = '".$value."'");
			$query = $this->dwh_backup->get();
			$result = $query->result();
			return $result;
		}
	}



	public function kotatujuan($value='')
	{
		if (!empty($value)) {
			$this->dwh_backup->SELECT('RMCTCD');
			$this->dwh_backup->FROM('RMSKNPAR2');
			$this->dwh_backup->where("RMSNDCD = '".$value."'");
			$query = $this->dwh_backup->get();
			$result = $query->result();
			return array_shift($result);
		}
	}

	public function code_bank()
	{
		$this->dbcms->SELECT('code_bank,nama_bank,desc_bank');
		$this->dbcms->FROM('tbl_mst_bank');
		$query = $this->dbcms->get();
		$result = $query->result();
		return $result;
	}

	public function Getbank($code_bank="")
	{
		$this->dbcms->SELECT('code_bank,nama_bank,desc_bank');
		$this->dbcms->FROM('tbl_mst_bank');
		$this->dbcms->where("code_bank ='".$code_bank."' ");
		$query = $this->dbcms->get();
		$result = $query->result();
		return array_shift($result);
	}

	public function get_employee_ga($value='')
    {
    	$this->dbsso->select('USER_IDX,USER_ID,USER_NAME');
    	$this->dbsso->from('tbl_mst_user');
    	// $this->dbsso->WHERE("DEPARTMENT_ID = '".flow_user('DEPARTMENT_ID')."'");
    	$this->dbsso->WHERE("DIVISION_ID = '".flow_user('DIVISION_ID')."'");
    	$this->dbsso->WHERE("BRANCHBSMI_ID = '".flow_user('BRANCHBSMI_ID')."' ");
    	$this->dbsso->WHERE("GROUP_NAME = 'PIC'");
    	$query = $this->dbsso->get();
    	// print_r($this->dbsso->last_query()); die;
		$result = $query->result();

		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$data[$key] = "'".$value->USER_IDX."'";
			}
			$DataUser = implode(',', $data);
			return $DataUser;
		}
    }

    public function get_kadiv($division="",$dept="")
    {
    	$this->dbsso->select('USER_IDX,NIK,FULL_NAME,USER_ID,EMAIL,USER_NAME,DEPARTMENT_ID,DIVISION_ID,BRANCHBSMI_ID,GROUP_NAME');
    	$this->dbsso->from('tbl_mst_user');
    	$this->dbsso->WHERE("DIVISION_ID = '".$division."'");
    	$this->dbsso->WHERE("DEPARTMENT_ID = '".$dept."'");
    	$this->dbsso->WHERE("GROUP_NAME = 'APP_3' ");
    	$query = $this->dbsso->get();
    	// print_r($this->dbsso->last_query()); die();
		$result = $query->result();
		// echo "<pre>"; print_r($result); echo "</pre>"; die();
		return array_shift($result);
    }

	public function get_grade()
	{
		$this->dbsso->select('*');
		$this->dbsso->from('tbl_mst_grade');
		$query = $this->dbsso->get();
		$result = $query->result();
		return $result;
	}

	public function get_data_email($id='')
	{
		if (!empty($id)) {
			$this->dbsso->select('USER_IDX,EMAIL');
			$this->dbsso->from('tbl_mst_user');
			$this->dbsso->WHERE("USER_IDX = '".$id."'");
			$query = $this->dbsso->get();
			$result = $query->result();
			return array_shift($result);
		}
	}

	public function post_data($data='')
    {
        $user_password 	= $data['USER_PASSWORD']; 
        $new_password   = $data['new_password'];
        $user_id        = $data['USER_ID'];
        $user_idx       = flow_user('USER_IDX');
        $result_udpdate=$this->dbsso->query("
                                UPDATE 
                                    tbl_mst_user 
                                            SET USER_PASSWORD = (select [dbo].[ENCRYPT] ('$new_password','$user_id') as pass from tbl_mst_user WHERE USER_IDX = '$user_idx' )
                                WHERE 
                                USER_IDX = '$user_idx'
                              ");
        return $result_udpdate;
    }


    public function FunctionName($value='')
    {
    			$USERKEY			=$a['USERKEY'];
				$MF_ESCROW			=$a['MF_ESCROW'];
				$NO_REK_DB			=$a['NO_REK_DB'];
				$POLIS_NO			=$a['POLIS_NO'];
				$TGL_USER_PAYMENT	=$a['TGL_USER_PAYMENT'];
				$NO_REFF			=$a['NO_REFF'];
				$AMOUNT_AWAL		=$a['AMOUNT'];
				$AMOUNT_ARRAY		= explode(".",$AMOUNT_AWAL);
				$AMOUNT				=$AMOUNT_ARRAY[0];
			
				
				$ID_AUTODEBET		= $a['ID_AUTODEBET'];
				$Potong				= substr($a['MF_ESCROW'],0,1);
				$NO_REK_DB_POT		= substr($a['NO_REK_DB'],5,10);
				$No_Rek 			= $Potong=="1"?"10000".$a['MF_ESCROW']:"20000".$a['MF_ESCROW'];
			
				$UserKey 			= $USERKEY;
				$KD_PERUSAHAAN 		= 'T099';
				$KD_PRODUK 			= 'T099';
				$MESSSTAT 			= '1';
				$MESSTYPE 			= '0200';
				$TRANSDATE 			= date("Ymd");
				$TRANSTIME 			= date("His");
				$REK_DEBT 			= $NO_REK_DB; // Norek Development debet ( no gl)
				$REK_CREDIT		 	= $No_Rek; // Norek Eskrow ( credit )
				$BIT3 	 			= '181000';
				$BIT4 	 			= STR_PAD($AMOUNT, 12, '0', STR_PAD_LEFT);
				$BIT7	 			= date("mdHis");
//				$BIT11	 			= rand(10000,99999);
				$BIT11	 			= rand(100000,999999);
				$BIT12 	 			= date("His");
				$BIT13   			= date("md");
				$BIT15   			= date("md");
				$BIT18 	 			= '6010';
				$BIT32 			 	= '506';
				$BIT37 	 			= STR_PAD(sprintf("%s%s",$BIT12,$no), 12, '0', STR_PAD_LEFT);
				$BIT42 	 			= '5066012999009';
				$BIT43 	 			= 'MENARA BANK MEGA SYARIAH              ID';
				$BIT49 			 	= '333';
				$BIT63   			= 'TRF';
				$RMK   	 			= sprintf("%s %s",$POLIS_NO,$NO_REFF);
				$BIT48 = STR_PAD($RMK, 50, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD("UIR", 10, ' ', STR_PAD_RIGHT);
				$BIT48 .= "1820008002  5        6        19       20       0        0        0        ";
				$BIT48 .= "0        0        0        0        0        0        0        0        ";
				$BIT48 .= "0        0        0        0        0        ";
				$BIT48 .= STR_PAD($REK_DEBT, 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD($AMOUNT, 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD($REK_CREDIT, 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD($AMOUNT, 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 .= STR_PAD('', 20, ' ', STR_PAD_RIGHT);
				$BIT48 = strlen($BIT48) . $BIT48;

				// remark tanya ke ga untuk transaksi asset di akunting

				
    }



// EOF
}
?>