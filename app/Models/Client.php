<?php
namespace App\Models;

use App\Enums\ClientStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes, HasFactory;
    protected $guarded = false;

    protected $casts = [
        'status'          => ClientStatusEnum::class,
        'last_contact_at' => 'datetime',
    ];

    public function getOwner()
    {
        return User::find($this->owner_id)->name;
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
