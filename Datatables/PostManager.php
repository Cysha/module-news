<?php namespace Cms\Modules\News\Datatables;

use Lock;

class PostManager
{
    public function boot()
    {
        return [
            /**
             * Page Decoration Values
             */
            'page' => [
                'title' => '<i class="fa fa-fw fa-files-o"></i> News Post Manager',
                'header' => [
                    [
                        'btn-text'  => 'Create News Post',
                        'btn-link'  => 'admin.news.create',
                        'btn-class' => 'btn btn-info btn-labeled',
                        'btn-icon'  => 'fa fa-plus'
                    ],
                ],
            ],

            /**
             * Set up some table options, these will be passed back to the view
             */
            'options' => [
                'filtering' => true,
                'pagination' => true,
                'sorting' => true,
                'sort_column' => 'id',
                'source' => 'admin.news.manager',
                'collection' => function () {
                    $model = 'Cms\Modules\News\Models\Post';
                    return $model::with('author')->get();
                },
            ],

            /**
             * Lists the tables columns
             */
            'columns' => [
                'id' => [
                    'th' => '&nbsp;',
                    'tr' => function ($model) {
                        return $model->id;
                    },
                    'sorting' => true,
                    'width' => '5%',
                ],

                'author' => [
                    'th' => 'Author',
                    'tr' => function ($model) {
                        return $model->author->screenname;
                    },
                    'sorting' => true,
                    'filtering' => true,
                    'width' => '10%',
                ],

                'slug' => [
                    'th' => 'Title',
                    'tr' => function ($model) {
                        $model = $model->transform();
                        return sprintf('<a href="%s" target="news.preview">%s <i class="fa fa-external-link"></i></a>', $model['href'], $model['title']);
                    },
                    'sorting' => true,
                    'filtering' => true,
                    'width' => '25%',
                ],

                'is_hidden' => [
                    'th' => 'Hidden',
                    'tr' => function ($model) {
                        return (
                            $model->hide === '1'
                            ? '<div class="label label-danger">Hidden</div>'
                            : '<div class="label label-success">Not Hidden</div>'
                        );
                    },
                    'tr-class' => 'text-center',
                    'sorting' => true,
                    'filtering' => true,
                    'width' => '5%',
                 ],

                'published' => [
                    'th' => 'Published',
                    'tr' => function ($model) {
                        return (
                            $model->publish_at->timezone(config('app.timezone'))->format('U') <= time()
                            ? '<div class="label label-success">Published</div>'
                            : '<div class="label label-danger">Not Published</div>'
                        );
                    },
                    'tr-class' => 'text-center',
                    'sorting' => true,
                    'filtering' => true,
                    'width' => '5%',
                ],

                'publish_at' => [
                    'th' => 'Date Published',
                    'tr' => function ($model) {
                        return date_carbon($model->publish_at, 'd/m/Y H:i:s');
                    },
                    'th-class' => 'hidden-xs hidden-sm',
                    'tr-class' => 'hidden-xs hidden-sm',
                    'width' => '15%',
                ],

                'created_at' => [
                    'th' => 'Date Created',
                    'tr' => function ($model) {
                        return date_carbon($model->created_at, 'd/m/Y H:i:s');
                    },
                    'th-class' => 'hidden-xs hidden-sm',
                    'tr-class' => 'hidden-xs hidden-sm',
                    'width' => '15%',
                ],

                'actions' => [
                    'th' => 'Actions',
                    'tr' => function ($model) {
                        $return = [];

                        if (Lock::can('manage.update', 'news_post')) {
                            $return[] = [
                                'btn-title' => 'Edit',
                                'btn-link'  => route('admin.news.update', [
                                    'news_post_id' => $model->id
                                ]),
                                'btn-class' => 'btn btn-warning btn-xs btn-labeled',
                                'btn-icon'  => 'fa fa-pencil'
                            ];
                        }

                        return $return;
                    },
                ],
            ],
        ];

    }
}
