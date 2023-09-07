<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StorePrescriptionOrderRequest;
use App\Http\Requests\UpdatePrescriptionOrderRequest;
use App\Models\prescription_order;
use App\Http\Resources\PrescriptionOrderResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PrescriptionOrderController extends Controller
{
    public function index()
    {
        return PrescriptionOrderResource::collection(prescription_order::all());
    }

    public function show(prescription_order $prescription_order){
        return PrescriptionOrderResource::make($prescription_order);
    }

    public function store(StorePrescriptionOrderRequest $request) 
    {
        return new PrescriptionOrderResource(
            prescription_order::create([
                $request->validated(),
                'image_path' => $request->file('image_path')->store('prescription', 'public')
            ])
        );
    }

    public function update(UpdatePrescriptionOrderRequest $request, prescription_order $prescriptionOrder)
    {
        $prescriptionOrder->update($request->validated());
        return PrescriptionOrderResource::make($prescriptionOrder);
    }    

    public function destroy(prescription_order $prescription_order)
    {
        $prescription_order->delete();
        return response()->noContent();
    }
}
