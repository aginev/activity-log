<?php

namespace Aginev\ActivityLog;

use Illuminate\Support\Facades\Facade;

class ActivityLogFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Aginev\ActivityLog';
    }
}