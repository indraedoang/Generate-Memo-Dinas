<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* indra setiawan 
* author indrasetiawan0103gmail.com 
* bdd haji top up
* 19 agustus 2019
*/
    function is_login() {
        $that =& get_instance();
        $is_login = $that->session->userdata('is_login');
        if(!isset($is_login) || $is_login != true) {
            return false;
        }else{
            return true; }
    }
    function str_ucfrist($str)
    {
        return ucwords(str_replace(['_','-'], ' ', str_replace('cmf', 'CMF', $str)));
    }
    function str_strtolower($str)
    {
        return strtolower(str_replace([' ','_'], '_', $str));
    }
    function current_user($key=False)
    { 
        $that =& get_instance();
         if (!is_login()) return False;
        if ($key!==False) return (isset($that->session->userdata('current_user')->$key)) ? $that->session->userdata('current_user')->$key : FALSE ;
    }
    function flow_user($key=False)
    {
        $that =& get_instance();
        if (!is_login()) return False;
        $current = $that->session->userdata('current_user');
        return $current->$key;
    }
    function get_employee_name()
    {
        $that =& get_instance();
        $that->load->model("M_generate","mGenerate");
        $current = $that->session->userdata('current_user');
        $master = $that->mGenerate->get(array("id" => $current->user_id),'user',TRUE);
        return $master->full_name;
    }

    function  get_department_id()
    {
        $that =& get_instance();
        $that->load->model("M_generate","mGenerate");
        $dept = $that->mGenerate->get(array("id" => flow_user('user_id')),'user',TRUE);
        return $dept->department_id;
    }

    function get_department_name($id='')
    {
        $that =& get_instance();
        $that->load->model("M_generate","mGenerate");
        $dept = $that->mGenerate->get(array("id" => $id),'department',TRUE);
        return $dept->department;
    }

    function getModul($str)
    {
        $that =& get_instance();
        $that->load->model("M_generate","mGenerate");
        $master = $that->mGenerate->get(array("id" => $str),'modul',TRUE);
        return $master->nama;
    }
    function fogit($str)
    {
        $that =& get_instance();
        if (!empty($str)) {
              $plaintext_string = $that->enc->fogit($str);
            return $plaintext_string;
        }
    }
    function defog($str)
    {
        $that =& get_instance();
        if (!empty($str)) {
              $plaintext_string = $that->enc->defog($str);
            return $plaintext_string;
        }
    }
    function _datatable($data)
    {
        if(!empty($data)){
            $that =&get_instance();
            $tmpl = array('table_open' => '<table class="table table-striped table-bordered">');
            $that->table->set_template($tmpl);
            $that->table->set_heading(set_heading($data));
        }
    }

    function _datatable_fixed_col($data)
    {
        if(!empty($data)){
            $that =&get_instance();
            $tmpl = array('table_open' => '<table id="datatable-fixed-header" class="table table-striped table-bordered">');
            $that->table->set_template($tmpl);
            $that->table->set_heading(set_heading($data));
        }
    }



    function set_heading($data)
    {
        if (!empty($data)) 
        {
           $i = 1;
            foreach ($data as $key => $value) 
            {
                $t = count($value);
                $h = explode(',',$t);
                foreach ($value as $k => $v) 
                {
                    if ($i <= $h[0] ) 
                    {
                        if($k == 'cmf'){
                            $param[$i] = strtoupper($k);
                        }else{
                            switch ($k) 
                            {
                                case 'office':
                                    $param[$i]   = 'Position';
                                    break;
                                case 'nik':
                                    $param[$i]   = 'NIK';
                                   break;
                                case 'sector':
                                    $param[$i]   = 'Division';
                                    break;
                                case 'department':
                                    $param[$i]   = 'Group';
                                    break;
                                default:
                                   $param[$i] = str_ucfrist($k);
                                    break;
                            }
                        }
                    }
                    $i++;
                }
            }
        }
        return $param;
    }
   
    function shift_array($array)
    {
        if(is_array($array)) $shift = array_shift($array);
        else $shift = $array;
        return $shift;
    }
    function _at($nama_karyawan, $value='')
    {
        $that =& get_instance();
        if ( isset($that->$nama_karyawan) && $value === '' ) return $that->$nama_karyawan;
        $that->load->vars(array($nama_karyawan=>$value));
        $that->$nama_karyawan = $value;
    }

    // Generate Random Digit
    /**
     * Is it an Ajax request?  
     * 
     * Check XHR request
     *
     * @access  public
     * @return  boolean
     */

    function render($t_view='', $data=False, $outbuff=False)
    { 
        $that =& get_instance();
        $that->template->render($t_view, $data, $outbuff);
    }

    function render_partial($t_view='', $data=False, $outbuff=False)
    {
        $that =& get_instance();
        return $that->template->render_partial($t_view, $data, $outbuff);
    }

    // check post data and xss clean
    function _cleantag($data)
    {
        if(is_array($data)):
            foreach ($data as $key => $value) {
                $cl[$key] = trim(htmlentities(strip_tags($value)));
            }
        else:
            $cl = trim(htmlentities(strip_tags($data)));
        endif;

        return $cl;
    }
    function _post($var_nama_karyawan='', $default='', $xss_clean=True){
        if ($var_nama_karyawan):
            $ps = (isset($_POST[$var_nama_karyawan]) && $_POST[$var_nama_karyawan]) ? $_POST[$var_nama_karyawan] : $default;
            if ($xss_clean) return xss_clean($ps);
            return $ps;
        endif;
        
        // get all data
        foreach($_POST as $key=>$val):
            $ps[$key] = ($xss_clean) ? xss_clean($val) : $val;
        endforeach;

        return $ps;
    }
    function _post_clean($var_nama_karyawan='', $default='', $xss_clean=True){
        if ($var_nama_karyawan):
            $ps = (isset($_POST[$var_nama_karyawan]) && $_POST[$var_nama_karyawan]) ? $_POST[$var_nama_karyawan] : $default;
            if ($xss_clean) return xss_clean($ps);
            return _cleantag($ps);
        endif;
        
        // get all data
        foreach($_POST as $key=>$val):
            $ps[$key] = ($xss_clean) ? xss_clean($val) : $val;
        endforeach;

        return _cleantag($ps);
    }
    function _get($var_nama_karyawan='', $default=False, $xss_clean=True){
        $rv = '';

        if ($var_nama_karyawan):
            $rv = (isset($_GET[$var_nama_karyawan]) && $_GET[$var_nama_karyawan]) ? $_GET[$var_nama_karyawan] : $default;
            if ($xss_clean) return xss_clean($rv);
            return $rv;
        endif;
        
        // get all data
        foreach($_GET as $key=>$val):
            $rv[$key] = ($xss_clean) ? xss_clean($val) : $val;
        endforeach;

        return $rv;
    }
    function _get_clean($var_nama_karyawan='', $default=False, $xss_clean=True){
        $rv = '';

        if ($var_nama_karyawan):
            $rv = (isset($_GET[$var_nama_karyawan]) && $_GET[$var_nama_karyawan]) ? $_GET[$var_nama_karyawan] : $default;
            if ($xss_clean) return xss_clean($rv);
            return _cleantag($rv);
        endif;
        
        // get all data
        foreach($_GET as $key=>$val):
            $rv[$key] = ($xss_clean) ? xss_clean($val) : $val;
        endforeach;

        return _cleantag($rv);
    }
    function html_data($data)
    {
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $data);
        $return = stripslashes($html);
        return $return;
    }

    function sendemail($to,$subject,$message,$cc='',$debug=FALSE)
    {
        // print_r($subject); die();
        $that =& get_instance();
        $that->load->model('M_setting','m_workflow');
       
        return $that->m_workflow->ind_sendmail($to,$subject,$message,$cc,$debug);
    }
      function failed_message($message,$redirect='',$data=false)
    {
        $that =& get_instance();
        $redirect = preg_match("~^(?:f|ht)tps?://~i",$redirect) ? $redirect : base_url(). $redirect;
        echo '<script type="text/javascript">alert("'.$message.'"); </script>';
        echo "<script>document.location=\"".$redirect."\";</script>";
        if($data) $that->session->set_flashdata('data', $data);
        die();
    }