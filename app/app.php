<?php


$app->get('/', function() use ($app) {
    $app->log->addDebug('Request for Home Page received', array($app->request()));
    $app->view->addCss('custom.css');
    $app->view->addJs('custom.js');
     $app->render('home.php', array("hello" => 'Hello from Slim 2 app') );
})->name('home');
