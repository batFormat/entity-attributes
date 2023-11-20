<?php

namespace Batformat\EntityAttributes\Tests;

use Batformat\EntityAttributes\Models\Attributes\AttributeModel;
use Batformat\EntityAttributes\Models\Attributes\NumericAttributeModel;
use Batformat\EntityAttributes\Models\Attributes\SelectAttributeModel;
use Batformat\EntityAttributes\Models\Attributes\TextAttributeModel;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase;

class AttributeTest extends TestCase
{
    use WithWorkbench;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testTextAttributeModelHasGetType(): void
    {
        $textAttributeModel = new TextAttributeModel();

        $this->assertEquals(AttributeModel::TYPE_TEXT, $textAttributeModel->getType());
    }

    public function testSelectAttributeModelHasGetType(): void
    {
        $selectAttributeModel = new SelectAttributeModel();

        $this->assertEquals(AttributeModel::TYPE_SELECT, $selectAttributeModel->getType());
    }

    public function testNumericAttributeModelHasGetType(): void
    {
        $numericAttributeModel = new NumericAttributeModel();

        $this->assertEquals(AttributeModel::TYPE_NUMERIC, $numericAttributeModel->getType());
    }
}
