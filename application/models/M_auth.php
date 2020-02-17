<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* indra setiawan 
* author indrasetiawan0103gmail.com 
* Memo Dinas
* 07 Febuari 2020
*/
class M_auth extends CI_Model
{
    function __construct()
    {
        parent::__construct();
         $this->pri_index   = 'id';
         $this->auth        = 'login';
    }
    // update  

      function update(Array $data, $where = array(),$table=NULL) {
        if ($table !== NULL ) {
            $table = $this->$table;
        } else {
            $table = $this->auth;
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
       // get table

     function get($where = NULL,$table = NULL,$single=NULL) {
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
            $table = $this->auth;
        }

        $result = $this->db->get($table)->result();
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
    // end get table
        //save 
    function save(Array $data,$table = NULL) {

        if ($table !== NULL ) {
            $table = $this->$table;
        } else {
            $table = $this->unit;
        }

        if ($this->db->insert($table, $data)) {
            return true;
        } else {
            return false;
        } 
    }
    //end save 
    // delete
      function delete($where = array(),$table = NULL) {
        
        if ($table !== NULL ) {
            $table = $this->$table;
        } else {
            $table = $this->unit;
        }

        if (!is_array($where)) {
            $where = array($this->pri_index => $where);
        }
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    }
    // end delete

    function login_email($nik="")
    {
        $this->db->select('*');
        $this->db->from('t_user a');
        $this->db->join('t_auth b','a.id = b.user','LEFT');
        $this->db->where("a.nik = '".$nik."'");
        $query = $this->db->get(); 
        return $query->result();
    }

    function login($username="",$password="")
    {
        $data['username'] = $username;
        $data['password'] = $password;
        $login = $this->auth($data);
        if (!empty($login))
        {
            $this->session->set_userdata('current_user', $login);   
            $this->session->set_userdata('is_login', true);
            $this->session->flashdata('current_user', $login);
            return '1';
        }else
        {
            return '0';
        }
    }

    function auth($key)
    {
        $query = $this->db->get_where($this->auth, array('username' => $key['username'], 'password' => $key['password'] ), 1, 0);
        return $query->row();
    }
     function select($find='',$table='auth')
    {
        $query = $this->db->get_where($this->$table,$find);
        return $query->row();
    }
     function select_group_name($find='',$table='group_name')
    {
        $query = $this->db->get_where($this->$table,$find);
        return $query->row();
    }

     function select_group_id($find='',$table='group_id')
    {
        $query = $this->db->get_where($this->$table,$find);
        return $query->row();
    }

    function select_unit($where=NULL, $table=NULL,$select=NULL,$select_option=FALSE)
    {
        if ( $select !== NULL )
        {
            $this->db->select($select,$select_option);
        }
        return $this->get_unit($where,$table);
    }
    function select_user($where=NULL,$table=NULL,$select=NULL,$select_option=FALSE)
    {
        if ( $select !== NULL )
        {
            $this->db->select($select,$select_option);
        }
        return $this->get($where,$table);
    } 
}