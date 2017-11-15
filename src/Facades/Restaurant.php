<?php

namespace TakeawayTown\LaravelRestaurant\Facades;

class Restaurant extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'restaurant';
    }
}
