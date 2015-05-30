<?php namespace Cms\Modules\News\Models;

use Cms\Modules\Core\Models\BaseModel as CoreBaseModel;

class BaseModel extends CoreBaseModel
{

    public function __construct()
    {
        parent::__construct();

        $this->table = 'news_'.$this->table;
    }

}
