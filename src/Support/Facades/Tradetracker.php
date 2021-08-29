<?php

namespace Eelcol\LaravelTradedoubler\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Tradetracker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tradetracker';
    }
}