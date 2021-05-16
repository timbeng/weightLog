<?php

namespace App\Models;


class User
{
    // USer params
    public $id = null;
    public $birth_date = null;
    public $gender = null;
    public $age = null;
    public $username = "";
    public $firstname = "";
    public $lastname = "";
    public $email = "";
    public $phone = "";
    public $notes = "";
    public $weight;
    public $height;
    public $neck;
    public $waist;
    public $hips;
    public $fat_percentage = "?";


    public function fullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }



    public function calculateAge()
    {
        if ($this->birth_date != null) {
            $from = new \DateTime($this->birth_date);
            $to = new \DateTime('today');
            return $from->diff($to)->y;
        } else {
            return '?';
        }
    }



    public function insert(array $params = [])
    {
        try {
            $query = $this->db->createQuery('insert', 'users', $params);
            $stmt = $this->db->prepare($query['sql']);
            $stmt->execute($query['params']);
            return ['status' => 200, 'message' => ''];
        } catch (\PDOException $ex) {
            $this->log->addError($ex->getMessage());
            return ['status' => 500, 'message' => ''];
        }
    }


    public function update(int $id, array $params = [])
    {
        try {
            $query = $this->db->createQuery('update', 'users', $params, $id);
            $stmt = $this->db->prepare($query['sql']);
            $stmt->execute($query['params']);
            return ['status' => 200, 'message' => ''];
        } catch (\PDOException $ex) {
            $this->log->addError($ex->getMessage());
            return ['status' => 500, 'message' => ''];
        }
    }
}
