<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServerDatabase extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_id',
        'driver',
        'host',
        'port',
        'username',
        'password',
        'base_user',
        'base_game'
    ];

    protected $hidden = [
        'username',
        'password'
    ];

    public function Server(): BelongsTo
    {
        return $this->belongsTo(Server::class);
    }
}
