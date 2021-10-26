<?php


namespace App\Services;


use GuzzleHttp\Client;

class SteamApiService
{
    //private $apiKey;
    private $apiClient;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->apiClient = new Client([
            'base_uri' => 'https://api.steampowered.com'
        ]);
    }

    private function getPlayerSummariesRequest(string $steamIds): object
    {
        return json_decode($this->apiClient->request(
            'GET',
            '/ISteamUser/GetPlayerSummaries/v2',
            ['query' => ['key' => $this->apiKey, 'steamids' => $steamIds]]
        )
            ->getBody()
            ->getContents());

    }

    public function getUserInfo(string $steamId): ?object
    {
        $userInfo = $this->getPlayerSummariesRequest($steamId);
        if (isset($userInfo->response->players) && count($userInfo->response->players) > 0)
            return $userInfo->response->players[0];
        return null;

    }

    public function getUsersInfo(array $steamIds): array
    {
        $steamIdsString = implode(',', $steamIds);
        $userInfo = $this->getPlayerSummariesRequest($steamIdsString);
        if (isset($userInfo->response->players))
            return $userInfo->response->players;
        return [];
    }

    public function getUserName(string $steamId): ?string
    {
        $userInfo = $this->getUserInfo($steamId);
        if ($userInfo)
            return $userInfo->personaname;
        return null;
    }

    public function getUserAvatar(string $steamId): ?string
    {
        $userInfo = $this->getUserInfo($steamId);
        if ($userInfo) {
            return $userInfo->avatarfull;
        }
        return null;
    }
}
