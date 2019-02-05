<?php

return [
    'menu' => [
        [
            'text'        => 'Venues',
            'url'         => 'admin/venue',
            'icon'        => 'file',
            'label'       => null,
            'label_color' => 'success',
            'submenu'     => [
                [
                    'text' => 'List',
                    'url'  => 'admin/venue'
                ],
                [
                    'text' => 'Create',
                    'url'  => 'admin/venue/create'
                ]
            ]
        ],
        [
            'text'        => 'Books',
            'url'         => 'admin/book',
            'icon'        => 'file',
            'label'       => null,
            'label_color' => 'success',
            'submenu'     => [
                [
                    'text' => 'List',
                    'url'  => 'admin/book'
                ],
                [
                    'text' => 'Create',
                    'url'  => 'admin/book/create'
                ]
            ]
        ],
        [
            'text'        => 'Events',
            'url'         => 'admin/event',
            'icon'        => 'file',
            'label'       => null,
            'label_color' => 'success',
            'submenu'     => [
                [
                    'text' => 'List',
                    'url'  => 'admin/event'
                ],
                [
                    'text' => 'Create',
                    'url'  => 'admin/event/create'
                ],
                [
                    'text' => 'Date blocked',
                    'url'  => 'admin/eventDateBlocked'
                ]
            ]
        ]
    ]
];
