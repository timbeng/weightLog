<?php

namespace App\Models\Workout;
  
class Program
{ 
    protected $id = null;
    protected $name = null;         // Name of the exercise 
    protected $exercises = [];      // Array of sets 
    protected $description = "";    // Array of sets 
  
   

    /**
     * Add exercise
     *
     * @param exercise_id 
     * 
     * @return void
     * 
     */
    protected function addExercise($exercise_id = null)
    {
    }

 

}