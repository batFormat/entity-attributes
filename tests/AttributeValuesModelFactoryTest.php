<?php

namespace Batformat\EntityAttributes\Tests;

use Batformat\EntityAttributes\Exceptions\BadTypeException;
use Batformat\EntityAttributes\Models\AttributeValues\Factories\AttributeValuesModelFactory;
use Batformat\EntityAttributes\Models\AttributeValues\TextAttributeValuesModel;
use PHPUnit\Framework\TestCase;

class AttributeValuesModelFactoryTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @throws BadTypeException
     */
    public function testFactory(): void
    {
        // attribute_value_collection
        $value = [
            'attribute_id'   => 1,
            'attribute_type' => 'text',
            'attribute_code' => 'city',
            'values'         => [
                [
                    'value' => 'Вологда'
                ]
            ],
        ];

        $textAttributeValuesModel = AttributeValuesModelFactory::createModel($value);

        $this->assertInstanceOf(TextAttributeValuesModel::class, $textAttributeValuesModel);
    }
}
