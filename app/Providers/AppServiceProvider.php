<?php
namespace App\Providers;

use App\Models\Client;
use App\Models\Deal;
use App\Models\User;
use App\Policies\AccessesPolicy;
use App\Policies\ClientPolicy;
use App\Policies\DealPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        Paginator::useBootstrapFive();

        Gate::policy(User::class, AccessesPolicy::class);
        Gate::policy(Client::class, ClientPolicy::class);
        Gate::policy(Deal::class, DealPolicy::class);

    }
}
