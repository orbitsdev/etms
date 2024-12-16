<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class RouteManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'routemanager'; // This must match the name bound in the service container
    }
}
