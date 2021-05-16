<?php

namespace App\Models\Workout;
        
use App\Models\Models;
 
class Workout extends Models
{ 
    protected $user_id = null;
    protected $program_id = null;
    protected $workout_started = null;  // When
    protected $workout_length = null;   // How long the workout was
    protected $exercises = [];          // Array of exercises
    protected $grade = null;            // How the workout felt
    protected $comment = null;          // Comment on the workout
    protected $completed = false;       // Workout completed

    

    /**
     * Start a Workout  
     */
    public function start($session, $program_id=null){
        if(isset($session['workout'])){
            return $session['workout'];
        }
        else { 
            $this->program_id = $program_id; 
            $this->workout_started = date('Y-m-d H:i:s'); 
            return $this;
        } 
    }
    


    /**
     * getMuscleGroups
     * 
     */
    public function getMuscleGroups($id = null)
    { 
        try {
            $stmt = $this->db->prepare("SELECT * FROM `workout_muscle_groups` ORDER BY order_by ASC;"); 
            $stmt->execute();
            $result = $stmt->fetchAll(); 
            return $result; 
        }
        catch(\PDOException $ex){ 
            $this->log->addError($ex->getMessage());
            return [ ];
        } 
    }
    
     
}
