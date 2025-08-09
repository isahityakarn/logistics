<?php
namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Load;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function index()
    {
        // Show only the current driver's bids if user is a driver
        if (Auth::user() && Auth::user()->user_type === 'driver') {
            $bids = Bid::with(['loadRelation', 'driver'])
                ->where('driver_id', Auth::id())
                ->latest()
                ->paginate(10);
        } else {
            // Admin or company sees all bids
            $bids = Bid::with(['loadRelation', 'driver'])->latest()->paginate(10);
        }
        return view('admin.bids.index', compact('bids'));
    }

    public function create(Request $request)
    {
        $loads = Load::all();
        $drivers = User::where('user_type', 'driver')->get();
        $selectedLoadId = $request->query('load_id');
        return view('admin.bids.create', compact('loads', 'drivers', 'selectedLoadId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'load_id' => 'required|exists:loads,id',
            'driver_id' => 'required|exists:users,id',
            'price' => 'nullable|numeric',
            'status' => 'required|string',
        ]);
        Bid::create($data);
        return redirect()->route('bids.index')->with('success', 'Bid created successfully.');
    }

    public function show(Bid $bid)
    {
        $bid->load(['loadRelation', 'driver']);
        return view('admin.bids.show', compact('bid'));
    }

    public function edit(Bid $bid)
    {
        $loads = Load::all();
        $drivers = User::where('user_type', 'driver')->get();
        return view('admin.bids.edit', compact('bid', 'loads', 'drivers'));
    }

    public function update(Request $request, Bid $bid)
    {
        $data = $request->validate([
            'load_id' => 'required|exists:loads,id',
            'driver_id' => 'required|exists:users,id',
            'price' => 'nullable|numeric',
            'status' => 'required|string',
        ]);
        $bid->update($data);
        return redirect()->route('bids.index')->with('success', 'Bid updated successfully.');
    }

    public function destroy(Bid $bid)
    {
        $bid->delete();
        return redirect()->route('bids.index')->with('success', 'Bid deleted successfully.');
    }
}
