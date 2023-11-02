<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models;

use Batformat\EntityAttributes\Collections\AttributesValuesCollection;

class EntityModel
{
    protected AttributesValuesCollection|null $attributesValues;

    public function getAttributesValues(): ?AttributesValuesCollection
    {
        return $this->attributesValues;
    }

    public function setAttributesValues(?AttributesValuesCollection $values): self
    {
        $this->attributesValues = $values;

        return $this;
    }
}

