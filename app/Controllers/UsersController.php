<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use OpenApi\Attributes as OA;

class UsersController extends BaseController {

    use ResponseTrait;
    
    #[OA\Get(
        path: '/api/users',
        responses: [
            new OA\Response(
            response: 200,
            description: "list users",
            content: new OA\JsonContent(
               ref: "#/components/schemas/User"
            )
        ),
        new OA\Response(response: 401, description: 'Not allowed'),
    ],
    security: [['bearerAuth' => []]],
    )]
    public function index()
    {
        $users = [];
        for ($i=0; $i < 10; $i++) { 
            array_push($users, [
                'id' => $i,
                'email' => 'mail'.$i.'@gmail.com',
                'name' => 'user'.$i,
                'created' => date('Y-m-d H:i:s')
            ]);
        }
        return $this->respond($users, 200);
    }

    #[OA\Get(
        path: '/api/test',
        responses: [
            new OA\Response(
            response: 200,
            description: "Test api",
            content: new OA\JsonContent(
               ref: "#/components/schemas/User"
            )
        ),
        new OA\Response(response: 401, description: 'Not allowed'),
    ],
    security: [['bearerAuth' => []]],
    )]
    public function test()
    {
        return $this->respond(['status' => 'success', 'message' => 'Welcome to the API']);
    }
}