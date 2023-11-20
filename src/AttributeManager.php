<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes;

use Batformat\EntityAttributes\DTOs\AttributeValueDTO;
use Batformat\EntityAttributes\DTOs\TextAttributeValueDTO;
use Batformat\EntityAttributes\Models\AttributeValues\BaseAttributeValuesModel;
use Illuminate\Support\Collection;

class AttributeManager
{
    private Collection $attributesValues;

    public function __construct()
    {
        $this->attributesValues = collect();
    }

    public function getValues(): Collection
    {
        return $this->attributesValues;
    }

    public function setAttributesValues(array $attributesValues): self
    {
        foreach ($attributesValues as $key => $value) {
            $this->setAttributeValue($key, $value);
        }

        return $this;
    }

    public function setAttributeValue(string $key, AttributeValueDTO $attributeValueDTO): self
    {
        $this->attributesValues->put(
            $key,
            BaseAttributeValuesModel::fromArray($attributeValueDTO->toArray())
        );

        return $this;
    }

    // or scalar value?
    public function addTextValue(string $attributeCode, string $value): self
    {
        $attributeValue = new TextAttributeValueDTO(
            attributeCode: $attributeCode,
            values: [$value],
        );

        $this->setAttributeValue($attributeCode, $attributeValue);

        return $this;
    }

    //        ->addNumericValue()
    //        ->addSelectValue()

}
