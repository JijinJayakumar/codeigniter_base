<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**

 * @package    Ci

 * @subpackage Library

 * @author     Jijin

 * @disclamer Please do not change ,  feel free to create new one

 */

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Jemail extends Library
{

    public function __construct()
    {

        $this->ci = &get_instance();

        $this->sender_email = $this->ci->config->item('sender_email');

        $this->sender_email_password = $this->ci->config->item('sender_email_password');

        $this->sender_host = $this->ci->config->item('sender_host');

        $this->sender_port = $this->ci->config->item('sender_port');

        $this->sender_name = $this->ci->config->item('sender_name');

    }

    public function send($details = array())
    {

        $mail = new PHPMailer(true);

        try {

            $page = $this->ci->load->view('emails/' . $details['page'], $details['page_data'], true);

            $mail->SMTPDebug = 0;

            $mail->isSMTP();

            $mail->Host = $this->sender_host;

            $mail->SMTPAuth = true;

            $mail->Username = $this->sender_email;

            $mail->Password = $this->sender_email_password;

            $mail->SMTPSecure = 'tls';

            $mail->Port = $this->sender_port;

            $mail->setFrom($this->sender_email, $this->sender_name);

            $mail->addAddress($details['to']);

            // $mail->addReplyTo($this->sender_email, 'Information');

            $mail->isHTML(true);

            $mail->Subject = $details['subject'];

            $mail->Body = $page;

            $mail->send();

            return true;

        } catch (Exception $e) {

            // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

            return false;

        }

    }

}
