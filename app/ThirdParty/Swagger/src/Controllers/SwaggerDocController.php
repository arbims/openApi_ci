<?php

namespace Swagger\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use OpenApi\Annotations\Server;
use OpenApi\Attributes as OA;

#[OA\Info(title: "Codeigniter Api", version: "0.1", description: "Example swagger openApi")]
#[OA\Server(url: "http://localhost:8080")]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'JWT',
    name: 'bearerAuth',
    in: 'header'
)]
class SwaggerDocController extends BaseController {

    use ResponseTrait;
    
    protected $view;

    public function __construct()
    {
        $this->view = \Config\Services::renderer(APPPATH . 'ThirdParty/Swagger/src/Views');
    }
    
    public function index()
    {
        // Render the view from the new path
        return $this->view->render('swagger/index');
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