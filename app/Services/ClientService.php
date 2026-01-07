<?php
namespace App\Services;

use App\Models\Client;
use App\Models\Log;
use App\Models\Source;
use App\QueryFilters\ClientFilters;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ClientService
{
    public function __construct(protected LogService $log)
    {}
    public function getClients(array $filters): LengthAwarePaginator
    {
        $clients = Client::query()->with('owner', 'deals');
        $clients = app(ClientFilters::class)->apply($clients, $filters);

        return $clients->paginate(10)->withQueryString();
    }

    public function getSources(): Collection
    {
        return Source::all();
    }

    public function createClient(array $data): void
    {
        $client = Client::create([ ...$data, 'owner_id' => auth()->user()->id]);
        $this->log->create($client, [
            'name'   => $client->name,
            'email'  => $client->email != null ? $client->email : 'null',
            'phone'  => $client->phone,
            'status' => $client->status->value,
            'city'   => $client->city != null ? $client->city : 'null',
            'note'   => $client->note != null ? $client->note : 'null',
            'source' => $client->source->value,
        ]);
    }

    public function updateClient(array $data, Client $client): void
    {
        $oldData = [
            'name'   => $client->name,
            'email'  => $client->email != null ? $client->email : 'null',
            'phone'  => $client->phone,
            'status' => $client->status->value,
            'city'   => $client->city != null ? $client->city : 'null',
            'note'   => $client->note != null ? $client->note : 'null',
            'source' => $client->source->value,
        ];
        $client->update([ ...$data, 'last_contact_at' => now()]);
        $newData = [
            'name'   => $client->name,
            'email'  => $client->email != null ? $client->email : 'null',
            'phone'  => $client->phone,
            'status' => $client->status->value,
            'city'   => $client->city != null ? $client->city : 'null',
            'note'   => $client->note != null ? $client->note : 'null',
            'source' => $client->source->value,
        ];

        $this->log->update($client, $oldData, $newData);
    }

    public function destroyClient(Client $client): void
    {
        $client->delete();
        $this->log->delete($client);
    }

    public function loadRelationShipsToClient(Client $client): Client
    {
        return $client->load(['source', 'deals' => function ($query) {
            $query->with('tasks');
        }]);
    }

}