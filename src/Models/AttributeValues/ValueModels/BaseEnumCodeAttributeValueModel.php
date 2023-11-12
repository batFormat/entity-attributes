<?php

declare(strict_types=1);

namespace Batformat\EntityAttributes\Models\AttributeValues\ValueModels;

class BaseEnumCodeAttributeValueModel extends BaseAttributeValueModel
{
    protected ?string $enumCode;

    protected ?int $enumId;

    public function __construct()
    {
        $this->enumId = null;
        $this->enumCode = null;
    }

    public static function fromArray($value): BaseAttributeValueModel
    {
        $model = new static();

        $enumId = isset($value['enum_id']) ? (int)$value['enum_id'] : null;
        $enumCode = $value['enum_code'] ?? null;
        $fieldValue = $value['value'] ?? null;

        $model
            ->setValue($fieldValue)
            ->setEnumId($enumId)
            ->setEnumCode($enumCode);

        return $model;
    }

    public function getEnumCode(): ?string
    {
        return $this->enumCode;
    }

    public function setEnumCode(?string $enumCode): BaseEnumCodeAttributeValueModel
    {
        $this->enumCode = $enumCode;

        return $this;
    }

    public function getEnumId(): ?int
    {
        return $this->enumId;
    }

    public function setEnumId(?int $enumId): BaseEnumCodeAttributeValueModel
    {
        $this->enumId = $enumId;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'value' => $this->getValue(),
            'enum_id' => $this->getEnumId(),
            'enum_code' => $this->getEnumCode(),
        ];
    }
}
