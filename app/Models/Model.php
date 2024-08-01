<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperModel
 */
class Model extends BaseModel
{
    use HasFactory;
    use SoftDeletes;
}
