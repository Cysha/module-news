<?php

namespace Cms\Modules\News\Http\Controllers\Backend;

use Cms\Modules\Core\Http\Controllers\BaseBackendController;

class BaseAdminController extends BaseBackendController
{
    public function boot()
    {
        parent::boot();

        $this->theme->setTitle('News');
    }

    public function formAssets()
    {
        $this->theme->asset()->add('slugify', 'modules/news/admin/js/editor.js', ['app.js']);
    }
}
