<?php

return [
    'userBlock' => [
        [
            'title' => 'Монитор',
            'route' => 'dashboard',
            'boxIconClass' => 'bxs-dashboard',
        ],
        [
            'title' => 'Заявки',
            'route' => 'requests.index',
            'boxIconClass' => 'bx-file',
        ],
        [
            'title' => 'Заказчики',
            'route' => 'customers.index',
            'boxIconClass' => 'bxs-business',
        ],
    ],
    'adminBlock' => [
        [
            'title' => 'Пользователи',
            'route' => 'users.index',
            'boxIconClass' => 'bx-user',
        ],
    ],
];
