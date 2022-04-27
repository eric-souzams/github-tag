<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GithubService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.github.com/'
        ]);
    }

    public function requestUserData(string $username)
    {
        $uri = '/users/' . $username;
        try {
            $response = $this->client->request('GET', $uri);
            return json_decode($response->getBody());
        } catch (GuzzleException $exception) {
            return [
                'message' => 'User not found'
            ];
        }
    }

    public function requestUserRepositories(string $username)
    {
        $uri = '/users/' . $username . '/repos';
        try {
            $response = $this->client->request('GET', $uri);
            return json_decode($response->getBody());
        } catch (GuzzleException $exception) {
            return [
                'message' => 'User not found'
            ];
        }
    }
}