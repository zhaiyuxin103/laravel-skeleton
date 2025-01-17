<?php

declare(strict_types=1);

namespace App\Facades;

use App\Services\HolidayService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed fetch($year = null, $date = true, $format = 'json')
 *
 * @see HolidayService
 */
class Holiday extends Facade
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
        return HolidayService::class;
    }
}
