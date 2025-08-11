<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function byType()
    {
        $drivers = User::where('user_type', 'driver')->get();
        $companies = User::where('user_type', 'company')->get();
        $all = User::where('user_type','!=', 'admin')->orderby('id', 'desc')->paginate(15);
        return view('admin.users.by_type', compact('drivers', 'companies', 'all'));
    }
}
