<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class facController extends Controller
{
    public function showForm()
    {
        return view('welcome');
    }

    public function getUserDetails(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::where('facultyId', $userId)->first();

        if (!$user || $user->status === 'pending' ) {
            return back()->with('error', 'User not found!');
        }

        return view('welcome', compact('user'));
    }
}
