<?php
namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Source;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        return view('clients.index', ['clients' => Client::paginate(10)]);
    }

    public function create(): View
    {
        return view('clients.create', ['sources' => Source::all()]);
    }

    public function store(ClientRequest $request)
    {
        $data             = $request->validated();
        $data['owner_id'] = auth()->user()->id;

        Client::create($data);

        return redirect()->route('clients.index');
    }
}
