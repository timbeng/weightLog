<?php
 
use Slim\Factory\AppFactory; 

// Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php'; 

// Config files
require_once __DIR__ . "/../app/includes/config.php"; 

// Dependency injection container
require_once __DIR__ . "/../app/includes/di.php";  
 
session_start(); 

// Set container to create App with on AppFactory 
AppFactory::setContainer($dic); 
$app = AppFactory::create(); 

$app->addRoutingMiddleware();

$app->addBodyParsingMiddleware(); 

require_once ROUTES_PATH . "/../includes/SameSiteCookie.php"; 
  
// Include public routes 
require_once ROUTES_PATH . "/public/routes.php";    
require_once ROUTES_PATH . "/public/composition.routes.php";  
  
// Logged in
$app->group('', function ($group) {
 
    $files = scandir(ROUTES_PATH.'/protected'); 
    foreach($files as $file){
        if(is_file(ROUTES_PATH.'/protected/'.$file)){ 
            require_once ROUTES_PATH . "/protected/".$file; 
        } 
    } 
 
})->add(new App\Middleware\AuthMiddleware($dic));

$app->run();