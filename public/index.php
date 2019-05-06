<?php
define('APP_DIR', realpath(__DIR__.'/../').'/');
define('CONFIG_DIR', realpath(__DIR__.'/../config').'/');

require_once __DIR__.'/../vendor/autoload.php';


\jojer\core\App::start();
\jojer\core\Session::start();

$router = new \jojer\core\Router();

$router->start();
