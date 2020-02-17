<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* indra setiawan 
* @author indrasetiawan0103@gmail.com 
* CMF ( Change Managament Form)
* 10 April 2017
*/
function notifikasi_alternate($nik="",$modul="",$status="")
{ 
    $that =& get_instance();
    $that->load->model('m_generate','mGenerate');
    $that->load->model('m_cmf','mCMF');
    if (!empty($nik)) 
    {
        switch ($modul) 
        {
            case '1': // change management form approval 
                $stat = explode(',', $status);
                if (flow_user('department') == '1') 
                    {
                        $approval_cmf = $that->mCMF->waiting_approval_it(get_underling($nik),$stat);
                    }else{
                        $approval_cmf = $that->mCMF->waiting_approval(get_underling($nik),$status);
                    }
                    $result = empty($approval_cmf) ? 0 : count($approval_cmf);
                    return $result;
                break;
            case '2': // mandays approval
                // $mandays                    = $that->mGenerate->get(array("approval_".$status."" => $nik,"status" => $status),'t_approval_mandays');
                $mandays           =  $this->mCMF->waiting_approval_gh(get_underling(flow_user('nik')),$status);
                 $result = empty($mandays) ? 0 : count($mandays);
                return $result;
                break;
            case '3': // implementation plan 
                $imp = $that->mGenerate->approval_implementation($nik,$status);
                $result = empty($imp) ? 0 : count($imp);
                return $result;
                break;
            case '4':
                $imp_res  = $that->database->get(array("approval_".$status."" => $nik, "status" =>$status),'t_approval_result');
                 $result =  empty($imp_res) ? 0 : count($imp_res);
                break;
            case '5': // monitoring
                $monitor = $that->mGenerate->monitoring_cmf($nik);
                return  $result = empty($monitor) ? 0 : count($monitor);
                break;
            case '6':
                $sec = $that->mGenerate->get(array("nik" => $nik),'t_user',TRUE);
                $officer = $that->mGenerate->knowing_cmf($sec->sector);
                return empty($officer)? 0 : count($officer) ;
                break;
            case '7':
                $str = $that->mGenerate->get(array("approval_".$status."" => $nik,"status" => $status),'t_approval_result');
                return empty($str)? 0 : count($str) ;
                break;
            case '8':
                $imp = $that->mGenerate->approval_implementation($nik,$status);
                return empty($imp)? 0 : count($imp) ;
                break;
            default:
               $result = '0';
                break;
        }
    }
    return $result;
}
function progress_status($status="")
{
    $that =& get_instance();
    $that->load->model('m_generate','mGenerate');
    if (flow_user('department') == '1') 
    {
        switch (flow_user('office')) {
            case '5':
            case '6':
                $result = $that->database->dashboard_on_progress(flow_user('nik'),'3',$status);
                break;
            case '4':
                $result = $that->database->dashboard_on_progress(flow_user('nik'),'4',$status);
                break;
            case '3':
                 $result = $that->database->dashboard_on_progress(flow_user('nik'),'7',$status);
                break;
            case '2':
                 $result = $that->database->dashboard_on_progress(flow_user('nik'),'8',$status);
                break;
            default:
                # code...
                break;
        }
    }else{
        switch (flow_user('office')) {
            case '5':
            case '6':
                $result =  $that->mGenerate->get(array("request_name" => flow_user('nik'),"status_cmf" => $status),"t_cmf");
                break;
            case '4':
                $result = $that->database->dashboard_on_progress(flow_user('nik'),'1',$status);
                break;
            case '3':
                $result = $that->database->dashboard_on_progress(flow_user('nik'),'2',$status);
                break;
            case '2':
                $result = $that->database->dashboard_on_progress(flow_user('nik'),'6',$status);
                break;
            
            default:
                # code...
                break;
        }
    }
    return empty($result) ? 0 : count($result);
}
function join_table($select='',$table="",$join="")
{
    $that =& get_instance();
    $that->load->model('m_generate','mGenerate');
    $join   = $that->mGenerate->join_table($select,$table,$join);
    $result = array_shift($join);
    return $result;
}



?>