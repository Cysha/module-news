<?php namespace Cysha\Modules\News\Controllers\Admin\NewsManager;

use Cysha\Modules\News as News;
use Former;
use Input;
use Redirect;

class AddNewsController extends BaseNewsManagerController
{

    public function getAdd()
    {
        $this->objTheme->asset()->add('slugify', 'packages/module/news/assets/admin/js/editor.js');
        return $this->setView('news.admin.form');
    }

    public function postAdd()
    {
        $input = Input::except('_token');

        if (($publish = array_get($input, 'publish_at')) === null || empty($publish)) {
            $input['publish_at'] = date('Y-m-d h:i:s', time());
        }
        $input['author_id'] = \Auth::user()->id;

        $slugCheck = News\Models\News::whereSlug($input['slug'])->get()->first();
        if ($slugCheck !== null) {
            return Redirect::route('admin.news.add')->withInput()->withError('Error, slug already exists, pick another.');
        }

        $objNews = new News\Models\News;
        $objNews->fill($input);
        if (!$objNews->save()) {
            return Redirect::route('admin.news.add')->withErrors($objNews->errors());
        }

        return Redirect::route('admin.news.edit', $objNews->id)->withInfo('News Article Added');
    }
}
