<div class="well well-sm">
    <header class="row">
        <div class="col-md-12">
            <h4>{{ array_get($post, 'link') }} <small>by {{ array_get($post, 'author.name') }} <br />Published {{ array_get($post, 'publish_at.fuzzy') }}</small></h4>
        </div>
    </header>
    <section class="news-content">
        {{ array_get($post, 'content') }}
    </section>
</div>
