<?php

namespace App\Http\Controllers;

use App\Models\LogisticsLoad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LogisticsLoadController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($user->user_type === 'admin') {
            $jobs = LogisticsLoad::with('driver')->latest();
        } elseif ($user->user_type === 'driver') {
            $jobs = LogisticsLoad::with('company')->latest();
        } 
        
        elseif ($user->user_type === 'company') {
            // dd(Auth::user()->id);
            $jobs = LogisticsLoad::with('company')->where("company_id", Auth::user()->id);
            
            if ($request->has('status') && $request->has('driver')) {
                if ($request->status === 'assigned') {
                    $jobs = $jobs->where('company_id', $user->id)
                              ->whereIn('status', ['assigned', 'in_progress', 'picked_up', 'in_transit']);
                } elseif ($request->status === 'completed') {
                    $jobs = $jobs->where('company_id', $user->id)->where('status', 'completed');
                }
            } else {
                $jobs = $jobs->where(function($query) use ($user) {
                    $query->where('company_id', $user->id)
                          ->orWhere('status', 'pending');
                });
            }
            
            $jobs = $jobs->latest();
        } else {
            $jobs = LogisticsLoad::whereNull('id');
        }
        
        $jobs = $jobs->paginate(10);
        
        return view('logistics-loads.index', compact('jobs'));
    }

    public function create()
    {
        $drivers = User::where('user_type', 'driver')->get();
        return view('logistics-loads.create', compact('drivers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pickup_location' => 'required|string|max:255',
            'pickup_phone' => 'nullable|string|max:20',
            'pickup_company' => 'nullable|string|max:255',
            'pickup_additional_info' => 'nullable|string',
            'pickup_latitude' => 'nullable|numeric|between:-90,90',
            'pickup_longitude' => 'nullable|numeric|between:-180,180',
            'pickup_date_time_from' => 'nullable|date',
            'pickup_date_time_to' => 'nullable|date|after_or_equal:pickup_date_time_from',
            'pickup_info' => 'nullable|string|max:255',
            
            'delivery_location' => 'required|string|max:255',
            'delivery_phone' => 'nullable|string|max:20',
            'delivery_company' => 'nullable|string|max:255',
            'delivery_additional_info' => 'nullable|string',
            'delivery_latitude' => 'nullable|numeric|between:-90,90',
            'delivery_longitude' => 'nullable|numeric|between:-180,180',
            'delivery_date_time_from' => 'nullable|date|after_or_equal:pickup_date_time_from',
            'delivery_date_time_to' => 'nullable|date|after_or_equal:delivery_date_time_from',
            'delivery_info' => 'nullable|string|max:255',
            
            'job_description' => 'nullable|string|max:255',
            'suggested_vehicle' => 'nullable|string|max:255',
            'packaging' => 'nullable|string|max:255',
            'no_of_items' => 'required|integer|min:1',
            'gross_weight' => 'nullable|numeric|min:0',
            'weight_unit' => 'required|in:kg,lbs,tons',
            'body_type' => 'nullable|string|max:255',
            'job_type' => 'required|in:pickup_delivery,courier,freight,moving,other',
            
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'dimension_unit' => 'required|in:cm,inches,meters,feet',
            
            'notes' => 'nullable|string',
            'upload_document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            
            'distance_km' => 'nullable|numeric|min:0',
            'distance_miles' => 'nullable|numeric|min:0',
            'rate_per_km' => 'nullable|numeric|min:0',
            'rate_per_mile' => 'nullable|numeric|min:0',
            'currency' => 'required|in:USD,EUR,GBP,INR,CAD,AUD',
            
            'status' => 'required|in:pending,assigned,in_progress,picked_up,in_transit,delivered,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('upload_document')) {
            $file = $request->file('upload_document');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('job-documents', $fileName, 'public');
            $data['upload_document'] = $filePath;
            $data['document_name'] = $file->getClientOriginalName();
        }

        if (Auth::user()->user_type === 'driver') {
            $data['driver_id'] = Auth::id();
        }

        $job = LogisticsLoad::create($data);

        $redirectRoute = 'logistics-loads.index';
        if (Auth::user()->user_type === 'driver') {
            $redirectRoute = 'driver.logistics-loads.index';
        } elseif (Auth::user()->user_type === 'company') {
            $redirectRoute = 'company.logistics-loads.index';
        } elseif (Auth::user()->user_type === 'admin') {
            $redirectRoute = 'admin.logistics-loads.index';
        }

        return redirect()->route($redirectRoute)
            ->with('success', 'Logistics job created successfully!');
    }

    public function show(LogisticsLoad $logisticsJob)
    {
        $user = Auth::user();
        if ($user->user_type === 'driver') {
            if ($logisticsJob->created_by !== $user->id && $logisticsJob->driver_id !== $user->id) {
                abort(403, 'Unauthorized to view this job.');
            }
        }

        return view('logistics-loads.show', compact('logisticsJob'));
    }

    public function edit(LogisticsLoad $logisticsJob)
    {
        $user = Auth::user();
        if ($user->user_type === 'driver') {
            if ($logisticsJob->created_by !== $user->id && $logisticsJob->driver_id !== $user->id) {
                abort(403, 'Unauthorized to edit this job.');
            }
        }

        $drivers = User::where('user_type', 'driver')->get();
        return view('logistics-loads.edit', compact('logisticsJob', 'drivers'));
    }

    public function update(Request $request, LogisticsLoad $logisticsJob)
    {
        $user = Auth::user();
        if ($user->user_type === 'driver') {
            if ($logisticsJob->created_by !== $user->id && $logisticsJob->driver_id !== $user->id) {
                abort(403, 'Unauthorized to update this job.');
            }
        }

        $validator = Validator::make($request->all(), [
            'pickup_location' => 'required|string|max:255',
            'pickup_phone' => 'nullable|string|max:20',
            'pickup_company' => 'nullable|string|max:255',
            'pickup_additional_info' => 'nullable|string',
            'pickup_latitude' => 'nullable|numeric|between:-90,90',
            'pickup_longitude' => 'nullable|numeric|between:-180,180',
            'pickup_date_time_from' => 'nullable|date',
            'pickup_date_time_to' => 'nullable|date|after_or_equal:pickup_date_time_from',
            'pickup_info' => 'nullable|string|max:255',
            
            'delivery_location' => 'required|string|max:255',
            'delivery_phone' => 'nullable|string|max:20',
            'delivery_company' => 'nullable|string|max:255',
            'delivery_additional_info' => 'nullable|string',
            'delivery_latitude' => 'nullable|numeric|between:-90,90',
            'delivery_longitude' => 'nullable|numeric|between:-180,180',
            'delivery_date_time_from' => 'nullable|date|after_or_equal:pickup_date_time_from',
            'delivery_date_time_to' => 'nullable|date|after_or_equal:delivery_date_time_from',
            'delivery_info' => 'nullable|string|max:255',
            
            'job_description' => 'nullable|string|max:255',
            'suggested_vehicle' => 'nullable|string|max:255',
            'packaging' => 'nullable|string|max:255',
            'no_of_items' => 'required|integer|min:1',
            'gross_weight' => 'nullable|numeric|min:0',
            'weight_unit' => 'required|in:kg,lbs,tons',
            'body_type' => 'nullable|string|max:255',
            'job_type' => 'required|in:pickup_delivery,courier,freight,moving,other',
            
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'dimension_unit' => 'required|in:cm,inches,meters,feet',
            
            'notes' => 'nullable|string',
            'upload_document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            
            'distance_km' => 'nullable|numeric|min:0',
            'distance_miles' => 'nullable|numeric|min:0',
            'rate_per_km' => 'nullable|numeric|min:0',
            'rate_per_mile' => 'nullable|numeric|min:0',
            'currency' => 'required|in:USD,EUR,GBP,INR,CAD,AUD',
            
            'status' => 'required|in:pending,assigned,in_progress,picked_up,in_transit,delivered,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        if ($request->hasFile('upload_document')) {
            if ($logisticsJob->upload_document) {
                Storage::disk('public')->delete($logisticsJob->upload_document);
            }
            
            $file = $request->file('upload_document');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('job-documents', $fileName, 'public');
            $data['upload_document'] = $filePath;
            $data['document_name'] = $file->getClientOriginalName();
        }

        $logisticsJob->update($data);

        $redirectRoute = 'logistics-loads.index';
        if (Auth::user()->user_type === 'driver') {
            $redirectRoute = 'driver.logistics-loads.index';
        } elseif (Auth::user()->user_type === 'company') {
            $redirectRoute = 'company.logistics-loads.index';
        } elseif (Auth::user()->user_type === 'admin') {
            $redirectRoute = 'admin.logistics-loads.index';
        }

        return redirect()->route($redirectRoute)
            ->with('success', 'Logistics job updated successfully!');
    }

    public function destroy(LogisticsLoad $logisticsJob)
    {
        if ($logisticsJob->upload_document) {
            Storage::disk('public')->delete($logisticsJob->upload_document);
        }
        
        $logisticsJob->delete();

        return redirect()->route('logistics-loads.index')
            ->with('success', 'Logistics job deleted successfully!');
    }

    public function assign(Request $request, LogisticsLoad $logisticsJob)
    {
        $request->validate([
            'driver_id' => 'required|exists:users,id'
        ]);

        $driver = User::findOrFail($request->driver_id);
        
        if ($driver->user_type !== 'driver') {
            return back()->with('error', 'Selected user is not a driver.');
        }

        $logisticsJob->update([
            'driver_id' => $request->driver_id,
            'status' => 'assigned',
            'assigned_at' => now(),
        ]);

        return back()->with('success', 'Job assigned to driver successfully!');
    }

    public function accept(LogisticsLoad $logisticsJob)
    {
        $user = Auth::user();
        
        if ($user->user_type !== 'driver') {
            return back()->with('error', 'Only drivers can accept jobs.');
        }
        
        if ($logisticsJob->status !== 'pending') {
            return back()->with('error', 'This job is no longer available.');
        }
        
        if ($logisticsJob->driver_id !== null) {
            return back()->with('error', 'This job has already been assigned to another driver.');
        }
        
        $logisticsJob->update([
            'driver_id' => $user->id,
            'status' => 'assigned',
            'assigned_at' => now(),
        ]);
        
        return back()->with('success', 'Job accepted successfully! You can now start working on this job.');
    }

    public function updateStatus(Request $request, LogisticsLoad $logisticsJob)
    {
        $request->validate([
            'status' => 'required|in:pending,assigned,in_progress,picked_up,in_transit,delivered,completed,cancelled'
        ]);

        $statusData = ['status' => $request->status];

        switch ($request->status) {
            case 'in_progress':
                $statusData['started_at'] = now();
                break;
            case 'picked_up':
                $statusData['picked_up_at'] = now();
                break;
            case 'delivered':
                $statusData['delivered_at'] = now();
                break;
            case 'completed':
                $statusData['completed_at'] = now();
                break;
        }

        $logisticsJob->update($statusData);

        return back()->with('success', 'Job status updated successfully!');
    }
}
