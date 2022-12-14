<?php

namespace Blog\DB;


class DbStatements{


	public function getPosts($app) {
		$query = $app['db']->query("SELECT * FROM posts");
		$result = $query;
		$i = 0;
		$posts = [];
		while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
			$posts[$i] = $row['post_title'];
			$posts[$i + 1] = $row['post_content'];
			$posts[$i + 2] = $row['user_id'];
			$i += 3;
		}
		return $posts;
	}

	public function addPosts($app, $data) {
		$query = $app['db']->prepare("INSERT INTO posts (post_title, post_content, user_id)
		VALUES ('".$data['post-title']."','".$data['post-content']."','".$_SESSION['user_id']."')");
			$result = $query->execute();
			if ($result) {
				return true;
		} else {
				return false;
		}
	}

	public function addUser($app, $data) {
		$hashedpass = password_hash($data['password'], PASSWORD_BCRYPT);

		$query = $app['db']->prepare("INSERT INTO users (user_firstname, user_lastname, user_mail, user_password)
		VALUES ('".$data['firstname']."','".$data['lastname']."','".$data['email']."','".$hashedpass."')");
			$result = $query->execute();
			if ($result) {
				return true;
		} else {
				return false;
		}
	}

	public function verifyUser($app, $data) {
		$query = $app['db']->prepare("SELECT * FROM users WHERE user_mail=:email");
		$query->bindParam(":email", $data['email'], SQLITE3_TEXT);
		$result = $query->execute();
		$result = $result->fetchArray(SQLITE3_ASSOC);
		if (!$result) {
			return false;
	} else {
			if (password_verify($data['password'], $result['user_password'])) {
					$_SESSION['user_id'] = $result['user_id'];
					return true;
			} else {
					return false;
			}
		}
	}

	public function getUsernameById($app, $id) {
		$query = $app['db']->prepare("SELECT user_firstname FROM users WHERE user_id= $id");
		// $query->bindParam(":id", $id, SQLITE3_INTEGER);
		$result = $query->execute();
		$result = $result->fetchArray(SQLITE3_ASSOC);
		$result = (array) $result;
		// print_r(implode($result));
		return implode($result);
	}
	
}

