<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboardAdmin()
    {
        $dailyRegistrations = [];
        
        // Get registrations for last 7 days
        for($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = User::whereDate('created_at', $date)->count();
            $dailyRegistrations[] = $count;
        }

        return view('Admin.adminHome', compact('dailyRegistrations'));
    }

    public function profileAdmin(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function index()
    {
        $dailyRegistrations = [];
        
        // Get registrations for last 7 days
        for($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = User::whereDate('created_at', $date)->count();
            $dailyRegistrations[] = $count;
        }

        return view('Admin.adminHome', compact('dailyRegistrations'));
    }
}


