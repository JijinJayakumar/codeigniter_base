<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// use models\Welcome_model;
// use app\helpers\ArrayHelper;
use app\models\Welcome_model;
use app\libraries\REST_Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
// use Restserver\Libraries\Format;
class Welcome extends  \CI_Controller {

	
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        // $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        // $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        // $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	
	public function users_get(){
		echo "working";
	}

	public function index_get()
	{
		$this->load->model('TestModel');

		// print_r($this->TestModel->test());
		 $users = Welcome_model::all();
		 $this->response($users);

	}


	public function index_post(){
		//echo "test working";
	}

	public function sentinel(){

		$credentials = [
			'email'    => 'admin@admin.com',
			'password' => '123456',
		];
		
		//  $user=Sentinel::registerAndActivate($credentials);
// 		  $user=Sentinel::authenticate($credentials);
// echo $user->id;
		// print_r($user);
		// $role = Sentinel::getRoleRepository()->createModel()->create([
		// 	'name' => 'SuperAdmin',
		// 	'slug' => 'superadmin',
		// ]);

				// 		$role = Sentinel::findRoleById(1);

				// $role->permissions = [
				// 	'user.update' => true,
				// 	'user.view' => true,
				// ];

				// $role->save();
		

	// $user = Sentinel::findById(1);
	// $role = Sentinel::findRoleByName('SuperAdmin');
	// $role->users()->attach($user);


// 	$user = Sentinel::findById(1);

// $data=Sentinel::login($user);
// $admin = Sentinel::inRole('superadmin');
// echo json_encode($admin);
// echo getenv('DB_HOSTNAME');
	}

	
}
