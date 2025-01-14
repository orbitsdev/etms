<?php

namespace App\Providers;

use App\Models\Request;
use App\Models\JobOrder;
use App\Models\Equipment;
use App\Models\MaintenanceLog;
use App\Observers\RequestObserver;
use App\Observers\JobOrderObserver;
use App\Observers\EquipmentObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Observers\MaintenanceLogObserver;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {

        Equipment::observe(EquipmentObserver::class);
        Request::observe(RequestObserver::class);
        JobOrder::observe(JobOrderObserver::class);
        // Equipment::observe(EquipmentObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
