<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'User',
    type: 'array',
    items   : new OA\Items(
        properties: [
            new OA\Property(property: 'id', type: 'integer', description: 'Identifiant unique de l\'utilisateur'),
            new OA\Property(property: 'name', type: 'string', description: 'Nom de l\'utilisateur'),
            new OA\Property(property: 'email', type: 'string', description: 'Email de l\'utilisateur'),
            new OA\Property(property: 'created_at', type: 'string', format: 'date-time', description: 'Date de création de l\'utilisateur')
        ])
)]
class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = User::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'email', 'password', 'token'];

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

    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['password'])) {
            return $data;
        }
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }

}
