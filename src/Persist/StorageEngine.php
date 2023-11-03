<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist;

use Batformat\EntityAttributes\Models\EntityModel;

abstract class StorageEngine
{
    protected EntityModel $entityModel;

    public function __construct(EntityModel $entityModel)
    {
        $this->entityModel = $entityModel;
    }

    abstract public function flush(): void;
}