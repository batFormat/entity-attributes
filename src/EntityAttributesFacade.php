<?php

namespace Batformat\EntityAttributes;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Batformat\EntityAttributes\Skeleton\SkeletonClass
 */
class EntityAttributesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'entity-attributes';
    }
}
