<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models;

use Batformat\EntityAttributes\Collections\AttributesValuesCollection;

class Entity
{
    protected int $id;
    protected AttributesValuesCollection|null $attributesValues;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

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

