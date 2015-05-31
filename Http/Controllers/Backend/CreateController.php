<?php namespace Cms\Modules\News\Http\Controllers\Backend;

use Cms\Modules\News\Repositories\Post\RepositoryInterface as PostRepository;
use Cms\Modules\News as News;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CreateController extends BaseAdminController
{

    public function boot()
    {
        parent::boot();

        $this->theme->setTitle('Create News Post');
    }

    public function getCreate()
    {
        $this->formAssets();

        return $this->setView('backend.form', [
            'content' => '',
        ]);
    }

    public function postCreate(Request $input, PostRepository $post)
    {
        $input = $input->except('_token');

        if (($publish = array_get($input, 'publish_at')) === null || empty($publish)) {
            $input['publish_at'] = Carbon::now();
        }
        $input['author_id'] = \Auth::user()->id;

        if ($post->slugExists($input->get('slug'))) {
            return redirect(redirect('admin.news.create'))
                ->withInput()
                ->withError('Error, slug already exists, pick another.');
        }

        $createdPost = $post->create($input);
        if ($createdPost === null) {
            return redirect(redirect('admin.news.create'))
                ->withErrors($createdPost->errors());
        }

        return redirect(route('admin.news.update', $createdPost->id))
            ->withInfo('News Article Added');
    }
}
