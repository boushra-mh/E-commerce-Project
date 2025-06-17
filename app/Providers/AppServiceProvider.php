<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\Listeners\AssignDefualtPermission;
use App\Listeners\SendNotification;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Support\Facades\Event;
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
    {  Event::listen(UserRegistered::class ,
                AssignDefualtPermission::class);

        Event::listen(UserRegistered::class ,
            SendNotification::class);

        Event::listen(UserRegistered::class ,
            SendWelcomeEmail::class);
    }
}
