<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models\Attributes;

class NumericAttributeModel extends AttributeModel
{
    public function getType(): string
    {
        return AttributeModel::TYPE_NUMERIC;
    }
}
