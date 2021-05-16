<?php

namespace App\Controllers;


class UserController 
{

    public function __construct(\App\Models\Database $db, \Monolog\Logger $log)
    {
        $this->db = $db;
        $this->log = $log;
    }

    
    public function get($request, $response)
    { 
        // Get Route and id argument from url
        $route = $request->getAttribute('route');
        $user_id = $route->getArgument('id');

        // Call model for data
        $user = $this->container->Users->get(['user_id' => $user_id]);
        $company = $this->container->Company->getCompanies();
        echo json_encode(['user' => $user, 'company' => $company]);
    }



    public function update($request, $response)
    {
        // Get Route and id argument from url 
        $parsedBody = $request->getParsedBody();
        // $files = $request->getUploadedFiles();  
  
        // Call model and update
        $result = $this->container->Users->update($parsedBody);

        return $response->withJson(
            [
                'success' => $result['success'],
                'message' => $result['message'],
                'id' => $result['id'],
            ],
            $result['status']
        ); 
    }



    public function delete($request, $response)
    {
        // Get Route and id argument from url
        $route = $request->getAttribute('route');
        $user_id = $route->getArgument('id');

        // Call model for data
        $result = $this->container->Users->delete($user_id);

        echo json_encode($result);
    }



    public function create($request, $response)
    {
        // Get Route and id argument from url
        $parsedBody = $request->getParsedBody();

        // Check if username exists in database
        if ($this->container->Users->get(['username' => $parsedBody['username']])) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Användarnamnet finns redan i databasen.']));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }

        // Check if email exists in database
        if ($this->container->Users->get(['email' => $parsedBody['email']])) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Eposten finns redan i databasen.']));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }

        // Call model for data
        $result = $this->container->Users->create($parsedBody);

        // Send activation email
        $this->container->Users->sendActivationEmail(['user_id' => $result['user_id']]);

        if ($result['success'] == true) {
            $response->getBody()->write(json_encode(['success' => $result['success'], 'message' => 'Användaren Skapads!']));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
        } else {
            $response->getBody()->write(json_encode(['success' => $result['success'], 'message' => 'Det gick inte att skapa användaren.']));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500);
        }
    }
}
