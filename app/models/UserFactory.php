<?php

namespace App\Models;
 

class UserFactory
{ 
    protected $db;
    protected $BodyComposition;
    protected $log;
     
    // Injecting database and the logger (so the constructor don't lie)
    public function __construct(Database $db, \Monolog\Logger $log)
    {
        $this->db = $db; 
        $this->log = $log; 
    }

 
    public function get($user_id): object
    {
        try {
            $sql = "SELECT * FROM users 
                    WHERE users.id = :user_id;";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['user_id' => $user_id]);
            $result = $stmt->fetch();
  
            if (!$result) {
                $this->log->addError("No user found with id: " . $user_id);
                return false;
            }
  
            // Dynamically add all user data if exists
            $user = new User();
            foreach ($result as $key => $param) { 
                // if (property_exists($user, $key)) {
                    $user->$key = $param;
                // }
            }
            
            // Might not need to calulate the age on every fetch? 
            $user->age = $this->calculateAge($user->birth_date);

            return $user;
        } catch (\PDOException $ex) {
            $this->log->addError($ex->getMessage());
            return new User;
        }
    }
  

    public function calculateAge($birth_date)
    {
        if ($birth_date != null) {
            $from = new \DateTime($birth_date);
            $to = new \DateTime('today');
            return $from->diff($to)->y;
        } else {
            return '?';
        }
    }
 
}
