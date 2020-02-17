<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 require_once APPPATH."/third_party/PHPMailer/PHPMailerAutoload.php";

class ind_mailler extends PHPMailer {
	public function __construct()
	{
		parent::__construct();
	}
}
// EOF 