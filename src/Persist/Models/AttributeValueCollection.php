<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist\Models;

use Batformat\EntityAttributes\Models\Attributes\AttributeModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttributeValueCollection extends Model
{
    // TODO: refactor this
    protected array $relationsMap = [
        AttributeModel::TYPE_TEXT => 'scalars',
        AttributeModel::TYPE_SELECT => 'enums',
        AttributeModel::TYPE_MULTISELECT => 'enums',
    ];

    public function setAttributeId(int $id): self
    {
        $this->setAttribute('attribute_id', $id);

        return $this;
    }

    public function setAttributeType(string $type): self
    {
        $this->setAttribute('attribute_type', $type);

        return $this;
    }

    public function setAttributeCode(?string $code): self
    {
        $this->setAttribute('attribute_code', $code);

        return $this;
    }

    public function scalars(): HasMany
    {
        return $this->hasMany(AttributeScalarValue::class);
    }

    public function enums(): HasMany
    {
        return $this->hasMany(AttributeEnumValue::class);
    }

    public function toArray(): array
    {
        $type = $this->getAttribute('attribute_type');
        $relationName = $this->relationsMap[$type];

        $this->load($relationName);

        return [
            'id' => $this->getAttribute('id'),
            'attribute_id' => $this->getAttribute('attribute_id'),
            'attribute_type' => $type,
            'attribute_code' => $this->getAttribute('attribute_code'),
            'values' => $this->getRelation($relationName)->map(fn($item) => $this->getFilledValue($item)),
        ];
    }

    /**
     * TODO: Поддержать полиморфизм, сделать рефакторинг
     * catalog
     * @param Model $item
     * @return mixed
     */
    public function getFilledValue(Model $item)
    {
        switch ($this->attribute_type) {
            case AttributeModel::TYPE_MULTISELECT:
            case AttributeModel::TYPE_SELECT:
                return $item;
            case AttributeModel::TYPE_TEXT:
                return ['value' => $item->text_value ?? $item->integer_value];

            default:
                break;
        }
    }
}

