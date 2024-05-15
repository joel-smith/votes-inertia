<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function show()
    {
        $userPolls = Poll::where('user_id', auth()->user()->id)->get();
        return Inertia::render('Dashboard', ['userPolls' => $userPolls]);
    }
}
