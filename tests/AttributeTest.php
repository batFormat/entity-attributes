<?php

namespace Batformat\EntityAttributes\Tests;

use Batformat\EntityAttributes\Models\Attributes\AttributeModel;
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
}
