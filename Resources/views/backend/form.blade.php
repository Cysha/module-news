<div class="col-md-10">
{!! Former::horizontal_open() !!}
    <div class="panel panel-default">
        <div class="panel-heading">Post Details</div>
        <div class="panel-body">
            {!! Former::text('title')->required()->tabindex('1') !!}

            {!! Former::text('slug')->prepend('news/')->required()->tabindex('2') !!}

            {!! Former::text('publish_at')->inlineHelp('<small>Published will be set to submitted date if not present. if you want to specify, YYYY-mm-dd h:i:s</small>')->tabindex('3') !!}

            {!! Former::radios('hide')->radios([
                'Yes' => ['value' => '1'],
                'No' => ['value' => '0'],
            ])->inline()->required()->tabindex('4') !!}

            <button class="btn-labeled btn btn-success pull-right" type="submit" tabindex="6">
                <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span> Save
            </button>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Post Content</div>
        <div class="panel-body">
            @include(config('cms.core.app.default-editor'), ['id' => 'content', 'content' => $content, 'tabindex' => 5])
        </div>
    </div>

{!! Former::close() !!}
</div>
