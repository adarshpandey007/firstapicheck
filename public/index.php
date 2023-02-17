<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require './config/db.php';
$config = ['settings' => ['displayErrorDetails' => true]]; 
$app = new Slim\App($config);
//$app = new \Slim\App;

require './routes/users.php';

$app->run();
