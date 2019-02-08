<?php

/**

 * Site global functions

 * @package    Ci

 * @subpackage Helpers

 * @author     Jijin

 * @disclamer Please do not change values form here, use confi file and lang files , feel free to create new one, but think  again before updating one

 */
defined('BASEPATH') or exit('No direct script access allowed');
if (!function_exists('json_output')) {
    function json_output($output = '')
    {
        $CI = &get_instance();
        $CI->output->set_status_header(200)->set_content_type('application/json', 'utf-8')->set_output(json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))->_display();
        exit;
    }
}
if (!function_exists('check_method')) {
    function check_method($method = 'get')
    {
        $CI = &get_instance();
        if ($CI->input->method() != $method) {
            $output = array(
                "status" => false,
                "Message" => "Nethod Not Allowded"
            );
            $CI = &get_instance();
            $CI->output->set_status_header(401)->set_content_type('application/json', 'utf-8')->set_output(json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))->_display();
            exit;
        }
    }
}
if (!function_exists('false_response')) {
    function false_response($message = '')
    {
        $CI = &get_instance();
        $output = array(
            "status" => false,
            'message' => $message
        );
        return $output;
    }
}
if (!function_exists('true_response')) {
    function true_response($message = '')
    {
        $CI = &get_instance();
        $output = array(
            "status" => true,
            'message' => $message
        );
        return $output;
    }
}
if (!function_exists('time_now')) {
    function time_now()
    {
        return date('Y-m-d H:i:s');
    }
}
if (!function_exists('api_url')) {
    function api_url()
    {
        $CI = &get_instance();
        return base_url() . "api/" . $CI->config->config['current_api_version'] . "/";
    }
}
if (!function_exists('site_name')) {
    function site_name()
    {
        $CI = &get_instance();
        return $CI->config->config['site_name'];
    }
}
if (!function_exists('site_logo')) {
    function site_logo()
    {
        $CI = &get_instance();
        return base_url() . "" . $CI->config->config['site_logo'];
    }
}
if (!function_exists('site_icon')) {
    function site_icon()
    {
        $CI = &get_instance();
        return base_url() . "" . $CI->config->config['site_icon'];
    }
}
if (!function_exists('profile_pic_url')) {
    function profile_pic_url($params = null)
    {
        $CI = &get_instance();
        return base_url() . "" . $CI->config->config['profile_pic_url'] . "" . $params;
    }
}
if (!function_exists('admin_resource_url')) {
    function admin_resource_url($params = null)
    {
        $CI = &get_instance();
        return base_url() . "" . $CI->config->config['admin_resource_folder'] . "" . $params;
    }
}
if (!function_exists('folder_check')) {
    function folder_check($params = null)
    {
        if (!file_exists($params)) {
            mkdir($params, 0777, true);
            $myFile = $params . "/index.html"; // or .php
            $fh = fopen($myFile, 'w'); // or die("error");
            $stringData = "your are not allowded to view this folders";
            fwrite($fh, $stringData);
            fclose($fh);
        }
    }
}
if (!function_exists('check_in_array')) {
    function check_in_array($value, $array)
    {
        $CI = &get_instance();
        if (!in_array($value, $array)) {
            return json_output(false_response("please use valid keys"));
        }
    }
}
if (!function_exists('check_is_empty')) {
    function check_is_empty($array)
    {
        $CI = &get_instance();
        array_walk($array, function ($value, $key) {
            if (empty($value)) {
                json_output(false_response(lang('missing_fields')));
                exit;
            };
        });
    }
}
if (!function_exists('update_id')) {
    function update_id($where, $table, $field)
    {
        $CI = &get_instance();
        $CI->db->where($where);
        return $CI->db->get($table)->row()->$field;
    }
}
if (!function_exists('file_remove')) {
    function file_remove($folderpath)
    {
        if (file_exists($folderpath)) {
            unlink($folderpath);
            return true;
        } else {
            return false;
        }
    }
}
if (!function_exists('file_upload')) {
    function file_upload($folder, $field_key = 'files')
    {
        $CI = &get_instance();
        folder_check($folder); //create folder
        $config['upload_path'] = $folder;
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = true;
        // Load and initialize upload library
        $CI->load->library('upload', $config);
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
                $CI->upload->initialize($config);
                // Upload file to server
                if ($CI->upload->do_upload('file')) {
                    // Uploaded file data
                    $fileData = $CI->upload->data();
                    $uploadData[] = array(
                        $fileData['file_type'] => $fileData['file_name']
                    );
                    //  $CI->crud->createData($CI->table['dare_files'], $uploadData);
                } else {
                    //  $uploadData = $CI->upload->display_errors();
                    //die();
                }
            }
        } else {
            $CI->upload->initialize($config); // Upload file to server
            if ($CI->upload->do_upload($field_key)) {
                // Uploaded file data
                $fileData = $CI->upload->data();
                $uploadData[] = array(
                    $fileData['file_type'] => $fileData['file_name']
                );
            }
        }
        return $uploadData;
    }
}
if (!function_exists('JMakeThumbNail')) {
    function JMakeThumbNail($fileName = 'default.jpg', $fileHeight = 100, $fileWidth = 100, $raw_name = 'default.jpg')
    {
        $temp_location = "./temp/";
        $source_file_name = (file_exists($fileName)) ? $fileName : 'default.jpg';
        $source_file_modified = (file_exists($source_file_name)) ? filemtime($source_file_name) : 0;
        $filename_array = explode('.', $source_file_name);
        $source_ext = strtolower(array_pop($filename_array));
        $mime_types = array(
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif'
        );
        $mime_type = false;
        if (array_key_exists($source_ext, $mime_types)) {
            $mime_type = $mime_types[$source_ext];
        }
        // Set a maximum height and width
        // round($fileWidth, -1); // Round to nearest ten
        $width = (isset($fileWidth) && $fileWidth < 1000) ? $fileWidth : 100;
        $height = (isset($fileHeight) && $fileWidth < 1000) ? $fileHeight : 100;
        // New dimensions
        list($width_orig, $height_orig) = getimagesize($source_file_name);
        $ratio_orig = $width_orig / $height_orig;
        if ($width / $height > $ratio_orig) {
            $width = intval($height * $ratio_orig);
        } else {
            $height = intval($width / $ratio_orig);
        }
        // New File Name
        $pattern = '/(.*)(\.[a-z]{3,4})$/';
        $replacement = $temp_location . "" . preg_replace('/\\.[^.\\s]{3,4}$/', '', $raw_name) . '_' . $width . 'x' . $height . '$2';
        $new_file_name = preg_replace($pattern, $replacement, $source_file_name);
        $new_file_modified = (file_exists($new_file_name)) ? filemtime($new_file_name) : 0;
        // Resample
        if (!file_exists($new_file_name) || $source_file_modified > $new_file_modified) {
            $image_p = imagecreatetruecolor($width, $height);
            switch ($mime_type) {
                case 'image/png':
                    $image = imagecreatefrompng($source_file_name);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagepng($image_p, $new_file_name, 8);
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($source_file_name);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagegif($image_p, $new_file_name, 80);
                    break;
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($source_file_name);
                    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                    imagejpeg($image_p, $new_file_name, 80);
                    break;
            }
            imagedestroy($image_p);
        }
        return array(
            "mime" => $mime_type,
            "file" => $new_file_name
        );
    }
    function random_string($limit = 10)
    {
        $date = date('l/j/So/fF/Y/h:i:s/A');
        return substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyz0123456789' . $date, 10)), 0, $limit);
    }
}
