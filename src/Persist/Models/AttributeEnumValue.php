<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist\Models;

use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\BaseAttributeValueModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\SelectAttributeValueModel;

class AttributeEnumValue extends AttributeValue
{
    protected $fillable = [
        'attribute_value_collection_id',
        'enum_code',
        'enum_id',
    ];

    public static function fromValueModelWithCollectionId(
        SelectAttributeValueModel|BaseAttributeValueModel $valueModel,
        int $attributeValueCollectionId
    ): AttributeValue {
        return new self([
            'attribute_value_collection_id' => $attributeValueCollectionId,
            'enum_code'                     => $valueModel->getEnumCode(),
            'enum_id'                       => $valueModel->getEnumId(),
        ]);
    }
}

