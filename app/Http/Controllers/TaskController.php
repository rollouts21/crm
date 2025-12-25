<?php
namespace App\Http\Controllers;

use App\Http\Requests\TaskIndexRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Client;
use App\Models\Deal;
use App\Models\Task;
use App\QueryFilters\TaskFilters;

class TaskController extends Controller
{
    public function index(TaskIndexRequest $request)
    {
        $filters = $request->validated();
        $tasks   = Task::query()->with('client', 'deal');
        $tasks   = app(TaskFilters::class)->apply($tasks, $filters);
        return view('tasks.index', ['tasks' => $tasks->paginate(10)->withQueryString()]);
    }

    public function create(Client $client, Deal $deal)
    {
        return view('tasks.create', ['client' => $client, 'deal' => $deal]);
    }

    public function store(TaskRequest $request, Client $client, Deal $deal)
    {
        $data = $request->validated();

        $clientId = $client->id;
        $dealId   = $deal->id;
        $ownerId  = auth()->user()->id;

        Task::create([ ...$data, "client_id" => $clientId, 'deal_id' => $dealId, 'owner_id' => $ownerId]);

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show');
    }

    public function edit(Client $client, Deal $deal, Task $task)
    {
        return view('tasks.edit', ['client' => $client, 'deal' => $deal, 'task' => $task]);
    }

    public function update(TaskRequest $request, Client $client, Deal $deal, Task $task)
    {
        $data = $request->validated();
        $task->update($data);

        return redirect()->route('tasks.index');
    }

    public function destroy()
    {
        //
    }

}
