<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class ClientController extends Controller
{
    public function index()
    {
        // return ClientResource::collection(Client::with(['city'])->get());
        return ClientResource::collection(Client::all());
    }

    public function show(Client $client){
        return ClientResource::make($client);
    }

    public function store(StoreClientRequest $request)
    {
        $validatedData = $request->validated();
        $encryptedPassword = Hash::make($validatedData['password']);
        $validatedData['password'] = $encryptedPassword;
        $client = Client::create($validatedData);
        return new ClientResource($client);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        // $client->update($request->validated());
        // return ClientResource::make($client);
        $validatedData = $request->validated();
        $encryptedPassword = Hash::make($validatedData['password']);
        $validatedData['password'] = $encryptedPassword;

        $client->update($validatedData);
        return ClientResource::make($client);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->noContent();
    }
}
