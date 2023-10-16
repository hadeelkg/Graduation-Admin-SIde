<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Http\Resources\AdminResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


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
        $validatedData = $request->validated();

        // Encrypt the password
        $encryptedPassword = Hash::make($validatedData['password']);

        // Update the validated data with the encrypted password
        $validatedData['password'] = $encryptedPassword;

        // Create the Admin model instance with the encrypted password
        $admin = Admin::create($validatedData);

        return new AdminResource($admin);
        // return new AdminResource(Admin::create($request->validated()));
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $validatedData = $request->validated();
        $encryptedPassword = Hash::make($validatedData['password']);
        $validatedData['password'] = $encryptedPassword;

        $admin->update($validatedData);
        return AdminResource::make($admin);
        // return $request;
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->noContent();
    }

}
