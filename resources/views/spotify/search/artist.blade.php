<div class="artist">
    @if ($artist->images)
        <img src="{{$artist->images[0]->url}}" height="64" width="64">
    @else {{-- We don't have a picture, so grab a placeholder.--}}
        <img src="https://via.placeholder.com/64">
    @endif
        <a href="{{route('artistInfo',['id' => $artist->id])}}">{{$artist->name}}</a>


</div>