<?php

/**
 * Routes for gym log
 *   
 *  
 * Startpage. 
 *  - Select workout program
 *  - See statistics 
 *  - Edit body data 
 * 
 * 
 * Active Workout program page
 *  - Se all exercises 
 *  - add remove exercise
 *  - Add remove set
 *  - Mark set as complete 
 *  - Edid weights and reps 
 * 
 * 
 * Active Workout program page
 *  - Se all exercises 
 *  - add remove exercise
 *  - Add remove set
 *  - Mark set as complete 
 *  - Edid weights and reps 
 * 
 * 
 * 	
 *	profile
 *	add
 *	create-program
 *	settings
 * 
 */
$group->group('/profile', function ($group) {

    $group->get('', function ($request, $response, $args) {
        $data['current_nav'] = 'profile'; 
 
        $UserFactory = $this->get('UserFactory');
        $User = $UserFactory->get($_SESSION['user_id']);
  
        $BodyComposition = $this->get('BodyComposition'); 
        $User->fat_percentage = $BodyComposition->calculateFatProcentage($User);
       
        $data['user'] = $User;

        $view = $this->get('view');
        return $view->render($response, "gymlog/profile.tpl.php", $data);
    });

    $group->put('/{id}', function ($request, $response, $args) {
        $params = $request->getParsedBody();
        $UserFactory = $this->get('UserFactory');
        $result = $UserFactory->update($args['id'], $params);

        $payload = json_encode($result['message']);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($result['status']);
    });
});
