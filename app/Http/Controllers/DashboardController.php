<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Document;

class DashboardController extends Controller
{
    function index(Request $request){
        if (! Gate::allows('View Dashboard')) {
            abort(403);
        }

        return view('dashboard.index');
    }
	
}
