<div class="song">
    <a href="{{route('trackInfo',['id' => $trackInfo->id])}}">Name: {{$trackInfo->name}}</a>
    <p>Disc Number: {{$trackInfo->disc_number}}</p>
    <p>Song Length: {{$trackInfo->duration_ms}} ms</p>
</div>