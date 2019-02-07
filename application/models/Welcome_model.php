<?php
namespace app\models;
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Welcome_model extends Eloquent {
    protected $table = 'user_types';
    public $timestamps = false;
	public function test()
	{
        
        // echo "done";
		// return  $this->db->get('user_types')->result_array();
		
    }
    	
}
