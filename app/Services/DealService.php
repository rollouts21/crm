<?php
namespace App\Services;

use App\Enums\DealsStatusEnum;
use App\Models\Client;
use App\Models\Deal;
use App\QueryFilters\DealFilters;
use Illuminate\Pagination\LengthAwarePaginator;

class DealService
{
    public function __construct(protected LogService $log)
    {}
    public function getDeals(array $filters): LengthAwarePaginator
    {
        $deals = Deal::query()->with('client', 'owner');
        $deals = app(DealFilters::class)->apply($deals, $filters);

        return $deals->paginate(10)->withQueryString();
    }

    public function createDeal(array $data, Client $client): void
    {
        $deal = Deal::create([ ...$data, 'owner_id' => auth()->user()->id, 'client_id' => $client->id]);
        $this->log->create($deal, [
            'title'             => $deal->title,
            'amount'            => $deal->amount,
            'status'            => $deal->status->value,
            'expected_close_at' => $deal->expected_close_at,
            'comment'           => $deal->comment,

        ]);
    }

    public function updateDeal(array $data, Client $client, Deal $deal): void
    {

        if (isset($data['status'])) {
            if ($data['status'] == DealsStatusEnum::Won->value || $data['status'] == DealsStatusEnum::Lost->value) {
                $deal->update(['closed_at' => now()]);
            }
        }
        $oldData = [
            'title'             => $deal->title,
            'amount'            => $deal->amount,
            'status'            => $deal->status->value,
            'expected_close_at' => $deal->expected_close_at,
            'closed_at'         => $deal->closed_at != null ? $deal->closed_at : 'null',
            'lost_reason'       => $deal->lost_reason != null ? $deal->lost_reason : 'null',
            'comment'           => $deal->comment,
        ];
        $deal->update($data);
        $newData = [
            'title'             => $deal->title,
            'amount'            => $deal->amount,
            'status'            => $deal->status->value,
            'expected_close_at' => $deal->expected_close_at,
            'closed_at'         => $deal->closed_at != null ? $deal->closed_at : 'null',
            'lost_reason'       => $deal->lost_reason != null ? $deal->lost_reason : 'null',
            'comment'           => $deal->comment,
        ];

        $this->log->update($deal, $oldData, $newData);
    }

    public function loadRelationShipsToDeal(Deal $deal): Deal
    {
        // return $deal->load(['tasks', 'client' => function ($query) {
        //     $query->with('tasks');
        // }]);
        return $deal->load(['tasks', 'owner', 'client']);
    }
}
