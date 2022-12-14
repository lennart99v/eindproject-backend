<?php

namespace Blog\Controller;

use Blog\DB\DbStatements;
use Blog\Controller\Index;

class Register {

	protected $app;

	public function __construct($app){
			$this->app = $app;
	}

	public function getRegister() {
	$data = array(
		"errorMsg"  => '',
		"login" => 'logout',
		"register" => '',	
	);
	if (empty($_SESSION['user_id'])) {
		$data['login'] = 'login';
		$data['register'] = 'register';
	}
	return $this->app->render("../src/View/templates/register.php with ../src/View/layout.php", $data);
	}

	public function postRegister($registerData) {
		$db = new DbStatements();
		$regCheck = $db->addUser($this->app, $registerData);
		if($regCheck) {
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
		} else {
			$data = array(
				"errorMsg"  => 'Something went wrong! this email adress is probably already in use.',
				"login" => 'logout',
				"register" => '',	
			);
			if (empty($_SESSION['user_id'])) {
				$data['login'] = 'login';
				$data['register'] = 'register';
			}
			return $this->app->render("../src/View/templates/register.php with ../src/View/layout.php", $data);
		}
	}
}

// hash paswoord die data naar data base -> insert 