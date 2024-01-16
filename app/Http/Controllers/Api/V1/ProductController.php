<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use File;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        // return ProductResource::collection(Product::all());

            // Check if filtering criteria are provided in the request
        if ($request->hasAny(['brand', 'category', 'target_sex', 'priceSort'])) {
            // Apply filtering
            $brandId = $request->input('brand');
            $categoryId = $request->input('category');
            $target_sex = $request->input('target_sex');

            $query = Product::query();

            if ($brandId) {
                $query->where('brand_id', $brandId);
            }
            if ($categoryId) {
                $query->where('category_id', $categoryId);
            }
            if ($target_sex) {
                $query->where('target_sex', $target_sex);
            }

            // price sort
            if ($request->has('priceSort')) {
                if ($request->priceSort == 'low_to_high') {
                    $query->orderBy('price', 'asc');
                } elseif ($request->priceSort == 'high_to_low') {
                    $query->orderBy('price', 'desc');
                }
            }
            // end price sort

            $filteredProducts = $query->get();

            return ProductResource::collection($filteredProducts);
        } else {
            // Retrieve all products
            $products = Product::all();

            return ProductResource::collection($products);
        }
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
        if ($request->hasFile('image_path')) {
            $newImagePath = $request->file('image_path')->store('product_images', 'public');
            $product->image_path = $newImagePath;
        }
        $product->save();
        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
