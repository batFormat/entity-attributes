<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist\Models;

use Batformat\EntityAttributes\Models\AttributeValues\BaseAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\BaseAttributeValueModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
abstract class AttributeValue extends Model
{
    abstract public static function fromValuesModelsToArray(
        BaseAttributeValuesModel $valuesModel,
        BaseAttributeValueModel $valueModel
    ): array;

    abstract public static function fromArray(
        BaseAttributeValuesModel $valuesModel,
        BaseAttributeValueModel $valueModel
    ): self;

    abstract public static function uniqueBy(): array;
}

