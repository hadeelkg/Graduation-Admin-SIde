<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Client;
use App\Models\City;
use App\Models\Product;
use App\Models\Order;

class StatisticsController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'city_count' => City::count(),
                'product_count' => Product::count(),
                'client_count' => Client::count(),
                'order_count' => Order::count(),
            ]], 200);
    }
}
