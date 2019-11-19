<?php

namespace App\Http\Controllers;

use App\SpotifyAPI;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Monolog\TestCase;

class SearchController extends Controller
{

    public function index()
    {
        return view('index');
    }


    public function search(Request $request)
    {
        $query = $request->get('query');


        $api = new SpotifyAPI();
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
    public function info(Request $request)
    {

    }

}
