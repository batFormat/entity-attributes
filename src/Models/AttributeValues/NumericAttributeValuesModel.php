<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models\AttributeValues;

use Batformat\EntityAttributes\Models\Attributes\AttributeModel;

class NumericAttributeValuesModel extends BaseAttributeValuesModel
{
    public function getFieldType(): string
    {
        return AttributeModel::TYPE_NUMERIC;
    }
}
