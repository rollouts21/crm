<?php
namespace App\Http\Controllers;

use App\Http\Requests\ClientIndexRequest;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Source;
use App\QueryFilters\ClientFilters;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(ClientIndexRequest $request): View
    {
        $filters = $request->validated();
        $clients = Client::query()->with('owner');
        $clients = app(ClientFilters::class)->apply($clients, $filters);
        return view('clients.index', ['clients' => $clients->paginate(15)->withQueryString(), 'sources' => Source::all()]);
    }

    public function create(): View
    {
        return view('clients.create', ['sources' => Source::all()]);
    }

    public function store(ClientRequest $request)
    {
        $data             = $request->validated();
        $data['owner_id'] = auth()->user()->id;

        Client::create([ ...$data, 'owner_id' => auth()->user()->id]);

        return redirect()->route('clients.index');
    }

    public function show(Client $client)
    {
        return view('clients.show', ['client' => $client, 'sources' => Source::all()]);
    }

    public function edit(Client $client)
    {
        return view('clients.edit', ['client' => $client, 'sources' => Source::all()]);
    }

    public function update(ClientRequest $request, Client $client)
    {
        $data = $request->validated();
        $client->update($data);
        // $client->update(['last_contact_at' => now()]);

        return redirect()->route('clients.index');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index');
    }
}
