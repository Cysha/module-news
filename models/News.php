<?php namespace Cysha\Modules\News\Models;

use Cache;
use Config;

class News extends BaseModel
{

    public $rules = [
        'creating' => [
            'title'   => 'required|unique:news,title',
            'slug'    => 'required|unique:news,slug',
            'hide'    => 'required|in:0,1',
            'content' => 'required',
        ],
        'updating' => [
            'title'   => 'unique:news,title,:id:',
            'slug'    => 'unique:news,slug,:id:',
            'hide'    => 'in:0,1',
        ],
    ];

    public $fillable = [
        'author_id', 'title', 'slug', 'content', 'view_count', 'publish_at', 'hide'
    ];
    protected $identifiableName = 'title';
    protected $link = [
        'route'      => 'pxcms.news.view',
        'attributes' => ['id', 'slug'],
    ];

    public function author()
    {
        $model = Config::get('auth.model');
        return $this->belongsTo($model, 'author_id', 'id');
    }

    public function scopeGetCurrent($query, $limit = 5)
    {
        return $query->where('publish_at', '<=', date('Y-m-d H:i:s', time()))->whereHide(0)->take($limit)->orderBy('publish_at', 'desc')->get();
    }

    public function getContentAttribute($value)
    {
        return parseMarkdown($value);
    }


    public function getDates()
    {
        return ['created_at', 'updated_at', 'publish_at'];
    }

    public function transform()
    {
        $data = [
            'id'         => (int) $this->id,
            'title'      => (string) $this->title,
            'content'    => (string) $this->content,
            'slug'       => (string) $this->slug,
            'link'       => (string) $this->makeLink(false),
            'href'       => (string) $this->makeLink(true),

            'publish_at' => date_array($this->publish_at),
            'created_at' => date_array($this->created_at),
            'updated_at' => date_array($this->updated_at),
            'author'     => $this->author->transform(),
        ];

        return $data;
    }
}
