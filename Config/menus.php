<?php

return [
    'backend_sidebar' => [
        'News' => [
            [
                'route'         => 'admin.news.manager',
                'text'          => 'Manage Posts',
                'icon'          => 'fa-files-o',
                'order'         => 1,
                'permission'    => 'manage@news_post',
                'activePattern' => '\/{backend}\/news\/(.*)'
            ],
            [
                'route'         => 'admin.news.create',
                'text'          => 'Add News',
                'icon'          => 'fa-file-text',
                'order'         => 2,
                'permission'    => 'manage.create@news_post',
            ],
        ],
    ],
];
