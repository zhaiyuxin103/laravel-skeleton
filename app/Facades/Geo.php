<?php

namespace App\Facades;

use App\Services\GeoService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed fetch(array $query, string $format = 'json')
 *
 * @see \App\Services\GeoService
 */
class Geo extends Facade
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getFacadeAccessor(): string
    {
        return GeoService::class;
    }
}