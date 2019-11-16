<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rennokki\Larafy\Exceptions\SpotifyAuthorizationException;
use Rennokki\Larafy\Larafy;

class SearchController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function search(Request $request)
    {
        $query = $request->get('query');
        $api = new Larafy();
        try
        {
        $songResults = $api->searchArtists($query);
        $albumResults = $api->searchAlbums($query);
        $trackResults = $api->searchTracks($query);
        } catch(SpotifyAuthorizationException $e) {
            // invalid ID & Secret provided
            $e->getAPIResponse(); // Get the JSON API response.
        }
        return view('search', ['searchTerm' => $query, 'songs' => $songResults, 'albums' => $albumResults, 'tracks' => $trackResults]);
    }
}
