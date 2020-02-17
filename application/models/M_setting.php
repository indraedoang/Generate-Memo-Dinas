<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* indra setiawan 
* author indrasetiawan0103gmail.com 
* Memo Dinas
* 07 Febuari 2020
*/

class M_setting extends CI_Model {

	function __construct()
	{
		parent::__construct();
        $this->webseting = 'setting';
        $this->pri_index = 'id';
	}
    // Setting
    function get($where = NULL,$single=NULL) {
        $this->db->from($this->webseting);
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where($this->pri_index, $where);
            }
        }
        $result = $this->db->get()->result();
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
    function save(Array $data) {
        if ($this->db->insert($this->webseting, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array($this->pri_index => $where);
            }
        $this->db->update($this->webseting, $data, $where);
        return $this->db->affected_rows();
    }
    function select($option,$name='')
    {
        if(!empty($name)) $find = array('container' => $option,'title' => $name);
        else $find = array('container' => $option);
        
        $query = $this->db->get_where($this->webseting,$find);
        return $query->row();
    }
    function select_one($find)
    {
        $query = $this->db->get_where($this->webseting,$find);
        return $query->row();
    }
    function select_by($where=NULL,$select=NULL,$select_option=FALSE)
    {
        if ( $select !== NULL )
        {
            $this->db->select($select,$select_option);
        }
        return $this->get($where);
    }
    function delete($where = array()) {
        if (!is_array($where)) {
            $where = array($this->pri_index => $where);
        }
        $this->db->delete($this->webseting, $where);
        return $this->db->affected_rows();
    }

     function ind_sendmail($to_address, $subject, $message, $table='', $cc_address='', $attachment='', $debug=FALSE )
    {
        // print_r($cc_address); die();
        // get config from db
        $protocol = $this->select_one(array('container' => 'email', 'title' => 'protocol'));
        $auth = $this->select_one(array('container' => 'email', 'title' => 'auth'));
        $host = $this->select_one(array('container' => 'email', 'title' => 'host'));
        $port = $this->select_one(array('container' => 'email', 'title' => 'port'));
        $username = $this->select_one(array('container' => 'email', 'title' => 'username'));
        $password = $this->select_one(array('container' => 'email', 'title' => 'password'));
        $from = $this->select_one(array('container' => 'email', 'title' => 'from'));
        $name = $this->select_one(array('container' => 'email', 'title' => 'name'));
       
        // load email and start instance
        $this->load->library('ind_mailler');
        // start email
        //
        $this->ind_mailler->XMailer = 'CMF APPLICATION ';
        if($protocol->content=='smtp')
        {
            //Tell PHPMailer to use SMTP
            $this->ind_mailler->isSMTP();
        } else {
            // Set PHPMailer to use the sendmail transport
            $this->ind_mailler->isSendmail();
        }
        if($debug!=FALSE)
        {
            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $this->ind_mailler->SMTPDebug = 2;
            //Ask for HTML-friendly debug output
            $this->ind_mailler->Debugoutput = 'html';
        } else {
            $this->ind_mailler->SMTPDebug = 0;
        }
        
        //Set the hostname of the mail server
        $this->ind_mailler->Host = $host->content;
        //Set the SMTP port number - likely to be 25, 465 or 587
        $this->ind_mailler->Port = $port->content;
        if($auth->content=='Yes')
        {
            $this->ind_mailler->SMTPAuth = true;
            //Username to use for SMTP authentication
            $this->ind_mailler->Username = $username->content;
            //Password to use for SMTP authentication
            $this->ind_mailler->Password = $password->content;
        } else {
            //Whether to use SMTP authentication
            $this->ind_mailler->SMTPAuth = false;
        }
        $this->ind_mailler->ClearAllRecipients();
        if(is_array($cc_address))
        {
            foreach ($cc_address as $show) {
                $employee_cc = get_employee_data($show,'email');
                $email_cc_name = (!empty($employee_cc))? $employee_cc->name : '';
                $this->ind_mailler->AddCC($show,$email_cc_name);
            }
        } elseif(!empty($cc_address))
        {
            $employee_cc = get_employee_data($cc_address,'email');
            $email_cc_name = (!empty($employee_cc))? $employee_cc->name : '';
            $this->ind_mailler->AddCC($cc_address,$email_cc_name);
        }
        //Set who the message is to be sent from
        $this->ind_mailler->setFrom($from->content, $name->content);
        //Set who the message is to be sent to
        $employee_data = get_employee_data($to_address,'email');
        $email_name = (!empty($employee_data))? $employee_data->name: '';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
        $message = "".$message;
        $this->ind_mailler->addAddress($to_address, $email_name,$headers);
        //Set the subject line
        if (empty($subject)) 
        {
            $this->ind_mailler->Subject = "Approval Request ".str_ucfrist($table);
        }else {
            $this->ind_mailler->Subject = $subject;
        }
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $message = (!empty($message))? $message : '';
        $message .= "\n\n\nThank You, \n".anchor_popup(base_url(), 'Application Change Management Form').".";
        // print_r($message); die();
        $this->ind_mailler->msgHTML(nl2br($message));

            if ($attachment != '')
            {
                if (!is_array($attachment))
                {
                    $attachments[] = $attachment;

                    $attachment = $attachments;
                }

                foreach ($attachment as $each_attachment)
                {
                    $this->ind_mailler->AddAttachment($each_attachment);
                }
            }

        //send the message, check for errors
        if (!$this->ind_mailler->send()) {
            return "Mailer Error: " . $this->ind_mailler->ErrorInfo;
        } else {
            return "Message sent!";
        }
    }
   
// EOF 	
}