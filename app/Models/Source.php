<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Client> $clients
 * @property-read int|null $clients_count
 * @method static \Database\Factories\SourceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Source withoutTrashed()
 * @mixin \Eloquent
 */
class Source extends Model
{
    use SoftDeletes, HasFactory;
    protected $guarded = false;

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
