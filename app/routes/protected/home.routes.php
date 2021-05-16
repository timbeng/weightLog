<?php

/**
 * Routes for gym log
 *  
 * NEEDED pages
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


// $group->group('', function ($group) {

//     // Gymlog startpage
//     $group->get('/', function ($request, $response, $args) { 
//         $User = $this->get('User');
//         $User->init($_SESSION['user_id']);
//         $data['user'] = $User;
 
//         $data['current_nav'] = 'home';

//         $view = $this->get('view');
//         return $view->render($response, "gymlog/gymlog.tpl.php", $data);
//     });
 
// });



$group->group('', function ($group) {
 
    $group->get('/', function ($request, $response, $args) {

        // // Create Workout object
        // $workout = new App\Models\Workout\Workout($this); 
        // $data['muscle_groups'] = $workout->getMuscleGroups( ); 

        $User = $this->get('User'); 
        $data['user'] = $User;
   
        $data['current_nav'] = 'home';

        $view = $this->get('view');
        return $view->render($response, "gymlog/gymlog.tpl.php", $data);
    });
 
    $group->put('/{id}', function ($request, $response, $args) {

        echo "<pre>";
        die(print_r($args));

        // // Create Workout object
        // $workout = new App\Models\Workout\Workout($this); 
        // $data['muscle_groups'] = $workout->getMuscleGroups( ); 

        $User = $this->get('User');
        $User->init($_COOKIE['user_id']);
        $data['user'] = $User;
   
        $data['current_nav'] = 'home';

        $view = $this->get('view');
        return $view->render($response, "gymlog/profile.tpl.php", $data);
    });
  
});  


