<div class="album">
        @if ($song->album->images)
    <img src="{{$album->images[0]->url}}" height="64" width="64">
        @else {{-- We don't have a picture, so grab a placeholder.--}}
    <img src="https://via.placeholder.com/64">
        @endif
    <a href="{{route('albumInfo',['id' => $album->id])}}">{{$album->name}}</a>
</div>