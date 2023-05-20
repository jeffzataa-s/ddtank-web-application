<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_name',
        'version'
    ];

    public function Database(): HasOne
    {
        return $this->hasOne(ServerDatabase::class);
    }
}
