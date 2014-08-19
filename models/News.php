<?php namespace Cysha\Modules\Pages\Models;

use Cache;

class News extends BaseModel
{

    public $fillable = [
        'author_id', 'title', 'slug', 'content', 'view_count', 'publish_at', 'hide'
    ];

    /**
     * Transformer method
     *
     * @param  Pages\Models\Content $model
     * @return array
     */
    public function transform()
    {
        $data = [
            'id'      => (int) $this->id,


            'content' => (string) $this->content,
        ];

        return $data;
    }
}
