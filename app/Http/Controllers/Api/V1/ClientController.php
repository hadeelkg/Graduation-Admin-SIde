<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use App\Http\Controllers\Controller;

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
        return new ClientResource(Client::create($request->validated()));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        return ClientResource::make($client);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->noContent();
    }
}
