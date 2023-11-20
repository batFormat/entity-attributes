<?php

namespace Batformat\EntityAttributes\Tests;

use Batformat\EntityAttributes\Models\AttributeValues\Factories\AttributeValuesModelFactory;
use Batformat\EntityAttributes\Models\AttributeValues\NumericAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\SelectAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\TextAttributeValuesModel;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase;

class AttributeValuesModelFactoryTest extends TestCase
{
    use WithWorkbench;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testScalarTextFactory(): void
    {
        $value = [
            'attribute_id' => 1,
            'attribute_type' => 'text',
            'attribute_code' => 'city',
            'values' => [
                [
                    'value' => 'Вологда'
                ]
            ],
        ];

        $textAttributeValuesModel = AttributeValuesModelFactory::createModel($value);

        $this->assertInstanceOf(TextAttributeValuesModel::class, $textAttributeValuesModel);
    }

    public function testEnumFactory(): void
    {
        $value = [
            'attribute_id' => 2,
            'attribute_type' => 'select',
            'attribute_code' => 'status',
            'values' => [
                [
                    'value' => 'ПНЗ',
                    "enum_id" => 1,
                    "enum_code" => null
                ],
                [
                    'value' => 'В работе',
                    "enum_id" => 2,
                    "enum_code" => null
                ]
            ],
        ];

        $selectAttributeValuesModel = AttributeValuesModelFactory::createModel($value);

        $this->assertInstanceOf(SelectAttributeValuesModel::class, $selectAttributeValuesModel);
    }

    public function testScalarNumericFactory(): void
    {
        $value = [
            'attribute_id' => 3,
            'attribute_type' => 'numeric',
            'attribute_code' => 'price',
            'values' => [
                [
                    'value' => 100000
                ]
            ],
        ];

        $numericAttributeValuesModel = AttributeValuesModelFactory::createModel($value);

        $this->assertInstanceOf(NumericAttributeValuesModel::class, $numericAttributeValuesModel);
    }
}
