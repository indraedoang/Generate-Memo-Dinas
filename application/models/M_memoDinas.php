<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* indra setiawan 
* author indrasetiawan0103gmail.com 
* Memo Dinas
* 07 Febuari 2020
*/

class M_memoDinas extends CI_Model
{
    function __construct()
    {
        parent::__construct();
         $this->pri_index   = 'id';
    }

    function dashboardDatatable($modul="")
    {
        $this->db->select("*");
        $this->db->from("memodinas");
        $this->db->order_by("id","desc");
        $this->db->where("user_id = '".flow_user('user_id')."' ");
        $this->db->limit("5");
        $query  = $this->db->get();
        $result =  $query->result();
        return $result;
    }

    function count_memodinas($modul="")
    {
        $this->db->select("COUNT(id) as jum");
        $this->db->from("memodinas");
        $this->db->where("modul = '".$modul."' ");
        $this->db->where("user_id = '".flow_user('user_id')."' ");
        $query  = $this->db->get();
        $result =  $query->result();
        return array_shift($result);
    }

    function count_SuratKeluar($modul="")
    {
        $this->db->select("COUNT(id) as jum");
        $this->db->from("memodinas");
        $this->db->where("modul = '".$modul."' ");
        $this->db->where("user_id = '".flow_user('user_id')."' ");
        $query  = $this->db->get();
        $result =  $query->result();
        return array_shift($result);
    }

    function GetMemo($modul='')
    {
        $this->db->select("*");
        $this->db->from("memodinas");
        $this->db->where("modul = '".$modul."' ");
        $this->db->where("user_id = '".flow_user('user_id')."' ");
        $query = $this->db->get(); 
        return $query->result();
    }


    function memodinas($modul)
    {
        $this->db->select("*");
        $this->db->from("memodinas");
        $this->db->where("modul = '".$modul."' ");
        $query = $this->db->get(); 
        return $query->result();
    }

    function count_dashboard($value='')
    {
        $this->db->select("count(id) as jumlah,dept_id");
        $this->db->from("memodinas");
        $this->db->group_by("dept_id");
        $query = $this->db->get(); 
        return $query->result();
    }

   

// EOF
}