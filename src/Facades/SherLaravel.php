<?php

namespace IUGOsds\SherLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class SherLaravel extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sherlaravel';
    }
}
