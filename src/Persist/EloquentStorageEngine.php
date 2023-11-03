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

class EloquentStorageEngine extends StorageEngine
{
    protected array $mapGroups = [
        TextAttributeValuesModel::class    => AttributeScalarValue::class,
        NumericAttributeValuesModel::class => AttributeScalarValue::class,
        SelectAttributeValuesModel::class  => AttributeEnumValue::class,
    ];

    public function flush(): void
    {
        $collection = $this->entityModel->getAttributesValues();

        /** @var BaseAttributeValuesModel $item */
        foreach ($collection as $item) {
            $attributeValueCollection = new AttributeValueCollection();
            $attributeValueCollection->setAttributeId($item->getAttributeId());
            $attributeValueCollection->save();

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
    }
}
