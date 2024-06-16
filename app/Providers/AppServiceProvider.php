<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard)
    {
        $permissions = ItemPermission::group('Modal ')
            ->addPermission('Access', 'Access')
            ->addPermission('Management', 'Management');

        $dashboard->registerPermissions($permissions);

        Dashboard::useModel(
            \Orchid\Platform\Models\User::class,
            \App\Models\User::class
        );
    }
}
