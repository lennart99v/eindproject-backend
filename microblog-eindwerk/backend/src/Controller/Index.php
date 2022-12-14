<?php

namespace Blog\Controller;

use Blog\DB\DbStatements;


class Index {

	protected $app;

	public function __construct($app){
			$this->app = $app;
	}

	public function getIndex() {
		$db = new DbStatements();
		$posts = $db->getPosts($this->app);
		// print_r(count($posts));
		for ($i = 0; $i < count($posts); $i += 3){
			$posts[$i + 2] = $db->getUsernameById($this->app, $posts[$i + 2]);
		}
		if (!empty($posts)) {
			$posts = $posts;
		} 
		$data = array(
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
	}
}

