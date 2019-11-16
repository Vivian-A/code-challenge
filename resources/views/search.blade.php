<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Code Challenge</title>
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: sans-serif;
            height: 100vh;
            margin: 50px;
        }

        .full-height {
            height: 100vh;
        }

        .result {
        }
    </style>
</head>
<body>
<div class="full-height">
    <div class="result">
        Your Search Term Was: <b>{{$searchTerm}}</b>
        <div class="songList">
            Songs:
            @foreach($songs->items as $song)
                @include('spotify.song')
            @endforeach
        </div>
        <div class="ArtistList">
            Artists:
            @foreach($artists->items as $artist)
                @include('spotify.song')
            @endforeach
        </div>
        <div class="songList">
            Albums
            @foreach($albums->items as $album)
                @include('spotify.song')
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
