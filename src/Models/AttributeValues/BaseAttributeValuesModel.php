<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models\AttributeValues;

use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\BaseAttributeValueCollection;

class BaseAttributeValuesModel
{
    protected int|null $attributeId;

    protected string|null $attributeCode;

    protected BaseAttributeValueCollection $values;

    public function getAttributeId(): ?int
    {
        return $this->attributeId;
    }

    public function setAttributeId(?int $attributeId): void
    {
        $this->attributeId = $attributeId;
    }

    public function getAttributeCode(): ?string
    {
        return $this->attributeCode;
    }

    public function setAttributeCode(?string $attributeCode): void
    {
        $this->attributeCode = $attributeCode;
    }

    public function getValues(): BaseAttributeValueCollection
    {
        return $this->values;
    }


    public function setValues(BaseAttributeValueCollection $values): BaseAttributeValuesModel
    {
        $this->values = $values;

        return $this;
    }
}