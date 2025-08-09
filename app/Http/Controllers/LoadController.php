<?php

namespace App\Http\Controllers;

use App\Models\Load;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoadController extends Controller
{
    public function changeStatus(Request $request, Load $load)
    {
        $request->validate([
            'status' => 'required|string',
        ]);
        $load->status = $request->status;
        $load->save();
        return redirect()->back()->with('success', 'Status updated successfully.');
    }
    public function index()
    {
        $loads = Load::all();
        return view('admin.loads.index', compact('loads'));
    }

    public function create()
    {
        // dd('This is the create method for loads.');
        return view('admin.loads.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // 'company_id' => 'required|integer',
            'driver_id' => 'nullable|integer',
            'pickup_location' => 'required|string',
            'pickup_phone' => 'required|string',
            'pickup_company' => 'nullable|string',
            'pickup_additional_info' => 'nullable|string',
            'pickup_latitude' => 'nullable|numeric',
            'pickup_longitude' => 'nullable|numeric',
            'pickup_date_time_from' => 'nullable|date',
            'pickup_date_time_to' => 'nullable|date',
            'pickup_info' => 'nullable|string',
            'delivery_location' => 'required|string',
            'delivery_phone' => 'required|string',
            'delivery_company' => 'nullable|string',
            'delivery_additional_info' => 'nullable|string',
            'delivery_latitude' => 'nullable|numeric',
            'delivery_longitude' => 'nullable|numeric',
            'delivery_date_time_from' => 'nullable|date',
            'delivery_date_time_to' => 'nullable|date',
            'delivery_info' => 'nullable|string',
            'job_description' => 'nullable|string',
            'suggested_vehicle' => 'nullable|string',
            'packaging' => 'nullable|string',
            'no_of_items' => 'nullable|integer',
            'gross_weight' => 'nullable|numeric',
            'weight_unit' => 'nullable|string',
            'body_type' => 'nullable|string',
            'job_type' => 'nullable|string',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'dimension_unit' => 'nullable|string',
            'notes' => 'nullable|string',
            'document_name' => 'nullable|string',
            'upload_document' => 'nullable|string',
            'distance_km' => 'nullable|numeric',
            'distance_miles' => 'nullable|numeric',
            'rate_per_km' => 'nullable|numeric',
            'rate_per_mile' => 'nullable|numeric',
            'currency' => 'nullable|string',
            'status' => 'nullable|string',
            'assigned_at' => 'nullable|date',
            'completed_at' => 'nullable|date',
        ]);

        // $distanceKM = $this->getDistance($request->pickup_location, $request->delivery_location);
        // dd($distanceKM);
        // $distanceValue = floatval($distanceKM['distance'] ?? 0);
        // return $distanceKM['distance'] ?? null;
        $load = new Load;
        $load->company_id = Auth::user()->id;
        $load->pickup_location = $request->pickup_location;
        $load->pickup_phone = $request->pickup_phone;
        $load->pickup_company=$request->pickup_company;
        $load->pickup_additional_info=$request->pickup_additional_info;
        $load->pickup_latitude=$request->pickup_latitude;
        $load->pickup_longitude=$request->pickup_longitude;
        $load->pickup_date_time_from=$request->pickup_date_time_from;
        $load->pickup_date_time_to=$request->pickup_date_time_to;
        $load->pickup_info=$request->pickup_info;
        $load->delivery_location=$request->delivery_location;
        $load->delivery_phone=$request->delivery_phone;
        $load->delivery_company=$request->delivery_company;
        $load->delivery_additional_info=$request->delivery_additional_info;
        $load->delivery_latitude=$request->delivery_latitude;
        $load->delivery_longitude=$request->delivery_longitude;
        $load->delivery_date_time_from=$request->delivery_date_time_from;
        $load->delivery_date_time_to=$request->delivery_date_time_to;
        $load->delivery_info=$request->delivery_info;
        $load->job_description=$request->job_description;
        $load->suggested_vehicle=$request->suggested_vehicle;
        $load->packaging=$request->packaging;
        $load->no_of_items=$request->no_of_items;
        $load->gross_weight=$request->gross_weight;
        $load->weight_unit=$request->weight_unit;
        $load->body_type=$request->body_type;
        $load->job_type=$request->job_type;
        $load->length=$request->length;
        $load->width=$request->width;
        $load->height=$request->height;
        $load->dimension_unit=$request->dimension_unit;
        $load->notes=$request->notes;
        $load->document_name=$request->document_name;
        $load->upload_document=$request->upload_document;
        $load->distance_km=$request->distance_km;
        $load->distance_miles=$request->distance_miles;
        $load->rate_per_km=$request->rate_per_km;
        $load->rate_per_mile=$request->rate_per_mile;
        $load->currency=$request->currency;
        $load->status=$request->status;
        $load->assigned_at=$request->assigned_at;
        $load->completed_at=$request->completed_at;

        $load->save();

        return redirect()->route('loads.index')->with('success', 'Load created successfully.');
    }



    public function show(Load $load)
    {
        return view('admin.loads.show', compact('load'));
    }

    public function edit(Load $load)
    {
        return view('admin.loads.edit', compact('load'));
    }

    public function update(Request $request, Load $load)
    {
        $data = $request->validate([
            'driver_id' => 'nullable|integer',
            'pickup_location' => 'required|string',
            'pickup_phone' => 'required|string',
            'pickup_company' => 'nullable|string',
            'pickup_additional_info' => 'nullable|string',
            'pickup_latitude' => 'nullable|numeric',
            'pickup_longitude' => 'nullable|numeric',
            'pickup_date_time_from' => 'nullable|date',
            'pickup_date_time_to' => 'nullable|date',
            'pickup_info' => 'nullable|string',
            'delivery_location' => 'required|string',
            'delivery_phone' => 'required|string',
            'delivery_company' => 'nullable|string',
            'delivery_additional_info' => 'nullable|string',
            'delivery_latitude' => 'nullable|numeric',
            'delivery_longitude' => 'nullable|numeric',
            'delivery_date_time_from' => 'nullable|date',
            'delivery_date_time_to' => 'nullable|date',
            'delivery_info' => 'nullable|string',
            'job_description' => 'nullable|string',
            'suggested_vehicle' => 'nullable|string',
            'packaging' => 'nullable|string',
            'no_of_items' => 'nullable|integer',
            'gross_weight' => 'nullable|numeric',
            'weight_unit' => 'nullable|string',
            'body_type' => 'nullable|string',
            'job_type' => 'nullable|string',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'dimension_unit' => 'nullable|string',
            'notes' => 'nullable|string',
            'document_name' => 'nullable|string',
            'upload_document' => 'nullable|string',
            'distance_km' => 'nullable|numeric',
            'distance_miles' => 'nullable|numeric',
            'rate_per_km' => 'nullable|numeric',
            'rate_per_mile' => 'nullable|numeric',
            'currency' => 'nullable|string',
            'status' => 'nullable|string',
            'assigned_at' => 'nullable|date',
            'completed_at' => 'nullable|date',
        ]);
        $load->update($data);
        return redirect()->route('loads.index')->with('success', 'Load updated successfully.');
    }

    public function destroy(Load $load)
    {
        $load->delete();
        return redirect()->route('loads.index')->with('success', 'Load deleted successfully.');
    }
}
