<?php declare(strict_types=1);

namespace SwagTraining\UpsellingProducts\Entity;

use Shopware\Core\Content\Product\ProductEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class UpsellingEntity extends Entity
{
    use EntityIdTrait;

    protected string $productId = '';
    protected string $upsellingProductId = '';
    protected ?ProductEntity $product = null;

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

    public function getProduct(): ?ProductEntity
    {
        return $this->product;
    }

    public function setProduct(?ProductEntity $product): void
    {
        $this->product = $product;
    }
}
