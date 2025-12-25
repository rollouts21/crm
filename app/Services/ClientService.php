<?php
namespace App\Services;

use App\Models\Client;
use App\Models\Source;
use App\QueryFilters\ClientFilters;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ClientService
{
    public function getClients(array $filters): LengthAwarePaginator
    {
        $clients = Client::query()->with('owner');
        $clients = app(ClientFilters::class)->apply($clients, $filters);

        return $clients->paginate(10)->withQueryString();
    }

    public function getSources(): Collection
    {
        return Source::all();
    }

    public function createClient(array $data): void
    {
        Client::create([ ...$data, 'owner_id' => auth()->user()->id]);
    }

    public function updateClient(array $data, Client $client): void
    {
        $client->update([ ...$data, 'last_contact_at' => now()]);
    }

    public function destroyClient(Client $client): void
    {
        $client->delete();
    }

    public function loadRelationShipsToClient(Client $client): Client
    {
        return $client->load(['source', 'deals' => function ($query) {
            $query->with('tasks');
        }]);
    }
}
