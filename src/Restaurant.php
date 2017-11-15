<?php

namespace TakeawayTown\LaravelRestaurant;

use Illuminate\Support\Facades\Config;

class Restaurant
{
    /**
     * Our Laravel Application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new Teamwork instance.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct( $app )
    {
        $this->app = $app;
    }

}
