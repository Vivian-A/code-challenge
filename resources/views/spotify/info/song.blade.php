<div class="song">
    @if ($trackInfo->album->images)
        <img src="{{$trackInfo->album->images[1]->url}}" height="256" width="256">
    @else {{-- We don't have a picture, so grab a placeholder.--}}
        <img src="https://via.placeholder.com/256"/>
    @endif
        <p>Name: {{$trackInfo->name}}</p>
        <p>Popularity: {{$trackInfo->popularity}}</p>
        <p>Disc Number: {{$trackInfo->disc_number}}</p>
        <p>Song Length: {{$trackInfo->duration_ms}} ms</p>
        <h2>Bonus track info</h2>
        <p>Danceability: {{$extraTrackInfo->danceability}}</p>
        <p>Energy: {{$extraTrackInfo->energy}}</p>
        <p>Speechiness: {{$extraTrackInfo->speechiness}}</p>
        <p>Liveness: {{$extraTrackInfo->liveness}}</p>
        <p>Tempo: {{$extraTrackInfo->tempo}}</p>
</div>