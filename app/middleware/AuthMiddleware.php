<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteContext;


class AuthMiddleware
{
    private $dic;

    function __construct($dic)
    {
        $this->dic = $dic;
    }


    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);  
        // If user is logged in. 
        if (isset($_SESSION['user_id'])) { 
            return $response;
        } else {
            $flash = $this->dic->get('flash');
            $flash->addMessage('messsage', "<div class='alert alert-danger'>Du måste vara inloggad.</div>");

            return $response
                ->withHeader('Location', SITE_URL . '/login')
                ->withStatus(401);
        }
    }
}
