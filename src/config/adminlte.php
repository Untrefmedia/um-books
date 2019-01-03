<?php

return [
    'menu' => [
        [
            'text'        => 'Venues',
            'url'         => 'admin/venues',
            'icon'        => 'file',
            'label'       => null,
            'label_color' => 'success',
            'submenu'     => [
                [
                    'text' => 'List',
                    'url'  => 'admin/venues'
                ],
                [
                    'text' => 'Create',
                    'url'  => 'admin/venues/create'
                ]
            ]
        ],
        [
            'text'        => 'Books',
            'url'         => 'admin/books',
            'icon'        => 'file',
            'label'       => null,
            'label_color' => 'success',
            'submenu'     => [
                [
                    'text' => 'List',
                    'url'  => 'admin/books'
                ],
                [
                    'text' => 'Create',
                    'url'  => 'admin/books/create'
                ]
            ]
        ],
        [
            'text'        => 'Events',
            'url'         => 'admin/events',
            'icon'        => 'file',
            'label'       => null,
            'label_color' => 'success',
            'submenu'     => [
                [
                    'text' => 'List',
                    'url'  => 'admin/events'
                ],
                [
                    'text' => 'Create',
                    'url'  => 'admin/events/create'
                ]
            ]
        ]
    ]
];
