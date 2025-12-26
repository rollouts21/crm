<?php
namespace App\Http\Controllers;

use App\Enums\ClientStatusEnum;
use App\Models\Client;
use App\Models\Deal;
use App\Models\Task;

class MainController extends Controller
{
    public function index()
    {
        $totalClient     = Client::count();
        $totalNewClients = Client::where('status', '=', ClientStatusEnum::New ->value)->count();
        $openDeals       = Deal::count();
        $wonTotal        = Deal::all()->sum('amount');
        $tasksToday      = Task::whereDate('due_at', now())->get();
        return view('index', ['totalClient' => $totalClient, 'totalNewClients' => $totalNewClients, 'openDeals' => $openDeals, 'wonTotal' => $wonTotal, 'tasksToday' => $tasksToday]);
    }
}
