<?php
ob_start();
session_start();
require "core/Autoload.php";
require "core/checkExist.php";
new core\Autoload;

require 'core/bootstrap.php';

use core\Router;
use core\Request;

Router::load('app/routes.php')->direct(Request::uri(),Request::method());

?>
