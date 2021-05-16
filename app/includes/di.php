<?php

use DI\Container;


// Create Container using PHP-DI
$dic = new container();


// Do login and recaptcha check etc 
$dic->set('GateKeeper', function ($dic) {
    $db = $dic->get('db');
    $log = $dic->get('log');
    return new \App\Models\GateKeeper($db, $log);
});


// Logs... stuff
$dic->set('log', function ($dic) {
    $logger = new \Monolog\Logger('log');
    $file_handler = new \Monolog\Handler\StreamHandler(__DIR__ . '/../../logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
});


// Räknar med att bara ha en databas (för tillfället). Annars kan parametrarna bli annorlunda. 
// Uppdatera så att man kör någon Connect cuntion istället och trycker in en array så att man kan koppla sig mot olika databaser 
$dic->set('db', function ($dic) {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET . "";
    $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    return new \App\Models\Database($dsn, DB_USER, DB_PASSWORD, $options);
});


$dic->set('view', function ($dic) {
    $view = new \Slim\Views\PhpRenderer(TEMPLATE . '/');
    $view->addAttribute('auth', $dic);
    return $view;
});


$dic->set('flash', function () {
    return new \Slim\Flash\Messages();
});


$dic->set('User', function ($dic) {
    $db = $dic->get('db');
    $log = $dic->get('log');
    return new \App\Models\User($db, $log);
});


$dic->set('UserFactory', function ($dic) {
    $db = $dic->get('db');
    $log = $dic->get('log');
    return new \App\Models\UserFactory($db, $log);
});


$dic->set('BodyComposition', function ($dic) {
    $log = $dic->get('log');
    return new \App\Models\BodyComposition($log);
});
