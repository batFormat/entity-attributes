<?php

namespace Batformat\EntityAttributes\Tests;

use Batformat\EntityAttributes\Collections\AttributesValuesCollection;
use Batformat\EntityAttributes\Models\AttributeValues\BaseAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\SelectAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\TextAttributeValuesModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\SelectAttributeValueCollection;
use Batformat\EntityAttributes\Models\AttributeValues\ValueCollections\TextAttributeValueCollection;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\SelectAttributeValueModel;
use Batformat\EntityAttributes\Models\AttributeValues\ValueModels\TextAttributeValueModel;
use Batformat\EntityAttributes\Models\Entity;
use Batformat\EntityAttributes\Persist\EloquentStorageEngine;
use Batformat\EntityAttributes\Persist\Models\AttributeValueCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase;

class EntityModelTest extends TestCase
{
    use WithWorkbench;

    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadLaravelMigrations();

        $this->seed();
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

        $entityModel = new Entity();
        $entityModel->setAttributesValues($entityAttributesValues);

        $cityAttributeValueModel = $entityModel->getAttributesValues()
            ->findByAttributeCode('city');

        $this->assertInstanceOf(TextAttributeValuesModel::class, $cityAttributeValueModel);
        $this->assertEquals('Вологда', $cityAttributeValueModel->getValues()->first()->getValue());
    }

    public function testEntityModelCanStoreAttributesValues(): void
    {
        $entity = new Entity();
        $entity->setId(100500);

        $entityAttributesValues = $this->storeAttributesValuesCollection($entity);
        $actualEntityAttributesValues = $this->getAttributesValuesCollection($entity);

        $this->assertEquals($entityAttributesValues, $actualEntityAttributesValues);
    }
    public function storeAttributesValuesCollection(Entity $entity): Collection
    {
        $cityAttributeValueModel = new TextAttributeValuesModel();
        $cityAttributeValueModel->setAttributeId(1);
        $cityAttributeValueModel->setAttributeCode('city');
        $cityAttributeValueModel->setValues(
            (new TextAttributeValueCollection())
                ->add((new TextAttributeValueModel())->setValue('Вологда'))
        );

        $statusAttributeValueModel = new SelectAttributeValuesModel();
        $statusAttributeValueModel->setAttributeId(2);
        $statusAttributeValueModel->setAttributeCode('status');
        $statusAttributeValueModel->setValues(
            (new SelectAttributeValueCollection())
                ->add(
                    (new SelectAttributeValueModel())
                        ->setEnumId(555)
                        ->setValue('Новый')
                )
        );

        $entityAttributesValues = new AttributesValuesCollection();
        $entityAttributesValues
            ->add($cityAttributeValueModel)
            ->add($statusAttributeValueModel);

        $entity->setAttributesValues($entityAttributesValues);

        $storage = new EloquentStorageEngine($entity);
        $storage->flush();

        return $entityAttributesValues;
    }

    public function getAttributesValuesCollection(Entity $entity): AttributesValuesCollection
    {
        $valuesCollectionIds = DB::table('attribute_value_collection_entities')
            ->where('entity_id', $entity->getId())
            ->pluck('attribute_value_collection_id');

        $valuesCollections = AttributeValueCollection::query()
            ->whereIn('id', $valuesCollectionIds)
            ->get();

        $actualEntityAttributesValues = new AttributesValuesCollection();

        foreach ($valuesCollections as $valuesCollection) {
            $attributeValueModel = BaseAttributeValuesModel::fromArray($valuesCollection->toArray());
            $actualEntityAttributesValues->add($attributeValueModel);
        }

        return $actualEntityAttributesValues;
    }
}
