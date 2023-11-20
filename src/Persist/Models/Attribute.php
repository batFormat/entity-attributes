<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Attribute extends Model
{
    protected $fillable = [
        'name',
        'code',
        'type',
    ];
}

