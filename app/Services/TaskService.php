<?php
namespace App\Services;

use App\Enums\TaskStatusEnum;
use App\Models\Client;
use App\Models\Deal;
use App\Models\Task;
use App\QueryFilters\TaskFilters;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService
{

    public function __construct(protected LogService $log)
    {}
    public function getTasks(array $filters): LengthAwarePaginator
    {

        $tasks = Task::query()->with('client', 'deal');
        $tasks = app(TaskFilters::class)->apply($tasks, $filters);

        return $tasks->paginate(10)->withQueryString();
    }

    public function createTask(array $data, Client $client, Deal $deal): void
    {

        $clientId = $client->id;
        $dealId   = $deal->id;
        $ownerId  = auth()->user()->id;

        $task = Task::create([ ...$data, "client_id" => $clientId, 'deal_id' => $dealId, 'owner_id' => $ownerId]);
        $this->log->create($task, [
            'title'       => $task->title,
            'description' => $task->description != null ? $task->description : 'null',
            'due_at'      => $task->due_at,
            'status'      => $task->status->value,
            'priority'    => $task->priority->value,
        ]);
    }

    public function updateTask(array $data, Client $client, Deal $deal, Task $task): void
    {

        $oldData = [
            'title'       => $task->title,
            'description' => $task->description != null ? $task->description : 'null',
            'due_at'      => $task->due_at,
            'status'      => $task->status->value,
            'priority'    => $task->priority->value,
        ];
        if (isset($data['status'])) {
            if ($data['status'] == TaskStatusEnum::Done->value || $data['status'] == TaskStatusEnum::Canceled->value) {
                $task->update(['completed_at' => now()]);
            }
        }

        $task->update($data);
        $newData = [
            'title'       => $task->title,
            'description' => $task->description != null ? $task->description : 'null',
            'due_at'      => $task->due_at,
            'status'      => $task->status->value,
            'priority'    => $task->priority->value,
        ];

        $this->log->update($task, $oldData, $newData);
    }

}
