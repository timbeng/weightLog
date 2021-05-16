<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$app->group('/composition', function ($group) {

    $group->get('', function ($request, $response, $args) {
        $data = [];
        $view = $this->get('view');
        return $view->render($response, "composition/composition.tpl.php", $data);
    });

    $group->get('/calculate', function ($request, $response, $args) {
  
        $User = $this->get('User');
        $User->gender = $_GET['gender'];
        $User->waist = $_GET['waist'];
        $User->neck = $_GET['neck'];
        $User->height = $_GET['height'];
        $User->hips = isset($_GET['hips'])? $_GET['hips'] : null; 

        $BodyComposition = $this->get('BodyComposition');
        $User->fat_percentage = $BodyComposition->calculateFatProcentage($User);

        $payload = json_encode($User); 
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });
});
