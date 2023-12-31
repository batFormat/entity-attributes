<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models\AttributeValues;

use Batformat\EntityAttributes\Models\AttributeValues\Factories\AttributeValuesModelFactory;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\BaseAttributeValueCollection;

class BaseAttributeValuesModel
{
    protected string|null $attributeCode;

    protected BaseAttributeValueCollection $values;

    public static function fromArray(array $value): BaseAttributeValuesModel
    {
        return AttributeValuesModelFactory::createModel($value);
    }

    public function getAttributeCode(): ?string
    {
        return $this->attributeCode;
    }

    public function setAttributeCode(?string $attributeCode): BaseAttributeValuesModel
    {
        $this->attributeCode = $attributeCode;

        return $this;
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
