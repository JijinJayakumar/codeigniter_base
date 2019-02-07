<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**

 * @package    Ci

 * @subpackage Library

 * @author     Jijin

 * @disclamer Please do not change ,  feel free to create new one

 */

use Firebase\JWT\JWT;

class Jauth extends Library
{

    public function __construct()
    {
        parent::__construct();
        $this->secret_key = $_ENV['JWT_SECRET'];
    }

    public function encode($array = array())
    {

        return JWT::encode($array, $this->secret_key);

    }

    public function decode($method = false)
    {

        try {

            $token = $this->ci->input->get_request_header('Auth', true);

            $decoded = (array) JWT::decode($token, $this->secret_key, array('HS256'));

            return $decoded;

            //s throw new Exception($decoded);

        } catch (Exception $e) {

            $decoded = false;

            $output = array(

                "status" => false,

                "message" => "Failed to authenticate",

            );

            $this->ci->output

                ->set_status_header(200)

                ->set_content_type('application/json', 'utf-8')

                ->set_output(json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))

                ->_display();

            exit;

        }

    }

    public function regenerate_token($userid, $regenerate = false)
    {
        return array("data" => $tokendata, "token_data" => $this->encode($tokendata));

    }

}
