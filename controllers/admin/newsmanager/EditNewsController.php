<?php namespace Cysha\Modules\News\Controllers\Admin\NewsManager;

use Cysha\Modules\News as News;
use Former;
use Input;
use Redirect;

class EditNewsController extends BaseNewsManagerController
{

    public function getEdit(News\Models\News $objNews)
    {

        Former::populateField('content', $objNews->getOriginal('content'));
        Former::populateField('title', $objNews->getOriginal('title'));
        Former::populateField('slug', $objNews->getOriginal('slug'));
        Former::populateField('hide', $objNews->getOriginal('hide'));
        Former::populateField('publish_at', $objNews->getOriginal('publish_at'));

        return $this->setView('news.admin.form');
    }

    public function postEdit(News\Models\News $objNews)
    {
        $slugCheck = News\Models\News::whereSlug(Input::get('slug'))->where('id', '<>', $objNews->id)->get()->first();
        if ($slugCheck !== null) {
            return Redirect::route('admin.news.edit', $objNews->id)->withInput()->withError('Error, slug already exists, pick another.');
        }

        $objNews->fill(Input::except('_token'));
        if (!$objNews->save()) {
            return Redirect::route('admin.news.edit', $objNews->id)->withErrors($objNews->errors());
        }

        return Redirect::route('admin.news.edit', $objNews->id)->withInfo('News Article Updated');
    }
}
