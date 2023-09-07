<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Http\Resources\ProductResource;

// use App\Http\Requests\StoreProductImageRequest;
// use App\Http\Requests\UpdateProductImageRequest;
// use App\Models\product_image;
// use App\Http\Resources\ProductImageResource;

use App\Http\Controllers\Controller;
class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function show(Product $product){
        return ProductResource::make($product);
        // return $product->product_images;
    }

    public function store(StoreProductRequest $request) 
    {
        return new ProductResource(
            Product::create([
                ...$request->validated(),
                'image_path' => $request->file('image_path')->store('product_images', 'public')
            ])
        );

        // $product = Product::create($request->validated());        
        // foreach ($request->productImages AS $product_image) { 
        //     $product->product_image()->create([
        //         'image_path' =>  $product_image->store('images', 'public')
        //     ]);
        // }
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return ProductResource::make($product);
    }    

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
