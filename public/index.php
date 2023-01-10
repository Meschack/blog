<?php

require '../vendor/autoload.php';
require '../src/Router.php';

use App\Router;

define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new Router(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');
$router
  ->get('/blog', '/post/index', 'blog')
  ->get('/blog/category', '/category/show', 'category')
  ->run();
