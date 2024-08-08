<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Travel;

class MainController extends Controller
{
    public function dashboard()
    {
        // Recupera i viaggi dell'utente loggato
        $travels = Travel::where('user_id', Auth::id())->get();

        // Passa i viaggi alla vista
        return view('admin.dashboard', compact('travels'));
    }
}
