<?php

namespace Batformat\EntityAttributes\Tests;

use Batformat\EntityAttributes\Collections\AttributesValuesCollection;
use Batformat\EntityAttributes\Models\AttributeValues\TextAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\TextAttributeValueCollection;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\TextAttributeValueModel;
use Batformat\EntityAttributes\Models\EntityModel;
use Orchestra\Testbench\TestCase;

class EntityModelTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testEntityModelTestHasContainsAttributesValues(): void
    {
        $cityAttributeValueModel = new TextAttributeValuesModel();
        $cityAttributeValueModel->setAttributeCode('city');
        $cityAttributeValueModel->setValues(
            (new TextAttributeValueCollection())
                ->add((new TextAttributeValueModel())->setValue('Вологда'))
        );

        $entityAttributesValues = new AttributesValuesCollection();
        $entityAttributesValues->add($cityAttributeValueModel);

        $entityModel = new EntityModel();
        $entityModel->setCustomFieldsValues($entityAttributesValues);

        $cityAttributeValueModel = $entityModel->getCustomFieldsValues()
            ->findByAttributeCode('city');

        $this->assertInstanceOf(TextAttributeValuesModel::class, $cityAttributeValueModel);
        $this->assertEquals('Вологда', $cityAttributeValueModel->getValues()->first()->getValue());
    }
}
