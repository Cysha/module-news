<?php

namespace Cms\Modules\News\Models;

use League\CommonMark\CommonMarkConverter;

class Post extends BaseModel
{
    public $table = 'posts';
    public $fillable = [
        'author_id', 'title', 'slug', 'content', 'view_count', 'publish_at', 'hide',
    ];
    protected $identifiableName = 'title';
    protected $link = [
        'route' => 'pxcms.news.read',
        'attributes' => ['news_post_id' => 'id', 'slug'],
    ];

    public function author()
    {
        $model = config('auth.model');

        return $this->belongsTo($model, 'author_id', 'id');
    }

    public function getContentAttribute($value)
    {
        $value = replaceMentions($value);

        return escape(with(new CommonMarkConverter())->convertToHtml($value));
    }

    public function getDates()
    {
        return ['created_at', 'updated_at', 'publish_at'];
    }

    public function transform()
    {
        $data = [
            'id' => (int) $this->id,
            'title' => (string) $this->title,
            'content' => (string) $this->content,
            'slug' => (string) $this->slug,
            'link' => (string) $this->makeLink(false),
            'href' => (string) $this->makeLink(true),

            'publish_at' => date_array($this->publish_at),
            'created_at' => date_array($this->created_at),
            'updated_at' => date_array($this->updated_at),
            'author' => $this->author->transform(),
        ];

        return $data;
    }
}
