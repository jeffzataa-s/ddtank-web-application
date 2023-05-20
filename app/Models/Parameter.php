<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    protected $fillable = [
        "key",
        "value"
    ];

    public function scopegetValueFromKey(Builder $query, string $key){
        return $this->where('key', $key)->first()->value;
    }
}
