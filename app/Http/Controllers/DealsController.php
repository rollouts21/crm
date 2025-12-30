<?php
namespace App\Http\Controllers;

use App\Http\Requests\DealIndexRequest;
use App\Http\Requests\DealsRequest;
use App\Models\Client;
use App\Models\Deal;
use App\Services\ClientService;
use App\Services\DealService;

class DealsController extends Controller
{
    public function __construct(protected DealService $service, protected ClientService $client)
    {

    }
    public function index(DealIndexRequest $request)
    {
        $filters = $request->validated();
        return view('deals.index', ['deals' => $this->service->getDeals($filters)]);
    }

    public function create(Client $client)
    {
        return view('deals.create', ['client' => $client]);
    }

    public function store(Client $client, DealsRequest $request)
    {
        $data = $request->validated();
        $this->service->createDeal($data, $client);
        return redirect()->route('deals.index');
    }

    public function show(Client $client, Deal $deal, )
    {
        $client = $this->client->loadRelationShipsToClient($client);
        return view('deals.show', ['client' => $client, 'deal' => $this->service->loadRelationShipsToDeal($deal)]);
    }

    public function edit(Client $client, Deal $deal)
    {
        return view('deals.edit', ['deal' => $deal]);
    }

    public function update(Client $client, Deal $deal, DealsRequest $request)
    {
        $data = $request->validated();
        $this->service->updateDeal($data, $client, $deal);

        return redirect()->route('deals.index');
    }
}
