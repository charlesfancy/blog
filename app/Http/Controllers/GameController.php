<?php

namespace App\Http\Controllers;

use App\Game;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GameController extends Controller
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client;
        $this->baseUrl = 'http://api.steampowered.com/';
        $this->apiKey = config('services.steam.api_key');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $games = $this->callApi();
            $this->saveGames($games);
        } catch (\Exception $e) {
            throw $e;
//            throw new \Exception('Error');
        }
    }

    protected function callApi()
    {
        $url = $this->baseUrl . 'IPlayerService/GetOwnedGames/v0001/';
        $params = [
            'key' => $this->apiKey,
            'steamid' => '76561197960434622',
            'format' => 'json',
        ];

        $body = $this->apiRequest($url, $params)->getContents();

        return $body['response']['games'];
    }

    protected function saveGames($games)
    {
        foreach ($games as $game) {
            if (!Game::where('app_id', $game['appid'])->exists()) {
                $gameName = $this->getGameName($game['appid']);

                $model = new Game;
                $model->app_id = $game['appid'];
                $model->name = $gameName;
                $model->playtime = $game['playtime_forever'];
                $model->save();
            }
        }
    }

    protected function getGameName($appid)
    {
        $url = $this->baseUrl . 'ISteamUserStats/GetSchemaForGame/v2/';

        $params = [
            'key' => $this->apiKey,
            'appid' => $appid,
            'format' => 'json',
        ];

        $body = $this->apiRequest($url, $params);

        $game = $body['game'];
        return isset($game['gameName']) ? $game['gameName'] : null;
    }

    protected function apiRequest($url, $query)
    {
        $res = $this->client->request('GET', $url . '?' . http_build_query($query));
        $body = json_decode($res->getBody(), true);

        return $body;
    }
}
