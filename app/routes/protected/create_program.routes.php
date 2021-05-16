<?php

/** 
 * 
 */
$group->group('/create-program', function ($group) {

    // Gymlog startpage
    $group->get('', function ($request, $response, $args) {

        // // Create Workout object
        // $workout = new App\Models\Workout\Workout($this); 
        // $data['muscle_groups'] = $workout->getMuscleGroups( ); 

        $User = $this->get('User');
        // $User->init($_COOKIE['user_id']);
        $data['user'] = $User;
 
        $data['current_nav'] = 'create-program';

        $view = $this->get('view');
        return $view->render($response, "gymlog/gymlog.tpl.php", $data);
    });

    // Gymlog startpage
    $group->get('/profile', function ($request, $response, $args) {

        // // Create Workout object
        // $workout = new App\Models\Workout\Workout($this); 
        // $data['muscle_groups'] = $workout->getMuscleGroups( ); 

        $User = $this->get('User');
        $User->init($_COOKIE['user_id']);
        $data['user'] = $User;

 

        $data['current_loggedin_nav'] = 'gymlog';

        $view = $this->get('view');
        return $view->render($response, "gymlog/gymlog.tpl.php", $data);
    });



    $group->get('/create-program', function ($request, $response, $args) {
        $view = $this->get('view');

        // // Create Workout object
        // $workout = new App\Models\Workout\Workout($this); 
        // $data['muscle_groups'] = $workout->getMuscleGroups( ); 

        $data['current_loggedin_nav'] = 'gymlog';
        return $view->render($response, "gymlog/programs.tpl.php", $data);
    });


    // 
    $group->get('//create-program', function ($request, $response, $args) {
        $data['h1'] = 'Gör ett program ';

        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    });

    // 
    $group->get('/settings', function ($request, $response, $args) {
        print_r($args);
        die;

        $view = $this->get('view');

        // $data['workout'] = new App\Models\Workout\Workout($this); 
        // $data['workout']->setWorkoutDate( ); 

        $data['current_loggedin_nav'] = 'gymlog';
        return $view->render($response, "gymlog/active.tpl.php", $data);
    });
}); 
// })->add(new App\Middleware\WorkoutMiddleware($container)); 
