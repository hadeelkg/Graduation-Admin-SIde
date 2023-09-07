<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\City;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Client;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Order;
use App\Models\order_product;
use App\Models\Pharmacist;
use App\Models\prescription_order;
// use App\Models\product_image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    //    Admin::factory(5)->create();
       City::factory(5)->create();
       Brand::factory(3)->create();
       Category::factory(3)->create();
       Client::factory(5)->create();
       Comment::factory(5)->create();
       Product::factory(13)->create();
       Order::factory(13)->create();
       order_product::factory(13)->create();
       Pharmacist::factory(4)->create();
       prescription_order::factory(20)->create();
    //    product_image::factory(30)->create();
    }
}
