<?php

namespace App;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
// TODO: Split this into multiple classes. It's getting a tad large.
class SpotifyAPI
{
    protected $clientID;
    protected $clientSecret; // Make these variables so we don't have to keep reading the env file.
    protected $token;

    public function __construct()
    {
        $this->clientID = env('SPOTIFY_KEY');
        $this->clientSecret = env('SPOTIFY_SECRET');
        $this->generateToken();
    }

    protected function generateToken()
    {
        $client = new Client();
        try {
            $request = $client->request('POST', 'https://accounts.spotify.com/api/token',
                [
                    'headers' =>
                        [
                            // Craft the request
                            'Content-Type' => 'application/x-www-form-urlencoded',
                            'Accepts' => 'application/json',
                            'Authorization' => 'Basic ' . base64_encode($this->clientID . ':' . $this->clientSecret) //Encode our key

                        ],
                    'form_params' =>
                        [
                            'grant_type' => 'client_credentials',
                        ],
                ]);
        } // TODO: do something about it instead of just throwing our hands up and going 'welp'
        catch (ClientException $e) {
        } catch (GuzzleException $e) {
        } // something went wrong on spotify's side (or ours, check if the key is correct)
        $response = json_decode($request->getBody());
        $this->token = $response->access_token; // grab our access token and store it
        return $this;
    }
    /// IMPROVEMENT: make this comment actually follow standards
    /// endpoint is the search, basically
    /// data is the stuff we want to actually send
    public function sendRequest(string $endpoint, array $data = [])
    {
        $client = new Client();
        // IMPROVEMENT: make method a variable thats changeable, but for now we only need GET which is easier to deal with

        $request = $client->request('GET', 'https://api.spotify.com/v1' . $endpoint . '?' . http_build_query($data), [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accepts' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        // TODO: same thing as above, actually give this catch a body
        return json_decode($request->getBody());
    }

    public function sendIdRequest(string $endpoint, string $data)
    {
        $client = new Client();

        $request = $client->request('GET', 'https://api.spotify.com/v1' . $endpoint. $data, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accepts' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token,
            ],
        ]);

        // TODO: same thing as above, actually give this catch a body
        return json_decode($request->getBody());
    }
    public function searchArtists(string $query)
    {
        $json = $this->sendRequest('/search',
            [
                'q' => $query,
                'type' => 'artist', // this is all we need thankfully, every other thing is optional
                /// POSSIBLE IMPROVEMENT: change it to one function, you can change type to be 'artist,album,track'
                ///  and it'll return all 3. The code i've written doesn't support that and
                ///  I dont have time to do that right now. Still though, food for thought.
            ]);
        return $json->artists;
    }
    public function searchAlbums(string $query)
    {
        $json = $this->sendRequest('/search',
            [
               'q' => $query,
               'type' => 'album',
            ]);
        return $json->albums;
    }
    public function searchTracks(string $query)
    {
        $json = $this->sendRequest('/search',
            [
                'q' => $query,
                'type' => 'track',
            ]);
        return $json->tracks;
    }
    ///
    ///  EXTRA INFO
    ///
    public function trackInfo(string $id)
    {
        $json = $this->sendIdRequest('/tracks/', $id);
        return $json;
    }
    public function extraTrackInfo(string $id)
    {
        $json = $this->sendIdRequest('/audio-features/', $id);
        if (!$json) // not all songs have been analysed
        {
            return null;
        }
        return $json;

    }
    public function albumInfo(string $id)
    {
        $json = $this->sendIdRequest('/albums/', $id);
        return $json;
    }
    public function artistInfo(string $id)
    {
        $json = $this->sendIdRequest('/artists/', $id);
        return $json;
    }
}