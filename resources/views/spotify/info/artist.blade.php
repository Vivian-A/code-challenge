<div class="artist">
    @if ($artistInfo->images)
        <img src="{{$artistInfo->images[1]->url}}" height="256" width="256">
    @else {{-- We don't have a picture, so grab a placeholder.--}}
    <img src="https://via.placeholder.com/256">
    @endif
        <p>Name: {{$artistInfo->name}}</p>
        <p>Popularity: {{$artistInfo->popularity}}</p>
        <p>Total Followers: {{$artistInfo->followers->total}}</p>
        @if ($artistInfo->genres)
            <p>Genre: {{$artistInfo->genres[0]}}</p>
        @endif
</div>