<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\DTOs;

use Batformat\EntityAttributes\Models\Attributes\AttributeModel;

class NumericAttributeValueDTO extends AttributeValueDTO
{
    public function toArray(): array
    {
        return [
            'attribute_type' => AttributeModel::TYPE_NUMERIC,
            'attribute_code' => $this->attributeCode,
            'values' => collect($this->values)->map(fn($item) => ['value' => $item])->toArray(),
        ];
    }
}