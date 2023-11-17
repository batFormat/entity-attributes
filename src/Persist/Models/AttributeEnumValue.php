<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist\Models;

use Batformat\EntityAttributes\Models\AttributeValues\BaseAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\BaseAttributeValueModel;

class AttributeEnumValue extends AttributeValue
{
    protected $fillable = [
        'entity_id',
        'attribute_id',
        'attribute_type',
        'attribute_code',
        'json_value',
    ];

    protected $casts = [
        'json_value' => 'json'
    ];

    public static function fromValuesModelsToArray(
        BaseAttributeValuesModel $valuesModel,
        BaseAttributeValueModel $valueModel
    ): array {
        return [
            'enum_code' => $valueModel->getEnumCode(),
            'enum_id'   => $valueModel->getEnumId(),
            'value'     => $valueModel->getValue()
        ];
    }

    public static function fromArray(
        BaseAttributeValuesModel $valuesModel,
        BaseAttributeValueModel $valueModel
    ): AttributeValue {
        return new self(self::fromValuesModelsToArray($valuesModel, $valueModel));
    }

    public static function uniqueBy(): array
    {
        return ['entity_id', 'attribute_id'];
    }
}

