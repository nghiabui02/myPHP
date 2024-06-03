<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class MyController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('index'); // Hoặc bất kỳ logic nào khác mà bạn muốn
    }

    private mixed $client_id;
    private mixed $client_secret;
    private mixed $client;

    public function __construct()
    {
        $this->client_id = env('SPOTIFY_CLIENT_ID');
        $this->client_secret = env('SPOTIFY_CLIENT_SECRET');
        $this->client = new Client(['base_uri' => 'https://api.spotify.com/v1/']);
    }

    /**
     * @throws GuzzleException
     */
    private function getAccessToken()
    {
        $client = new Client();

        $response = $client->request('POST', 'https://api.spotify.com/v1/', [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->client_id . ':' . $this->client_secret),
            ],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        $body = json_decode((string) $response->getBody(), true);
        return $body['access_token'];
    }

    /**
     * @throws GuzzleException
     */
    public function getTrack($id): \Illuminate\Http\JsonResponse
    {
        $access_token = $this->getAccessToken();

        $response = $this->client->request('GET', "tracks/{$id}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $access_token,
            ],
        ]);

        $track = json_decode((string) $response->getBody(), true);

        return response()->json($track);
    }
}
