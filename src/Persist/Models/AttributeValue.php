<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist\Models;

use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\BaseAttributeValueModel;
use Illuminate\Database\Eloquent\Model;

abstract class AttributeValue extends Model
{
    abstract public static function fromValueModelWithCollectionId(
        BaseAttributeValueModel $valueModel,
        int $attributeValueCollectionId
    ): self;
}

