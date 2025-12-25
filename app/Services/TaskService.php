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

        Task::create([ ...$data, "client_id" => $clientId, 'deal_id' => $dealId, 'owner_id' => $ownerId]);
    }

    public function updateTask(array $data, Client $client, Deal $deal, Task $task): void
    {

        if (isset($data['status'])) {
            if ($data['status'] == TaskStatusEnum::Done->value || $data['status'] == TaskStatusEnum::Canceled->value) {
                $task->update(['completed_at' => now()]);
            }
        }

        $task->update($data);
    }

}
