<?php


session_start();

use Blog\Controller\Index;
use Blog\Controller\Login;
use Blog\Controller\Register;
use Blog\Controller\CreatePost;

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Lime\App() ;

$app->service("db", function(){
    return new \SQLite3('../src/DB/microBlogdb.db');
});

$app->get("/auth/logout", function() {
    $_SESSION['user_id'] = '';
    $panel = new Login($this);
    return $panel->getLogin();    
});
$app->get("/auth/login", function() {
    $panel = new Login($this);
    return $panel->getLogin();    
});

$app->post("/auth/login", function() use($app){
    $loginData = $_POST;
    $panel = new Login($app);
    return $panel->postLogin($loginData); 
});

$app->get("/auth/register", function() {
    $panel = new Register($this);
    return $panel->getRegister();    
});

$app->post("/auth/register", function() use($app){
    $registerData = $_POST;
    $panel = new Register($app);
    return $panel->postRegister($registerData);  
});

$app->bind("/auth", function() {
    return "This was a GET or POST request...";
});

$app->get("/index", function() use($app) {
    $panel = new Index($app);
    return $panel->getIndex();
});
$app->get("/post/create", function() use($app) {
    $panel = new CreatePost($app);
    return $panel->getCreatePost();
});
$app->post("/post/create", function() use($app) {
    $postData = $_POST;
    $panel = new CreatePost($app);
    return $panel->postCreatePost($postData);
});
$app->run();
// $_SESSION['user_id'] = '';
// $app->bindClass('Panel');
