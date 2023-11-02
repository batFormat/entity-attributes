<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models\AttributeValues\Factories;

use Batformat\EntityAttributes\Models\Attributes\AttributeModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\BaseAttributeValueModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\TextAttributeValueModel;

class AttributeValueModelFactory
{
    /**
     * @param array $attribute
     *
     * @return BaseAttributeValueModel
     */
    public static function createModel(array $attribute): BaseAttributeValueModel
    {
        $attributeType = $attribute['attribute_type'] ?? null;

        switch ($attributeType) {
            case AttributeModel::TYPE_TEXT:
                $model = new TextAttributeValueModel();
                break;
            default:
                trigger_error(
                    "Unprocessable attribute type '{$attributeType}'.",
                    E_USER_NOTICE
                );
                $model = new BaseAttributeValueModel();
                break;
        }

        return $model;
    }
}