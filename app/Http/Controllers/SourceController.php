<?php

namespace App\Http\Controllers;

use App\Http\Requests\SourceRequest;
use App\Models\Source;
use App\Services\LogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SourceController extends Controller
{
    public function __construct(protected LogService $log) {}
    public function index(): View
    {
        return view('sources.index', ['sources' => Source::all()]);
    }

    public function create(): View
    {
        return view('sources.create');
    }

    public function edit(Source $source): View
    {
        return view('sources.edit', ['source' => $source]);
    }

    public function store(SourceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $source = Source::create($data);
        $this->log->create($source, ['name' => $source->name]);
        return redirect()->route('source.index');
    }

    public function update(SourceRequest $request, Source $source): RedirectResponse
    {
        $oldData = [
            'name' => $source->name,
        ];
        $data = $request->validated();
        $source->update($data);
        $newData = [
            'name' => $source->name,
        ];

        $this->log->update($source, $oldData, $newData);
        return redirect()->route('source.index');
    }
}
