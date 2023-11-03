<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist\Models;

use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\BaseAttributeValueModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\NumericAttributeValueModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\TextAttributeValueModel;

class AttributeScalarValue extends AttributeValue
{
    protected $fillable = [
        'attribute_value_collection_id',
        'text_value',
        'integer_value',
    ];

    protected static array $columns = [
        TextAttributeValueModel::class    => 'text_value',
        NumericAttributeValueModel::class => 'integer_value',
    ];

    public static function fromValueModelWithCollectionId(
        BaseAttributeValueModel $valueModel,
        int $attributeValueCollectionId
    ): AttributeValue {
        return new self([
            self::$columns[$valueModel::class] => $valueModel->getValue(),
            'attribute_value_collection_id'    => $attributeValueCollectionId,
        ]);
    }
}

