<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // Use larafy to get the artists, songs, and albums for the query.
        $artistResults = $api->searchArtists($query);
        $albumResults = $api->searchAlbums($query);
        $songResults = $api->searchTracks($query);

        return view('search', ['searchTerm' => $query, 'songs' => $songResults, 'albums' => $albumResults, 'artists' => $artistResults]);
    }
}
