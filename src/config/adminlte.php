<?php

$venue = [
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
            'url'  => 'admin/venue/create',
            'can'  => 'venue-create'
        ]
    ]
];

$book = [
    'text'        => 'Books',
    'url'         => 'admin/book',
    'icon'        => 'file',
    'label'       => null,
    'label_color' => 'success',
    'submenu'     => [
        [
            'text' => 'List',
            'url'  => 'admin/book'
        ]
        // [
        //     'text' => 'Create',
        //     'url'  => 'admin/book/create',
        //     'can'  => 'book-create'
        // ]
    ]
];

$event = [
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
        ['text'       => 'Blocked Turns',
            'url'         => 'admin/eventBlocked',
            'icon'        => 'file',
            'label'       => null,
            'label_color' => 'success',
            'submenu'     => [
                [
                    'text' => 'List',
                    'url'  => 'admin/eventBlocked'
                ],
                [
                    'text' => 'Create',
                    'url'  => 'admin/eventBlocked/create'
                ]
            ]
        ]
    ]
];

return [
    'menu' => [
        0 => $venue,
        1 => $book,
        2 => $event
    ]
];
