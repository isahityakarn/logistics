<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function byType(Request $request)
    {
        $drivers = User::where('user_type', 'driver')->get();
        $companies = User::where('user_type', 'company')->get();

        $query = User::query()
            ->where('user_type', '!=', 'admin')
            ->orderByDesc('id');

        // Text filters: name, phone, email, address
        if ($request->filled('name')) {
            $query->where('name', 'like', '%'.trim((string) $request->input('name')).'%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%'.trim((string) $request->input('phone')).'%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%'.trim((string) $request->input('email')).'%');
        }
        if ($request->filled('address')) {
            $query->where('address', 'like', '%'.trim((string) $request->input('address')).'%');
        }

        // Date range filters: created_from, created_to (YYYY-MM-DD)
        if ($request->filled('created_from')) {
            $query->whereDate('created_at', '>=', (string) $request->input('created_from'));
        }
        if ($request->filled('created_to')) {
            $query->whereDate('created_at', '<=', (string) $request->input('created_to'));
        }

        $all = $query->paginate(15)->appends($request->query());
        return view('admin.users.by_type', compact('drivers', 'companies', 'all'));
    }
}
