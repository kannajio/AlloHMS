<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Phpmailer_library
{
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        require_once(APPPATH."third_party/PHPMailer/src/PHPMailer.php");
		require_once(APPPATH."third_party/PHPMailer/src/SMTP.php");
        $objMail = new PHPMailer\PHPMailer\PHPMailer();
        return $objMail;
		// require 'PHPMailer/src/PHPMailer.php';
		// require 'PHPMailer/src/SMTP.php';

		// $mail = new PHPMailer\PHPMailer\PHPMailer();
    }
}