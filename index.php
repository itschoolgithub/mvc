<?php
session_start();
use App\Core\Router;

define('MVC', true);

require 'app/autoload.php';
require 'app/config.php';

$router = new Router;
$router->run();