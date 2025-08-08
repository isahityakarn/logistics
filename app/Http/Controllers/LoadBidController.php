<?php

namespace App\Http\Controllers;

use App\Models\LoadBid;
use App\Models\LogisticsLoad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoadBidController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->user_type === 'admin') {
            $prices = LoadBid::with(['logisticsJob', 'company'])->latest();
        } elseif ($user->user_type === 'company') {
            $prices = LoadBid::with(['logisticsJob', 'company'])
                ->where('company_id', $user->id)
                ->latest();
        } elseif ($user->user_type === 'driver') {
            // Drivers can view prices for jobs they are assigned to

            $logisticsJobId = LogisticsLoad::where('driver_id', $user->id)->pluck('id');
            // return $logisticsJobId;
            $prices = LoadBid::with(['logisticsJob', 'company'])
            ->whereIn('logisticjob_id', $logisticsJobId)
                ->whereHas('logisticsJob', function($query) use ($user) {
                    $query->where('driver_id', $user->id);
                })
                ->latest();
        } else {
            $prices = LoadBid::whereNull('id'); // Empty collection
        }
        
        $prices = $prices->paginate(10);
        
        return view('load-bids.index', compact('prices'));
    }

    public function create()
    {
        $user = Auth::user();
        
        if (!in_array($user->user_type, ['admin', 'company'])) {
            return redirect()->route($this->getIndexRoute())
                ->with('error', 'Only admin and company users can create job prices.');
        }
        
        $logisticsJobs = LogisticsLoad::all();
        $companies = User::where('user_type', 'company')->get();
        
        return view('load-bids.create', compact('logisticsJobs', 'companies'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if (!in_array($user->user_type, ['admin', 'company'])) {
            return redirect()->route($this->getIndexRoute())
                ->with('error', 'Only admin and company users can create job prices.');
        }

        $validator = Validator::make($request->all(), [
            'logisticjob_id' => 'required|exists:logistics_load,id',
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

        LoadBid::create($data);

        $redirectRoute = $this->getIndexRoute();
        return redirect()->route($redirectRoute)
            ->with('success', 'Load price created successfully!');
    }

    public function show(LoadBid $loadPrice)
    {
        $user = Auth::user();
        
        if ($user->user_type === 'company' && $loadPrice->company_id !== $user->id) {
            return redirect()->route('load-bids.index')
                ->with('error', 'You can only view your own job prices.');
        }
        
        if ($user->user_type === 'driver') {
            // Drivers can only view prices for jobs they are assigned to
            if ($loadPrice->logisticsJob->driver_id !== $user->id) {
                return redirect()->route('load-bids.index')
                    ->with('error', 'You can only view prices for jobs assigned to you.');
            }
        }

        return view('load-bids.show', compact('loadPrice'));
    }

    public function edit(LoadBid $loadPrice)
    {
        $user = Auth::user();
        
        if (!in_array($user->user_type, ['admin', 'company'])) {
            return redirect()->route('load-bids.index')
                ->with('error', 'Only admin and company users can edit job prices.');
        }
        
        if ($user->user_type === 'company' && $loadPrice->company_id !== $user->id) {
            return redirect()->route('load-bids.index')
                ->with('error', 'You can only edit your own job prices.');
        }
        
        $logisticsJobs = LogisticsLoad::all();
        $companies = User::where('user_type', 'company')->get();
        
        return view('load-bids.edit', compact('loadPrice', 'logisticsJobs', 'companies'));
    }

    public function update(Request $request, LoadBid $loadPrice)
    {
        $user = Auth::user();
        
        if (!in_array($user->user_type, ['admin', 'company'])) {
            return redirect()->route('load-bids.index')
                ->with('error', 'Only admin and company users can update job prices.');
        }
        
        if ($user->user_type === 'company' && $loadPrice->company_id !== $user->id) {
            return redirect()->route('load-bids.index')
                ->with('error', 'You can only update your own job prices.');
        }

        $validator = Validator::make($request->all(), [
            'logisticjob_id' => 'required|exists:logistics_load,id',
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

        $loadPrice->update($data);

        return redirect()->route('load-bids.index')
            ->with('success', 'Load price updated successfully!');
    }

    public function destroy(LoadBid $loadPrice)
    {
        $user = Auth::user();
        
        if (!in_array($user->user_type, ['admin', 'company'])) {
            return redirect()->route('load-bids.index')
                ->with('error', 'Only admin and company users can delete job prices.');
        }
        
        if ($user->user_type === 'company' && $loadPrice->company_id !== $user->id) {
            return redirect()->route('load-bids.index')
                ->with('error', 'You can only delete your own job prices.');
        }
        
        $loadPrice->delete();

        return redirect()->route('load-bids.index')
            ->with('success', 'Load price deleted successfully!');
    }

    private function getIndexRoute()
    {
        $user = Auth::user();
        return match($user->user_type) {
            'admin' => 'admin.load-bids.index',
            'company' => 'company.load-bids.index',
            'driver' => 'driver.load-bids.index',
            default => 'load-bids.index'
        };
    }

    private function getCreateRoute()
    {
        $user = Auth::user();
        return match($user->user_type) {
            'admin' => 'admin.load-bids.create',
            'company' => 'company.load-bids.create',
            default => 'load-bids.create'
        };
    }
}
