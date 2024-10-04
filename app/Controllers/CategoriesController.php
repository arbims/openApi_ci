<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\API\ResponseTrait;
use OpenApi\Attributes as OA;

class CategoriesController extends BaseController {

    use ResponseTrait;
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    #[OA\Get(
        path: '/api/categories',
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
        $categories = $this->categoryModel->findAll();
        return $this->respond($categories, 200);
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
        path: '/api/categories/id',
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
    public function update(int $id)
    {
        if ($this->request->is('put')) {
            $json_data = $this->request->getJSON();
            if ($this->categoryModel->update($id , $json_data) == false) {
                return $this->respond(['Errors' => $this->categoryModel->errors()], 200);
            }
            $category = $this->categoryModel->find($id);
            return $this->respond($category, 200);
        }
        return $this->respond(['Error' => 'Method not allowed'], 401);
    }

    #[OA\Delete(
        path: '/api/categories/id',
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
    public function delete(int $id)
    {
        if ($this->request->is('delete')) {
            $this->categoryModel->delete($id);
            return $this->respond(['delete' => 'success'], 200);
        }
        return $this->respond(['Error' => 'Method not allowed'], 401);
    }
}