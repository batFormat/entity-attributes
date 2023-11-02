<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models\AttributeValues\ValueModels;

class BaseAttributeValueModel
{
    protected string|int|bool|array|null|object $value;

    public function getValue(): object|int|bool|array|string|null
    {
        return $this->value;
    }

    public function setValue(array|bool|int|string|null $value): BaseAttributeValueModel
    {
        $this->value = $value;

        return $this;
    }
}
