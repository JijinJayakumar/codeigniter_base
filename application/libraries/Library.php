<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**

 * @package    Ci

 * @subpackage Library

 * @author     Jijin

 * @disclamer Please do not change ,  feel free to create new one

 */
//this class loaded in index
class Library ///core library fil
{
    public function __construct()
    {
        $this->ci = &get_instance();
        ///Models
        $this->ci->load->model('api/crud', 'crud');
        $this->ci->load->model('api/v1/teams_model', 'teams_model');
        $this->ci->load->model('api/v1/user_model', 'user_model');
        $this->ci->load->model('api/v1/posts_model', 'posts_model');
        $this->ci->load->model('api/v1/wall_model', 'wall_model');
        $this->ci->load->model('api/v1/Athlete_model', 'athlete_model');
        $this->ci->load->model('api/v1/Activity_model', 'activity_model');
        $this->ci->load->model('api/v1/Dare_model', 'dare_model');

        //tables
        $this->table['users'] = $this->ci->config->item('users', 'table');
        $this->table['roles'] = $this->ci->config->item('roles', 'table');
        $this->table['gambits'] = $this->ci->config->item('gambits', 'table');
        $this->table['fans'] = $this->ci->config->item('fans', 'table');
        $this->table['users_social'] = $this->ci->config->item('users_social', 'table');
        $this->table['teams'] = $this->ci->config->item('teams', 'table');
        $this->table['team_members'] = $this->ci->config->item('team_members', 'table');
        $this->table['claps'] = $this->ci->config->item('claps', 'table');
        $this->table['comments'] = $this->ci->config->item('comments', 'table');
        $this->table['posts'] = $this->ci->config->item('posts', 'table');
        $this->table['posts_media'] = $this->ci->config->item('posts_media', 'table');
        $this->table['account_types'] = $this->ci->config->item('account_types', 'table');
        $this->table['athlete_sports_category'] = $this->ci->config->item('athlete_sports_category', 'table');
        $this->table['business_details'] = $this->ci->config->item('business_details', 'table');
        $this->table['business_types'] = $this->ci->config->item('business_types', 'table');
        $this->table['user_activity'] = $this->ci->config->item('user_activity', 'table'); //main table

        //Variables
        // $this->default_level = $this->ci->config->item('default_level');
       

    }

    public function upload($folder, $field_key)
    {
        $output=array();
        $config['upload_path'] = './' . $folder;

        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $config['max_size'] = 3024;

        $config['max_width'] = 1024;

        $config['max_height'] = 768;

        $config['encrypt_name'] = true;

        $this->ci->load->library('upload', $config);

        if (!$this->ci->upload->do_upload($field_key)) {
            // $output = false_response('An error occured');
            $output['status'] = false;

        } else {
            $imageData = $this->ci->upload->data();
            $output = array("name" => $imageData['file_name'], "type" => $imageData['file_type'], "status" => true);

        }

        return $output;

    }



}
