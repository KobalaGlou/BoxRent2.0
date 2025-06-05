<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class FrontendController extends Controller
{
    public function index()
    {

        if (auth()->check()) {
            return Inertia::render('AuthIndex', [
            ]);
        }else{
            return Inertia::render('GuestIndex', [
            ]);
        }
    }
}
