<div class="album">
    @if ($albumInfo->images)
        <img src="{{$albumInfo->images[1]->url}}" height="256" width="256">
    @else {{-- We don't have a picture, so grab a placeholder.--}}
        <img src="https://via.placeholder.com/256"/>
    @endif
        <p>{{$albumInfo->name}}</p>
        {{--TODO: Allow for multiple artists--}}
        <a href="{{route('artistInfo',['id' => $albumInfo->artists[0]->id])}}">{{$albumInfo->artists[0]->name}}</a>
        <p>Spotify ID: {{$albumInfo->id}}</p>
        <p>Popularity: {{$albumInfo->popularity}}</p>
        <p>Release Date: {{$albumInfo->release_date}}</p>
        <p>Track Count: {{$albumInfo->total_tracks}}</p>
        <h2>Tracks:</h2>
        @foreach($albumInfo->tracks->items as $trackInfo)
            @include('spotify.info.albumTrack')
        @endforeach
</div>