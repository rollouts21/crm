<?php
namespace App\Models;

use App\Enums\DealsStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
