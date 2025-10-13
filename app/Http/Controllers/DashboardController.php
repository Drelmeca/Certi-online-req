<?php

namespace App\Http\Controllers;

use App\Models\CertRequest;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 1) {
            return redirect()->route('CertRequest');
        }

        // Example: Get counts from your tables
        $totalClaims = CertRequest::where('status',  1)->count();
        $pendingRequests = CertRequest::where('status', 0)->count();
        $totalAdmins = User::where('role', 2)->count();

        return Inertia::render('Dashboard', [
            'totalClaims'=> $totalClaims,
            'pendingRequests' => $pendingRequests,
            'totalAdmins' => $totalAdmins,
        ]);
    }
    
}