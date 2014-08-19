<div class="page-header">
    <h1>{{ Config::get('core::app.site-name') }} News</h1>
</div>

@if (count($posts))
    @foreach($posts as $post)
        @include('news::news._row', ['post' => $post->transform()])
    @endforeach
@endif
