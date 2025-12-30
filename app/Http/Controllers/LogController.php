<?php
namespace App\Http\Controllers;

use App\Models\Log;
use \Illuminate\View\View;

class LogController extends Controller
{
    public function index(): View
    {
        return view('logs.index', ['logs' => Log::all()]);
    }

    public function show(Log $log): View
    {
        return view('logs.show', ['log' => $log]);
    }
}
