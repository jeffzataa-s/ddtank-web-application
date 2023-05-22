<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class GameUserCharacter extends Model
{
    use HasFactory;

    protected $table = "Sys_Users_Detail";

    protected $search = [
        'UserID', 'UserName', 'NickName', 'Grade', 'GP', 'GiftToken', 'Money'
    ];

   
    public function scopegetGameConnection(Builder $query, int $serverId)
    {
        if ($serverId) {
            $server = Server::find($serverId);
            if ($server && isset($server->database) && isset($server->database->base_user)) {
                $connectionKey = $server->database->base_user . "_" . $serverId;
                $connections = Config::get('database.connections');
                if (array_key_exists($connectionKey, $connections)) {
                    $this->setConnection($connectionKey);
                    return $this->newQuery();
                }
                return $connectionKey;
            }
        }
    }

    public function scopegetInfo(Builder $query, int $serverId, string $username){
        return $this->getGameConnection($serverId)->select($this->search)->where('UserName', $username);
    }
}
