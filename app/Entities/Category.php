<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'FormCategory',
    properties: [
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'category name'
        ),
        new OA\Property(
            property: 'slug',
            type: 'string',
            example: 'category-slug'
        ),
    ]
)]
class Category extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}
