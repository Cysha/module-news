<?php namespace Cms\Modules\News\Http\Controllers\Backend;

use Cms\Modules\Admin\Traits\DataTableTrait;
use Cms\Modules\News\Datatables\PostManager;

class ManagerController extends BaseAdminController
{
    use DataTableTrait;

    public function newsManager()
    {
        return $this->renderDataTable(with(new PostManager)->boot());
    }

}
