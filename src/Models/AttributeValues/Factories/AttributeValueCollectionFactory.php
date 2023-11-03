<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models\AttributeValues\Factories;

use Batformat\EntityAttributes\Models\Attributes\AttributeModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\BaseAttributeValueCollection;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\NumericAttributeValueCollection;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\SelectAttributeValueCollection;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\TextAttributeValueCollection;

class AttributeValueCollectionFactory
{
    /**
     * @param array $attribute
     *
     * @return BaseAttributeValueCollection
     */
    public static function createCollection(array $attribute): BaseAttributeValueCollection
    {
        $attributeType = $attribute['attribute_type'] ?? null;

        switch ($attributeType) {
            case AttributeModel::TYPE_TEXT:
                $collection = new TextAttributeValueCollection();
                break;
            case AttributeModel::TYPE_NUMERIC:
                $collection = new NumericAttributeValueCollection();
                break;
            case AttributeModel::TYPE_SELECT:
                $collection = new SelectAttributeValueCollection();
                break;
            default:
                trigger_error(
                    "Unprocessable attribute type '{$attributeType}'.",
                    E_USER_NOTICE
                );
                $collection = new BaseAttributeValueCollection();
                break;
        }

        foreach ($attribute['values'] as $value) {
            $valueModel = AttributeValueModelFactory::createModel($attribute);
            $valueModel = $valueModel::fromArray($value);
            $collection->add($valueModel);
        }

        return $collection;
    }
}
