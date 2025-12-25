<?php
namespace App\Services;

use App\Enums\DealsStatusEnum;
use App\Models\Client;
use App\Models\Deal;
use App\QueryFilters\DealFilters;
use Illuminate\Pagination\LengthAwarePaginator;

class DealService
{
    public function getDeals(array $filters): LengthAwarePaginator
    {
        $deals = Deal::query()->with('client', 'owner');
        $deals = app(DealFilters::class)->apply($deals, $filters);

        return $deals->paginate(10)->withQueryString();
    }

    public function createDeal(array $data, Client $client): void
    {
        Deal::create([ ...$data, 'owner_id' => auth()->user()->id, 'client_id' => $client->id]);
    }

    public function updateDeal(array $data, Client $client, Deal $deal): void
    {

        if (isset($data['status'])) {
            if ($data['status'] == DealsStatusEnum::Won->value || $data['status'] == DealsStatusEnum::Lost->value) {
                $deal->update(['closed_at' => now()]);
            }
        }

        $deal->update($data);
    }

    public function loadRelationShipsToDeal(Deal $deal): Deal
    {
        // return $deal->load(['tasks', 'client' => function ($query) {
        //     $query->with('tasks');
        // }]);
        return $deal->load(['tasks', 'owner', 'client']);
    }
}
