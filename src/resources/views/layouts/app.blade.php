<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title') | EleCRM
    </title>

    @vite(['resources/js/app.js', 'resources/css/app.scss'])
</head>

<body class="bg-light">
<div class="page" id="page">
    <x-header
        :is-page-with-admin-sidebar="false"
    ></x-header>
    <x-sidebar
        :is-admin-sidebar="false"
        :menu="[
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
            ]"
    ></x-sidebar>
    <main class="page__content content py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
