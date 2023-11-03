<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValueCollection extends Model
{

    public function setAttributeId(int $attributeId): self
    {
        $this->setAttribute('attribute_id', $attributeId);

        return $this;
    }
}

