<?php
namespace App\Http\Controllers;

use App\Http\Requests\TaskIndexRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Client;
use App\Models\Deal;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller
{

    public function __construct(protected TaskService $service)
    {}
    public function index(TaskIndexRequest $request)
    {
        $filters = $request->validated();
        return view('tasks.index', ['tasks' => $this->service->getTasks($filters)]);
    }

    public function create(Client $client, Deal $deal)
    {
        return view('tasks.create', ['client' => $client, 'deal' => $deal]);
    }

    public function store(TaskRequest $request, Client $client, Deal $deal)
    {
        $data = $request->validated();

        $this->service->createTask($data, $client, $deal);
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
        $this->service->updateTask($data, $client, $deal, $task);
        return redirect()->route('tasks.index');
    }

    public function destroy()
    {
        //
    }

}
