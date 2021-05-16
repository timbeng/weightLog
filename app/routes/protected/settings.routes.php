<?php
 
 
$group->group('/settings', function ($group) {

    // Gymlog startpage
    $group->get('', function ($request, $response, $args) {

        // // Create Workout object
        // $workout = new App\Models\Workout\Workout($this); 
        // $data['muscle_groups'] = $workout->getMuscleGroups( ); 

        $User = $this->get('User'); 
        $data['user'] = $User;
   
        $data['current_nav'] = 'settings'; 

        $view = $this->get('view');
        return $view->render($response, "gymlog/gymlog.tpl.php", $data);
    });
 
});  
