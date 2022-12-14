<?php

namespace Blog\Controller;

use Blog\DB\DbStatements;


class Login {

	protected $app;

	public function __construct($app){
			$this->app = $app;
	}

	public function getLogin() {
	$data = array(
			"errorMsg"  => '',		
			"login" => 'logout',
			"register" => '',	
	);

	if (empty($_SESSION['user_id'])) {
		$data['login'] = 'login';
		$data['register'] = 'register';
	}
	return $this->app->render("../src/View/templates/login.php with ../src/View/layout.php", $data);
	}
	
	public function postLogin($loginData) {
		$db = new DbStatements();

		$verification = $db->verifyUser($this->app, $loginData);

		if($verification) {
			$posts = $db->getPosts($this->app);
		if (!empty($posts)) {
			$posts = $posts;
		} 
			$data = array(
				"name"  => 'Lennart',
				"posts" => $posts,
				"errorMsg"  => '',		
				"login" => 'logout',
				"register" => '',	
		);
		if (empty($_SESSION['user_id'])) {
			$data['login'] = 'login';
			$data['register'] = 'register';
		}
		return  $this->app->render("../src/View/templates/index.php with ../src/View/layout.php", $data);
		} else {
			$data = array(
				"errorMsg"  => '<p class="error">Username password combination is wrong!</p>',
				"login" => 'logout',
				"register" => '',	
		);
		if (empty($_SESSION['user_id'])) {
			$data['login'] = 'login';
			$data['register'] = 'register';
		}
		return $this->app->render("../src/View/templates/login.php with ../src/View/layout.php", $data);
		}
	}

}

