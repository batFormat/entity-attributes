<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist\Models;

use Batformat\EntityAttributes\Models\AttributeValues\BaseAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\BaseAttributeValueModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\NumericAttributeValueModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\TextAttributeValueModel;

class AttributeScalarValue extends AttributeValue
{
    protected $fillable = [
        'entity_id',
        'attribute_id',
        'attribute_type',
        'attribute_code',
        'text_value',
        'integer_value',
    ];

    protected $appends = ['value'];

    protected static $columns = [
        TextAttributeValueModel::class    => 'text_value',
        NumericAttributeValueModel::class => 'integer_value',
    ];

    public static function fromValuesModelsToArray(
        BaseAttributeValuesModel $valuesModel,
        BaseAttributeValueModel $valueModel
    ): array {
        return [
            'text_value'                       => null,
            'integer_value'                    => null,
            self::$columns[$valueModel::class] => $valueModel->getValue()
        ];
    }

    public static function fromArray(
        BaseAttributeValuesModel $valuesModel,
        BaseAttributeValueModel $valueModel
    ): AttributeValue {
        return new self(self::fromValuesModelsToArray($valuesModel, $valueModel));
    }

    public function getValueAttribute(): string|int|null
    {
        return $this->text_value ?? $this->integer_value ?? null;
    }

    public static function uniqueBy(): array
    {
        return ['entity_id', 'attribute_id'];
    }
}
