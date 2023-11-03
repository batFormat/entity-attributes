<?php

namespace Batformat\EntityAttributes\Tests;

use Batformat\EntityAttributes\Collections\AttributesValuesCollection;
use Batformat\EntityAttributes\Models\AttributeValues\TextAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\TextAttributeValueCollection;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\TextAttributeValueModel;
use Batformat\EntityAttributes\Models\EntityModel;
use Batformat\EntityAttributes\Persist\EloquentStorageEngine;
use Batformat\EntityAttributes\Persist\StorageEngine;
use PHPUnit\Framework\TestCase;

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
        $entityModel->setAttributesValues($entityAttributesValues);

        $cityAttributeValueModel = $entityModel->getAttributesValues()
            ->findByAttributeCode('city');

        $this->assertInstanceOf(TextAttributeValuesModel::class, $cityAttributeValueModel);
        $this->assertEquals('Вологда', $cityAttributeValueModel->getValues()->first()->getValue());
    }

    public function testEntityModelCanStoreAttributesValues(): void
    {
        $cityAttributeValueModel = new TextAttributeValuesModel();
        $cityAttributeValueModel->setAttributeId(1);
        $cityAttributeValueModel->setAttributeCode('city');
        $cityAttributeValueModel->setValues(
            (new TextAttributeValueCollection())
                ->add((new TextAttributeValueModel())->setValue('Вологда'))
        );

        $entityAttributesValues = new AttributesValuesCollection();
        $entityAttributesValues->add($cityAttributeValueModel);

        $entityModel = new EntityModel();
        $entityModel->setAttributesValues($entityAttributesValues);

        $storage = new EloquentStorageEngine($entityModel);
        $storage->flush();
    }
}
