<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\order_product;
use App\Models\Product;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


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
        $order = Order::create($request->validated());
        foreach ($request->products as $item) {
            $orderItem = new  order_product;
            $orderItem->product_id=$item['product_id'];
            $product_price = Product::find($item['product_id'])->price;
            $orderItem->product_price = $product_price;
            $orderItem->quantity=$item['quantity'];
            $orderItem->subtotal_price=$item['quantity'] * intval($product_price);
            $orderItem->order_id=$order->id;
            $orderItem->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'order sent successfully',
            'data' => new OrderResource($order),
        ], Response::HTTP_CREATED);
        return $request;
    }

    public function update(UpdateOrderRequest $request)
    {
        // $order->update($request->validated());
        // $records = order_product::where('order_id', $order->id)->get();

        // foreach ($records as $record) {
        //     $record->delete();
        // }

        // foreach ($request->products as $item) {
        //     $orderItem = new  order_product;
        //     $orderItem->product_id=$item['product_id'];
        //     $product_price = Product::find($item['product_id'])->price;
        //     $orderItem->product_price = $product_price;
        //     $orderItem->quantity=$item['quantity'];
        //     $orderItem->subtotal_price=$item['quantity'] * intval($product_price);
        //     $orderItem->order_id=$order->id;
        //     $orderItem->save();
        // }
        // return new OrderResource($order);
        $orderId = $request->input('order_id');
        $newStatus = $request->input('status');

        // Find the order by ID
        $order = Order::findOrFail($orderId);

        // Update the status
        $order->status = $newStatus;
        $order->save();

        // return new OrderResource($order);
        return response()->json([
            'status' => true,
            'message' => 'order status updated successfully',
            'data' => new OrderResource($order),
        ], Response::HTTP_CREATED);
        return $request;

    }

    public function destroy(Order $order)
    {
        $records = order_product::where('order_id', $order->id)->get();
        foreach ($records as $record) {
            $record->delete();
        }
        $order->delete();
        return response()->noContent();
    }
}
