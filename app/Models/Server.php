<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function Applications(): HasMany
    {
        return $this->hasMany(ServerApplication::class);
    }

    public function scopegetApplicationByKey(Builder $query, string $key){
        return $this->Applications->where('key', $key)->first();
    }
}
