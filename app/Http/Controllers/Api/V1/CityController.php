<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;

class CityController extends Controller
{
    // this method returns all rows
    public function index() 
    {
        // return City::all(); =>this returns all unwanted columns
        // the next one returns only the selected columns (on city resource file)
        return CityResource::collection(City::all());
    }

    public function store(StoreCityRequest $request)
    {
        // $city = City::create($request->validated());

        // return CityResource::make($city);
        // return new CityResource($city);
        
        return new CityResource(City::create($request->validated()));

    }

    // this method returns only one specified row
    public function show(City $city)
    {
        // this return json data
        return CityResource::make($city);
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->validated());

        return CityResource::make($city);
    }

    public function destroy(City $city)
    {
        $city->delete();
        return response()->noContent();
    }
}
