<?php

namespace App\Providers;

use App\Models\Role;
use App\Repositories\V1\Admin\AdminRepositoryInterface;
use View;
use Illuminate\Support\ServiceProvider;
use App\Repositories\V1\Admin\AdminRepository;
use App\Repositories\V1\User\UserRepository;
use App\Repositories\V1\User\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $permission = Role::where('id', '!=', '1')->get();

        return View::share('permission', $permission);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
