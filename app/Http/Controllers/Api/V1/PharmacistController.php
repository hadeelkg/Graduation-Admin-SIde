<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StorePharmacistRequest;
use App\Http\Requests\UpdatePharmacistRequest;
use App\Models\Pharmacist;
use App\Http\Resources\PharmacistResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PharmacistController extends Controller
{
        public function index()
    {
        return PharmacistResource::collection(Pharmacist::all());
    }

    public function show(Pharmacist $pharmacist){
        return PharmacistResource::make($pharmacist);
    }

    public function store(StorePharmacistRequest $request)
    {
        return new PharmacistResource(
            // Pharmacist::create($request->validated())
            Pharmacist::create([
                ...$request->validated(),
                'image_path' => $request->file('image_path')->store('pharmacist', 'public')
            ])
        );
    }

    public function update(UpdatePharmacistRequest $request, Pharmacist $pharmacist)
    {
        $pharmacist->update($request->validated());
        if ($request->hasFile('image_path')) {
            $newImagePath = $request->file('image_path')->store('pharmacist', 'public');
            $pharmacist->image_path = $newImagePath;
        }
        $pharmacist->save();
        return $pharmacist;
    }

    public function destroy(Pharmacist $pharmacist)
    {
        $pharmacist->delete();
        return response()->noContent();
    }
}
