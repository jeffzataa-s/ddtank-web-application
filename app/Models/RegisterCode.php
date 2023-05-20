<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code'
    ];

    public function scopecanUse(Builder $query, $code): bool
    {
        if (!$code) 
            return false;

        $registerCode = RegisterCode::where('code', $code)->first();
        if ($registerCode && Carbon::now() <= $registerCode->expire_at)
            return true;

        return false;
    }
}
