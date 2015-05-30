@if (count($posts))
    @foreach($posts as $post)

        @include(partial('news::frontend._row'), ['post' => $post->transform()])

    @endforeach
@endif
