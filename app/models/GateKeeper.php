<?php

namespace App\Models;

class GateKeeper
{
    protected $db;
    protected $log;


    public function __construct(Database $db, \Monolog\Logger $log)
    {
        $this->db = $db;
        $this->log = $log;
    }


    public function checkReCaptcha($token)
    {
        /* 
            [success] => 1
            [challenge_ts] => 2018-11-01T22:31:14Z
            [hostname] => recaptcha.local
            [score] => 0.9
            [action] => contact 
        */

        // Build POST request:
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = SECRET_KEY;
        $recaptcha_response = $token;

        // Make and decode POST request:
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);

        return $recaptcha;
    }


    public function doLogin($data = [], $regnore_hash = null)
    {
        // Check recaptcha 
        $reCaptchaResult = $this->checkReCaptcha($data['token']);

        // Recahptcha not passed 
        if ($reCaptchaResult->success != 1) {
            // $this->sendEmailWrongReCaptcha($user);
            return [
                'success' => false,
                'id' => null,
                'status' => 401,
                'message' => "Det verkar som att du inte har tillstånd att logga in på den här sidan.</br>
                                     Ett meddelande har skickats ut till din mail med information om hur du loggar in."
            ];
        }

        // Passed Get user:
        $sql = "SELECT * FROM users ";

        // Check if trying to login with email OR username
        if (filter_var($data['username'], FILTER_VALIDATE_EMAIL)) {
            $sql .= " WHERE email = :email;";
            $param[':email'] = $data['username'];
        } else {
            $sql .= " WHERE username = :username;";
            $param[':username'] = $data['username'];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($param);
        $result = $stmt->fetch();

        if (empty($result)) {
            return ['success' => false, 'message' => 'Användaren hittades inte..', 'status' => 500];
        } else if ($result['deleted'] == 1) {
            return ['success' => false, 'message' => 'Användaren är inte aktiverad.'];
        } else {

            if (password_verify($data['password'], $result['password'])) {
                $_SESSION['user_id'] = $result['id'];

                // $privileges = $this->checkPrivilegesForModule( $result['id'], $data['uri'] );
                // if ($privileges==false) {
                //     $data['uri'] = 'profile';
                // }

                return ['success' => true, 'status' => 200, 'id' => $result['id'], 'message' => 'Du loggas in.', 'uri' => $data['uri']];
            } else {
                return ['success' => false, 'id' => null, 'status' => 401, 'message' => 'Felaktigt användarnamn eller lösenord.'];
            }
        }
    }


    public function checkPrivilegesForModule($user_id, $slug)
    {
        $slug = str_replace('/', '', explode('/', $slug));

        if (!isset($slug[1])) {
            return false;
        }

        $sql = "SELECT * FROM modules 
            INNER JOIN privileges 
                ON modules.id = privileges.module_id
            WHERE user_id = :user_id AND modules.slug = :slug;";

        $param[':user_id'] = $user_id;
        $param[':slug'] = $slug[1];
        $stmt = $this->db->prepare($sql);
        $stmt->execute($param);
        $result = $stmt->fetch();

        return $result;
    }
}
