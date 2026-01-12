<?php
namespace App\Models;

use App\Enums\DealsStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $client_id
 * @property int $owner_id
 * @property string $title
 * @property numeric $amount
 * @property DealsStatusEnum $status
 * @property \Illuminate\Support\Carbon $expected_close_at
 * @property \Illuminate\Support\Carbon|null $closed_at
 * @property string|null $lost_reason
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 * @property-read int|null $tasks_count
 * @method static \Database\Factories\DealFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereExpectedCloseAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereLostReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Deal withoutTrashed()
 * @mixin \Eloquent
 */
class Deal extends Model
{
    use SoftDeletes, HasFactory;
    protected $guarded = false;
    protected $casts   = [
        'status'            => DealsStatusEnum::class,
        'expected_close_at' => 'date',
        'closed_at'         => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
