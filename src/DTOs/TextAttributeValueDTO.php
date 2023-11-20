<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\DTOs;

use Batformat\EntityAttributes\Models\Attributes\AttributeModel;

class TextAttributeValueDTO extends AttributeValueDTO
{
    public function toArray(): array
    {
        return [
            'attribute_id' => $this->attributeId,
            'attribute_type' => AttributeModel::TYPE_TEXT,
            'attribute_code' => $this->attributeCode,
            'values' => collect($this->values)->map(fn($item) => ['value' => $item])->toArray(),
        ];
    }
}