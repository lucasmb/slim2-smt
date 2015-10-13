<?php


use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use League\Monga;
use Slim\Slim;

require '../vendor/autoload.php';

/*
 * Set app mode based on domain name
 */
define('LOCAL_ENV', isset($_SERVER["SERVER_NAME"]) && ($_SERVER["SERVER_NAME"] == 'slimesite.dev') ? 'DEV' : 'PROD');

if( LOCAL_ENV == 'DEV' ){
	$dev_mode = true;
	$mode = 'development';
}else{
	$dev_mode = false;
	$mode = 'production';
}

 
/*
 * Mongodb connection config
 */
if($dev_mode){
	$dns = 'mongodb://127.0.0.1:27017/';
	$db_name = 'slimsmtdb';
}else {
    $dns = 'mongodb://admin:admin@173.3.91.5:27017/';
    $db_name = 'slimsmtdb';
}


$rootPath = realpath(dirname(__DIR__));
$appPath = $rootPath . '/app';
 
/*
 * Config array for Monolog and Mongo
 */
$config = array(
    'logger'                   => '',
    'logger_name'              => 'Slim-SMT',
    'log_file'                 => $rootPath . '/app/logs/app.log',
    'log_signal'               => Logger::DEBUG, //minimum signal lvl to be logged (debug,info,notice,warning,critical
    'app_path'                 => $rootPath . '/app',
    'dns'					   => $dns,
    'db_name'                  => $db_name, 
);
 
 
/*
 * Init for Slim app
 */
$app = new Slim(array(
    'debug' => $dev_mode,
    'mode' => $mode,
    'templates.path' => $appPath.'/views',
    'view' => new slimSMT\libs\CustomView(),
    //'view' => new \Slim\Views\Twig(),
));

/*
 * Twig Views Config
 */
$app->view->parserOptions = [
    'debug' => $dev_mode, 
    'cache' => $appPath.'/cache', 
    'charset' => 'utf-8', 
    'auto_reload' => true, 
    'strict_variables' => false, 
    'autoescape' => true 
];

/*
 * Twig Extensions
 */
$app->view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
    new slimSMT\libs\CustomTwigExt()
);
 

/*
 * Singleton Connection for MongoDB
 */  
$app->container->singleton('db', function () use ($config) {
    $connection = Monga::connection($config['dns']);
    return $connection->database($config['db_name']);
});


/*
 * Replace slim log wiht Monolog
 */  
$app->container->singleton('log', function () use ($config) {
    // create a log channel
    $log = new Logger($config['logger_name']);
    $log->pushHandler(new StreamHandler($config['log_file'], $config['log_signal']));
    return $log;
});
 