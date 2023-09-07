<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductImageRequest;
use App\Http\Requests\UpdateProductImageRequest;
use App\Models\product_image;
use App\Http\Resources\ProductImageResource;
use App\Http\Controllers\Controller;

class ProductImageController extends Controller
{
    public function index()
    {
        return ProductImageResource::collection(product_image::all());
    }

    public function show(product_image $product_image){
        return ProductImageResource::make($product_image);
    }

    public function store(StoreProductImageRequest $request) 
    {
        return new ProductImageResource(product_image::create($request->validated()));
    }

    public function update(UpdateProductImageRequest $request, product_image $product_image)
    {
        $product_image->update($request->validated());
        return ProductImageResource::make($product_image);
    }    

    public function destroy(product_image $product_image)
    {
        $product_image->delete();
        return response()->noContent();
    }
}
