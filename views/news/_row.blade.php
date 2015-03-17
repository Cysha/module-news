<div class="panel panel-default">
    <div class="panel-heading">
        {{ array_get($post, 'link') }} <small>by {{ array_get($post, 'author.screenname') }} <br />Published {{ array_get($post, 'publish_at.fuzzy') }}</small>
    </div>
    <div class="panel-body">
        {{ array_get($post, 'content') }}
    </div>
</div>
