{{--<div class="blog-post">--}}
    {{--<h2 class="blog-post-title">--}}
        {{--<a href="/posts/{{$post->id}}">--}}
            {{--{{ $post->title }}--}}
        {{--</a>--}}
    {{--</h2>--}}
    {{--<h7 class="text-info">Post score: {{$post->aura}} <br></h7>--}}
    {{--<p class="blog-post-meta">--}}
        {{--By <b>{{$post->user->name}} the {{$post->user->title}}</b> on--}}
        {{--{{$post->created_at->toFormattedDateString()}}--}}
    {{--</p>--}}
    {{--{{$post->body}}--}}
    {{--<br>--}}
    {{--@if (Auth::check())--}}
        {{--<a class="btn btn-sm btn-outline-primary" href="/posts/{{$post->id}}/upvote/">Upvote this!</a>--}}
    {{--@endif--}}
{{--</div><!-- /.blog-post -->--}}
<div class="artist">
    <img src="{{$artist->images[2]->url}}">
    <a href="{{$artist->external_urls->spotify}}">{{$artist->name}}</a>


</div>