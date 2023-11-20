<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\DTOs;

use Illuminate\Contracts\Support\Arrayable;

abstract class AttributeValueDTO implements Arrayable
{
    public function __construct(
        protected readonly int $attributeId,
        protected readonly string $attributeCode,
        protected readonly array $values,
    ) {
    }

    public function toArray(): array
    {
        return [
            'attribute_id' => $this->attributeId,
            'attribute_code' => $this->attributeCode,
            'values' => $this->values,
        ];
    }
}