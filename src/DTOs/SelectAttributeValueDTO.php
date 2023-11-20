<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\DTOs;

use Batformat\EntityAttributes\Models\Attributes\AttributeModel;

class SelectAttributeValueDTO extends AttributeValueDTO
{
    public function toArray(): array
    {
        return [
            'attribute_id' => $this->attributeId,
            'attribute_type' => AttributeModel::TYPE_SELECT,
            'attribute_code' => $this->attributeCode,
            'values' => $this->values,
        ];
    }
}