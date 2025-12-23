<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Source extends Model
{
    use SoftDeletes, HasFactory;
    protected $guarded = false;

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
