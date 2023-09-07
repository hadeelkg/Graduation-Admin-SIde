<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderProductRequest;
use App\Http\Requests\UpdateOrderProductRequest;
use App\Models\order_product;
use App\Http\Resources\OrderProductResource;
use App\Http\Controllers\Controller;

class OrderProductController extends Controller
{
    public function index()
    {
        return OrderProductResource::collection(order_product::all());
    }

    public function show(order_product $order_product){
        return OrderProductResource::make($order_product);
    }

    public function store(StoreOrderProductRequest $request) 
    {
        return new OrderProductResource(order_product::create($request->validated()));
    }

    public function update(UpdateOrderProductRequest $request, order_product $orderProduct)
    {
        $orderProduct->update($request->validated());
        return OrderProductResource::make($orderProduct);
    }    

    public function destroy(order_product $order_product)
    {
        $order_product->delete();
        return response()->noContent();
    }
}
