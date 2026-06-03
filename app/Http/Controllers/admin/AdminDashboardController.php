<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $latestNews = \App\Models\News::latest()->take(4)->get();
        return view('admin.dashboard', compact('latestNews'));
    }
}