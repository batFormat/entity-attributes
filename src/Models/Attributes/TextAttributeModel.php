<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models\Attributes;

class TextAttributeModel extends AttributeModel
{
    public function getType(): string
    {
        return AttributeModel::TYPE_TEXT;
    }
}
