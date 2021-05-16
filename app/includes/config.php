<?php

// Localhost
if (explode('.', $_SERVER['HTTP_HOST'])[1] == 'local') {

  define('SITE_URL', "http://weightlog.local");

  define('SITE_ROOT', realpath(__DIR__ . "/../../public_html"));
  define('APP_ROOT', __DIR__ . "/../");
  define('ROUTES_PATH', __DIR__ . "/../Routes");
  define('MODULES_PATH', __DIR__ . "/../Modules");
  define('MODEL', __DIR__ . "/../Model/");
  define('TEMPLATE', __DIR__ . "/../templates/");
  define('CONTROLLER', __DIR__ . "/../Controller/");
  define('PUBLIC_PATH', "");

  // Database  
  define('DB_HOST', "localhost");
  define('DB_NAME', "weightlog");
  define('DB_USER', "root");
  define('DB_PASSWORD', "");  
  define('DB_CHARSET', "utf8");

  define('SITE_KEY', "");
  define('SECRET_KEY', "");
}

// Remote host
else {

  define('SITE_URL', "");

  define('SITE_ROOT', realpath(__DIR__ . "/../../public_html"));
  define('APP_ROOT', __DIR__ . "/../");
  define('ROUTES_PATH', __DIR__ . "/../Routes");
  define('MODULES_PATH', __DIR__ . "/../Modules");
  define('MODEL', __DIR__ . "/../Models/");
  define('TEMPLATE', __DIR__ . "/../templates/");
  define('CONTROLLER', __DIR__ . "/../Controller/");
  define('PUBLIC_PATH', "");

  // Database  
  define('DB_HOST', "localhost");
  define('DB_NAME', "");
  define('DB_USER', "");
  define('DB_PASSWORD', "");
  define('DB_CHARSET', "utf8");

  define('SITE_KEY', "");
  define('SECRET_KEY', "");
}
