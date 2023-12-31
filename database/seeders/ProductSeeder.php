<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('products')->insert([
            [
                'name'=>'Anh1',
                'price'=>1000000,
                'quantity'=> 100,
                'category'=>'forher',
                'gallery'=>'storage/product-img/anh1.jpg',
                'description'=>'a perfume good',
            ],
            [
                'name'=>'Anh2',
                'price'=>1000000,
                'quantity'=> 100,
                'category'=>'forher',
                'gallery'=>'storage/product-img/anh2.jpg',
                'description'=>'a perfume good',
            ],
            [
                'name'=>'Anh3',
                'price'=>1000000,
                'quantity'=> 100,
                'category'=>'forher',
                'gallery'=>'storage/product-img/anh3.jpg',
                'description'=>'a perfume good',
            ],
            [
                'name'=>'Anh4',
                'price'=>1000000,
                'quantity'=> 100,
                'category'=>'forher',
                'gallery'=>'storage/product-img/anh4.jpg',
                'description'=>'a perfume good',
            ],
            [
                'name'=>'Anh5',
                'price'=>1000000,
                'quantity'=> 100,
                'category'=>'forher',
                'gallery'=>'storage/product-img/anh5.jpg',
                'description'=>'a perfume good',
            ],
            [
                'name'=>'Anh6',
                'price'=>1000000,
                'quantity'=> 100,
                'category'=>'forher',
                'gallery'=>'storage/product-img/anh6.jpg',
                'description'=>'a perfume good',
            ],
            [
                'name'=>'Anh7',
                'price'=>1000000,
                'quantity'=> 100,
                'category'=>'forher',
                'gallery'=>'storage/product-img/anh7.jpg',
                'description'=>'a perfume good',
            ],
            [
                'name'=>'Anh8',
                'price'=>1000000,
                'quantity'=> 100,
                'category'=>'forher',
                'gallery'=>'storage/product-img/anh6.jpg',
                'description'=>'a perfume good',
            ],
            [
                'name'=>'Anh9',
                'price'=>1000000,
                'quantity'=> 100,
                'category'=>'forher',
                'gallery'=>'storage/product-img/anh6.jpg',
                'description'=>'a perfume good',
            ],
            [
                'name'=>'Anh10',
                'price'=>1000000,
                'quantity'=> 100,
                'category'=>'forher',
                'gallery'=>'storage/product-img/anh6.jpg',
                'description'=>'a perfume good',
            ],
        ]);
    }
}
