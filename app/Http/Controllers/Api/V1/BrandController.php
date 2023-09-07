<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Http\Resources\BrandResource;
use App\Http\Controllers\Controller;


class BrandController extends Controller
{
    public function index()
    {
        return BrandResource::collection(Brand::all());
    }

    public function show(Brand $brand){
        return BrandResource::make($brand);
    }

    public function store(StoreBrandRequest $request) 
    {
        return new BrandResource(Brand::create($request->validated()));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());
        return BrandResource::make($brand);
    }    

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->noContent();
    }

}
