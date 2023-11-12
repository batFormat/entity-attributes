<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Persist;

use Batformat\EntityAttributes\Models\AttributeValues\BaseAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\NumericAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\SelectAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\TextAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\BaseAttributeValueModel;
use Batformat\EntityAttributes\Persist\Models\AttributeEnumValue;
use Batformat\EntityAttributes\Persist\Models\AttributeScalarValue;
use Batformat\EntityAttributes\Persist\Models\AttributeValue;
use Batformat\EntityAttributes\Persist\Models\AttributeValueCollection;
use Illuminate\Support\Facades\DB;

class EloquentStorageEngine extends StorageEngine
{
    protected array $mapGroups = [
        TextAttributeValuesModel::class => AttributeScalarValue::class,
        NumericAttributeValuesModel::class => AttributeScalarValue::class,
        SelectAttributeValuesModel::class => AttributeEnumValue::class,
    ];

    public function flush(): void
    {
        $collection = $this->entityModel->getAttributesValues();

        $values = [];

        /** @var BaseAttributeValuesModel $item */
        foreach ($collection as $item) {
            $attributeValueCollection = new AttributeValueCollection();
            $attributeValueCollection->setAttributeId($item->getAttributeId());
            // TODO: Add method to phpdoc in BaseAttributeValuesModel
            $attributeValueCollection->setAttributeType($item->getFieldType());
            $attributeValueCollection->setAttributeCode($item->getAttributeCode());
            $attributeValueCollection->save();

            $values[] = [
                'entity_id' => $this->entityModel->getId(),
                'attribute_value_collection_id' => $attributeValueCollection->id
            ];

            /** @var BaseAttributeValueModel $value */
            foreach ($item->getValues() as $value) {
                /** @var AttributeValue $valueModel */
                $valueModel = $this->mapGroups[$item::class]::fromValueModelWithCollectionId(
                    $value,
                    $attributeValueCollection->id
                );

                $valueModel->save();
            }
        }

        DB::table('attribute_value_collection_entities')
            ->upsert($values, ['entity_id', 'attribute_value_collection_id']);
    }
}
