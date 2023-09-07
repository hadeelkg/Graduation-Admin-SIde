<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    public function show(Order $order){
        return OrderResource::make($order);
    }

    public function store(StoreOrderRequest $request) 
    {
        return new OrderResource(Order::create($request->validated()));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return OrderResource::make($order);
    }    

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->noContent();
    }
}
