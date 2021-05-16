<?php 

use Selective\SameSiteCookie\SameSiteCookieConfiguration;
use Selective\SameSiteCookie\SameSiteCookieMiddleware;
use Selective\SameSiteCookie\SameSiteSessionMiddleware; 

$configuration = new SameSiteCookieConfiguration();

// Register the samesite cookie middleware
$app->add(new SameSiteCookieMiddleware($configuration));

// Start the native PHP session handler and fetch the session attributes
$app->add(new SameSiteSessionMiddleware($configuration));