<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\FighterDeletedEvent;
use App\Events\MasterDeletedEvent;
use App\Listeners\FighterDeletedEventListener;
use App\Listeners\MasterDeletedEventListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        FighterDeletedEvent::class => [
            FighterDeletedEventListener::class,
        ],
        MasterDeletedEvent::class => [
            MasterDeletedEventListener::class,
        ],
        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\LogExpiredSession',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
