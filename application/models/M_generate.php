<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* indra setiawan 
* author indrasetiawan0103gmail.com 
* Memo Dinas
* 07 Febuari 2020
*/

class M_generate extends CI_Model
{
    function __construct()
    {
        parent::__construct();
         $this->pri_index   = 'id';
    }
    function save(Array $data,$table = NULL) {
        $this->{$table} = $table;
        if ($table !== NULL ) {
            $table = $this->$table;
        } else {
            $table = $this->{$table};
        }
    
        if ($this->db->insert($table, $data)) {
            return true;
        } else {
            return false;
        } 
    } 
    // end save
    // get
    function get($where = NULL,$table = NULL,$single=NULL) {
        $this->{$table} = $table;
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where($this->pri_index, $where);
            }
        }
        if ($table !== NULL ) {
            $table = $this->$table;
        } else {
            $table = $this->{$table};
        }
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        $result = $query->result();
        if ($result) {
            if ($single !== NULL) {
                return array_shift($result);
            } else {
                return $result;
            }
        } else {
            return false;
        }
    }
    // end get 
    // update
    function update(Array $data, $where = array(),$table=NULL) {
        $this->{$table} = $table;
        if ($table !== NULL ) {
            $table = $this->$table;
        } else {
            $table = $this->{$table};
        }

        if (!is_array($where)) {
            $where = array($this->pri_index => $where);
        }
        $this->db->update($table, $data, $where);
        $update = $this->db->affected_rows();
        if(!empty($update))
        {
            return true;
        } else {
            return false;
        }
    }
    // end update
    // select 
    function select($where=NULL, $table=NULL,$select=NULL,$select_option=FALSE)
    {
        if ( $select !== NULL )
        {
            $this->db->select($select,$select_option);
        }
        return $this->get($where,$table);
    }
    // end select

    // delete
     function delete($where = array(),$table = NULL) {
        $this->{$table} = $table;
        if ($table !== NULL ) {
            $table = $this->$table;
        } else {
            $table = $this->{$table};
        }

        if (!is_array($where)) {
            $where = array($this->pri_index => $where);
        }
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    }

    function getdataMemoDinas($dept_id="",$modul="")
    {
        $this->db->select('*');
        $this->db->from('memodinas');
        $this->db->where("dept_id = '".$dept_id."'");
        $this->db->where("modul = '".$modul."'");
        $this->db->where("YEAR(tgl_request) = '".date('Y')."'");
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function generate_memo_dinas($modul="")
    {

        $zero_padding = 4;
        $db = $this->getdataMemoDinas(get_department_id(),$modul);
        if ($db == FALSE) {
           $reference = 1;
        }else{
        $reference = 0;
            foreach ($db as $key ) {
                if ($modul == '1') {
                    $reference_db = substr($key->no_md, 6, $zero_padding);
                }else{
                    $reference_db = substr($key->no_md, 0, $zero_padding);
                }

                if ($reference_db > $reference)
                {
                    $reference = $reference_db+1;
                }
                // $reference++;
            }
        }
        while (strlen($reference) < $zero_padding)
        {
            $reference = "0" . $reference;
        }
        return $reference;
        // $dept =  $this->getSingkatan(); 
        // $memodinas = $reference." / ".$dept." / ".date('Y');
        // return $memodinas;
    }

    function format_no_memo($modul)
    {
        $dept       =  $this->getSingkatan();
        $reference  = $this->generate_memo_dinas($modul);
        switch ($modul) {
            case '1': // memo dinas 
                $result     ="MD. / ".$reference." / ".$dept." / ".date('y');
                break;
            case '2': // surat keluar
                $result = $reference." / BMS / ".$dept." / ".$this->romawiBulan(date('m'))." / ".date('y');
                break;
            
            default:
                $result     = $reference." / ".$dept." / ".date('Y');
                break;
        }
        return $result;
    }

    function romawiBulan($mounth='')
    {

        switch ($mounth) {
            case '01':
                $result= 'I';
                break;
            case '02':
                $result = 'II';
                break;
            case '03':
                $result = 'III';
                break;
            case '04':
                $result = 'IV';
                break;
            case '05':
                $result = 'V';
                break;
            case '06':
               $result = 'VI';
                break;
            case '07':
                $result = 'VII';
                break;
            case '08':
                $result = 'VIII';
                break;
            case '09':
                $result = 'IX';
                break;
            case '10':
                $result = 'X';
                break;
            case '11':
               $result = 'XI';
                break;
            case '12':
                $result = 'XII';
                break;
            default:
                $result = 'XX';
                break;
        }
        return $result;
    }

    function getSingkatan()
    {
        $user = $this->get(array("id" =>flow_user("user_id")),'user',TRUE);
        $dept = $this->get(array("id" => $user->department_id),'department',true);
        return $dept->singkatan;
    }

// EOF
}