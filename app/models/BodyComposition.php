<?php

namespace App\Models;


class BodyComposition
{
    public function __construct(\Monolog\Logger $log)
    { 
        $this->log = $log; 
    }


    // Development of the DoD Body Composition Estimation Equations. 
    // Hodgdon, J.A och Friedl, K. Naval Health Research Center, Technical Document No. 99-2B. Publicerad 1999
    // http://www.bodybuilding.com/fun/kurilla5.pdf 
    public function calculateFatProcentage(User $user) 
    {
        // Convert to inch
        $heightInch = $this->cmToInch($user->height);
        $waistInch = $this->cmToInch($user->waist);
        $neckWidthInch = $this->cmToInch($user->neck);
 
        // Male body
        if ($user->gender == 'male') {
            return round(86.010 * log10($waistInch - $neckWidthInch ) - 70.041 * log10($heightInch) + 36.76, 1);
        } 
        
        // Female body
        else if ($user->gender == 'female') {
            $hipkWidthInch = $this->cmToInch($user->hips) ;
            return round(163.205 * log10(($waistInch + $hipkWidthInch) - $neckWidthInch ) - 97.684 * log10($heightInch) + 36.76, 1);
        } 

        // None of the abve
        else {
            $this->log->addError('Gender is nether male or female: ' . $user->gender);
            return false;
        }
    }


    protected function cmToInch($cm)
    {
        if(!is_numeric($cm) ){
            $this->log->addError('None numeric value into cmToInch Method. Value:'.$cm);
            return false;
        }
        return $cm * 0.393700787  ;
    }
}
