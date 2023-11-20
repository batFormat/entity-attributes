<?php

namespace Batformat\EntityAttributes\Tests;

use Batformat\EntityAttributes\AttributeManager;
use Batformat\EntityAttributes\Models\AttributeValues\TextAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\TextAttributeValueCollection;
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

    public function testAttributeValueDTO(): void
    {
        $cityAttributeValueModel = new TextAttributeValuesModel();
        $cityAttributeValueModel->setAttributeId(1);
        $cityAttributeValueModel->setAttributeCode('city');
        $cityAttributeValueModel->setValues(
            (new TextAttributeValueCollection())
                ->add((new TextAttributeValueModel())->setValue('Вологда'))
        );

        $attributeManager = new AttributeManager();
        $attributeManager->addTextValue(1, 'city', 'Вологда');

        $this->assertEquals($cityAttributeValueModel, $attributeManager->getValues()->first());
    }
}
