<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$app->group('', function ($group) {

    $group->get('/login', function ($request, $response, $args) {
        $view = $this->get('view');
        $flash = $this->get('flash');
        $data['flash']['message'] = $flash->getMessages();


        // if user is loged in redirect to  start page 
        if (isset($_SESSION['user_id'])) { 
            return $response->withHeader('Location', SITE_URL)
                            ->withStatus(200);
        }


        return $view->render($response, "login/login.tpl.php", $data);
    });


    $group->post('/login', function ($request, $response, $args) {
        $param = $request->getParsedBody();
        $GateKeeper = $this->get('GateKeeper');

        $result = $GateKeeper->doLogin([
            'username' => $param['username'],
            'password' => $param['password'],
            'token' => $param['token'],
            'uri' => isset($param['uri']) ? $param['uri'] :  ''
        ]);

        $response->getBody()->write(json_encode($result));
        return $response->withStatus($result['status']);
    });


    $group->get('/logout', function ($request, $response, $args) {

        if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
            $flash = $this->get('flash');
            $flash->addMessage('logout', "<div class='alert alert-info'>Du loggades nu ut.</div>");
        }

        // redirect to start page
        return $response->withHeader('Location', SITE_URL . '/login')
            ->withStatus(200);
    });
});
