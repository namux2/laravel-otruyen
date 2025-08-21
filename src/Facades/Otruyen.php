<?php

namespace YourVendor\Otruyen\Facades;

use Illuminate\Support\Facades\Facade;

class Otruyen extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'otruyen';
    }
}
