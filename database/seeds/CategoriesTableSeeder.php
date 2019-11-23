<?php

use App\Model\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Smart',
           ]);
           Category::create([
            'name' => 'Basic',
           ]);
           Category::create([
            'name' => 'Accessories',
           ]);
       
    }
}
