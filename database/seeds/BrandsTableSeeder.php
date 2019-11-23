<?php

use App\Model\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           Brand::create([
            'name' => 'Symphony',
           ]);
           Brand::create([
            'name' => 'Samsung',
           ]);
           Brand::create([
            'name' => 'Xiaomi',
           ]);
           Brand::create([
            'name' => 'Vivo',
           ]);
           Brand::create([
            'name' => 'Oppo',
           ]);
    }
}
