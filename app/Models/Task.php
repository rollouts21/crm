<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, HasFactory;
    protected $guarded = false;

    protected $casts = [
        'due_at'   => 'date',
        'priority' => \App\Enums\TaskPriorityEnum::class,
        'status'   => \App\Enums\TaskStatusEnum::class,
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }

}
