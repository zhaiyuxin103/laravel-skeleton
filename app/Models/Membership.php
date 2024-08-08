<?php

namespace App\Models;

use App\Traits\HasDateTimeFormatter;
use Laravel\Jetstream\Membership as JetstreamMembership;

/**
 * @mixin IdeHelperMembership
 */
class Membership extends JetstreamMembership
{
    use HasDateTimeFormatter;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
