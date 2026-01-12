<?php
namespace App\Models;

use App\Enums\ClientStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $owner_id
 * @property int $source_id
 * @property ClientStatusEnum $status
 * @property string $name
 * @property string $phone
 * @property string|null $email
 * @property string|null $city
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $last_contact_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Deal> $deals
 * @property-read int|null $deals_count
 * @property-read \App\Models\User $owner
 * @property-read \App\Models\Source $source
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @method static \Database\Factories\ClientFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereLastContactAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client withoutTrashed()
 * @mixin \Eloquent
 */
class Client extends Model
{
    use SoftDeletes, HasFactory;
    protected $guarded = false;

    protected $casts = [
        'status'          => ClientStatusEnum::class,
        'last_contact_at' => 'datetime',
    ];

    // public function getOwner()
    // {
    //     return User::find($this->owner_id)->name;
    // }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function allTasks(): int
    {
        $count = 0;
        foreach ($this->deals as $deal) {
            $count += $deal->tasks->where('status', '=', 'open')->count();
        }
        return $count;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getWonTotal()
    {
        // $total = 0;
        // foreach ($this->deals as $deal) {
        //     $total += (int) $deal->where('status', '=', 'won')->get('amount');
        // }
        return $this->deals->where('status', '=', 'won')->sum('amount');
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
}
