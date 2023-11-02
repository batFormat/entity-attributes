<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Collections;

use Batformat\EntityAttributes\Models\AttributeValues\BaseAttributeValuesModel;
use Illuminate\Support\Collection;

class AttributesValuesCollection extends Collection
{
    public function findByAttributeCode($code)
    {
        /** @var BaseAttributeValuesModel $item */
        foreach ($this as $item) {
            $attributeCode = $item->getAttributeCode();

            if (isset($attributeCode) && $attributeCode === $code) {
                return $item;
            }
        }
        return null;
    }
}
