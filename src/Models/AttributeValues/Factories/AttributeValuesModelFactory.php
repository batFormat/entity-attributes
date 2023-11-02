<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models\AttributeValues\Factories;

use Batformat\EntityAttributes\Exceptions\BadTypeException;
use Batformat\EntityAttributes\Models\Attributes\AttributeModel;
use Batformat\EntityAttributes\Models\AttributeValues\BaseAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\TextAttributeValuesModel;

class AttributeValuesModelFactory
{
    /**
     * @param array $attribute
     *
     * @return BaseAttributeValuesModel
     * @throws BadTypeException
     */
    public static function createModel(array $attribute): BaseAttributeValuesModel
    {
        $attributeType = $attribute['attribute_type'] ?? null;

        switch ($attributeType) {
            case AttributeModel::TYPE_TEXT:
                $model = new TextAttributeValuesModel();
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
            ->setAttributeId($attribute['attribute_id'] ?? null);

        return $model;
    }
}