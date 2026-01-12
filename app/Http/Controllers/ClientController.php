<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientIndexRequest;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function __construct(protected ClientService $service)
    {

    }

    public function index(ClientIndexRequest $request): View
    {
        $filters = $request->validated();
        return view('clients.index', ['clients' => $this->service->getClients($filters), 'sources' => $this->service->getSources()]);
    }

    public function create(): View
    {
        return view('clients.create', ['sources' => $this->service->getSources()]);
    }

    public function store(ClientRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->service->createClient($data);

        return redirect()->route('clients.index');
    }

    public function show(Client $client)
    {

        return view('clients.show', ['client' => $this->service->loadRelationShipsToClient($client), 'sources' => $this->service->getSources()]);
    }

    public function edit(Client $client)
    {
        return view('clients.edit', ['client' => $client, 'sources' => $this->service->getSources()]);
    }

    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
        $data = $request->validated();
        $this->service->updateClient($data, $client);

        return redirect()->route('clients.index');
    }

    public function destroy(Client $client): RedirectResponse
    {
        $this->service->destroyClient($client);
        return redirect()->route('clients.index');
    }
}
