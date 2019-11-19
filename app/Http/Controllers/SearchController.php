<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Monolog\TestCase;

class SearchController extends Controller
{
    protected $clientID;
    protected $clientSecret; // Make these variables so we don't have to keep reading the env file.
    protected $token;
    public function index()
    {
        return view('index');
    }


    public function search(Request $request)
    {
        $query = $request->get('query');



        if ($query == "") // If there's no search, just do a default one.
        {
            $query = "Carbon Based Lifeforms"; // In this case, it's a band I like.
            // This isn't a perfect solution, but with the timeframe I have, it'll have to do.
        }

        $artistResults = $api->searchArtists($query);
        $albumResults = $api->searchAlbums($query);
        $songResults = $api->searchTracks($query);

        return view('search', ['searchTerm' => $query, 'songs' => $songResults, 'albums' => $albumResults, 'artists' => $artistResults]);
    }
    public function __construct()
    {
        $this->clientID = env('SPOTIFY_KEY');
        $this->clientSecret = env('SPOTIFY_SECRET');
        if ($this->token)
        {

        }
    }
    protected function generateClientToken()
    {
        $client = new Client();
        try
        {
            $request = $client->request('POST', 'https://accounts.spotify.com/api/token',
            [
                'headers' => 
                [
                    // Craft the request
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accepts' => 'application/json',
                    'Authorization' => 'Basic '.base64_encode($this->clientID.':'.$this->clientSecret) //Encode our key

                ],
                'form_params' =>
                [
                    'grant_type' => 'client_credentials',
                ],
            ]);
        }
    }
}
