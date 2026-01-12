<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $actor_id
 * @property string $entity_type
 * @property int $entity_id
 * @property string $action
 * @property array<array-key, mixed>|null $changes
 * @property string|null $ip
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $actor
 * @property-read Model|\Eloquent $entity
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log whereActorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log whereChanges($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Log withoutTrashed()
 * @mixin \Eloquent
 */
class Log extends Model
{
    use SoftDeletes;

    protected $guarded = false;

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }

    protected $casts = [
        'changes' => 'array',
    ];

    public function actor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
