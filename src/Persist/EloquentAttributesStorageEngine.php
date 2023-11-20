<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist;

use Batformat\EntityAttributes\Collections\AttributesValuesCollection;
use Batformat\EntityAttributes\Models\AttributeValues\BaseAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\NumericAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\SelectAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\TextAttributeValuesModel;
use Batformat\EntityAttributes\Persist\Models\AttributeEnumValue;
use Batformat\EntityAttributes\Persist\Models\AttributeScalarValue;
use Batformat\EntityAttributes\Persist\Models\AttributeValue;
use Illuminate\Support\Collection;

class EloquentAttributesStorageEngine extends StorageEngine
{
    protected array $mapGroups = [
        TextAttributeValuesModel::class => AttributeScalarValue::class,
        NumericAttributeValuesModel::class => AttributeScalarValue::class,
        SelectAttributeValuesModel::class => AttributeEnumValue::class,
    ];

    public function getAttributesValues(): AttributesValuesCollection
    {
        $collection = new Collection();

        $scalarValues = AttributeScalarValue::query()
            ->where('entity_id', $this->entityModel->getId())
            ->get();

        $enumValues = AttributeEnumValue::query()
            ->where('entity_id', $this->entityModel->getId())
            ->get();

        collect()
            ->merge($scalarValues)
            ->merge($enumValues)
            ->groupBy('attribute_id')
            ->each(function (Collection $items) use ($collection) {
                $item = $items->first();

                if ($item instanceof AttributeEnumValue) {
                    $collection->add([
                        'attribute_id' => $item->attribute_id,
                        'attribute_type' => $item->attribute_type,
                        'attribute_code' => $item->attribute_code,
                        'values' => $item->json_value
                    ]);
                } else {
                    $collection->add([
                        'attribute_id' => $item->attribute_id,
                        'attribute_type' => $item->attribute_type,
                        'attribute_code' => $item->attribute_code,
                        'values' => $items->toArray()
                    ]);
                }
            });

        $actualEntityAttributesValues = new AttributesValuesCollection();

        foreach ($collection as $valuesCollection) {
            $attributeValueModel = BaseAttributeValuesModel::fromArray($valuesCollection);
            $actualEntityAttributesValues->add($attributeValueModel);
        }

        return $actualEntityAttributesValues;
    }

    public function save(): void
    {
        $collection = $this->entityModel->getAttributesValues();

        $requests = [];

        /** @var BaseAttributeValuesModel $item */
        foreach ($collection as $item) {
            $values = [];

            $attributes = [
                'entity_id' => $this->entityModel->getId(),
                'attribute_id' => $item->getAttributeId(),
                'attribute_type' => $item->getFieldType(),
                'attribute_code' => $item->getAttributeCode(),
            ];

            /** @var class-string<AttributeValue> $className */
            $className = $this->mapGroups[$item::class];

            if ($className === AttributeEnumValue::class) {
                $values[] = [
                    ...$attributes,
                    'json_value' => $item->getValues()->map(fn($item) => $item->toArray())->toJson()
                ];
            } else {
                foreach ($item->getValues() as $value) {
                    $values[] = [
                        ...$attributes,
                        ...$className::fromValuesModelsToArray($item, $value)
                    ];
                }
            }

            $requests[$className] = array_merge($requests[$className] ?? [], $values);
        }

        /** @var class-string<AttributeValue> $className */
        foreach ($requests as $className => $values) {
            $model = new $className;
            $model->upsert($values, $className::uniqueBy());
        }
    }
}
