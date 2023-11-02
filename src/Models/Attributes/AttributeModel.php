<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models\Attributes;

class AttributeModel
{
    public const TYPE_TEXT = 'text';
    public const TYPE_NUMERIC = 'numeric';
    public const TYPE_CHECKBOX = 'checkbox';
    public const TYPE_SELECT = 'select';
    public const TYPE_MULTISELECT = 'multiselect';

    protected int $id;

    protected string|null $name;
}

