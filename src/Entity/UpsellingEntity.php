<?php declare(strict_types=1);

namespace SwagTraining\CrossSellingProducts\Entity;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class UpsellingEntity extends Entity
{
    use EntityIdTrait;

    protected string $productId = '';
    protected string $upsellingProductId = '';

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    public function getUpsellingProductId(): string
    {
        return $this->upsellingProductId;
    }

    public function setUpsellingProductId(string $upsellingProductId): void
    {
        $this->upsellingProductId = $upsellingProductId;
    }
}