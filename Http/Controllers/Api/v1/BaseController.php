<?php namespace Cms\Modules\News\Http\Controllers\Api\V1;

use Cms\Modules\Core\Http\Controllers\BaseApiController as BAC;

class BaseController extends BAC
{

    public function getIndex()
    {
        return $this->sendOK('ok');
    }
}
