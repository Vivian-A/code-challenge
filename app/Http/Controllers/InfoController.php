<?php
/**
 * Created by PhpStorm.
 * User: NSCCStudent
 * Date: 11/18/19
 * Time: 11:56 PM
 */

namespace App\Http\Controllers;


use App\SpotifyAPI;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Monolog\TestCase;

class InfoController
{
    public function trackInfo(Request $request, $id)
    {
        $api = new SpotifyAPI();
        $trackInfo = $api->trackInfo($id);
        $extraTrackInfo = $api->extraTrackInfo($id);
        if ($extraTrackInfo == null)
        {
            return view('spotify/info/song', ['trackInfo' => $trackInfo]);
        }
        return view('spotify/info/song', ['trackInfo' => $trackInfo, 'extraTrackInfo' => $extraTrackInfo]);
    }
    public function albumInfo(Request $request, $id)
    {
        $api = new SpotifyAPI();
        $albumInfo = $api->albumInfo($id);
        return view('spotify/info/album', ['albumInfo' => $albumInfo]);
    }
}