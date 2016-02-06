<?php

return [
    'backend_sidebar' => [
        'News' => [
            'order' => 101,
            'children' => [
                [
                    'route'         => 'admin.news.manager',
                    'text'          => 'Manage Posts',
                    'icon'          => 'fa-files-o',
                    'order'         => 1,
                    'permission'    => 'manage@news_post',
                    'activePattern' => '\/{backend}\/news\/(\d)\/(.*)'
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
    ],
];
