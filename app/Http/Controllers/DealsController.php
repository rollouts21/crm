<?php
namespace App\Http\Controllers;

use App\Enums\DealsStatusEnum;
use App\Http\Requests\DealsRequest;
use App\Models\Client;
use App\Models\Deal;

class DealsController extends Controller
{
    public function index()
    {
        return view('deals.index', ['deals' => Deal::with('client', 'owner')->paginate(10)->withQueryString()]);
    }

    public function create(Client $client)
    {
        return view('deals.create', ['client' => $client]);
    }

    public function store(Client $client, DealsRequest $request)
    {
        $data = $request->validated();
        Deal::create([ ...$data, 'owner_id' => auth()->user()->id, 'client_id' => $client->id]);

        return redirect()->route('deals.index');
    }

    public function show(Client $client, Deal $deal)
    {
        return view('deals.show', ['client' => $client, 'deal' => $deal]);
    }

    public function edit(Client $client, Deal $deal)
    {
        return view('deals.edit', ['deal' => $deal]);
    }

    public function update(Client $client, Deal $deal, DealsRequest $request)
    {
        $data = $request->validated();
        if (isset($data['status'])) {
            if ($data['status'] == DealsStatusEnum::Won->value || $data['status'] == DealsStatusEnum::Lost->value) {
                $deal->update(['closed_at' => now()]);
            }
        }
        $deal->update($data);

        return redirect()->route('deals.index');
    }
}
