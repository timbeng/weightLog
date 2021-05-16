<?php

namespace App\Models\Workout;
  

class Set
{

    protected $id;
    protected $weight;        
    protected $reps; 
    protected $completed = false; 
 
  
  

    /**
     * set completed
     *
     * @param exercise_id 
     * 
     * @return void
     * 
     */
    protected function seCompleted($set_id = null)
    {
    }


    /**
     * remove a set
     *
     * @param exercise_id 
     * 
     * @return void
     * 
     */
    protected function removeSet($exercise_id = null)
    {
    }




}