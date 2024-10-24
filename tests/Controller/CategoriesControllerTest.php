<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Config\Factories;
use App\Models\CategoryModel;
use App\Controllers\CategoriesController;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use Config\Services;

class CategoriesControllerTest extends CIUnitTestCase
{
    //use ControllerTestTrait;
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $migrate     = true;
    protected $migrateOnce = false;
    protected $refresh     = true;
    protected $namespace   = 'App';

    
    protected function setUp(): void
    {
        parent::setUp();
        $mockCategoryModel = $this->createMock(CategoryModel::class);
        $mockCategoryModel->method('paginate')
            ->willReturn([
                ['id' => 1, 'name' => 'Category 1', 'slug' => 'category-1'],
                ['id' => 2, 'name' => 'Category 2', 'slug' => 'category-2']
            ]);

        // Simuler la pagination
        $pager = $this->createMock('CodeIgniter\Pager\Pager');
        $pager->method('getTotal')
            ->willReturn(2);

        $mockCategoryModel->pager = $pager;

        // Injecter le mock dans les factories
        Factories::injectMock('models', 'CategoryModel', $mockCategoryModel);
    }

    public function testIndexReturnsCategoriesWithPagination()
    {
        // Simuler une requête GET à l'API
        $result = $this->withHeaders(['Authorization' => 'Bearer ' . $this->getTestToken()])->get('api/categories');

        // Vérifier que la réponse HTTP est 200 (OK)
        $result->assertStatus(200);
    }

    public function testIndexReturns404WhenPageIsOutOfRange()
    {
        $_GET['page'] = 120;
        $result = $this->withHeaders(['Authorization' => 'Bearer ' . $this->getTestToken()])->get('api/categories?page=120');
        $result->assertStatus(404);

        // Vérifier le contenu du message d'erreur
        $result->assertSee('NotFoundException');
        $result->assertSee('Not Found');
    }

    public function testCreateCategory()
    {
        $mockData = [
            'name' => 'New Category',
            'slug' => 'new-category'
        ];
    
        $result = $this->withBodyFormat('json')->withHeaders(['Authorization' => 'Bearer ' . $this->getTestToken()])
                       ->post('api/categories', $mockData);
        $result->assertStatus(200);
        $result->assertSee('New Category');
    }

    public function getTestToken()
    {
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJteWFwcCIsInN1YiI6MSwiZXhwIjoxNzI5NzczODY2fQ.JtHhB5Z6cgW5zC0dSlRJDuBL5IcKZj7whrIJE6imQNEJ7iLsUjg2xhrNe1d9Zlt6eF4M26VGFjOXXm3VGYN_7HbGd9WG1MgICKAdjfUxGtxbmQ1SGsnYe1Nb2L1446O8_HmlYnemXd57n6GJYYvOX1IjwsEjVnCQATULhlzWO-M';
    }
}
