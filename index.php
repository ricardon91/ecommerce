<?php

session_start();

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Classes\Page;
use \Classes\PageAdmin;
use \Classes\Model\User;

$app = new Slim();

$app->config('debug', true);

//Main page route
$app->get('/', function() {

    $page = new Page();

    $page->setTpl("index");
});

//Admin page route
$app->get('/admin', function() {

    $page = new PageAdmin();

    $page->setTpl("index");
});

//Login page route
$app->get('/admin/login', function () {

    $page = new PageAdmin([
        "header" => false,
        "footer" => false
    ]);

    $page->setTpl("login");
});

$app->post('/admin/login', function (){
    
    User::login($_POST["login"], $_POST["password"]);
    
    header("Location: /admin");
    exit;
});

$app->get('/admin/logout', function (){
    
    User::logout();
    
    header("Location: /admin/login");
    exit;
});

$app->run();
?>