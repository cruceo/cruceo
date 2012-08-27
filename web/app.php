<?php

require_once __DIR__.'/../app/bootstrap.php.cache';
require_once __DIR__.'/../app/AppKernel.php';
//require_once __DIR__.'/../app/AppCache.php';

use Symfony\Component\HttpFoundation\Request;

$env   = getenv('APP_ENV') === false ? 'prod' : getenv('APP_ENV');
$debug = getenv('APP_DEBUG') === false ? false : (boolean) getenv('APP_DEBUG');

$kernel = new AppKernel($env, $debug);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);
$kernel->handle(Request::createFromGlobals())->send();
