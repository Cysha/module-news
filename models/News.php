<?php namespace Cysha\Modules\News\Models;

use Cache;
use Config;

class News extends BaseModel
{

    public $fillable = [
        'author_id', 'title', 'slug', 'content', 'view_count', 'publish_at', 'hide'
    ];
    protected $identifiableName = 'title';
    protected $link = [
        'route'      => 'pxcms.news.view',
        'attributes' => ['name' => 'slug'],
    ];

    public function author()
    {
        $model = Config::get('auth.model');
        return $this->belongsTo($model, 'author_id', 'id');
    }

    public function scopeGetCurrent($query)
    {
        return $query->where('publish_at', '<=', date('Y-m-d h:i:s', time()))->whereHide(0)->orderBy('publish_at', 'desc')->get();
    }

    public function getContentAttribute($value)
    {
        return \Markdown::parse($value);
    }



    public function getDates()
    {
        return ['created_at', 'updated_at', 'publish_at'];
    }

    public function transform()
    {
        $data = [
            'id'           => (int) $this->id,
            'title'        => (string) $this->title,
            'content'      => (string) $this->content,
            'slug'        => (string) $this->slug,
            'link'        => (string) $this->makeLink(false),
            'href'        => (string) $this->makeLink(true),

            'publish_at'   => date_array($this->publish_at),
            'created_at'   => date_array($this->created_at),
            'updated_at'   => date_array($this->updated_at),
            'author'       => $this->author->transform(),
        ];

        return $data;
    }
}
