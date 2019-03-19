<?php
namespace app\libraries;
defined('BASEPATH') or exit('No direct script access allowed');

/**

 * @package    Ci

 * @subpackage Library

 * @author     Jijin

 * @disclamer Please do not change ,  feel free to create new one

 */
//this class loaded in index
class Library   ///core library fil

{
    public function __construct()
    {
        $this->ci = &get_instance();
        ///Models
      

        //Variables
        // $this->default_level = $this->ci->config->item('default_level');

    }

    public function file_upload($folder, $field_key = 'files')
    {
        folder_check($folder); //create folder
        $config['upload_path'] = $folder;

        $config['allowed_types'] = '*';

        $config['encrypt_name'] = true;

        $this->ci->load->library('upload', $config);
        if (is_array($_FILES[$field_key]['name'])) {
            $filesCount = count($_FILES[$field_key]['name']);
            $uploadData = array();
            for ($i = 0; $i < $filesCount; $i++) {

                $_FILES['file']['name'] = $_FILES[$field_key]['name'][$i];
                $_FILES['file']['type'] = $_FILES[$field_key]['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES[$field_key]['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES[$field_key]['error'][$i];
                $_FILES['file']['size'] = $_FILES[$field_key]['size'][$i];

                // File upload configuration

                $this->ci->upload->initialize($config);

                // Upload file to server

                if ($this->ci->upload->do_upload('file')) {

                    $imageData = $this->ci->upload->data();
                    $output = array("name" => $imageData['file_name'], "type" => $imageData['file_type'], "status" => true, "error_data" => $this->ci->upload->display_errors());

                    

                } else {

                    $output['status'] = false;
                    $output['error_data'] = $this->ci->upload->display_errors();

                }
            }

        } else {
            $this->ci->upload->initialize($config); // Upload file to server

            if ($this->ci->upload->do_upload($field_key)) {
                $imageData = $this->ci->upload->data();
                $output = array("name" => $imageData['file_name'], "type" => $imageData['file_type'], "status" => true,"error_data"=> $this->ci->upload->display_errors());
            } else {

                $output['status'] = false;
                $output['name'] ="default.png";
                $output[ 'type'] = "image/jpeg";

                $output['error_data'] = $this->ci->upload->display_errors();

            }
        }

        return $output;

    }

}
