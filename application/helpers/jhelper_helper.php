<?php

/**

 * Site global functions

 * @package    Ci

 * @subpackage Helpers

 * @author     Jijin

 * @disclamer Please do not change values form here, use confi file and lang files , feel free to create new one, but think  again before updating one

 */
if (!function_exists('go_back_url')) {
    function go_back_url()
    {
        $CI = &get_instance();
        if ($CI->agent->referrer()) {
            return $CI->agent->referrer();
        } else {
            return base_url();
        }
    }
}
if (!function_exists('get_urls')) {
    function get_urls()
    {
        $CI = &get_instance();
        $urls = $CI->uri->uri_string();
        return ("$urls");
    }
}

//** DEBUG FUNCTION :smile: */
if (!function_exists('d_print_r')) {
    function d_print_r($array = "", $die = '0')
    {
        $CI = &get_instance();
        echo "<h1>Array Details</h1><br> <pre> ";
        print_r($array);
        echo "</pre>";
        if ($die == '1') {
            die('die function started, set to zero');
        }
    }
}
if (!function_exists('d_last_query')) {
    function d_last_query($die = '0')
    {
        $CI = &get_instance();
        echo $CI->db->last_query() . "<br>";
        if ($die == '1') {
            die('die function started, set to zero');
        }
    }
}
if (!function_exists('d_echo')) {
    function d_echo($var, $die = '0')
    {
        $CI = &get_instance();
        echo $var;
        if ($die == '1') {
            die('die function started, set to zero');
        }
    }
}