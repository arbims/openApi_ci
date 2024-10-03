<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use OpenApi\Annotations\Server;
use OpenApi\Attributes as OA;

#[OA\Info(title: "Codeigniter Api", version: "0.1", description: "Example swagger openApi")]
#[OA\Server(url: "http://localhost:8080")]
#[OA\SecurityScheme(securityScheme: "securityScheme", type: "http", scheme: "bearer")]
class SwaggerDocController extends BaseController {

    use ResponseTrait;
    
    public function index()
    {
        return view('swagger/index');
    }

    public function swagger()
    {
        $swaggerFile = WRITEPATH . 'swagger.json';

        if (file_exists($swaggerFile)) {
            $swaggerContent = file_get_contents($swaggerFile);
            return $this->respond(json_decode($swaggerContent));
        }
    
        return $this->fail('Swagger file not found.');
    }
}