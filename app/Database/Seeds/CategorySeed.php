<?php

namespace App\Database\Seeds;

use App\Models\CategoryModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class CategorySeed extends Seeder
{
    public function run()
    {
        $categoryModel = new CategoryModel();
        $faker = Factory::create();
        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            $title = $faker->sentence(3);
            $data = [
                'name' => $title,
                'slug'  => url_title($title, '-', true)
            ];
            $categoryModel->skipValidation(true);
            $categoryModel->save($data);
        }
        
    }
}
