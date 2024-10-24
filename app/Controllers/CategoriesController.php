<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use OpenApi\Attributes as OA;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class CategoriesController extends BaseController {

    use ResponseTrait;
    private $categoryModel;
    const PAGINATE = 3;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    #[OA\Get(
        path: '/api/categories',
        parameters:[
            new OA\Parameter(
                name: "page",
                in: "query",
                required: false,
                description: "Page number",
                schema: new OA\Schema(type: "integer", default: 1)
            ),
        ],
        responses: [
            new OA\Response(
            response: 200,
            description: "list categories",
            content: new OA\JsonContent(
               ref: "#/components/schemas/Category"
            )
        ),
        new OA\Response(response: 401, description: 'Not allowed'),
    ],
    security: [['bearerAuth' => []]],
    )]
    public function index()
    {
        $model = model(CategoryModel::class);

        $data = [
            'categories' => $model->paginate(self::PAGINATE),
            'pager' => $model->pager,
        ];
        $model->pager->getTotal();
        $lastPage = ceil($model->pager->getTotal() / self::PAGINATE);
        if ($this->request->getGet('page') > $lastPage) {
            $data = [
                "exception"=> "NotFoundException",
                "message" => "Not Found",
                "code" => 404
            ];
            return $this->respond($data, 404);
        }
        return $this->respond($data, 200);
    }

    #[OA\Post(
        path: '/api/categories',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/FormCategory",
                required: ['name', 'slug']
            )
        ),
        responses: [
            new OA\Response(
            response: 200,
            description: "create category",
            content: new OA\JsonContent(
               ref: "#/components/schemas/Category"
            )
        ),
        new OA\Response(response: 401, description: 'Not allowed'),
    ],
    security: [['bearerAuth' => []]],
    )]
    public function create()
    {
        if ($this->request->is('post')) {
            $json_data = $this->request->getJSON();
            if ($this->categoryModel->insert($json_data) == false) {
                return $this->respond(['Errors' => $this->categoryModel->errors()], 200);
            }
            $category = $this->categoryModel->find($this->categoryModel->getInsertID());
            return $this->respond($category, 200);
        }
        return $this->respond(['Error' => 'Method not allowed'], 401);
    }

    #[OA\Put(
        path: '/api/categories/{id}',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                ref: "#/components/schemas/FormCategory",
                required: ['name', 'slug']
            )
        ),
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Category ID",
                schema: new OA\Schema(type: "integer")
            ),
        ],
        responses: [
        new OA\Response(
            response: 200,
            description: "create category",
            content: new OA\JsonContent(
            ref: "#/components/schemas/Category"
            )
        ),
        new OA\Response(response: 404, description: 'Object Not Found'),
        new OA\Response(response: 401, description: 'Not allowed'),
        new OA\Response(
            response: 422,
            description: 'Validation Error',
            content: new OA\JsonContent(
                type: "object"
            )
        )
    ],
    security: [['bearerAuth' => []]],
    )]
    public function update(int $id)
    {
        if ($this->request->is('put')) {
            $json_data = $this->request->getJSON();
            if ($this->categoryModel->update($id , $json_data) == false) {
                return $this->respond(['Errors' => $this->categoryModel->errors()], 422);
            }
            $category = $this->categoryModel->find($id);
            if ($category) {
                return $this->respond($category, 200);
            } else {
                return $this->respond(['Error' => 'Object Not Found'], 404);
            }
            
        }
        return $this->respond(['Error' => 'Method not allowed'], 401);
    }

    #[OA\Delete(
        path: '/api/categories/{id}',
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "Category ID",
                schema: new OA\Schema(type: "integer")
            ),
        ],
        responses: [
            new OA\Response(
            response: 200,
            description: "create category",
            content: new OA\JsonContent(
               ref: "#/components/schemas/Category"
            )
        ),
        new OA\Response(response: 404, description: 'Object Not Found'),
        new OA\Response(response: 401, description: 'Not allowed'),
    ],
    security: [['bearerAuth' => []]],
    )]
    public function delete(int $id)
    {
        if ($this->request->is('delete')) {
            if ($this->categoryModel->find($id)) {
                $this->categoryModel->delete($id);
                return $this->respond(['delete' => 'success'], 200);
            } else {
                return $this->respond(['Error' => 'Object Not Found'], 404);
            }
        }
        return $this->respond(['Error' => 'Method not allowed'], 401);
    }
}