<?php

namespace Blog\Controller;

use Blog\DB\DbStatements;


class CreatePost {

	protected $app;

	public function __construct($app){
			$this->app = $app;
	}

	public function getCreatePost() {	
	if(!empty($_SESSION['user_id'])) {
		$data = array(
			"errorMsg"  => '',
			"login" => 'logout',
			"register" => '',
		);
		return  $this->app->render("../src/View/templates/postCreate.php with ../src/View/layout.php", $data);
 	} else { 
		$data = array(	
			"errorMsg"  => 'U have to log in to create posts.',	
			"login" => 'login',
			"register" => 'register',		
		);
		return $this->app->render("../src/View/templates/login.php with ../src/View/layout.php", $data);
	}
	}

	public function postCreatePost($postData) {
		$db = new DbStatements();
		$postCheck = $db->addPosts($this->app,$postData);
		$data = array(
			"errorMsg"  => '',
			"login" => 'logout',
			"register" => '',
		);
		if (!$postCheck) {
			$data["errorMsg"] = '<p class="error">This post title has already been used.</p>';
			return  $this->app->render("../src/View/templates/postCreate.php with ../src/View/layout.php", $data);
		} else {
			$posts = $db->getPosts($this->app);
			for ($i = 0; $i < count($posts); $i += 3){
				$posts[$i + 2] = $db->getUsernameById($this->app, $posts[$i + 2]);
			}
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
			return  $this->app->render("../src/View/templates/index.php with ../src/View/layout.php", $data);
		}
	}
}