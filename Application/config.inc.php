<?php
error_reporting(-1);
ini_set('display_errors', 'On');
setlocale(LC_TIME, "de_DE");

require_once('db_credentials.inc.php');

define('ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('MODEL', ROOT . 'model' . DIRECTORY_SEPARATOR);
define('VIEW', ROOT . 'view' . DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT . 'controller' . DIRECTORY_SEPARATOR);
define('CLASSES', ROOT . 'classes' . DIRECTORY_SEPARATOR);
define('CSS', 'https://tippold.com/sportradar/css' . DIRECTORY_SEPARATOR);

spl_autoload_register(function ($classname){

    $rootpath = ROOT . $classname. ".class.php";
    $modelpath = MODEL . $classname. ".class.php";
    $viewpath = VIEW . $classname. ".class.php";
    $controllerpath = CONTROLLER . $classname. ".class.php";
    $classespath = CLASSES . $classname. ".class.php";

    if(file_exists($rootpath))
    {
        require_once($rootpath);
    }
    elseif (file_exists($modelpath))
    {
        require_once($modelpath);
    }
    elseif (file_exists($viewpath))
    {
        require_once($viewpath);
    }
    elseif (file_exists($controllerpath))
    {
        require_once($controllerpath);
    }
    elseif (file_exists($classespath))
    {
        require_once($classespath);
    }
});

