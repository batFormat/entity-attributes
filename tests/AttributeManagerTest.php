<?php

namespace Batformat\EntityAttributes\Tests;

use Batformat\EntityAttributes\AttributeManager;
use Batformat\EntityAttributes\Models\AttributeValues\NumericAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\SelectAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\TextAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\NumericAttributeValueCollection;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\SelectAttributeValueCollection;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\TextAttributeValueCollection;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\NumericAttributeValueModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\SelectAttributeValueModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\TextAttributeValueModel;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase;

class AttributeManagerTest extends TestCase
{
    use WithWorkbench;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testTextAttributeValueDTO(): void
    {
        $cityAttributeValueModel = new TextAttributeValuesModel();
        $cityAttributeValueModel->setAttributeCode('city');
        $cityAttributeValueModel->setValues(
            (new TextAttributeValueCollection())
                ->add((new TextAttributeValueModel())->setValue('Вологда'))
        );

        $attributeManager = new AttributeManager();
        $attributeManager->addTextValue('city', 'Вологда');

        $this->assertEquals($cityAttributeValueModel, $attributeManager->getValues()->first());
    }

    public function testNumericAttributeValueDTO(): void
    {
        $priceAttributeValueModel = new NumericAttributeValuesModel();
        $priceAttributeValueModel->setAttributeCode('price');
        $priceAttributeValueModel->setValues(
            (new NumericAttributeValueCollection())
                ->add((new NumericAttributeValueModel())->setValue(500000))
        );

        $attributeManager = new AttributeManager();
        $attributeManager->addNumericValue('price', 500000);

        $this->assertEquals($priceAttributeValueModel, $attributeManager->getValues()->first());
    }

    public function testSelectAttributeValueDTO(): void
    {
        $statusAttributeValueModel = new SelectAttributeValuesModel();
        $statusAttributeValueModel->setAttributeCode('status');
        $statusAttributeValueModel->setValues(
            (new SelectAttributeValueCollection())
                ->add(
                    (new SelectAttributeValueModel())
                        ->setEnumId(111)
                        ->setValue('Новый')
                )
                ->add(
                    (new SelectAttributeValueModel())
                        ->setEnumId(555)
                        ->setValue('В работе')
                )
        );

        $attributeManager = new AttributeManager();

        $attributeManager->addSelectValue('status', [
            ['enum_id' => 111, 'value' => 'Новый'],
            ['enum_id' => 555, 'value' => 'В работе'],
        ]);

        $this->assertEquals($statusAttributeValueModel, $attributeManager->getValues()->first());
    }
}
