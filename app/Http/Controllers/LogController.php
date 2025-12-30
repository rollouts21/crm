<?php
namespace App\Http\Controllers;

use App\Models\Log;
use App\QueryFilters\LogFilters;
use \Illuminate\View\View;

class LogController extends Controller
{
    public function index(): View
    {
        $filters = request()->validate([
            'action'      => 'nullable',
            'entity_type' => 'nullable',
            'min'         => 'nullable',
            'max'         => 'nullable',
        ]);
        $logs = Log::query();
        $logs = app(LogFilters::class)->apply($logs, $filters);
        return view('logs.index', ['logs' => $logs->paginate(10)->withQueryString()]);
    }

    public function show(Log $log): View
    {
        return view('logs.show', ['log' => $log]);
    }
}
