<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use OpenApi\Annotations as OA;

#[OA\Info(title: "My First API", version: "0.1")]
class UsersController extends BaseController {

    use ResponseTrait;
    
    #[OA\Get(
        path: '/api/users',
        responses: [
            new OA\Response(response: 200, description: 'AOK'),
            new OA\Response(response: 401, description: 'Not allowed'),
        ]
    )]
    public function index()
    {
        return $this->respond(['status' => 'success', 'message' => 'Welcome to the API']);
    }
}