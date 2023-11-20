<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models\AttributeValues\Factories;

use Batformat\EntityAttributes\Models\Attributes\AttributeModel;
use Batformat\EntityAttributes\Models\AttributeValues\BaseAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\SelectAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\TextAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\NumericAttributeValuesModel;

class AttributeValuesModelFactory
{
    /**
     * @param array $attribute
     *
     * @return BaseAttributeValuesModel
     */
    public static function createModel(array $attribute): BaseAttributeValuesModel
    {
        $attributeType = $attribute['attribute_type'] ?? null;

        switch ($attributeType) {
            case AttributeModel::TYPE_TEXT:
                $model = new TextAttributeValuesModel();
                break;
            case AttributeModel::TYPE_NUMERIC:
                $model = new NumericAttributeValuesModel();
                break;
            case AttributeModel::TYPE_SELECT:
                $model = new SelectAttributeValuesModel();
                break;
            default:
                trigger_error(
                    "Unprocessable attribute type '{$attributeType}'.",
                    E_USER_NOTICE
                );
                $model = new BaseAttributeValuesModel();
                break;
        }

        $values = AttributeValueCollectionFactory::createCollection($attribute);

        $model
            ->setValues($values)
            ->setAttributeCode($attribute['attribute_code'] ?? null)
        ;

        return $model;
    }
}
