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
            'url'  => 'admin/venue',
            'can'  => 'venue-list'
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
            'url'  => 'admin/book',
            'can'  => 'book-list'
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
            'url'  => 'admin/event',
            'can'  => 'event-list'
        ],
        [
            'text' => 'Create',
            'url'  => 'admin/event/create',
            'can'  => 'event-create'
        ],
        ['text'       => 'Blocked Turns',
            'url'         => 'admin/eventBlocked',
            'icon'        => 'file',
            'label'       => null,
            'label_color' => 'success',
            'submenu'     => [
                [
                    'text' => 'List',
                    'url'  => 'admin/eventBlocked',
                    'can'  => 'eventBlocked-list'
                ],
                [
                    'text' => 'Create',
                    'url'  => 'admin/eventBlocked/create',
                    'can'  => 'eventBlocked-create'
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
