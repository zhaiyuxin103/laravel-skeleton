<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class HolidayService
{
    private static string $uri = 'https://holidays-jp.github.io/api/v1';

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function fetch($year = null, $date = true, $format = 'json')
    {
        $uri = self::$uri;
        if ($year) {
            $uri .= '/' . $year;
        }
        $uri .= ($date ? '/date' : '/datetime') . '.' . $format;

        $formats = ['json', 'csv'];

        if (! in_array(strtolower($format), $formats)) {
            throw new InvalidArgumentException(trans('validation.messages.holiday.format.in', [
                'format' => $format,
                'values' => Arr::join($formats, ', '),
            ]));
        }

        try {
            $response = Http::get($uri);

            return $format === 'json' ? $response->json() : $response->body();
        } catch (Throwable $th) {
            throw new HttpException($th->getCode(), $th->getMessage());
        }
    }
}
