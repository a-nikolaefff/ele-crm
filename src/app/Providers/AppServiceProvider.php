<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.bootstrap-5');

        DB::listen(function ($query) {
            File::append(
                storage_path('/logs/query.log'),
                '[' . date('Y-m-d H:i:s') . ']' . PHP_EOL . $query->sql . ' ['
                . implode(', ', $query->bindings) . ']' . PHP_EOL . PHP_EOL
            );
        });
    }
}
