<?php

namespace LaravelAutoUpdate;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LaravelAutoUpdate\Skeleton\SkeletonClass
 */
class LaravelAutoUpdateFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-auto-update';
    }
}
