<?php namespace Cysha\Modules\News\Controllers\Admin;

use Cysha\Modules\News as News;
use Auth;
use URL;
use Config;

class NewsController extends BaseAdminController
{
    use \Cysha\Modules\Admin\Traits\DataTableTrait;

    public function __construct()
    {
        parent::__construct();

        $this->objTheme->setTitle('<i class="fa fa-file"></i> News Manager');
        $this->objTheme->breadcrumb()->add('News Manager', URL::route('admin.news.index'));
        $this->assets();

        $this->setActions([
            'header' => [
                [
                    'btn-text'  => 'Add News',
                    'btn-link'  => URL::Route('admin.news.add'),
                    'btn-class' => 'btn btn-info btn-labeled',
                    'btn-icon'  => 'fa fa-plus'
                ],
            ],
        ]);

        $this->setTableOptions([
            'filtering'     => true,
            'pagination'    => true,
            'sorting'       => true,
            'sort_column'   => 'id',
            'source'        => URL::route('admin.news.ajax'),
            'collection'    => function () {
                return News\Models\News::with('author')->get();
            },
        ]);

        $this->setTableColumns([
            'id' => [
                'th'        => '&nbsp;',
                'tr'        => function ($model) {
                    return $model->id;
                },
                'sorting'   => true,
                'width'     => '5%',
            ],
            'author' => [
                'th'        => 'Author',
                'tr'        => function ($model) {
                    return $model->author->name;
                },
                'sorting'   => true,
                'filtering' => true,
                'width'     => '10%',
            ],
            'title' => [
                'th'        => 'Title',
                'tr'        => function ($model) {
                    return $model->title;
                },
                'sorting'   => true,
                'filtering' => true,
                'width'     => '10%',
            ],
            'slug' => [
                'th'        => 'slug',
                'tr'        => function ($model) {
                    $model = $model->transform();
                    return sprintf('<a href="%s" target="pages.preview">%s</a>', $model['href'], $model['slug']);
                },
                'sorting'   => true,
                'filtering' => true,
                'width'     => '25%',
            ],

            'published' => [
                'th'        => 'Published',
                'tr'        => function ($model) {
                    return ($model->pubilsh_at < time() ? '<div class="label label-success">Published</div>' : '<div class="label label-danger">Not Published</div>');
                },
                'tr-class'  => 'text-center',
                'sorting'   => true,
                'filtering' => true,
                'width'     => '5%',
            ],
            'publish_at' => [
                'th'        => 'Date Published',
                'tr'        => function ($model) {
                    return date_carbon($model->publish_at, 'd/m/Y H:i:s');
                },
                'th-class'  => 'hidden-xs hidden-sm',
                'tr-class'  => 'hidden-xs hidden-sm',
                'width'     => '15%',
            ],
            'created_at' => [
                'th'        => 'Date Created',
                'tr'        => function ($model) {
                    return date_carbon($model->created_at, 'd/m/Y H:i:s');
                },
                'th-class'  => 'hidden-xs hidden-sm',
                'tr-class'  => 'hidden-xs hidden-sm',
                'width'     => '15%',
            ],
            'actions' => [
                'th' => 'Actions',
                'tr' => function ($model) {
                    return [[
                        'btn-text'  => 'View User',
                        'btn-link'  => ( Auth::user()->can('admin.user.view') ? sprintf('/admin/users/%d/view', $model->id) : '#' ),
                        'btn-class' => ( Auth::user()->can('admin.user.view') ? 'btn btn-default btn-sm btn-labeled' : 'btn btn-warning btn-sm btn-labeled disabled' ),
                        'btn-icon'  => 'fa fa-file-text-o'
                    ],
                    [
                        'btn-text'  => 'Edit',
                        'btn-link'  => ( Auth::user()->can('admin.user.edit') ? sprintf('/admin/users/%d/edit', $model->id) : '#' ),
                        'btn-class' => ( Auth::user()->can('admin.user.edit') ? 'btn btn-warning btn-sm btn-labeled' : 'btn btn-warning btn-sm btn-labeled disabled' ),
                        'btn-icon'  => 'fa fa-pencil'
                    ]];
                },
            ]
        ]);

    }


}
