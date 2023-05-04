<?php

return [
    'userBlock' => [
        [
            'title' => 'Главная',
            'route' => 'home',
            'boxIconClass' => 'bx-home-alt',
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
