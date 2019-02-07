<?php
// namespace app\models;
defined('BASEPATH') OR exit('No direct script access allowed');
class TestModel extends \CI_Model { //Eloquent {
    protected $table = 'user_types';
    public $timestamps = false;
	public function test()
	{
        
         echo "done";
		// return  $this->db->get('user_types')->result_array();
		
    }
    	
}
