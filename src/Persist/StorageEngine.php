<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist;

use Batformat\EntityAttributes\Models\Entity;

abstract class StorageEngine
{
    protected Entity $entityModel;

    public function __construct(Entity $entityModel)
    {
        $this->entityModel = $entityModel;
    }

    abstract public function flush(): void;
}