<?php

namespace Cms\Modules\News\Models;

use Cms\Modules\Core\Models\BaseModel as CoreBaseModel;

class BaseModel extends CoreBaseModel
{
    public function __construct()
    {
        parent::__construct();

        $prefix = config('cms.news.config.table-prefix', 'news_');
        $this->table = $prefix.$this->table;
    }
}
