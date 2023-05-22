<?php

namespace App\Helpers;

use App\Models\Server;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CenterServiceHelper
{
    private function getAuthKey(int $version, string $user)
    {
        $currentTime = time();
        $randomKey = rand(111111, 999999);

        switch ($version) {
            case 4100: {
                    $questKey = env('GAME_4100_KEY', "QY-16-WAN-0668-2555555-7ROAD-dandantang-love777nguyenluu");
                    $key = (strtolower($user) . "|" . $randomKey . "|" . $currentTime . "|" . md5($user . strtoupper($randomKey) . $currentTime . $questKey));
                    break;
                }
            default:
                Log::error("Undefined version trying auth: {$version}!");
                break;
        }

        return [
            'content' => $key,
            'key' => $randomKey
        ];
    }

    public function authorizeUser(Server $server, User $user)
    {
        try {
            $authKeyData = $this->getAuthKey($server->version, $user->email);
            $content = $authKeyData['content'];

            $questApplication = $server->getApplicationByKey('quest_url');
            if ($questApplication) {
                $client = new Client([
                    'verify' => empty($questApplication->ssl_verify) ? false : $questApplication->ssl_verify
                ]);

                $httpQuest = $client->request('GET', $questApplication->url . "/CreateLogin.aspx", [
                    'query' => [
                        'content' => $content
                    ]
                ]);

                $response = ($httpQuest->getBody()->getContents());
                return [
                    'state' => $response,
                    'key' => $authKeyData['key']
                ];
            }
        } catch (Exception $ex) {
            Log::error("{$ex->getMessage()} on {$ex->getFile()}, line: {$ex->getLine()}!");
            return [
                'state' => -1
            ];
        }
    }
}
