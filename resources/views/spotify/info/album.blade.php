<div class="album">
    @if ($song->album->images)
        <img src="{{$album->images[1]->url}}" height="256" width="256">
    @else {{-- We don't have a picture, so grab a placeholder.--}}
        <img src="https://via.placeholder.com/256"/>
    @endif
        <p>{{$album->name}}</p>
        <p>Spotify ID: {{$album->id}}</p>
        <p>Popularity: {{$album->poplarity}}</p>
        <p>Release Date: "{{$album->release_date}}</p>
        <p>Track Count: {{$album->total_tracks}}</p>
        <p>Tracks:</p>
        @foreach($album->tracks as $song)
            @include('spotify.search.song')
        @endforeach
</div>