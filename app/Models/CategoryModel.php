<?php

namespace App\Models;

use App\Entities\Category;
use CodeIgniter\Model;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Category',
    type: 'array',
    items   : new OA\Items(
        properties: [
            new OA\Property(property: 'id', type: 'integer', description: 'Identifiant unique de l\'utilisateur'),
            new OA\Property(property: 'name', type: 'string', description: 'name category'),
            new OA\Property(property: 'slug', type: 'string', description: 'slug category'),
        ])
)]
class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Category::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'slug'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
