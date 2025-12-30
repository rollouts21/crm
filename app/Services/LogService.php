<?php
namespace App\Services;

use App\Models\Log;
use Illuminate\Database\Eloquent\Model;

class LogService
{
    public function log(Model $entity, string $action, array $changes = []): void
    {
        Log::create([
            'actor_id'    => auth()->user()->id,
            'entity_type' => class_basename($entity),
            'entity_id'   => $entity->getKey(),
            'action'      => $action,
            'changes'     => $changes,
            'ip'          => request()->ip(),
            'user_agent'  => request()->userAgent(),
        ]);
    }

    public function create(Model $entity, array $data): void
    {
        $this->log($entity, 'create', ['new' => $data]);
    }

    public function update(Model $entity, array $oldData, array $newData): void
    {
        $this->log($entity, 'update', ['old' => $oldData, 'new' => $newData]);
    }

    public function delete(Model $entity): void
    {
        $this->log($entity, 'delete', []);
    }
}
