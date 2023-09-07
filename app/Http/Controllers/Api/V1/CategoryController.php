<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function show(Category $category){
        return CategoryResource::make($category);
    }

    public function store(StoreCategoryRequest $request) 
    {
        return new CategoryResource(Category::create($request->validated()));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return CategoryResource::make($category);
    }    

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
