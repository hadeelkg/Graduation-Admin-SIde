<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Http\Resources\AdminResource;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return AdminResource::collection(Admin::all());
    }

    public function show(Admin $admin){
        return AdminResource::make($admin);
    }

    public function store(StoreAdminRequest $request) 
    {
        return new AdminResource(Admin::create($request->validated()));
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $admin->update($request->validated());
        return AdminResource::make($admin);
        // return $request;
    }    

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->noContent();
    }

}
