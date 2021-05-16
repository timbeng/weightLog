<?php

namespace App\Models\Workout;
 
 

class Exercise
{

    protected $id = null;
    protected $name = null;         // Name of the exercise
    protected $time = null;         // How long the workout was
    protected $musclegroups = null; // What muscel grups were trained
    protected $sets = [];           // Array of sets 
 
   

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