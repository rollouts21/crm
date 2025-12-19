<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    protected $guarded = false;

    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}
