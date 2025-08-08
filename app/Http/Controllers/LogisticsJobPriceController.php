<?php

namespace App\Http\Controllers;

use App\Models\LogisticsJobPrice;
use App\Models\LogisticsJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LogisticsJobPriceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->user_type === 'admin') {
            $prices = LogisticsJobPrice::with(['logisticsJob', 'company'])->latest();
        } elseif ($user->user_type === 'company') {
            $prices = LogisticsJobPrice::with(['logisticsJob', 'company'])
                ->where('company_id', $user->id)
                ->latest();
        } elseif ($user->user_type === 'driver') {
            // Drivers can view prices for jobs they are assigned to

            $logisticsJobId = LogisticsJob::where('driver_id', $user->id)->pluck('id');
            // return $logisticsJobId;
            $prices = LogisticsJobPrice::with(['logisticsJob', 'company'])
            ->whereIn('logisticjob_id', $logisticsJobId)
                ->whereHas('logisticsJob', function($query) use ($user) {
                    $query->where('driver_id', $user->id);
                })
                ->latest();
        } else {
            $prices = LogisticsJobPrice::whereNull('id'); // Empty collection
        }
        
        $prices = $prices->paginate(10);
        
        return view('logistics-job-prices.index', compact('prices'));
    }

    public function create()
    {
        $user = Auth::user();
        
        if (!in_array($user->user_type, ['admin', 'company'])) {
            return redirect()->route($this->getIndexRoute())
                ->with('error', 'Only admin and company users can create job prices.');
        }
        
        $logisticsJobs = LogisticsJob::all();
        $companies = User::where('user_type', 'company')->get();
        
        return view('logistics-job-prices.create', compact('logisticsJobs', 'companies'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!in_array($user->user_type, ['admin', 'company'])) {
            return redirect()->route($this->getIndexRoute())
                ->with('error', 'Only admin and company users can create job prices.');
        }

        $validator = Validator::make($request->all(), [
            'logisticjob_id' => 'required|exists:logistics_jobs,id',
            'company_id' => 'required|exists:users,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,assigned,in_progress,picked_up,in_transit,delivered,completed,cancelled'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $company = User::findOrFail($request->company_id);
        if ($company->user_type !== 'company') {
            return back()->with('error', 'Selected user must be a company.');
        }

        $data = $request->all();
        
        if ($user->user_type === 'company') {
            $data['company_id'] = $user->id;
        }

        LogisticsJobPrice::create($data);

        $redirectRoute = $this->getIndexRoute();
        return redirect()->route($redirectRoute)
            ->with('success', 'Logistics job price created successfully!');
    }

    public function show(LogisticsJobPrice $logisticsJobPrice)
    {
        $user = Auth::user();
        
        if ($user->user_type === 'company' && $logisticsJobPrice->company_id !== $user->id) {
            return redirect()->route('logistics-job-prices.index')
                ->with('error', 'You can only view your own job prices.');
        }
        
        if ($user->user_type === 'driver') {
            // Drivers can only view prices for jobs they are assigned to
            if ($logisticsJobPrice->logisticsJob->driver_id !== $user->id) {
                return redirect()->route('logistics-job-prices.index')
                    ->with('error', 'You can only view prices for jobs assigned to you.');
            }
        }

        return view('logistics-job-prices.show', compact('logisticsJobPrice'));
    }

    public function edit(LogisticsJobPrice $logisticsJobPrice)
    {
        $user = Auth::user();
        
        if (!in_array($user->user_type, ['admin', 'company'])) {
            return redirect()->route('logistics-job-prices.index')
                ->with('error', 'Only admin and company users can edit job prices.');
        }
        
        if ($user->user_type === 'company' && $logisticsJobPrice->company_id !== $user->id) {
            return redirect()->route('logistics-job-prices.index')
                ->with('error', 'You can only edit your own job prices.');
        }
        
        $logisticsJobs = LogisticsJob::all();
        $companies = User::where('user_type', 'company')->get();
        
        return view('logistics-job-prices.edit', compact('logisticsJobPrice', 'logisticsJobs', 'companies'));
    }

    public function update(Request $request, LogisticsJobPrice $logisticsJobPrice)
    {
        $user = Auth::user();
        
        if (!in_array($user->user_type, ['admin', 'company'])) {
            return redirect()->route('logistics-job-prices.index')
                ->with('error', 'Only admin and company users can update job prices.');
        }
        
        if ($user->user_type === 'company' && $logisticsJobPrice->company_id !== $user->id) {
            return redirect()->route('logistics-job-prices.index')
                ->with('error', 'You can only update your own job prices.');
        }

        $validator = Validator::make($request->all(), [
            'logisticjob_id' => 'required|exists:logistics_jobs,id',
            'company_id' => 'required|exists:users,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,assigned,in_progress,picked_up,in_transit,delivered,completed,cancelled'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $company = User::findOrFail($request->company_id);
        if ($company->user_type !== 'company') {
            return back()->with('error', 'Selected user must be a company.');
        }

        $data = $request->all();
        
        if ($user->user_type === 'company') {
            $data['company_id'] = $user->id;
        }

        $logisticsJobPrice->update($data);

        return redirect()->route('logistics-job-prices.index')
            ->with('success', 'Logistics job price updated successfully!');
    }

    public function destroy(LogisticsJobPrice $logisticsJobPrice)
    {
        $user = Auth::user();
        
        if (!in_array($user->user_type, ['admin', 'company'])) {
            return redirect()->route('logistics-job-prices.index')
                ->with('error', 'Only admin and company users can delete job prices.');
        }
        
        if ($user->user_type === 'company' && $logisticsJobPrice->company_id !== $user->id) {
            return redirect()->route('logistics-job-prices.index')
                ->with('error', 'You can only delete your own job prices.');
        }
        
        $logisticsJobPrice->delete();

        return redirect()->route('logistics-job-prices.index')
            ->with('success', 'Logistics job price deleted successfully!');
    }

    private function getIndexRoute()
    {
        $user = Auth::user();
        return match($user->user_type) {
            'admin' => 'admin.job-prices.index',
            'company' => 'company.job-prices.index',
            'driver' => 'driver.job-prices.index',
            default => 'logistics-job-prices.index'
        };
    }

    private function getCreateRoute()
    {
        $user = Auth::user();
        return match($user->user_type) {
            'admin' => 'admin.job-prices.create',
            'company' => 'company.job-prices.create',
            default => 'logistics-job-prices.create'
        };
    }
}
